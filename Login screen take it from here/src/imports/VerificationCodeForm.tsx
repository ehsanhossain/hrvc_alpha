import React, { useState, useEffect, useRef } from "react";
import svgPaths from "./svg-02wdzx3h8p";

interface VerificationCodeFormProps {
  email: string;
  onVerify: (code: string) => void;
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

function Frame3() {
  return (
    <div className="content-stretch flex gap-[12px] items-center relative shrink-0">
      <Group />
      <div className="flex flex-col font-['Inter:Semi_Bold',sans-serif] font-semibold justify-center leading-[0] not-italic relative shrink-0 text-[18px] text-black text-center text-nowrap">
        <p className="leading-[28px] whitespace-pre">Enter Verification Code</p>
      </div>
    </div>
  );
}

function Frame1() {
  return (
    <div className="content-stretch flex gap-[12px] items-center relative shrink-0 w-full">
      <Frame3 />
    </div>
  );
}

function TextInput({ 
  value, 
  onChange, 
  onKeyDown, 
  isFocused 
}: { 
  value: string; 
  onChange: (val: string) => void; 
  onKeyDown: (e: React.KeyboardEvent) => void;
  isFocused: boolean;
}) {
  const inputRef = useRef<HTMLInputElement>(null);

  useEffect(() => {
    if (isFocused && inputRef.current) {
      inputRef.current.focus();
    }
  }, [isFocused]);

  return (
    <div className="bg-neutral-50 h-[55px] relative rounded-[5px] shrink-0 w-[45px]" data-name="Text input">
      <input
        ref={inputRef}
        type="text"
        maxLength={1}
        value={value}
        onChange={(e) => {
          const val = e.target.value;
          if (/^[0-9]*$/.test(val)) {
            onChange(val);
          }
        }}
        onKeyDown={onKeyDown}
        className="absolute inset-0 w-full h-full text-center bg-transparent border-none outline-none text-[24px] font-['Inter'] font-semibold text-neutral-800 focus:ring-0 z-10"
      />
      <div aria-hidden="true" className={`absolute border border-solid inset-0 rounded-[5px] pointer-events-none ${value ? 'border-[#2580d3]' : 'border-[#bbcdde]'}`} />
      {!value && <div className="absolute inset-0 shadow-[0px_2px_0px_0px_inset_rgba(231,235,238,0.2)] pointer-events-none" />}
    </div>
  );
}

function CodeInputs({ code, setCode }: { code: string[], setCode: (code: string[]) => void }) {
  const handleChange = (index: number, value: string) => {
    const newCode = [...code];
    newCode[index] = value;
    setCode(newCode);

    // Auto-focus next input
    if (value && index < 5) {
      const nextInput = document.getElementById(`code-input-${index + 1}`);
      nextInput?.focus();
    }
  };

  const handleKeyDown = (index: number, e: React.KeyboardEvent) => {
    if (e.key === 'Backspace' && !code[index] && index > 0) {
      // Focus previous input on backspace if empty
      const newCode = [...code];
      newCode[index - 1] = '';
      setCode(newCode);
      const prevInput = document.getElementById(`code-input-${index - 1}`);
      prevInput?.focus();
    }
  };

  // Using a simpler implementation for the generated code to match the visual design but make it functional
  // Since I cannot pass refs easily through the map in the original structure, I'll implement the logic directly in the Frame component
  return null; 
}

function Frame({ code, setCode }: { code: string[], setCode: (code: string[]) => void }) {
  const inputRefs = useRef<(HTMLInputElement | null)[]>([]);

  const handleChange = (index: number, value: string) => {
    // Allow only numbers
    if (!/^\d*$/.test(value)) return;

    const newCode = [...code];
    newCode[index] = value;
    setCode(newCode);

    // Auto-focus next input
    if (value && index < 5) {
      inputRefs.current[index + 1]?.focus();
    }
  };

  const handleKeyDown = (index: number, e: React.KeyboardEvent) => {
    if (e.key === 'Backspace') {
      if (!code[index] && index > 0) {
        const newCode = [...code];
        newCode[index - 1] = '';
        setCode(newCode);
        inputRefs.current[index - 1]?.focus();
      }
    }
  };

  const handlePaste = (e: React.ClipboardEvent) => {
    e.preventDefault();
    const pastedData = e.clipboardData.getData('text').slice(0, 6).split('');
    if (pastedData.every(char => /^\d$/.test(char))) {
      const newCode = [...code];
      pastedData.forEach((char, index) => {
        if (index < 6) newCode[index] = char;
      });
      setCode(newCode);
      const focusIndex = Math.min(pastedData.length, 5);
      inputRefs.current[focusIndex]?.focus();
    }
  };

  return (
    <div className="content-stretch flex items-center justify-between max-w-[392px] min-w-[392px] relative shrink-0 w-full">
      {code.map((digit, index) => (
        <div key={index} className="bg-neutral-50 h-[55px] relative rounded-[5px] shrink-0 w-[45px]" data-name="Text input">
          <input
            ref={el => { inputRefs.current[index] = el; }}
            type="text"
            maxLength={1}
            value={digit}
            onChange={(e) => handleChange(index, e.target.value)}
            onKeyDown={(e) => handleKeyDown(index, e)}
            onPaste={index === 0 ? handlePaste : undefined}
            className="absolute inset-0 w-full h-full text-center bg-transparent border-none outline-none text-[24px] font-['Inter'] font-semibold text-neutral-800 focus:ring-0 z-10 p-0"
          />
          <div aria-hidden="true" className={`absolute border border-solid inset-0 rounded-[5px] pointer-events-none ${digit ? 'border-[#2580d3]' : 'border-[#bbcdde]'}`} />
          {!digit && <div className="absolute inset-0 shadow-[0px_2px_0px_0px_inset_rgba(231,235,238,0.2)] pointer-events-none" />}
        </div>
      ))}
    </div>
  );
}

function Frame2({ email, code, setCode }: { email: string, code: string[], setCode: (code: string[]) => void }) {
  return (
    <div className="content-stretch flex flex-col gap-[18px] items-start relative shrink-0 w-full">
      <div className="flex flex-col font-['Inter:Regular',sans-serif] font-normal justify-center leading-[0] not-italic relative shrink-0 text-[0px] text-neutral-500 w-full">
        <p className="leading-[20px] text-[14px]">
          <span>{`Enter the 6‑digit code we sent to `}</span>
          <span className="font-['Inter:Bold',sans-serif] font-bold not-italic text-neutral-800">{email || 'your email'}</span>
        </p>
      </div>
      <Frame code={code} setCode={setCode} />
    </div>
  );
}

function HeroiconsOutlineShieldCheck() {
  return (
    <div className="absolute left-0 size-[20px] top-0" data-name="heroicons-outline/shield-check">
      <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 20 20">
        <g id="heroicons-outline/shield-check">
          <path d={svgPaths.p7e6cf00} id="Vector" stroke="var(--stroke-0, white)" strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.25" />
        </g>
      </svg>
    </div>
  );
}

function HeroiconsOutlineShieldCheck1() {
  return (
    <div className="absolute left-0 size-[20px] top-0" data-name="heroicons-outline/shield-check">
      <HeroiconsOutlineShieldCheck />
    </div>
  );
}

function Shield() {
  return (
    <div className="absolute left-0 size-[20px] top-0" data-name="Shield">
      <HeroiconsOutlineShieldCheck1 />
    </div>
  );
}

function IconLeft() {
  return (
    <div className="relative shrink-0 size-[20px]" data-name="Icon / Left">
      <Shield />
    </div>
  );
}

function Button({ onClick, disabled }: { onClick: () => void, disabled: boolean }) {
  return (
    <div 
      className={`bg-[#2580d3] relative rounded-[6px] shrink-0 w-full transition-colors ${disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer hover:bg-[#1E6DB3] active:bg-[#1A5FA0]'}`}
      data-name="Button"
      onClick={!disabled ? onClick : undefined}
    >
      <div className="flex flex-row items-center justify-center overflow-clip rounded-[inherit] size-full">
        <div className="box-border content-stretch flex gap-[6px] items-center justify-center px-[16px] py-[10px] relative w-full">
          <IconLeft />
          <div className="flex flex-col font-['Inter:Medium',sans-serif] font-medium justify-center leading-[0] not-italic relative shrink-0 text-[14px] text-justify text-nowrap text-white">
            <p className="leading-[20px] whitespace-pre">Verify Code</p>
          </div>
        </div>
      </div>
    </div>
  );
}

function FooterContainer({ onResend }: { onResend: () => void }) {
  const [countdown, setCountdown] = useState(30);
  const [canResend, setCanResend] = useState(false);

  useEffect(() => {
    if (countdown > 0) {
      const timer = setTimeout(() => setCountdown(countdown - 1), 1000);
      return () => clearTimeout(timer);
    } else {
      setCanResend(true);
    }
  }, [countdown]);

  const handleResend = () => {
    if (canResend) {
      onResend();
      setCountdown(30);
      setCanResend(false);
    }
  };

  return (
    <div className="content-stretch flex flex-col gap-[15px] items-center relative shrink-0 w-full" data-name="Footer Container">
      <p className="font-['Inter:Regular',sans-serif] font-normal leading-[20px] not-italic relative shrink-0 text-[0px] text-[12px] text-[grey] text-nowrap whitespace-pre">
        <span>{`Didn’t receive a code? `}</span>
        <span className="font-['Inter:Bold',sans-serif] font-bold text-[#94989c]"> </span>
        <span 
          className={`font-['Inter:Bold',sans-serif] font-bold text-[#1f6db3] ${canResend ? 'cursor-pointer hover:underline' : 'opacity-50 cursor-not-allowed'}`}
          onClick={handleResend}
        >
          Resend Code
        </span>
        <span className="text-neutral-500"> {canResend ? '' : `In ${countdown}s`}</span>
      </p>
    </div>
  );
}

function FormContainer({ email, onVerify, onResend }: VerificationCodeFormProps) {
  const [code, setCode] = useState<string[]>(Array(6).fill(""));

  const handleVerify = () => {
    if (code.every(digit => digit !== "")) {
      onVerify(code.join(""));
    } else {
      alert("Please enter the full 6-digit code");
    }
  };

  return (
    <div className="basis-0 content-stretch flex flex-col gap-[46px] grow items-center min-h-px min-w-px relative shrink-0" data-name="Form Container">
      <Frame1 />
      <Frame2 email={email} code={code} setCode={setCode} />
      <Button onClick={handleVerify} disabled={code.some(d => d === "")} />
      <FooterContainer onResend={onResend} />
    </div>
  );
}

export default function VerificationCodeForm({ email, onVerify, onResend }: VerificationCodeFormProps) {
  return (
    <div className="bg-white relative rounded-[20px] shrink-0 w-full max-w-[480px]" data-name="Login Form">
      <div className="flex flex-row items-center justify-center rounded-[inherit] size-full">
        <div className="box-border content-stretch flex gap-[10px] items-center justify-center overflow-clip p-[40px] relative size-full">
          <FormContainer email={email} onVerify={onVerify} onResend={onResend} />
        </div>
      </div>
    </div>
  );
}
