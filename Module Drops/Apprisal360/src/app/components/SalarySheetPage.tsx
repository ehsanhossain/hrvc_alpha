import React, { useState } from "react";
import { 
  FileText, 
  ChevronRight, 
  Search, 
  MoreHorizontal, 
  Edit3, 
  Trash2, 
  Plus, 
  ArrowLeft,
  Building2,
  Download,
  Filter,
  Info,
  Upload,
  Settings2,
  TrendingUp
} from "lucide-react";
import { motion, AnimatePresence } from "motion/react";
import { MOCK_COMPANIES, MOCK_EMPLOYEES } from "@/app/mockData";
import { TopHeader } from "./TopHeader";
import { toast } from "sonner";
import { SalaryStructureModal, SalaryComponent } from "@/app/components/SalaryStructureModal";
import { ImportSalaryModal } from "@/app/components/ImportSalaryModal";
import { SalaryRangeModal, TitleConfig } from "@/app/components/SalaryRangeModal";

interface SalaryRow {
  employeeId: string;
  name: string;
  role: string;
  avatar?: string;
  values: Record<string, number>; // componentId -> amount
}

const INITIAL_COMPONENTS: SalaryComponent[] = [
  { id: 'basic', name: 'Basic Pay', shortName: 'BSC', type: 'Fixed', defaultValue: 45000 },
  { id: 'hra', name: 'House Rent', shortName: 'HRA', type: 'Fixed', defaultValue: 25000 },
  { id: 'tra', name: 'Transport', shortName: 'TRA', type: 'Fixed', defaultValue: 5000 },
  { id: 'med', name: 'Medical', shortName: 'MED', type: 'Fixed', defaultValue: 3000 },
  { id: 'ext', name: 'Extra', shortName: 'EXT', type: 'Fixed', defaultValue: 0 },
];

export function SalarySheetPage() {
  const [selectedCompanyId, setSelectedCompanyId] = useState<string | null>(null);
  const [searchQuery, setSearchQuery] = useState("");
  const [components, setComponents] = useState<SalaryComponent[]>(INITIAL_COMPONENTS);
  const [salaryData, setSalaryData] = useState<SalaryRow[]>([]);
  const [rangeConfigs, setRangeConfigs] = useState<TitleConfig[]>([]);
  
  const [isStructureModalOpen, setIsStructureModalOpen] = useState(false);
  const [isImportModalOpen, setIsImportModalOpen] = useState(false);
  const [isRangeModalOpen, setIsRangeModalOpen] = useState(false);

  const generateSalaryData = (companyId: string, currentComponents: SalaryComponent[]): SalaryRow[] => {
    return MOCK_EMPLOYEES
      .filter(emp => emp.companyId === companyId)
      .map(emp => {
        const values: Record<string, number> = {};
        currentComponents.forEach(c => {
          values[c.id] = c.defaultValue + (Math.floor(Math.random() * 5000) - 2500);
        });
        return {
          employeeId: emp.id,
          name: emp.name,
          role: emp.role,
          values
        };
      });
  };

  const handleSelectCompany = (companyId: string) => {
    setSelectedCompanyId(companyId);
    setSalaryData(generateSalaryData(companyId, components));
  };

  const handleUpdateValue = (empId: string, componentId: string, value: number) => {
    setSalaryData(prev => prev.map(row => 
      row.employeeId === empId ? { ...row, values: { ...row.values, [componentId]: value } } : row
    ));
  };

  const calculateTotal = (row: SalaryRow) => {
    return Object.values(row.values).reduce((acc, val) => acc + val, 0);
  };

  const handleSaveStructure = (newComponents: SalaryComponent[]) => {
    setComponents(newComponents);
    setSalaryData(prev => prev.map(row => {
      const newValues: Record<string, number> = {};
      newComponents.forEach(c => {
        newValues[c.id] = row.values[c.id] ?? c.defaultValue;
      });
      return { ...row, values: newValues };
    }));
    setIsStructureModalOpen(false);
    toast.success("Salary structure updated successfully");
  };

  const selectedCompany = MOCK_COMPANIES.find(c => c.id === selectedCompanyId);

  return (
    <div className="flex-1 flex flex-col h-screen overflow-hidden bg-white font-normal">
      <TopHeader />
      
      <main className="flex-1 flex flex-col overflow-hidden">
        {/* Breadcrumbs & Header */}
        <div className="px-6 py-4 border-b border-gray-50 flex items-center justify-between bg-white shrink-0">
          <div className="space-y-1">
            <div className="flex items-center gap-1.5 text-[10px] font-normal text-gray-400 uppercase tracking-widest">
              <span>Compensation</span>
              <ChevronRight className="w-2.5 h-2.5" />
              <span className={selectedCompanyId ? "text-gray-400" : "text-[#2580D3]"}>Salary Sheets</span>
              {selectedCompanyId && (
                <>
                  <ChevronRight className="w-2.5 h-2.5" />
                  <span className="text-[#2580D3]">{selectedCompany?.name}</span>
                </>
              )}
            </div>
            <h1 className="text-[20px] font-normal text-gray-900 tracking-tight">
              {selectedCompanyId ? `${selectedCompany?.name} Payroll` : "Select Company Salary Sheet"}
            </h1>
          </div>

          <div className="flex items-center gap-2">
            {selectedCompanyId && (
              <>
                <button 
                  onClick={() => setIsImportModalOpen(true)}
                  className="px-3 py-1.5 text-orange-600 font-normal text-[12px] flex items-center gap-2 bg-orange-50/50 border border-orange-100 rounded-[3px] hover:bg-orange-50 transition-all"
                >
                  <Upload className="w-3.5 h-3.5" />
                  Import
                </button>
                <button 
                  onClick={() => setIsRangeModalOpen(true)}
                  className="px-3 py-1.5 text-[#2580D3] font-normal text-[12px] flex items-center gap-2 bg-blue-50/50 border border-blue-100 rounded-[3px] hover:bg-blue-50 transition-all"
                >
                  <TrendingUp className="w-3.5 h-3.5" />
                  Salary Range
                </button>
                <button 
                  onClick={() => setIsStructureModalOpen(true)}
                  className="px-3 py-1.5 text-gray-600 font-normal text-[12px] flex items-center gap-2 bg-white border border-gray-100 rounded-[3px] hover:bg-gray-50 transition-all"
                >
                  <Settings2 className="w-3.5 h-3.5" />
                  Structure
                </button>
                <div className="h-4 w-px bg-gray-100 mx-1" />
                <button 
                  onClick={() => setSelectedCompanyId(null)}
                  className="px-3 py-1.5 text-gray-500 font-normal text-[12px] flex items-center gap-2 bg-white border border-gray-100 rounded-[3px] hover:bg-gray-50 transition-all"
                >
                  <ArrowLeft className="w-3.5 h-3.5" />
                  Back
                </button>
              </>
            )}
            {!selectedCompanyId && (
              <button className="p-2 text-gray-400 hover:text-gray-900 transition-colors">
                <Download className="w-4 h-4" />
              </button>
            )}
          </div>
        </div>

        <div className="flex-1 overflow-y-auto no-scrollbar bg-gray-50/30">
          <AnimatePresence mode="wait">
            {!selectedCompanyId ? (
              <motion.div 
                key="company-table-view"
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
                className="p-8"
              >
                <div className="bg-white border border-gray-100 rounded-[3px] overflow-hidden shadow-sm">
                  <table className="w-full text-left border-collapse">
                    <thead>
                      <tr className="bg-gray-50/80 border-b border-gray-100">
                        <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest">Company Name</th>
                        <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">Employees</th>
                        <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">Currency</th>
                        <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest">Status</th>
                        <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-right">Action</th>
                      </tr>
                    </thead>
                    <tbody className="divide-y divide-gray-50">
                      {MOCK_COMPANIES.map((company) => (
                        <tr 
                          key={company.id} 
                          className="hover:bg-blue-50/30 transition-all cursor-pointer group"
                          onClick={() => handleSelectCompany(company.id)}
                        >
                          <td className="px-6 py-4">
                            <div className="flex items-center gap-3">
                              <div className="w-8 h-8 rounded-full border border-gray-100 p-1 bg-gray-50 flex items-center justify-center shrink-0 overflow-hidden">
                                {company.logo ? (
                                  <img src={company.logo} alt="" className="w-full h-full object-cover rounded-full" />
                                ) : (
                                  <Building2 className="w-4 h-4 text-gray-300" />
                                )}
                              </div>
                              <div className="text-[13px] font-normal text-gray-900 group-hover:text-[#2580D3] transition-colors">
                                {company.name}
                              </div>
                            </div>
                          </td>
                          <td className="px-6 py-4 text-center text-[12px] text-gray-600 font-normal">
                            {company.employeeCount}
                          </td>
                          <td className="px-6 py-4 text-center text-[11px] text-gray-400 font-normal">
                            USD
                          </td>
                          <td className="px-6 py-4">
                            <span className="px-2 py-0.5 bg-green-50 text-green-600 text-[10px] rounded-[2px] border border-green-100 font-normal">
                              Active
                            </span>
                          </td>
                          <td className="px-6 py-4 text-right">
                            <button className="text-[#2580D3] text-[11px] font-normal hover:underline flex items-center gap-1 ml-auto">
                              Open Sheet
                              <ChevronRight className="w-3 h-3" />
                            </button>
                          </td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                </div>
              </motion.div>
            ) : (
              <motion.div 
                key="salary-table"
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
                className="p-6"
              >
                {/* Table Actions */}
                <div className="mb-4 flex items-center justify-between">
                  <div className="relative w-64">
                    <Search className="absolute left-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" />
                    <input 
                      type="text"
                      placeholder="Search employees..."
                      value={searchQuery}
                      onChange={(e) => setSearchQuery(e.target.value)}
                      className="w-full pl-8 pr-4 py-1.5 bg-white border border-gray-100 rounded-[3px] text-[12px] focus:border-[#2580D3] outline-none transition-all"
                    />
                  </div>
                  <div className="flex items-center gap-2">
                    <button className="px-3 py-1.5 bg-white border border-gray-100 rounded-[3px] text-[11px] flex items-center gap-2 text-gray-600 hover:bg-gray-50">
                      <Filter className="w-3 h-3" />
                      Filter
                    </button>
                    <button className="px-3 py-1.5 bg-[#2580D3] text-white rounded-[3px] text-[11px] flex items-center gap-2 hover:bg-[#1e6bb3] shadow-sm">
                      <Plus className="w-3 h-3" />
                      Add Employee
                    </button>
                  </div>
                </div>

                {/* Salary Table */}
                <div className="bg-white border border-gray-100 rounded-[3px] overflow-hidden shadow-sm overflow-x-auto no-scrollbar">
                  <table className="w-full text-left border-collapse min-w-[1000px]">
                    <thead>
                      <tr className="bg-gray-50/80 border-b border-gray-100">
                        <th className="px-4 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest sticky left-0 bg-gray-50/80 z-10">Employees</th>
                        {components.map(comp => (
                          <th key={comp.id} className="px-4 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-right">
                            {comp.name}
                            <span className="block text-[8px] opacity-40">{comp.shortName}</span>
                          </th>
                        ))}
                        <th className="px-4 py-3 text-[10px] font-normal text-gray-900 uppercase tracking-widest text-right bg-blue-50/30">Total</th>
                        <th className="px-4 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody className="divide-y divide-gray-50">
                      {salaryData
                        .filter(row => row.name.toLowerCase().includes(searchQuery.toLowerCase()))
                        .map((row) => (
                        <tr key={row.employeeId} className="hover:bg-gray-50/50 transition-colors group">
                          <td className="px-4 py-4 sticky left-0 bg-white group-hover:bg-gray-50/50 z-10 border-r border-gray-50">
                            <div className="flex items-center gap-3">
                              <div className="w-8 h-8 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0">
                                <span className="text-[10px] font-normal text-blue-600">
                                  {row.name.split(' ').map(n => n[0]).join('')}
                                </span>
                              </div>
                              <div>
                                <h4 className="text-[13px] font-normal text-gray-900 leading-tight">{row.name}</h4>
                                <p className="text-[10px] text-gray-400 uppercase tracking-tight">{row.role}</p>
                              </div>
                            </div>
                          </td>
                          {components.map(comp => (
                            <td key={comp.id} className="px-4 py-4 text-right">
                              <input 
                                type="number" 
                                value={row.values[comp.id] || 0} 
                                onChange={(e) => handleUpdateValue(row.employeeId, comp.id, parseInt(e.target.value) || 0)}
                                className="w-full bg-transparent border-none p-0 text-right text-[13px] font-normal text-gray-600 focus:ring-0 focus:text-gray-900 transition-colors" 
                              />
                            </td>
                          ))}
                          <td className="px-4 py-4 text-right bg-blue-50/10">
                            <span className="text-[14px] font-normal text-gray-900">
                              {calculateTotal(row).toLocaleString()}
                            </span>
                          </td>
                          <td className="px-4 py-4">
                            <div className="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                              <button className="p-1.5 text-gray-400 hover:text-[#2580D3] hover:bg-blue-50 rounded-[3px] transition-all">
                                <Edit3 className="w-3.5 h-3.5" />
                              </button>
                              <button className="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-[3px] transition-all">
                                <Trash2 className="w-3.5 h-3.5" />
                              </button>
                            </div>
                          </td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                </div>
              </motion.div>
            )}
          </AnimatePresence>
        </div>
      </main>

      <SalaryStructureModal 
        isOpen={isStructureModalOpen}
        onClose={() => setIsStructureModalOpen(false)}
        components={components}
        onSave={handleSaveStructure}
      />

      <ImportSalaryModal 
        isOpen={isImportModalOpen}
        onClose={() => setIsImportModalOpen(false)}
        onImport={(data) => {
          toast.success("Data imported successfully");
        }}
      />

      <SalaryRangeModal 
        isOpen={isRangeModalOpen}
        onClose={() => setIsRangeModalOpen(false)}
        configs={rangeConfigs}
        onSave={(newConfigs) => {
          setRangeConfigs(newConfigs);
          toast.success("Salary ranges and rank multipliers updated");
        }}
      />
    </div>
  );
}