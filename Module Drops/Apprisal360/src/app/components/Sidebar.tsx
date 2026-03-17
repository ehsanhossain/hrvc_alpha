import React, { useState } from "react";
import { 
  LayoutDashboard, 
  Users2, 
  BarChart3, 
  GraduationCap, 
  DollarSign, 
  PieChart,
  ChevronDown,
  ChevronRight,
  Plus,
  Monitor,
  Bell,
  Settings as SettingsIcon,
  Users,
  Network,
  UserCircle,
  Clock,
  Navigation,
  FileText,
  Activity,
  ChevronLeft,
  Gift,
  History
} from "lucide-react";
import logo from "figma:asset/8751ee0b3b95082ba211dfbee5c7531bde7d4f24.png";

interface SidebarProps {
  currentPath: string;
  onNavigate: (path: string) => void;
}

export function Sidebar({ currentPath, onNavigate }: SidebarProps) {
  const [expandedSections, setExpandedSections] = useState<string[]>(['DASHBOARD', 'EVALUATION', 'COMPENSATION']);

  const toggleSection = (section: string) => {
    setExpandedSections(prev => 
      prev.includes(section) ? prev.filter(s => s !== section) : [...prev, section]
    );
  };

  const MenuItem = ({ icon: Icon, label, path, badge }: { icon: any, label: string, path: string, badge?: string }) => {
    const isActive = currentPath === path;
    return (
      <button
        onClick={() => onNavigate(path)}
        className={`w-full flex items-center justify-between px-2.5 py-1.5 rounded-[3px] transition-all group
          ${isActive 
            ? 'bg-[#2580D3] text-white' 
            : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900'}
        `}
      >
        <div className="flex items-center gap-2.5">
          <Icon className={`w-3.5 h-3.5 ${isActive ? 'text-white' : 'text-gray-400 group-hover:text-gray-600'}`} />
          <span className="text-[12px] font-normal">{label}</span>
        </div>
        {badge && (
          <span className="bg-red-500 text-white text-[9px] px-1 py-0.5 rounded-[2px]">
            {badge}
          </span>
        )}
      </button>
    );
  };

  const SectionHeader = ({ label, icon: Icon }: { label: string, icon: any }) => {
    const isExpanded = expandedSections.includes(label);
    return (
      <button
        onClick={() => toggleSection(label)}
        className="w-full flex items-center justify-between px-2.5 py-1.5 mt-2 text-gray-400 hover:text-gray-900 group"
      >
        <div className="flex items-center gap-2.5">
          <Icon className="w-3.5 h-3.5 text-gray-300 group-hover:text-gray-500" />
          <span className="text-[10px] font-normal uppercase tracking-widest">{label}</span>
        </div>
        {isExpanded ? <ChevronDown className="w-3 h-3" /> : <ChevronRight className="w-3 h-3" />}
      </button>
    );
  };

  return (
    <aside className="w-56 h-screen bg-white border-r border-gray-100 flex flex-col overflow-y-auto no-scrollbar">
      {/* Brand Selector */}
      <div className="px-3 py-4 border-b border-gray-50 mb-1">
        <button className="flex items-center gap-2.5 px-2 py-1.5 w-full hover:bg-gray-50 rounded-[3px] transition-colors group">
          <img src={logo} alt="Aprisal360" className="w-5 h-5 object-contain shrink-0" />
          <div className="text-left flex-1 min-w-0">
            <div className="text-[13px] font-normal text-gray-900 leading-tight truncate">Aprisal360</div>
            <div className="text-[10px] font-normal text-gray-500 truncate">Performance Management</div>
          </div>
          <ChevronDown className="w-3.5 h-3.5 text-gray-400 shrink-0" />
        </button>
      </div>

      <div className="flex-1 px-2 py-1 space-y-0.5">
        {/* Dashboard Section */}
        <div className="space-y-0.5">
          <SectionHeader label="DASHBOARD" icon={LayoutDashboard} />
          {expandedSections.includes('DASHBOARD') && (
            <div className="space-y-0.5 pl-1.5">
              <MenuItem icon={Monitor} label="Evaluation Hub" path="/evaluation-hub" />
              <MenuItem icon={PieChart} label="My Dashboard" path="/dashboard" />
            </div>
          )}
        </div>

        {/* Evaluation Section */}
        <div className="space-y-0.5">
          <SectionHeader label="EVALUATION" icon={BarChart3} />
          {expandedSections.includes('EVALUATION') && (
            <div className="space-y-0.5 pl-1.5">
              <MenuItem icon={LayoutDashboard} label="Evaluation Dashboard" path="/evaluation-dashboard" />
              <MenuItem icon={Navigation} label="Active Evaluation" path="/active-evaluation" />
              <MenuItem icon={Plus} label="Create Evaluation" path="/create-evaluation" />
              <MenuItem icon={History} label="History" path="/evaluation-history" />
              <MenuItem icon={SettingsIcon} label="Rank Setup" path="/rank-setup" />
              <MenuItem icon={BarChart3} label="Results & Reports" path="/results-reports" />
            </div>
          )}
        </div>

        {/* Compensation Section */}
        <div className="space-y-0.5">
          <SectionHeader label="COMPENSATION" icon={DollarSign} />
          {expandedSections.includes('COMPENSATION') && (
            <div className="space-y-0.5 pl-1.5">
              <MenuItem icon={FileText} label="Salary Sheet" path="/salary-sheet" />
              <MenuItem icon={Gift} label="Bonus" path="/bonus" />
            </div>
          )}
        </div>
      </div>

      {/* Footer Actions Removed as requested */}
    </aside>
  );
}