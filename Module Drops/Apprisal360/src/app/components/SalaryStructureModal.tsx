import React, { useState } from "react";
import { X, Plus, Trash2, GripVertical, Settings2, Info } from "lucide-react";

export interface SalaryComponent {
  id: string;
  name: string;
  shortName: string;
  type: "Fixed" | "Percentage";
  defaultValue: number;
}

interface Props {
  isOpen: boolean;
  onClose: () => void;
  components: SalaryComponent[];
  onSave: (components: SalaryComponent[]) => void;
}

export function SalaryStructureModal({ isOpen, onClose, components: initialComponents, onSave }: Props) {
  const [components, setComponents] = useState<SalaryComponent[]>(initialComponents);

  if (!isOpen) return null;

  const addComponent = () => {
    const newComp: SalaryComponent = {
      id: Math.random().toString(36).substr(2, 9),
      name: "New Component",
      shortName: "NEW",
      type: "Fixed",
      defaultValue: 0
    };
    setComponents([...components, newComp]);
  };

  const removeComponent = (id: string) => {
    setComponents(components.filter(c => c.id !== id));
  };

  const updateComponent = (id: string, field: keyof SalaryComponent, value: any) => {
    setComponents(components.map(c => c.id === id ? { ...c, [field]: value } : c));
  };

  return (
    <div className="fixed inset-0 z-[100] flex items-center justify-center bg-black/20 backdrop-blur-[2px]">
      <div className="bg-white w-full max-w-xl rounded-[3px] shadow-2xl border border-gray-100 overflow-hidden flex flex-col max-h-[90vh]">
        <div className="px-6 py-4 border-b border-gray-50 flex items-center justify-between bg-white shrink-0">
          <div className="flex items-center gap-2">
            <div className="w-8 h-8 bg-blue-50 rounded-[3px] flex items-center justify-center">
              <Settings2 className="w-4 h-4 text-[#2580D3]" />
            </div>
            <div>
              <h2 className="text-[15px] font-normal text-gray-900 tracking-tight">Salary Structure Configuration</h2>
              <p className="text-[10px] text-gray-400 uppercase tracking-widest">Define components and default values</p>
            </div>
          </div>
          <button onClick={onClose} className="p-2 hover:bg-gray-50 rounded-[3px] transition-colors">
            <X className="w-4 h-4 text-gray-400" />
          </button>
        </div>

        <div className="p-6 overflow-y-auto no-scrollbar flex-1 space-y-4">
          <div className="bg-blue-50/30 p-4 border border-blue-50 rounded-[3px] flex gap-3">
            <Info className="w-4 h-4 text-[#2580D3] shrink-0 mt-0.5" />
            <p className="text-[11px] text-gray-500 leading-relaxed font-normal">
              Changes to the structure will update the payroll sheet columns. Fixed components are absolute amounts, while Percentage components can be calculated during processing.
            </p>
          </div>

          <div className="space-y-2">
            <div className="grid grid-cols-12 gap-3 px-3 text-[9px] font-normal text-gray-400 uppercase tracking-widest mb-1">
              <div className="col-span-5">Component Name</div>
              <div className="col-span-2 text-center">Code</div>
              <div className="col-span-2 text-center">Type</div>
              <div className="col-span-2 text-right">Default</div>
              <div className="col-span-1"></div>
            </div>

            <div className="space-y-1.5">
              {components.map((comp) => (
                <div key={comp.id} className="grid grid-cols-12 gap-3 items-center bg-gray-50/50 p-2 rounded-[3px] border border-gray-100 group">
                  <div className="col-span-5 flex items-center gap-2">
                    <GripVertical className="w-3.5 h-3.5 text-gray-300 cursor-grab" />
                    <input 
                      type="text" 
                      value={comp.name}
                      onChange={(e) => updateComponent(comp.id, 'name', e.target.value)}
                      className="w-full bg-white border border-gray-100 rounded-[2px] px-2 py-1.5 text-[12px] font-normal outline-none focus:border-[#2580D3]"
                    />
                  </div>
                  <div className="col-span-2">
                    <input 
                      type="text" 
                      value={comp.shortName}
                      onChange={(e) => updateComponent(comp.id, 'shortName', e.target.value.toUpperCase())}
                      className="w-full bg-white border border-gray-100 rounded-[2px] px-2 py-1.5 text-[11px] font-normal text-center outline-none focus:border-[#2580D3]"
                      maxLength={4}
                    />
                  </div>
                  <div className="col-span-2">
                    <select 
                      value={comp.type}
                      onChange={(e) => updateComponent(comp.id, 'type', e.target.value)}
                      className="w-full bg-white border border-gray-100 rounded-[2px] px-1 py-1.5 text-[11px] font-normal outline-none focus:border-[#2580D3] appearance-none text-center"
                    >
                      <option value="Fixed">$</option>
                      <option value="Percentage">%</option>
                    </select>
                  </div>
                  <div className="col-span-2">
                    <input 
                      type="number" 
                      value={comp.defaultValue}
                      onChange={(e) => updateComponent(comp.id, 'defaultValue', parseFloat(e.target.value) || 0)}
                      className="w-full bg-white border border-gray-100 rounded-[2px] px-2 py-1.5 text-[12px] font-normal text-right outline-none focus:border-[#2580D3]"
                    />
                  </div>
                  <div className="col-span-1 flex justify-end">
                    <button 
                      onClick={() => removeComponent(comp.id)}
                      className="p-1.5 text-gray-300 hover:text-red-500 transition-colors opacity-0 group-hover:opacity-100"
                    >
                      <Trash2 className="w-3.5 h-3.5" />
                    </button>
                  </div>
                </div>
              ))}
            </div>

            <button 
              onClick={addComponent}
              className="w-full py-2.5 border border-dashed border-gray-200 rounded-[3px] text-[11px] text-gray-400 hover:text-[#2580D3] hover:border-[#2580D3] hover:bg-blue-50/30 transition-all flex items-center justify-center gap-2 mt-4"
            >
              <Plus className="w-3.5 h-3.5" />
              Add New Component
            </button>
          </div>
        </div>

        <div className="px-6 py-4 border-t border-gray-50 bg-gray-50/50 flex items-center justify-end gap-3 shrink-0">
          <button 
            onClick={onClose}
            className="px-4 py-2 text-[12px] text-gray-500 font-normal hover:text-gray-700"
          >
            Cancel
          </button>
          <button 
            onClick={() => onSave(components)}
            className="px-6 py-2 bg-[#2580D3] text-white rounded-[3px] text-[12px] font-normal hover:bg-[#1e6bb3] shadow-sm transition-all active:scale-95"
          >
            Update Structure
          </button>
        </div>
      </div>
    </div>
  );
}
