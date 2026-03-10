import svgPaths from "./svg-02wdzx3h8p";

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

function TextInput() {
  return (
    <div className="bg-neutral-50 h-[55px] pointer-events-none relative rounded-[5px] shrink-0 w-[45px]" data-name="Text input">
      <div aria-hidden="true" className="absolute border border-[#bbcdde] border-solid inset-0 rounded-[5px]" />
      <div className="absolute inset-0 shadow-[0px_2px_0px_0px_inset_rgba(231,235,238,0.2)]" />
    </div>
  );
}

function Frame() {
  return (
    <div className="content-stretch flex items-center justify-between max-w-[392px] min-w-[392px] relative shrink-0 w-full">
      {[...Array(6).keys()].map((_, i) => (
        <TextInput key={i} />
      ))}
    </div>
  );
}

function Frame2() {
  return (
    <div className="content-stretch flex flex-col gap-[18px] items-start relative shrink-0 w-full">
      <div className="flex flex-col font-['Inter:Regular',sans-serif] font-normal justify-center leading-[0] not-italic relative shrink-0 text-[0px] text-neutral-500 w-full">
        <p className="leading-[20px] text-[14px]">
          <span>{`Enter the 6‑digit code we sent to `}</span>
          <span className="font-['Inter:Bold',sans-serif] font-bold not-italic text-neutral-800">sam***@gmail.com</span>
        </p>
      </div>
      <Frame />
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

function Button() {
  return (
    <div className="bg-[#2580d3] relative rounded-[6px] shrink-0 w-full" data-name="Button">
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

function FooterContainer() {
  return (
    <div className="content-stretch flex flex-col gap-[15px] items-center relative shrink-0 w-full" data-name="Footer Container">
      <p className="font-['Inter:Regular',sans-serif] font-normal leading-[20px] not-italic relative shrink-0 text-[0px] text-[12px] text-[grey] text-nowrap whitespace-pre">
        <span>{`Didn’t receive a code? `}</span>
        <span className="font-['Inter:Bold',sans-serif] font-bold text-[#94989c]"> </span>
        <span className="font-['Inter:Bold',sans-serif] font-bold text-[#1f6db3]">{`Resend Code `}</span>
        <span className="text-neutral-500">In 30s</span>
      </p>
    </div>
  );
}

function FormContainer() {
  return (
    <div className="basis-0 content-stretch flex flex-col gap-[46px] grow items-center min-h-px min-w-px relative shrink-0" data-name="Form Container">
      <Frame1 />
      <Frame2 />
      <Button />
      <FooterContainer />
    </div>
  );
}

export default function LoginForm() {
  return (
    <div className="bg-white relative rounded-[20px] size-full" data-name="Login Form">
      <div className="flex flex-row items-center justify-center size-full">
        <div className="box-border content-stretch flex gap-[10px] items-center justify-center overflow-clip p-[40px] relative size-full">
          <FormContainer />
        </div>
      </div>
    </div>
  );
}