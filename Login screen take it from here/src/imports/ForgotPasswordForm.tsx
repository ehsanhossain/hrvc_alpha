import React, { useState } from "react";
import svgPaths from "./svg-b0vxnqtimp";

interface ForgotPasswordFormProps {
  onBack: () => void;
  onSent: (email: string) => void;
}

function Group2() {
  return (
    <div className="[grid-area:1_/_1] h-[8.859px] ml-0 mt-0 relative w-[11.417px]">
      <div className="absolute inset-[-8.81%_-6.83%]">
        <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 13 11">
          <g id="Group 1000002173">
            <path d={svgPaths.p3f0cfb80} id="Vector" stroke="var(--stroke-0, white)" strokeLinecap="round" strokeLinejoin="round" strokeMiterlimit="10" strokeWidth="1.56031" />
            <path d={svgPaths.p39badf0} id="Vector_2" stroke="var(--stroke-0, white)" strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.56031" />
          </g>
        </svg>
      </div>
    </div>
  );
}

function Group1() {
  return (
    <div className="grid-cols-[max-content] grid-rows-[max-content] inline-grid place-items-start relative shrink-0">
      <Group2 />
    </div>
  );
}

function Frame() {
  return (
    <div className="content-stretch flex gap-[4.818px] items-start leading-[0] relative shrink-0">
      <Group1 />
      <div className="flex flex-col font-['SF_Pro_Display:Semibold',sans-serif] justify-center not-italic relative shrink-0 text-[16px] text-nowrap text-white">
        <p className="leading-[19.538px] whitespace-pre">Back</p>
      </div>
    </div>
  );
}

function Frame1({ onClick }: { onClick: () => void }) {
  return (
    <button 
      onClick={onClick}
      className="bg-[#2580d3] box-border content-stretch cursor-pointer flex flex-col gap-[4.818px] h-[26px] items-center justify-center px-[14.934px] py-[4.336px] relative rounded-[4.336px] shrink-0 w-[66px] hover:bg-[#1E6DB3] transition-colors border-none"
    >
      <Frame />
    </button>
  );
}

function Frame2({ onBack }: { onBack: () => void }) {
  return (
    <div className="content-stretch flex gap-[12px] items-center relative shrink-0 w-full">
      <Frame1 onClick={onBack} />
      <div className="flex flex-col font-['Inter:Semi_Bold',sans-serif] font-semibold justify-center leading-[0] not-italic relative shrink-0 text-[18px] text-black text-center text-nowrap">
        <p className="leading-[28px] whitespace-pre">Forget Password?</p>
      </div>
    </div>
  );
}

function Frame3({ onBack }: { onBack: () => void }) {
  return (
    <div className="content-stretch flex flex-col gap-[5px] items-center relative shrink-0 w-full">
      <Frame2 onBack={onBack} />
      <div className="flex flex-col font-['Inter:Regular',sans-serif] font-normal justify-center leading-[0] not-italic relative shrink-0 text-[14px] text-black w-full">
        <p className="leading-[20px]">Enter your email and we’ll send you reset instructions.</p>
      </div>
    </div>
  );
}

function Email() {
  return (
    <div className="absolute left-0 size-[20px] top-0" data-name="Email">
      <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 20 20">
        <g id="Email">
          <path d={svgPaths.p1a396f80} id="Vector" stroke="var(--stroke-0, #A3A3A3)" strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.25" />
        </g>
      </svg>
    </div>
  );
}

function Email1() {
  return (
    <div className="absolute left-0 size-[20px] top-0" data-name="Email">
      <Email />
    </div>
  );
}

function Email2() {
  return (
    <div className="absolute left-0 size-[20px] top-0" data-name="Email">
      <Email1 />
    </div>
  );
}

function IconLeft() {
  return (
    <div className="relative shrink-0 size-[20px]" data-name="Icon-left">
      <Email2 />
    </div>
  );
}

function TextCursor({ value, onChange }: { value: string, onChange: (val: string) => void }) {
  return (
    <div className="content-stretch flex gap-[2px] items-center relative shrink-0 w-full" data-name="Text + Cursor">
      <div className="flex flex-col font-['Inter:Regular',sans-serif] font-normal justify-center leading-[0] not-italic relative shrink-0 text-[14px] text-neutral-400 w-full">
         <input
          type="email"
          value={value}
          onChange={(e) => onChange(e.target.value)}
          placeholder="name@company.com"
          className="w-full bg-transparent border-none outline-none text-[14px] leading-[20px] text-neutral-900 placeholder:text-neutral-400 font-['Inter',sans-serif]"
        />
      </div>
    </div>
  );
}

function LeftContent({ value, onChange }: { value: string, onChange: (val: string) => void }) {
  return (
    <div className="basis-0 content-stretch flex gap-[8px] grow items-center min-h-px min-w-px relative shrink-0" data-name="Left Content">
      <IconLeft />
      <TextCursor value={value} onChange={onChange} />
    </div>
  );
}

function RightContent() {
  return <div className="content-stretch flex gap-[4px] items-center shrink-0" data-name="Right Content" />;
}

function InputFrame({ value, onChange }: { value: string, onChange: (val: string) => void }) {
  return (
    <div className="bg-white relative rounded-[6px] shrink-0 w-full" data-name="Input Frame">
      <div aria-hidden="true" className="absolute border border-neutral-200 border-solid inset-0 pointer-events-none rounded-[6px] shadow-[0px_1px_2px_0px_rgba(16,24,40,0.04)]" />
      <div className="flex flex-row items-center size-full">
        <div className="box-border content-stretch flex gap-[12px] items-center px-[12px] py-[8px] relative w-full">
          <LeftContent value={value} onChange={onChange} />
          <RightContent />
        </div>
      </div>
    </div>
  );
}

function LabelFrame({ value, onChange }: { value: string, onChange: (val: string) => void }) {
  return (
    <div className="content-stretch flex flex-col gap-[4px] items-start relative shrink-0 w-full" data-name="Label + Frame">
      <div className="flex flex-col font-['Inter:Medium',sans-serif] font-medium justify-center leading-[0] not-italic relative shrink-0 text-[14px] text-neutral-900 w-full">
        <p className="leading-[20px]">Work Email</p>
      </div>
      <InputFrame value={value} onChange={onChange} />
    </div>
  );
}

function InputBox({ value, onChange }: { value: string, onChange: (val: string) => void }) {
  return (
    <div className="content-stretch flex flex-col gap-[8px] items-start relative shrink-0 w-full" data-name="Input / Box">
      <LabelFrame value={value} onChange={onChange} />
    </div>
  );
}

function PaperAirplane() {
  return (
    <div className="absolute left-0 size-[24px] top-0" data-name="paper-airplane">
      <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 24 24">
        <g id="paper-airplane">
          <path d={svgPaths.p6567500} id="Vector" stroke="var(--stroke-0, white)" strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" />
        </g>
      </svg>
    </div>
  );
}

function IconLeft1() {
  return (
    <div className="relative shrink-0 size-[20px]" data-name="Icon / Left">
      <PaperAirplane />
    </div>
  );
}

function Button({ onClick }: { onClick: () => void }) {
  return (
    <div 
      className="bg-[#2580d3] relative rounded-[6px] shrink-0 w-full cursor-pointer hover:bg-[#1E6DB3] active:bg-[#1A5FA0] transition-colors" 
      data-name="Button"
      onClick={onClick}
    >
      <div className="flex flex-row items-center justify-center overflow-clip rounded-[inherit] size-full">
        <div className="box-border content-stretch flex gap-[6px] items-center justify-center px-[16px] py-[10px] relative w-full">
          <IconLeft1 />
          <div className="flex flex-col font-['Inter:Medium',sans-serif] font-medium justify-center leading-[0] not-italic relative shrink-0 text-[14px] text-justify text-nowrap text-white">
            <p className="leading-[20px] whitespace-pre">Send reset link</p>
          </div>
        </div>
      </div>
    </div>
  );
}

function Frame4({ onSent }: { onSent: (email: string) => void }) {
  const [email, setEmail] = useState("");
  
  const handleSend = () => {
    if (!email) {
      alert("Please enter your email address");
      return;
    }
    onSent(email);
  };

  return (
    <div className="content-stretch flex flex-col gap-[32px] items-start relative shrink-0 w-full">
      <InputBox value={email} onChange={setEmail} />
      <Button onClick={handleSend} />
    </div>
  );
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

function FooterContainer() {
  return (
    <div className="content-stretch flex flex-col gap-[15px] items-center relative shrink-0 w-full" data-name="Footer Container">
      <div className="flex flex-col font-['Inter:Regular','Noto_Sans:Regular',sans-serif] font-normal justify-center leading-[0] min-w-full not-italic relative shrink-0 text-[0px] text-center text-neutral-800 w-[min-content]">
        <p className="leading-[20px] text-[12px]">
          <span className="text-neutral-800">{`By continuing you confirm that you agree with our `}</span>
          <span className="[text-decoration-skip-ink:none] [text-underline-position:from-font] decoration-solid font-['Inter:Bold','Noto_Sans:Regular',sans-serif] font-bold not-italic text-[#1f6db3] underline cursor-pointer">Privacy Policy</span>,<span className="text-neutral-800"> </span>
          <span className="[text-decoration-skip-ink:none] [text-underline-position:from-font] decoration-solid font-['Inter:Bold','Noto_Sans:Regular',sans-serif] font-bold not-italic text-[#1f6db3] underline cursor-pointer">Disclosures</span>
          <span className="text-[#2580d3]"> </span>
          <span className="text-neutral-800">{`& `}</span>
          <span className="[text-decoration-skip-ink:none] [text-underline-position:from-font] decoration-solid font-['Inter:Bold','Noto_Sans:Regular',sans-serif] font-bold not-italic text-[#1f6db3] underline cursor-pointer">Terms and Conditions</span>
          <span className="text-neutral-800">.</span>
        </p>
      </div>
      <Group />
    </div>
  );
}

function FormContainer({ onBack, onSent }: { onBack: () => void, onSent: (email: string) => void }) {
  return (
    <div className="basis-0 content-stretch flex flex-col grow h-full items-center justify-between min-h-px min-w-px relative shrink-0" data-name="Form Container">
      <Frame3 onBack={onBack} />
      <Frame4 onSent={onSent} />
      <FooterContainer />
    </div>
  );
}

export default function ForgotPasswordForm({ onBack, onSent }: ForgotPasswordFormProps) {
  return (
    <div className="bg-white relative rounded-[20px] shrink-0 w-full max-w-[480px]" data-name="Login Form">
      <div className="flex flex-row items-center justify-center rounded-[inherit] size-full">
        <div className="box-border content-stretch flex gap-[10px] items-center justify-center overflow-clip p-[40px] relative size-full">
          <FormContainer onBack={onBack} onSent={onSent} />
        </div>
      </div>
    </div>
  );
}
