import React, { useState } from "react";
import {
  ChevronRight,
  Clock,
  CheckCircle2,
  AlertCircle,
  Target,
  TrendingUp,
  Calendar,
  FileText,
  Users,
  ClipboardCheck,
  ChevronDown,
  Eye,
  Edit3,
  BarChart3,
  ArrowUpRight,
  Circle,
  Minus,
  User,
  Star
} from "lucide-react";
import { TopHeader } from "./TopHeader";
import { motion } from "motion/react";

// ─── Current user context ───────────────────────────────
const CURRENT_USER = {
  id: "u_st",
  name: "Shuhei Takahashi",
  role: "Chief Operating Officer",
  department: "Executive",
  company: "Nexus Holdings",
  avatar: "https://images.unsplash.com/photo-1672685667592-0392f458f46f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwcm9mZXNzaW9uYWwlMjBtYW4lMjBwb3J0cmFpdCUyMGhlYWRzaG90fGVufDF8fHx8MTc2OTQ3OTU0MXww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral",
  permissionLevel: "General Manager" as const,
};

// ─── My own evaluations ────────────────────────────────
interface MyEvaluation {
  id: string;
  cycleName: string;
  period: string;
  type: string;
  selfEvalStatus: "Not Started" | "In Progress" | "Submitted";
  firstEvaluator: string;
  firstEvalStatus: "Pending" | "In Progress" | "Completed";
  secondEvaluator: string;
  secondEvalStatus: "Pending" | "In Progress" | "Completed";
  overallProgress: number;
  deadline: string;
  currentScore: number | null;
  pimScore: number | null;
  competencyScore: number | null;
}

const MY_EVALUATIONS: MyEvaluation[] = [
  {
    id: "me_1",
    cycleName: "Q1 2026 Performance Review",
    period: "Jan – Mar 2026",
    type: "Quarterly Review",
    selfEvalStatus: "In Progress",
    firstEvaluator: "Tony Stark",
    firstEvalStatus: "Pending",
    secondEvaluator: "Board Committee",
    secondEvalStatus: "Pending",
    overallProgress: 35,
    deadline: "2026-02-15",
    currentScore: null,
    pimScore: 78,
    competencyScore: 82,
  },
  {
    id: "me_2",
    cycleName: "Leadership Development Assessment",
    period: "Jan – Feb 2026",
    type: "Leadership Review",
    selfEvalStatus: "Submitted",
    firstEvaluator: "Tony Stark",
    firstEvalStatus: "In Progress",
    secondEvaluator: "Board Committee",
    secondEvalStatus: "Pending",
    overallProgress: 55,
    deadline: "2026-02-10",
    currentScore: 84,
    pimScore: 85,
    competencyScore: 83,
  },
];

// ─── Subordinate evaluations (as 1st / 2nd evaluator) ──
interface SubordinateEvaluation {
  id: string;
  employeeId: string;
  employeeName: string;
  employeeRole: string;
  employeeTeam: string;
  avatar: string;
  cycleName: string;
  evaluatorRole: "1st Evaluator" | "2nd Evaluator";
  selfEvalStatus: "Not Started" | "In Progress" | "Submitted";
  myReviewStatus: "Not Started" | "In Progress" | "Completed";
  deadline: string;
  selfScore: number | null;
  myScore: number | null;
}

const SUBORDINATE_EVALUATIONS: SubordinateEvaluation[] = [
  {
    id: "se_1",
    employeeId: "e_tl1",
    employeeName: "Sarah Johnson",
    employeeRole: "Team Lead",
    employeeTeam: "Enterprise Sales",
    avatar: "https://images.unsplash.com/photo-1758600587839-56ba05596c69?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwcm9mZXNzaW9uYWwlMjBhc2lhbiUyMHdvbWFuJTIwaGVhZHNob3QlMjBwb3J0cmFpdHxlbnwxfHx8fDE3NzAzNDUxNDV8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral",
    cycleName: "Q1 2026 Performance Review",
    evaluatorRole: "1st Evaluator",
    selfEvalStatus: "Submitted",
    myReviewStatus: "In Progress",
    deadline: "2026-02-20",
    selfScore: 81,
    myScore: 78,
  },
  {
    id: "se_2",
    employeeId: "e_tl2",
    employeeName: "David Lee",
    employeeRole: "Team Lead",
    employeeTeam: "Enterprise Sales",
    avatar: "https://images.unsplash.com/photo-1758518729314-b02874db8c37?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwcm9mZXNzaW9uYWwlMjB5b3VuZyUyMG1hbiUyMGNvcnBvcmF0ZSUyMGhlYWRzaG90fGVufDF8fHx8MTc3MDM0NTU5Nnww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral",
    cycleName: "Q1 2026 Performance Review",
    evaluatorRole: "1st Evaluator",
    selfEvalStatus: "In Progress",
    myReviewStatus: "Not Started",
    deadline: "2026-02-20",
    selfScore: null,
    myScore: null,
  },
  {
    id: "se_3",
    employeeId: "m_mgr1",
    employeeName: "Michael Chen",
    employeeRole: "Sales Director",
    employeeTeam: "Management",
    avatar: "https://images.unsplash.com/photo-1568585105565-e372998a195d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxjb3Jwb3JhdGUlMjBtYW4lMjBzdWl0JTIwcG9ydHJhaXQlMjBoZWFkc2hvdHxlbnwxfHx8fDE3NzAzNDU1OTh8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral",
    cycleName: "Q1 2026 Performance Review",
    evaluatorRole: "1st Evaluator",
    selfEvalStatus: "Submitted",
    myReviewStatus: "Completed",
    deadline: "2026-02-20",
    selfScore: 88,
    myScore: 85,
  },
  {
    id: "se_4",
    employeeId: "s_tl1",
    employeeName: "Frank Wright",
    employeeRole: "Team Lead",
    employeeTeam: "SMB Sales",
    avatar: "https://images.unsplash.com/photo-1610387694365-19fafcc86d86?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwcm9mZXNzaW9uYWwlMjB3b21hbiUyMGJ1c2luZXNzJTIwcG9ydHJhaXQlMjBvZmZpY2V8ZW58MXx8fHwxNzcwMzIxMDA0fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral",
    cycleName: "Leadership Development Assessment",
    evaluatorRole: "2nd Evaluator",
    selfEvalStatus: "Submitted",
    myReviewStatus: "Not Started",
    deadline: "2026-02-10",
    selfScore: 76,
    myScore: null,
  },
  {
    id: "se_5",
    employeeId: "emp_new1",
    employeeName: "Yuki Tanaka",
    employeeRole: "Senior Analyst",
    employeeTeam: "Strategy",
    avatar: "https://images.unsplash.com/photo-1765005204058-10418f5123c5?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwcm9mZXNzaW9uYWwlMjB3b21hbiUyMGhlYWRzaG90JTIwY29ycG9yYXRlfGVufDF8fHx8MTc3MDM0NTU5OHww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral",
    cycleName: "Q1 2026 Performance Review",
    evaluatorRole: "2nd Evaluator",
    selfEvalStatus: "Submitted",
    myReviewStatus: "In Progress",
    deadline: "2026-02-20",
    selfScore: 90,
    myScore: 87,
  },
];

// ─── My PIM metrics ─────────────────────────────────────
interface PIMMetric {
  id: string;
  name: string;
  type: "KFI" | "KGI" | "KPI";
  target: number;
  current: number;
  unit: string;
  trend: "up" | "down" | "flat";
}

const MY_PIM_METRICS: PIMMetric[] = [
  { id: "pm1", name: "Revenue Growth", type: "KFI", target: 1200000, current: 980000, unit: "THB", trend: "up" },
  { id: "pm2", name: "Cost Reduction", type: "KFI", target: 10, current: 7.2, unit: "%", trend: "up" },
  { id: "pm3", name: "Market Share", type: "KGI", target: 25, current: 22.5, unit: "%", trend: "up" },
  { id: "pm4", name: "Project Completion", type: "KGI", target: 90, current: 85, unit: "%", trend: "flat" },
  { id: "pm5", name: "Customer Satisfaction", type: "KPI", target: 90, current: 92, unit: "%", trend: "up" },
  { id: "pm6", name: "Response Time", type: "KPI", target: 2, current: 1.8, unit: "hrs", trend: "up" },
];

// ─── Helpers ─────────────────────────────────────────────
function daysUntil(dateStr: string) {
  const diff = new Date(dateStr).getTime() - new Date("2026-02-06").getTime();
  return Math.ceil(diff / (1000 * 60 * 60 * 24));
}

function StatusBadge({ status, size = "sm" }: { status: string; size?: "sm" | "xs" }) {
  const map: Record<string, { bg: string; text: string; dot: string }> = {
    "Not Started": { bg: "bg-gray-50 border-gray-100", text: "text-gray-500", dot: "bg-gray-300" },
    "In Progress": { bg: "bg-blue-50/50 border-blue-100", text: "text-blue-600", dot: "bg-blue-500" },
    Submitted: { bg: "bg-green-50/50 border-green-100", text: "text-green-600", dot: "bg-green-500" },
    Completed: { bg: "bg-green-50/50 border-green-100", text: "text-green-600", dot: "bg-green-500" },
    Pending: { bg: "bg-orange-50/50 border-orange-100", text: "text-orange-600", dot: "bg-orange-400" },
  };
  const s = map[status] ?? map["Not Started"];
  return (
    <span className={`inline-flex items-center gap-1.5 px-2 py-0.5 rounded-[2px] border font-normal ${s.bg} ${s.text} ${size === "xs" ? "text-[9px]" : "text-[10px]"} uppercase tracking-wider`}>
      <span className={`w-1.5 h-1.5 rounded-full ${s.dot}`} />
      {status}
    </span>
  );
}

// ─── Component ───────────────────────────────────────────
export function MyDashboardPage() {
  const [subFilter, setSubFilter] = useState<"All" | "1st Evaluator" | "2nd Evaluator">("All");
  const [subStatusFilter, setSubStatusFilter] = useState<"All" | "Not Started" | "In Progress" | "Completed">("All");
  const [expandedEval, setExpandedEval] = useState<string | null>(MY_EVALUATIONS[0]?.id ?? null);

  // Stats
  const totalSubordinates = SUBORDINATE_EVALUATIONS.length;
  const completedReviews = SUBORDINATE_EVALUATIONS.filter((s) => s.myReviewStatus === "Completed").length;
  const pendingReviews = SUBORDINATE_EVALUATIONS.filter((s) => s.myReviewStatus !== "Completed").length;
  const nearestDeadline = MY_EVALUATIONS.reduce((nearest, e) => {
    const d = daysUntil(e.deadline);
    return d < nearest ? d : nearest;
  }, 999);

  // Filtered subordinates
  const filteredSubs = SUBORDINATE_EVALUATIONS
    .filter((s) => subFilter === "All" || s.evaluatorRole === subFilter)
    .filter((s) => subStatusFilter === "All" || s.myReviewStatus === subStatusFilter);

  const firstEvalCount = SUBORDINATE_EVALUATIONS.filter((s) => s.evaluatorRole === "1st Evaluator").length;
  const secondEvalCount = SUBORDINATE_EVALUATIONS.filter((s) => s.evaluatorRole === "2nd Evaluator").length;

  return (
    <div className="flex-1 flex flex-col h-screen overflow-hidden bg-[#F4F6F9] font-normal">
      <TopHeader />

      <main className="flex-1 overflow-y-auto no-scrollbar">
        {/* Breadcrumbs & Header */}
        <div className="px-6 py-4 border-b border-gray-100 bg-white shrink-0">
          <div className="flex items-center justify-between">
            <div className="space-y-1">
              <div className="flex items-center gap-1.5 text-[10px] font-normal text-[#94989C] uppercase tracking-widest">
                <span>Dashboard</span>
                <ChevronRight className="w-2.5 h-2.5" />
                <span className="text-[#2580D3]">My Dashboard</span>
              </div>
              <h1 className="text-[20px] font-normal text-gray-900 tracking-tight">My Dashboard</h1>
            </div>
            <div className="flex items-center gap-3">
              <div className="flex items-center gap-2.5 px-3 py-1.5 bg-gray-50/50 border border-gray-100 rounded-[3px]">
                <img src={CURRENT_USER.avatar} alt="" className="w-6 h-6 rounded-full object-cover border border-gray-100" />
                <div>
                  <div className="text-[11px] text-gray-900 font-normal leading-none">{CURRENT_USER.name}</div>
                  <div className="text-[9px] text-[#94989C] mt-0.5">{CURRENT_USER.role}</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div className="p-6 space-y-5">
          {/* ─── Stat Cards ──────────────────────────── */}
          <div className="grid grid-cols-4 gap-3">
            {[
              {
                label: "Active Cycles",
                value: MY_EVALUATIONS.length.toString(),
                sub: "Evaluation cycles in progress",
                icon: BarChart3,
                color: "text-[#2580D3]",
                bg: "bg-blue-50/50",
                border: "border-blue-100",
              },
              {
                label: "Self-Eval Progress",
                value: `${MY_EVALUATIONS.filter((e) => e.selfEvalStatus === "Submitted").length}/${MY_EVALUATIONS.length}`,
                sub: "Self evaluations submitted",
                icon: ClipboardCheck,
                color: "text-green-600",
                bg: "bg-green-50/50",
                border: "border-green-100",
              },
              {
                label: "Pending Reviews",
                value: pendingReviews.toString(),
                sub: `${completedReviews} of ${totalSubordinates} completed`,
                icon: Users,
                color: "text-orange-600",
                bg: "bg-orange-50/50",
                border: "border-orange-100",
              },
              {
                label: "Nearest Deadline",
                value: nearestDeadline > 0 ? `${nearestDeadline}d` : "Today",
                sub: nearestDeadline > 0 ? `Due in ${nearestDeadline} days` : "Action required now",
                icon: Clock,
                color: nearestDeadline <= 3 ? "text-red-600" : "text-gray-600",
                bg: nearestDeadline <= 3 ? "bg-red-50/50" : "bg-gray-50/50",
                border: nearestDeadline <= 3 ? "border-red-100" : "border-gray-100",
              },
            ].map((stat) => (
              <motion.div
                key={stat.label}
                initial={{ opacity: 0, y: 8 }}
                animate={{ opacity: 1, y: 0 }}
                className="bg-white border border-gray-100 rounded-[3px] p-4"
              >
                <div className="flex items-start justify-between mb-3">
                  <span className="text-[10px] text-[#94989C] uppercase tracking-widest font-normal">{stat.label}</span>
                  <div className={`w-7 h-7 rounded-[3px] ${stat.bg} border ${stat.border} flex items-center justify-center`}>
                    <stat.icon className={`w-3.5 h-3.5 ${stat.color}`} />
                  </div>
                </div>
                <div className={`text-[22px] font-normal ${stat.color} leading-none mb-1`}>{stat.value}</div>
                <div className="text-[10px] text-[#94989C] font-normal">{stat.sub}</div>
              </motion.div>
            ))}
          </div>

          {/* ─── My Evaluations Section ──────────────── */}
          <div className="bg-white border border-gray-100 rounded-[3px]">
            <div className="px-5 py-3 border-b border-gray-50 flex items-center justify-between">
              <div className="flex items-center gap-2.5">
                <div className="w-6 h-6 rounded-[3px] bg-blue-50/50 border border-blue-100 flex items-center justify-center">
                  <Target className="w-3 h-3 text-[#2580D3]" />
                </div>
                <div>
                  <h2 className="text-[13px] font-normal text-gray-900">My Evaluations</h2>
                  <p className="text-[10px] text-[#94989C] font-normal">Your active evaluation cycles and progress</p>
                </div>
              </div>
              <span className="text-[10px] text-[#94989C] font-normal">{MY_EVALUATIONS.length} active</span>
            </div>

            <div className="divide-y divide-gray-50">
              {MY_EVALUATIONS.map((ev) => {
                const isExpanded = expandedEval === ev.id;
                const daysLeft = daysUntil(ev.deadline);
                return (
                  <div key={ev.id}>
                    <button
                      onClick={() => setExpandedEval(isExpanded ? null : ev.id)}
                      className="w-full px-5 py-3.5 flex items-center gap-4 hover:bg-gray-50/30 transition-colors text-left"
                    >
                      <ChevronRight className={`w-3.5 h-3.5 text-gray-300 transition-transform ${isExpanded ? "rotate-90" : ""}`} />
                      <div className="flex-1 min-w-0">
                        <div className="flex items-center gap-2 mb-0.5">
                          <h3 className="text-[13px] font-normal text-gray-900 truncate">{ev.cycleName}</h3>
                          <span className="px-2 py-0.5 bg-blue-50/50 text-blue-700 text-[9px] rounded-[2px] border border-blue-100 font-normal shrink-0">
                            {ev.type}
                          </span>
                        </div>
                        <div className="text-[10px] text-[#94989C] font-normal">{ev.period}</div>
                      </div>
                      <StatusBadge status={ev.selfEvalStatus} />
                      <div className="flex items-center gap-2 w-32 shrink-0">
                        <div className="flex-1 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                          <div className="h-full bg-[#2580D3] rounded-full" style={{ width: `${ev.overallProgress}%` }} />
                        </div>
                        <span className="text-[10px] text-gray-600 font-normal w-7 text-right">{ev.overallProgress}%</span>
                      </div>
                      <div className={`text-[10px] font-normal shrink-0 ${daysLeft <= 5 ? "text-red-500" : "text-[#94989C]"}`}>
                        {daysLeft > 0 ? `${daysLeft}d left` : "Overdue"}
                      </div>
                    </button>

                    {isExpanded && (
                      <motion.div
                        initial={{ height: 0, opacity: 0 }}
                        animate={{ height: "auto", opacity: 1 }}
                        exit={{ height: 0, opacity: 0 }}
                        transition={{ duration: 0.15 }}
                        className="px-5 pb-4 overflow-hidden"
                      >
                        <div className="ml-7.5 pl-4 border-l border-gray-100">
                          {/* Evaluation Pipeline */}
                          <div className="grid grid-cols-3 gap-3 mb-4">
                            {/* Self Evaluation */}
                            <div className="bg-gray-50/50 border border-gray-100 rounded-[3px] p-3">
                              <div className="flex items-center justify-between mb-2">
                                <span className="text-[10px] text-[#94989C] uppercase tracking-widest font-normal">Self Evaluation</span>
                                <StatusBadge status={ev.selfEvalStatus} size="xs" />
                              </div>
                              <div className="flex items-center gap-2">
                                <div className="w-6 h-6 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center">
                                  <User className="w-3 h-3 text-[#2580D3]" />
                                </div>
                                <span className="text-[11px] text-gray-700 font-normal">You</span>
                              </div>
                              {ev.selfEvalStatus !== "Submitted" && (
                                <button className="mt-2.5 w-full px-2.5 py-1.5 bg-[#2580D3] text-white text-[10px] rounded-[3px] font-normal hover:bg-[#1e6bb3] transition-colors flex items-center justify-center gap-1.5">
                                  <Edit3 className="w-3 h-3" />
                                  {ev.selfEvalStatus === "Not Started" ? "Start Self Evaluation" : "Continue Evaluation"}
                                </button>
                              )}
                            </div>

                            {/* 1st Evaluator */}
                            <div className="bg-gray-50/50 border border-gray-100 rounded-[3px] p-3">
                              <div className="flex items-center justify-between mb-2">
                                <span className="text-[10px] text-[#94989C] uppercase tracking-widest font-normal">1st Evaluator</span>
                                <StatusBadge status={ev.firstEvalStatus} size="xs" />
                              </div>
                              <div className="flex items-center gap-2">
                                <div className="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center">
                                  <User className="w-3 h-3 text-gray-500" />
                                </div>
                                <span className="text-[11px] text-gray-700 font-normal">{ev.firstEvaluator}</span>
                              </div>
                            </div>

                            {/* 2nd Evaluator */}
                            <div className="bg-gray-50/50 border border-gray-100 rounded-[3px] p-3">
                              <div className="flex items-center justify-between mb-2">
                                <span className="text-[10px] text-[#94989C] uppercase tracking-widest font-normal">2nd Evaluator</span>
                                <StatusBadge status={ev.secondEvalStatus} size="xs" />
                              </div>
                              <div className="flex items-center gap-2">
                                <div className="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center">
                                  <User className="w-3 h-3 text-gray-500" />
                                </div>
                                <span className="text-[11px] text-gray-700 font-normal">{ev.secondEvaluator}</span>
                              </div>
                            </div>
                          </div>

                          {/* Score Preview */}
                          {(ev.pimScore !== null || ev.competencyScore !== null) && (
                            <div className="flex items-center gap-4 bg-blue-50/30 border border-blue-100/50 rounded-[3px] px-4 py-2.5">
                              <span className="text-[10px] text-[#94989C] uppercase tracking-widest font-normal">Interim Scores</span>
                              <div className="h-4 w-px bg-gray-200" />
                              {ev.pimScore !== null && (
                                <div className="flex items-center gap-1.5">
                                  <span className="text-[10px] text-gray-500 font-normal">PIM</span>
                                  <span className="text-[12px] text-gray-900 font-normal">{ev.pimScore}</span>
                                  <span className="text-[9px] text-[#94989C]">/ 100</span>
                                </div>
                              )}
                              <div className="h-4 w-px bg-gray-200" />
                              {ev.competencyScore !== null && (
                                <div className="flex items-center gap-1.5">
                                  <span className="text-[10px] text-gray-500 font-normal">Competency</span>
                                  <span className="text-[12px] text-gray-900 font-normal">{ev.competencyScore}</span>
                                  <span className="text-[9px] text-[#94989C]">/ 100</span>
                                </div>
                              )}
                              {ev.currentScore !== null && (
                                <>
                                  <div className="h-4 w-px bg-gray-200" />
                                  <div className="flex items-center gap-1.5">
                                    <span className="text-[10px] text-gray-500 font-normal">Overall</span>
                                    <span className="text-[13px] text-[#2580D3] font-normal">{ev.currentScore}</span>
                                    <span className="text-[9px] text-[#94989C]">/ 100</span>
                                  </div>
                                </>
                              )}
                            </div>
                          )}
                        </div>
                      </motion.div>
                    )}
                  </div>
                );
              })}
            </div>
          </div>

          {/* ─── My PIM Metrics ──────────────────────── */}
          <div className="bg-white border border-gray-100 rounded-[3px]">
            <div className="px-5 py-3 border-b border-gray-50 flex items-center justify-between">
              <div className="flex items-center gap-2.5">
                <div className="w-6 h-6 rounded-[3px] bg-green-50/50 border border-green-100 flex items-center justify-center">
                  <TrendingUp className="w-3 h-3 text-green-600" />
                </div>
                <div>
                  <h2 className="text-[13px] font-normal text-gray-900">My PIM Metrics</h2>
                  <p className="text-[10px] text-[#94989C] font-normal">Key performance indicators for current cycle</p>
                </div>
              </div>
            </div>

            <div className="grid grid-cols-3 gap-px bg-gray-50">
              {MY_PIM_METRICS.map((metric) => {
                const pct = Math.min(100, (metric.current / metric.target) * 100);
                const isOnTrack = pct >= 80;
                return (
                  <div key={metric.id} className="bg-white p-4">
                    <div className="flex items-center justify-between mb-2">
                      <span className={`px-1.5 py-0.5 text-[8px] rounded-[2px] border font-normal uppercase tracking-wider ${
                        metric.type === "KFI" ? "bg-indigo-50 text-indigo-600 border-indigo-100" :
                        metric.type === "KGI" ? "bg-teal-50 text-teal-600 border-teal-100" :
                        "bg-purple-50 text-purple-600 border-purple-100"
                      }`}>
                        {metric.type}
                      </span>
                      <div className={`flex items-center gap-0.5 text-[10px] font-normal ${
                        metric.trend === "up" ? "text-green-600" : metric.trend === "down" ? "text-red-500" : "text-gray-400"
                      }`}>
                        {metric.trend === "up" && <ArrowUpRight className="w-3 h-3" />}
                        {metric.trend === "down" && <ArrowUpRight className="w-3 h-3 rotate-90" />}
                        {metric.trend === "flat" && <Minus className="w-3 h-3" />}
                      </div>
                    </div>
                    <h4 className="text-[12px] text-gray-900 font-normal mb-1">{metric.name}</h4>
                    <div className="flex items-baseline gap-1 mb-2">
                      <span className="text-[16px] text-gray-900 font-normal">
                        {metric.unit === "THB" ? `${(metric.current / 1000).toFixed(0)}k` : metric.current}
                      </span>
                      <span className="text-[10px] text-[#94989C] font-normal">
                        / {metric.unit === "THB" ? `${(metric.target / 1000).toFixed(0)}k` : metric.target} {metric.unit}
                      </span>
                    </div>
                    <div className="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                      <div
                        className={`h-full rounded-full transition-all ${isOnTrack ? "bg-green-500" : "bg-orange-400"}`}
                        style={{ width: `${pct}%` }}
                      />
                    </div>
                    <div className="text-[9px] text-[#94989C] mt-1 font-normal">{pct.toFixed(0)}% of target</div>
                  </div>
                );
              })}
            </div>
          </div>

          {/* ─── Subordinate / Team Evaluations ──────── */}
          {SUBORDINATE_EVALUATIONS.length > 0 && (
            <div className="bg-white border border-gray-100 rounded-[3px]">
              <div className="px-5 py-3 border-b border-gray-50 flex items-center justify-between">
                <div className="flex items-center gap-2.5">
                  <div className="w-6 h-6 rounded-[3px] bg-orange-50/50 border border-orange-100 flex items-center justify-center">
                    <Users className="w-3 h-3 text-orange-600" />
                  </div>
                  <div>
                    <h2 className="text-[13px] font-normal text-gray-900">Team Evaluations</h2>
                    <p className="text-[10px] text-[#94989C] font-normal">
                      People assigned to you as evaluator
                    </p>
                  </div>
                </div>
                <div className="flex items-center gap-2">
                  <span className="px-2 py-0.5 bg-blue-50/50 border border-blue-100 rounded-[2px] text-[9px] text-blue-700 font-normal">
                    {firstEvalCount} as 1st
                  </span>
                  <span className="px-2 py-0.5 bg-purple-50/50 border border-purple-100 rounded-[2px] text-[9px] text-purple-700 font-normal">
                    {secondEvalCount} as 2nd
                  </span>
                </div>
              </div>

              {/* Filters */}
              <div className="px-5 py-2.5 border-b border-gray-50 flex items-center justify-between">
                <div className="flex items-center gap-1.5">
                  {(["All", "1st Evaluator", "2nd Evaluator"] as const).map((f) => (
                    <button
                      key={f}
                      onClick={() => setSubFilter(f)}
                      className={`px-2.5 py-1 rounded-[3px] text-[10px] font-normal uppercase tracking-wider transition-all ${
                        subFilter === f ? "bg-[#2580D3] text-white" : "bg-gray-50 text-gray-500 hover:bg-gray-100"
                      }`}
                    >
                      {f}
                    </button>
                  ))}
                  <div className="w-px h-4 bg-gray-100 mx-1" />
                  {(["All", "Not Started", "In Progress", "Completed"] as const).map((f) => (
                    <button
                      key={f}
                      onClick={() => setSubStatusFilter(f)}
                      className={`px-2.5 py-1 rounded-[3px] text-[10px] font-normal uppercase tracking-wider transition-all ${
                        subStatusFilter === f ? "bg-gray-900 text-white" : "bg-gray-50 text-gray-500 hover:bg-gray-100"
                      }`}
                    >
                      {f}
                    </button>
                  ))}
                </div>
                <span className="text-[10px] text-[#94989C] font-normal">{filteredSubs.length} results</span>
              </div>

              {/* Table */}
              <div className="overflow-x-auto no-scrollbar">
                <table className="w-full text-left border-collapse min-w-[900px]">
                  <thead>
                    <tr className="bg-gray-50/80 border-b border-gray-100">
                      <th className="px-5 py-2.5 text-[10px] font-normal text-gray-400 uppercase tracking-widest">Employee</th>
                      <th className="px-5 py-2.5 text-[10px] font-normal text-gray-400 uppercase tracking-widest">Cycle</th>
                      <th className="px-5 py-2.5 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">Role</th>
                      <th className="px-5 py-2.5 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">Self-Eval</th>
                      <th className="px-5 py-2.5 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">My Review</th>
                      <th className="px-5 py-2.5 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">Self Score</th>
                      <th className="px-5 py-2.5 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">My Score</th>
                      <th className="px-5 py-2.5 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-center">Deadline</th>
                      <th className="px-5 py-2.5 text-[10px] font-normal text-gray-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                  </thead>
                  <tbody className="divide-y divide-gray-50">
                    {filteredSubs.map((sub) => {
                      const dLeft = daysUntil(sub.deadline);
                      return (
                        <tr key={sub.id} className="hover:bg-gray-50/30 transition-colors group">
                          <td className="px-5 py-3">
                            <div className="flex items-center gap-2.5">
                              <img src={sub.avatar} alt="" className="w-7 h-7 rounded-full object-cover border border-gray-100 shrink-0" />
                              <div>
                                <div className="text-[12px] text-gray-900 font-normal leading-tight">{sub.employeeName}</div>
                                <div className="text-[10px] text-[#94989C] font-normal">{sub.employeeRole} · {sub.employeeTeam}</div>
                              </div>
                            </div>
                          </td>
                          <td className="px-5 py-3">
                            <span className="text-[11px] text-gray-700 font-normal">{sub.cycleName}</span>
                          </td>
                          <td className="px-5 py-3 text-center">
                            <span className={`px-2 py-0.5 rounded-[2px] text-[9px] font-normal border ${
                              sub.evaluatorRole === "1st Evaluator"
                                ? "bg-blue-50/50 text-blue-700 border-blue-100"
                                : "bg-purple-50/50 text-purple-700 border-purple-100"
                            }`}>
                              {sub.evaluatorRole}
                            </span>
                          </td>
                          <td className="px-5 py-3 text-center">
                            <StatusBadge status={sub.selfEvalStatus} size="xs" />
                          </td>
                          <td className="px-5 py-3 text-center">
                            <StatusBadge status={sub.myReviewStatus} size="xs" />
                          </td>
                          <td className="px-5 py-3 text-center">
                            {sub.selfScore !== null ? (
                              <span className="text-[12px] text-gray-900 font-normal">{sub.selfScore}</span>
                            ) : (
                              <span className="text-[10px] text-gray-300">—</span>
                            )}
                          </td>
                          <td className="px-5 py-3 text-center">
                            {sub.myScore !== null ? (
                              <span className="text-[12px] text-[#2580D3] font-normal">{sub.myScore}</span>
                            ) : (
                              <span className="text-[10px] text-gray-300">—</span>
                            )}
                          </td>
                          <td className="px-5 py-3 text-center">
                            <span className={`text-[10px] font-normal ${dLeft <= 5 ? "text-red-500" : "text-[#94989C]"}`}>
                              {new Date(sub.deadline).toLocaleDateString("en-GB", { day: "2-digit", month: "short" })}
                              {dLeft <= 7 && (
                                <span className="ml-1 text-[9px]">({dLeft}d)</span>
                              )}
                            </span>
                          </td>
                          <td className="px-5 py-3">
                            <div className="flex items-center justify-end gap-1">
                              <button className="p-1.5 text-gray-400 hover:text-[#2580D3] hover:bg-blue-50 rounded-[3px] transition-all">
                                <Eye className="w-3.5 h-3.5" />
                              </button>
                              {sub.myReviewStatus !== "Completed" && sub.selfEvalStatus === "Submitted" && (
                                <button className="px-2.5 py-1 bg-[#2580D3] text-white text-[10px] rounded-[3px] font-normal hover:bg-[#1e6bb3] transition-colors flex items-center gap-1">
                                  <Edit3 className="w-3 h-3" />
                                  {sub.myReviewStatus === "Not Started" ? "Evaluate" : "Continue"}
                                </button>
                              )}
                              {sub.myReviewStatus === "Completed" && (
                                <span className="flex items-center gap-1 px-2 py-1 bg-green-50/50 text-green-600 text-[10px] rounded-[3px] font-normal border border-green-100">
                                  <CheckCircle2 className="w-3 h-3" />
                                  Done
                                </span>
                              )}
                            </div>
                          </td>
                        </tr>
                      );
                    })}
                  </tbody>
                </table>
              </div>

              {filteredSubs.length === 0 && (
                <div className="flex flex-col items-center justify-center py-12">
                  <div className="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mb-3 border border-gray-100">
                    <Users className="w-5 h-5 text-gray-300" />
                  </div>
                  <h3 className="text-[13px] font-normal text-gray-900 mb-0.5">No evaluations match</h3>
                  <p className="text-[10px] text-[#94989C] font-normal">Try adjusting the filters above</p>
                </div>
              )}
            </div>
          )}

          {/* Bottom spacing */}
          <div className="h-4" />
        </div>
      </main>
    </div>
  );
}
