import React, { useState } from "react";
import { X, DollarSign, Target, TrendingUp, Search, Plus, Trash2, Info } from "lucide-react";
import { INITIAL_RANKS } from "@/app/mockData";

export interface TitleConfig {
  id: string;
  title: string;
  minSalary: number;
  maxSalary: number;
  multipliers: Record<string, number>;
}

interface Props {
  isOpen: boolean;
  onClose: () => void;
  configs: TitleConfig[];
  onSave: (configs: TitleConfig[]) => void;
}

const MOCK_TITLES = [
  "Sales Manager",
  "Senior Sales Rep",
  "Account Executive",
  "Product Designer",
  "Frontend Engineer",
  "HR Generalist",
  "Operations Lead"
];

export function SalaryRangeModal({ isOpen, onClose, configs: initialConfigs, onSave }: Props) {
  // Use initial configs or generate mock if empty
  const [localConfigs, setLocalConfigs] = useState<TitleConfig[]>(
    initialConfigs.length > 0 ? initialConfigs : MOCK_TITLES.map((title, i) => ({
      id: `t${i}`,
      title,
      minSalary: 45000 + (i * 5000),
      maxSalary: 85000 + (i * 8000),
      multipliers: INITIAL_RANKS.reduce((acc, r) => ({
        ...acc,
        [r.rank]: r.salaryMultiplier
      }), {})
    }))
  );

  const [searchQuery, setSearchQuery] = useState("");

  if (!isOpen) return null;

  const updateField = (id: string, field: keyof TitleConfig, value: any) => {
    setLocalConfigs(prev => prev.map(c => c.id === id ? { ...c, [field]: value } : c));
  };

  const updateMultiplier = (id: string, rank: string, value: number) => {
    setLocalConfigs(prev => prev.map(c => 
      c.id === id ? { ...c, multipliers: { ...c.multipliers, [rank]: value } } : c
    ));
  };

  const addRole = () => {
    const newId = `t${Date.now()}`;
    setLocalConfigs([...localConfigs, {
      id: newId,
      title: "New Role",
      minSalary: 30000,
      maxSalary: 60000,
      multipliers: INITIAL_RANKS.reduce((acc, r) => ({ ...acc, [r.rank]: 1.0 }), {})
    }]);
  };

  const removeRole = (id: string) => {
    setLocalConfigs(localConfigs.filter(c => c.id !== id));
  };

  return (
    <div className="fixed inset-0 z-[100] flex items-center justify-center bg-black/20 backdrop-blur-[2px]">
      <div className="bg-white w-[95vw] max-w-5xl h-[85vh] rounded-[3px] shadow-2xl border border-gray-100 overflow-hidden flex flex-col">
        <div className="px-6 py-4 border-b border-gray-50 flex items-center justify-between bg-white shrink-0">
          <div className="flex items-center gap-2">
            <div className="w-8 h-8 bg-blue-50 rounded-[3px] flex items-center justify-center">
              <TrendingUp className="w-4 h-4 text-[#2580D3]" />
            </div>
            <div>
              <h2 className="text-[15px] font-normal text-gray-900 tracking-tight">Salary Ranges & Rank Multipliers</h2>
              <p className="text-[10px] text-gray-400 uppercase tracking-widest">Title-based pay scaling</p>
            </div>
          </div>
          <div className="flex items-center gap-4">
            <div className="relative w-48">
              <Search className="absolute left-2 top-1/2 -translate-y-1/2 w-3 h-3 text-gray-400" />
              <input 
                type="text"
                placeholder="Search roles..."
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                className="w-full pl-7 pr-2 py-1 bg-gray-50 border border-gray-100 rounded-[2px] text-[11px] outline-none focus:bg-white"
              />
            </div>
            <button onClick={onClose} className="p-2 hover:bg-gray-50 rounded-[3px] transition-colors">
              <X className="w-4 h-4 text-gray-400" />
            </button>
          </div>
        </div>

        <div className="flex-1 overflow-auto no-scrollbar p-6">
          <div className="border border-gray-100 rounded-[3px] overflow-hidden">
            <table className="w-full text-left border-collapse min-w-[1000px]">
              <thead>
                <tr className="bg-gray-50 border-b border-gray-100">
                  <th className="px-4 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest sticky left-0 bg-gray-50 z-20 w-48">Role</th>
                  <th className="px-4 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center w-56">Base Range</th>
                  {INITIAL_RANKS.map(rank => (
                    <th key={rank.rank} className="px-4 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">
                      Rank {rank.rank}
                    </th>
                  ))}
                  <th className="px-4 py-3 w-10"></th>
                </tr>
              </thead>
              <tbody className="divide-y divide-gray-50">
                {localConfigs
                  .filter(c => c.title.toLowerCase().includes(searchQuery.toLowerCase()))
                  .map((config) => (
                  <tr key={config.id} className="hover:bg-gray-50/50 transition-colors group">
                    <td className="px-4 py-3 sticky left-0 bg-white group-hover:bg-gray-50/50 z-10 border-r border-gray-50">
                      <input 
                        type="text"
                        value={config.title}
                        onChange={(e) => updateField(config.id, 'title', e.target.value)}
                        className="w-full bg-transparent border-none p-0 text-[12px] font-normal text-gray-900 focus:ring-0"
                      />
                    </td>
                    <td className="px-4 py-3">
                      <div className="flex items-center gap-1.5">
                        <div className="relative flex-1">
                          <span className="absolute left-1.5 top-1/2 -translate-y-1/2 text-[8px] text-gray-300">$</span>
                          <input 
                            type="number"
                            value={config.minSalary}
                            onChange={(e) => updateField(config.id, 'minSalary', parseInt(e.target.value) || 0)}
                            className="w-full pl-4 pr-1 py-1 bg-gray-50 border border-gray-100 rounded-[2px] text-[11px] font-normal outline-none focus:bg-white"
                          />
                        </div>
                        <span className="text-gray-300 text-[10px]">—</span>
                        <div className="relative flex-1">
                          <span className="absolute left-1.5 top-1/2 -translate-y-1/2 text-[8px] text-gray-300">$</span>
                          <input 
                            type="number"
                            value={config.maxSalary}
                            onChange={(e) => updateField(config.id, 'maxSalary', parseInt(e.target.value) || 0)}
                            className="w-full pl-4 pr-1 py-1 bg-gray-50 border border-gray-100 rounded-[2px] text-[11px] font-normal outline-none focus:bg-white"
                          />
                        </div>
                      </div>
                    </td>
                    {INITIAL_RANKS.map(rank => (
                      <td key={rank.rank} className="px-4 py-3">
                        <div className="relative">
                          <input 
                            type="number"
                            step="0.01"
                            value={config.multipliers[rank.rank]}
                            onChange={(e) => updateMultiplier(config.id, rank.rank, parseFloat(e.target.value) || 0)}
                            className="w-full px-2 py-1 bg-white border border-gray-100 rounded-[2px] text-[11px] font-normal text-center outline-none focus:border-blue-200"
                          />
                          <span className="absolute right-1 top-1/2 -translate-y-1/2 text-[9px] text-gray-200">x</span>
                        </div>
                      </td>
                    ))}
                    <td className="px-2 py-3">
                      <button 
                        onClick={() => removeRole(config.id)}
                        className="p-1.5 text-gray-300 hover:text-red-500 opacity-0 group-hover:opacity-100 transition-opacity"
                      >
                        <Trash2 className="w-3.5 h-3.5" />
                      </button>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
          
          <button 
            onClick={addRole}
            className="mt-4 w-full py-2 border border-dashed border-gray-200 rounded-[3px] text-[11px] text-gray-400 hover:text-[#2580D3] hover:border-[#2580D3] hover:bg-blue-50/20 transition-all flex items-center justify-center gap-2"
          >
            <Plus className="w-3.5 h-3.5" />
            Add New Job Role
          </button>
        </div>

        <div className="px-6 py-4 border-t border-gray-50 bg-gray-50/50 flex items-center justify-between shrink-0">
          <div className="flex items-center gap-2 text-[11px] text-gray-400">
            <Info className="w-3.5 h-3.5 text-blue-400" />
            Multipliers define the salary growth factor for each performance rank.
          </div>
          <div className="flex items-center gap-3">
            <button 
              onClick={onClose}
              className="px-4 py-2 text-[12px] text-gray-500 font-normal hover:text-gray-700"
            >
              Cancel
            </button>
            <button 
              onClick={() => {
                onSave(localConfigs);
                onClose();
              }}
              className="px-6 py-2 bg-[#2580D3] text-white rounded-[3px] text-[12px] font-normal hover:bg-[#1e6bb3] shadow-sm transition-all active:scale-95"
            >
              Update Configuration
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}