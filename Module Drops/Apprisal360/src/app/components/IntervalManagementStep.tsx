import React, { useState, useMemo, useCallback, useRef } from "react";
import { Plus, Trash2, Calendar, GripVertical, Info, Layers, UserCheck, HelpCircle } from "lucide-react";
import { EvaluationState, TimelineEvent } from "../types";
import { format, parseISO, differenceInDays, addDays, eachMonthOfInterval, endOfMonth, startOfMonth, isSameDay } from "date-fns";
import { motion, AnimatePresence } from "motion/react";
import { useDrag, useDrop } from "react-dnd";

interface Props {
  state: EvaluationState;
  setState: React.Dispatch<React.SetStateAction<EvaluationState>>;
}

const ITEM_TYPE = "MILESTONE";

interface DraggableMilestoneProps {
  event: TimelineEvent;
  index: number;
  moveMilestone: (dragIndex: number, hoverIndex: number) => void;
  updateEvent: (id: string, field: keyof TimelineEvent, value: string) => void;
  removeEvent: (id: string) => void;
}

const DraggableMilestone = ({ event, index, moveMilestone, updateEvent, removeEvent }: DraggableMilestoneProps) => {
  const ref = useRef<HTMLDivElement>(null);
  
  const [, drop] = useDrop({
    accept: ITEM_TYPE,
    hover(item: { index: number }, monitor) {
      if (!ref.current) return;
      const dragIndex = item.index;
      const hoverIndex = index;
      if (dragIndex === hoverIndex) return;
      moveMilestone(dragIndex, hoverIndex);
      item.index = hoverIndex;
    },
  });

  const [{ isDragging }, drag] = useDrag({
    type: ITEM_TYPE,
    item: { index },
    collect: (monitor) => ({
      isDragging: monitor.isDragging(),
    }),
  });

  drag(drop(ref));

  return (
    <motion.div 
      ref={ref}
      layout
      initial={{ opacity: 0, y: 5 }}
      animate={{ opacity: isDragging ? 0.4 : 1, y: 0 }}
      exit={{ opacity: 0, scale: 0.95 }}
      className="grid grid-cols-12 gap-4 items-center bg-white p-2.5 rounded-[3px] border border-[#f0f1f3] hover:border-[#2580D3]/30 transition-all group shadow-sm mb-1.5"
    >
      <div className="col-span-1 flex justify-center text-gray-300 group-hover:text-[#2580D3] transition-colors cursor-grab active:cursor-grabbing">
        <GripVertical className="w-4 h-4" />
      </div>
      
      <div className="col-span-5">
        <input 
          type="text"
          value={event.name}
          onChange={(e) => updateEvent(event.id, 'name', e.target.value)}
          className="w-full px-2 py-1 bg-[#f9fafb] border border-[#f0f1f3] rounded-[2px] focus:ring-1 focus:ring-[#2580D3]/20 focus:border-[#2580D3] outline-none transition-all font-normal text-[12px] text-gray-700"
          placeholder="e.g., Self-Evaluation Period"
        />
      </div>

      <div className="col-span-3">
        <input 
          type="date"
          value={event.startDate}
          onChange={(e) => updateEvent(event.id, 'startDate', e.target.value)}
          className="w-full px-2 py-1 bg-[#f9fafb] border border-[#f0f1f3] rounded-[2px] focus:ring-1 focus:ring-[#2580D3]/20 focus:border-[#2580D3] outline-none transition-all font-normal text-[11px] text-gray-500"
        />
      </div>

      <div className="col-span-2">
        <input 
          type="date"
          value={event.endDate}
          onChange={(e) => updateEvent(event.id, 'endDate', e.target.value)}
          className="w-full px-2 py-1 bg-[#f9fafb] border border-[#f0f1f3] rounded-[2px] focus:ring-1 focus:ring-[#2580D3]/20 focus:border-[#2580D3] outline-none transition-all font-normal text-[11px] text-gray-500"
        />
      </div>

      <div className="col-span-1 flex justify-end">
        <button 
          onClick={() => removeEvent(event.id)}
          className="p-1.5 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-[2px] transition-all opacity-0 group-hover:opacity-100"
        >
          <Trash2 className="w-3.5 h-3.5" />
        </button>
      </div>
    </motion.div>
  );
};

export function IntervalManagementStep({ state, setState }: Props) {
  const [showLegend, setShowLegend] = useState(false);
  const cycleStart = parseISO(state.timeFrame.startDate || "2026-01-01");
  const cycleEnd = parseISO(state.timeFrame.endDate || "2026-12-31");
  const totalDays = useMemo(() => differenceInDays(cycleEnd, cycleStart) + 1, [cycleStart, cycleEnd]);

  const monthCols = useMemo(() => {
    const months = eachMonthOfInterval({ start: cycleStart, end: cycleEnd });
    return months.map(m => {
      const start = isSameDay(m, cycleStart) || m > cycleStart ? m : cycleStart;
      const mEnd = endOfMonth(m);
      const end = mEnd < cycleEnd ? mEnd : cycleEnd;
      const days = differenceInDays(end, start) + 1;
      return {
        label: format(m, 'MMM').toUpperCase(),
        width: (days / totalDays) * 100
      };
    });
  }, [cycleStart, cycleEnd, totalDays]);

  const midTermEvents = useMemo(() => {
    if (!state.timeFrame.midTermReview) return [];
    return state.timeFrame.periods.map(period => {
      const start = parseISO(period.startDate);
      const end = parseISO(period.endDate);
      const midDays = Math.floor(differenceInDays(end, start) / 2);
      const midDate = addDays(start, midDays);
      return {
        id: `mid-${period.id}`,
        name: `Mid-term`,
        date: midDate,
        formatted: format(midDate, 'yyyy-MM-dd')
      };
    });
  }, [state.timeFrame.periods, state.timeFrame.midTermReview]);

  const moveMilestone = useCallback((dragIndex: number, hoverIndex: number) => {
    setState(prev => {
      const newEvents = [...prev.timelineEvents];
      const draggedEvent = newEvents[dragIndex];
      newEvents.splice(dragIndex, 1);
      newEvents.splice(hoverIndex, 0, draggedEvent);
      return { ...prev, timelineEvents: newEvents };
    });
  }, [setState]);

  const addEvent = () => {
    const newEvent: TimelineEvent = {
      id: Math.random().toString(36).substr(2, 9),
      name: "New Milestone",
      startDate: state.timeFrame.startDate,
      endDate: format(addDays(parseISO(state.timeFrame.startDate), 14), 'yyyy-MM-dd'),
    };
    setState(prev => ({ ...prev, timelineEvents: [...prev.timelineEvents, newEvent] }));
  };

  const removeEvent = (id: string) => {
    setState(prev => ({ ...prev, timelineEvents: prev.timelineEvents.filter(e => e.id !== id) }));
  };

  const updateEvent = (id: string, field: keyof TimelineEvent, value: string) => {
    setState(prev => ({
      ...prev,
      timelineEvents: prev.timelineEvents.map(e => e.id === id ? { ...e, [field]: value } : e)
    }));
  };

  const getPositionStyles = (startStr: string, endStr: string) => {
    const start = parseISO(startStr);
    const end = parseISO(endStr);
    const daysFromStart = differenceInDays(start, cycleStart);
    const duration = differenceInDays(end, start) + 1;

    const left = (daysFromStart / totalDays) * 100;
    const width = (duration / totalDays) * 100;

    return {
      left: `${Math.max(0, left)}%`,
      width: `${Math.min(100 - left, width)}%`
    };
  };

  return (
    <div className="p-6 space-y-8 bg-white min-h-[600px]">
      <div className="flex items-center justify-between">
        <div>
          <h3 className="text-[18px] font-normal text-gray-900 tracking-tight">Interval Management & Timelines</h3>
          <p className="text-[11px] text-gray-400 font-normal mt-0.5 uppercase tracking-wider">Visualise sub-periods and milestones</p>
        </div>
        <button 
          onClick={addEvent}
          className="px-5 py-2 bg-[#2580D3] text-white rounded-[3px] font-normal text-[12px] flex items-center gap-2 hover:bg-[#1e6bb3] transition-all shadow-sm active:scale-[0.98]"
        >
          <Plus className="w-4 h-4" />
          Add Milestone
        </button>
      </div>

      <section className="space-y-4">
        <div className="flex items-center justify-between bg-gray-50/50 p-2.5 rounded-[3px] border border-gray-100">
          <div className="flex items-center gap-6">
            <div className="flex items-center gap-2 text-[11px] text-gray-600 font-normal border-r border-gray-200 pr-6">
              <Info className="w-4 h-4 text-[#2580D3]" />
              <span>Cycle Type: <strong className="text-gray-900">{state.timeFrame.interval}</strong></span>
            </div>
            <div className="flex items-center gap-2 text-[11px] text-gray-600 font-normal">
              <Layers className="w-4 h-4 text-purple-500" />
              <span>Periods: <strong className="text-gray-900">{state.timeFrame.periods.length}</strong></span>
            </div>
            {state.timeFrame.midTermReview && (
              <div className="flex items-center gap-2 text-[11px] text-blue-600 font-medium bg-blue-50 px-2 py-0.5 rounded-[2px] border border-blue-100">
                <UserCheck className="w-3.5 h-3.5" />
                <span>Auto Mid-terms Active</span>
              </div>
            )}
          </div>
          
          <div className="flex items-center gap-3">
            <div className="relative group">
              <button 
                onMouseEnter={() => setShowLegend(true)}
                onMouseLeave={() => setShowLegend(false)}
                className="p-1.5 text-gray-400 hover:text-[#2580D3] transition-colors bg-white rounded-[2px] border border-gray-100"
              >
                <HelpCircle className="w-3.5 h-3.5" />
              </button>
              <AnimatePresence>
                {showLegend && (
                  <motion.div 
                    initial={{ opacity: 0, scale: 0.95, y: 10 }}
                    animate={{ opacity: 1, scale: 1, y: 0 }}
                    exit={{ opacity: 0, scale: 0.95, y: 10 }}
                    className="absolute bottom-full right-0 mb-2 w-48 bg-white border border-gray-100 rounded-[3px] p-2.5 shadow-xl z-[100]"
                  >
                    <div className="flex items-center gap-2 mb-1.5">
                      <div className="w-3 h-0.5 border-t border-dashed border-orange-300" />
                      <span className="text-[10px] text-gray-500 font-medium">Mid-term Marker</span>
                    </div>
                    <p className="text-[9px] text-gray-400 leading-relaxed font-normal">
                      Automated review checkpoints calculated at the exact midpoint of each evaluation period.
                    </p>
                  </motion.div>
                )}
              </AnimatePresence>
            </div>
            <div className="text-[11px] font-medium text-gray-500 bg-white px-3 py-1 rounded-[2px] border border-gray-100">
              {format(cycleStart, 'MMM dd, yyyy')} — {format(cycleEnd, 'MMM dd, yyyy')}
            </div>
          </div>
        </div>

        <div className="relative border border-[#e0e1e3] rounded-[3px] overflow-hidden bg-white">
          <div className="flex border-b border-[#e0e1e3] bg-[#f9fafb]">
            {monthCols.map((col, idx) => (
              <div 
                key={idx} 
                style={{ width: `${col.width}%` }}
                className="text-center py-2.5 text-[10px] font-medium text-gray-500 uppercase tracking-widest border-r border-[#e0e1e3] last:border-r-0 shrink-0"
              >
                {col.label}
              </div>
            ))}
          </div>

          <div className="relative min-h-[260px]">
             <div className="absolute inset-0 top-0 flex pointer-events-none">
               {state.timeFrame.periods.map((period, idx) => {
                 const styles = getPositionStyles(period.startDate, period.endDate);
                 return (
                   <div 
                    key={period.id}
                    className={`absolute top-0 bottom-0 border-r border-[#e5e7eb] last:border-r-0 ${idx % 2 === 0 ? 'bg-gray-50/20' : 'bg-white'}`}
                    style={{ ...styles }}
                   >
                     {/* Move period title to bottom and make it lighter */}
                     <div className="absolute bottom-4 left-0 right-0 px-3">
                       <span className="text-[9px] text-gray-300 font-bold uppercase tracking-widest truncate block">
                         {period.name}
                       </span>
                     </div>
                   </div>
                 );
               })}
             </div>

             <div className="relative space-y-4 pt-10 px-0 pb-16">
                {state.timelineEvents.map((event) => {
                  const styles = getPositionStyles(event.startDate, event.endDate);
                  return (
                    <div key={event.id} className="relative h-7">
                      <motion.div 
                        initial={{ scaleX: 0, opacity: 0 }}
                        animate={{ scaleX: 1, opacity: 1 }}
                        style={{ ...styles }}
                        className="absolute h-full bg-[#2580D3] rounded-[2px] flex items-center px-3 cursor-pointer hover:brightness-110 transition-all shadow-sm z-10"
                      >
                        <span className="text-[10px] text-white font-medium truncate whitespace-nowrap drop-shadow-sm">
                          {event.name}
                        </span>
                      </motion.div>
                    </div>
                  );
                })}

                {midTermEvents.map((me) => {
                  const totalDaysCycle = differenceInDays(cycleEnd, cycleStart) + 1;
                  const daysFromStart = differenceInDays(me.date, cycleStart);
                  const left = (daysFromStart / totalDaysCycle) * 100;

                  return (
                    <div 
                      key={me.id} 
                      className="absolute top-0 bottom-0 w-px border-l border-dashed border-orange-300/60 z-20 pointer-events-none"
                      style={{ left: `${left}%` }}
                    >
                      <div className="absolute top-[32px] left-[-3px] w-1.5 h-1.5 rounded-full bg-orange-300/80 shadow-none" />
                      {/* Removed text label "Mid-term" as requested */}
                    </div>
                  );
                })}
                
                {state.timelineEvents.length === 0 && !state.timeFrame.midTermReview && (
                  <div className="h-24 flex items-center justify-center">
                    <p className="text-[12px] text-gray-400 font-normal italic">No milestones defined yet.</p>
                  </div>
                )}
             </div>
          </div>
        </div>
      </section>

      <section className="space-y-6">
        <div className="space-y-3">
          <div className="flex items-center gap-2 mb-2">
             <div className="w-2 h-2 rounded-full bg-[#2580D3] shadow-sm shadow-[#2580D3]/20" />
             <h4 className="text-[13px] font-normal text-gray-800 uppercase tracking-widest">Milestones Configuration</h4>
          </div>
          <div className="grid grid-cols-12 gap-4 px-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
            <div className="col-span-1"></div>
            <div className="col-span-5">Event Name</div>
            <div className="col-span-3 text-center">Start Date</div>
            <div className="col-span-2 text-center">End Date</div>
            <div className="col-span-1"></div>
          </div>

          <div className="space-y-1">
            <AnimatePresence initial={false}>
              {state.timelineEvents.map((event, index) => (
                <DraggableMilestone 
                  key={event.id}
                  event={event}
                  index={index}
                  moveMilestone={moveMilestone}
                  updateEvent={updateEvent}
                  removeEvent={removeEvent}
                />
              ))}
            </AnimatePresence>
          </div>
        </div>

        <div className="space-y-3 pt-6 border-t border-gray-100">
          <div className="flex items-center gap-2 mb-2">
             <div className="w-2 h-2 rounded-full bg-purple-400 shadow-sm shadow-purple-400/20" />
             <h4 className="text-[13px] font-normal text-gray-800 uppercase tracking-widest">Cycle Sub-Periods</h4>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
             {state.timeFrame.periods.map(period => (
               <div key={period.id} className="p-4 bg-gray-50/50 border border-gray-100 rounded-[3px] space-y-2 hover:bg-white hover:border-[#2580D3]/20 transition-all shadow-sm">
                  <span className="text-[11px] font-bold text-gray-900 uppercase tracking-tight block truncate">{period.name}</span>
                  <div className="flex items-center justify-between">
                    <div className="text-[10px] text-gray-500 font-normal bg-white px-2 py-1 rounded-[2px] border border-gray-100">
                      {format(parseISO(period.startDate), 'MMM dd')}
                    </div>
                    <div className="h-px flex-1 mx-2 bg-gray-200" />
                    <div className="text-[10px] text-gray-500 font-normal bg-white px-2 py-1 rounded-[2px] border border-gray-100">
                      {format(parseISO(period.endDate), 'MMM dd')}
                    </div>
                  </div>
               </div>
             ))}
          </div>
        </div>
      </section>
    </div>
  );
}
