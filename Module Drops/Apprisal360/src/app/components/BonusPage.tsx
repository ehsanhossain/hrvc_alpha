import React, { useState } from "react";
import { 
  DollarSign, 
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
  Gift
} from "lucide-react";
import { motion, AnimatePresence } from "motion/react";
import { MOCK_COMPANIES, MOCK_EMPLOYEES } from "@/app/mockData";
import { TopHeader } from "./TopHeader";
import { toast } from "sonner";

interface BonusRow {
  employeeId: string;
  name: string;
  role: string;
  baseSalary: number;
  performanceScore: number;
  multiplier: number;
  fixedBonus: number;
  extraBonus: number;
}

const generateBonusData = (companyId: string): BonusRow[] => {
  return MOCK_EMPLOYEES
    .filter(emp => emp.companyId === companyId)
    .map(emp => ({
      employeeId: emp.id,
      name: emp.name,
      role: emp.role,
      baseSalary: 45000,
      performanceScore: 85 + Math.floor(Math.random() * 15),
      multiplier: 1.2,
      fixedBonus: 5000,
      extraBonus: 2500,
    }));
};

export function BonusPage() {
  const [selectedCompanyId, setSelectedCompanyId] = useState<string | null>(null);
  const [searchQuery, setSearchQuery] = useState("");
  const [bonusData, setBonusData] = useState<BonusRow[]>([]);

  const handleSelectCompany = (companyId: string) => {
    setSelectedCompanyId(companyId);
    setBonusData(generateBonusData(companyId));
  };

  const calculateTotalBonus = (row: BonusRow) => {
    return (row.baseSalary * (row.multiplier - 1)) + row.fixedBonus + row.extraBonus;
  };

  const selectedCompany = MOCK_COMPANIES.find(c => c.id === selectedCompanyId);

  return (
    <div className="flex-1 flex flex-col h-screen overflow-hidden bg-white font-normal">
      <TopHeader />
      
      <main className="flex-1 flex flex-col overflow-hidden">
        {/* Breadcrumbs & Header */}
        <div className="px-6 py-4 border-b border-gray-50 flex items-center justify-between bg-white shrink-0">
          <div className="space-y-1">
            <div className="flex items-center gap-1.5 text-[10px] font-normal text-gray-500 uppercase tracking-widest">
              <span>Compensation</span>
              <ChevronRight className="w-2.5 h-2.5" />
              <span className={selectedCompanyId ? "text-gray-400" : "text-[#2580D3]"}>Bonus Sheets</span>
              {selectedCompanyId && (
                <>
                  <ChevronRight className="w-2.5 h-2.5" />
                  <span className="text-[#2580D3]">{selectedCompany?.name}</span>
                </>
              )}
            </div>
            <h1 className="text-[20px] font-normal text-gray-900 tracking-tight">
              {selectedCompanyId ? `${selectedCompany?.name} Bonus Configuration` : "Select Company for Bonus Sheet"}
            </h1>
          </div>

          <div className="flex items-center gap-2">
            {selectedCompanyId && (
              <button 
                onClick={() => setSelectedCompanyId(null)}
                className="px-3 py-1.5 text-gray-500 font-normal text-[12px] flex items-center gap-2 bg-white border border-gray-100 rounded-[3px] hover:bg-gray-50 transition-all"
              >
                <ArrowLeft className="w-3.5 h-3.5" />
                Change Company
              </button>
            )}
            <div className="h-4 w-px bg-gray-100 mx-1" />
            <button className="p-2 text-gray-400 hover:text-gray-900 transition-colors">
              <Download className="w-4 h-4" />
            </button>
          </div>
        </div>

        <div className="flex-1 overflow-y-auto no-scrollbar bg-gray-50/30">
          <AnimatePresence mode="wait">
            {!selectedCompanyId ? (
              <motion.div 
                key="bonus-company-table"
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
                className="p-8"
              >
                <div className="bg-white border border-gray-100 rounded-[3px] overflow-hidden shadow-sm">
                  <table className="w-full text-left border-collapse">
                    <thead>
                      <tr className="bg-gray-50/80 border-b border-gray-100">
                        <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest">Company Entity</th>
                        <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">Eligibility</th>
                        <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-right">Base Pool</th>
                        <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">Status</th>
                        <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-right">Action</th>
                      </tr>
                    </thead>
                    <tbody className="divide-y divide-gray-50">
                      {MOCK_COMPANIES.map((company) => (
                        <tr 
                          key={company.id} 
                          className="hover:bg-orange-50/30 transition-all cursor-pointer group"
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
                              <div className="text-[13px] font-normal text-gray-900 group-hover:text-orange-600 transition-colors">
                                {company.name}
                              </div>
                            </div>
                          </td>
                          <td className="px-6 py-4 text-center text-[12px] text-gray-600 font-normal">
                            {company.employeeCount} Members
                          </td>
                          <td className="px-6 py-4 text-right text-[13px] text-gray-600 font-normal">
                            $ 250,000.00
                          </td>
                          <td className="px-6 py-4 text-center">
                            <span className="px-2 py-0.5 bg-orange-50 text-orange-600 text-[10px] rounded-[2px] border border-orange-100 font-normal uppercase tracking-tight">
                              Pending
                            </span>
                          </td>
                          <td className="px-6 py-4 text-right">
                            <button className="text-orange-600 text-[11px] font-normal hover:underline flex items-center gap-1 ml-auto">
                              View Bonus
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
                key="bonus-table"
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
                      <Gift className="w-3 h-3" />
                      Bulk Bonus
                    </button>
                  </div>
                </div>

                {/* Bonus Table */}
                <div className="bg-white border border-gray-100 rounded-[3px] overflow-hidden shadow-sm overflow-x-auto no-scrollbar">
                  <table className="w-full text-left border-collapse min-w-[1000px]">
                    <thead>
                      <tr className="bg-gray-50/80 border-b border-gray-100">
                        <th className="px-4 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest">Employees</th>
                        <th className="px-4 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">Score</th>
                        <th className="px-4 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-right">Base Salary</th>
                        <th className="px-4 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">Multiplier</th>
                        <th className="px-4 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-right">Fixed Bonus</th>
                        <th className="px-4 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-right">Extra Bonus</th>
                        <th className="px-4 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-right font-normal text-[#2580D3]">Total Bonus</th>
                        <th className="px-4 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody className="divide-y divide-gray-50">
                      {bonusData
                        .filter(row => row.name.toLowerCase().includes(searchQuery.toLowerCase()))
                        .map((row) => (
                        <tr key={row.employeeId} className="hover:bg-gray-50/50 transition-colors group">
                          <td className="px-4 py-4">
                            <div className="flex items-center gap-3">
                              <div className="w-8 h-8 rounded-full bg-orange-50 border border-orange-100 flex items-center justify-center shrink-0">
                                <span className="text-[10px] font-normal text-orange-600">
                                  {row.name.split(' ').map(n => n[0]).join('')}
                                </span>
                              </div>
                              <div>
                                <h4 className="text-[13px] font-normal text-gray-900 leading-tight">{row.name}</h4>
                                <p className="text-[10px] text-gray-400 uppercase tracking-tight">{row.role}</p>
                              </div>
                            </div>
                          </td>
                          <td className="px-4 py-4 text-center">
                            <span className="px-2 py-0.5 bg-green-50 text-green-700 text-[11px] rounded-[2px] border border-green-100">
                              {row.performanceScore}
                            </span>
                          </td>
                          <td className="px-4 py-4 text-right text-[13px] text-gray-600">
                            {row.baseSalary.toLocaleString()}
                          </td>
                          <td className="px-4 py-4 text-center text-[13px] text-gray-900">
                            {row.multiplier}x
                          </td>
                          <td className="px-4 py-4 text-right text-[13px] text-gray-600">
                            {row.fixedBonus.toLocaleString()}
                          </td>
                          <td className="px-4 py-4 text-right text-[13px] text-gray-600">
                            {row.extraBonus.toLocaleString()}
                          </td>
                          <td className="px-4 py-4 text-right">
                            <span className="text-[14px] font-normal text-[#2580D3]">
                              {calculateTotalBonus(row).toLocaleString()}
                            </span>
                          </td>
                          <td className="px-4 py-4">
                            <div className="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                              <button className="p-1.5 text-gray-400 hover:text-[#2580D3] hover:bg-blue-50 rounded-[3px] transition-all">
                                <Edit3 className="w-3.5 h-3.5" />
                              </button>
                            </div>
                          </td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                </div>

                {/* Summary Section */}
                <div className="mt-6 flex justify-end">
                  <div className="bg-white border border-gray-100 rounded-[3px] p-6 w-80 space-y-4 shadow-sm">
                    <h3 className="text-[10px] font-normal text-gray-400 uppercase tracking-widest border-b border-gray-50 pb-2">Bonus Summary</h3>
                    <div className="space-y-2">
                      <div className="flex justify-between text-[12px]">
                        <span className="text-gray-500">Eligible Employees</span>
                        <span className="text-gray-900 font-normal">{bonusData.length}</span>
                      </div>
                      <div className="flex justify-between text-[12px]">
                        <span className="text-gray-500">Total Bonus Pool</span>
                        <span className="text-gray-900 font-normal text-[#2580D3]">
                          {bonusData.reduce((acc, row) => acc + calculateTotalBonus(row), 0).toLocaleString()}
                        </span>
                      </div>
                    </div>
                    <button className="w-full py-2 bg-[#2580D3] text-white rounded-[3px] text-[12px] font-normal hover:bg-[#1e6bb3] shadow-md transition-all active:scale-95 uppercase tracking-wide">
                      Disburse Bonuses
                    </button>
                  </div>
                </div>
              </motion.div>
            )}
          </AnimatePresence>
        </div>
      </main>
    </div>
  );
}