import React, { useState } from "react";
import { ChevronRight, ChevronLeft, Save, CheckCircle2 } from "lucide-react";
import { motion, AnimatePresence } from "motion/react";
import { Toaster, toast } from "sonner";
import { DndProvider } from "react-dnd";
import { HTML5Backend } from "react-dnd-html5-backend";
import { EvaluationState } from "./types";
import { INITIAL_RANKS, MOCK_KFI_ITEMS, MOCK_KGI_ITEMS, MOCK_KPI_ITEMS, MOCK_WEIGHT_TEMPLATES, MOCK_RANK_TEMPLATES } from "./mockData";
import { BasicInfoStep } from "./components/BasicInfoStep";
import { TimeFrameStep } from "./components/TimeFrameStep";
import { IntervalManagementStep } from "./components/IntervalManagementStep";
import { EvaluationMethodStep } from "./components/EvaluationMethodStep";
import { SalaryBonusStep } from "./components/SalaryBonusStep";
import { RankIncrementStep } from "./components/RankIncrementStep";
import { EvaluatorsStep } from "./components/EvaluatorsStep";
import { Sidebar } from "./components/Sidebar";
import { TopHeader } from "./components/TopHeader";
import { ComingSoon } from "./components/ComingSoon";
import { RankSetupPage } from "./components/RankSetupPage";
import { SalarySheetPage } from "./components/SalarySheetPage";
import { BonusPage } from "./components/BonusPage";
import { OrganizationMapPage } from "./components/OrganizationMapPage";
import { ActiveEvaluationPage } from "./components/ActiveEvaluationPage";
import { EvaluationHistoryPage } from "./components/EvaluationHistoryPage";
import { MyDashboardPage } from "./components/MyDashboardPage";

const STEPS = [
  "Basic Information",
  "Time Frame",
  "Interval Management",
  "Evaluation Method",
  "Salary & Bonus",
  "Rank & Increment",
  "Default Evaluators",
];

const INITIAL_STATE: EvaluationState = {
  step: 7, // Set to 7 so user sees the work immediately
  basicInfo: {
    name: "2026 Q1 Performance Review",
    description: "Quarterly review for all sales and management staff.",
    entity: "Company",
    selectedCompanyIds: ["c1"],
    selectedEmployeeIds: ["1", "2", "3", "e_tl1", "e_tl2", "4", "5", "s_tl1", "m_mgr1", "m_gm1"],
  },
  timeFrame: {
    startDate: "2026-01-01",
    endDate: "2026-03-31",
    interval: "Quarterly",
    periods: [{ id: "1", name: "Q1 2026", startDate: "2026-01-01", endDate: "2026-03-31" }],
    midTermReview: true,
    bonusInclusion: true,
    bonusMonth: "March",
  },
  timelineEvents: [
    { id: "1", name: "Goal Setting", startDate: "2026-01-01", endDate: "2026-01-15" },
    { id: "2", name: "Self Evaluation", startDate: "2026-03-15", endDate: "2026-03-20" },
    { id: "3", name: "Manager Review", startDate: "2026-03-21", endDate: "2026-03-31" },
  ],
  evaluationMethod: {
    weightTemplates: MOCK_WEIGHT_TEMPLATES,
    selectedTemplateId: 'wt1',
    pimWeight: 70,
    competencyWeight: 20,
    bufferWeight: 10,
    kfiWeight: 40,
    kgiWeight: 40,
    kpiWeight: 20,
    pimItems: [...MOCK_KFI_ITEMS, ...MOCK_KGI_ITEMS, ...MOCK_KPI_ITEMS],
    competencies: [],
    successCriteria: {
      uniformThreshold: 4,
      description: "Must meet at least 85% of KFI targets.",
    },
  },
  salaryBonus: {
    incrementRules: [
      { id: "1", minScore: 90, maxScore: 100, type: "Percentage", value: 12 },
      { id: "2", minScore: 80, maxScore: 89, type: "Percentage", value: 8 },
    ],
  },
  rankIncrement: {
    rankTemplates: MOCK_RANK_TEMPLATES,
    selectedTemplateId: 'rt1',
    salarySheetId: "ss1",
    ranks: INITIAL_RANKS,
    enableBonus: true,
    baseBonusAmount: 5000,
  },
  evaluators: {
    assignments: {
      "1": { first: "e_tl1", second: "m_mgr1" },
      "2": { first: "e_tl1", second: "m_mgr1" },
      "3": { first: "e_tl1", second: "m_mgr1" },
      "e_tl1": { first: "m_mgr1", second: "m_gm1" },
      "m_mgr1": { first: "m_gm1", second: "m_adm1" },
    },
  },
};

export default function App() {
  const [state, setState] = useState<EvaluationState>(INITIAL_STATE);
  const [isSubmitted, setIsSubmitted] = useState(false);
  const [currentPath, setCurrentPath] = useState('/dashboard');

  const nextStep = () => {
    if (state.step < 7) {
      setState((prev) => ({ ...prev, step: prev.step + 1 }));
    } else {
      setIsSubmitted(true);
      toast.success("Evaluation profile created successfully!");
    }
  };

  const prevStep = () => {
    if (state.step > 1) {
      setState((prev) => ({ ...prev, step: prev.step - 1 }));
    }
  };

  const handleSaveDraft = () => {
    toast.success("Draft saved successfully!");
  };

  const MainContent = () => (
    <div className="flex-1 flex flex-col h-screen overflow-hidden">
      <TopHeader />
      
      <main className="flex-1 overflow-y-auto p-5 space-y-4 no-scrollbar">
        {/* Breadcrumbs & Title */}
        <div className="flex items-center justify-between mb-1">
          <div className="space-y-0.5">
            <div className="flex items-center gap-1.5 text-[10px] font-normal text-gray-500 uppercase tracking-widest">
              <span>Performance</span>
              <ChevronRight className="w-2.5 h-2.5" />
              <span className="text-[#2580D3]">Create Profile</span>
            </div>
            <h1 className="text-[20px] font-normal text-gray-900 tracking-tight">Create New Evaluation Profile</h1>
          </div>
          
          <div className="flex items-center gap-2">
            <button 
              onClick={handleSaveDraft}
              className="px-3 py-1.5 text-gray-500 font-normal text-[12px] flex items-center gap-2 bg-gray-50 border border-gray-100 rounded-[3px] hover:bg-gray-100 transition-all"
            >
              <Save className="w-3.5 h-3.5" />
              Save Draft
            </button>
            <div className="h-4 w-px bg-gray-100 mx-1" />
            <div className="flex items-center gap-2 text-[11px]">
              <span className="font-normal text-[#2580D3]">Step {state.step}</span>
              <span className="text-gray-500">/ 7</span>
            </div>
          </div>
        </div>

        {/* Wizard Steps Indicator */}
        <div className="bg-gray-50/50 p-1.5 rounded-[3px] border border-gray-100 flex items-center gap-1 overflow-x-auto no-scrollbar">
          {STEPS.map((stepName, idx) => {
            const stepNum = idx + 1;
            const isActive = state.step === stepNum;
            const isCompleted = state.step > stepNum;
            
            return (
              <div key={stepName} className="flex items-center gap-1 shrink-0">
                <button 
                  onClick={() => setState(prev => ({ ...prev, step: stepNum }))}
                  className={`flex items-center gap-2 px-3 py-1.5 rounded-[3px] transition-all whitespace-nowrap
                    ${isActive ? 'bg-white border border-gray-100 text-[#2580D3]' : isCompleted ? 'text-green-600' : 'text-gray-500 hover:bg-gray-50/50'}
                  `}
                >
                  <span className={`w-4 h-4 rounded-full flex items-center justify-center text-[9px] font-normal border
                    ${isActive ? 'border-[#2580D3] bg-[#2580D3] text-white' : isCompleted ? 'border-green-600 bg-green-50' : 'border-gray-200'}
                  `}>
                    {isCompleted ? <CheckCircle2 className="w-2.5 h-2.5" /> : stepNum}
                  </span>
                  <span className="text-[11px] font-normal uppercase tracking-tight">{stepName}</span>
                </button>
                {idx < STEPS.length - 1 && <ChevronRight className="w-3 h-3 text-gray-200 mx-0.5 shrink-0" />}
              </div>
            );
          })}
        </div>

        <AnimatePresence mode="wait">
          <motion.div
            key={state.step}
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            transition={{ duration: 0.15 }}
            className="bg-white rounded-[3px] border border-gray-100"
          >
            {state.step === 1 && <BasicInfoStep state={state} setState={setState} />}
            {state.step === 2 && <TimeFrameStep state={state} setState={setState} />}
            {state.step === 3 && <IntervalManagementStep state={state} setState={setState} />}
            {state.step === 4 && <EvaluationMethodStep state={state} setState={setState} />}
            {state.step === 5 && <SalaryBonusStep state={state} setState={setState} />}
            {state.step === 6 && <RankIncrementStep state={state} setState={setState} />}
            {state.step === 7 && <EvaluatorsStep state={state} setState={setState} />}
          </motion.div>
        </AnimatePresence>

        {/* Footer Navigation */}
        <div className="flex items-center justify-between py-2">
          <button
            onClick={prevStep}
            disabled={state.step === 1}
            className={`px-4 py-2 rounded-[3px] font-normal text-[12px] flex items-center gap-2 transition-all
              ${state.step === 1 ? 'opacity-0 cursor-default' : 'text-gray-500 bg-white border border-gray-100 hover:bg-gray-50'}
            `}
          >
            <ChevronLeft className="w-3.5 h-3.5" />
            Previous
          </button>
          
          <button
            onClick={nextStep}
            className="px-6 py-2 bg-[#2580D3] text-white rounded-[3px] font-normal text-[12px] flex items-center gap-2 hover:bg-[#1e6bb3] transition-all"
          >
            {state.step === 7 ? "Launch Evaluation" : "Continue"}
            <ChevronRight className="w-3.5 h-3.5" />
          </button>
        </div>
      </main>
    </div>
  );

  if (isSubmitted) {
    return (
      <div className="min-h-screen bg-white flex items-center justify-center p-4 font-normal">
        <motion.div 
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          className="bg-gray-50/50 rounded-[3px] border border-gray-100 p-10 text-center max-w-sm w-full"
        >
          <div className="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-5">
            <CheckCircle2 className="w-6 h-6 text-green-600" />
          </div>
          <h2 className="text-xl font-normal text-gray-900 mb-1.5">Launch Successful</h2>
          <p className="text-[12px] text-gray-500 mb-6">
            Evaluation profile "{state.basicInfo.name}" has been initialized.
          </p>
          <button 
            onClick={() => {
              setState(INITIAL_STATE);
              setIsSubmitted(false);
            }}
            className="w-full py-2 bg-blue-600 text-white rounded-[3px] font-normal text-[12px] hover:bg-blue-700 transition-colors"
          >
            Create Another
          </button>
        </motion.div>
      </div>
    );
  }

  return (
    <DndProvider backend={HTML5Backend}>
      <div className="flex h-screen bg-background font-normal text-gray-900 overflow-hidden">
        <Toaster position="top-right" />
        <Sidebar 
          currentPath={currentPath} 
          onNavigate={(path) => setCurrentPath(path)} 
        />
        {currentPath === '/create-evaluation' ? (
          <MainContent />
        ) : currentPath === '/rank-setup' ? (
          <RankSetupPage onBack={() => setCurrentPath('/create-evaluation')} />
        ) : currentPath === '/organization-map' ? (
          <OrganizationMapPage onBack={() => setCurrentPath('/create-evaluation')} />
        ) : currentPath === '/salary-sheet' ? (
          <SalarySheetPage />
        ) : currentPath === '/bonus' ? (
          <BonusPage />
        ) : currentPath === '/active-evaluation' ? (
          <ActiveEvaluationPage />
        ) : currentPath === '/evaluation-history' ? (
          <EvaluationHistoryPage />
        ) : currentPath === '/dashboard' ? (
          <MyDashboardPage />
        ) : (
          <ComingSoon 
            featureName={currentPath} 
            onBack={() => setCurrentPath('/create-evaluation')} 
          />
        )}
      </div>
    </DndProvider>
  );
}