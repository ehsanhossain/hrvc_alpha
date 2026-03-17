import React, { useState } from "react";
import { 
  Settings, 
  BarChart3, 
  Award, 
  Sliders, 
  CheckCircle2, 
  AlertTriangle, 
  X, 
  Plus, 
  ChevronDown, 
  Edit3, 
  Copy,
  Users,
  Building2,
  Table as TableIcon,
  ChevronRight,
  ChevronLeft,
  Save,
  Check
} from "lucide-react";
import { EvaluationState, WeightTemplate } from "../types";
import { motion, AnimatePresence } from "motion/react";
import { ImageWithFallback } from "@/app/components/figma/ImageWithFallback";
import pimLogo from "figma:asset/c05133c2f9c828b95b9683fddaa8784d7545e655.png";
import { toast } from "sonner";

interface Props {
  state: EvaluationState;
  setState: React.Dispatch<React.SetStateAction<EvaluationState>>;
}

type Tab = 'templates' | 'position' | 'department';

export function EvaluationMethodStep({ state, setState }: Props) {
  const [activeTab, setActiveTab] = useState<Tab>('templates');
  const [view, setView] = useState<'selection' | 'details'>('selection');
  const [showPimConfig, setShowPimConfig] = useState(false);
  const [showCompetencyConfig, setShowCompetencyConfig] = useState(false);
  const [pimFilter, setPimFilter] = useState<'All' | 'KFI' | 'KGI' | 'KPI'>('All');
  const [showCreateModal, setShowCreateModal] = useState(false);
  const [newTemplateName, setNewTemplateName] = useState("");
  
  // Local state for editing a template before saving
  const [editingTemplate, setEditingTemplate] = useState<WeightTemplate | null>(null);

  const totalWeight = editingTemplate 
    ? (editingTemplate.pimWeight || 0) + (editingTemplate.competencyWeight || 0) + (editingTemplate.bufferWeight || 0)
    : (state.evaluationMethod.pimWeight || 0) + (state.evaluationMethod.competencyWeight || 0) + (state.evaluationMethod.bufferWeight || 0);
    
  const isTotalWeightValid = totalWeight === 100;

  const totalPimCategoryWeight = editingTemplate
    ? (editingTemplate.kfiWeight || 0) + (editingTemplate.kgiWeight || 0) + (editingTemplate.kpiWeight || 0)
    : (state.evaluationMethod.kfiWeight || 0) + (state.evaluationMethod.kgiWeight || 0) + (state.evaluationMethod.kpiWeight || 0);
    
  const isPimCategoryWeightValid = totalPimCategoryWeight === 100;

  const updateWeight = (field: 'pimWeight' | 'competencyWeight' | 'bufferWeight', value: number) => {
    const val = isNaN(value) ? 0 : value;
    if (editingTemplate) {
      setEditingTemplate({ ...editingTemplate, [field]: val });
    } else {
      setState(prev => ({
        ...prev,
        evaluationMethod: { ...prev.evaluationMethod, [field]: val }
      }));
    }
  };

  const updatePimCategoryWeight = (field: 'kfiWeight' | 'kgiWeight' | 'kpiWeight', value: number) => {
    const val = isNaN(value) ? 0 : value;
    if (editingTemplate) {
      setEditingTemplate({ ...editingTemplate, [field]: val });
    } else {
      setState(prev => ({
        ...prev,
        evaluationMethod: { ...prev.evaluationMethod, [field]: val }
      }));
    }
  };

  const handleCreateTemplate = () => {
    if (!newTemplateName.trim()) return;
    
    const newTemplate: WeightTemplate = {
      id: `wt-${Date.now()}`,
      name: newTemplateName,
      isDefault: false,
      pimWeight: 70,
      competencyWeight: 20,
      bufferWeight: 10,
      kfiWeight: 40,
      kgiWeight: 40,
      kpiWeight: 20,
      usage: 0
    };

    setEditingTemplate(newTemplate);
    setNewTemplateName("");
    setShowCreateModal(false);
    setView('details');
  };

  const startEditing = (template: WeightTemplate) => {
    setEditingTemplate({ ...template });
    setView('details');
  };

  const saveConfiguration = () => {
    if (!editingTemplate) return;
    if (!isTotalWeightValid) {
      toast.error(`Total weight must be 100% (currently ${totalWeight}%)`);
      return;
    }
    if (!isPimCategoryWeightValid) {
      toast.error(`PIM category weights must total 100% (currently ${totalPimCategoryWeight}%)`);
      return;
    }

    setState(prev => {
      const exists = prev.evaluationMethod.weightTemplates.some(t => t.id === editingTemplate.id);
      const newTemplates = exists 
        ? prev.evaluationMethod.weightTemplates.map(t => t.id === editingTemplate.id ? editingTemplate : t)
        : [...prev.evaluationMethod.weightTemplates, editingTemplate];
      
      return {
        ...prev,
        evaluationMethod: {
          ...prev.evaluationMethod,
          weightTemplates: newTemplates,
          selectedTemplateId: editingTemplate.id,
          // Update global weights to match the selected template
          pimWeight: editingTemplate.pimWeight,
          competencyWeight: editingTemplate.competencyWeight,
          bufferWeight: editingTemplate.bufferWeight,
          kfiWeight: editingTemplate.kfiWeight,
          kgiWeight: editingTemplate.kgiWeight,
          kpiWeight: editingTemplate.kpiWeight,
        }
      };
    });

    toast.success(`Configuration "${editingTemplate.name}" saved`);
    setView('selection');
    setEditingTemplate(null);
  };

  const togglePimItem = (id: string) => {
    setState(prev => ({
      ...prev,
      evaluationMethod: {
        ...prev.evaluationMethod,
        pimItems: prev.evaluationMethod.pimItems.map(item => 
          item.id === id ? { ...item, isSelected: !item.isSelected } : item
        )
      }
    }));
  };

  if (view === 'selection') {
    return (
      <div className="p-6 space-y-6">
        <div>
          {/* Removed PIM Logo and Dropdown as requested */}
          <div className="flex items-center justify-between">
            <h2 className="text-[18px] font-normal text-gray-900">Weight Configuration</h2>
          </div>
          <p className="text-[11px] text-gray-500 font-normal mt-1 uppercase tracking-wider">Configure evaluation weights for different positions and departments</p>
        </div>

        {/* Tabs */}
        <div className="bg-gray-50/50 p-1 rounded-[4px] border border-gray-100 flex items-center gap-1">
          {[
            { id: 'templates', label: 'Weight Templates', icon: TableIcon },
            { id: 'position', label: 'Position Assignment', icon: Users },
            { id: 'department', label: 'Department Assignment', icon: Building2 },
          ].map((tab) => (
            <button
              key={tab.id}
              onClick={() => setActiveTab(tab.id as Tab)}
              className={`flex-1 flex items-center justify-center gap-2 py-2 rounded-[3px] text-[11px] font-normal transition-all
                ${activeTab === tab.id 
                  ? 'bg-white border border-gray-100 text-gray-900 shadow-sm' 
                  : 'text-gray-500 hover:text-gray-700 hover:bg-white/50'}
              `}
            >
              <tab.icon className={`w-3.5 h-3.5 ${activeTab === tab.id ? 'text-blue-600' : 'text-gray-400'}`} />
              {tab.label}
            </button>
          ))}
        </div>

        {activeTab === 'templates' && (
          <div className="space-y-4">
            <div className="flex items-center justify-between">
              <h4 className="text-[14px] font-normal text-gray-900 uppercase tracking-tight">Weight Templates</h4>
              <button 
                onClick={() => setShowCreateModal(true)}
                className="px-4 py-1.5 bg-[#2580D3] text-white rounded-[3px] font-normal text-[12px] flex items-center gap-2 hover:bg-[#1e6bb3] transition-all shadow-sm active:scale-[0.98]"
              >
                <Plus className="w-4 h-4" />
                Create Template
              </button>
            </div>

            <div className="border border-gray-100 rounded-[3px] overflow-hidden">
              <table className="w-full text-left">
                <thead>
                  <tr className="bg-gray-50/50 border-b border-gray-100">
                    <th className="px-4 py-3 text-[10px] font-normal text-gray-500 uppercase tracking-widest">Template Name</th>
                    <th className="px-4 py-3 text-[10px] font-normal text-gray-500 uppercase tracking-widest">PIM Weight</th>
                    <th className="px-4 py-3 text-[10px] font-normal text-gray-500 uppercase tracking-widest">Competency Weight</th>
                    <th className="px-4 py-3 text-[10px] font-normal text-gray-500 uppercase tracking-widest">Buffer Weight</th>
                    <th className="px-4 py-3 text-[10px] font-normal text-gray-500 uppercase tracking-widest">Usage</th>
                    <th className="px-4 py-3 text-[10px] font-normal text-gray-500 uppercase tracking-widest text-right">Actions</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-gray-50">
                  {state.evaluationMethod.weightTemplates.map((template) => (
                    <tr 
                      key={template.id} 
                      className="hover:bg-gray-50/50 transition-colors group cursor-pointer" 
                      onClick={() => startEditing(template)}
                    >
                      <td className="px-4 py-4">
                        <div className="flex items-center gap-2">
                          <span className="text-[12px] font-normal text-gray-900">{template.name}</span>
                          {template.isDefault && (
                            <span className="px-1.5 py-0.5 bg-gray-100 text-gray-500 text-[9px] font-normal rounded-[2px]">Default</span>
                          )}
                        </div>
                      </td>
                      <td className="px-4 py-4 text-[12px] font-normal text-gray-700">{template.pimWeight}%</td>
                      <td className="px-4 py-4 text-[12px] font-normal text-gray-700">{template.competencyWeight}%</td>
                      <td className="px-4 py-4 text-[12px] font-normal text-gray-700">{template.bufferWeight}%</td>
                      <td className="px-4 py-4">
                        <span className="px-2 py-0.5 bg-gray-50 text-gray-500 text-[10px] font-normal rounded-full border border-gray-100">
                          {template.usage} assignments
                        </span>
                      </td>
                      <td className="px-4 py-4 text-right">
                        <div className="flex items-center justify-end gap-2 transition-opacity">
                          <button 
                            className="p-1 text-gray-400 hover:text-[#2580D3] hover:bg-blue-50 rounded-[2px]"
                            onClick={(e) => {
                              e.stopPropagation();
                              startEditing(template);
                            }}
                          >
                            <Edit3 className="w-3.5 h-3.5" />
                          </button>
                          <button 
                            className="p-1 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-[2px]"
                            onClick={(e) => e.stopPropagation()}
                          >
                            <Copy className="w-3.5 h-3.5" />
                          </button>
                        </div>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        )}

        <AnimatePresence>
          {showCreateModal && (
            <div className="fixed inset-0 z-[110] flex items-center justify-center p-4">
              <motion.div 
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
                onClick={() => setShowCreateModal(false)}
                className="absolute inset-0 bg-gray-900/40 backdrop-blur-[2px]"
              />
              <motion.div 
                initial={{ opacity: 0, scale: 0.98 }}
                animate={{ opacity: 1, scale: 1 }}
                exit={{ opacity: 0, scale: 0.98 }}
                className="relative bg-white w-full max-w-md rounded-[3px] p-6 shadow-xl"
              >
                <div className="flex items-center justify-between mb-6">
                  <h3 className="text-[16px] font-normal text-gray-900">Create New Template</h3>
                  <button onClick={() => setShowCreateModal(false)} className="text-gray-400 hover:text-gray-900">
                    <X className="w-4 h-4" />
                  </button>
                </div>
                
                <div className="space-y-4">
                  <div className="space-y-1.5">
                    <label className="text-[10px] font-normal text-gray-500 uppercase tracking-widest">Template Name</label>
                    <input 
                      autoFocus
                      type="text"
                      placeholder="e.g., Sales Rep Template"
                      value={newTemplateName}
                      onChange={(e) => setNewTemplateName(e.target.value)}
                      className="w-full px-3 py-2 bg-gray-50 border border-gray-100 rounded-[3px] focus:ring-1 focus:ring-blue-100 outline-none font-normal text-[13px]"
                      onKeyDown={(e) => e.key === 'Enter' && handleCreateTemplate()}
                    />
                  </div>
                  
                  <div className="flex gap-3 pt-4">
                    <button 
                      onClick={() => setShowCreateModal(false)}
                      className="flex-1 py-2 text-gray-500 font-normal text-[12px] bg-white border border-gray-100 rounded-[3px] hover:bg-gray-50 transition-colors"
                    >
                      Cancel
                    </button>
                    <button 
                      onClick={handleCreateTemplate}
                      className="flex-1 py-2 bg-[#2580D3] text-white rounded-[3px] font-normal text-[12px] hover:bg-[#1e6bb3] transition-colors"
                    >
                      Create & Configure
                    </button>
                  </div>
                </div>
              </motion.div>
            </div>
          )}
        </AnimatePresence>
      </div>
    );
  }

  return (
    <div className="flex flex-col h-full bg-white">
      <div className="px-6 py-4 border-b border-gray-50 flex items-center justify-between bg-white sticky top-0 z-10">
        <div className="flex items-center gap-3">
          <button 
            onClick={() => setView('selection')}
            className="flex items-center gap-1.5 text-[11px] text-gray-500 font-normal hover:text-[#2580D3] transition-colors"
          >
            <ChevronLeft className="w-3.5 h-3.5" />
            Back to Templates
          </button>
          <div className="h-4 w-px bg-gray-100" />
          <div className="flex items-center gap-2">
            <span className="text-[12px] font-normal text-gray-900">{editingTemplate?.name || 'New Configuration'}</span>
          </div>
        </div>
        
        <div className="flex items-center gap-4">
          <div className={`px-2 py-0.5 rounded-[3px] font-normal text-[10px] border flex items-center gap-1.5
            ${isTotalWeightValid ? 'bg-green-50 text-green-700 border-green-100' : 'bg-red-50 text-red-700 border-red-100'}
          `}>
            {isTotalWeightValid ? <CheckCircle2 className="w-3 h-3" /> : <AlertTriangle className="w-3 h-3" />}
            Total Weight: {totalWeight}%
          </div>
          <button 
            onClick={saveConfiguration}
            className="px-4 py-1.5 bg-[#2580D3] text-white rounded-[3px] font-normal text-[12px] flex items-center gap-2 hover:bg-[#1e6bb3] transition-all shadow-sm active:scale-[0.98]"
          >
            <Save className="w-3.5 h-3.5" />
            Save Configuration
          </button>
        </div>
      </div>

      <div className="p-6 space-y-8 flex-1 overflow-y-auto no-scrollbar">
        {/* Component Weight Configuration */}
        <section className="space-y-6">
          <div className="flex items-center justify-between">
            <div>
              <h3 className="text-[14px] font-normal text-gray-900 uppercase tracking-tight">Evaluation Components</h3>
              <p className="text-[11px] text-gray-500 font-normal">Define weight distribution for this template</p>
            </div>
            {/* Main Total Visualization */}
            <div className="flex items-center gap-6 pr-4">
               <div className="flex flex-col items-end">
                  <span className="text-[9px] text-gray-400 font-normal uppercase tracking-widest">Running Total</span>
                  <div className="flex items-center gap-2">
                    <span className={`text-[24px] font-normal ${isTotalWeightValid ? 'text-green-600' : 'text-[#2580D3]'}`}>
                      {totalWeight}
                      <span className="text-[14px] ml-0.5">%</span>
                    </span>
                    {isTotalWeightValid && <Check className="w-5 h-5 text-green-600" />}
                  </div>
               </div>
            </div>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            {/* PIM Card */}
            <div className="p-5 rounded-[3px] border border-gray-100 bg-white hover:border-[#2580D3]/30 transition-all shadow-sm relative group">
              <div className="flex items-center gap-3 mb-6">
                <div className="shrink-0">
                  <ImageWithFallback src={pimLogo} alt="PIM" className="h-3.5 w-auto object-contain opacity-80" />
                </div>
                <div className="flex-1">
                  <h4 className="font-normal text-gray-900 text-[13px] leading-tight uppercase tracking-tight">Performance</h4>
                  <p className="text-[10px] text-gray-500 font-normal">KFI, KGI, KPI metrics</p>
                </div>
              </div>
              
              <div className="space-y-4">
                <div className="flex items-center justify-between bg-gray-50/50 p-3 rounded-[3px] border border-gray-50">
                  <label className="text-[10px] font-normal text-gray-400 uppercase tracking-widest">Weight Percentage</label>
                  <div className="relative">
                    <input 
                      type="number"
                      min="0"
                      max="100"
                      value={editingTemplate?.pimWeight ?? state.evaluationMethod.pimWeight}
                      onChange={(e) => updateWeight('pimWeight', parseInt(e.target.value))}
                      className="w-16 px-2 py-1 bg-white border border-gray-200 rounded-[2px] text-[15px] font-normal text-right focus:border-[#2580D3] focus:ring-1 focus:ring-[#2580D3]/10 outline-none transition-all"
                    />
                    <span className="absolute -right-4 top-1/2 -translate-y-1/2 text-gray-400 text-[12px] font-normal">%</span>
                  </div>
                </div>
              </div>

              {(editingTemplate?.pimWeight || state.evaluationMethod.pimWeight) > 0 && (
                <button 
                  onClick={() => setShowPimConfig(true)}
                  className="mt-6 w-full py-2.5 bg-[#2580D3]/5 text-[#2580D3] font-normal text-[11px] rounded-[3px] border border-[#2580D3]/10 hover:bg-[#2580D3]/10 hover:border-[#2580D3]/20 transition-all flex items-center justify-center gap-2 uppercase tracking-wide"
                >
                  <Settings className="w-3.5 h-3.5" />
                  Configure PIM Metrics
                </button>
              )}
            </div>

            {/* Competency Card */}
            <div className="p-5 rounded-[3px] border border-gray-100 bg-white hover:border-purple-200 transition-all shadow-sm">
              <div className="flex items-center gap-3 mb-6">
                <div className="w-6 h-6 bg-purple-50 rounded-[3px] flex items-center justify-center shrink-0 border border-purple-100/50">
                  <Award className="w-3.5 h-3.5 text-purple-600" />
                </div>
                <div className="flex-1">
                  <h4 className="font-normal text-gray-900 text-[13px] leading-tight uppercase tracking-tight">Competency</h4>
                  <p className="text-[10px] text-gray-500 font-normal">Skill assessments</p>
                </div>
              </div>
              
              <div className="space-y-4">
                <div className="flex items-center justify-between bg-gray-50/50 p-3 rounded-[3px] border border-gray-50">
                  <label className="text-[10px] font-normal text-gray-400 uppercase tracking-widest">Weight Percentage</label>
                  <div className="relative">
                    <input 
                      type="number"
                      min="0"
                      max="100"
                      value={editingTemplate?.competencyWeight ?? state.evaluationMethod.competencyWeight}
                      onChange={(e) => updateWeight('competencyWeight', parseInt(e.target.value))}
                      className="w-16 px-2 py-1 bg-white border border-gray-200 rounded-[2px] text-[15px] font-normal text-right focus:border-purple-600 focus:ring-1 focus:ring-purple-100 outline-none transition-all"
                    />
                    <span className="absolute -right-4 top-1/2 -translate-y-1/2 text-gray-400 text-[12px] font-normal">%</span>
                  </div>
                </div>

                {(editingTemplate?.competencyWeight || state.evaluationMethod.competencyWeight) > 0 && (
                  <button 
                    onClick={() => setShowCompetencyConfig(true)}
                    className="mt-6 w-full py-2.5 bg-purple-50 text-purple-600 font-normal text-[11px] rounded-[3px] border border-purple-100 hover:bg-purple-100 hover:border-purple-200 transition-all flex items-center justify-center gap-2 uppercase tracking-wide"
                  >
                    <Settings className="w-3.5 h-3.5" />
                    Configure Competencies
                  </button>
                )}
              </div>
            </div>

            {/* Buffer Card */}
            <div className="p-5 rounded-[3px] border border-gray-100 bg-white hover:border-orange-200 transition-all shadow-sm">
              <div className="flex items-center gap-3 mb-6">
                <div className="w-6 h-6 bg-orange-50 rounded-[3px] flex items-center justify-center shrink-0 border border-orange-100/50">
                  <Sliders className="w-3.5 h-3.5 text-orange-600" />
                </div>
                <div className="flex-1">
                  <h4 className="font-normal text-gray-900 text-[13px] leading-tight uppercase tracking-tight">Buffer Rate</h4>
                  <p className="text-[10px] text-gray-500 font-normal">Manager adjustments</p>
                </div>
              </div>
              
              <div className="space-y-4">
                <div className="flex items-center justify-between bg-gray-50/50 p-3 rounded-[3px] border border-gray-50">
                  <label className="text-[10px] font-normal text-gray-400 uppercase tracking-widest">Weight Percentage</label>
                  <div className="relative">
                    <input 
                      type="number"
                      min="0"
                      max="100"
                      value={editingTemplate?.bufferWeight ?? state.evaluationMethod.bufferWeight}
                      onChange={(e) => updateWeight('bufferWeight', parseInt(e.target.value))}
                      className="w-16 px-2 py-1 bg-white border border-gray-200 rounded-[2px] text-[15px] font-normal text-right focus:border-orange-600 focus:ring-1 focus:ring-orange-100 outline-none transition-all"
                    />
                    <span className="absolute -right-4 top-1/2 -translate-y-1/2 text-gray-400 text-[12px] font-normal">%</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <div className="h-px bg-gray-50" />

        {/* Success Criteria */}
        <section className="space-y-4">
          <h3 className="text-[14px] font-normal text-gray-900 uppercase tracking-tight">Success Criteria</h3>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div className="space-y-3 p-5 bg-gray-50/50 rounded-[3px] border border-gray-100">
              <label className="text-[10px] font-normal text-gray-500 uppercase tracking-widest block">Uniform Threshold Level</label>
              <div className="flex items-center gap-1.5">
                {[1, 2, 3, 4, 5, 6].map(level => (
                  <button
                    key={level}
                    onClick={() => setState(prev => ({ 
                      ...prev, 
                      evaluationMethod: { 
                        ...prev.evaluationMethod, 
                        successCriteria: { ...prev.evaluationMethod.successCriteria, uniformThreshold: level } 
                      } 
                    }))}
                    className={`w-9 h-9 rounded-[3px] font-normal text-[14px] border transition-all
                      ${state.evaluationMethod.successCriteria.uniformThreshold === level 
                        ? 'bg-[#2580D3] border-[#2580D3] text-white shadow-md active:scale-95' 
                        : 'bg-white border-gray-100 text-gray-500 hover:border-[#2580D3]/20'}
                    `}
                  >
                    {level}
                  </button>
                ))}
              </div>
              <p className="text-[10px] text-gray-500 font-normal leading-tight mt-1 uppercase tracking-tight">Minimum level required across all metrics.</p>
            </div>

            <div className="space-y-2">
              <label className="text-[10px] font-normal text-gray-500 uppercase tracking-widest block">Configuration Description</label>
              <textarea 
                rows={3}
                placeholder="Explain success criteria..."
                value={state.evaluationMethod.successCriteria.description}
                onChange={(e) => setState(prev => ({ 
                  ...prev, 
                  evaluationMethod: { 
                    ...prev.evaluationMethod, 
                    successCriteria: { ...prev.evaluationMethod.successCriteria, description: e.target.value } 
                  } 
                }))}
                className="w-full px-3 py-2.5 bg-white border border-gray-100 rounded-[3px] focus:ring-1 focus:ring-[#2580D3]/20 focus:border-[#2580D3] outline-none transition-all font-normal text-[12px] resize-none"
              />
            </div>
          </div>
        </section>

        {/* PIM Configuration Modal */}
        <AnimatePresence>
          {showPimConfig && (
            <div className="fixed inset-0 z-[100] flex items-center justify-center p-4">
              <motion.div 
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
                onClick={() => setShowPimConfig(false)}
                className="absolute inset-0 bg-gray-900/40 backdrop-blur-[2px]"
              />
              <motion.div 
                initial={{ opacity: 0, scale: 0.98 }}
                animate={{ opacity: 1, scale: 1 }}
                exit={{ opacity: 0, scale: 0.98 }}
                className="relative bg-white w-full max-w-4xl max-h-[85vh] rounded-[3px] flex flex-col shadow-2xl overflow-hidden"
              >
                <div className="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-white">
                  <div className="flex items-center gap-4">
                    <div className="h-4 flex items-center">
                        <ImageWithFallback src={pimLogo} alt="PIM" className="h-3.5 w-auto object-contain opacity-80" />
                    </div>
                    <div className="h-4 w-px bg-gray-100" />
                    <div className={`text-[10px] font-normal uppercase tracking-widest px-2 py-0.5 rounded-[2px] border
                      ${isPimCategoryWeightValid ? 'text-green-600 bg-green-50 border-green-100' : 'text-red-500 bg-red-50 border-red-100'}
                    `}>
                      Categories Total: {totalPimCategoryWeight}%
                    </div>
                  </div>
                  <button onClick={() => setShowPimConfig(false)} className="p-1.5 text-gray-400 hover:text-gray-900 rounded-[3px] hover:bg-gray-50 transition-colors">
                    <X className="w-4 h-4" />
                  </button>
                </div>

                <div className="flex-1 overflow-y-auto p-8 space-y-10 no-scrollbar">
                  <div className="grid grid-cols-3 gap-6">
                    {[
                      { id: 'kfiWeight', label: 'KFI (Key Financial Indicators)', color: 'blue' },
                      { id: 'kgiWeight', label: 'KGI (Key Goal Indicators)', color: 'purple' },
                      { id: 'kpiWeight', label: 'KPI (Key Performance Indicators)', color: 'orange' },
                    ].map((cat) => (
                      <div key={cat.id} className="space-y-4 p-5 rounded-[3px] bg-gray-50/50 border border-gray-100 shadow-sm transition-all hover:bg-white">
                        <div className="flex flex-col gap-1.5">
                          <label className="text-[9px] font-normal text-gray-500 uppercase tracking-widest">{cat.label}</label>
                          <div className="flex items-center justify-between bg-white px-3 py-2 rounded-[2px] border border-gray-100">
                             <input 
                              type="number"
                              min="0"
                              max="100"
                              value={editingTemplate ? (editingTemplate[cat.id as keyof WeightTemplate] as number) : (state.evaluationMethod[cat.id as keyof typeof state.evaluationMethod] as number)}
                              onChange={(e) => updatePimCategoryWeight(cat.id as any, parseInt(e.target.value))}
                              className="w-full text-[16px] font-normal text-gray-900 outline-none"
                             />
                             <span className="text-gray-400 text-[13px]">%</span>
                          </div>
                        </div>
                      </div>
                    ))}
                  </div>

                  <div className="space-y-5">
                    <div className="flex items-center justify-between">
                      <div className="space-y-0.5">
                        <h4 className="text-[13px] font-normal text-gray-900 uppercase tracking-widest">Individual Metrics Selection</h4>
                        <p className="text-[10px] text-gray-500 font-normal">Select the specific items to be included in this evaluation</p>
                      </div>
                      <div className="flex bg-gray-50 p-1 rounded-[3px] border border-gray-100">
                        {['All', 'KFI', 'KGI', 'KPI'].map(f => (
                          <button
                            key={f}
                            onClick={() => setPimFilter(f as any)}
                            className={`px-3 py-1 rounded-[2px] text-[10px] font-normal uppercase tracking-widest transition-all
                              ${pimFilter === f ? 'bg-white text-[#2580D3] border border-gray-100 shadow-sm' : 'text-gray-500 hover:text-gray-700'}
                            `}
                          >
                            {f}
                          </button>
                        ))}
                      </div>
                    </div>

                    <div className="grid grid-cols-2 gap-4">
                      {state.evaluationMethod.pimItems
                        .filter(item => pimFilter === 'All' || item.type === pimFilter)
                        .map((item) => (
                          <div 
                            key={item.id}
                            onClick={() => togglePimItem(item.id)}
                            className={`p-4 rounded-[3px] border cursor-pointer transition-all flex items-start gap-3
                              ${item.isSelected ? 'border-[#2580D3] bg-blue-50/10 shadow-sm' : 'border-gray-50 hover:bg-gray-100'}
                            `}
                          >
                            <div className={`w-4 h-4 rounded-[2px] border flex items-center justify-center shrink-0 mt-0.5
                              ${item.isSelected ? 'bg-[#2580D3] border-[#2580D3]' : 'bg-white border-gray-200'}
                            `}>
                              {item.isSelected && <CheckCircle2 className="w-3 h-3 text-white" />}
                            </div>
                            <div className="flex-1">
                              <span className="text-[8px] font-normal uppercase tracking-widest text-[#2580D3] bg-blue-50 px-1.5 py-0.5 rounded-[2px]">{item.type}</span>
                              <h5 className="font-normal text-gray-900 text-[13px] leading-tight mt-1">{item.name}</h5>
                              <p className="text-[10px] text-gray-400 font-normal mt-0.5">{item.category}</p>
                            </div>
                          </div>
                        ))}
                    </div>
                  </div>
                </div>

                <div className="px-6 py-4 border-t border-gray-100 bg-gray-50/30 flex items-center justify-between">
                  <div className="text-[10px] font-normal text-gray-500 uppercase tracking-widest">
                    {state.evaluationMethod.pimItems.filter(i => i.isSelected).length} metrics included in this profile
                  </div>
                  <button 
                    onClick={() => setShowPimConfig(false)}
                    className="px-8 py-2 bg-[#2580D3] text-white rounded-[3px] font-normal text-[12px] hover:bg-[#1e6bb3] transition-all shadow-lg active:scale-95"
                  >
                    Confirm PIM Selection
                  </button>
                </div>
              </motion.div>
            </div>
          )}
        </AnimatePresence>

        {/* Competency Configuration Modal */}
        <AnimatePresence>
          {showCompetencyConfig && (
            <div className="fixed inset-0 z-[100] flex items-center justify-center p-4">
              <motion.div 
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
                onClick={() => setShowCompetencyConfig(false)}
                className="absolute inset-0 bg-gray-900/40 backdrop-blur-[2px]"
              />
              <motion.div 
                initial={{ opacity: 0, scale: 0.98 }}
                animate={{ opacity: 1, scale: 1 }}
                exit={{ opacity: 0, scale: 0.98 }}
                className="relative bg-white w-full max-w-2xl max-h-[80vh] rounded-[3px] flex flex-col shadow-2xl overflow-hidden"
              >
                <div className="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-white">
                  <div className="flex items-center gap-4">
                    <div className="w-6 h-6 bg-purple-50 rounded-[3px] flex items-center justify-center shrink-0 border border-purple-100/50">
                      <Award className="w-3.5 h-3.5 text-purple-600" />
                    </div>
                    <div className="h-4 w-px bg-gray-100" />
                    <h3 className="text-[14px] font-normal text-gray-900 uppercase tracking-tight">Configure Competency Weights</h3>
                  </div>
                  <button onClick={() => setShowCompetencyConfig(false)} className="p-1.5 text-gray-400 hover:text-gray-900 rounded-[3px] hover:bg-gray-50 transition-colors">
                    <X className="w-4 h-4" />
                  </button>
                </div>

                <div className="flex-1 overflow-y-auto p-6 space-y-4 no-scrollbar">
                  {state.evaluationMethod.competencies.length === 0 ? (
                    <div className="text-center py-10 space-y-3">
                      <div className="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mx-auto">
                        <Award className="w-6 h-6 text-gray-300" />
                      </div>
                      <p className="text-[12px] text-gray-500 font-normal">No competencies defined for this evaluation.</p>
                    </div>
                  ) : (
                    <div className="space-y-3">
                      {state.evaluationMethod.competencies.map((comp) => (
                        <div key={comp.id} className="p-4 bg-gray-50/50 border border-gray-100 rounded-[3px] flex items-center justify-between group hover:bg-white hover:border-purple-200 transition-all">
                          <div>
                            <h4 className="text-[13px] font-normal text-gray-900">{comp.name}</h4>
                            <p className="text-[10px] text-gray-400 uppercase tracking-widest mt-0.5">Core Competency</p>
                          </div>
                          <div className="flex items-center gap-3">
                            <div className="relative">
                              <input 
                                type="number"
                                value={comp.weight}
                                onChange={(e) => {
                                  const val = parseInt(e.target.value) || 0;
                                  setState(prev => ({
                                    ...prev,
                                    evaluationMethod: {
                                      ...prev.evaluationMethod,
                                      competencies: prev.evaluationMethod.competencies.map(c => 
                                        c.id === comp.id ? { ...c, weight: val } : c
                                      )
                                    }
                                  }));
                                }}
                                className="w-16 px-2 py-1 bg-white border border-gray-200 rounded-[2px] text-[14px] text-right focus:border-purple-600 outline-none transition-all"
                              />
                              <span className="absolute -right-4 top-1/2 -translate-y-1/2 text-gray-400 text-[11px] font-normal">%</span>
                            </div>
                          </div>
                        </div>
                      ))}
                    </div>
                  )}
                </div>

                <div className="px-6 py-4 border-t border-gray-100 bg-gray-50/30 flex items-center justify-between">
                   <div className="text-[10px] font-normal text-gray-400 uppercase tracking-widest">
                     Ensure weights total 100% of Competency component
                   </div>
                   <button 
                    onClick={() => setShowCompetencyConfig(false)}
                    className="px-8 py-2 bg-purple-600 text-white rounded-[3px] font-normal text-[12px] hover:bg-purple-700 transition-all shadow-md active:scale-95"
                  >
                    Confirm Selection
                  </button>
                </div>
              </motion.div>
            </div>
          )}
        </AnimatePresence>
      </div>
    </div>
  );
}
