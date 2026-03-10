import React, { useEffect, useState } from "react";
import svgPaths from "./svg-rq5rz9k8tj";
import imgSda11 from "figma:asset/db3d2ec162945184fcdf125477eccd2769d5ea90.png";

interface CheckEmailFormProps {
  email: string;
  onEnterCode: () => void;
  onResend: () => void;
}

function Group() {
  return (
    <div className="h-[25.894px] relative shrink-0 w-[18.116px]" data-name="Group">
      <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 19 26">
        <g id="Group">
          <path d={svgPaths.p3dc2e580} fill="var(--fill-0, #377EC1)" id="Vector" />
          <path d={svgPaths.p1cadaf00} fill="var(--fill-0, #7EB3E1)" id="Vector_2" />
        </g>
      </svg>
    </div>
  );
}

function Header() {
  return (
    <div className="content-stretch flex gap-[12px] items-center relative shrink-0 w-full">
      <Group />
      <div className="flex flex-col font-['Inter:Semi_Bold',sans-serif] font-semibold justify-center leading-[0] not-italic relative shrink-0 text-[18px] text-black text-center text-nowrap">
        <p className="leading-[28px] whitespace-pre">Check Your Email</p>
      </div>
    </div>
  );
}

function TextContent({ email }: { email: string }) {
  return (
    <div className="basis-0 content-stretch flex flex-col gap-[12px] grow items-start min-h-px min-w-px relative shrink-0">
      <Header />
      <p className="font-['Inter:Regular',sans-serif] font-normal leading-[20px] not-italic relative shrink-0 text-[0px] text-[14px] text-neutral-500 w-full">
        <span>{`We’ve sent a password reset link to `}</span>
        <span className="font-['Inter:Medium',sans-serif] font-medium text-neutral-800">{email || 'your email'}</span>
        <span className="font-['Inter:Medium',sans-serif] font-medium">. </span>Follow the instructions to continue.
      </p>
    </div>
  );
}

function TopSection({ email }: { email: string }) {
  return (
    <div className="content-stretch flex gap-[12px] items-center relative shrink-0 w-full">
      <TextContent email={email} />
    </div>
  );
}

function EmailOpened() {
  return (
    <div className="absolute left-0 size-[20px] top-0" data-name="Email - Opened">
      <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 20 20">
        <g id="Email - Opened">
          <path d={svgPaths.p930c200} id="Vector" stroke="var(--stroke-0, white)" strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.25" />
        </g>
      </svg>
    </div>
  );
}

function IconLeft() {
  return (
    <div className="relative shrink-0 size-[20px]" data-name="Icon / Left">
      <EmailOpened />
    </div>
  );
}

function CheckEmailButton() {
  return (
    <div 
      className="bg-[#2580d3] relative rounded-[6px] shrink-0 w-full cursor-pointer hover:bg-[#1E6DB3] active:bg-[#1A5FA0] transition-colors" 
      data-name="Button"
      onClick={() => window.open('mailto:')}
    >
      <div className="flex flex-row items-center justify-center overflow-clip rounded-[inherit] size-full">
        <div className="box-border content-stretch flex gap-[6px] items-center justify-center px-[16px] py-[10px] relative w-full">
          <IconLeft />
          <div className="flex flex-col font-['Inter:Medium',sans-serif] font-medium justify-center leading-[0] not-italic relative shrink-0 text-[14px] text-justify text-nowrap text-white">
            <p className="leading-[20px] whitespace-pre">Check your email</p>
          </div>
        </div>
      </div>
    </div>
  );
}

function CodeButton({ onClick }: { onClick: () => void }) {
  return (
    <div 
      className="bg-white h-[40px] relative rounded-[6px] shrink-0 w-full cursor-pointer hover:bg-neutral-50 transition-colors" 
      data-name="Button"
      onClick={onClick}
    >
      <div className="box-border content-stretch flex gap-[8px] h-[40px] items-center justify-center overflow-clip px-[16px] py-[10px] relative rounded-[inherit] w-full">
        <div className="flex flex-col font-['Inter:Medium',sans-serif] font-medium justify-center leading-[0] not-italic relative shrink-0 text-[14px] text-center text-neutral-700 text-nowrap">
          <p className="leading-[20px] whitespace-pre">I have the code</p>
        </div>
      </div>
      <div aria-hidden="true" className="absolute border border-neutral-200 border-solid inset-0 pointer-events-none rounded-[6px]" />
    </div>
  );
}

function ResendButton({ onResend }: { onResend: () => void }) {
  const [countdown, setCountdown] = useState(120); // 2 minutes
  const [canResend, setCanResend] = useState(false);

  useEffect(() => {
    if (countdown > 0) {
      const timer = setTimeout(() => setCountdown(countdown - 1), 1000);
      return () => clearTimeout(timer);
    } else {
      setCanResend(true);
    }
  }, [countdown]);

  const formatTime = (seconds: number) => {
    const m = Math.floor(seconds / 60);
    const s = seconds % 60;
    return `${m}m${s > 0 ? ` ${s}s` : ''}`;
  };

  const handleClick = () => {
    if (canResend) {
      onResend();
      setCountdown(120);
      setCanResend(false);
    }
  };

  return (
    <div 
      className={`bg-white relative rounded-[6px] shrink-0 w-full ${canResend ? 'cursor-pointer hover:bg-neutral-50' : 'cursor-not-allowed opacity-70'}`} 
      data-name="Button"
      onClick={handleClick}
    >
      <div className="box-border content-stretch flex gap-[8px] items-center justify-center overflow-clip px-[16px] py-[10px] relative rounded-[inherit] w-full">
        <div className="flex flex-col font-['Inter:Medium',sans-serif] font-medium justify-center leading-[0] not-italic relative shrink-0 text-[14px] text-center text-neutral-700 text-nowrap">
          <p className="leading-[20px] whitespace-pre">
            {canResend ? "Resend code" : `Resend in ${formatTime(countdown)}`}
          </p>
        </div>
      </div>
      <div aria-hidden="true" className="absolute border border-neutral-200 border-solid inset-0 pointer-events-none rounded-[6px]" />
    </div>
  );
}

function ActionButtons({ onEnterCode, onResend }: { onEnterCode: () => void, onResend: () => void }) {
  return (
    <div className="content-stretch flex items-center justify-between relative shrink-0 w-full gap-3">
      <CodeButton onClick={onEnterCode} />
      <ResendButton onResend={onResend} />
    </div>
  );
}

function BottomSection({ onEnterCode, onResend }: { onEnterCode: () => void, onResend: () => void }) {
  return (
    <div className="content-stretch flex flex-col gap-[15px] items-start relative shrink-0 w-full">
      <CheckEmailButton />
      <ActionButtons onEnterCode={onEnterCode} onResend={onResend} />
    </div>
  );
}

function FormContainer({ email, onEnterCode, onResend }: CheckEmailFormProps) {
  return (
    <div className="basis-0 content-stretch flex flex-col grow h-full items-center justify-between min-h-px min-w-px relative shrink-0" data-name="Form Container">
      <TopSection email={email} />
      <div className="h-[214px] relative shrink-0 w-[269.264px]" data-name="sda (1) 1">
        <div className="absolute inset-0 overflow-hidden pointer-events-none">
          <img alt="" className="absolute h-[135.99%] left-[-53.28%] max-w-none top-[-21.61%] w-[192.14%]" src={imgSda11} />
        </div>
      </div>
      <BottomSection onEnterCode={onEnterCode} onResend={onResend} />
    </div>
  );
}

export default function CheckEmailForm({ email, onEnterCode, onResend }: CheckEmailFormProps) {
  return (
    <div className="bg-white relative rounded-[20px] shrink-0 w-full max-w-[480px]" data-name="Check Email Form">
      <div className="flex flex-row items-center justify-center rounded-[inherit] size-full">
        <div className="box-border content-stretch flex gap-[10px] items-center justify-center overflow-clip p-[40px] relative size-full">
          <FormContainer email={email} onEnterCode={onEnterCode} onResend={onResend} />
        </div>
      </div>
    </div>
  );
}
