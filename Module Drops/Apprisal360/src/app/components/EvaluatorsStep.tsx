import React, { useState } from "react";
import { 
  Users, 
  UserCheck, 
  UserPlus, 
  AlertCircle, 
  CheckCircle2, 
  Search, 
  GitBranch, 
  ShieldCheck,
  ArrowRight,
  Info,
  ChevronDown,
  AlertTriangle,
  Link2
} from "lucide-react";
import { EvaluationState, Employee, PermissionLevel } from "../types";
import { MOCK_EMPLOYEES } from "../mockData";
import { toast } from "sonner";
import permissionMapImage from 'figma:asset/3478f6d3952991a7ae9d039169a04e9402022744.png';

interface Props {
  state: EvaluationState;
  setState: React.Dispatch<React.SetStateAction<EvaluationState>>;
}

export function EvaluatorsStep({ state, setState }: Props) {
  const [activeTab, setActiveTab] = useState<'map' | 'assignment'>('map');
  const [searchTerm, setSearchTerm] = useState("");
  
  const allEmployees = MOCK_EMPLOYEES;
  const selectedEmployees = allEmployees.filter(e => state.basicInfo.selectedEmployeeIds.includes(e.id));
  
  const fullyAssignedCount = selectedEmployees.filter(e => {
    const assignment = state.evaluators.assignments[e.id];
    const level = e.permissionLevel;
    if (level === 'Admin') return true; // Admins are complete by default or manual
    if (level === 'General Manager') return assignment?.first;
    return assignment?.first && assignment?.second;
  }).length;

  const incompleteCount = selectedEmployees.length - fullyAssignedCount;

  const updateAssignment = (employeeId: string, type: 'first' | 'second', evaluatorId: string) => {
    setState(prev => ({
      ...prev,
      evaluators: {
        ...prev.evaluators,
        assignments: {
          ...prev.evaluators.assignments,
          [employeeId]: {
            ...prev.evaluators.assignments[employeeId] || { first: '', second: '' },
            [type]: evaluatorId
          }
        }
      }
    }));
  };

  const autoAssign = () => {
    const newAssignments = { ...state.evaluators.assignments };
    let conflictCount = 0;

    selectedEmployees.forEach(emp => {
      let first = "";
      let second = "";

      if (emp.permissionLevel === 'Staff') {
        const teamLeaders = allEmployees.filter(e => e.team === emp.team && e.permissionLevel === 'Team Leader');
        if (teamLeaders.length === 1) {
          first = teamLeaders[0].id;
        } else if (teamLeaders.length > 1) {
          conflictCount++;
        }
        
        const managers = allEmployees.filter(e => e.permissionLevel === 'Manager');
        if (managers.length > 0) second = managers[0].id;
      } 
      else if (emp.permissionLevel === 'Team Leader') {
        const managers = allEmployees.filter(e => e.permissionLevel === 'Manager');
        if (managers.length > 0) first = managers[0].id;
        
        const gms = allEmployees.filter(e => e.permissionLevel === 'General Manager');
        if (gms.length > 0) second = gms[0].id;
      }
      else if (emp.permissionLevel === 'Manager') {
        const gms = allEmployees.filter(e => e.permissionLevel === 'General Manager');
        if (gms.length > 0) first = gms[0].id;
        
        const admins = allEmployees.filter(e => e.permissionLevel === 'Admin');
        if (admins.length > 0) second = admins[0].id;
      }
      else if (emp.permissionLevel === 'General Manager') {
        const admins = allEmployees.filter(e => e.permissionLevel === 'Admin');
        if (admins.length > 0) first = admins[0].id;
      }

      newAssignments[emp.id] = { first, second };
    });

    setState(prev => ({
      ...prev,
      evaluators: {
        ...prev.evaluators,
        assignments: newAssignments
      }
    }));

    if (conflictCount > 0) {
      toast.warning(`Conflict Detected: ${conflictCount} employees belong to teams with multiple Team Leaders. Please assign them manually.`);
    } else {
      toast.success("All evaluators mapped based on organization hierarchy.");
    }
  };

  const filteredEmployees = selectedEmployees.filter(emp => 
    emp.name.toLowerCase().includes(searchTerm.toLowerCase()) || 
    emp.role.toLowerCase().includes(searchTerm.toLowerCase()) ||
    emp.team.toLowerCase().includes(searchTerm.toLowerCase())
  );

  return (
    <div className="p-6 space-y-6 flex flex-col h-full overflow-hidden">
      {/* Summary Stats */}
      <section className="grid grid-cols-4 gap-4 shrink-0">
        {[
          { label: 'Total Selected', value: selectedEmployees.length, icon: Users, color: 'blue' },
          { label: 'Map Complete', value: fullyAssignedCount, icon: CheckCircle2, color: 'green' },
          { label: 'Pending Action', value: incompleteCount, icon: AlertCircle, color: 'red' },
          { label: 'System Logic', value: 'Active', icon: ShieldCheck, color: 'purple' },
        ].map((stat) => (
          <div key={stat.label} className="p-3 rounded-[3px] border border-gray-100 bg-gray-50/20">
            <div className="flex items-center gap-2 mb-1.5">
              <div className="w-5 h-5 bg-white border border-gray-100 rounded-[3px] flex items-center justify-center">
                <stat.icon className={`w-3 h-3 text-${stat.color}-600`} />
              </div>
              <span className="text-[9px] font-normal uppercase tracking-widest text-gray-400">{stat.label}</span>
            </div>
            <div className="text-[18px] font-normal text-gray-900 leading-none">{stat.value}</div>
          </div>
        ))}
      </section>

      {/* Tabs */}
      <div className="flex items-center justify-between border-b border-gray-50 shrink-0">
        <div className="flex items-center">
          <button 
            onClick={() => setActiveTab('map')}
            className={`px-6 py-2.5 text-[11px] font-normal uppercase tracking-widest transition-all relative
              ${activeTab === 'map' ? 'text-[#2580D3]' : 'text-gray-400 hover:text-gray-600'}
            `}
          >
            Evaluator Map
            {activeTab === 'map' && <div className="absolute bottom-0 left-0 right-0 h-[2px] bg-[#2580D3]" />}
          </button>
          <button 
            onClick={() => setActiveTab('assignment')}
            className={`px-6 py-2.5 text-[11px] font-normal uppercase tracking-widest transition-all relative
              ${activeTab === 'assignment' ? 'text-[#2580D3]' : 'text-gray-400 hover:text-gray-600'}
            `}
          >
            Evaluator Assignment
            {activeTab === 'assignment' && <div className="absolute bottom-0 left-0 right-0 h-[2px] bg-[#2580D3]" />}
          </button>
        </div>
        
        {activeTab === 'assignment' && (
          <div className="flex items-center gap-2 pb-1.5">
            <div className="relative">
              <Search className="w-3.5 h-3.5 text-gray-300 absolute left-2.5 top-1/2 -translate-y-1/2" />
              <input 
                type="text" 
                placeholder="Search employees..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="pl-8 pr-3 py-1.5 bg-gray-50 border border-gray-100 rounded-[3px] focus:ring-1 focus:ring-blue-100 outline-none transition-all text-[11px] font-normal w-48"
              />
            </div>
            <button 
              onClick={autoAssign}
              className="px-3 py-1.5 bg-[#2580D3] text-white rounded-[3px] font-normal text-[11px] hover:bg-[#1e6bb3] transition-all flex items-center gap-1.5 shadow-sm active:scale-95"
            >
              <UserPlus className="w-3.5 h-3.5" />
              Auto Assign
            </button>
          </div>
        )}
      </div>

      <div className="flex-1 overflow-y-auto no-scrollbar">
        {activeTab === 'assignment' ? (
          <div className="border border-gray-100 rounded-[3px] overflow-hidden bg-white">
            <table className="w-full text-left">
              <thead>
                <tr className="bg-gray-50/80 text-[9px] font-normal text-gray-400 uppercase tracking-[0.1em]">
                  <th className="px-4 py-3 border-b border-gray-50">Employee Information</th>
                  <th className="px-4 py-3 border-b border-gray-50">Role & Team</th>
                  <th className="px-4 py-3 border-b border-gray-50">1st Evaluator (Primary)</th>
                  <th className="px-4 py-3 border-b border-gray-50">2nd Evaluator (Secondary)</th>
                  <th className="px-4 py-3 border-b border-gray-50 text-right">Status</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-gray-50">
                {filteredEmployees.map((emp) => {
                  const assignment = state.evaluators.assignments[emp.id] || { first: '', second: '' };
                  const level = emp.permissionLevel;
                  
                  // Check for conflict (Multiple TLs in team)
                  const teamLeaders = allEmployees.filter(e => e.team === emp.team && e.permissionLevel === 'Team Leader');
                  const hasConflict = level === 'Staff' && teamLeaders.length > 1 && !assignment.first;

                  const isComplete = (level === 'Admin' ? true : 
                                    level === 'General Manager' ? !!assignment.first : 
                                    (assignment.first && assignment.second));

                  return (
                    <tr key={emp.id} className="hover:bg-blue-50/5 transition-colors">
                      <td className="px-4 py-4">
                        <div className="flex items-center gap-3">
                          <div className={`w-8 h-8 rounded-full flex items-center justify-center text-[10px] font-normal border
                            ${level === 'Admin' ? 'bg-purple-50 text-purple-600 border-purple-100' : 
                              level === 'General Manager' ? 'bg-blue-50 text-blue-600 border-blue-100' :
                              level === 'Manager' ? 'bg-green-50 text-green-600 border-green-100' :
                              'bg-gray-50 text-gray-600 border-gray-100'}
                          `}>
                            {emp.name.split(' ').map(n => n[0]).join('')}
                          </div>
                          <div>
                            <div className="text-[12px] font-normal text-gray-900 leading-tight">{emp.name}</div>
                            <div className="text-[10px] font-normal text-gray-400">{emp.role}</div>
                          </div>
                        </div>
                      </td>
                      <td className="px-4 py-4">
                        <div className="flex flex-col gap-1">
                          <span className="text-[10px] font-normal text-gray-500 uppercase tracking-tight">{emp.permissionLevel}</span>
                          <span className="text-[11px] font-normal text-gray-900">{emp.team}</span>
                        </div>
                      </td>
                      <td className="px-4 py-4">
                        <div className="relative">
                          <select 
                            value={assignment.first}
                            onChange={(e) => updateAssignment(emp.id, 'first', e.target.value)}
                            className={`w-full bg-white border border-gray-100 rounded-[2px] px-2 py-1.5 font-normal text-[11px] appearance-none cursor-pointer focus:border-[#2580D3] outline-none
                              ${assignment.first ? 'text-gray-900' : 'text-gray-300 italic'}
                              ${hasConflict ? 'border-amber-200 bg-amber-50/30' : ''}
                            `}
                          >
                            <option value="">{hasConflict ? 'Conflict: Select Manually' : 'Select Primary...'}</option>
                            {allEmployees.filter(e => e.id !== emp.id).map(e => (
                              <option key={e.id} value={e.id}>{e.name} ({e.permissionLevel})</option>
                            ))}
                          </select>
                          <ChevronDown className="w-3 h-3 text-gray-300 absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none" />
                        </div>
                      </td>
                      <td className="px-4 py-4">
                        <div className="relative">
                          <select 
                            value={assignment.second}
                            onChange={(e) => updateAssignment(emp.id, 'second', e.target.value)}
                            disabled={level === 'Admin' || level === 'General Manager'}
                            className={`w-full bg-white border border-gray-100 rounded-[2px] px-2 py-1.5 font-normal text-[11px] appearance-none cursor-pointer focus:border-[#2580D3] outline-none
                              ${assignment.second ? 'text-gray-900' : 'text-gray-300 italic'}
                              ${(level === 'Admin' || level === 'General Manager') ? 'bg-gray-50 cursor-not-allowed opacity-50' : ''}
                            `}
                          >
                            <option value="">{(level === 'Admin' || level === 'General Manager') ? 'N/A' : 'Select Secondary...'}</option>
                            {allEmployees.filter(e => e.id !== emp.id).map(e => (
                              <option key={e.id} value={e.id}>{e.name} ({e.permissionLevel})</option>
                            ))}
                          </select>
                          {!(level === 'Admin' || level === 'General Manager') && <ChevronDown className="w-3 h-3 text-gray-300 absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none" />}
                        </div>
                      </td>
                      <td className="px-4 py-4 text-right">
                        <div className="flex flex-col items-end gap-1">
                          {isComplete ? (
                            <div className="flex items-center gap-1.5 text-green-600 text-[10px] font-normal uppercase tracking-tight">
                              <span>Ready</span>
                              <CheckCircle2 className="w-3.5 h-3.5" />
                            </div>
                          ) : (
                            <div className={`flex items-center gap-1.5 text-[10px] font-normal uppercase tracking-tight
                              ${hasConflict ? 'text-amber-500' : 'text-red-400'}
                            `}>
                              <span>{hasConflict ? 'Conflict' : 'Pending'}</span>
                              {hasConflict ? <AlertTriangle className="w-3.5 h-3.5" /> : <AlertCircle className="w-3.5 h-3.5" />}
                            </div>
                          )}
                        </div>
                      </td>
                    </tr>
                  );
                })}
              </tbody>
            </table>
          </div>
        ) : (
          <div className="space-y-6 animate-in fade-in slide-in-from-bottom-2 duration-300">
            {/* Configuration Rules Section */}
            <div className="bg-white border border-gray-100 rounded-[3px] overflow-hidden">
              <div className="bg-gray-50/80 px-6 py-4 border-b border-gray-100">
                <div className="flex items-center gap-3">
                  <div className="w-8 h-8 bg-[#2580D3] rounded-[3px] flex items-center justify-center">
                    <ShieldCheck className="w-4 h-4 text-white" />
                  </div>
                  <div>
                    <h3 className="text-[13px] font-normal text-gray-900">Auto-Assignment Configuration</h3>
                    <p className="text-[10px] text-[#94989C] mt-0.5">Configure evaluator mapping rules for each permission level</p>
                  </div>
                </div>
              </div>

              <div className="p-6 space-y-6">
                {/* Staff Rules */}
                <div className="border border-gray-100 rounded-[3px] overflow-hidden">
                  <div className="bg-gray-50 px-4 py-3 border-b border-gray-100">
                    <div className="flex items-center gap-2">
                      <div className="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <span className="text-[9px] font-normal text-gray-600">01</span>
                      </div>
                      <span className="text-[11px] font-normal text-gray-900 uppercase tracking-widest">Staff Level Configuration</span>
                    </div>
                  </div>
                  <div className="p-4 bg-white space-y-4">
                    <div className="grid grid-cols-2 gap-4">
                      <div>
                        <label className="block text-[10px] font-normal text-gray-500 uppercase tracking-widest mb-2">1st Evaluator Rule</label>
                        <div className="relative">
                          <select className="w-full bg-gray-50 border border-gray-100 rounded-[3px] px-3 py-2 text-[11px] font-normal appearance-none cursor-pointer focus:border-[#2580D3] outline-none">
                            <option value="team-leader-same-team">Team Leader (Same Team)</option>
                            <option value="manager">Direct Manager</option>
                            <option value="general-manager">General Manager</option>
                          </select>
                          <ChevronDown className="w-3 h-3 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" />
                        </div>
                        <p className="text-[9px] text-[#94989C] mt-1.5">Primary evaluator assignment logic</p>
                      </div>
                      <div>
                        <label className="block text-[10px] font-normal text-gray-500 uppercase tracking-widest mb-2">2nd Evaluator Rule</label>
                        <div className="relative">
                          <select className="w-full bg-gray-50 border border-gray-100 rounded-[3px] px-3 py-2 text-[11px] font-normal appearance-none cursor-pointer focus:border-[#2580D3] outline-none">
                            <option value="manager">Department Manager</option>
                            <option value="general-manager">General Manager</option>
                            <option value="admin">System Admin</option>
                          </select>
                          <ChevronDown className="w-3 h-3 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" />
                        </div>
                        <p className="text-[9px] text-[#94989C] mt-1.5">Secondary evaluator assignment logic</p>
                      </div>
                    </div>
                    <div className="flex items-center gap-2 p-3 bg-blue-50/50 border border-blue-100 rounded-[3px]">
                      <AlertCircle className="w-3.5 h-3.5 text-blue-600 shrink-0" />
                      <span className="text-[10px] text-gray-600">If multiple Team Leaders exist in the same team, system will flag for manual assignment</span>
                    </div>
                  </div>
                </div>

                {/* Team Leader Rules */}
                <div className="border border-gray-100 rounded-[3px] overflow-hidden">
                  <div className="bg-gray-50 px-4 py-3 border-b border-gray-100">
                    <div className="flex items-center gap-2">
                      <div className="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                        <span className="text-[9px] font-normal text-blue-600">02</span>
                      </div>
                      <span className="text-[11px] font-normal text-gray-900 uppercase tracking-widest">Team Leader Configuration</span>
                    </div>
                  </div>
                  <div className="p-4 bg-white space-y-4">
                    <div className="grid grid-cols-2 gap-4">
                      <div>
                        <label className="block text-[10px] font-normal text-gray-500 uppercase tracking-widest mb-2">1st Evaluator Rule</label>
                        <div className="relative">
                          <select className="w-full bg-gray-50 border border-gray-100 rounded-[3px] px-3 py-2 text-[11px] font-normal appearance-none cursor-pointer focus:border-[#2580D3] outline-none">
                            <option value="manager">Department Manager</option>
                            <option value="general-manager">General Manager</option>
                            <option value="admin">System Admin</option>
                          </select>
                          <ChevronDown className="w-3 h-3 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" />
                        </div>
                      </div>
                      <div>
                        <label className="block text-[10px] font-normal text-gray-500 uppercase tracking-widest mb-2">2nd Evaluator Rule</label>
                        <div className="relative">
                          <select className="w-full bg-gray-50 border border-gray-100 rounded-[3px] px-3 py-2 text-[11px] font-normal appearance-none cursor-pointer focus:border-[#2580D3] outline-none">
                            <option value="general-manager">General Manager</option>
                            <option value="admin">System Admin</option>
                            <option value="none">None</option>
                          </select>
                          <ChevronDown className="w-3 h-3 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                {/* Manager Rules */}
                <div className="border border-gray-100 rounded-[3px] overflow-hidden">
                  <div className="bg-gray-50 px-4 py-3 border-b border-gray-100">
                    <div className="flex items-center gap-2">
                      <div className="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center">
                        <span className="text-[9px] font-normal text-green-600">03</span>
                      </div>
                      <span className="text-[11px] font-normal text-gray-900 uppercase tracking-widest">Manager Configuration</span>
                    </div>
                  </div>
                  <div className="p-4 bg-white space-y-4">
                    <div className="grid grid-cols-2 gap-4">
                      <div>
                        <label className="block text-[10px] font-normal text-gray-500 uppercase tracking-widest mb-2">1st Evaluator Rule</label>
                        <div className="relative">
                          <select className="w-full bg-gray-50 border border-gray-100 rounded-[3px] px-3 py-2 text-[11px] font-normal appearance-none cursor-pointer focus:border-[#2580D3] outline-none">
                            <option value="general-manager">General Manager</option>
                            <option value="admin">System Admin</option>
                          </select>
                          <ChevronDown className="w-3 h-3 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" />
                        </div>
                      </div>
                      <div>
                        <label className="block text-[10px] font-normal text-gray-500 uppercase tracking-widest mb-2">2nd Evaluator Rule</label>
                        <div className="relative">
                          <select className="w-full bg-gray-50 border border-gray-100 rounded-[3px] px-3 py-2 text-[11px] font-normal appearance-none cursor-pointer focus:border-[#2580D3] outline-none">
                            <option value="admin">System Admin</option>
                            <option value="none">None</option>
                          </select>
                          <ChevronDown className="w-3 h-3 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                {/* General Manager Rules */}
                <div className="border border-gray-100 rounded-[3px] overflow-hidden">
                  <div className="bg-gray-50 px-4 py-3 border-b border-gray-100">
                    <div className="flex items-center gap-2">
                      <div className="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center">
                        <span className="text-[9px] font-normal text-purple-600">04</span>
                      </div>
                      <span className="text-[11px] font-normal text-gray-900 uppercase tracking-widest">General Manager Configuration</span>
                    </div>
                  </div>
                  <div className="p-4 bg-white space-y-4">
                    <div className="grid grid-cols-2 gap-4">
                      <div>
                        <label className="block text-[10px] font-normal text-gray-500 uppercase tracking-widest mb-2">1st Evaluator Rule</label>
                        <div className="relative">
                          <select className="w-full bg-gray-50 border border-gray-100 rounded-[3px] px-3 py-2 text-[11px] font-normal appearance-none cursor-pointer focus:border-[#2580D3] outline-none">
                            <option value="admin">System Admin</option>
                          </select>
                          <ChevronDown className="w-3 h-3 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" />
                        </div>
                      </div>
                      <div>
                        <label className="block text-[10px] font-normal text-gray-500 uppercase tracking-widest mb-2">2nd Evaluator Rule</label>
                        <div className="relative">
                          <select disabled className="w-full bg-gray-100 border border-gray-100 rounded-[3px] px-3 py-2 text-[11px] font-normal appearance-none cursor-not-allowed text-gray-400">
                            <option value="none">Not Applicable</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                {/* Admin Rules */}
                <div className="border border-gray-100 rounded-[3px] overflow-hidden">
                  <div className="bg-gray-50 px-4 py-3 border-b border-gray-100">
                    <div className="flex items-center gap-2">
                      <div className="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center">
                        <span className="text-[9px] font-normal text-purple-600">05</span>
                      </div>
                      <span className="text-[11px] font-normal text-gray-900 uppercase tracking-widest">System Admin Configuration</span>
                    </div>
                  </div>
                  <div className="p-4 bg-white">
                    <div className="flex items-center gap-2 p-3 bg-purple-50/50 border border-purple-100 rounded-[3px]">
                      <Info className="w-3.5 h-3.5 text-purple-600 shrink-0" />
                      <span className="text-[10px] text-gray-600">System Admins do not require evaluators and are excluded from auto-assignment</span>
                    </div>
                  </div>
                </div>
              </div>

              {/* Action Footer */}
              <div className="bg-gray-50 px-6 py-4 border-t border-gray-100 flex items-center justify-between">
                <div className="flex items-center gap-2">
                  <CheckCircle2 className="w-4 h-4 text-green-600" />
                  <span className="text-[11px] text-gray-600">Configuration ready for {selectedEmployees.length} employees</span>
                </div>
                <button 
                  onClick={() => {
                    autoAssign();
                    setTimeout(() => setActiveTab('assignment'), 500);
                  }}
                  className="px-6 py-2.5 bg-[#2580D3] text-white rounded-[3px] font-normal text-[12px] hover:bg-[#1e6bb3] transition-all flex items-center gap-2 shadow-sm active:scale-95"
                >
                  <UserPlus className="w-4 h-4" />
                  Run Auto-Assignment
                  <ArrowRight className="w-3.5 h-3.5" />
                </button>
              </div>
            </div>
          </div>
        )}
      </div>
    </div>
  );
}
