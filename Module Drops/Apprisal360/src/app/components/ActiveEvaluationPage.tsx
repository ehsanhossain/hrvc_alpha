import React, { useState } from "react";
import { 
  Play, 
  Pause, 
  CheckCircle2, 
  Clock, 
  Users, 
  TrendingUp, 
  Calendar,
  BarChart3,
  ChevronRight,
  Eye,
  Settings,
  StopCircle,
  AlertCircle,
  Building2,
  MoreHorizontal,
  Search,
  Filter,
  Download
} from "lucide-react";
import { TopHeader } from "./TopHeader";
import { motion } from "motion/react";

interface Company {
  id: string;
  name: string;
  logo?: string;
  activeEvaluations: number;
  runningCount: number;
  pausedCount: number;
  pendingCount: number;
  totalEmployees: number;
}

interface ActiveEvaluation {
  id: string;
  name: string;
  period: string;
  startDate: string;
  endDate: string;
  status: 'Running' | 'Paused' | 'Pending';
  progress: number;
  totalEmployees: number;
  completedEvaluations: number;
  companyId: string;
  type: string;
}

const MOCK_COMPANIES: Company[] = [
  {
    id: "c1",
    name: "Nexus Holdings",
    activeEvaluations: 2,
    runningCount: 2,
    pausedCount: 0,
    pendingCount: 0,
    totalEmployees: 450
  },
  {
    id: "c2",
    name: "Quantum Solutions",
    activeEvaluations: 1,
    runningCount: 0,
    pausedCount: 1,
    pendingCount: 0,
    totalEmployees: 320
  },
  {
    id: "c3",
    name: "Apex Global",
    activeEvaluations: 1,
    runningCount: 1,
    pausedCount: 0,
    pendingCount: 0,
    totalEmployees: 120
  },
  {
    id: "c4",
    name: "Stellar Tech",
    activeEvaluations: 1,
    runningCount: 0,
    pausedCount: 0,
    pendingCount: 1,
    totalEmployees: 280
  }
];

const MOCK_ACTIVE_EVALUATIONS: ActiveEvaluation[] = [
  {
    id: "eval_001",
    name: "Q1 2026 Performance Review",
    period: "January - March 2026",
    startDate: "2026-01-15",
    endDate: "2026-02-15",
    status: "Running",
    progress: 67,
    totalEmployees: 450,
    completedEvaluations: 302,
    companyId: "c1",
    type: "Quarterly Review"
  },
  {
    id: "eval_001b",
    name: "Leadership Development Assessment",
    period: "January - February 2026",
    startDate: "2026-01-10",
    endDate: "2026-02-10",
    status: "Running",
    progress: 45,
    totalEmployees: 85,
    completedEvaluations: 38,
    companyId: "c1",
    type: "Leadership Review"
  },
  {
    id: "eval_002",
    name: "Sales Team Mid-Year Assessment",
    period: "H1 2026",
    startDate: "2026-01-20",
    endDate: "2026-02-20",
    status: "Running",
    progress: 34,
    totalEmployees: 120,
    completedEvaluations: 41,
    companyId: "c3",
    type: "Department Review"
  },
  {
    id: "eval_003",
    name: "Annual Leadership Evaluation 2026",
    period: "Full Year 2025",
    startDate: "2026-02-01",
    endDate: "2026-02-28",
    status: "Paused",
    progress: 12,
    totalEmployees: 85,
    completedEvaluations: 10,
    companyId: "c2",
    type: "Leadership Review"
  },
  {
    id: "eval_004",
    name: "New Hire Probation Review",
    period: "December 2025 Hires",
    startDate: "2026-02-05",
    endDate: "2026-02-12",
    status: "Pending",
    progress: 0,
    totalEmployees: 24,
    completedEvaluations: 0,
    companyId: "c4",
    type: "Probation Review"
  }
];

export function ActiveEvaluationPage() {
  const [selectedCompany, setSelectedCompany] = useState<Company | null>(null);
  const [selectedStatus, setSelectedStatus] = useState<'All' | 'Running' | 'Paused' | 'Pending'>('All');
  const [searchQuery, setSearchQuery] = useState("");

  // If no company selected, show company list
  if (!selectedCompany) {
    return (
      <div className="flex-1 flex flex-col h-screen overflow-hidden bg-[#F4F6F9] font-normal">
        <TopHeader />
        
        <main className="flex-1 flex flex-col overflow-hidden">
          {/* Breadcrumbs & Header */}
          <div className="px-6 py-4 border-b border-gray-100 bg-white shrink-0">
            <div className="flex items-center justify-between">
              <div className="space-y-1">
                <div className="flex items-center gap-1.5 text-[10px] font-normal text-[#94989C] uppercase tracking-widest">
                  <span>Evaluations</span>
                  <ChevronRight className="w-2.5 h-2.5" />
                  <span className="text-[#2580D3]">Active Cycles</span>
                </div>
                <h1 className="text-[20px] font-normal text-gray-900 tracking-tight">Active Evaluation Cycles</h1>
              </div>
            </div>
          </div>

          {/* Company Selection Grid */}
          <div className="flex-1 overflow-y-auto no-scrollbar p-6">
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
              {MOCK_COMPANIES.map((company) => (
                <motion.button
                  key={company.id}
                  onClick={() => setSelectedCompany(company)}
                  initial={{ opacity: 0, y: 10 }}
                  animate={{ opacity: 1, y: 0 }}
                  whileHover={{ y: -2 }}
                  className="bg-white border border-gray-100 rounded-[3px] p-5 text-left hover:border-[#2580D3]/50 hover:shadow-sm transition-all"
                >
                  <div className="flex items-start justify-between mb-4">
                    <div className="flex items-center gap-3">
                      <div className="w-10 h-10 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0">
                        <span className="text-[12px] font-normal text-blue-600">
                          {company.name.split(' ').map(n => n[0]).join('')}
                        </span>
                      </div>
                      <div>
                        <h3 className="text-[14px] font-normal text-gray-900">{company.name}</h3>
                        <p className="text-[10px] text-[#94989C]">{company.totalEmployees} employees</p>
                      </div>
                    </div>
                    <ChevronRight className="w-4 h-4 text-gray-300" />
                  </div>

                  <div className="space-y-3">
                    <div className="flex items-center justify-between pb-3 border-b border-gray-50">
                      <span className="text-[11px] text-[#94989C]">Active Evaluations</span>
                      <span className="text-[16px] font-normal text-gray-900">{company.activeEvaluations}</span>
                    </div>

                    <div className="grid grid-cols-3 gap-2">
                      {company.runningCount > 0 && (
                        <div className="px-2 py-1.5 bg-green-50/50 rounded-[3px] border border-green-100">
                          <div className="text-[10px] text-green-600 flex items-center gap-1">
                            <div className="w-1.5 h-1.5 bg-green-500 rounded-full" />
                            {company.runningCount} Running
                          </div>
                        </div>
                      )}
                      {company.pausedCount > 0 && (
                        <div className="px-2 py-1.5 bg-orange-50/50 rounded-[3px] border border-orange-100">
                          <div className="text-[10px] text-orange-600 flex items-center gap-1">
                            <Pause className="w-3 h-3" />
                            {company.pausedCount} Paused
                          </div>
                        </div>
                      )}
                      {company.pendingCount > 0 && (
                        <div className="px-2 py-1.5 bg-gray-50/50 rounded-[3px] border border-gray-100">
                          <div className="text-[10px] text-gray-600 flex items-center gap-1">
                            <Clock className="w-3 h-3" />
                            {company.pendingCount} Pending
                          </div>
                        </div>
                      )}
                    </div>
                  </div>
                </motion.button>
              ))}
            </div>
          </div>
        </main>
      </div>
    );
  }

  // Company selected - show evaluations for that company in table format
  const filteredEvaluations = MOCK_ACTIVE_EVALUATIONS
    .filter(e => e.companyId === selectedCompany.id)
    .filter(e => selectedStatus === 'All' || e.status === selectedStatus)
    .filter(e => e.name.toLowerCase().includes(searchQuery.toLowerCase()));

  const runningCount = MOCK_ACTIVE_EVALUATIONS.filter(e => e.companyId === selectedCompany.id && e.status === 'Running').length;
  const pausedCount = MOCK_ACTIVE_EVALUATIONS.filter(e => e.companyId === selectedCompany.id && e.status === 'Paused').length;

  return (
    <div className="flex-1 flex flex-col h-screen overflow-hidden bg-[#F4F6F9] font-normal">
      <TopHeader />
      
      <main className="flex-1 flex flex-col overflow-hidden">
        {/* Breadcrumbs & Header */}
        <div className="px-6 py-4 border-b border-gray-100 bg-white shrink-0">
          <div className="flex items-center justify-between">
            <div className="space-y-1">
              <div className="flex items-center gap-1.5 text-[10px] font-normal text-[#94989C] uppercase tracking-widest">
                <button 
                  onClick={() => setSelectedCompany(null)}
                  className="hover:text-[#2580D3] transition-colors"
                >
                  Evaluations
                </button>
                <ChevronRight className="w-2.5 h-2.5" />
                <button 
                  onClick={() => setSelectedCompany(null)}
                  className="hover:text-[#2580D3] transition-colors"
                >
                  Active Cycles
                </button>
                <ChevronRight className="w-2.5 h-2.5" />
                <span className="text-[#2580D3]">{selectedCompany.name}</span>
              </div>
              <h1 className="text-[20px] font-normal text-gray-900 tracking-tight">Active Evaluation Cycles</h1>
            </div>

            <div className="flex items-center gap-2">
              {runningCount > 0 && (
                <div className="flex items-center gap-1.5 px-3 py-1.5 bg-green-50/50 border border-green-100 rounded-[3px]">
                  <div className="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse" />
                  <span className="text-[11px] text-green-700 font-normal">{runningCount} Running</span>
                </div>
              )}
              {pausedCount > 0 && (
                <div className="flex items-center gap-1.5 px-3 py-1.5 bg-orange-50/50 border border-orange-100 rounded-[3px]">
                  <Pause className="w-3 h-3 text-orange-600" />
                  <span className="text-[11px] text-orange-700 font-normal">{pausedCount} Paused</span>
                </div>
              )}
            </div>
          </div>
        </div>

        {/* Filter Tabs */}
        <div className="px-6 py-3 bg-white border-b border-gray-100 shrink-0">
          <div className="flex items-center gap-2">
            {(['All', 'Running', 'Paused', 'Pending'] as const).map((status) => (
              <button
                key={status}
                onClick={() => setSelectedStatus(status)}
                className={`px-3 py-1.5 rounded-[3px] text-[11px] font-normal uppercase tracking-wider transition-all ${
                  selectedStatus === status
                    ? 'bg-[#2580D3] text-white'
                    : 'bg-gray-50 text-gray-600 hover:bg-gray-100'
                }`}
              >
                {status}
              </button>
            ))}
          </div>
        </div>

        {/* Table Content */}
        <div className="flex-1 overflow-y-auto no-scrollbar p-6">
          {/* Search Bar */}
          <div className="mb-4 flex items-center justify-between">
            <div className="relative w-64">
              <Search className="absolute left-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" />
              <input 
                type="text"
                placeholder="Search evaluations..."
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                className="w-full pl-8 pr-4 py-1.5 bg-white border border-gray-100 rounded-[3px] text-[12px] focus:border-[#2580D3] outline-none transition-all"
              />
            </div>
            <div className="flex items-center gap-2">
              <button className="px-3 py-1.5 bg-white border border-gray-100 rounded-[3px] text-[11px] flex items-center gap-2 text-gray-600 hover:bg-gray-50">
                <Download className="w-3 h-3" />
                Export
              </button>
            </div>
          </div>

          {/* Evaluation Table */}
          <div className="bg-white border border-gray-100 rounded-[3px] overflow-hidden shadow-sm">
            <div className="overflow-x-auto no-scrollbar">
              <table className="w-full text-left border-collapse min-w-[1200px]">
                <thead>
                  <tr className="bg-gray-50/80 border-b border-gray-100">
                    <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest">Evaluation Name</th>
                    <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest">Type</th>
                    <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest">Period</th>
                    <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">Status</th>
                    <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">Total Staff</th>
                    <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">Completed</th>
                    <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">Progress</th>
                    <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-right">Actions</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-gray-50">
                  {filteredEvaluations.map((evaluation) => (
                    <tr key={evaluation.id} className="hover:bg-gray-50/50 transition-colors group">
                      <td className="px-6 py-4">
                        <div>
                          <h4 className="text-[13px] font-normal text-gray-900 leading-tight mb-0.5">{evaluation.name}</h4>
                          <div className="flex items-center gap-1.5 text-[10px] text-[#94989C]">
                            <Calendar className="w-3 h-3" />
                            {new Date(evaluation.startDate).toLocaleDateString('en-GB', { day: '2-digit', month: 'short' })} - {new Date(evaluation.endDate).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' })}
                          </div>
                        </div>
                      </td>
                      <td className="px-6 py-4">
                        <span className="px-2 py-0.5 bg-blue-50/50 text-blue-700 text-[10px] rounded-[2px] border border-blue-100 font-normal">
                          {evaluation.type}
                        </span>
                      </td>
                      <td className="px-6 py-4 text-[12px] text-gray-600 font-normal">
                        {evaluation.period}
                      </td>
                      <td className="px-6 py-4 text-center">
                        <span className={`inline-flex items-center gap-1.5 px-2 py-0.5 rounded-[2px] text-[9px] font-normal uppercase tracking-wider border ${
                          evaluation.status === 'Running' ? 'bg-green-50 text-green-600 border-green-100' :
                          evaluation.status === 'Paused' ? 'bg-orange-50 text-orange-600 border-orange-100' :
                          'bg-gray-50 text-gray-600 border-gray-100'
                        }`}>
                          {evaluation.status === 'Running' && <div className="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse" />}
                          {evaluation.status === 'Paused' && <Pause className="w-3 h-3" />}
                          {evaluation.status === 'Pending' && <Clock className="w-3 h-3" />}
                          {evaluation.status}
                        </span>
                      </td>
                      <td className="px-6 py-4 text-center text-[12px] text-gray-900 font-normal">
                        {evaluation.totalEmployees}
                      </td>
                      <td className="px-6 py-4 text-center text-[12px] text-green-700 font-normal">
                        {evaluation.completedEvaluations}
                      </td>
                      <td className="px-6 py-4">
                        <div className="flex items-center gap-2">
                          <div className="flex-1 h-2 bg-gray-100 rounded-full overflow-hidden">
                            <motion.div 
                              initial={{ width: 0 }}
                              animate={{ width: `${evaluation.progress}%` }}
                              transition={{ duration: 0.5, ease: "easeOut" }}
                              className={`h-full rounded-full ${
                                evaluation.status === 'Running' ? 'bg-green-500' :
                                evaluation.status === 'Paused' ? 'bg-orange-400' :
                                'bg-gray-300'
                              }`}
                            />
                          </div>
                          <span className="text-[10px] text-gray-600 font-normal w-8 text-right">{evaluation.progress}%</span>
                        </div>
                      </td>
                      <td className="px-6 py-4">
                        <div className="flex items-center justify-end gap-1">
                          <button className="p-1.5 text-gray-400 hover:text-[#2580D3] hover:bg-blue-50 rounded-[3px] transition-all">
                            <Eye className="w-3.5 h-3.5" />
                          </button>
                          <button className="p-1.5 text-gray-400 hover:text-gray-900 hover:bg-gray-50 rounded-[3px] transition-all">
                            <Settings className="w-3.5 h-3.5" />
                          </button>
                          {evaluation.status === 'Running' && (
                            <button className="p-1.5 text-gray-400 hover:text-orange-600 hover:bg-orange-50 rounded-[3px] transition-all">
                              <Pause className="w-3.5 h-3.5" />
                            </button>
                          )}
                          {evaluation.status === 'Paused' && (
                            <button className="p-1.5 text-gray-400 hover:text-green-600 hover:bg-green-50 rounded-[3px] transition-all">
                              <Play className="w-3.5 h-3.5" />
                            </button>
                          )}
                          <button className="p-1.5 text-gray-400 hover:text-gray-900 hover:bg-gray-50 rounded-[3px] transition-all">
                            <MoreHorizontal className="w-3.5 h-3.5" />
                          </button>
                        </div>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>

            {filteredEvaluations.length === 0 && (
              <div className="flex flex-col items-center justify-center py-16">
                <div className="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                  <TrendingUp className="w-8 h-8 text-gray-300" />
                </div>
                <h3 className="text-[14px] font-normal text-gray-900 mb-1">No evaluations found</h3>
                <p className="text-[11px] text-[#94989C]">Try adjusting your search or filters</p>
              </div>
            )}
          </div>
        </div>
      </main>
    </div>
  );
}
