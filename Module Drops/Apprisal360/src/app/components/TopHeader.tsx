import React from "react";
import { Search, Bell, ChevronDown, Command } from "lucide-react";

const AVATAR_URL = "https://images.unsplash.com/photo-1672685667592-0392f458f46f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwcm9mZXNzaW9uYWwlMjBtYW4lMjBwb3J0cmFpdCUyMGhlYWRzaG90fGVufDF8fHx8MTc2OTQ3OTU0MXww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral";

export function TopHeader() {
  return (
    <header className="h-12 bg-white border-b border-gray-100 flex items-center justify-between px-4 sticky top-0 z-30">
      <div className="flex items-center gap-6">
        {/* Company Selector */}
        <button className="flex items-center gap-2 px-3 py-1 bg-gray-50/50 border border-gray-100 rounded-[3px] hover:bg-gray-100 transition-colors">
          <div className="w-5 h-5 bg-white border border-gray-100 rounded-[2px] flex items-center justify-center overflow-hidden shrink-0">
            <div className="w-3 h-3 bg-red-600 rounded-full scale-75" /> {/* Representative icon */}
          </div>
          <div className="text-left">
            <div className="text-[11px] font-normal text-gray-700 leading-none">Mitsubishi Co., Limited</div>
            <div className="text-[9px] font-normal text-gray-500 mt-0.5 uppercase tracking-wider">Company</div>
          </div>
          <ChevronDown className="w-3 h-3 text-gray-400 ml-2" />
        </button>

        {/* Search Bar */}
        <div className="flex items-center bg-gray-50/50 px-2.5 py-1 rounded-[3px] border border-gray-100 min-w-[200px] group focus-within:bg-white focus-within:border-blue-200 transition-all">
          <Search className="w-3.5 h-3.5 text-gray-500 mr-2" />
          <input 
            type="text" 
            placeholder="Search" 
            className="bg-transparent border-none outline-none text-[11px] font-normal w-full text-gray-700 placeholder:text-gray-500"
          />
          <div className="flex items-center gap-0.5 px-1 py-0.5 bg-white border border-gray-100 rounded-[2px] ml-2">
            <Command className="w-2.5 h-2.5 text-gray-400" />
            <span className="text-[9px] text-gray-400 font-normal">K</span>
          </div>
        </div>
      </div>

      <div className="flex items-center gap-2">
        {/* User Profile */}
        <button className="flex items-center gap-3 px-2 py-1 hover:bg-gray-50 rounded-[3px] transition-colors group">
          <div className="text-right">
            <div className="text-[12px] font-normal text-gray-900 leading-none">Shuhei Takahashi</div>
            <div className="text-[10px] font-normal text-gray-500 mt-0.5">Chief Operating Officer</div>
          </div>
          <div className="relative">
            <img 
              src={AVATAR_URL} 
              alt="Profile" 
              className="w-7 h-7 rounded-[3px] object-cover border border-gray-100"
            />
          </div>
          <ChevronDown className="w-3 h-3 text-gray-400" />
        </button>

        <div className="h-6 w-px bg-gray-100 mx-1" />

        {/* Notifications */}
        <button className="flex items-center gap-2 px-2 py-1 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-[3px] transition-colors">
          <Bell className="w-4 h-4" />
          <span className="text-[11px] font-normal">15</span>
        </button>
      </div>
    </header>
  );
}
