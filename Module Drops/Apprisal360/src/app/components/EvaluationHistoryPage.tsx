import React, { useState } from "react";
import { 
  CheckCircle2, 
  Calendar,
  Users, 
  TrendingUp, 
  ChevronRight,
  Eye,
  Download,
  BarChart3,
  Award,
  Search,
  Clock,
  Building2
} from "lucide-react";
import { TopHeader } from "./TopHeader";
import { motion } from "motion/react";

interface Company {
  id: string;
  name: string;
  completedEvaluations: number;
  totalEmployees: number;
  averageScore: number;
}

interface HistoricalEvaluation {
  id: string;
  name: string;
  period: string;
  startDate: string;
  endDate: string;
  completedDate: string;
  totalEmployees: number;
  completedEvaluations: number;
  averageScore: number;
  companyId: string;
  type: string;
  ranksDistribution: { rank: string; count: number; color: string }[];
}

const MOCK_COMPANIES: Company[] = [
  {
    id: "c1",
    name: "Nexus Holdings",
    completedEvaluations: 3,
    totalEmployees: 450,
    averageScore: 73.2
  },
  {
    id: "c2",
    name: "Quantum Solutions",
    completedEvaluations: 2,
    totalEmployees: 320,
    averageScore: 71.8
  },
  {
    id: "c3",
    name: "Apex Global",
    completedEvaluations: 2,
    totalEmployees: 120,
    averageScore: 65.2
  },
  {
    id: "c4",
    name: "Stellar Tech",
    completedEvaluations: 1,
    totalEmployees: 280,
    averageScore: 78.9
  }
];

const MOCK_HISTORICAL_EVALUATIONS: HistoricalEvaluation[] = [
  {
    id: "eval_h001",
    name: "Q4 2025 Performance Review",
    period: "October - December 2025",
    startDate: "2025-12-01",
    endDate: "2025-12-31",
    completedDate: "2025-12-31",
    totalEmployees: 450,
    completedEvaluations: 450,
    averageScore: 72.5,
    companyId: "c1",
    type: "Quarterly Review",
    ranksDistribution: [
      { rank: "A", count: 89, color: "bg-green-500" },
      { rank: "B", count: 156, color: "bg-blue-500" },
      { rank: "C", count: 142, color: "bg-yellow-500" },
      { rank: "D", count: 48, color: "bg-orange-500" },
      { rank: "F", count: 15, color: "bg-red-500" }
    ]
  },
  {
    id: "eval_h002",
    name: "Annual Review 2025",
    period: "Full Year 2025",
    startDate: "2025-11-01",
    endDate: "2025-11-30",
    completedDate: "2025-11-30",
    totalEmployees: 890,
    completedEvaluations: 887,
    averageScore: 68.3,
    companyId: "c1",
    type: "Annual Review",
    ranksDistribution: [
      { rank: "A", count: 124, color: "bg-green-500" },
      { rank: "B", count: 298, color: "bg-blue-500" },
      { rank: "C", count: 312, color: "bg-yellow-500" },
      { rank: "D", count: 108, color: "bg-orange-500" },
      { rank: "F", count: 45, color: "bg-red-500" }
    ]
  },
  {
    id: "eval_h003",
    name: "Q3 2025 Leadership Assessment",
    period: "July - September 2025",
    startDate: "2025-09-15",
    endDate: "2025-10-15",
    completedDate: "2025-10-14",
    totalEmployees: 85,
    completedEvaluations: 85,
    averageScore: 78.9,
    companyId: "c4",
    type: "Leadership Review",
    ranksDistribution: [
      { rank: "A", count: 32, color: "bg-green-500" },
      { rank: "B", count: 41, color: "bg-blue-500" },
      { rank: "C", count: 9, color: "bg-yellow-500" },
      { rank: "D", count: 2, color: "bg-orange-500" },
      { rank: "F", count: 1, color: "bg-red-500" }
    ]
  },
  {
    id: "eval_h004",
    name: "Sales Team H1 2025 Review",
    period: "January - June 2025",
    startDate: "2025-07-01",
    endDate: "2025-07-31",
    completedDate: "2025-07-29",
    totalEmployees: 120,
    completedEvaluations: 118,
    averageScore: 65.2,
    companyId: "c3",
    type: "Department Review",
    ranksDistribution: [
      { rank: "A", count: 18, color: "bg-green-500" },
      { rank: "B", count: 42, color: "bg-blue-500" },
      { rank: "C", count: 38, color: "bg-yellow-500" },
      { rank: "D", count: 14, color: "bg-orange-500" },
      { rank: "F", count: 6, color: "bg-red-500" }
    ]
  },
  {
    id: "eval_h005",
    name: "Q2 2025 Performance Review",
    period: "April - June 2025",
    startDate: "2025-06-01",
    endDate: "2025-06-30",
    completedDate: "2025-06-30",
    totalEmployees: 560,
    completedEvaluations: 560,
    averageScore: 70.8,
    companyId: "c2",
    type: "Quarterly Review",
    ranksDistribution: [
      { rank: "A", count: 112, color: "bg-green-500" },
      { rank: "B", count: 201, color: "bg-blue-500" },
      { rank: "C", count: 168, color: "bg-yellow-500" },
      { rank: "D", count: 58, color: "bg-orange-500" },
      { rank: "F", count: 21, color: "bg-red-500" }
    ]
  }
];

export function EvaluationHistoryPage() {
  const [selectedCompany, setSelectedCompany] = useState<Company | null>(null);
  const [searchQuery, setSearchQuery] = useState("");
  const [selectedType, setSelectedType] = useState<'All' | 'Quarterly Review' | 'Annual Review' | 'Department Review' | 'Leadership Review'>('All');

  const getScoreColor = (score: number) => {
    if (score >= 80) return 'text-green-600';
    if (score >= 60) return 'text-blue-600';
    if (score >= 40) return 'text-yellow-600';
    return 'text-orange-600';
  };

  const getScoreBgColor = (score: number) => {
    if (score >= 80) return 'bg-green-50/50 border-green-100';
    if (score >= 60) return 'bg-blue-50/50 border-blue-100';
    if (score >= 40) return 'bg-yellow-50/50 border-yellow-100';
    return 'bg-orange-50/50 border-orange-100';
  };

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
                  <span className="text-[#2580D3]">History</span>
                </div>
                <h1 className="text-[20px] font-normal text-gray-900 tracking-tight">Evaluation History</h1>
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
                    <div className="grid grid-cols-2 gap-3">
                      <div>
                        <div className="text-[8px] text-[#94989C] uppercase tracking-widest mb-1">Completed</div>
                        <div className="text-[16px] font-normal text-gray-900">{company.completedEvaluations}</div>
                      </div>
                      <div>
                        <div className="text-[8px] text-[#94989C] uppercase tracking-widest mb-1">Avg Score</div>
                        <div className={`text-[16px] font-normal ${getScoreColor(company.averageScore)}`}>
                          {company.averageScore.toFixed(1)}%
                        </div>
                      </div>
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

  // Company selected - show evaluations for that company
  const filteredEvaluations = MOCK_HISTORICAL_EVALUATIONS
    .filter(e => e.companyId === selectedCompany.id)
    .filter(e => {
      const matchesSearch = e.name.toLowerCase().includes(searchQuery.toLowerCase());
      const matchesType = selectedType === 'All' || e.type === selectedType;
      return matchesSearch && matchesType;
    });

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
                  History
                </button>
                <ChevronRight className="w-2.5 h-2.5" />
                <span className="text-[#2580D3]">{selectedCompany.name}</span>
              </div>
              <h1 className="text-[20px] font-normal text-gray-900 tracking-tight">Evaluation History</h1>
            </div>

            <div className="flex items-center gap-2">
              <button className="px-3 py-1.5 bg-white border border-gray-200 text-gray-700 rounded-[3px] text-[11px] font-normal hover:bg-gray-50 transition-colors flex items-center gap-2">
                <Download className="w-3.5 h-3.5" />
                Export All
              </button>
            </div>
          </div>
        </div>

        {/* Search & Filter Bar */}
        <div className="px-6 py-3 bg-white border-b border-gray-100 shrink-0">
          <div className="flex items-center justify-between gap-4">
            <div className="relative flex-1 max-w-md">
              <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" />
              <input 
                type="text"
                placeholder="Search evaluations..."
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                className="w-full pl-9 pr-4 py-2 bg-white border border-gray-200 rounded-[3px] text-[12px] focus:border-[#2580D3] outline-none transition-all"
              />
            </div>

            <div className="flex items-center gap-2">
              {(['All', 'Quarterly Review', 'Annual Review', 'Department Review', 'Leadership Review'] as const).map((type) => (
                <button
                  key={type}
                  onClick={() => setSelectedType(type)}
                  className={`px-3 py-1.5 rounded-[3px] text-[10px] font-normal uppercase tracking-wider transition-all ${
                    selectedType === type
                      ? 'bg-[#2580D3] text-white'
                      : 'bg-gray-50 text-gray-600 hover:bg-gray-100'
                  }`}
                >
                  {type}
                </button>
              ))}
            </div>
          </div>
        </div>

        {/* Evaluation List */}
        <div className="flex-1 overflow-y-auto no-scrollbar p-6">
          <div className="space-y-4">
            {filteredEvaluations.map((evaluation) => (
              <motion.div
                key={evaluation.id}
                initial={{ opacity: 0, y: 10 }}
                animate={{ opacity: 1, y: 0 }}
                className="bg-white border border-gray-100 rounded-[3px] overflow-hidden hover:border-[#2580D3]/30 transition-all"
              >
                <div className="p-5">
                  <div className="flex items-start justify-between mb-4">
                    <div className="flex-1">
                      <div className="flex items-center gap-3 mb-2">
                        <h3 className="text-[15px] font-normal text-gray-900">{evaluation.name}</h3>
                        <span className="flex items-center gap-1.5 px-2 py-0.5 bg-green-50 text-green-600 border border-green-100 rounded-[2px] text-[9px] font-normal uppercase tracking-wider">
                          <CheckCircle2 className="w-3 h-3" />
                          Completed
                        </span>
                        <span className="px-2 py-0.5 bg-gray-50 text-gray-600 border border-gray-100 rounded-[2px] text-[9px] font-normal uppercase tracking-wider">
                          {evaluation.type}
                        </span>
                      </div>
                      <div className="flex items-center gap-4 text-[11px] text-[#94989C]">
                        <div className="flex items-center gap-1.5">
                          <Calendar className="w-3 h-3" />
                          Completed: {new Date(evaluation.completedDate).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' })}
                        </div>
                        <div className="flex items-center gap-1.5">
                          <Clock className="w-3 h-3" />
                          Period: {evaluation.period}
                        </div>
                      </div>
                    </div>

                    <div className="flex items-center gap-2">
                      <button className="p-2 text-gray-400 hover:text-[#2580D3] hover:bg-blue-50 rounded-[3px] transition-all">
                        <Eye className="w-4 h-4" />
                      </button>
                      <button className="p-2 text-gray-400 hover:text-gray-900 hover:bg-gray-50 rounded-[3px] transition-all">
                        <Download className="w-4 h-4" />
                      </button>
                    </div>
                  </div>

                  {/* Stats Grid */}
                  <div className="grid grid-cols-4 gap-3 mb-4">
                    <div className="p-3 bg-gray-50/50 rounded-[3px]">
                      <div className="flex items-center gap-2 mb-1">
                        <Users className="w-3.5 h-3.5 text-gray-400" />
                        <span className="text-[8px] text-[#94989C] uppercase tracking-widest">Evaluated</span>
                      </div>
                      <div className="text-[14px] font-normal text-gray-900">
                        {evaluation.completedEvaluations} / {evaluation.totalEmployees}
                      </div>
                    </div>
                    <div className={`p-3 rounded-[3px] border ${getScoreBgColor(evaluation.averageScore)}`}>
                      <div className="flex items-center gap-2 mb-1">
                        <TrendingUp className="w-3.5 h-3.5 text-gray-400" />
                        <span className="text-[8px] text-[#94989C] uppercase tracking-widest">Avg Score</span>
                      </div>
                      <div className={`text-[14px] font-normal ${getScoreColor(evaluation.averageScore)}`}>
                        {evaluation.averageScore.toFixed(1)}%
                      </div>
                    </div>
                    <div className="p-3 bg-green-50/30 rounded-[3px]">
                      <div className="flex items-center gap-2 mb-1">
                        <Award className="w-3.5 h-3.5 text-green-600" />
                        <span className="text-[8px] text-[#94989C] uppercase tracking-widest">Top Rank</span>
                      </div>
                      <div className="text-[14px] font-normal text-green-700">
                        {evaluation.ranksDistribution[0].count} ({((evaluation.ranksDistribution[0].count / evaluation.totalEmployees) * 100).toFixed(1)}%)
                      </div>
                    </div>
                    <div className="p-3 bg-blue-50/30 rounded-[3px]">
                      <div className="flex items-center gap-2 mb-1">
                        <BarChart3 className="w-3.5 h-3.5 text-blue-600" />
                        <span className="text-[8px] text-[#94989C] uppercase tracking-widest">Completion</span>
                      </div>
                      <div className="text-[14px] font-normal text-blue-700">
                        {((evaluation.completedEvaluations / evaluation.totalEmployees) * 100).toFixed(0)}%
                      </div>
                    </div>
                  </div>

                  {/* Rank Distribution */}
                  <div className="mb-4">
                    <div className="text-[9px] text-[#94989C] uppercase tracking-widest mb-2">Rank Distribution</div>
                    <div className="flex items-center gap-1 h-2 rounded-full overflow-hidden bg-gray-100">
                      {evaluation.ranksDistribution.map((rank, idx) => {
                        const percentage = (rank.count / evaluation.totalEmployees) * 100;
                        return (
                          <div
                            key={idx}
                            className={`h-full ${rank.color} transition-all`}
                            style={{ width: `${percentage}%` }}
                            title={`${rank.rank}: ${rank.count} (${percentage.toFixed(1)}%)`}
                          />
                        );
                      })}
                    </div>
                    <div className="flex items-center justify-between mt-2">
                      {evaluation.ranksDistribution.map((rank, idx) => (
                        <div key={idx} className="flex items-center gap-1.5">
                          <div className={`w-2 h-2 ${rank.color} rounded-[2px]`} />
                          <span className="text-[10px] text-gray-600">{rank.rank}: {rank.count}</span>
                        </div>
                      ))}
                    </div>
                  </div>
                </div>
              </motion.div>
            ))}
          </div>

          {filteredEvaluations.length === 0 && (
            <div className="flex flex-col items-center justify-center py-16">
              <div className="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <BarChart3 className="w-8 h-8 text-gray-300" />
              </div>
              <h3 className="text-[14px] font-normal text-gray-900 mb-1">No evaluations found</h3>
              <p className="text-[11px] text-[#94989C]">Try adjusting your search or filters</p>
            </div>
          )}
        </div>
      </main>
    </div>
  );
}
