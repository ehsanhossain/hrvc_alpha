import { LucideIcon } from "lucide-react";

export interface Company {
  id: string;
  name: string;
  logo?: string;
  employeeCount: number;
}

export type EntityType = 'Company' | 'Branch' | 'Department' | 'Team';

export type PermissionLevel = 'Staff' | 'Team Leader' | 'Manager' | 'General Manager' | 'Admin';

export interface Employee {
  id: string;
  name: string;
  role: string;
  team: string;
  companyId: string;
  status: 'Active' | 'On Leave' | 'Resigning';
  type: 'Perm' | 'Prob' | 'Cont';
  hasPIM: boolean;
  hasKPI: boolean;
  probationEndDays?: number;
  contractEndDays?: number;
  resigningInDays?: number;
  salary: number;
  permissionLevel: PermissionLevel;
}

export interface Team {
  id: string;
  name: string;
  members: Employee[];
}

export interface TimelineEvent {
  id: string;
  name: string;
  startDate: string;
  endDate: string;
}

export interface IndividualLevel {
  level: number;
  valueType: 'percentage' | 'amount' | 'percentage_of_amount';
  value: number;
  description: string;
}

export interface IndividualPIMItem {
  id: string;
  name: string;
  type: 'KFI' | 'KGI' | 'KPI';
  category: string;
  isSelected: boolean;
  targetValue: number;
  targetUnit: 'amount' | 'percentage';
  currency: string;
  occurrence: 'yearly' | 'half-yearly' | 'quarterly' | 'monthly';
  targetBehavior: 'average' | 'last-month' | 'range' | 'specific-month';
  weight: number;
  levels: IndividualLevel[];
}

export interface CompetencyConfig {
  id: string;
  name: string;
  weight: number;
  levels: { level: number; value: number }[];
}

export interface RankConfig {
  rank: string;
  label: string;
  minScore: number;
  maxScore: number;
  salaryMultiplier: number;
  bonusMultiplier: number;
}

export interface RankTemplate {
  id: string;
  name: string;
  isDefault: boolean;
  ranks: RankConfig[];
  enableBonus: boolean;
  baseBonusAmount: number;
  usage: number;
  createdDate: string;
}

export interface SalaryIncrementRule {
  id: string;
  minScore: number;
  maxScore: number;
  type: 'Percentage' | 'Amount';
  value: number;
}

export interface WeightTemplate {
  id: string;
  name: string;
  isDefault: boolean;
  pimWeight: number;
  competencyWeight: number;
  bufferWeight: number;
  kfiWeight: number;
  kgiWeight: number;
  kpiWeight: number;
  usage: number;
}

export interface EvaluationState {
  step: number;
  basicInfo: {
    name: string;
    description: string;
    entity: EntityType;
    selectedCompanyIds: string[];
    selectedEmployeeIds: string[];
  };
  timeFrame: {
    startDate: string;
    endDate: string;
    interval: 'Annual' | 'Half-yearly' | 'Triannual' | 'Quarterly';
    periods: { id: string; name: string; startDate: string; endDate: string }[];
    midTermReview: boolean;
    bonusInclusion: boolean;
    bonusMonth: string;
  };
  timelineEvents: TimelineEvent[];
  evaluationMethod: {
    weightTemplates: WeightTemplate[];
    selectedTemplateId: string;
    pimWeight: number;
    competencyWeight: number;
    bufferWeight: number;
    kfiWeight: number; // % of PIM
    kgiWeight: number; // % of PIM
    kpiWeight: number; // % of PIM
    pimItems: IndividualPIMItem[];
    competencies: CompetencyConfig[];
    successCriteria: {
      uniformThreshold: number;
      description: string;
    };
  };
  salaryBonus: {
    incrementRules: SalaryIncrementRule[];
  };
  rankIncrement: {
    rankTemplates: RankTemplate[];
    selectedTemplateId: string;
    salarySheetId: string;
    ranks: RankConfig[];
    enableBonus: boolean;
    baseBonusAmount: number;
  };
  evaluators: {
    assignments: { [employeeId: string]: { first: string; second: string } };
  };
}