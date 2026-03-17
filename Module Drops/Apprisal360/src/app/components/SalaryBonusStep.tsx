import React from "react";
import { Plus, Trash2, DollarSign, Percent, Calculator, ChevronDown, FileText, Info } from "lucide-react";
import { EvaluationState, RankConfig } from "../types";
import { MOCK_SALARY_SHEETS } from "../mockData";

interface Props {
  state: EvaluationState;
  setState: React.Dispatch<React.SetStateAction<EvaluationState>>;
}

export function SalaryBonusStep({ state, setState }: Props) {
  const MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  const selectedSheet = MOCK_SALARY_SHEETS.find(s => s.id === state.rankIncrement.salarySheetId) || MOCK_SALARY_SHEETS[0];

  const updateRankValue = (index: number, value: number) => {
    setState(prev => {
      const newRanks = [...prev.rankIncrement.ranks];
      // Convert percentage (e.g. 10) to multiplier (e.g. 1.1)
      newRanks[index] = { ...newRanks[index], salaryMultiplier: 1 + (value / 100) };
      return {
        ...prev,
        rankIncrement: { ...prev.rankIncrement, ranks: newRanks }
      };
    });
  };

  const updateRankScores = (index: number, field: 'minScore' | 'maxScore', value: number) => {
    setState(prev => {
      const newRanks = [...prev.rankIncrement.ranks];
      newRanks[index] = { ...newRanks[index], [field]: value };
      return {
        ...prev,
        rankIncrement: { ...prev.rankIncrement, ranks: newRanks }
      };
    });
  };

  return (
    <div className="p-6 space-y-8 bg-white no-scrollbar overflow-y-auto max-h-[75vh]">
      {/* 1. Salary Sheet Selector */}
      <div className="space-y-3">
        <div className="flex items-center gap-2 mb-1">
          <div className="w-6 h-6 bg-blue-50 rounded-[3px] flex items-center justify-center">
            <FileText className="w-3.5 h-3.5 text-blue-600" />
          </div>
          <h3 className="text-[14px] font-normal text-gray-900 uppercase tracking-tight">Base Salary Configuration</h3>
        </div>
        
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div className="relative">
            <label className="text-[10px] font-normal text-gray-400 uppercase tracking-widest mb-1.5 block">Active Salary Sheet</label>
            <div className="relative">
              <select 
                value={state.rankIncrement.salarySheetId}
                onChange={(e) => setState(prev => ({ ...prev, rankIncrement: { ...prev.rankIncrement, salarySheetId: e.target.value } }))}
                className="w-full px-3 py-2.5 bg-gray-50 border border-gray-100 rounded-[3px] focus:ring-1 focus:ring-blue-100 outline-none transition-all font-normal text-gray-700 text-[13px] appearance-none"
              >
                {MOCK_SALARY_SHEETS.map(s => (
                  <option key={s.id} value={s.id}>{s.name} ({s.currency})</option>
                ))}
              </select>
              <ChevronDown className="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" />
            </div>
          </div>
          <div className="p-4 bg-blue-50/20 border border-blue-50 rounded-[3px] flex items-center gap-6 self-end">
            <div>
              <div className="text-[9px] font-normal text-gray-400 uppercase tracking-widest mb-0.5">Reference Base</div>
              <div className="text-[14px] font-normal text-gray-900">{selectedSheet.baseSalary.toLocaleString()} {selectedSheet.currency}</div>
            </div>
            <div className="w-px h-6 bg-blue-100/50" />
            <div>
              <div className="text-[9px] font-normal text-gray-400 uppercase tracking-widest mb-0.5">Staff Count</div>
              <div className="text-[14px] font-normal text-gray-900">{selectedSheet.employeeCount} Members</div>
            </div>
          </div>
        </div>
      </div>

      <div className="h-px bg-gray-50" />

      {/* 2. Bonus Inclusion Card from Screenshot */}
      <div className="bg-[#2580D3]/5 border border-[#2580D3]/10 rounded-[3px] p-6 space-y-5 shadow-sm">
        <div className="flex items-center justify-between">
          <div className="flex items-center gap-2.5">
            <div className="w-5 h-5 flex items-center justify-center bg-white rounded-full shadow-sm">
              <DollarSign className="w-3.5 h-3.5 text-[#2580D3]" />
            </div>
            <span className="text-[12px] font-normal text-gray-900 uppercase tracking-wider">Bonus Inclusion</span>
          </div>
          <div className="flex bg-white p-0.5 rounded-[3px] border border-gray-100 shadow-sm">
            {["Yes", "No"].map((opt) => (
              <button
                key={opt}
                onClick={() => setState(prev => ({ ...prev, timeFrame: { ...prev.timeFrame, bonusInclusion: opt === "Yes" } }))}
                className={`w-14 py-1.5 rounded-[2px] font-normal text-[11px] transition-all
                  ${(opt === "Yes") === state.timeFrame.bonusInclusion ? 'bg-[#2580D3] text-white shadow-sm' : 'text-gray-400 hover:text-gray-600'}
                `}
              >
                {opt}
              </button>
            ))}
          </div>
        </div>
        
        <div className={`space-y-2 transition-all duration-300 ${state.timeFrame.bonusInclusion ? 'opacity-100' : 'opacity-30 pointer-events-none'}`}>
          <label className="text-[10px] font-normal text-gray-400 uppercase tracking-widest block">Bonus Disbursement Month</label>
          <div className="relative">
            <select 
              value={state.timeFrame.bonusMonth}
              onChange={(e) => setState(prev => ({ ...prev, timeFrame: { ...prev.timeFrame, bonusMonth: e.target.value } }))}
              className="w-full px-4 py-2.5 bg-white border border-gray-100 rounded-[3px] focus:ring-1 focus:ring-[#2580D3]/20 focus:border-[#2580D3] outline-none transition-all font-normal text-[13px] text-gray-700 appearance-none"
            >
              {MONTHS.map(month => <option key={month} value={month}>{month}</option>)}
            </select>
            <div className="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
              <ChevronDown className="w-4 h-4 text-gray-400" />
            </div>
          </div>
        </div>
      </div>

      {/* 3. Increment Rules based on Ranks */}
      <div className="space-y-6 pt-2">
        <div className="flex items-center justify-between">
          <div>
            <h3 className="text-[14px] font-normal text-gray-900">Increment Rules</h3>
            <p className="text-[11px] text-gray-400 font-normal mt-0.5">Define salary adjustments based on performance ranks</p>
          </div>
          <button 
            className="px-3 py-1.5 bg-[#2580D3] text-white rounded-[3px] font-normal text-[12px] flex items-center gap-2 hover:bg-[#1e6bb3] shadow-sm transition-all"
          >
            <Plus className="w-3.5 h-3.5" />
            Add Rule
          </button>
        </div>

        <div className="space-y-2.5">
          <div className="grid grid-cols-12 gap-4 px-4 text-[9px] font-normal text-gray-400 uppercase tracking-[0.15em]">
            <div className="col-span-4">Score Range</div>
            <div className="col-span-3">Type</div>
            <div className="col-span-4">Value</div>
            <div className="col-span-1"></div>
          </div>

          {state.rankIncrement.ranks.map((rank, idx) => (
            <div 
              key={rank.rank}
              className="grid grid-cols-12 gap-4 items-center bg-gray-50/30 p-2.5 rounded-[3px] border border-gray-100 hover:border-blue-100 transition-all group relative"
            >
              {/* Badge for Rank */}
              <div className="absolute -left-2 top-1/2 -translate-y-1/2 w-6 h-6 bg-white border border-gray-100 shadow-sm rounded-full flex items-center justify-center text-[10px] font-normal text-gray-400 z-10 group-hover:text-[#2580D3] transition-colors">
                {rank.rank}
              </div>

              <div className="col-span-4 flex items-center gap-2 ml-4">
                <input 
                  type="number"
                  value={rank.minScore}
                  onChange={(e) => updateRankScores(idx, 'minScore', parseInt(e.target.value) || 0)}
                  className="w-full px-3 py-2 bg-white border border-gray-100 rounded-[3px] focus:ring-1 focus:ring-blue-100 outline-none transition-all font-normal text-center text-[12px]"
                  placeholder="Min"
                />
                <span className="text-gray-300 font-light">—</span>
                <input 
                  type="number"
                  value={rank.maxScore}
                  onChange={(e) => updateRankScores(idx, 'maxScore', parseInt(e.target.value) || 0)}
                  className="w-full px-3 py-2 bg-white border border-gray-100 rounded-[3px] focus:ring-1 focus:ring-blue-100 outline-none transition-all font-normal text-center text-[12px]"
                  placeholder="Max"
                />
              </div>

              <div className="col-span-3 flex bg-white p-0.5 rounded-[3px] border border-gray-100 shadow-sm">
                <button className="flex-1 py-1.5 rounded-[2px] text-[10px] font-normal uppercase transition-all bg-[#2580D3] text-white">
                  %
                </button>
                <button className="flex-1 py-1.5 rounded-[2px] text-[10px] font-normal uppercase transition-all text-gray-400 hover:text-gray-600">
                  $
                </button>
              </div>

              <div className="col-span-4 relative">
                <input 
                  type="number"
                  value={Math.round((rank.salaryMultiplier - 1) * 100)}
                  onChange={(e) => updateRankValue(idx, parseInt(e.target.value) || 0)}
                  className="w-full px-4 py-2 bg-white border border-gray-100 rounded-[3px] focus:ring-1 focus:ring-blue-100 outline-none transition-all font-normal text-[13px] text-gray-700 text-right pr-8"
                />
                <span className="absolute left-3 top-1/2 -translate-y-1/2 text-[11px] text-gray-300 font-normal">%</span>
              </div>

              <div className="col-span-1 flex justify-end">
                <button 
                  className="p-1.5 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-[3px] transition-all opacity-0 group-hover:opacity-100"
                >
                  <Trash2 className="w-3.5 h-3.5" />
                </button>
              </div>
            </div>
          ))}
        </div>

        <div className="p-4 bg-gray-50/50 rounded-[3px] border border-gray-100 border-dashed flex items-start gap-3 mt-4">
          <div className="w-8 h-8 bg-white border border-gray-100 rounded-[3px] flex items-center justify-center shrink-0">
            <Calculator className="w-4 h-4 text-[#2580D3]" />
          </div>
          <p className="text-[11px] text-gray-400 font-normal leading-relaxed">
            System applies highest priority rule based on base salary from the active sheet. The increment value is currently linked to <span className="text-gray-900 font-normal">Rank Configuration</span>.
          </p>
        </div>
      </div>
    </div>
  );
}
