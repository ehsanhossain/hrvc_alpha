import React, { useState } from "react";
import { X, Upload, FileSpreadsheet, CheckCircle2, AlertCircle, ChevronRight } from "lucide-react";

interface Props {
  isOpen: boolean;
  onClose: () => void;
  onImport: (data: any[]) => void;
}

export function ImportSalaryModal({ isOpen, onClose, onImport }: Props) {
  const [step, setStep] = useState<1 | 2>(1);
  const [isUploading, setIsUploading] = useState(false);

  if (!isOpen) return null;

  const handleUpload = () => {
    setIsUploading(true);
    setTimeout(() => {
      setIsUploading(false);
      setStep(2);
    }, 1500);
  };

  const MOCK_MAPPINGS = [
    { source: "EMP_ID", target: "Employee ID", status: "matched" },
    { source: "FULL_NAME", target: "Name", status: "matched" },
    { source: "BASIC_PAY", target: "Basic", status: "matched" },
    { source: "HRA", target: "House Rent", status: "matched" },
    { source: "MISC", target: "Extra", status: "unmatched" },
  ];

  return (
    <div className="fixed inset-0 z-[100] flex items-center justify-center bg-black/20 backdrop-blur-[2px]">
      <div className="bg-white w-full max-w-lg rounded-[3px] shadow-2xl border border-gray-100 overflow-hidden flex flex-col">
        <div className="px-6 py-4 border-b border-gray-50 flex items-center justify-between bg-white shrink-0">
          <div className="flex items-center gap-2">
            <div className="w-8 h-8 bg-orange-50 rounded-[3px] flex items-center justify-center">
              <Upload className="w-4 h-4 text-orange-600" />
            </div>
            <div>
              <h2 className="text-[15px] font-normal text-gray-900 tracking-tight">Import Salary Sheet</h2>
              <p className="text-[10px] text-gray-400 uppercase tracking-widest">Excel or CSV upload</p>
            </div>
          </div>
          <button onClick={onClose} className="p-2 hover:bg-gray-50 rounded-[3px] transition-colors">
            <X className="w-4 h-4 text-gray-400" />
          </button>
        </div>

        <div className="p-8">
          {step === 1 ? (
            <div className="space-y-6">
              <div 
                className={`border-2 border-dashed rounded-[3px] p-10 flex flex-col items-center justify-center transition-all
                  ${isUploading ? 'border-orange-200 bg-orange-50/10' : 'border-gray-100 bg-gray-50/30 hover:border-orange-200 hover:bg-orange-50/10 cursor-pointer'}
                `}
                onClick={() => !isUploading && handleUpload()}
              >
                {isUploading ? (
                  <div className="flex flex-col items-center gap-3">
                    <div className="w-10 h-10 border-2 border-orange-600 border-t-transparent rounded-full animate-spin" />
                    <p className="text-[12px] text-orange-600 font-normal">Processing sheet data...</p>
                  </div>
                ) : (
                  <>
                    <div className="w-12 h-12 bg-white rounded-full shadow-sm flex items-center justify-center mb-4">
                      <FileSpreadsheet className="w-6 h-6 text-gray-300" />
                    </div>
                    <p className="text-[13px] text-gray-600 font-normal mb-1">Click to browse or drag and drop</p>
                    <p className="text-[11px] text-gray-400">Supported formats: .xlsx, .csv (Max 10MB)</p>
                  </>
                )}
              </div>
              
              <div className="space-y-3">
                <h4 className="text-[10px] font-normal text-gray-400 uppercase tracking-widest">Requirements</h4>
                <div className="space-y-2">
                  {[
                    "Employee ID must match system records",
                    "Currency must be consistent across all rows",
                    "Date format should be YYYY-MM-DD"
                  ].map((req, i) => (
                    <div key={i} className="flex items-center gap-2 text-[11px] text-gray-500">
                      <div className="w-1 h-1 bg-orange-300 rounded-full" />
                      {req}
                    </div>
                  ))}
                </div>
              </div>
            </div>
          ) : (
            <div className="space-y-6">
              <div className="space-y-3">
                <h4 className="text-[10px] font-normal text-gray-400 uppercase tracking-widest">Column Mapping</h4>
                <div className="border border-gray-100 rounded-[3px] overflow-hidden">
                  {MOCK_MAPPINGS.map((mapping, i) => (
                    <div key={i} className="flex items-center justify-between p-3 border-b border-gray-50 last:border-none bg-white">
                      <div className="flex items-center gap-4">
                        <span className="text-[11px] font-normal text-gray-400 font-mono">{mapping.source}</span>
                        <ChevronRight className="w-3 h-3 text-gray-200" />
                        <span className="text-[12px] font-normal text-gray-700">{mapping.target}</span>
                      </div>
                      {mapping.status === "matched" ? (
                        <CheckCircle2 className="w-3.5 h-3.5 text-green-500" />
                      ) : (
                        <div className="flex items-center gap-1 text-[10px] text-orange-500">
                          <AlertCircle className="w-3 h-3" />
                          Manual fix needed
                        </div>
                      )}
                    </div>
                  ))}
                </div>
              </div>

              <div className="p-4 bg-green-50/50 border border-green-50 rounded-[3px] flex gap-3">
                <CheckCircle2 className="w-4 h-4 text-green-500 shrink-0 mt-0.5" />
                <p className="text-[11px] text-gray-600 leading-relaxed font-normal">
                  <span className="font-normal text-green-700">Mapping complete.</span> 124 records detected. No critical errors found in data types.
                </p>
              </div>
            </div>
          )}
        </div>

        <div className="px-6 py-4 border-t border-gray-50 bg-gray-50/50 flex items-center justify-end gap-3 shrink-0">
          <button 
            onClick={onClose}
            className="px-4 py-2 text-[12px] text-gray-500 font-normal hover:text-gray-700"
          >
            Cancel
          </button>
          <button 
            onClick={() => {
              if (step === 1) handleUpload();
              else {
                onImport([]);
                onClose();
              }
            }}
            className="px-6 py-2 bg-orange-600 text-white rounded-[3px] text-[12px] font-normal hover:bg-orange-700 shadow-sm transition-all active:scale-95 flex items-center gap-2"
          >
            {step === 1 ? "Scan File" : "Finish Import"}
          </button>
        </div>
      </div>
    </div>
  );
}
