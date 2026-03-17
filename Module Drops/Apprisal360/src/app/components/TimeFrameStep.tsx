import React, { useState, useRef, useEffect } from "react";
import { Calendar, Clock, DollarSign, CalendarCheck, Calendar as CalendarIcon, ArrowRight, Info, AlertCircle } from "lucide-react";
import { EvaluationState } from "../types";
import { DateRangePicker } from "./DateRangePicker";
import { format, parseISO, isValid, addMonths, subDays, differenceInDays } from "date-fns";
import { AnimatePresence, motion } from "motion/react";

interface Props {
  state: EvaluationState;
  setState: React.Dispatch<React.SetStateAction<EvaluationState>>;
}

const INTERVALS = ["Annual", "Half-yearly", "Triannual", "Quarterly"];
const MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

export function TimeFrameStep({ state, setState }: Props) {
  const [isDatePickerOpen, setIsDatePickerOpen] = useState(false);
  const datePickerRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const handleClickOutside = (event: MouseEvent) => {
      if (datePickerRef.current && !datePickerRef.current.contains(event.target as Node)) {
        setIsDatePickerOpen(false);
      }
    };
    document.addEventListener("mousedown", handleClickOutside);
    return () => document.removeEventListener("mousedown", handleClickOutside);
  }, []);

  const startDate = state.timeFrame.startDate ? parseISO(state.timeFrame.startDate) : null;
  const endDate = state.timeFrame.endDate ? parseISO(state.timeFrame.endDate) : null;

  const handleDateChange = (start: Date | null, end: Date | null) => {
    const newStart = start ? format(start, 'yyyy-MM-dd') : "";
    const newEnd = end ? format(end, 'yyyy-MM-dd') : "";
    
    const newPeriods = state.timeFrame.interval === 'Annual' 
      ? [{ id: '1', name: 'Annual Period', startDate: newStart, endDate: newEnd }]
      : generateDefaultPeriods(newStart, newEnd, state.timeFrame.interval);

    setState(prev => ({
      ...prev,
      timeFrame: {
        ...prev.timeFrame,
        startDate: newStart,
        endDate: newEnd,
        periods: newPeriods
      }
    }));
  };

  const handleIntervalChange = (interval: any) => {
    const newPeriods = interval === 'Annual'
      ? [{ id: '1', name: 'Annual Period', startDate: state.timeFrame.startDate, endDate: state.timeFrame.endDate }]
      : generateDefaultPeriods(state.timeFrame.startDate, state.timeFrame.endDate, interval);

    setState(prev => ({
      ...prev,
      timeFrame: {
        ...prev.timeFrame,
        interval,
        periods: newPeriods
      }
    }));
  };

  const generateDefaultPeriods = (start: string, end: string, interval: string) => {
    if (!start || !end) return [];
    const s = parseISO(start);
    const e = parseISO(end);
    const count = interval === 'Half-yearly' ? 2 : interval === 'Triannual' ? 3 : 4;
    const totalDays = differenceInDays(e, s);
    
    const periods = [];
    for (let i = 0; i < count; i++) {
      const pStart = addMonths(s, i * (12 / count));
      const pEnd = i === count - 1 ? e : subDays(addMonths(s, (i + 1) * (12 / count)), 1);
      periods.push({
        id: Math.random().toString(36).substr(2, 9),
        name: `${interval} Period ${i + 1}`,
        startDate: format(pStart, 'yyyy-MM-dd'),
        endDate: format(pEnd, 'yyyy-MM-dd')
      });
    }
    return periods;
  };

  const updatePeriod = (id: string, field: 'startDate' | 'endDate', value: string) => {
    setState(prev => ({
      ...prev,
      timeFrame: {
        ...prev.timeFrame,
        periods: prev.timeFrame.periods.map(p => p.id === id ? { ...p, [field]: value } : p)
      }
    }));
  };

  return (
    <div className="p-6 space-y-8 bg-white min-h-[600px]">
      <section className="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <div className="space-y-4">
          <div className="flex items-center gap-2 mb-1">
            <div className="w-6 h-6 bg-[#2580D3]/10 rounded-[3px] flex items-center justify-center">
              <Calendar className="w-3.5 h-3.5 text-[#2580D3]" />
            </div>
            <h3 className="text-[14px] font-normal text-gray-900 uppercase tracking-tight">Evaluation Plan</h3>
          </div>
          
          <div className="relative" ref={datePickerRef}>
            <label className="text-[10px] font-normal text-muted-foreground uppercase tracking-widest mb-1.5 block">Time Frame Selection</label>
            <div 
              onClick={() => setIsDatePickerOpen(!isDatePickerOpen)}
              className={`
                w-full flex items-center justify-between px-4 py-3 bg-white border rounded-[3px] cursor-pointer transition-all group
                ${isDatePickerOpen ? 'border-[#2580D3] ring-1 ring-[#2580D3]/10' : 'border-[#f0f1f3] hover:border-gray-200'}
              `}
            >
              <div className="flex items-center gap-6">
                <div className="flex flex-col">
                  <span className="text-[10px] text-muted-foreground font-normal uppercase tracking-wider">Start</span>
                  <span className={`text-[13px] font-normal ${state.timeFrame.startDate ? 'text-gray-900' : 'text-gray-300'}`}>
                    {state.timeFrame.startDate ? format(parseISO(state.timeFrame.startDate), 'EEE, dd MMM yyyy') : 'Pick start date'}
                  </span>
                </div>
                <div className="flex items-center justify-center">
                  <ArrowRight className="w-4 h-4 text-gray-300" />
                </div>
                <div className="flex flex-col">
                  <span className="text-[10px] text-muted-foreground font-normal uppercase tracking-wider">End</span>
                  <span className={`text-[13px] font-normal ${state.timeFrame.endDate ? 'text-gray-900' : 'text-gray-300'}`}>
                    {state.timeFrame.endDate ? format(parseISO(state.timeFrame.endDate), 'EEE, dd MMM yyyy') : 'Pick end date'}
                  </span>
                </div>
              </div>
              <CalendarIcon className={`w-4 h-4 transition-colors ${isDatePickerOpen ? 'text-[#2580D3]' : 'text-muted-foreground group-hover:text-gray-600'}`} />
            </div>

            <AnimatePresence>
              {isDatePickerOpen && (
                <DateRangePicker 
                  startDate={startDate && isValid(startDate) ? startDate : null}
                  endDate={endDate && isValid(endDate) ? endDate : null}
                  onChange={handleDateChange}
                  onClose={() => setIsDatePickerOpen(false)}
                />
              )}
            </AnimatePresence>
          </div>

          <div className="p-4 bg-gray-50/30 rounded-[3px] border border-gray-100 space-y-3">
            <div className="flex items-center justify-between">
              <div className="flex items-center gap-2">
                <CalendarCheck className="w-4 h-4 text-gray-400" />
                <span className="text-[12px] font-normal text-gray-900">Mid-Term Review</span>
              </div>
              <label className="relative inline-flex items-center cursor-pointer scale-90">
                <input 
                  type="checkbox" 
                  className="sr-only peer"
                  checked={state.timeFrame.midTermReview}
                  onChange={(e) => setState(prev => ({ ...prev, timeFrame: { ...prev.timeFrame, midTermReview: e.target.checked } }))}
                />
                <div className="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#2580D3]" />
              </label>
            </div>
          </div>
        </div>

        <div className="space-y-6">
          <div className="flex items-center gap-2 mb-1">
            <div className="w-6 h-6 bg-purple-50 rounded-[3px] flex items-center justify-center">
              <Clock className="w-3.5 h-3.5 text-purple-600" />
            </div>
            <h3 className="text-[14px] font-normal text-gray-900 uppercase tracking-tight">Interval Configuration</h3>
          </div>

          <div className="grid grid-cols-2 gap-2">
            {INTERVALS.map((interval) => {
              const isSelected = state.timeFrame.interval === interval;
              return (
                <button
                  key={interval}
                  onClick={() => handleIntervalChange(interval)}
                  className={`px-4 py-2.5 rounded-[3px] border font-normal transition-all text-left text-[13px] flex items-center justify-between
                    ${isSelected ? 'border-[#2580D3] bg-[#2580D3]/5 text-[#2580D3] ring-1 ring-[#2580D3]/20' : 'border-[#f0f1f3] text-gray-500 hover:bg-gray-50'}
                  `}
                >
                  {interval}
                  {isSelected && <div className="w-1.5 h-1.5 rounded-full bg-[#2580D3]" />}
                </button>
              );
            })}
          </div>

          {state.timeFrame.interval !== 'Annual' && (
            <motion.div 
              initial={{ opacity: 0, y: 10 }}
              animate={{ opacity: 1, y: 0 }}
              className="space-y-3"
            >
              <div className="flex items-center gap-2 text-[10px] text-[#2580D3] uppercase tracking-widest font-medium">
                <AlertCircle className="w-3.5 h-3.5" />
                <span>Define {state.timeFrame.interval} Sub-Periods</span>
              </div>
              <div className="space-y-2">
                {state.timeFrame.periods.map((period, idx) => (
                  <div key={period.id} className="flex items-center gap-3 p-3 bg-gray-50/50 border border-gray-100 rounded-[3px] hover:border-gray-200 transition-colors">
                    <span className="text-[11px] font-medium text-gray-400 w-24 truncate">{period.name}</span>
                    <div className="flex-1 grid grid-cols-2 gap-2">
                      <input 
                        type="date"
                        value={period.startDate}
                        onChange={(e) => updatePeriod(period.id, 'startDate', e.target.value)}
                        className="px-2 py-1.5 bg-white border border-gray-200 rounded-[2px] text-[11px] outline-none focus:border-[#2580D3]"
                      />
                      <input 
                        type="date"
                        value={period.endDate}
                        onChange={(e) => updatePeriod(period.id, 'endDate', e.target.value)}
                        className="px-2 py-1.5 bg-white border border-gray-200 rounded-[2px] text-[11px] outline-none focus:border-[#2580D3]"
                      />
                    </div>
                  </div>
                ))}
              </div>
            </motion.div>
          )}
        </div>
      </section>
    </div>
  );
}