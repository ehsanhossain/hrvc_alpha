import React, { useState, useRef, useEffect } from "react";
import { Building2, CheckCircle2, Search, ChevronDown, X, Building } from "lucide-react";
import { EvaluationState } from "../types";
import { MOCK_COMPANIES } from "../mockData";
import { ImageWithFallback } from "@/app/components/figma/ImageWithFallback";
import { motion, AnimatePresence } from "motion/react";

interface Props {
  state: EvaluationState;
  setState: React.Dispatch<React.SetStateAction<EvaluationState>>;
}

export function BasicInfoStep({ state, setState }: Props) {
  const [isOpen, setIsOpen] = useState(false);
  const [searchTerm, setSearchTerm] = useState("");
  const dropdownRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const handleClickOutside = (event: MouseEvent) => {
      if (dropdownRef.current && !dropdownRef.current.contains(event.target as Node)) {
        setIsOpen(false);
      }
    };
    document.addEventListener("mousedown", handleClickOutside);
    return () => document.removeEventListener("mousedown", handleClickOutside);
  }, []);

  const toggleCompany = (companyId: string) => {
    setState(prev => {
      const isSelected = prev.basicInfo.selectedCompanyIds.includes(companyId);
      const selected = isSelected
        ? prev.basicInfo.selectedCompanyIds.filter(id => id !== companyId)
        : [...prev.basicInfo.selectedCompanyIds, companyId];
      
      // Calculate total employees from selected companies for the reach
      // Note: In a real app, this might sync selectedEmployeeIds if needed, 
      // but here we are just managing company selection for Step 1.
      
      return {
        ...prev,
        basicInfo: { ...prev.basicInfo, selectedCompanyIds: selected }
      };
    });
  };

  const filteredCompanies = MOCK_COMPANIES.filter(c => 
    c.name.toLowerCase().includes(searchTerm.toLowerCase())
  );

  const selectedCompanies = MOCK_COMPANIES.filter(c => 
    state.basicInfo.selectedCompanyIds.includes(c.id)
  );

  const totalEmployees = selectedCompanies.reduce((acc, c) => acc + c.employeeCount, 0);

  return (
    <div className="p-6 space-y-8 bg-white">
      <section className="grid grid-cols-1 md:grid-cols-2 gap-10">
        <div className="space-y-6">
          <div className="space-y-1.5">
            <label className="text-[10px] font-normal text-muted-foreground uppercase tracking-[0.1em]">Profile Name</label>
            <input 
              type="text"
              placeholder="e.g., Annual Performance Cycle 2026"
              value={state.basicInfo.name}
              onChange={(e) => setState(prev => ({ ...prev, basicInfo: { ...prev.basicInfo, name: e.target.value } }))}
              className="w-full px-3 py-2.5 bg-white border border-[#f0f1f3] rounded-[3px] focus:ring-1 focus:ring-[#2580D3]/20 focus:border-[#2580D3] outline-none transition-all font-normal text-[13px] placeholder:text-gray-300"
            />
          </div>
          <div className="space-y-1.5">
            <label className="text-[10px] font-normal text-muted-foreground uppercase tracking-[0.1em]">Description</label>
            <textarea 
              rows={8}
              placeholder="Provide context and objectives for this evaluation profile..."
              value={state.basicInfo.description}
              onChange={(e) => setState(prev => ({ ...prev, basicInfo: { ...prev.basicInfo, description: e.target.value } }))}
              className="w-full px-3 py-2.5 bg-white border border-[#f0f1f3] rounded-[3px] focus:ring-1 focus:ring-[#2580D3]/20 focus:border-[#2580D3] outline-none transition-all font-normal text-[13px] resize-none no-scrollbar placeholder:text-gray-300"
            />
          </div>
        </div>

        <div className="space-y-4 flex flex-col">
          <div className="flex items-center justify-between">
            <label className="text-[10px] font-normal text-muted-foreground uppercase tracking-[0.1em]">Evaluation Entity: Company</label>
            <span className="text-[10px] text-[#2580D3] font-normal bg-[#2580D3]/5 px-2 py-0.5 rounded-[2px]">
              {selectedCompanies.length} Selected
            </span>
          </div>

          <div className="relative" ref={dropdownRef}>
            <div 
              onClick={() => setIsOpen(!isOpen)}
              className={`min-h-[44px] w-full px-3 py-2 bg-white border rounded-[3px] cursor-pointer transition-all flex items-center justify-between group
                ${isOpen ? 'border-[#2580D3] ring-1 ring-[#2580D3]/10' : 'border-[#f0f1f3] hover:border-gray-200 shadow-sm'}
              `}
            >
              <div className="flex flex-wrap gap-1.5 flex-1 min-w-0">
                {selectedCompanies.length > 0 ? (
                  selectedCompanies.map(company => (
                    <div 
                      key={company.id}
                      className="flex items-center gap-1.5 pl-1 pr-2 py-0.5 bg-[#f9fafb] border border-[#f0f1f3] rounded-[2px] group/chip transition-all hover:bg-white hover:border-[#2580D3]/30"
                    >
                      <div className="w-4 h-4 rounded-full overflow-hidden shrink-0 border border-gray-100">
                        {company.logo ? (
                          <ImageWithFallback src={company.logo} alt={company.name} className="w-full h-full object-cover" />
                        ) : (
                          <div className="w-full h-full bg-[#2580D3] flex items-center justify-center text-[8px] text-white font-normal uppercase">
                            {company.name.charAt(0)}
                          </div>
                        )}
                      </div>
                      <span className="text-[11px] font-normal text-gray-700 truncate max-w-[120px]">{company.name}</span>
                      <button 
                        onClick={(e) => {
                          e.stopPropagation();
                          toggleCompany(company.id);
                        }}
                        className="text-gray-400 hover:text-red-500 transition-colors"
                      >
                        <X className="w-3 h-3" />
                      </button>
                    </div>
                  ))
                ) : (
                  <span className="text-[13px] text-gray-400 font-normal">Select companies to evaluate...</span>
                )}
              </div>
              <div className="flex items-center gap-2 shrink-0 ml-2">
                <div className="w-px h-4 bg-[#f0f1f3]" />
                <ChevronDown className={`w-4 h-4 text-gray-400 transition-transform duration-200 ${isOpen ? 'rotate-180 text-[#2580D3]' : ''}`} />
              </div>
            </div>

            <AnimatePresence>
              {isOpen && (
                <motion.div 
                  initial={{ opacity: 0, y: 4 }}
                  animate={{ opacity: 1, y: 0 }}
                  exit={{ opacity: 0, y: 4 }}
                  transition={{ duration: 0.15 }}
                  className="absolute z-[100] mt-1.5 w-full bg-white border border-[#f0f1f3] rounded-[3px] shadow-xl overflow-hidden flex flex-col"
                >
                  <div className="p-2 border-b border-[#f9fafb] bg-[#f9fafb]/50">
                    <div className="relative">
                      <Search className="absolute left-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" />
                      <input 
                        autoFocus
                        type="text"
                        placeholder="Search registered companies..."
                        value={searchTerm}
                        onChange={(e) => setSearchTerm(e.target.value)}
                        className="w-full pl-8 pr-3 py-1.5 bg-white border border-[#f0f1f3] rounded-[2px] outline-none font-normal text-[12px] focus:border-[#2580D3]/50 transition-all"
                      />
                    </div>
                  </div>
                  
                  <div className="max-h-[260px] overflow-y-auto no-scrollbar py-1">
                    {filteredCompanies.length > 0 ? (
                      filteredCompanies.map((company) => {
                        const isSelected = state.basicInfo.selectedCompanyIds.includes(company.id);
                        return (
                          <div 
                            key={company.id}
                            onClick={() => toggleCompany(company.id)}
                            className={`flex items-center justify-between px-3 py-2 cursor-pointer transition-all group
                              ${isSelected ? 'bg-[#2580D3]/5' : 'hover:bg-[#f9fafb]'}
                            `}
                          >
                            <div className="flex items-center gap-3">
                              <div className={`w-3.5 h-3.5 rounded-[2px] border flex items-center justify-center transition-all
                                ${isSelected ? 'bg-[#2580D3] border-[#2580D3]' : 'bg-white border-gray-300 group-hover:border-[#2580D3]'}
                              `}>
                                {isSelected && <CheckCircle2 className="w-2.5 h-2.5 text-white" />}
                              </div>
                              <div className="w-6 h-6 rounded-full overflow-hidden border border-gray-100 shrink-0">
                                {company.logo ? (
                                  <ImageWithFallback src={company.logo} alt={company.name} className="w-full h-full object-cover" />
                                ) : (
                                  <div className="w-full h-full bg-[#2580D3]/10 flex items-center justify-center text-[10px] text-[#2580D3] font-normal uppercase">
                                    {company.name.charAt(0)}
                                  </div>
                                )}
                              </div>
                              <div className="flex flex-col">
                                <span className={`text-[12px] font-normal transition-colors ${isSelected ? 'text-[#2580D3]' : 'text-gray-700 group-hover:text-gray-900'}`}>
                                  {company.name}
                                </span>
                                <span className="text-[10px] text-gray-400 font-normal">{company.employeeCount} Employees</span>
                              </div>
                            </div>
                            {isSelected && (
                              <div className="w-1.5 h-1.5 rounded-full bg-[#2580D3]" />
                            )}
                          </div>
                        );
                      })
                    ) : (
                      <div className="px-4 py-8 text-center">
                        <Building className="w-8 h-8 text-gray-200 mx-auto mb-2" />
                        <p className="text-[11px] text-gray-400 font-normal">No companies found matching "{searchTerm}"</p>
                      </div>
                    )}
                  </div>
                  
                  <div className="px-3 py-2 bg-[#f9fafb] border-t border-[#f0f1f3] flex items-center justify-between">
                    <span className="text-[10px] text-gray-400 font-normal">Showing {filteredCompanies.length} companies</span>
                    <button 
                      onClick={() => setIsOpen(false)}
                      className="text-[10px] text-[#2580D3] font-normal hover:underline"
                    >
                      Done Selecting
                    </button>
                  </div>
                </motion.div>
              )}
            </AnimatePresence>
          </div>
          
          <div className="mt-auto p-4 bg-[#f9fafb]/50 border border-[#f0f1f3] rounded-[3px] border-dashed">
            <div className="flex items-center gap-3">
              <div className="w-8 h-8 rounded-full bg-white border border-[#f0f1f3] flex items-center justify-center">
                <Building2 className="w-4 h-4 text-[#2580D3]" />
              </div>
              <div>
                <h4 className="text-[11px] font-normal text-gray-400 uppercase tracking-wider">Target Reach</h4>
                <p className="text-[13px] font-normal text-gray-900">
                  {totalEmployees.toLocaleString()} Total Employees
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}