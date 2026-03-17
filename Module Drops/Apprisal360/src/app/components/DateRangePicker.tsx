import React, { useState, useMemo } from 'react';
import { 
  format, 
  addMonths, 
  subMonths, 
  startOfMonth, 
  endOfMonth, 
  startOfWeek, 
  endOfWeek, 
  isSameMonth, 
  isSameDay, 
  addDays, 
  eachDayOfInterval, 
  isWithinInterval,
  isBefore,
  differenceInDays,
  isToday
} from 'date-fns';
import { ChevronLeft, ChevronRight, Calendar as CalendarIcon, X } from 'lucide-react';
import { motion, AnimatePresence } from 'motion/react';

interface DateRangePickerProps {
  startDate: Date | null;
  endDate: Date | null;
  onChange: (start: Date | null, end: Date | null) => void;
  onClose: () => void;
}

export function DateRangePicker({ startDate, endDate, onChange, onClose }: DateRangePickerProps) {
  const [currentMonth, setCurrentMonth] = useState(new Date());
  const nextMonth = addMonths(currentMonth, 1);

  const handleDateClick = (date: Date) => {
    if (!startDate || (startDate && endDate)) {
      onChange(date, null);
    } else {
      if (isBefore(date, startDate)) {
        onChange(date, null);
      } else {
        onChange(startDate, date);
      }
    }
  };

  const renderHeader = (month: Date, onPrev?: () => void, onNext?: () => void) => (
    <div className="flex items-center justify-between px-4 py-2 bg-white">
      <div className="flex items-center gap-1">
        {onPrev && (
          <button onClick={onPrev} className="p-1 hover:bg-gray-100 rounded-full transition-colors text-gray-500">
            <ChevronLeft className="w-4 h-4" />
          </button>
        )}
      </div>
      <span className="text-[14px] font-medium text-gray-900">{format(month, 'MMMM yyyy')}</span>
      <div className="flex items-center gap-1">
        {onNext && (
          <button onClick={onNext} className="p-1 hover:bg-gray-100 rounded-full transition-colors text-gray-500">
            <ChevronRight className="w-4 h-4" />
          </button>
        )}
      </div>
    </div>
  );

  const renderDays = (month: Date) => {
    const monthStart = startOfMonth(month);
    const monthEnd = endOfMonth(monthStart);
    const startDateView = startOfWeek(monthStart);
    const endDateView = endOfWeek(monthEnd);

    const dateFormat = "eeeeee";
    const days = [];
    let day = startDateView;

    // Weekday headers
    const dayLabels = [];
    for (let i = 0; i < 7; i++) {
      dayLabels.push(
        <div key={i} className="text-center text-[11px] font-normal text-gray-400 py-2 uppercase">
          {format(addDays(startDateView, i), dateFormat)}
        </div>
      );
    }

    const rows = [];
    let daysInRow = [];

    while (day <= endDateView) {
      for (let i = 0; i < 7; i++) {
        const formattedDate = format(day, 'd');
        const cloneDay = new Date(day);
        const isSelectedStart = startDate && isSameDay(day, startDate);
        const isSelectedEnd = endDate && isSameDay(day, endDate);
        const isInRange = startDate && endDate && isWithinInterval(day, { start: startDate, end: endDate });
        const isCurrentMonth = isSameMonth(day, monthStart);
        const isPast = isBefore(day, startOfDay(new Date()));
        const isTodaysDate = isToday(day);

        daysInRow.push(
          <div
            key={day.toString()}
            className={`
              relative h-10 flex items-center justify-center text-[12px] cursor-pointer transition-all
              ${!isCurrentMonth ? 'text-transparent pointer-events-none' : ''}
              ${isInRange && !isSelectedStart && !isSelectedEnd ? 'bg-[#2580D3]/10' : ''}
              ${isSelectedStart ? 'rounded-l-[3px] bg-[#2580D3] text-white' : ''}
              ${isSelectedEnd ? 'rounded-r-[3px] bg-[#2580D3] text-white' : ''}
              ${!isSelectedStart && !isSelectedEnd && isCurrentMonth ? 'hover:bg-gray-50 text-gray-700' : ''}
              ${isTodaysDate && !isSelectedStart && !isSelectedEnd ? 'font-bold text-[#2580D3]' : ''}
            `}
            onClick={() => handleDateClick(cloneDay)}
          >
            {isCurrentMonth && (
              <>
                <span className="relative z-10">{formattedDate}</span>
                {isSelectedStart && endDate && (
                  <div className="absolute right-0 top-0 bottom-0 w-1/2 bg-[#2580D3]/10 -z-1" />
                )}
                {isSelectedEnd && startDate && (
                  <div className="absolute left-0 top-0 bottom-0 w-1/2 bg-[#2580D3]/10 -z-1" />
                )}
              </>
            )}
          </div>
        );
        day = addDays(day, 1);
      }
      rows.push(
        <div className="grid grid-cols-7" key={day.toString()}>
          {daysInRow}
        </div>
      );
      daysInRow = [];
    }

    return (
      <div className="px-4 pb-4">
        <div className="grid grid-cols-7 mb-1">{dayLabels}</div>
        {rows}
      </div>
    );
  };

  const duration = useMemo(() => {
    if (startDate && endDate) {
      return differenceInDays(endDate, startDate) + 1;
    }
    return 0;
  }, [startDate, endDate]);

  return (
    <motion.div 
      initial={{ opacity: 0, y: 10, scale: 0.98 }}
      animate={{ opacity: 1, y: 0, scale: 1 }}
      exit={{ opacity: 0, y: 10, scale: 0.98 }}
      className="absolute top-full left-0 mt-2 bg-white border border-gray-100 shadow-2xl rounded-[3px] z-[200] w-[640px] overflow-hidden flex flex-col"
    >
      {/* Header Info like Agoda */}
      <div className="flex items-center justify-between p-4 border-b border-gray-50 bg-[#f9fafb]">
        <div className="flex items-center gap-8">
          <div className="flex flex-col gap-0.5">
            <span className="text-[10px] text-gray-400 uppercase tracking-wider font-normal">Start Date</span>
            <span className={`text-[13px] font-medium ${startDate ? 'text-[#2580D3]' : 'text-gray-300'}`}>
              {startDate ? format(startDate, 'EEE, dd MMM yyyy') : 'Select start date'}
            </span>
          </div>
          <div className="flex items-center justify-center">
             <div className="h-px w-6 bg-gray-200" />
          </div>
          <div className="flex flex-col gap-0.5">
            <span className="text-[10px] text-gray-400 uppercase tracking-wider font-normal">End Date</span>
            <span className={`text-[13px] font-medium ${endDate ? 'text-[#2580D3]' : 'text-gray-300'}`}>
              {endDate ? format(endDate, 'EEE, dd MMM yyyy') : 'Select end date'}
            </span>
          </div>
        </div>
        {duration > 0 && (
          <div className="bg-[#2580D3]/5 text-[#2580D3] px-3 py-1 rounded-[2px] text-[12px] font-medium border border-[#2580D3]/10">
            {duration} Days Duration
          </div>
        )}
      </div>

      <div className="flex">
        <div className="flex-1 border-r border-gray-50">
          {renderHeader(currentMonth, () => setCurrentMonth(subMonths(currentMonth, 1)))}
          {renderDays(currentMonth)}
        </div>
        <div className="flex-1">
          {renderHeader(nextMonth, undefined, () => setCurrentMonth(addMonths(currentMonth, 1)))}
          {renderDays(nextMonth)}
        </div>
      </div>

      <div className="p-4 border-t border-gray-50 flex items-center justify-between bg-white">
        <div className="text-[11px] text-gray-400 flex items-center gap-1.5">
           <div className="w-2 h-2 rounded-full bg-[#2580D3]" />
           <span>Today: {format(new Date(), 'dd MMM yyyy')}</span>
        </div>
        <div className="flex items-center gap-2">
          <button 
            onClick={() => onChange(null, null)}
            className="px-4 py-1.5 text-[12px] font-normal text-gray-500 hover:text-gray-700 transition-colors"
          >
            Clear
          </button>
          <button 
            onClick={onClose}
            className="px-6 py-1.5 bg-[#2580D3] text-white rounded-[3px] text-[12px] font-normal hover:bg-[#1e6bb3] transition-colors"
          >
            Confirm Date
          </button>
        </div>
      </div>
    </motion.div>
  );
}

function startOfDay(date: Date) {
  const d = new Date(date);
  d.setHours(0, 0, 0, 0);
  return d;
}
