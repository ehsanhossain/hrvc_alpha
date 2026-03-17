import React, { useState } from "react";
import {
  ChevronRight,
  Building2,
  Users,
  BarChart3,
  TrendingUp,
  Clock,
  Play,
  Pause,
  CheckCircle2,
  AlertCircle,
  Plus,
  ArrowUpRight,
  Calendar,
  FileText,
  Award,
  Eye,
  Navigation,
  Settings,
  Activity,
  Layers
} from "lucide-react";
import { TopHeader } from "./TopHeader";
import { motion } from "motion/react";
import {
  BarChart,
  Bar,
  XAxis,
  YAxis,
  Tooltip,
  ResponsiveContainer,
  PieChart as RechartsPie,
  Pie,
  Cell,
  AreaChart,
  Area,
  CartesianGrid,
  Legend
} from "recharts";

// ─── Aggregated data from across the system ──────────────

const COMPANIES_SUMMARY = [
  { id: "c1", name: "Nexus Holdings", employees: 450, activeCycles: 2, avgScore: 73.2, status: "active" as const },
  { id: "c2", name: "Quantum Solutions", employees: 320, activeCycles: 1, avgScore: 71.8, status: "active" as const },
  { id: "c3", name: "Apex Global", employees: 120, activeCycles: 1, avgScore: 65.2, status: "active" as const },
  { id: "c4", name: "Stellar Tech", employees: 280, activeCycles: 1, avgScore: 78.9, status: "active" as const },
  { id: "c5", name: "Horizon Industries", employees: 1200, activeCycles: 0, avgScore: 0, status: "inactive" as const },
  { id: "c6", name: "Lumina Group", employees: 75, activeCycles: 0, avgScore: 0, status: "inactive" as const },
];

const ACTIVE_EVALUATIONS = [
  { id: "eval_001", name: "Q1 2026 Performance Review", company: "Nexus Holdings", type: "Quarterly", status: "Running" as const, progress: 67, total: 450, completed: 302, deadline: "2026-02-15" },
  { id: "eval_001b", name: "Leadership Development Assessment", company: "Nexus Holdings", type: "Leadership", status: "Running" as const, progress: 45, total: 85, completed: 38, deadline: "2026-02-10" },
  { id: "eval_002", name: "Sales Team Mid-Year Assessment", company: "Apex Global", type: "Department", status: "Running" as const, progress: 34, total: 120, completed: 41, deadline: "2026-02-20" },
  { id: "eval_003", name: "Annual Leadership Evaluation 2026", company: "Quantum Solutions", type: "Leadership", status: "Paused" as const, progress: 12, total: 85, completed: 10, deadline: "2026-02-28" },
  { id: "eval_004", name: "New Hire Probation Review", company: "Stellar Tech", type: "Probation", status: "Pending" as const, progress: 0, total: 24, completed: 0, deadline: "2026-02-12" },
];

const RANK_DISTRIBUTION_AGGREGATE = [
  { rank: "A", count: 375, color: "#22c55e" },
  { rank: "B", count: 738, color: "#2580D3" },
  { rank: "C", count: 669, color: "#eab308" },
  { rank: "D", count: 230, color: "#f97316" },
  { rank: "F", count: 88, color: "#ef4444" },
];

const SCORE_TREND_DATA = [
  { period: "Q1 '25", avgScore: 68.2, topPerformer: 92, bottomPerformer: 38 },
  { period: "Q2 '25", avgScore: 70.8, topPerformer: 95, bottomPerformer: 41 },
  { period: "Q3 '25", avgScore: 72.1, topPerformer: 93, bottomPerformer: 44 },
  { period: "Q4 '25", avgScore: 72.5, topPerformer: 96, bottomPerformer: 42 },
  { period: "Q1 '26", avgScore: 74.3, topPerformer: 94, bottomPerformer: 46 },
];

const EMPLOYEE_BREAKDOWN = [
  { level: "Staff", count: 1840, color: "#94989C" },
  { level: "Team Leader", count: 186, color: "#2580D3" },
  { level: "Manager", count: 72, color: "#6366f1" },
  { level: "General Manager", count: 18, color: "#f59e0b" },
  { level: "Admin", count: 4, color: "#ef4444" },
];

const RECENT_ACTIVITY = [
  { id: "a1", action: "Evaluation launched", detail: "Q1 2026 Performance Review — Nexus Holdings", time: "2 hours ago", type: "launch" as const },
  { id: "a2", action: "Cycle paused", detail: "Annual Leadership Evaluation — Quantum Solutions", time: "5 hours ago", type: "pause" as const },
  { id: "a3", action: "Salary sheet updated", detail: "Standard Payroll 2025 — 150 records modified", time: "1 day ago", type: "salary" as const },
  { id: "a4", action: "Rank template created", detail: "Executive Level Assessment — 5 tiers configured", time: "2 days ago", type: "rank" as const },
  { id: "a5", action: "Evaluation completed", detail: "Q4 2025 Performance Review — Nexus Holdings", time: "3 days ago", type: "complete" as const },
  { id: "a6", action: "Bonus sheet finalized", detail: "Year-end bonus — Apex Global — 120 staff", time: "4 days ago", type: "salary" as const },
  { id: "a7", action: "Evaluator conflict resolved", detail: "Michael Chen reassigned for Enterprise Sales", time: "5 days ago", type: "resolve" as const },
];

// ─── Helpers ─────────────────────────────────────────────
function daysUntil(dateStr: string) {
  const diff = new Date(dateStr).getTime() - new Date("2026-02-06").getTime();
  return Math.ceil(diff / (1000 * 60 * 60 * 24));
}

const totalEmployees = COMPANIES_SUMMARY.reduce((s, c) => s + c.employees, 0);
const activeCompanies = COMPANIES_SUMMARY.filter(c => c.activeCycles > 0).length;
const totalActiveCycles = ACTIVE_EVALUATIONS.length;
const runningCount = ACTIVE_EVALUATIONS.filter(e => e.status === "Running").length;
const pausedCount = ACTIVE_EVALUATIONS.filter(e => e.status === "Paused").length;
const pendingCount = ACTIVE_EVALUATIONS.filter(e => e.status === "Pending").length;
const overallCompletion = Math.round(
  ACTIVE_EVALUATIONS.reduce((s, e) => s + e.progress, 0) / ACTIVE_EVALUATIONS.length
);
const totalRanked = RANK_DISTRIBUTION_AGGREGATE.reduce((s, r) => s + r.count, 0);
const avgHistoricalScore = 72.5;

// ─── Custom Tooltip ──────────────────────────────────────
function CustomTooltip({ active, payload, label }: any) {
  if (!active || !payload?.length) return null;
  return (
    <div className="bg-white border border-gray-100 rounded-[3px] px-3 py-2 text-[10px]">
      <div className="text-gray-500 font-normal mb-1">{label}</div>
      {payload.map((entry: any, idx: number) => (
        <div key={idx} className="flex items-center gap-2">
          <span className="w-2 h-2 rounded-full" style={{ background: entry.color }} />
          <span className="text-gray-600 font-normal">{entry.name}: </span>
          <span className="text-gray-900 font-normal">{entry.value}</span>
        </div>
      ))}
    </div>
  );
}

// ─── Component ───────────────────────────────────────────
export function EvaluationHubPage({ onNavigate }: { onNavigate: (path: string) => void }) {
  return (
    <div className="flex-1 flex flex-col h-screen overflow-hidden bg-[#F4F6F9] font-normal">
      <TopHeader />

      <main className="flex-1 overflow-y-auto no-scrollbar">
        {/* Header */}
        <div className="px-6 py-4 border-b border-gray-100 bg-white shrink-0">
          <div className="flex items-center justify-between">
            <div className="space-y-1">
              <div className="flex items-center gap-1.5 text-[10px] font-normal text-[#94989C] uppercase tracking-widest">
                <span>Dashboard</span>
                <ChevronRight className="w-2.5 h-2.5" />
                <span className="text-[#2580D3]">Evaluation Hub</span>
              </div>
              <h1 className="text-[20px] font-normal text-gray-900 tracking-tight">Evaluation Hub</h1>
            </div>
            <div className="flex items-center gap-2">
              <button
                onClick={() => onNavigate("/create-evaluation")}
                className="px-4 py-1.5 bg-[#2580D3] text-white rounded-[3px] text-[11px] font-normal hover:bg-[#1e6bb3] transition-colors flex items-center gap-1.5"
              >
                <Plus className="w-3.5 h-3.5" />
                New Evaluation
              </button>
            </div>
          </div>
        </div>

        <div className="p-6 space-y-5">

          {/* ─── Stat Row ────────────────────────────── */}
          <div className="grid grid-cols-6 gap-3">
            {[
              { label: "Companies", value: COMPANIES_SUMMARY.length.toString(), sub: `${activeCompanies} with active cycles`, icon: Building2, color: "text-[#2580D3]", bg: "bg-blue-50/50", border: "border-blue-100" },
              { label: "Total Employees", value: totalEmployees.toLocaleString(), sub: "Across all companies", icon: Users, color: "text-indigo-600", bg: "bg-indigo-50/50", border: "border-indigo-100" },
              { label: "Active Cycles", value: totalActiveCycles.toString(), sub: `${runningCount} running · ${pausedCount} paused · ${pendingCount} pending`, icon: Activity, color: "text-green-600", bg: "bg-green-50/50", border: "border-green-100" },
              { label: "Avg Completion", value: `${overallCompletion}%`, sub: "Across running evaluations", icon: BarChart3, color: "text-orange-600", bg: "bg-orange-50/50", border: "border-orange-100" },
              { label: "Avg Score", value: avgHistoricalScore.toFixed(1), sub: "Historical average", icon: TrendingUp, color: "text-teal-600", bg: "bg-teal-50/50", border: "border-teal-100" },
              { label: "Rank Templates", value: "3", sub: "Active templates in use", icon: Layers, color: "text-purple-600", bg: "bg-purple-50/50", border: "border-purple-100" },
            ].map((stat) => (
              <motion.div
                key={stat.label}
                initial={{ opacity: 0, y: 8 }}
                animate={{ opacity: 1, y: 0 }}
                className="bg-white border border-gray-100 rounded-[3px] p-3.5"
              >
                <div className="flex items-start justify-between mb-2.5">
                  <span className="text-[9px] text-[#94989C] uppercase tracking-widest font-normal leading-tight">{stat.label}</span>
                  <div className={`w-6 h-6 rounded-[3px] ${stat.bg} border ${stat.border} flex items-center justify-center shrink-0`}>
                    <stat.icon className={`w-3 h-3 ${stat.color}`} />
                  </div>
                </div>
                <div className={`text-[20px] font-normal ${stat.color} leading-none mb-0.5`}>{stat.value}</div>
                <div className="text-[9px] text-[#94989C] font-normal">{stat.sub}</div>
              </motion.div>
            ))}
          </div>

          {/* ─── Main 2-col Layout ───────────────────── */}
          <div className="grid grid-cols-3 gap-5">

            {/* Left: Active Evaluations Table (2 cols) */}
            <div className="col-span-2 bg-white border border-gray-100 rounded-[3px]">
              <div className="px-5 py-3 border-b border-gray-50 flex items-center justify-between">
                <div className="flex items-center gap-2.5">
                  <div className="w-6 h-6 rounded-[3px] bg-green-50/50 border border-green-100 flex items-center justify-center">
                    <Navigation className="w-3 h-3 text-green-600" />
                  </div>
                  <div>
                    <h2 className="text-[13px] font-normal text-gray-900">Active Evaluation Cycles</h2>
                    <p className="text-[10px] text-[#94989C] font-normal">All running, paused, and pending evaluations</p>
                  </div>
                </div>
                <button
                  onClick={() => onNavigate("/active-evaluation")}
                  className="text-[10px] text-[#2580D3] hover:underline font-normal flex items-center gap-1"
                >
                  View All <ArrowUpRight className="w-3 h-3" />
                </button>
              </div>

              <div className="overflow-x-auto no-scrollbar">
                <table className="w-full text-left border-collapse">
                  <thead>
                    <tr className="bg-gray-50/80 border-b border-gray-100">
                      <th className="px-5 py-2 text-[9px] font-normal text-gray-400 uppercase tracking-widest">Evaluation</th>
                      <th className="px-5 py-2 text-[9px] font-normal text-gray-400 uppercase tracking-widest">Company</th>
                      <th className="px-5 py-2 text-[9px] font-normal text-gray-400 uppercase tracking-widest text-center">Status</th>
                      <th className="px-5 py-2 text-[9px] font-normal text-gray-400 uppercase tracking-widest text-center">Staff</th>
                      <th className="px-5 py-2 text-[9px] font-normal text-gray-400 uppercase tracking-widest">Progress</th>
                      <th className="px-5 py-2 text-[9px] font-normal text-gray-400 uppercase tracking-widest text-center">Deadline</th>
                    </tr>
                  </thead>
                  <tbody className="divide-y divide-gray-50">
                    {ACTIVE_EVALUATIONS.map((ev) => {
                      const dLeft = daysUntil(ev.deadline);
                      return (
                        <tr key={ev.id} className="hover:bg-gray-50/30 transition-colors">
                          <td className="px-5 py-2.5">
                            <div className="text-[11px] text-gray-900 font-normal leading-tight">{ev.name}</div>
                            <div className="text-[9px] text-[#94989C] font-normal mt-0.5">{ev.type}</div>
                          </td>
                          <td className="px-5 py-2.5 text-[11px] text-gray-600 font-normal">{ev.company}</td>
                          <td className="px-5 py-2.5 text-center">
                            <span className={`inline-flex items-center gap-1 px-2 py-0.5 rounded-[2px] text-[9px] font-normal uppercase tracking-wider border ${
                              ev.status === "Running" ? "bg-green-50 text-green-600 border-green-100" :
                              ev.status === "Paused" ? "bg-orange-50 text-orange-600 border-orange-100" :
                              "bg-gray-50 text-gray-500 border-gray-100"
                            }`}>
                              {ev.status === "Running" && <span className="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse" />}
                              {ev.status === "Paused" && <Pause className="w-2.5 h-2.5" />}
                              {ev.status === "Pending" && <Clock className="w-2.5 h-2.5" />}
                              {ev.status}
                            </span>
                          </td>
                          <td className="px-5 py-2.5 text-center">
                            <span className="text-[11px] text-gray-900 font-normal">{ev.completed}</span>
                            <span className="text-[9px] text-[#94989C] font-normal">/{ev.total}</span>
                          </td>
                          <td className="px-5 py-2.5">
                            <div className="flex items-center gap-2">
                              <div className="flex-1 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                <div
                                  className={`h-full rounded-full ${
                                    ev.status === "Running" ? "bg-green-500" :
                                    ev.status === "Paused" ? "bg-orange-400" : "bg-gray-300"
                                  }`}
                                  style={{ width: `${ev.progress}%` }}
                                />
                              </div>
                              <span className="text-[9px] text-gray-500 font-normal w-6 text-right">{ev.progress}%</span>
                            </div>
                          </td>
                          <td className="px-5 py-2.5 text-center">
                            <span className={`text-[10px] font-normal ${dLeft <= 5 ? "text-red-500" : "text-[#94989C]"}`}>
                              {new Date(ev.deadline).toLocaleDateString("en-GB", { day: "2-digit", month: "short" })}
                              {dLeft <= 7 && <span className="ml-0.5 text-[8px]">({dLeft}d)</span>}
                            </span>
                          </td>
                        </tr>
                      );
                    })}
                  </tbody>
                </table>
              </div>
            </div>

            {/* Right: Recent Activity */}
            <div className="col-span-1 bg-white border border-gray-100 rounded-[3px]">
              <div className="px-4 py-3 border-b border-gray-50 flex items-center gap-2.5">
                <div className="w-6 h-6 rounded-[3px] bg-blue-50/50 border border-blue-100 flex items-center justify-center">
                  <Clock className="w-3 h-3 text-[#2580D3]" />
                </div>
                <div>
                  <h2 className="text-[13px] font-normal text-gray-900">Recent Activity</h2>
                  <p className="text-[10px] text-[#94989C] font-normal">System-wide events</p>
                </div>
              </div>

              <div className="divide-y divide-gray-50">
                {RECENT_ACTIVITY.map((act) => (
                  <div key={act.id} className="px-4 py-2.5 hover:bg-gray-50/30 transition-colors">
                    <div className="flex items-start gap-2.5">
                      <div className={`w-5 h-5 rounded-full flex items-center justify-center shrink-0 mt-0.5 ${
                        act.type === "launch" ? "bg-green-50" :
                        act.type === "pause" ? "bg-orange-50" :
                        act.type === "complete" ? "bg-blue-50" :
                        act.type === "salary" ? "bg-indigo-50" :
                        act.type === "rank" ? "bg-purple-50" :
                        "bg-gray-50"
                      }`}>
                        {act.type === "launch" && <Play className="w-2.5 h-2.5 text-green-600" />}
                        {act.type === "pause" && <Pause className="w-2.5 h-2.5 text-orange-600" />}
                        {act.type === "complete" && <CheckCircle2 className="w-2.5 h-2.5 text-blue-600" />}
                        {act.type === "salary" && <FileText className="w-2.5 h-2.5 text-indigo-600" />}
                        {act.type === "rank" && <Award className="w-2.5 h-2.5 text-purple-600" />}
                        {act.type === "resolve" && <AlertCircle className="w-2.5 h-2.5 text-gray-500" />}
                      </div>
                      <div className="flex-1 min-w-0">
                        <div className="text-[11px] text-gray-900 font-normal">{act.action}</div>
                        <div className="text-[10px] text-[#94989C] font-normal truncate">{act.detail}</div>
                        <div className="text-[9px] text-gray-400 font-normal mt-0.5">{act.time}</div>
                      </div>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>

          {/* ─── Charts Row ──────────────────────────── */}
          <div className="grid grid-cols-3 gap-5">

            {/* Score Trend Chart */}
            <div className="col-span-2 bg-white border border-gray-100 rounded-[3px]">
              <div className="px-5 py-3 border-b border-gray-50 flex items-center justify-between">
                <div className="flex items-center gap-2.5">
                  <div className="w-6 h-6 rounded-[3px] bg-teal-50/50 border border-teal-100 flex items-center justify-center">
                    <TrendingUp className="w-3 h-3 text-teal-600" />
                  </div>
                  <div>
                    <h2 className="text-[13px] font-normal text-gray-900">Performance Score Trend</h2>
                    <p className="text-[10px] text-[#94989C] font-normal">Average, top & bottom performer scores over time</p>
                  </div>
                </div>
              </div>
              <div className="p-4" style={{ height: 220 }}>
                <ResponsiveContainer width="100%" height="100%">
                  <AreaChart data={SCORE_TREND_DATA} margin={{ top: 5, right: 10, left: -20, bottom: 0 }}>
                    <CartesianGrid strokeDasharray="3 3" stroke="#f0f0f0" />
                    <XAxis dataKey="period" tick={{ fontSize: 10, fill: "#94989C" }} axisLine={false} tickLine={false} />
                    <YAxis domain={[0, 100]} tick={{ fontSize: 10, fill: "#94989C" }} axisLine={false} tickLine={false} />
                    <Tooltip content={<CustomTooltip />} />
                    <Area type="monotone" dataKey="topPerformer" name="Top Performer" stroke="#22c55e" fill="#22c55e" fillOpacity={0.08} strokeWidth={1.5} dot={{ r: 2 }} />
                    <Area type="monotone" dataKey="avgScore" name="Average" stroke="#2580D3" fill="#2580D3" fillOpacity={0.12} strokeWidth={2} dot={{ r: 3 }} />
                    <Area type="monotone" dataKey="bottomPerformer" name="Bottom Performer" stroke="#f97316" fill="#f97316" fillOpacity={0.08} strokeWidth={1.5} dot={{ r: 2 }} />
                  </AreaChart>
                </ResponsiveContainer>
              </div>
            </div>

            {/* Rank Distribution Pie */}
            <div className="col-span-1 bg-white border border-gray-100 rounded-[3px]">
              <div className="px-5 py-3 border-b border-gray-50 flex items-center gap-2.5">
                <div className="w-6 h-6 rounded-[3px] bg-yellow-50/50 border border-yellow-100 flex items-center justify-center">
                  <Award className="w-3 h-3 text-yellow-600" />
                </div>
                <div>
                  <h2 className="text-[13px] font-normal text-gray-900">Rank Distribution</h2>
                  <p className="text-[10px] text-[#94989C] font-normal">{totalRanked.toLocaleString()} evaluated employees</p>
                </div>
              </div>
              <div className="px-4 pt-2 pb-3 flex items-center gap-4">
                <div style={{ width: 130, height: 130 }}>
                  <ResponsiveContainer width="100%" height="100%">
                    <RechartsPie>
                      <Pie
                        data={RANK_DISTRIBUTION_AGGREGATE}
                        cx="50%"
                        cy="50%"
                        innerRadius={36}
                        outerRadius={58}
                        dataKey="count"
                        nameKey="rank"
                        strokeWidth={1.5}
                        stroke="#fff"
                      >
                        {RANK_DISTRIBUTION_AGGREGATE.map((entry) => (
                          <Cell key={entry.rank} fill={entry.color} />
                        ))}
                      </Pie>
                      <Tooltip
                        content={({ active, payload }) => {
                          if (!active || !payload?.length) return null;
                          const d = payload[0].payload;
                          return (
                            <div className="bg-white border border-gray-100 rounded-[3px] px-2.5 py-1.5 text-[10px]">
                              <span className="text-gray-900 font-normal">Rank {d.rank}: </span>
                              <span className="text-gray-600">{d.count} ({((d.count / totalRanked) * 100).toFixed(1)}%)</span>
                            </div>
                          );
                        }}
                      />
                    </RechartsPie>
                  </ResponsiveContainer>
                </div>
                <div className="flex-1 space-y-1.5">
                  {RANK_DISTRIBUTION_AGGREGATE.map((r) => (
                    <div key={r.rank} className="flex items-center justify-between">
                      <div className="flex items-center gap-2">
                        <span className="w-2.5 h-2.5 rounded-[2px]" style={{ background: r.color }} />
                        <span className="text-[11px] text-gray-700 font-normal">Rank {r.rank}</span>
                      </div>
                      <div className="flex items-center gap-2">
                        <span className="text-[11px] text-gray-900 font-normal">{r.count}</span>
                        <span className="text-[9px] text-[#94989C] font-normal w-8 text-right">
                          {((r.count / totalRanked) * 100).toFixed(0)}%
                        </span>
                      </div>
                    </div>
                  ))}
                </div>
              </div>
            </div>
          </div>

          {/* ─── Company Overview + Employee Breakdown ── */}
          <div className="grid grid-cols-3 gap-5">

            {/* Company Overview */}
            <div className="col-span-2 bg-white border border-gray-100 rounded-[3px]">
              <div className="px-5 py-3 border-b border-gray-50 flex items-center justify-between">
                <div className="flex items-center gap-2.5">
                  <div className="w-6 h-6 rounded-[3px] bg-indigo-50/50 border border-indigo-100 flex items-center justify-center">
                    <Building2 className="w-3 h-3 text-indigo-600" />
                  </div>
                  <div>
                    <h2 className="text-[13px] font-normal text-gray-900">Company Overview</h2>
                    <p className="text-[10px] text-[#94989C] font-normal">Evaluation status per company</p>
                  </div>
                </div>
              </div>
              <div className="overflow-x-auto no-scrollbar">
                <table className="w-full text-left border-collapse">
                  <thead>
                    <tr className="bg-gray-50/80 border-b border-gray-100">
                      <th className="px-5 py-2 text-[9px] font-normal text-gray-400 uppercase tracking-widest">Company</th>
                      <th className="px-5 py-2 text-[9px] font-normal text-gray-400 uppercase tracking-widest text-center">Employees</th>
                      <th className="px-5 py-2 text-[9px] font-normal text-gray-400 uppercase tracking-widest text-center">Active Cycles</th>
                      <th className="px-5 py-2 text-[9px] font-normal text-gray-400 uppercase tracking-widest text-center">Avg Score</th>
                      <th className="px-5 py-2 text-[9px] font-normal text-gray-400 uppercase tracking-widest text-center">Status</th>
                    </tr>
                  </thead>
                  <tbody className="divide-y divide-gray-50">
                    {COMPANIES_SUMMARY.map((co) => (
                      <tr key={co.id} className="hover:bg-gray-50/30 transition-colors">
                        <td className="px-5 py-2.5">
                          <div className="flex items-center gap-2.5">
                            <div className="w-7 h-7 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0">
                              <span className="text-[9px] text-blue-600 font-normal">
                                {co.name.split(" ").map(n => n[0]).join("")}
                              </span>
                            </div>
                            <span className="text-[11px] text-gray-900 font-normal">{co.name}</span>
                          </div>
                        </td>
                        <td className="px-5 py-2.5 text-center text-[11px] text-gray-700 font-normal">{co.employees.toLocaleString()}</td>
                        <td className="px-5 py-2.5 text-center">
                          {co.activeCycles > 0 ? (
                            <span className="text-[11px] text-[#2580D3] font-normal">{co.activeCycles}</span>
                          ) : (
                            <span className="text-[10px] text-gray-300 font-normal">—</span>
                          )}
                        </td>
                        <td className="px-5 py-2.5 text-center">
                          {co.avgScore > 0 ? (
                            <span className={`text-[11px] font-normal ${co.avgScore >= 75 ? "text-green-600" : co.avgScore >= 60 ? "text-blue-600" : "text-orange-600"}`}>
                              {co.avgScore.toFixed(1)}
                            </span>
                          ) : (
                            <span className="text-[10px] text-gray-300 font-normal">—</span>
                          )}
                        </td>
                        <td className="px-5 py-2.5 text-center">
                          <span className={`px-2 py-0.5 rounded-[2px] text-[9px] font-normal uppercase tracking-wider border ${
                            co.status === "active" ? "bg-green-50 text-green-600 border-green-100" : "bg-gray-50 text-gray-400 border-gray-100"
                          }`}>
                            {co.status === "active" ? "Active" : "No Cycles"}
                          </span>
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </div>

            {/* Employee Breakdown + Quick Actions */}
            <div className="col-span-1 space-y-5">

              {/* Employee Breakdown */}
              <div className="bg-white border border-gray-100 rounded-[3px]">
                <div className="px-4 py-3 border-b border-gray-50 flex items-center gap-2.5">
                  <div className="w-6 h-6 rounded-[3px] bg-gray-50 border border-gray-100 flex items-center justify-center">
                    <Users className="w-3 h-3 text-gray-500" />
                  </div>
                  <div>
                    <h2 className="text-[13px] font-normal text-gray-900">Employee Hierarchy</h2>
                    <p className="text-[10px] text-[#94989C] font-normal">{totalEmployees.toLocaleString()} total</p>
                  </div>
                </div>
                <div className="p-4 space-y-2">
                  {EMPLOYEE_BREAKDOWN.map((lvl) => {
                    const pct = (lvl.count / totalEmployees) * 100;
                    return (
                      <div key={lvl.level}>
                        <div className="flex items-center justify-between mb-1">
                          <span className="text-[10px] text-gray-600 font-normal">{lvl.level}</span>
                          <span className="text-[10px] text-gray-900 font-normal">{lvl.count.toLocaleString()}</span>
                        </div>
                        <div className="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                          <div className="h-full rounded-full" style={{ width: `${pct}%`, background: lvl.color }} />
                        </div>
                      </div>
                    );
                  })}
                </div>
              </div>

              {/* Quick Actions */}
              <div className="bg-white border border-gray-100 rounded-[3px]">
                <div className="px-4 py-3 border-b border-gray-50">
                  <h2 className="text-[13px] font-normal text-gray-900">Quick Actions</h2>
                </div>
                <div className="p-2 space-y-0.5">
                  {[
                    { label: "Create Evaluation", icon: Plus, path: "/create-evaluation", color: "text-[#2580D3]" },
                    { label: "Active Evaluations", icon: Navigation, path: "/active-evaluation", color: "text-green-600" },
                    { label: "Evaluation History", icon: Calendar, path: "/evaluation-history", color: "text-indigo-600" },
                    { label: "Salary Sheets", icon: FileText, path: "/salary-sheet", color: "text-orange-600" },
                    { label: "Rank Templates", icon: Award, path: "/rank-setup", color: "text-purple-600" },
                  ].map((action) => (
                    <button
                      key={action.label}
                      onClick={() => onNavigate(action.path)}
                      className="w-full flex items-center justify-between px-3 py-2 rounded-[3px] hover:bg-gray-50 transition-colors group"
                    >
                      <div className="flex items-center gap-2.5">
                        <action.icon className={`w-3.5 h-3.5 ${action.color}`} />
                        <span className="text-[11px] text-gray-700 font-normal group-hover:text-gray-900">{action.label}</span>
                      </div>
                      <ArrowUpRight className="w-3 h-3 text-gray-300 group-hover:text-gray-500" />
                    </button>
                  ))}
                </div>
              </div>
            </div>
          </div>

          {/* Bottom spacing */}
          <div className="h-4" />
        </div>
      </main>
    </div>
  );
}
