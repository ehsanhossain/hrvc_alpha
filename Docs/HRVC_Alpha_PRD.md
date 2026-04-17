# HRVC Alpha — Product Requirements Document (PRD)
**Version:** 1.0 (Alpha)  
**Date:** April 2026  
**Classification:** Internal — Developer Reference

---

## Table of Contents

1. [Product Overview](#1-product-overview)
2. [Goals & Non-Goals](#2-goals--non-goals)
3. [User Roles & Access Control](#3-user-roles--access-control)
4. [Organizational Hierarchy](#4-organizational-hierarchy)
5. [Module Specification](#5-module-specification)
   - 5.1 [KPI Management](#51-kpi-management)
   - 5.2 [KGI Management](#52-kgi-management)
   - 5.3 [KFI Management](#53-kfi-management)
   - 5.4 [PIM — Evaluation System](#54-pim--evaluation-system)
   - 5.5 [Salary Management](#55-salary-management)
   - 5.6 [Bonus Management](#56-bonus-management)
6. [Calculation Logic (Deep Spec)](#6-calculation-logic-deep-spec)
   - 6.1 [KPI Percentage](#61-kpi-percentage)
   - 6.2 [KGI / KFI Score](#62-kgi--kfi-score)
   - 6.3 [PIM Weight Allocation & Final Score](#63-pim-weight-allocation--final-score)
   - 6.4 [Three-Party Evaluation Average](#64-three-party-evaluation-average)
   - 6.5 [Salary Quartile Logic](#65-salary-quartile-logic)
6. [Data Models (Entity Summary)](#7-data-models-entity-summary)
7. [Tech Stack](#8-tech-stack)
8. [Architecture & Request Flow](#9-architecture--request-flow)
9. [URL Routing Map](#10-url-routing-map)
10. [Security Patterns](#11-security-patterns)
11. [Developer Setup & Environment](#12-developer-setup--environment)
12. [Status Codes Reference](#13-status-codes-reference)
13. [Open Issues & Future Work](#14-open-issues--future-work)

---

## 1. Product Overview

**HRVC Alpha** (Human Resource Value Chain — Alpha) is an enterprise-grade HR performance management platform. It provides a complete cycle for an organization to:

1. **Define** quantitative performance targets (KPI/KGI/KFI) at the company, branch, department, team and individual levels.
2. **Track** real-time progress against targets with monthly/quarterly/half-year/yearly cycles.
3. **Evaluate** employees using a weighted composite scoring model (PIM — Performance Integrated Metric).
4. **Manage** salary structures, allowances, and quartile benchmarking.
5. **Compute** performance bonuses driven by evaluation results.

The system is designed for **multi-company / multi-branch** groups, with strict role-based data isolation at every layer.

---

## 2. Goals & Non-Goals

### Goals
- Provide a centralized platform for the full HR performance cycle.
- Support multi-tenant, multi-company group configurations.
- Role-aware dashboards so each user sees only what they own.
- Full audit trails via history tables for every key entity.
- Mobile-friendly responsive layout.

### Non-Goals (Alpha scope)
- Real-time push notifications (currently polling/manual).
- Native mobile application.
- External HR system integrations (payroll software, ERP, etc.).
- Advanced analytics / BI dashboards.

---

## 3. User Roles & Access Control

Roles are stored in the `role` table and mapped per user in `user_role`. The `UserRole::userRight()` method converts a `roleId` (1–7 DB value) into an internal **privilege level** (1–7), used throughout controllers for branching logic.

| DB `roleId` | Role Name      | Privilege Level | Scope of Access |
|-------------|---------------|-----------------|-----------------|
| 1           | Admin          | **7**           | All companies, all data |
| 2           | GM             | **6**           | Company-level (their company) |
| 3           | Manager        | **5**           | Company level, same as GM |
| 4           | Supervisor / Asst. Manager | **4** | Branch → department |
| 5           | Team Leader    | **3**           | Own team only |
| 6           | HR             | **2**           | Read / HR config tasks |
| 7           | Staff          | **1**           | Own KPIs / own evaluation only |

**Key RBAC Rules (from code):**
- `isManager()` returns `1` for roleId 1–3 (Admin, GM, Manager). Only managers can update `targetAmount` during KPI update.
- `checkPermission()` on KPI/KGI gates edit access: Admin sees all; GM/Manager check `KpiBranch` matching their company's branch; Supervisor checks `KpiDepartment`; Team Leader checks `KpiTeam`.
- Staff (role 1 & 2) have read-only access to KPI records; they cannot edit.
- `isHr()` grants HR-specific configuration access.
- All controller `beforeAction()` hooks redirect unauthenticated users to `site/login`.
- All controllers additionally require a valid `groupId` — missing group → redirect to `setting/group/create-group`.

---

## 4. Organizational Hierarchy

```
Group
 └── Company (companyId, groupId)
      └── Branch (branchId, companyId)
           └── Department (departmentId, branchId, companyId)
                ├── Title (titleId, departmentId)         ← Like "Senior Engineer"
                └── Team  (teamId, companyId)
                     └── Employee (employeeId, branchId, departmentId, positionId, teamId)
                          └── User (userId, employeeId)   ← login account
```

**Key linking tables**

| Entity | Linking Entity | Purpose |
|--------|---------------|---------|
| KPI → Branch  | `kpi_branch`      | Which branches the KPI applies to |
| KPI → Dept    | `kpi_department`  | Which departments |
| KPI → Team    | `kpi_team`        | Which teams, includes team-level target |
| KPI → Employee| `kpi_employee`    | Which individuals, includes individual target+result |
| KGI → …       | Same pattern      | `kgi_branch`, `kgi_department`, `kgi_team`, `kgi_employee` |
| KFI           | `kfi_branch`, `kfi_department`, `kfi_employee` | KFI has no team dimension |

---

## 5. Module Specification

### 5.1 KPI Management

**What is a KPI?**  
A Key Performance Indicator is a quantitative metric with a target amount, measurement unit, time period, and priority. KPIs can be measured Monthly, Quarterly, Half-Yearly, or Yearly.

**Core Fields on the `kpi` table:**

| Field | Type | Description |
|-------|------|-------------|
| `kpiId` | INT PK | Auto-increment |
| `kpiName` | VARCHAR | Descriptive name |
| `companyId` | INT FK | Owning company |
| `unitId` | INT FK | Measurement unit (Monthly, Quarterly, etc.) |
| `fromDate` / `toDate` | DATE | Effective date range |
| `targetAmount` | DECIMAL | The numeric target |
| `result` | DECIMAL | Actual achieved result |
| `quantRatio` | INT | Quantitative/qualitative ratio (percentage) |
| `priority` | ENUM | High / Medium / Low |
| `amountType` | INT | Whether amount is a count, percentage, currency, etc. |
| `code` | VARCHAR | Optional alphanumeric KPI code |
| `month` / `year` | VARCHAR | Cycle period |
| `status` | INT | See Status Reference §13 |
| `createrId` | INT FK | User who created |
| `createDateTime` / `updateDateTime` | DATETIME | Timestamps |

**History tracking:**  
Every time a KPI is created or updated, a corresponding `kpi_history` record is inserted. This allows:
- Full audit trail of target changes.
- Reporting on who changed what and when.

**KPI Lifecycle States:**
- `status=1` → Active
- `status=2` → Draft/In Progress
- `status=4` → Under Review / Waiting Approval
- `status=88` → Team Leader proposed change, pending supervisor approval
- `status=99` → Soft-deleted

**Creating a KPI (ManagementController::actionCreateKpi)**

Flow:
1. POST form with `kpiName`, `companyId`, `unitId`, `amount`, `month`, `year`, `fromDate`, `toDate`, `branch[]`, `department[]`, `team[]`, `priority`, `status`, `result`.
2. `targetAmount` is stored after stripping commas: `str_replace(",", "", $_POST["amount"])`.
3. A `kpi_history` record is immediately created mirroring the KPI data.
4. `saveKpiBranch()` upserts the branch mapping (soft-deletes removed branches, adds new ones).
5. `saveKpiDepartment()` — same logic for departments.
6. `saveKpiTeam()` — same + creates a `kpi_team_history` record with null target/result initially.
7. Redirect to `kpi/assign/assign` for employee assignment.

**Updating a KPI:**
- Only managers (`isManager() == 1`) can change `targetAmount`.
- Non-managers may update other metadata fields.
- Every update appends a new history record (not updating the old one).

**Auto-result from team:**  
`actionAutoResult()` in `KpiTeamController` sums all `kpi_employee.result` values for members of the given team on the specified month/year and returns the aggregate — allowing the team result to be populated automatically.

**Deleting a KPI:**  
Soft-delete: sets `status=99` on `kpi`, `kpi_team`, `kpi_department`, `kpi_branch`, and `kpi_history`.

**Issue Tracking on KPIs:**
- Users can raise issues via `kpi_issue` (title + description + optional file upload).
- File is saved to `file/kpi/` with a random 10-char filename + original extension.
- Other users can reply with solutions via `kpi_solution`.
- The comment thread is rendered via `actionShowComment()` / AJAX rendering of `kpi_issue` and `kpi_history2` partials.

**Search & Filter:**
- Session-based filter persistence (`Yii::$app->session->get('kpi')`).
- Filtered search encodes params via AES-256-CBC → base64 → rawurlencode (see `ModelMaster::encodeParams()`).
- Filter criteria: `companyId`, `branchId`, `teamId`, `month`, `status`, `year`, `type` (list|grid).

---

### 5.2 KGI Management

**KGI** (Key Goal Indicator) follows the same structural pattern as KPI but with different business semantics — KGIs represent **goal-level** achievements vs KPI's operational metrics.

**Key differences from KPI:**
- KGI→KPI linkage: `kgi_has_kpi` table maps KGIs to supporting KPIs.
- `KgiEmployeeHistory` tracks individual history separately from team history.
- `KgiEmployeeWeight` carries the per-employee weighting configuration for evaluation.
- KGI team management mirrors KPI team with `kgi_team`, `kgi_team_history`, `kgi_team_weight`.

**Fields:** Identical schema to KPI (`kgiId`, `kgiName`, `companyId`, `unitId`, `targetAmount`, `result`, `quantRatio`, `priority`, `amountType`, `code`, `month`, `year`, `status`).

**KGI→KPI Relationship:**
```
KGI 1 ──(kgi_has_kpi)──► KPI A
KGI 1 ──(kgi_has_kpi)──► KPI B
```
A KGI is the higher-level goal; multiple KPIs can roll up into it.

---

### 5.3 KFI Management

**KFI** (Key Function Indicator) represents **functional / behavioural** metrics — how employees demonstrate required competencies and work behaviours.

**Key differences from KPI/KGI:**
- KFI operates at `branch` and `department` level; there is **no team dimension**.
- `kfi_has_kgi` maps KFIs to KGIs (KFI→KGI→KPI hierarchy).
- `KfiWeight` carries per-employee evaluation scores (firstScore, finalScore, result).
- Scoring uses the three-party average (see §6.4).

**Fields:** `kfiId`, `kfiName`, `companyId`, `branchId`, `unitId`, `targetAmount`, `month`, `createrId`, `status`.

**KFI→KGI Relationship:**
```
KFI 1 ──(kfi_has_kgi)──► KGI A ──(kgi_has_kpi)──► KPI 1
```

The full indicator hierarchy is: **KFI → KGI → KPI**.

---

### 5.4 PIM — Evaluation System

PIM (Performance Integrated Metric) is the core evaluation framework that aggregates KFI, KGI, and KPI scores into a single employee performance score.

#### 5.4.1 Evaluation Environment

An **Environment** defines the evaluation context:
- `companyId` + `branchId` → which group of employees is being evaluated.
- `isAllEmployee` → whether all employees in the branch/company are included.

#### 5.4.2 Evaluation Frame

A **Frame** is a named evaluation program within an Environment:
- `frameName` — e.g., "Annual Review 2025"
- `startDate` / `endDate` — the full evaluation window
- `attributeId` — links to an `Attribute` that defines the number of `round`s (terms).
- `isMid` — whether a mid-term evaluation checkpoint exists.

When a Frame is created, the system auto-generates `round` number of **FrameTerms** (E1, E2, E3...) and for each term:
- Creates a `pim_weight` record (KFI/KGI/KPI weights default to 0).
- Creates `term_item` records for each active `term_step` (evaluation timeline steps).

#### 5.4.3 FrameTerm (Evaluation Period)

Each term represents one evaluation round:
- `termName` — e.g., "E1", "E2"
- `startDate` / `endDate` / `midDate`
- `isIncludeBonus` — whether this term's results feed into bonus calculation.
- `status=1` → active term; `status=2` → future/queued.

#### 5.4.4 Weight Allocation

**PIM-level weights** (`pim_weight` table, per term):
- `kfiWeight` — percentage allocated to KFI performance (e.g., 20%)
- `kgiWeight` — percentage allocated to KGI performance (e.g., 30%)
- `kpiWeight` — percentage allocated to KPI performance (e.g., 50%)
- **Must sum to 100%** (enforced by UI, not DB constraint in Alpha).

**Employee-level weights** (`employee_pim_weight` table, per employee per term):
- Each employee can have personalised KFI/KGI/KPI weights overriding the term-level default.
- Created lazily in `actionEmployeePim()`: if no record exists, a new one is created with 0/0/0.

**KFI weight allocation** (`kfi_weight` table):
- One record per KFI per employee per term.
- `weight` — percentage of the KFI score this item contributes to the employee's KFI total (all KFI weights should sum to 100%).

**KGI weight allocation** — two tracks:
- `kgi_weight` (team-level KGIs): weight shared by team.
- `kgi_employee_weight` (individual KGIs): individual specific KGIs.

**KPI weight allocation** — two tracks:
- `kpi_team_weight` (team KPIs).
- `kpi_weight` (individual KPIs via `kpi_employee` linkage).

#### 5.4.5 Evaluator Assignment

`employee_evaluator` table:
- `employeeId` — the employee being evaluated.
- `termId` — the evaluation term.
- `primaryId` — employee ID of the primary evaluator (e.g., direct supervisor).
- `finalId` — employee ID of the final evaluator (e.g., section head).

Only the assigned `primaryId` can fill `firstScore`; only `finalId` can fill `finalScore`.

#### 5.4.6 Evaluation Actions (EvaController)

**Save evaluator point (e.g., KFI):**
1. `actionSaveEvaluatorPoint()` updates `kfi_weight.firstScore` and `kfi_weight.finalScore`.
2. Immediately calculates the running average:  
   `$everage = ((int)$firstScore + (int)$finalScore + (int)$evaluateeScore) / 3`
3. Returns `point` = `number_format($everage, 1)` to the frontend.

**Save evaluatee self-assessment:**
1. `actionSaveKfiEvaluateePoint()` updates `kfi_weight.result` (self-score), `midComment`, `primaryComment`.
2. Same 3-way average calculated and returned.

This same pattern (evaluator point + evaluatee point) repeats identically for:
- KGI Employee (`kgi_employee_weight`)
- KGI Team (`kgi_weight`)
- KPI Employee (`kpi_weight`)
- KPI Team (`kpi_team_weight`)

---

### 5.5 Salary Management

#### 5.5.1 Salary Structure Setup

A **Salary** record ties together:
- `companyId`, `departmentId`, `titleId`, `currencyId`.

A **SalaryStructure** record represents one component of the salary package:
- `salaryId` + `structureId` (references `structure` table) + `defaultValue`.

The `structure` table holds allowance types (e.g., "Base Salary", "Transport Allowance", "Housing Allowance"). `type=1` is always "Base Salary"; `type=2` is a custom allowance.

#### 5.5.2 Employee Salary Registration

`employee_salary`:
- `employeeId`, `structureId`, `value` — the actual salary per component for this individual.

`employee_salary_history`:
- Full round-by-round salary change history with `round` increment on each update.

#### 5.5.3 Quartile Analysis

The `actionRegister()` / `actionFilterSalaryRegisterResult()` endpoints compute quartile data for a given `departmentId` + `titleId` combination. This allows HR to see where each employee's base salary falls relative to Q1/Q2/Q3/Q4 within the peer group.

---

### 5.6 Bonus Management

The `BonusController` handles bonus cycles.

A `BonusTerm` defines a bonus payment period. A `BonusRecord` stores the computed bonus for an employee within that term — driven by PIM evaluation scores from `FrameTerm.isIncludeBonus` flagged terms.

---

## 6. Calculation Logic (Deep Spec)

### 6.1 KPI Percentage

When displaying a KPI's achievement percentage:

```
percentage = (result / targetAmount) × 100
```

- If `targetAmount = 0`, percentage is treated as 0 to avoid division by zero (handled in view layer).
- `quantRatio` (stored as integer, e.g., 80) represents the quantitative weight of this KPI. The remaining `(100 - quantRatio)` is qualitative — scored separately by evaluators.

**Chart data (last 8 months):**  
`actionKpiChart()` builds a chronological month array from KPI team history, slices to the last 8 entries, and returns JSON arrays:
```json
{
  "month": ["Jan25","Feb25",...],
  "target": [100, 120, ...],
  "result": [95, 115, ...]
}
```
The frontend renders these as a line/bar chart.

---

### 6.2 KGI / KFI Score

Both KGI and KFI follow identical logic:

```
achievementScore = (result / targetAmount) × 100
```

However, in the evaluation context, the score is qualitative (1–10 or 0–100 points given by evaluators), not derived purely from the result/target ratio. The `targetAmount` on KGI/KFI is informational; the evaluation score is the primary driver.

---

### 6.3 PIM Weight Allocation & Final Score

**Step 1: Determine PIM weights for the employee/term**

```
kfiWeight  = employee_pim_weight.kfiWeight   (or pim_weight.kfiWeight if no override)
kgiWeight  = employee_pim_weight.kgiWeight
kpiWeight  = employee_pim_weight.kpiWeight
// Must total 100
```

**Step 2: Calculate KFI aggregate score for employee**

```
kfi_aggregate = Σ ( kfi_weight.weight × kfi_item_score ) / 100
```
where `kfi_item_score` = the three-party average for each KFI item.

**Step 3: Calculate KGI aggregate score**

Two tracks:
```
kgi_team_aggregate = Σ ( kgi_weight.weight × kgi_team_3party_avg ) / 100
kgi_emp_aggregate  = Σ ( kgi_empl_weight.weight × kgi_emp_3party_avg ) / 100
kgi_aggregate = (kgi_team_aggregate + kgi_emp_aggregate)  // split defined per config
```

**Step 4: Calculate KPI aggregate score**

```
kpi_team_aggregate = Σ ( kpi_team_weight.weight × kpi_team_3party_avg ) / 100
kpi_emp_aggregate  = Σ ( kpi_weight.weight × kpi_emp_3party_avg ) / 100
kpi_aggregate = (kpi_team_aggregate + kpi_emp_aggregate)
```

**Step 5: Final PIM Score**

```
pim_score = ( kfi_aggregate × kfiWeight/100 )
           + ( kgi_aggregate × kgiWeight/100 )
           + ( kpi_aggregate × kpiWeight/100 )
```

---

### 6.4 Three-Party Evaluation Average

This is used for every **individual indicator** (KFI item, KGI employee item, KPI employee item):

```
three_party_avg = ( firstScore + finalScore + evaluateeScore ) / 3
```

Where:
- `firstScore` — assigned by the **Primary Evaluator** (direct supervisor).
- `finalScore` — assigned by the **Final Evaluator** (section head / senior manager).
- `evaluateeScore` (stored as `result`) — assigned by the **employee themselves** (self-assessment).

**Code reference (EvaController.php, line ~224):**
```php
$everage = ((int)$kfiWeight->firstScore + (int)$kfiWeight->finalScore + (int)$evaluateeScore) / 3;
$res["point"] = number_format($everage, 1);
```
Result is formatted to 1 decimal place.

---

### 6.5 Salary Quartile Logic

For a given `departmentId` + `titleId`:
1. Fetch all `employee_salary.value` (base salary, `structureId=1`) for all employees in that title.
2. Sort ascending.
3. Calculate:
   - **Q1** = 25th percentile
   - **Q2** = 50th percentile (median)
   - **Q3** = 75th percentile
   - **Q4** = max value (implemented in backend API)

This is used in the salary register UI to show where each employee ranks against peers.

---

## 7. Data Models (Entity Summary)

### Core HR Entities

| Table | Key Columns | Notes |
|-------|------------|-------|
| `group` | `groupId`, `groupName` | Top-level tenant |
| `company` | `companyId`, `companyName`, `groupId`, `countryId`, `picture` | Multi-company |
| `branch` | `branchId`, `branchName`, `companyId` | Office/location |
| `department` | `departmentId`, `deptName`, `branchId`, `companyId` | Org unit |
| `title` | `titleId`, `titleName`, `departmentId` | Job title |
| `team` | `teamId`, `teamName`, `companyId` | Work team |
| `employee` | `employeeId`, `employeeNumber`, `firstName`, `sureName`, `branchId`, `deptId`, `titleId`, `teamId`, `hireDate`, `picture`, `status` | |
| `user` | `userId`, `employeeId`, `username`, `password_hash` | Login account |
| `user_role` | `userRoleId`, `roleId`, `userId` | RBAC mapping |
| `role` | `roleId`, `roleName` | Role definition |

### KPI Entities

| Table | Key Columns |
|-------|------------|
| `kpi` | `kpiId`, `kpiName`, `companyId`, `unitId`, `targetAmount`, `result`, `quantRatio`, `amountType`, `priority`, `code`, `month`, `year`, `status`, `createrId` |
| `kpi_history` | `kpiHistoryId`, `kpiId`, `targetAmount`, `result`, `description`, `nextCheckDate`, `month`, `year`, `status` |
| `kpi_branch` | `kpiBranchId`, `kpiId`, `branchId`, `status` |
| `kpi_department` | `kpiDepartmentId`, `kpiId`, `departmentId`, `status` |
| `kpi_team` | `kpiTeamId`, `kpiId`, `teamId`, `target`, `result`, `remark`, `month`, `year`, `status` |
| `kpi_team_history` | `kpiTeamHistoryId`, `kpiTeamId`, `target`, `result`, `detail`, `month`, `year`, `status` |
| `kpi_employee` | `kpiEmployeeId`, `kpiId`, `employeeId`, `target`, `result`, `month`, `year`, `status` |
| `kpi_employee_history` | `kpiEmployeeHistoryId`, `kpiEmployeeId`, `target`, `result`, `nextCheckDate`, `status` |
| `kpi_issue` | `kpiIssueId`, `kpiId`, `employeeId`, `issue`, `description`, `file`, `status` |
| `kpi_solution` | `kpiSolutionId`, `kpiIssueId`, `employeeId`, `solution`, `parentId`, `file`, `status` |

### KGI Entities (mirrors KPI)

`kgi`, `kgi_history`, `kgi_branch`, `kgi_department`, `kgi_team`, `kgi_team_history`, `kgi_employee`, `kgi_employee_history`, `kgi_has_kpi`, `kgi_issue`, `kgi_solution`, `kgi_group`

### KFI Entities

`kfi`, `kfi_history`, `kfi_branch`, `kfi_department`, `kfi_employee`, `kfi_has_kgi`, `kfi_issue`, `kfi_solution`

### Evaluation Entities

| Table | Key Columns |
|-------|------------|
| `environment` | `environmentId`, `companyId`, `branchId`, `isAllEmployee`, `status` |
| `frame` | `frameId`, `frameName`, `environmentId`, `startDate`, `endDate`, `attributeId`, `isMid`, `status` |
| `frame_term` | `termId`, `termName`, `frameId`, `sort`, `startDate`, `endDate`, `midDate`, `isIncludeBonus`, `status` |
| `term_item` | `termItemId`, `termId`, `stepId`, `startDate`, `finishDate`, `status` |
| `term_step` | `stepId`, `stepName`, `sort`, `status` |
| `attribute` | `attributeId`, `attributeName`, `round` | Defines how many terms |
| `pim_weight` | `pimWeightId`, `termId`, `kfiWeight`, `kgiWeight`, `kpiWeight`, `status` |
| `employee_pim_weight` | `employeePimWeightId`, `employeeId`, `termId`, `kfiWeight`, `kgiWeight`, `kpiWeight`, `status` |
| `employee_evaluation` | `evalId`, `employeeId`, `pimWeightId`, `status` | Marks employee as included in this term |
| `employee_evaluator` | `evalutorId`, `employeeId`, `termId`, `primaryId`, `finalId` |
| `kfi_weight` | `kfiWeightId`, `employeeId`, `kfiId`, `termId`, `weight`, `firstScore`, `finalScore`, `result`, `firstComment`, `finalComment`, `midComment`, `primaryComment` |
| `kgi_weight` | (team KGI evaluation) same structure as kfi_weight |
| `kgi_employee_weight` | (individual KGI) same structure |
| `kpi_team_weight` | (team KPI evaluation) same structure |
| `kpi_weight` | (individual KPI) same structure |
| `master_kfi_evaluation`, `master_kgi_evaluation`, `master_kpi_evaluation` | Master references for evaluation config |
| `employee_kfi_evaluation`, `employee_kgi_evaluation`, `employee_kpi_evaluation` | Per-employee evaluation records |

### Salary Entities

| Table | Key Columns |
|-------|------------|
| `salary` | `salaryId`, `companyId`, `departmentId`, `titleId`, `currencyId`, `status` |
| `salary_structure` | `salaryStructureId`, `salaryId`, `structureId`, `defaultValue`, `status` |
| `structure` | `structureId`, `structureName`, `type` (1=base, 2=allowance) |
| `employee_salary` | `employeeSalaryId`, `employeeId`, `structureId`, `value`, `status` |
| `employee_salary_history` | same + `round` |
| `currency` | `currencyId`, `code`, `name` |
| `rank` | `rankId`, `rankName` | Employee rank |
| `bonus_term` | `bonusTermId`, `termName`, `status` |
| `bonus_record` | `bonusRecordId`, `bonusTermId`, `employeeId`, `amount`, `status` |

---

## 8. Tech Stack

| Layer | Technology | Details |
|-------|-----------|---------|
| **Language** | PHP 7.4+ | Minimum requirement in `composer.json` |
| **Framework** | Yii 2 Advanced (2.0.45+) | 3-tier: frontend / backend / console |
| **UI Framework** | Yii2 Bootstrap 5 | `yiisoft/yii2-bootstrap5 ~2.0.2` |
| **Icons** | Font Awesome | `rmrevin/yii2-fontawesome dev-master` |
| **Mailer** | Symfony Mailer | `yiisoft/yii2-symfonymailer ~2.0.3` |
| **Database** | MySQL (via Yii2 Active Record) | Confirmed by `demo_hrvc.sql` (13MB) |
| **ORM** | Yii2 ActiveRecord | Master/child model pattern |
| **Encryption** | AES-256-CBC via PHP `openssl_encrypt` | URL param encoding |
| **Session** | Yii2 native session | Filter state persistence |
| **API Layer** | Internal curl-via-PHP (`Api::connectApi`) | Frontend → Backend API calls |
| **Dev env** | Docker / Vagrant | Both `docker-compose.yml` and `Vagrantfile` present |
| **Testing** | Codeception 5.x | `codeception.yml` in each tier |

---

## 9. Architecture & Request Flow

HRVC Alpha uses the Yii2 **Advanced** project template, which separates the application into three tiers:

```
┌─────────────────────────────────────────────────────────┐
│                         Browser                         │
└───────────────────────────┬─────────────────────────────┘
                            │ HTTP
                            ▼
┌─────────────────────────────────────────────────────────┐
│              FRONTEND (Port 80 / frontend/)             │
│  Controllers → Models → Views                           │
│  Uses Api::connectApi() for data from backend           │
└───────────────────────────┬─────────────────────────────┘
                            │ internal HTTP (curl)
                            ▼
┌─────────────────────────────────────────────────────────┐
│              BACKEND (Port 8080 / backend/)             │
│  API Controllers → ActiveRecord → MySQL                 │
└───────────────────────────┬─────────────────────────────┘
                            │
                            ▼
                     ┌────────────┐
                     │   MySQL    │
                     └────────────┘
```

**Frontend** handles all UI rendering (PHP views + Bootstrap 5).  
**Backend** exposes internal REST-like APIs (no public exposure intended in Alpha).  
`Api::connectApi($url)` in `frontend/components/Api.php` makes the internal HTTP call using `Path::Api()` as the base URL.

---

## 10. URL Routing Map

All URLs are routed via `frontend_router.php` using Yii2's default rule `module/controller/action`.

### KPI Module (`/kpi/`)

| Route | Controller / Action | Description |
|-------|-------------------|-------------|
| `kpi/management/index` | `ManagementController::actionIndex` | KPI list view |
| `kpi/management/grid` | `ManagementController::actionGrid` | KPI grid view |
| `kpi/management/create-kpi` | `ManagementController::actionCreateKpi` | Create KPI form/POST |
| `kpi/management/prepare-update/{hash}` | `ManagementController::actionPrepareUpdate` | Load update form |
| `kpi/management/update-kpi` | `ManagementController::actionUpdateKpi` | Save update |
| `kpi/management/delete-kpi` | `ManagementController::actionDeleteKpi` | Soft delete (AJAX) |
| `kpi/management/history` | `ManagementController::actionHistory` | KPI history popup (AJAX) |
| `kpi/management/show-comment` | `ManagementController::actionShowComment` | Issue thread (AJAX) |
| `kpi/management/create-new-issue` | `ManagementController::actionCreateNewIssue` | Post issue |
| `kpi/management/save-kpi-answer` | `ManagementController::actionSaveKpiAnswer` | Reply to issue |
| `kpi/management/modal-history` | `ManagementController::actionModalHistory` | History popup |
| `kpi/management/search-kpi` | `ManagementController::actionSearchKpi` | Filter POST |
| `kpi/management/kpi-search-result/{hash}` | `ManagementController::actionKpiSearchResult` | Filtered results |
| `kpi/kpi-team/team-kpi` | `KpiTeamController::actionTeamKpi` | Team KPI list |
| `kpi/kpi-team/team-kpi-grid` | `KpiTeamController::actionTeamKpiGrid` | Team KPI grid |
| `kpi/kpi-team/kpi-team-history/{hash}` | `KpiTeamController::actionKpiTeamHistory` | Team detail/history |
| `kpi/kpi-team/kpi-team-setting/{hash}` | `KpiTeamController::actionKpiTeamSetting` | Set team targets |
| `kpi/kpi-team/set-team-target` | `KpiTeamController::actionSetTeamTarget` | Save team targets |
| `kpi/kpi-team/auto-result` | `KpiTeamController::actionAutoResult` | Auto-sum employee results |
| `kpi/kpi-team/kpi-chart` | `KpiTeamController::actionKpiChart` | Chart data (AJAX) |
| `kpi/assign/assign/{hash}` | `AssignController::actionAssign` | Employee assignment |
| `kpi/kpi-personal/...` | `KpiPersonalController` | Individual KPI tracking |

> Note: `{hash}` in all URLs is an AES-256-CBC encrypted, base64-encoded, URL-encoded JSON parameter string. Use `ModelMaster::decodeParams($hash)` to decrypt.

### Evaluation Module (`/evaluation/`)

| Route | Controller / Action | Description |
|-------|-------------------|-------------|
| `evaluation/environment/index` | `EnvironmentController::actionIndex` | Env list |
| `evaluation/environment/frame-setting/{hash}` | `::actionFrameSetting` | Frame term config |
| `evaluation/environment/evaluator-setting/{hash}` | `::actionEvaluatorSetting` | Assign evaluators |
| `evaluation/environment/weight-allocate/{hash}` | `::actionWeightAllocate` | PIM weights overview |
| `evaluation/environment/weight-allocate-setting/{hash}` | `::actionWeightAllocateSetting` | Per-employee weights |
| `evaluation/environment/kfi-weight-allocate/{hash}` | `::actionKfiWeightAllocate` | KFI weight config |
| `evaluation/environment/kgi-weight-allocate/{hash}` | `::actionKgiWeightAllocate` | KGI weight config |
| `evaluation/eva/evaluate/{hash}` | `EvaController::actionEvaluate` | Evaluation form |
| `evaluation/eva/save-evaluator-point` | `::actionSaveEvaluatorPoint` | Save KFI evaluator scores |
| `evaluation/eva/save-kfi-evaluatee-point` | `::actionSaveKfiEvaluateePoint` | Save KFI self-score |
| `evaluation/salary/index` | `SalaryController::actionIndex` | Salary overview |
| `evaluation/salary/create-salary` | `::actionCreateSalary` | Create salary config |
| `evaluation/salary/register/{hash}` | `::actionRegister` | Employee salary registration |

---

## 11. Security Patterns

### URL Parameter Encryption

All paginated and detail routes pass parameters via an encrypted hash:

```php
// Encoding (controller → redirect)
$hash = ModelMaster::encodeParams([
    "kpiId" => $kpiId,
    "companyId" => $companyId
]);
redirect("kpi/management/prepare-update/" . $hash);

// Decoding (at destination controller)
$param = ModelMaster::decodeParams($hash);
$kpiId = $param['kpiId'];
```

**Encryption:** AES-256-CBC with `Yii::$app->params['secureKey']`. IV = first 16 bytes of key.  
**Encoding:** base64 → URL-safe replace (`+` → `-`, `/` → `_`) → `rawurlencode`.

### Authentication Check

Every controller's `beforeAction()` checks:
```php
if (Yii::$app->user->id == '') {
    Yii::$app->response->redirect(Yii::$app->homeUrl . 'site/login');
    return false;
}
```

### File Upload Security

KPI issue file uploads:
- Random 10-character filename generated via `Yii::$app->security->generateRandomString(10)`.
- Extension preserved from original filename.
- Files stored under `file/kpi/` directory.

### Soft Delete Pattern

No hard deletes in the system. Records are marked `status=99`. All queries filter on `status != 99` or explicitly include valid status arrays `[1, 2, 4]`.

---

## 12. Developer Setup & Environment

### Prerequisites
- PHP 7.4 or higher with extensions: `openssl`, `pdo_mysql`, `curl`, `gd`, `fileinfo`.
- Composer (global).
- MySQL 5.7+ or MariaDB 10.4+.
- Web server: Apache or Nginx with `mod_rewrite` / `try_files`.

### Setup Steps

```bash
# 1. Clone the repo
git clone <repo-url> hrvc-alpha
cd hrvc-alpha

# 2. Install PHP dependencies
composer install

# 3. Initialize environments
php init --env=Development --overwrite=All

# 4. Configure database
# Edit common/config/main-local.php:
# Set db.dsn, db.username, db.password

# 5. Import starter database
mysql -u root -p hrvc_db < demo_hrvc.sql

# 6. (Windows) Run init.bat as alternative to step 3
init.bat

# 7. Start via Docker (optional)
docker-compose up -d

# 8. Or use Vagrant
vagrant up
```

### Directory Structure

```
hrvc-alpha/
├── frontend/           ← User-facing web application
│   ├── controllers/    ← Base controllers (Site, etc.)
│   ├── models/hrvc/    ← Business models (KPI, KGI, Employee...)
│   ├── modules/        ← Feature modules
│   │   ├── kpi/        ← KPI module
│   │   ├── kgi/        ← KGI module
│   │   ├── kfi/        ← KFI module
│   │   ├── evaluation/ ← PIM evaluation engine
│   │   ├── setting/    ← Group/company/employee config
│   │   └── ...
│   ├── views/          ← PHP view templates
│   └── web/            ← Public webroot (index.php, CSS, JS, images)
│       └── css/        ← site.css, pim.css, etc.
├── backend/            ← Internal API server
│   ├── controllers/    ← API controllers
│   └── modules/        ← API modules (kpi, kgi, evaluation, masterdata...)
├── common/
│   ├── models/         ← Shared models (User, ModelMaster...)
│   ├── helpers/        ← Path, Session helpers
│   └── carlendar/      ← Calendar utility
├── console/            ← CLI commands / migrations
├── environments/       ← dev/prod environment configs
├── vendor/             ← Composer packages
└── demo_hrvc.sql       ← Database dump with sample data
```

### Key Configuration Files

| File | Purpose |
|------|---------|
| `common/config/main.php` | Shared config (db component, params) |
| `common/config/main-local.php` | Local DB credentials (gitignored) |
| `frontend/config/main.php` | Frontend URL rules, modules registration |
| `backend/config/main.php` | Backend API config |
| `common/config/params.php` | `secureKey`, `secureVi`, `apiUrl` |

### Register Modules (frontend/config/main.php)

Modules must be declared to be routable:
```php
'modules' => [
    'kpi'        => ['class' => 'frontend\modules\kpi\Kpi'],
    'kgi'        => ['class' => 'frontend\modules\kgi\Kgi'],
    'kfi'        => ['class' => 'frontend\modules\kfi\Kfi'],
    'evaluation' => ['class' => 'frontend\modules\evaluation\Evaluation'],
    'setting'    => ['class' => 'frontend\modules\setting\Setting'],
    ...
],
```

---

## 13. Status Codes Reference

Used consistently across all tables (`kpi`, `kgi`, `kfi`, `kpi_team`, `employee`, etc.):

| Status Code | Meaning |
|-------------|---------|
| `1` | **Active / Approved** |
| `2` | **Draft / Inactive (created but not yet active)** |
| `4` | **Under Review** |
| `88` | **Pending Approval** (Team Leader submitted, awaiting manager confirm) |
| `99` | **Soft-deleted** |
| `100` | **Employee Draft** (employee record not yet fully confirmed) |

---

## 14. Open Issues & Future Work

| # | Issue / Feature | Priority |
|---|----------------|----------|
| 1 | `UserRole::isManager()` checks `roleId IN (1,2,3)` but the company description maps roleId 1=Admin, 2=GM, 3=Manager — this matches but should be documented explicitly in code. | Low |
| 2 | Hard-coded `$year = 2024` in `KpiTeamController::actionKpiChart()` (line ~392) when `$kpiTeamHistoryId == 0`. Should default to `date('Y')`. | Medium |
| 3 | `KpiTeam::checkPermission()` has a bug: `$kpiId = $kpiTeam["kpiTeamId"]` (should be `$kpiTeam["kpiId"]`). | High |
| 4 | No CSRF validation on many AJAX POST endpoints (e.g., `actionDeleteKpi`, `actionSaveKpiAnswer`). Should be enabled via `$this->enableCsrfValidation` or Yii2 CSRF tokens in AJAX headers. | High |
| 5 | `pim_weight` KFI+KGI+KPI weight total is enforced only in UI — no DB-level constraint or server-side validation to ensure they sum to 100. | Medium |
| 6 | Salary quartile calculation is done in the backend API — the exact percentile formula should be documented and unit-tested. | Medium |
| 7 | `demo_hrvc.sql` (13MB) contains actual data. Should be replaced with anonymized fixture data before sharing with new developers. | High |
| 8 | Multi-language support (`language` module present) but implementation completeness is unknown. | Low |
| 9 | File upload max size and allowed MIME types not validated server-side for KPI issue attachments. | Medium |
| 10 | Role 6 (HR, privilege=2) and Role 7 (Staff, privilege=1) are both mapped to `$staffId` when privilege ≤ 2 — HR users see the same data scope as staff, which may not be intended. | Medium |

---

*Document prepared from source code analysis of HRVC Alpha — April 2026.*  
*For questions, contact the lead developer or refer to the codebase in `c:\Code Projects\HRVC Alpha`.*
