import React, { useState } from "react";
import { TrendingUp, Coins, FileText, ChevronDown, Info, LayoutTemplate } from "lucide-react";
import { EvaluationState } from "../types";
import { MOCK_SALARY_SHEETS } from "../mockData";

interface Props {
  state: EvaluationState;
  setState: React.Dispatch<React.SetStateAction<EvaluationState>>;
}

// Import rank templates from the setup page
const AVAILABLE_RANK_TEMPLATES = [
  {
    id: "1",
    name: "Standard Performance Scale",
    description: "12-tier performance ranking from F to SS with progressive increments",
    ranks: [
      { rank: "F", label: "Below Expectations", minScore: 0, maxScore: 11, salaryMultiplier: 1.0, bonusMultiplier: 0.0 },
      { rank: "E", label: "Needs Improvement", minScore: 12, maxScore: 20, salaryMultiplier: 1.005, bonusMultiplier: 0.5 },
      { rank: "D", label: "Developing", minScore: 21, maxScore: 30, salaryMultiplier: 1.01, bonusMultiplier: 1.0 },
      { rank: "C", label: "Meets Expectations", minScore: 31, maxScore: 40, salaryMultiplier: 1.015, bonusMultiplier: 1.5 },
      { rank: "B", label: "Good Performance", minScore: 41, maxScore: 50, salaryMultiplier: 1.02, bonusMultiplier: 2.0 },
      { rank: "B+", label: "Strong Performance", minScore: 51, maxScore: 60, salaryMultiplier: 1.025, bonusMultiplier: 2.5 },
      { rank: "A", label: "Excellent", minScore: 61, maxScore: 70, salaryMultiplier: 1.03, bonusMultiplier: 3.0 },
      { rank: "A+", label: "Outstanding", minScore: 71, maxScore: 75, salaryMultiplier: 1.035, bonusMultiplier: 3.5 },
      { rank: "S-", label: "Exceptional", minScore: 76, maxScore: 80, salaryMultiplier: 1.04, bonusMultiplier: 4.0 },
      { rank: "S", label: "Superior", minScore: 81, maxScore: 85, salaryMultiplier: 1.045, bonusMultiplier: 4.5 },
      { rank: "S+", label: "Elite", minScore: 86, maxScore: 90, salaryMultiplier: 1.05, bonusMultiplier: 5.0 },
      { rank: "SS", label: "World Class", minScore: 91, maxScore: 100, salaryMultiplier: 1.055, bonusMultiplier: 5.5 },
    ],
    isDefault: true
  },
  {
    id: "2",
    name: "Simplified 5-Tier System",
    description: "Basic 5-level performance evaluation for smaller teams",
    ranks: [
      { rank: "Below Expectations", label: "Underperforming", minScore: 0, maxScore: 20, salaryMultiplier: 1.0, bonusMultiplier: 0.0 },
      { rank: "Meets Expectations", label: "Satisfactory", minScore: 21, maxScore: 40, salaryMultiplier: 1.01, bonusMultiplier: 1.0 },
      { rank: "Good Performance", label: "Good", minScore: 41, maxScore: 60, salaryMultiplier: 1.02, bonusMultiplier: 2.0 },
      { rank: "Excellent", label: "Excellent", minScore: 61, maxScore: 80, salaryMultiplier: 1.035, bonusMultiplier: 3.5 },
      { rank: "Outstanding", label: "Outstanding", minScore: 81, maxScore: 100, salaryMultiplier: 1.05, bonusMultiplier: 5.0 },
    ],
    isDefault: false
  },
  {
    id: "3",
    name: "Executive Level Assessment",
    description: "Premium tier system for senior leadership evaluation",
    ranks: [
      { rank: "Developing", label: "Development Stage", minScore: 0, maxScore: 30, salaryMultiplier: 1.005, bonusMultiplier: 0.5 },
      { rank: "Competent", label: "Competent Leader", minScore: 31, maxScore: 50, salaryMultiplier: 1.02, bonusMultiplier: 2.0 },
      { rank: "Strong", label: "Strong Leader", minScore: 51, maxScore: 70, salaryMultiplier: 1.04, bonusMultiplier: 4.0 },
      { rank: "Distinguished", label: "Distinguished Leader", minScore: 71, maxScore: 85, salaryMultiplier: 1.06, bonusMultiplier: 6.0 },
      { rank: "Exceptional", label: "Exceptional Leader", minScore: 86, maxScore: 100, salaryMultiplier: 1.08, bonusMultiplier: 8.0 },
    ],
    isDefault: false
  }
];

export function RankIncrementStep({ state, setState }: Props) {
  const selectedSheet = MOCK_SALARY_SHEETS.find(s => s.id === state.rankIncrement.salarySheetId) || MOCK_SALARY_SHEETS[0];
  
  // Find the selected template or use the first one as default
  const selectedTemplateId = state.rankIncrement.selectedTemplateId || AVAILABLE_RANK_TEMPLATES[0].id;
  const selectedTemplate = AVAILABLE_RANK_TEMPLATES.find(t => t.id === selectedTemplateId) || AVAILABLE_RANK_TEMPLATES[0];

  const handleTemplateChange = (templateId: string) => {
    const template = AVAILABLE_RANK_TEMPLATES.find(t => t.id === templateId);
    if (template) {
      setState(prev => ({
        ...prev,
        rankIncrement: {
          ...prev.rankIncrement,
          selectedTemplateId: templateId,
          ranks: template.ranks
        }
      }));
    }
  };

  return (
    <div className="p-6 space-y-8 bg-white no-scrollbar overflow-y-auto max-h-[70vh]">
      {/* Header */}
      <div className="flex items-center justify-between">
        <div>
          <h3 className="text-[16px] font-normal text-gray-900">Rank & Increment Configuration</h3>
          <p className="text-[11px] text-[#94989C] font-normal mt-1">Select a rank template and configure reward parameters</p>
        </div>
      </div>

      {/* Rank Template Selector */}
      <div className="bg-blue-50/30 border border-blue-100 rounded-[3px] p-5 space-y-4">
        <div className="flex items-center gap-2.5">
          <div className="w-6 h-6 bg-blue-100 rounded-[3px] flex items-center justify-center">
            <LayoutTemplate className="w-3.5 h-3.5 text-blue-600" />
          </div>
          <h3 className="text-[13px] font-normal text-gray-900 uppercase tracking-tight">Rank Template</h3>
        </div>
        
        <div className="space-y-3">
          <div className="relative">
            <select 
              value={selectedTemplateId}
              onChange={(e) => handleTemplateChange(e.target.value)}
              className="w-full px-4 py-3 bg-white border border-gray-200 rounded-[3px] focus:ring-1 focus:ring-blue-100 outline-none transition-all font-normal text-gray-900 text-[13px] appearance-none"
            >
              {AVAILABLE_RANK_TEMPLATES.map(template => (
                <option key={template.id} value={template.id}>
                  {template.name} {template.isDefault ? '(Default)' : ''}
                </option>
              ))}
            </select>
            <ChevronDown className="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" />
          </div>
          
          {selectedTemplate && (
            <div className="p-3 bg-white border border-blue-100 rounded-[3px]">
              <p className="text-[11px] text-gray-600 leading-relaxed">
                {selectedTemplate.description}
              </p>
              <div className="mt-2 flex items-center gap-4">
                <span className="text-[10px] text-gray-500">
                  <span className="font-normal text-gray-700">{selectedTemplate.ranks.length}</span> performance tiers
                </span>
              </div>
            </div>
          )}
        </div>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        {/* Salary Sheet Selector */}
        <div className="bg-gray-50/50 border border-gray-100 rounded-[3px] p-5 space-y-4">
          <div className="flex items-center gap-2.5">
            <div className="w-6 h-6 bg-blue-50 rounded-[3px] flex items-center justify-center">
              <FileText className="w-3.5 h-3.5 text-blue-600" />
            </div>
            <h3 className="text-[13px] font-normal text-gray-900 uppercase tracking-tight">Active Salary Sheet</h3>
          </div>
          
          <div className="relative">
            <select 
              value={state.rankIncrement.salarySheetId}
              onChange={(e) => setState(prev => ({ ...prev, rankIncrement: { ...prev.rankIncrement, salarySheetId: e.target.value } }))}
              className="w-full px-3 py-2 bg-white border border-gray-200 rounded-[3px] focus:ring-1 focus:ring-blue-100 outline-none transition-all font-normal text-gray-700 text-[12px] appearance-none"
            >
              {MOCK_SALARY_SHEETS.map(s => (
                <option key={s.id} value={s.id}>{s.name} ({s.currency})</option>
              ))}
            </select>
            <ChevronDown className="absolute right-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none" />
          </div>

          <div className="grid grid-cols-2 gap-3 pt-2">
            <div className="p-3 bg-white border border-gray-100 rounded-[3px]">
              <div className="text-[8px] font-normal text-[#94989C] uppercase tracking-[0.1em] mb-1">Base Salary</div>
              <div className="text-[13px] font-normal text-gray-900">{selectedSheet.baseSalary.toLocaleString()} <span className="text-[9px] text-gray-400">{selectedSheet.currency}</span></div>
            </div>
            <div className="p-3 bg-white border border-gray-100 rounded-[3px]">
              <div className="text-[8px] font-normal text-[#94989C] uppercase tracking-[0.1em] mb-1">Sheet Members</div>
              <div className="text-[13px] font-normal text-gray-900">{selectedSheet.employeeCount} <span className="text-[9px] text-gray-400">Staff</span></div>
            </div>
          </div>
        </div>

        {/* Bonus Configuration Card */}
        <div className="bg-orange-50/30 border border-orange-100 rounded-[3px] p-5 space-y-4">
          <div className="flex items-center justify-between">
            <div className="flex items-center gap-2.5">
              <div className="w-6 h-6 bg-orange-100 rounded-[3px] flex items-center justify-center">
                <Coins className="w-3.5 h-3.5 text-orange-600" />
              </div>
              <h3 className="text-[13px] font-normal text-gray-900 uppercase tracking-tight">Bonus Parameters</h3>
            </div>
            <label className="relative inline-flex items-center cursor-pointer scale-75">
              <input 
                type="checkbox" 
                className="sr-only peer"
                checked={state.rankIncrement.enableBonus}
                onChange={(e) => setState(prev => ({ ...prev, rankIncrement: { ...prev.rankIncrement, enableBonus: e.target.checked } }))}
              />
              <div className="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-orange-500" />
            </label>
          </div>

          <div className={`space-y-3 transition-all duration-300 ${state.rankIncrement.enableBonus ? 'opacity-100' : 'opacity-30 pointer-events-none'}`}>
            <div className="space-y-1.5">
              <label className="text-[9px] font-normal text-[#94989C] uppercase tracking-widest">Base Bonus Pool ({selectedSheet.currency})</label>
              <div className="relative">
                <input 
                  type="number"
                  value={state.rankIncrement.baseBonusAmount}
                  onChange={(e) => setState(prev => ({ ...prev, rankIncrement: { ...prev.rankIncrement, baseBonusAmount: parseInt(e.target.value) } }))}
                  className="w-full px-3 py-2 bg-white border border-gray-100 rounded-[3px] focus:ring-1 focus:ring-orange-100 outline-none transition-all font-normal text-[13px] text-gray-700"
                  placeholder="0.00"
                />
              </div>
            </div>
            <p className="text-[10px] text-[#94989C] leading-relaxed italic">
              * This amount will be multiplied by the rank bonus coefficient.
            </p>
          </div>
        </div>
      </div>

      {/* Performance Rank Table - Display Only */}
      <section className="space-y-4 pt-2">
        <div className="flex items-center justify-between">
          <div className="flex items-center gap-2.5">
            <div className="w-6 h-6 bg-green-50 rounded-[3px] flex items-center justify-center">
              <TrendingUp className="w-3.5 h-3.5 text-green-600" />
            </div>
            <h3 className="text-[13px] font-normal text-gray-900 uppercase tracking-tight">Rank-Based Reward Preview</h3>
          </div>
        </div>

        <div className="bg-white border border-gray-100 rounded-[3px] overflow-hidden shadow-sm">
          <table className="w-full text-left border-collapse">
            <thead>
              <tr className="bg-gray-50/50 border-b border-gray-100">
                <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest w-20">Rank</th>
                <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest w-32">Name</th>
                <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest w-32">Score</th>
                <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest">Evaluation Score</th>
                <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest w-28">Increment</th>
                <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest w-28">Bonus</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-gray-50">
              {selectedTemplate.ranks.map((rank, idx) => {
                return (
                  <tr key={idx} className="hover:bg-gray-50/30 transition-colors">
                    <td className="px-6 py-3">
                      <span className="text-[13px] font-normal text-gray-900 uppercase">
                        {rank.rank.substring(0, 3)}
                      </span>
                    </td>
                    <td className="px-6 py-3">
                      <span className="text-[11px] font-normal text-gray-400">Optional name</span>
                    </td>
                    <td className="px-6 py-3">
                      <div className="flex items-center gap-1.5 text-[13px] text-gray-600">
                        <span className="text-gray-500">{rank.minScore}</span>
                        <span>-</span>
                        <span className="text-gray-500">{rank.maxScore}</span>
                      </div>
                    </td>
                    <td className="px-6 py-3 relative">
                      <div className="h-1.5 w-full bg-gray-100 rounded-full relative overflow-hidden">
                        <div 
                          className="absolute h-full bg-[#2580D3] transition-all duration-300 rounded-full"
                          style={{ 
                            left: `${rank.minScore}%`, 
                            width: `${Math.max(2, rank.maxScore - rank.minScore)}%` 
                          }}
                        />
                      </div>
                      {/* Floating Label over the bar */}
                      <div 
                        className="absolute top-1/2 -translate-y-1/2 pointer-events-none transition-all duration-300"
                        style={{ left: `${(rank.minScore + rank.maxScore) / 2}%` }}
                      >
                        <div className="bg-[#2580D3] text-white text-[9px] px-1.5 py-0.5 rounded-[2px] shadow-sm flex items-center gap-1 -translate-x-1/2 border border-white/20">
                          {rank.rank.substring(0, 3)}
                        </div>
                      </div>
                    </td>
                    <td className="px-6 py-3">
                      <span className="text-[13px] font-normal text-gray-900">
                        {((rank.salaryMultiplier - 1) * 100).toFixed(1)}
                      </span>
                    </td>
                    <td className="px-6 py-3">
                      <span className="text-[13px] font-normal text-gray-900">
                        {rank.bonusMultiplier.toFixed(1)}
                      </span>
                    </td>
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>
        
        <div className="flex items-center gap-3 p-4 bg-blue-50/30 rounded-[3px] border border-blue-100">
          <Info className="w-4 h-4 text-blue-600 shrink-0" />
          <p className="text-[11px] text-gray-600 font-normal">
            This is a preview of the selected rank template. To modify rank configurations, please visit the <span className="font-normal text-[#2580D3]">Rank Setup</span> page from the main menu.
          </p>
        </div>
      </section>
    </div>
  );
}