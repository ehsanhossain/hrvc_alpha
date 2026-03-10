import svgPaths from "./svg-yfo2cfsof3";
import imgDesktopLoginLandingPage from "figma:asset/6aabb217838f03642a8bbe972562af7572d6cd6e.png";

function Group() {
  return (
    <div className="absolute inset-[6.82%_72.62%_8.72%_6.56%]" data-name="Group">
      <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 34 49">
        <g id="Group">
          <path d={svgPaths.pb460300} fill="var(--fill-0, #377EC1)" id="Vector" />
          <path d={svgPaths.p5257800} fill="var(--fill-0, #7EB3E1)" id="Vector_2" />
        </g>
      </svg>
    </div>
  );
}

function Group1() {
  return (
    <div className="absolute inset-[22.37%_4.45%_24.27%_33.14%]" data-name="Group">
      <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 102 31">
        <g id="Group">
          <path d={svgPaths.p17067100} fill="var(--fill-0, #272626)" id="Vector" />
          <path d={svgPaths.p290b9600} fill="var(--fill-0, #272626)" id="Vector_2" />
          <path d={svgPaths.p14bc1400} fill="var(--fill-0, #272626)" id="Vector_3" />
          <path d={svgPaths.p3177ec0} fill="var(--fill-0, #272626)" id="Vector_4" />
        </g>
      </svg>
    </div>
  );
}

function HrvcFinalLogos() {
  return (
    <div className="h-[57.36px] overflow-clip relative shrink-0 w-[162.788px]" data-name="HRVC Final Logos-01">
      <Group />
      <Group1 />
    </div>
  );
}

function Frame3() {
  return (
    <div className="content-stretch flex flex-col gap-[4px] items-center relative shrink-0">
      <HrvcFinalLogos />
      <div className="flex flex-col font-['Inter:Regular',sans-serif] font-normal justify-center leading-[0] not-italic relative shrink-0 text-[14px] text-center text-neutral-600 text-nowrap">
        <p className="leading-[20px] whitespace-pre">Enter your credentials to access HRVC.</p>
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

function TextCursor() {
  return (
    <div className="content-stretch flex gap-[2px] items-center relative shrink-0" data-name="Text + Cursor">
      <div className="flex flex-col font-['Inter:Regular',sans-serif] font-normal justify-center leading-[0] not-italic relative shrink-0 text-[14px] text-neutral-400 text-nowrap">
        <p className="leading-[20px] whitespace-pre">name@company.com</p>
      </div>
    </div>
  );
}

function LeftContent() {
  return (
    <div className="basis-0 content-stretch flex gap-[8px] grow items-center min-h-px min-w-px relative shrink-0" data-name="Left Content">
      <IconLeft />
      <TextCursor />
    </div>
  );
}

function RightContent() {
  return <div className="content-stretch flex gap-[4px] items-center shrink-0" data-name="Right Content" />;
}

function InputFrame() {
  return (
    <div className="bg-white relative rounded-[6px] shrink-0 w-full" data-name="Input Frame">
      <div aria-hidden="true" className="absolute border border-neutral-200 border-solid inset-0 pointer-events-none rounded-[6px] shadow-[0px_1px_2px_0px_rgba(16,24,40,0.04)]" />
      <div className="flex flex-row items-center size-full">
        <div className="box-border content-stretch flex gap-[12px] items-center px-[12px] py-[8px] relative w-full">
          <LeftContent />
          <RightContent />
        </div>
      </div>
    </div>
  );
}

function LabelFrame() {
  return (
    <div className="content-stretch flex flex-col gap-[4px] items-start relative shrink-0 w-full" data-name="Label + Frame">
      <div className="flex flex-col font-['Inter:Medium',sans-serif] font-medium justify-center leading-[0] not-italic relative shrink-0 text-[14px] text-neutral-900 w-full">
        <p className="leading-[20px]">Work Email</p>
      </div>
      <InputFrame />
    </div>
  );
}

function InputBox() {
  return (
    <div className="content-stretch flex flex-col gap-[8px] items-start relative shrink-0 w-full" data-name="Input / Box">
      <LabelFrame />
    </div>
  );
}

function Lock() {
  return (
    <div className="absolute left-0 size-[20px] top-0" data-name="Lock">
      <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 20 20">
        <g id="Lock">
          <path d={svgPaths.p3bd8c300} id="Vector" stroke="var(--stroke-0, #A3A3A3)" strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.25" />
        </g>
      </svg>
    </div>
  );
}

function Lock1() {
  return (
    <div className="absolute left-0 size-[20px] top-0" data-name="Lock">
      <Lock />
    </div>
  );
}

function Lock2() {
  return (
    <div className="absolute left-0 size-[20px] top-0" data-name="Lock">
      <Lock1 />
    </div>
  );
}

function IconLeft1() {
  return (
    <div className="relative shrink-0 size-[20px]" data-name="Icon-left">
      <Lock2 />
    </div>
  );
}

function TextCursor1() {
  return (
    <div className="content-stretch flex gap-[2px] items-center relative shrink-0" data-name="Text + Cursor">
      <div className="flex flex-col font-['Inter:Regular',sans-serif] font-normal justify-center leading-[0] not-italic relative shrink-0 text-[14px] text-neutral-400 text-nowrap">
        <p className="leading-[20px] whitespace-pre">Enter password here</p>
      </div>
    </div>
  );
}

function LeftContent1() {
  return (
    <div className="basis-0 content-stretch flex gap-[8px] grow items-center min-h-px min-w-px relative shrink-0" data-name="Left Content">
      <IconLeft1 />
      <TextCursor1 />
    </div>
  );
}

function RightContent1() {
  return <div className="content-stretch flex gap-[4px] items-center shrink-0" data-name="Right Content" />;
}

function InputFrame1() {
  return (
    <div className="bg-white relative rounded-[6px] shrink-0 w-full" data-name="Input Frame">
      <div aria-hidden="true" className="absolute border border-neutral-200 border-solid inset-0 pointer-events-none rounded-[6px] shadow-[0px_1px_2px_0px_rgba(16,24,40,0.04)]" />
      <div className="flex flex-row items-center size-full">
        <div className="box-border content-stretch flex gap-[12px] items-center px-[12px] py-[8px] relative w-full">
          <LeftContent1 />
          <RightContent1 />
        </div>
      </div>
    </div>
  );
}

function LabelFrame1() {
  return (
    <div className="content-stretch flex flex-col gap-[4px] items-start relative shrink-0 w-full" data-name="Label + Frame">
      <div className="flex flex-col font-['Inter:Medium',sans-serif] font-medium justify-center leading-[0] not-italic relative shrink-0 text-[14px] text-neutral-900 w-full">
        <p className="leading-[20px]">Password</p>
      </div>
      <InputFrame1 />
    </div>
  );
}

function InputBox1() {
  return (
    <div className="content-stretch flex flex-col gap-[8px] items-start relative shrink-0 w-full" data-name="Input / Box">
      <LabelFrame1 />
      <div className="flex flex-col font-['Inter:Medium',sans-serif] font-medium justify-center leading-[0] not-italic relative shrink-0 text-[#2580d3] text-[14px] w-full">
        <p className="leading-[20px]">Forgot password?</p>
      </div>
    </div>
  );
}

function Container() {
  return (
    <div className="absolute contents inset-0" data-name="Container">
      <div className="absolute bg-[#2580d3] inset-0 rounded-[27.375px]" data-name="Background" />
      <div className="absolute bg-white inset-[6.25%_3.85%_6.25%_42.31%] rounded-[75px]" data-name="Knob" />
    </div>
  );
}

function FormControlSwitch() {
  return (
    <div className="h-[24px] relative shrink-0 w-[39px]" data-name="Form Control / Switch">
      <Container />
    </div>
  );
}

function RememberCredentialsContainer() {
  return (
    <div className="content-stretch flex gap-[12px] items-center relative shrink-0" data-name="Remember Credentials Container">
      <FormControlSwitch />
      <div className="flex flex-col font-['Inter:Regular',sans-serif] font-normal justify-center leading-[0] not-italic relative shrink-0 text-[14px] text-black text-center text-nowrap">
        <p className="leading-[20px] whitespace-pre">Remember me</p>
      </div>
    </div>
  );
}

function Frame() {
  return (
    <div className="content-stretch flex flex-col gap-[24px] items-start relative shrink-0 w-full">
      <RememberCredentialsContainer />
    </div>
  );
}

function Frame1() {
  return (
    <div className="content-stretch flex flex-col gap-[24px] items-start relative shrink-0 w-full">
      <InputBox />
      <InputBox1 />
      <Frame />
    </div>
  );
}

function Frame2() {
  return (
    <div className="content-stretch flex flex-col gap-[20px] items-center justify-center relative shrink-0 w-full">
      <Frame3 />
      <Frame1 />
    </div>
  );
}

function LoginIcon() {
  return (
    <div className="absolute left-0 size-[24px] top-0" data-name="Login Icon">
      <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 24 24">
        <g id="heroicons-outline/arrow-right-end-on-rectangle">
          <path d={svgPaths.p371352c0} id="Vector" stroke="var(--stroke-0, white)" strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" />
        </g>
      </svg>
    </div>
  );
}

function IconLeft2() {
  return (
    <div className="relative shrink-0 size-[20px]" data-name="Icon / Left">
      <LoginIcon />
    </div>
  );
}

function Button() {
  return (
    <div className="bg-[#2580d3] relative rounded-[6px] shrink-0 w-full" data-name="Button">
      <div className="flex flex-row items-center justify-center overflow-clip rounded-[inherit] size-full">
        <div className="box-border content-stretch flex gap-[8px] items-center justify-center px-[16px] py-[10px] relative w-full">
          <IconLeft2 />
          <div className="flex flex-col font-['Inter:Semi_Bold',sans-serif] font-semibold justify-center leading-[0] not-italic relative shrink-0 text-[16px] text-justify text-nowrap text-white">
            <p className="leading-[24px] whitespace-pre">Login</p>
          </div>
        </div>
      </div>
    </div>
  );
}

function HelpCenterIcon() {
  return (
    <div className="h-[8px] relative shrink-0 w-[7.565px]" data-name="Help Center Icon">
      <div className="absolute inset-[-12.5%_-13.22%]">
        <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 10 10">
          <g id="Help Center Icon">
            <path d="M1 9.00052L7.80449 1.76102" id="Vector" stroke="var(--stroke-0, #1F6DB3)" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" />
            <path d={svgPaths.p5042680} id="Vector_2" stroke="var(--stroke-0, #1F6DB3)" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" />
            <path d={svgPaths.pefe3d80} id="Vector_3" stroke="var(--stroke-0, #1F6DB3)" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" />
          </g>
        </svg>
      </div>
    </div>
  );
}

function HelpCenterContainer() {
  return (
    <div className="content-stretch flex gap-[2px] items-center relative shrink-0" data-name="Help Center Container">
      <p className="font-['Inter:Regular',sans-serif] font-normal leading-[20px] not-italic relative shrink-0 text-[0px] text-[12px] text-[grey] text-nowrap whitespace-pre">
        <span className="text-neutral-500">{`Having trouble signing in? `}</span>
        <span className="font-['Inter:Bold',sans-serif] font-bold text-[#1f6db3]">Help Center</span>
      </p>
      <HelpCenterIcon />
    </div>
  );
}

function FooterContainer() {
  return (
    <div className="content-stretch flex flex-col gap-[16px] items-center relative shrink-0 w-full" data-name="Footer Container">
      <div className="flex flex-col font-['Inter:Regular','Noto_Sans:Regular',sans-serif] font-normal justify-center leading-[0] min-w-full not-italic relative shrink-0 text-[0px] text-center text-neutral-800 w-[min-content]">
        <p className="leading-[20px] text-[12px]">
          <span className="text-neutral-800">{`By continuing you confirm that you agree with our `}</span>
          <span className="[text-decoration-skip-ink:none] [text-underline-position:from-font] decoration-solid font-['Inter:Bold','Noto_Sans:Regular',sans-serif] font-bold not-italic text-[#1f6db3] underline">Privacy Policy</span>,<span className="text-neutral-800"> </span>
          <span className="[text-decoration-skip-ink:none] [text-underline-position:from-font] decoration-solid font-['Inter:Bold','Noto_Sans:Regular',sans-serif] font-bold not-italic text-[#1f6db3] underline">Disclosures</span>
          <span className="text-[#2580d3]"> </span>
          <span className="text-neutral-800">{`& `}</span>
          <span className="[text-decoration-skip-ink:none] [text-underline-position:from-font] decoration-solid font-['Inter:Bold','Noto_Sans:Regular',sans-serif] font-bold not-italic text-[#1f6db3] underline">Terms and Conditions</span>
          <span className="text-neutral-800">.</span>
        </p>
      </div>
      <HelpCenterContainer />
    </div>
  );
}

function FormContainer() {
  return (
    <div className="basis-0 content-stretch flex flex-col gap-[48px] grow items-center justify-center min-h-px min-w-px relative shrink-0" data-name="Form Container">
      <Frame2 />
      <Button />
      <FooterContainer />
    </div>
  );
}

function LoginForm() {
  return (
    <div className="basis-0 bg-white grow h-full min-h-px min-w-px relative rounded-[20px] shrink-0" data-name="Login Form">
      <div className="flex flex-row items-center justify-center overflow-clip rounded-[inherit] size-full">
        <div className="box-border content-stretch flex gap-[12px] items-center justify-center p-[40px] relative size-full">
          <FormContainer />
        </div>
      </div>
    </div>
  );
}

export default function DesktopLoginLandingPage() {
  return (
    <div className="relative size-full" data-name="Desktop Login Landing Page">
      <div aria-hidden="true" className="absolute inset-0 pointer-events-none">
        <div className="absolute inset-0" />
        <div className="absolute inset-0 overflow-hidden">
          <img alt="" className="absolute h-[106.67%] left-0 max-w-none top-[-2.11%] w-full" src={imgDesktopLoginLandingPage} />
        </div>
      </div>
      <div className="flex flex-row items-center justify-center size-full">
        <div className="box-border content-stretch flex gap-[10px] items-center justify-center px-[20px] py-[140px] relative size-full">
          <div className="basis-0 flex flex-row grow items-center self-stretch shrink-0">
            <LoginForm />
          </div>
        </div>
      </div>
    </div>
  );
}