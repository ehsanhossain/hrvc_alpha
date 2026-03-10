import svgPaths from "./svg-rq5rz9k8tj";
import imgSda11 from "figma:asset/db3d2ec162945184fcdf125477eccd2769d5ea90.png";

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

function Frame2() {
  return (
    <div className="content-stretch flex gap-[12px] items-center relative shrink-0 w-full">
      <Group />
      <div className="flex flex-col font-['Inter:Semi_Bold',sans-serif] font-semibold justify-center leading-[0] not-italic relative shrink-0 text-[18px] text-black text-center text-nowrap">
        <p className="leading-[28px] whitespace-pre">Check Your Email</p>
      </div>
    </div>
  );
}

function Frame1() {
  return (
    <div className="basis-0 content-stretch flex flex-col gap-[12px] grow items-start min-h-px min-w-px relative shrink-0">
      <Frame2 />
      <p className="font-['Inter:Regular',sans-serif] font-normal leading-[20px] not-italic relative shrink-0 text-[0px] text-[14px] text-neutral-500 w-full">
        <span>{`We’ve sent a password reset link to `}</span>
        <span className="font-['Inter:Medium',sans-serif] font-medium text-neutral-800">sam***@gmail.com.</span>
        <span className="font-['Inter:Medium',sans-serif] font-medium"> </span>Follow the instructions to continue.
      </p>
    </div>
  );
}

function Frame() {
  return (
    <div className="content-stretch flex gap-[12px] items-center relative shrink-0 w-full">
      <Frame1 />
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

function EmailOpened1() {
  return (
    <div className="absolute left-0 size-[20px] top-0" data-name="Email - Opened">
      <EmailOpened />
    </div>
  );
}

function EmailOpened2() {
  return (
    <div className="absolute left-0 size-[20px] top-0" data-name="Email - Opened">
      <EmailOpened1 />
    </div>
  );
}

function IconLeft() {
  return (
    <div className="relative shrink-0 size-[20px]" data-name="Icon / Left">
      <EmailOpened2 />
    </div>
  );
}

function Button() {
  return (
    <div className="bg-[#2580d3] relative rounded-[6px] shrink-0 w-full" data-name="Button">
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

function Button1() {
  return (
    <div className="bg-white h-[40px] relative rounded-[6px] shrink-0 w-[180px]" data-name="Button">
      <div className="box-border content-stretch flex gap-[8px] h-[40px] items-center justify-center overflow-clip px-[16px] py-[10px] relative rounded-[inherit] w-[180px]">
        <div className="flex flex-col font-['Inter:Medium',sans-serif] font-medium justify-center leading-[0] not-italic relative shrink-0 text-[14px] text-center text-neutral-700 text-nowrap">
          <p className="leading-[20px] whitespace-pre">I have the code</p>
        </div>
      </div>
      <div aria-hidden="true" className="absolute border border-neutral-200 border-solid inset-0 pointer-events-none rounded-[6px]" />
    </div>
  );
}

function Button2() {
  return (
    <div className="bg-white relative rounded-[6px] shrink-0 w-[180px]" data-name="Button">
      <div className="box-border content-stretch flex gap-[8px] items-center justify-center overflow-clip px-[16px] py-[10px] relative rounded-[inherit] w-[180px]">
        <div className="flex flex-col font-['Inter:Medium',sans-serif] font-medium justify-center leading-[0] not-italic relative shrink-0 text-[14px] text-center text-neutral-700 text-nowrap">
          <p className="leading-[20px] whitespace-pre">Resend in 2m</p>
        </div>
      </div>
      <div aria-hidden="true" className="absolute border border-neutral-200 border-solid inset-0 pointer-events-none rounded-[6px]" />
    </div>
  );
}

function Frame4() {
  return (
    <div className="content-stretch flex items-center justify-between relative shrink-0 w-full">
      <Button1 />
      <Button2 />
    </div>
  );
}

function Frame3() {
  return (
    <div className="content-stretch flex flex-col gap-[15px] items-start relative shrink-0 w-full">
      <Button />
      <Frame4 />
    </div>
  );
}

function FormContainer() {
  return (
    <div className="basis-0 content-stretch flex flex-col grow h-full items-center justify-between min-h-px min-w-px relative shrink-0" data-name="Form Container">
      <Frame />
      <div className="h-[214px] relative shrink-0 w-[269.264px]" data-name="sda (1) 1">
        <div className="absolute inset-0 overflow-hidden pointer-events-none">
          <img alt="" className="absolute h-[135.99%] left-[-53.28%] max-w-none top-[-21.61%] w-[192.14%]" src={imgSda11} />
        </div>
      </div>
      <Frame3 />
    </div>
  );
}

export default function LoginForm() {
  return (
    <div className="bg-white relative rounded-[20px] size-full" data-name="Login Form">
      <div className="flex flex-row items-center justify-center min-h-inherit min-w-inherit size-full">
        <div className="box-border content-stretch flex gap-[10px] items-center justify-center min-h-inherit min-w-inherit overflow-clip p-[40px] relative size-full">
          <FormContainer />
        </div>
      </div>
    </div>
  );
}