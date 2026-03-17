import React, { useState } from "react";
import { Plus, MinusCircle, Save, ChevronRight, Info, FileText, PlusCircle, Edit2, Trash2, Copy } from "lucide-react";
import { motion } from "motion/react";
import { toast } from "sonner";
import { TopHeader } from "./TopHeader";

interface RankItem {
  id: string;
  label: string;
  name: string;
  minScore: number;
  maxScore: number;
  increment: number;
  bonus: number;
}

interface RankTemplate {
  id: string;
  name: string;
  description: string;
  ranks: RankItem[];
  createdAt: Date;
  isDefault?: boolean;
}

const DEFAULT_RANKS: RankItem[] = [
  { id: "1", label: "F", name: "", minScore: 0, maxScore: 11, increment: 0.0, bonus: 0.0 },
  { id: "2", label: "E", name: "", minScore: 12, maxScore: 20, increment: 0.5, bonus: 0.5 },
  { id: "3", label: "D", name: "", minScore: 21, maxScore: 30, increment: 1.0, bonus: 1.0 },
  { id: "4", label: "C", name: "", minScore: 31, maxScore: 40, increment: 1.5, bonus: 1.5 },
  { id: "5", label: "B", name: "", minScore: 41, maxScore: 50, increment: 2.0, bonus: 2.0 },
  { id: "6", label: "B+", name: "", minScore: 51, maxScore: 60, increment: 2.5, bonus: 2.5 },
  { id: "7", label: "A", name: "", minScore: 61, maxScore: 70, increment: 3.0, bonus: 3.0 },
  { id: "8", label: "A+", name: "", minScore: 71, maxScore: 75, increment: 3.5, bonus: 3.5 },
  { id: "9", label: "S-", name: "", minScore: 76, maxScore: 80, increment: 4.0, bonus: 4.0 },
  { id: "10", label: "S", name: "", minScore: 81, maxScore: 85, increment: 4.5, bonus: 4.5 },
  { id: "11", label: "S+", name: "", minScore: 86, maxScore: 90, increment: 5.0, bonus: 5.0 },
  { id: "12", label: "SS", name: "", minScore: 91, maxScore: 100, increment: 5.5, bonus: 5.5 },
];

const INITIAL_TEMPLATES: RankTemplate[] = [
  {
    id: "1",
    name: "Standard Performance Scale",
    description: "12-tier performance ranking from F to SS with progressive increments",
    ranks: DEFAULT_RANKS,
    createdAt: new Date("2024-01-15"),
    isDefault: true
  },
  {
    id: "2",
    name: "Simplified 5-Tier System",
    description: "Basic 5-level performance evaluation for smaller teams",
    ranks: [
      { id: "1", label: "Below Expectations", name: "", minScore: 0, maxScore: 20, increment: 0.0, bonus: 0.0 },
      { id: "2", label: "Meets Expectations", name: "", minScore: 21, maxScore: 40, increment: 1.0, bonus: 1.0 },
      { id: "3", label: "Good Performance", name: "", minScore: 41, maxScore: 60, increment: 2.0, bonus: 2.0 },
      { id: "4", label: "Excellent", name: "", minScore: 61, maxScore: 80, increment: 3.5, bonus: 3.5 },
      { id: "5", label: "Outstanding", name: "", minScore: 81, maxScore: 100, increment: 5.0, bonus: 5.0 },
    ],
    createdAt: new Date("2024-02-10")
  },
  {
    id: "3",
    name: "Executive Level Assessment",
    description: "Premium tier system for senior leadership evaluation",
    ranks: [
      { id: "1", label: "Developing", name: "", minScore: 0, maxScore: 30, increment: 0.5, bonus: 0.5 },
      { id: "2", label: "Competent", name: "", minScore: 31, maxScore: 50, increment: 2.0, bonus: 2.0 },
      { id: "3", label: "Strong", name: "", minScore: 51, maxScore: 70, increment: 4.0, bonus: 4.0 },
      { id: "4", label: "Distinguished", name: "", minScore: 71, maxScore: 85, increment: 6.0, bonus: 6.0 },
      { id: "5", label: "Exceptional", name: "", minScore: 86, maxScore: 100, increment: 8.0, bonus: 8.0 },
    ],
    createdAt: new Date("2024-03-05")
  }
];

export function RankSetupPage({ onBack }: { onBack: () => void }) {
  const [view, setView] = useState<'list' | 'edit'>('list');
  const [templates, setTemplates] = useState<RankTemplate[]>(INITIAL_TEMPLATES);
  const [selectedTemplate, setSelectedTemplate] = useState<RankTemplate | null>(null);
  const [editingRanks, setEditingRanks] = useState<RankItem[]>([]);
  const [templateName, setTemplateName] = useState("");
  const [templateDescription, setTemplateDescription] = useState("");
  const [isCreatingNew, setIsCreatingNew] = useState(false);

  const createNewTemplate = () => {
    setIsCreatingNew(true);
    setSelectedTemplate(null);
    setEditingRanks(DEFAULT_RANKS);
    setTemplateName("");
    setTemplateDescription("");
    setView('edit');
  };

  const editTemplate = (template: RankTemplate) => {
    setIsCreatingNew(false);
    setSelectedTemplate(template);
    setEditingRanks([...template.ranks]);
    setTemplateName(template.name);
    setTemplateDescription(template.description);
    setView('edit');
  };

  const duplicateTemplate = (template: RankTemplate) => {
    const newTemplate: RankTemplate = {
      id: Math.random().toString(36).substr(2, 9),
      name: `${template.name} (Copy)`,
      description: template.description,
      ranks: template.ranks.map(r => ({ ...r, id: Math.random().toString(36).substr(2, 9) })),
      createdAt: new Date()
    };
    setTemplates([...templates, newTemplate]);
    toast.success("Template duplicated successfully");
  };

  const deleteTemplate = (id: string) => {
    if (templates.find(t => t.id === id)?.isDefault) {
      toast.error("Cannot delete default template");
      return;
    }
    setTemplates(templates.filter(t => t.id !== id));
    toast.success("Template deleted successfully");
  };

  const addRank = () => {
    const lastRank = editingRanks[editingRanks.length - 1];
    const newMin = lastRank ? lastRank.maxScore + 1 : 0;
    const newRank: RankItem = {
      id: Math.random().toString(36).substr(2, 9),
      label: "NEW",
      name: "",
      minScore: newMin,
      maxScore: Math.min(newMin + 10, 100),
      increment: 0,
      bonus: 0,
    };
    setEditingRanks([...editingRanks, newRank]);
  };

  const removeRank = (id: string) => {
    setEditingRanks(editingRanks.filter(r => r.id !== id));
  };

  const updateRank = (id: string, field: keyof RankItem, value: any) => {
    setEditingRanks(editingRanks.map(r => r.id === id ? { ...r, [field]: value } : r));
  };

  const handleSave = () => {
    if (!templateName.trim()) {
      toast.error("Please enter a template name");
      return;
    }

    if (isCreatingNew) {
      const newTemplate: RankTemplate = {
        id: Math.random().toString(36).substr(2, 9),
        name: templateName,
        description: templateDescription,
        ranks: editingRanks,
        createdAt: new Date()
      };
      setTemplates([...templates, newTemplate]);
      toast.success("Rank template created successfully");
    } else if (selectedTemplate) {
      setTemplates(templates.map(t => 
        t.id === selectedTemplate.id 
          ? { ...t, name: templateName, description: templateDescription, ranks: editingRanks }
          : t
      ));
      toast.success("Rank template updated successfully");
    }
    
    setView('list');
  };

  const handleCancel = () => {
    setView('list');
    setSelectedTemplate(null);
    setEditingRanks([]);
    setTemplateName("");
    setTemplateDescription("");
  };

  if (view === 'list') {
    return (
      <div className="flex-1 flex flex-col h-screen overflow-hidden bg-white font-normal">
        <TopHeader />
        
        <main className="flex-1 overflow-y-auto p-6 no-scrollbar">
          {/* Header */}
          <div className="flex items-center justify-between mb-8">
            <div className="space-y-1">
              <div className="flex items-center gap-1.5 text-[10px] font-normal text-gray-500 uppercase tracking-widest">
                <span>Evaluation</span>
                <ChevronRight className="w-2.5 h-2.5" />
                <span className="text-[#2580D3]">Rank Setup</span>
              </div>
              <div className="flex items-center gap-4">
                <h1 className="text-[20px] font-normal text-gray-900 tracking-tight">Rank Templates</h1>
              </div>
              <p className="text-[11px] text-[#94989C]">Create and manage performance ranking templates</p>
            </div>
            
            <button 
              onClick={createNewTemplate}
              className="px-6 py-2 bg-[#2580D3] text-white rounded-[3px] font-normal text-[12px] hover:bg-[#1e6bb3] transition-all shadow-md active:scale-95 uppercase tracking-wide flex items-center gap-2"
            >
              <PlusCircle className="w-4 h-4" />
              Create Template
            </button>
          </div>

          {/* Templates Table */}
          <div className="bg-white border border-gray-100 rounded-[3px] overflow-hidden">
            <table className="w-full text-left border-collapse">
              <thead>
                <tr className="bg-gray-50/50 border-b border-gray-100">
                  <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest">Template Name</th>
                  <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest">Description</th>
                  <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest w-24 text-center">Tiers</th>
                  <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest w-32">Created</th>
                  <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest w-64 text-center">Actions</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-gray-50">
                {templates.map((template) => (
                  <tr key={template.id} className="hover:bg-gray-50/30 transition-colors group">
                    <td className="px-6 py-4">
                      <div className="flex items-center gap-2">
                        <div className="w-8 h-8 bg-blue-50 rounded-[3px] flex items-center justify-center shrink-0">
                          <FileText className="w-4 h-4 text-[#2580D3]" />
                        </div>
                        <div>
                          <div className="text-[12px] font-normal text-gray-900 leading-tight">{template.name}</div>
                          {template.isDefault && (
                            <span className="inline-block mt-1 text-[9px] px-2 py-0.5 bg-blue-50 text-[#2580D3] rounded-full uppercase tracking-widest">
                              Default
                            </span>
                          )}
                        </div>
                      </div>
                    </td>
                    <td className="px-6 py-4">
                      <p className="text-[11px] text-gray-500 leading-relaxed max-w-md">
                        {template.description}
                      </p>
                    </td>
                    <td className="px-6 py-4 text-center">
                      <span className="text-[12px] text-gray-600">{template.ranks.length} tiers</span>
                    </td>
                    <td className="px-6 py-4">
                      <span className="text-[11px] text-gray-500">
                        {template.createdAt.toLocaleDateString('en-US', { month: 'numeric', day: 'numeric', year: 'numeric' })}
                      </span>
                    </td>
                    <td className="px-6 py-4">
                      <div className="flex items-center justify-center gap-2">
                        <button
                          onClick={() => editTemplate(template)}
                          className="px-4 py-1.5 bg-[#2580D3] text-white rounded-[3px] text-[11px] hover:bg-[#1e6bb3] transition-all flex items-center gap-1.5"
                        >
                          <Edit2 className="w-3.5 h-3.5" />
                          Edit
                        </button>
                        <button
                          onClick={() => duplicateTemplate(template)}
                          className="p-1.5 bg-gray-50 text-gray-600 rounded-[3px] hover:bg-gray-100 transition-all"
                          title="Duplicate"
                        >
                          <Copy className="w-3.5 h-3.5" />
                        </button>
                        {!template.isDefault && (
                          <button
                            onClick={() => deleteTemplate(template.id)}
                            className="p-1.5 bg-gray-50 text-gray-400 rounded-[3px] hover:bg-red-50 hover:text-red-500 transition-all"
                            title="Delete"
                          >
                            <Trash2 className="w-3.5 h-3.5" />
                          </button>
                        )}
                      </div>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>

        </main>
      </div>
    );
  }

  // Edit View
  return (
    <div className="flex-1 flex flex-col h-screen overflow-hidden bg-white font-normal">
      <TopHeader />
      
      <main className="flex-1 overflow-y-auto p-6 no-scrollbar">
        {/* Header */}
        <div className="flex items-center justify-between mb-8">
          <div className="space-y-1">
            <div className="flex items-center gap-1.5 text-[10px] font-normal text-gray-500 uppercase tracking-widest">
              <span>Evaluation</span>
              <ChevronRight className="w-2.5 h-2.5" />
              <span className="text-[#2580D3]">Rank Setup</span>
            </div>
            <div className="flex items-center gap-4">
              <h1 className="text-[20px] font-normal text-gray-900 tracking-tight">
                {isCreatingNew ? 'Create New Template' : 'Edit Template'}
              </h1>
            </div>
          </div>
          
          <div className="flex items-center gap-3">
            <button 
              onClick={handleCancel}
              className="px-6 py-2 bg-gray-100 text-gray-600 rounded-[3px] font-normal text-[12px] hover:bg-gray-200 transition-all uppercase tracking-wide"
            >
              Cancel
            </button>
            <button 
              onClick={handleSave}
              className="px-8 py-2 bg-[#2580D3] text-white rounded-[3px] font-normal text-[12px] hover:bg-[#1e6bb3] transition-all shadow-md active:scale-95 uppercase tracking-wide"
            >
              Save
            </button>
          </div>
        </div>

        {/* Template Info */}
        <div className="mb-6 p-5 bg-gray-50 border border-gray-100 rounded-[3px] space-y-4">
          <div className="grid grid-cols-2 gap-4">
            <div>
              <label className="block text-[10px] font-normal text-gray-500 uppercase tracking-widest mb-2">
                Template Name
              </label>
              <input
                type="text"
                value={templateName}
                onChange={(e) => setTemplateName(e.target.value)}
                placeholder="e.g., Standard Performance Scale"
                className="w-full px-3 py-2 bg-white border border-gray-200 rounded-[3px] text-[12px] font-normal text-gray-900 focus:border-[#2580D3] focus:ring-1 focus:ring-[#2580D3] outline-none"
              />
            </div>
            <div>
              <label className="block text-[10px] font-normal text-gray-500 uppercase tracking-widest mb-2">
                Description
              </label>
              <input
                type="text"
                value={templateDescription}
                onChange={(e) => setTemplateDescription(e.target.value)}
                placeholder="Brief description of this template"
                className="w-full px-3 py-2 bg-white border border-gray-200 rounded-[3px] text-[12px] font-normal text-gray-900 focus:border-[#2580D3] focus:ring-1 focus:ring-[#2580D3] outline-none"
              />
            </div>
          </div>
        </div>

        {/* Table Container */}
        <div className="bg-white border border-gray-100 rounded-[3px] overflow-hidden">
          <table className="w-full text-left border-collapse">
            <thead>
              <tr className="bg-gray-50/50 border-b border-gray-100">
                <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest w-20">Rank</th>
                <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest w-32">Name</th>
                <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest w-32">Score</th>
                <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest">Evaluation Score</th>
                <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest w-28">Increment</th>
                <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest w-28">Bonus</th>
                <th className="px-6 py-3 text-[10px] font-normal text-gray-400 uppercase tracking-widest w-20 text-center">Action</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-gray-50">
              {editingRanks.map((rank) => (
                <tr key={rank.id} className="hover:bg-gray-50/30 transition-colors group">
                  <td className="px-6 py-3">
                    <input 
                      type="text"
                      value={rank.label}
                      onChange={(e) => updateRank(rank.id, 'label', e.target.value)}
                      className="w-full bg-transparent border-none focus:ring-0 text-[13px] font-normal text-gray-900 uppercase placeholder-gray-300"
                      placeholder="e.g. A"
                    />
                  </td>
                  <td className="px-6 py-3">
                    <input 
                      type="text"
                      value={rank.name}
                      onChange={(e) => updateRank(rank.id, 'name', e.target.value)}
                      className="w-full bg-transparent border-none focus:ring-0 text-[11px] font-normal text-gray-600 placeholder-gray-300"
                      placeholder="Optional name"
                    />
                  </td>
                  <td className="px-6 py-3">
                    <div className="flex items-center gap-1.5 text-[13px] text-gray-600">
                      <input 
                        type="number"
                        value={rank.minScore}
                        onChange={(e) => updateRank(rank.id, 'minScore', parseInt(e.target.value) || 0)}
                        className="w-10 bg-transparent border-none p-0 focus:ring-0 text-center text-gray-500"
                      />
                      <span>-</span>
                      <input 
                        type="number"
                        value={rank.maxScore}
                        onChange={(e) => updateRank(rank.id, 'maxScore', parseInt(e.target.value) || 0)}
                        className="w-10 bg-transparent border-none p-0 focus:ring-0 text-center text-gray-500"
                      />
                    </div>
                  </td>
                  <td className="px-6 py-3 relative">
                    <div className="h-1.5 w-full bg-gray-100 rounded-full relative overflow-hidden">
                      <div 
                        className="absolute h-full bg-[#2580D3] transition-all duration-300 rounded-full"
                        style={{ 
                          left: `${rank.minScore}%`, 
                          width: `${Math.max(2, rank.maxScore - rank.minScore)}%` 
                        }}
                      />
                    </div>
                    {/* Floating Label over the bar */}
                    <div 
                      className="absolute top-1/2 -translate-y-1/2 pointer-events-none transition-all duration-300"
                      style={{ left: `${(rank.minScore + rank.maxScore) / 2}%` }}
                    >
                      <div className="bg-[#2580D3] text-white text-[9px] px-1.5 py-0.5 rounded-[2px] shadow-sm flex items-center gap-1 -translate-x-1/2 border border-white/20">
                        {rank.label}
                      </div>
                    </div>
                  </td>
                  <td className="px-6 py-3">
                    <input 
                      type="number"
                      step="0.1"
                      value={rank.increment}
                      onChange={(e) => updateRank(rank.id, 'increment', parseFloat(e.target.value) || 0)}
                      className="w-full bg-transparent border-none focus:ring-0 text-[13px] font-normal text-gray-900"
                    />
                  </td>
                  <td className="px-6 py-3">
                    <input 
                      type="number"
                      step="0.1"
                      value={rank.bonus}
                      onChange={(e) => updateRank(rank.id, 'bonus', parseFloat(e.target.value) || 0)}
                      className="w-full bg-transparent border-none focus:ring-0 text-[13px] font-normal text-gray-900"
                    />
                  </td>
                  <td className="px-6 py-3 text-center">
                    <button 
                      onClick={() => removeRank(rank.id)}
                      className="p-1.5 text-gray-300 hover:text-red-500 transition-colors opacity-0 group-hover:opacity-100"
                    >
                      <MinusCircle className="w-4 h-4" />
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
          
          {/* Empty State / Add Bottom Row */}
          <div className="p-3 bg-gray-50/30 border-t border-gray-50 flex justify-center">
            <button 
              onClick={addRank}
              className="flex items-center gap-2 text-[11px] font-normal text-gray-400 hover:text-[#2580D3] transition-colors uppercase tracking-widest"
            >
              <Plus className="w-3.5 h-3.5" />
              Add new tier
            </button>
          </div>
        </div>

        {/* Info Legend */}
        <div className="mt-8 p-4 bg-blue-50/30 border border-blue-100 rounded-[3px] flex items-start gap-3">
          <Info className="w-4 h-4 text-[#2580D3] shrink-0 mt-0.5" />
          <div className="space-y-1">
            <h4 className="text-[12px] font-normal text-gray-900 uppercase tracking-tight">Configuration Guide</h4>
            <p className="text-[11px] text-gray-500 leading-relaxed max-w-2xl">
              Define performance tiers by mapping evaluation scores to specific reward multipliers. Increment values adjust the base salary, while bonus values define the multiple of performance-based payouts.
            </p>
          </div>
        </div>
      </main>
    </div>
  );
}