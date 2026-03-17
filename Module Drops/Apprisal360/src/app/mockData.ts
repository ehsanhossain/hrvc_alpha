import { Employee, Team, IndividualPIMItem, Company } from "./types";

export const MOCK_COMPANIES: Company[] = [
  { id: 'c1', name: 'Nexus Holdings', employeeCount: 450, logo: 'https://images.unsplash.com/photo-1560179707-f14e90ef3623?w=100&h=100&fit=crop' },
  { id: 'c2', name: 'Quantum Solutions', employeeCount: 120, logo: 'https://images.unsplash.com/photo-1542744094-24638eff58bb?w=100&h=100&fit=crop' },
  { id: 'c3', name: 'Apex Global', employeeCount: 890, logo: 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=100&h=100&fit=crop' },
  { id: 'c4', name: 'Stellar Tech', employeeCount: 35, logo: 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=100&h=100&fit=crop' },
  { id: 'c5', name: 'Horizon Industries', employeeCount: 1200, logo: 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?w=100&h=100&fit=crop' },
  { id: 'c6', name: 'Lumina Group', employeeCount: 75, logo: 'https://images.unsplash.com/photo-1554469384-e58fac16e23a?w=100&h=100&fit=crop' },
  { id: 'c7', name: 'Vortex Systems', employeeCount: 230, logo: 'https://images.unsplash.com/photo-1577412647305-991150c7d163?w=100&h=100&fit=crop' },
  { id: 'c8', name: 'Elysium Corp', employeeCount: 560, logo: 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=100&h=100&fit=crop' },
  { id: 'c9', name: 'Pinnacle Partners', employeeCount: 45, logo: 'https://images.unsplash.com/photo-1556761175-b413da4baf72?w=100&h=100&fit=crop' },
  { id: 'c10', name: 'Zephyr Labs', employeeCount: 12, logo: 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=100&h=100&fit=crop' },
  { id: 'c11', name: 'Titan Energy', employeeCount: 3400, logo: 'https://images.unsplash.com/photo-1454165833767-027508496b4c?w=100&h=100&fit=crop' },
  { id: 'c12', name: 'Solaris Media', employeeCount: 88, logo: 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=100&h=100&fit=crop' },
  { id: 'c13', name: 'Aether Logistics', employeeCount: 150, logo: 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=100&h=100&fit=crop' },
  { id: 'c14', name: 'Nova Retail', employeeCount: 670, logo: 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=100&h=100&fit=crop' },
  { id: 'c15', name: 'Omni Bank', employeeCount: 8900, logo: 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=100&h=100&fit=crop' },
  { id: 'c16', name: 'Echo Communications', employeeCount: 420, logo: 'https://images.unsplash.com/photo-1552581234-26160f608093?w=100&h=100&fit=crop' },
  { id: 'c17', name: 'Prism Designs', employeeCount: 24, logo: 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=100&h=100&fit=crop' },
  { id: 'c18', name: 'Summit Ventures', employeeCount: 56, logo: 'https://images.unsplash.com/photo-1522071823991-b96c0d3e1b4b?w=100&h=100&fit=crop' },
  { id: 'c19', name: 'Delta Manufacturing', employeeCount: 1300, logo: 'https://images.unsplash.com/photo-1521791136064-7986c2959d9c?w=100&h=100&fit=crop' },
  { id: 'c20', name: 'Origin Biotech', employeeCount: 95, logo: 'https://images.unsplash.com/photo-1507537297325-5bcc7a985c34?w=100&h=100&fit=crop' },
  { id: 'c21', name: 'Clarion Finance', employeeCount: 310, logo: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=100&h=100&fit=crop' },
  { id: 'c22', name: 'Beacon Health', employeeCount: 450, logo: 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=100&h=100&fit=crop' },
  { id: 'c23', name: 'Atlas Construction', employeeCount: 1100, logo: 'https://images.unsplash.com/photo-1503387762-592dea58ef21?w=100&h=100&fit=crop' },
];

export const MOCK_EMPLOYEES: Employee[] = [
  // Enterprise Sales Team
  { id: '1', name: 'Alice Johnson', role: 'Sales Manager', team: 'Enterprise Sales', companyId: 'c1', status: 'Active', type: 'Perm', hasPIM: false, hasKPI: true, salary: 75000, permissionLevel: 'Staff' },
  { id: '2', name: 'Bob Smith', role: 'Senior Sales Rep', team: 'Enterprise Sales', companyId: 'c1', status: 'Active', type: 'Prob', hasPIM: true, hasKPI: true, probationEndDays: 45, salary: 60000, permissionLevel: 'Staff' },
  { id: '3', name: 'Carol Davis', role: 'Sales Rep', team: 'Enterprise Sales', companyId: 'c1', status: 'Active', type: 'Cont', hasPIM: true, hasKPI: true, contractEndDays: 180, resigningInDays: 30, salary: 50000, permissionLevel: 'Staff' },
  { id: 'e_tl1', name: 'Sarah Johnson', role: 'Team Lead', team: 'Enterprise Sales', companyId: 'c1', status: 'Active', type: 'Perm', hasPIM: true, hasKPI: true, salary: 85000, permissionLevel: 'Team Leader' },
  { id: 'e_tl2', name: 'David Lee', role: 'Team Lead', team: 'Enterprise Sales', companyId: 'c1', status: 'Active', type: 'Perm', hasPIM: true, hasKPI: true, salary: 85000, permissionLevel: 'Team Leader' },
  
  // SMB Sales Team
  { id: '4', name: 'David Wilson', role: 'Sales Rep', team: 'SMB Sales', companyId: 'c2', status: 'Active', type: 'Perm', hasPIM: false, hasKPI: false, salary: 45000, permissionLevel: 'Staff' },
  { id: '5', name: 'Eva Martinez', role: 'Account Manager', team: 'SMB Sales', companyId: 'c2', status: 'Active', type: 'Cont', hasPIM: true, hasKPI: true, salary: 55000, permissionLevel: 'Staff' },
  { id: 's_tl1', name: 'Frank Wright', role: 'Team Lead', team: 'SMB Sales', companyId: 'c2', status: 'Active', type: 'Perm', hasPIM: true, hasKPI: true, salary: 70000, permissionLevel: 'Team Leader' },
  
  // Management
  { id: 'm_mgr1', name: 'Michael Chen', role: 'Sales Director', team: 'Management', companyId: 'c1', status: 'Active', type: 'Perm', hasPIM: true, hasKPI: true, salary: 120000, permissionLevel: 'Manager' },
  { id: 'm_gm1', name: 'Steve Rogers', role: 'General Manager', team: 'Executive', companyId: 'c1', status: 'Active', type: 'Perm', hasPIM: true, hasKPI: true, salary: 200000, permissionLevel: 'General Manager' },
  { id: 'm_adm1', name: 'Tony Stark', role: 'System Admin', team: 'Executive', companyId: 'c1', status: 'Active', type: 'Perm', hasPIM: true, hasKPI: true, salary: 300000, permissionLevel: 'Admin' },
];

export const MOCK_TEAMS: Team[] = [
  { id: 't1', name: 'Enterprise Sales', members: MOCK_EMPLOYEES.slice(0, 3) },
  { id: 't2', name: 'SMB Sales', members: MOCK_EMPLOYEES.slice(3, 5) },
];

const createLevels = () => [
  { level: 1, valueType: 'percentage', value: 50, description: 'Below expectations' },
  { level: 2, valueType: 'percentage', value: 70, description: 'Needs improvement' },
  { level: 3, valueType: 'percentage', value: 85, description: 'Approaching target' },
  { level: 4, valueType: 'percentage', value: 100, description: 'Meets expectations' },
  { level: 5, valueType: 'percentage', value: 120, description: 'Exceeds expectations' },
  { level: 6, valueType: 'percentage', value: 150, description: 'Outstanding' },
] as any;

export const MOCK_KFI_ITEMS: IndividualPIMItem[] = [
  { id: 'kfi_1', name: 'Sales Target', type: 'KFI', category: 'Financial', isSelected: false, targetValue: 800000, targetUnit: 'amount', currency: 'THB', occurrence: 'quarterly', targetBehavior: 'average', weight: 0, levels: createLevels() },
  { id: 'kfi_2', name: 'Revenue Growth', type: 'KFI', category: 'Financial', isSelected: false, targetValue: 1200000, targetUnit: 'amount', currency: 'THB', occurrence: 'yearly', targetBehavior: 'average', weight: 0, levels: createLevels() },
  { id: 'kfi_3', name: 'Cost Reduction', type: 'KFI', category: 'Financial', isSelected: false, targetValue: 10, targetUnit: 'percentage', currency: 'THB', occurrence: 'quarterly', targetBehavior: 'average', weight: 0, levels: createLevels() },
];

export const MOCK_KGI_ITEMS: IndividualPIMItem[] = [
  { id: 'kgi_1', name: 'Market Share', type: 'KGI', category: 'Strategic', isSelected: false, targetValue: 25, targetUnit: 'percentage', currency: 'THB', occurrence: 'yearly', targetBehavior: 'average', weight: 0, levels: createLevels() },
  { id: 'kgi_2', name: 'Project Completion Rate', type: 'KGI', category: 'Operations', isSelected: false, targetValue: 90, targetUnit: 'percentage', currency: 'THB', occurrence: 'yearly', targetBehavior: 'average', weight: 0, levels: createLevels() },
];

export const MOCK_KPI_ITEMS: IndividualPIMItem[] = [
  { id: 'kpi_1', name: 'Customer Satisfaction Score', type: 'KPI', category: 'Customer', isSelected: false, targetValue: 90, targetUnit: 'percentage', currency: 'THB', occurrence: 'quarterly', targetBehavior: 'average', weight: 0, levels: createLevels() },
  { id: 'kpi_2', name: 'Response Time', type: 'KPI', category: 'Service', isSelected: false, targetValue: 2, targetUnit: 'amount', currency: 'Hours', occurrence: 'monthly', targetBehavior: 'average', weight: 0, levels: createLevels() },
];

export const MOCK_SALARY_SHEETS = [
  { id: 'ss1', name: 'Standard Payroll 2025', employeeCount: 150, currency: 'THB', baseSalary: 45000 },
  { id: 'ss2', name: 'Sales Commission Sheet', employeeCount: 45, currency: 'THB', baseSalary: 30000 },
];

export const INITIAL_RANKS = [
  { rank: 'A', label: 'Exceptional', minScore: 90, maxScore: 100, salaryMultiplier: 1.5, bonusMultiplier: 1.2 },
  { rank: 'B', label: 'Above Average', minScore: 75, maxScore: 89, salaryMultiplier: 1.2, bonusMultiplier: 1.0 },
  { rank: 'C', label: 'Meets Standards', minScore: 60, maxScore: 74, salaryMultiplier: 1.0, bonusMultiplier: 0.8 },
  { rank: 'D', label: 'Below Standards', minScore: 50, maxScore: 59, salaryMultiplier: 0.8, bonusMultiplier: 0.5 },
  { rank: 'E', label: 'Unsatisfactory', minScore: 0, maxScore: 49, salaryMultiplier: 0.5, bonusMultiplier: 0.0 },
];

export const MOCK_RANK_TEMPLATES = [
  { 
    id: 'rt1', 
    name: 'Standard 5-Level Performance', 
    isDefault: true,
    ranks: [
      { rank: 'A', label: 'Exceptional', minScore: 90, maxScore: 100, salaryMultiplier: 1.5, bonusMultiplier: 1.2 },
      { rank: 'B', label: 'Above Average', minScore: 75, maxScore: 89, salaryMultiplier: 1.2, bonusMultiplier: 1.0 },
      { rank: 'C', label: 'Meets Standards', minScore: 60, maxScore: 74, salaryMultiplier: 1.0, bonusMultiplier: 0.8 },
      { rank: 'D', label: 'Below Standards', minScore: 50, maxScore: 59, salaryMultiplier: 0.8, bonusMultiplier: 0.5 },
      { rank: 'E', label: 'Unsatisfactory', minScore: 0, maxScore: 49, salaryMultiplier: 0.5, bonusMultiplier: 0.0 },
    ],
    enableBonus: true,
    baseBonusAmount: 5000,
    usage: 12,
    createdDate: '2025-11-15'
  },
  { 
    id: 'rt2', 
    name: 'Sales Team Incentive Model', 
    isDefault: false,
    ranks: [
      { rank: 'A+', label: 'Top Performer', minScore: 95, maxScore: 100, salaryMultiplier: 1.8, bonusMultiplier: 1.5 },
      { rank: 'A', label: 'Excellent', minScore: 85, maxScore: 94, salaryMultiplier: 1.4, bonusMultiplier: 1.2 },
      { rank: 'B', label: 'Good', minScore: 70, maxScore: 84, salaryMultiplier: 1.1, bonusMultiplier: 0.9 },
      { rank: 'C', label: 'Adequate', minScore: 55, maxScore: 69, salaryMultiplier: 0.9, bonusMultiplier: 0.6 },
      { rank: 'D', label: 'Needs Improvement', minScore: 0, maxScore: 54, salaryMultiplier: 0.7, bonusMultiplier: 0.3 },
    ],
    enableBonus: true,
    baseBonusAmount: 8000,
    usage: 5,
    createdDate: '2026-01-10'
  },
  { 
    id: 'rt3', 
    name: 'Conservative 3-Tier', 
    isDefault: false,
    ranks: [
      { rank: 'High', label: 'Exceeds Expectations', minScore: 80, maxScore: 100, salaryMultiplier: 1.3, bonusMultiplier: 1.1 },
      { rank: 'Mid', label: 'Meets Expectations', minScore: 60, maxScore: 79, salaryMultiplier: 1.0, bonusMultiplier: 0.8 },
      { rank: 'Low', label: 'Below Expectations', minScore: 0, maxScore: 59, salaryMultiplier: 0.8, bonusMultiplier: 0.5 },
    ],
    enableBonus: false,
    baseBonusAmount: 0,
    usage: 3,
    createdDate: '2025-12-20'
  },
];

export const MOCK_WEIGHT_TEMPLATES = [
  { 
    id: 'wt1', 
    name: 'Default Configuration', 
    isDefault: true, 
    pimWeight: 70, 
    competencyWeight: 20, 
    bufferWeight: 10,
    kfiWeight: 40,
    kgiWeight: 40,
    kpiWeight: 20,
    usage: 0
  }
];