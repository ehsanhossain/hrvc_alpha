import React, { useState } from "react";
import { 
  Network, 
  ChevronRight, 
  Search, 
  Building2, 
  ShieldCheck, 
  Users, 
  GitBranch,
  ArrowLeft,
  Settings2,
  Info
} from "lucide-react";
import { MOCK_COMPANIES, MOCK_EMPLOYEES } from "@/app/mockData";
import { TopHeader } from "./TopHeader";
import permissionMapImage from 'figma:asset/3478f6d3952991a7ae9d039169a04e9402022744.png';

interface Props {
  onBack: () => void;
}

export function OrganizationMapPage({ onBack }: Props) {
  const [searchTerm, setSearchTerm] = useState("");

  const staff = MOCK_EMPLOYEES.filter(e => e.permissionLevel === 'Staff');
  const tl = MOCK_EMPLOYEES.filter(e => e.permissionLevel === 'Team Leader');
  const mgr = MOCK_EMPLOYEES.filter(e => e.permissionLevel === 'Manager');
  const gm = MOCK_EMPLOYEES.filter(e => e.permissionLevel === 'General Manager');
  const admin = MOCK_EMPLOYEES.filter(e => e.permissionLevel === 'Admin');

  return (
    <div className="flex-1 flex flex-col h-screen overflow-hidden bg-white font-normal">
      <TopHeader />
      
      <main className="flex-1 flex flex-col overflow-hidden">
        {/* Header */}
        <div className="px-6 py-4 border-b border-gray-50 flex items-center justify-between bg-white shrink-0">
          <div className="space-y-1">
            <div className="flex items-center gap-1.5 text-[10px] font-normal text-gray-400 uppercase tracking-widest">
              <span>Organization</span>
              <ChevronRight className="w-2.5 h-2.5" />
              <span className="text-[#2580D3]">Hierarchy Map</span>
            </div>
            <h1 className="text-[20px] font-normal text-gray-900 tracking-tight">Organization Evaluator Mapping</h1>
          </div>

          <div className="flex items-center gap-3">
            <button 
              onClick={onBack}
              className="px-3 py-1.5 text-gray-500 font-normal text-[12px] flex items-center gap-2 bg-white border border-gray-100 rounded-[3px] hover:bg-gray-50 transition-all"
            >
              <ArrowLeft className="w-3.5 h-3.5" />
              Exit Management
            </button>
          </div>
        </div>

        <div className="flex-1 overflow-y-auto no-scrollbar bg-gray-50/30 p-8 space-y-8">
          {/* Logic Summary */}
          <section className="bg-white border border-gray-100 rounded-[3px] p-8 shadow-sm">
            <div className="flex items-center justify-between mb-10">
              <div>
                <h2 className="text-[16px] font-normal text-gray-900">Auto-Evaluator Logic Flow</h2>
                <p className="text-[11px] text-gray-400 font-normal mt-1">Global permission-based reporting hierarchy</p>
              </div>
              <div className="flex items-center gap-2">
                <span className="px-3 py-1 bg-green-50 text-green-600 text-[10px] rounded-[2px] border border-green-100 font-normal uppercase tracking-widest">
                  Live Sync Active
                </span>
              </div>
            </div>

            <div className="max-w-4xl mx-auto">
              <img src={permissionMapImage} alt="Logic Flow" className="w-full h-auto object-contain opacity-90" />
            </div>
          </section>

          {/* Breakdown by Level */}
          <div className="grid grid-cols-5 gap-4">
            {[
              { label: 'Staff', count: staff.length, color: 'gray' },
              { label: 'Team Leader', count: tl.length, color: 'blue' },
              { label: 'Manager', count: mgr.length, color: 'green' },
              { label: 'General Mgr', count: gm.length, color: 'indigo' },
              { label: 'System Admin', count: admin.length, color: 'purple' },
            ].map((level) => (
              <div key={level.label} className="bg-white border border-gray-100 rounded-[3px] p-4 text-center">
                <div className="text-[10px] font-normal text-gray-400 uppercase tracking-widest mb-2">{level.label}</div>
                <div className="text-[24px] font-normal text-gray-900 leading-none">{level.count}</div>
                <div className="text-[9px] text-gray-400 mt-2">Active Users</div>
              </div>
            ))}
          </div>

          {/* Conflict & Assignment Rules */}
          <div className="grid grid-cols-2 gap-6">
            <div className="bg-white border border-gray-100 rounded-[3px] overflow-hidden">
              <div className="px-4 py-3 border-b border-gray-50 bg-gray-50/30 flex items-center justify-between">
                <div className="flex items-center gap-2">
                  <GitBranch className="w-3.5 h-3.5 text-gray-400" />
                  <span className="text-[11px] font-normal text-gray-700 uppercase tracking-widest">Mapping Rules</span>
                </div>
              </div>
              <div className="p-4 space-y-4">
                {[
                  { level: 'Staff', p1: 'Team Leader', p2: 'Manager' },
                  { level: 'Team Leader', p1: 'Manager', p2: 'General Manager' },
                  { level: 'Manager', p1: 'General Manager', p2: 'Admin' },
                  { level: 'General Manager', p1: 'Admin', p2: 'None' },
                ].map((rule) => (
                  <div key={rule.level} className="flex items-center gap-4 p-3 bg-gray-50/50 border border-gray-100 rounded-[2px]">
                    <div className="w-24 text-[12px] font-normal text-gray-900">{rule.level}</div>
                    <ChevronRight className="w-3 h-3 text-gray-300" />
                    <div className="flex-1 grid grid-cols-2 gap-2">
                      <div className="text-[10px] text-gray-500">1st: <span className="text-[#2580D3] font-normal">{rule.p1}</span></div>
                      <div className="text-[10px] text-gray-500">2nd: <span className="text-[#2580D3] font-normal">{rule.p2}</span></div>
                    </div>
                  </div>
                ))}
              </div>
            </div>

            <div className="bg-white border border-gray-100 rounded-[3px] overflow-hidden">
              <div className="px-4 py-3 border-b border-gray-50 bg-gray-50/30 flex items-center justify-between">
                <div className="flex items-center gap-2">
                  <ShieldCheck className="w-3.5 h-3.5 text-gray-400" />
                  <span className="text-[11px] font-normal text-gray-700 uppercase tracking-widest">Edge Case Logic</span>
                </div>
              </div>
              <div className="p-6 space-y-6">
                <div className="flex items-start gap-4">
                  <div className="w-8 h-8 bg-amber-50 rounded-[3px] flex items-center justify-center shrink-0">
                    <Info className="w-4 h-4 text-amber-500" />
                  </div>
                  <div>
                    <h4 className="text-[12px] font-normal text-gray-900 mb-1">Multiple Team Leaders</h4>
                    <p className="text-[11px] text-gray-500 leading-relaxed">
                      If a team has {'>'}1 Team Leader, the system enters "Conflict State". Auto-assignment is paused for those staff members until a primary TL is manually verified.
                    </p>
                  </div>
                </div>
                <div className="flex items-start gap-4">
                  <div className="w-8 h-8 bg-blue-50 rounded-[3px] flex items-center justify-center shrink-0">
                    <Settings2 className="w-4 h-4 text-[#2580D3]" />
                  </div>
                  <div>
                    <h4 className="text-[12px] font-normal text-gray-900 mb-1">Vacancy Handling</h4>
                    <p className="text-[11px] text-gray-500 leading-relaxed">
                      If a specific managerial level is vacant in the organization tree, the rule defaults to the next available higher permission level automatically.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  );
}
