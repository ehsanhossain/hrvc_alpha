import React from "react";
import { Construction, ArrowLeft } from "lucide-react";
import { motion } from "motion/react";
import { TopHeader } from "./TopHeader";

interface ComingSoonProps {
  featureName: string;
  onBack: () => void;
}

export function ComingSoon({ featureName, onBack }: ComingSoonProps) {
  // Extract a readable name from the path if needed, or just use the passed name
  const displayTitle = featureName
    .split('/')
    .pop()
    ?.split('-')
    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
    .join(' ') || "Feature";

  return (
    <div className="flex-1 flex flex-col h-screen overflow-hidden bg-white font-normal">
      <TopHeader />
      
      <main className="flex-1 flex items-center justify-center p-10 bg-gray-50/30">
        <motion.div 
          initial={{ opacity: 0, y: 10 }}
          animate={{ opacity: 1, y: 0 }}
          className="max-w-md w-full text-center space-y-6"
        >
          <div className="w-16 h-16 bg-[#2580D3]/5 rounded-[3px] flex items-center justify-center mx-auto border border-[#2580D3]/10">
            <Construction className="w-8 h-8 text-[#2580D3]" />
          </div>
          
          <div className="space-y-2">
            <h2 className="text-[24px] font-normal text-gray-900 tracking-tight">{displayTitle}</h2>
            <p className="text-[13px] text-gray-500 max-w-xs mx-auto">
              We're currently building this feature to meet our ultra-compact design standards. Check back soon for updates.
            </p>
          </div>

          <div className="pt-4">
            <button 
              onClick={onBack}
              className="px-6 py-2 bg-white border border-gray-200 text-gray-600 rounded-[3px] text-[12px] font-normal hover:bg-gray-50 transition-all flex items-center gap-2 mx-auto active:scale-95"
            >
              <ArrowLeft className="w-3.5 h-3.5" />
              Back to Create Evaluation
            </button>
          </div>

          <div className="pt-12 flex items-center justify-center gap-8 opacity-20 grayscale">
             {/* Subtle branding or progress indicator */}
             <div className="h-0.5 w-12 bg-gray-300" />
             <span className="text-[10px] uppercase tracking-[0.2em] text-gray-400">Under Construction</span>
             <div className="h-0.5 w-12 bg-gray-300" />
          </div>
        </motion.div>
      </main>
    </div>
  );
}
