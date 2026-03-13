<?php include __DIR__ . "/header.php"; ?>
<link rel="stylesheet" href="../plugins/apexcharts/dist/apexcharts.css">
<div class="wrapper-content">
    <h1 class="page-title">
        <img src="../asset/icon/coins.svg" alt="">
        Financial Planning
    </h1>

    <div class="card-nav-tab justify-content-between">
        <ul class="card-tab ">
            <li class="active" onclick="window.location.href='FinancialProfitLossPortal?id=<?php echo $_GET['id']; ?>';">
                <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                    <path d="M2.64966 19.999C2.52414 19.9661 2.39696 19.9374 2.27311 19.8998C0.819688 19.4612 0.281527 17.7399 1.25233 16.6356C1.30065 16.5808 1.35063 16.5271 1.40395 16.4687C0.538667 15.4823 0.530892 14.4949 1.39617 13.5044C0.54311 12.3224 0.542555 11.5342 1.40506 10.5557C1.38895 10.5327 1.37396 10.5046 1.3523 10.4816C0.716388 9.8103 0.580876 9.04718 0.960754 8.23503C1.34341 7.41662 2.05318 7.01915 3.00344 7.00767C3.53715 7.00141 4.07087 7.00663 4.60459 7.00663C4.67901 7.00663 4.75399 7.00663 4.84063 7.00663V5.3938C4.62292 5.3938 4.41021 5.39276 4.1975 5.3938C3.69488 5.39693 3.30556 5.2055 3.08285 4.7783C2.86015 4.35058 2.93846 3.94789 3.25058 3.57598C4.12141 2.53849 4.98669 1.49735 5.85752 0.460389C6.37291 -0.153028 7.22875 -0.15355 7.74359 0.459345C8.62331 1.50674 9.49747 2.55779 10.3772 3.60519C10.6832 3.9698 10.7315 4.36257 10.5205 4.7736C10.3083 5.18672 9.94011 5.38806 9.45193 5.3938C9.23089 5.39641 9.00985 5.3938 8.77215 5.3938V6.99724C8.8399 7.00037 8.91266 7.00663 8.98597 7.00663C9.52635 7.00767 10.0673 7.00193 10.6077 7.00819C11.6662 7.02071 12.4743 7.60179 12.7703 8.55425C12.7814 8.59076 12.7959 8.62676 12.8114 8.67005C13.6212 8.75299 14.3948 8.95224 15.0979 9.33615C17.1761 10.4701 18.2858 12.1659 18.2491 14.4302C18.2036 17.2673 16.0271 19.5305 13.0397 19.9499C12.9314 19.9651 12.8231 19.9833 12.7148 20H2.64966V19.999ZM17.0106 14.3139C17.0123 11.8091 14.8569 9.81708 12.1433 9.81499C9.59522 9.8129 7.42425 11.8613 7.42202 14.2685C7.4198 16.7853 9.54079 18.8258 12.1594 18.8269C14.8624 18.8279 17.009 16.8307 17.0106 14.3144V14.3139ZM11.4829 8.66588C11.2669 8.31118 10.9509 8.18078 10.5555 8.18078C8.04738 8.1813 5.53929 8.17973 3.0312 8.18443C2.8757 8.18443 2.7102 8.21155 2.56746 8.26736C2.15704 8.4275 1.941 8.8474 2.03097 9.26417C2.11816 9.66946 2.50748 9.96156 2.98289 9.96208C4.72178 9.96521 6.46122 9.96469 8.20011 9.95948C8.29286 9.95948 8.4006 9.91618 8.47558 9.86193C9.10871 9.405 9.80071 9.05917 10.5727 8.86305C10.8643 8.78898 11.1619 8.73525 11.4829 8.6664V8.66588ZM6.80111 1.23081C5.96582 2.23022 5.14831 3.20824 4.30246 4.22017C4.54905 4.22017 4.74732 4.21756 4.94559 4.22017C5.58817 4.22956 6.08801 4.69328 6.09967 5.29782C6.10689 5.66817 6.10133 6.03904 6.10133 6.40938C6.10133 6.60238 6.10133 6.79537 6.10133 6.99098H7.50366C7.50366 6.90596 7.50366 6.83606 7.50366 6.76564C7.50366 6.29097 7.49922 5.81631 7.50478 5.34164C7.51255 4.67189 7.99962 4.22278 8.71272 4.21913C8.89489 4.21809 9.0765 4.21913 9.29976 4.21913C8.45336 3.20668 7.63807 2.23179 6.80056 1.22977L6.80111 1.23081ZM8.52167 18.8149C7.87132 18.3235 7.35871 17.7753 6.96217 17.1317C6.93329 17.0842 6.84054 17.0461 6.77779 17.0461C5.51041 17.0414 4.24359 17.0388 2.97622 17.0451C2.55747 17.0471 2.24479 17.2349 2.0804 17.6016C1.8177 18.1879 2.27811 18.8222 2.97344 18.8243C4.78065 18.83 6.58785 18.8264 8.3956 18.8258C8.4217 18.8258 8.44781 18.8217 8.52167 18.8149ZM7.19987 11.1368C5.76644 11.1368 4.37411 11.1347 2.98122 11.1378C2.43362 11.1388 2.02153 11.516 2.01264 12.012C2.00431 12.5081 2.40141 12.9092 2.94901 12.9155C4.03699 12.9275 5.12498 12.9175 6.21297 12.9222C6.33904 12.9228 6.37291 12.8696 6.40346 12.7684C6.5623 12.24 6.8 11.7434 7.1149 11.2797C7.13934 11.2432 7.15989 11.2046 7.19932 11.1368H7.19987ZM6.12855 14.1037C6.14465 14.1115 6.13299 14.1011 6.12133 14.1011C5.02668 14.1011 3.93203 14.088 2.83793 14.1073C2.37863 14.1152 2.02153 14.5199 2.01375 14.9654C2.00542 15.4109 2.34753 15.8407 2.80405 15.85C3.99423 15.8746 5.18496 15.8584 6.34681 15.8584C6.27461 15.2752 6.20241 14.6983 6.12855 14.1042V14.1037Z" fill="#30313D" />
                    <path d="M10.2381 14.1482H11.0178L9.81543 11.6602H11.0745L12.343 14.4482L13.6114 11.6602H14.8705L13.6681 14.1482H14.4478V14.8629H13.3204L12.935 15.6568H14.4473V16.3448H12.935V17.3593H11.7515V16.3448H10.2392V15.6568H11.7515L11.366 14.8629H10.2386L10.2381 14.1482Z" fill="#30313D" />
                </svg>
                PL Forcast
            </li>
            <li onclick="window.location.href='GoldenRatio?id=<?php echo $_GET['id']; ?>';"><img src="../images/icons/Dark/48px/Golden-Ratio.png" style="width:18px"> Golden Ratio</li>
            <li onclick="window.location.href='ForecastAccounts?id=<?php echo $_GET['id']; ?>';"><img src="../images/icons/Dark/48px/Designation-1.png" style="width:18px"> Forecast Accounts</li>
        </ul>
        <ul class="card-tab" id="showBranchDetail">
        </ul>

    </div>

    <div class="mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="me-2 fs-20"><a href="FinancialProfitLossPortal?id=<?php echo $_GET['id']; ?>" class="text-primary"><i class="bi bi-caret-left-fill"></i>Back to Portal</a></div>
                                <div class="fs-20 me-2">Charts & Analysis</div>
                            </div>
                            <div class="d-flex align-items-center">
                                <a class="btn btn-sm btn-blue fs-13 me-2">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-1">
                                        <path d="M7 0C5.61553 0 4.26215 0.410543 3.11101 1.17971C1.95987 1.94888 1.06266 3.04213 0.532846 4.32122C0.003033 5.6003 -0.13559 7.00776 0.134506 8.36563C0.404603 9.7235 1.07129 10.9708 2.05026 11.9497C3.02922 12.9287 4.2765 13.5954 5.63437 13.8655C6.99224 14.1356 8.3997 13.997 9.67879 13.4672C10.9579 12.9373 12.0511 12.0401 12.8203 10.889C13.5895 9.73785 14 8.38447 14 7C13.998 5.1441 13.2599 3.36479 11.9475 2.05247C10.6352 0.74015 8.8559 0.0020073 7 0ZM7 12.8333C5.84628 12.8333 4.71846 12.4912 3.75918 11.8502C2.79989 11.2093 2.05222 10.2982 1.61071 9.23232C1.16919 8.16642 1.05368 6.99353 1.27876 5.86197C1.50384 4.73042 2.05941 3.69102 2.87521 2.87521C3.69102 2.0594 4.73042 1.50383 5.86198 1.27875C6.99353 1.05367 8.16642 1.16919 9.23232 1.6107C10.2982 2.05221 11.2093 2.79989 11.8502 3.75917C12.4912 4.71846 12.8333 5.84627 12.8333 7C12.8316 8.54657 12.2165 10.0293 11.1229 11.1229C10.0293 12.2165 8.54658 12.8316 7 12.8333Z" fill="#2580D3" />
                                        <path d="M6.99674 5.83301H6.41341C6.2587 5.83301 6.11033 5.89447 6.00093 6.00386C5.89154 6.11326 5.83008 6.26163 5.83008 6.41634C5.83008 6.57105 5.89154 6.71942 6.00093 6.82882C6.11033 6.93822 6.2587 6.99967 6.41341 6.99967H6.99674V10.4997C6.99674 10.6544 7.0582 10.8028 7.1676 10.9122C7.277 11.0215 7.42537 11.083 7.58008 11.083C7.73479 11.083 7.88316 11.0215 7.99256 10.9122C8.10195 10.8028 8.16341 10.6544 8.16341 10.4997V6.99967C8.16341 6.69026 8.04049 6.39351 7.8217 6.17472C7.60291 5.95592 7.30616 5.83301 6.99674 5.83301Z" fill="#2580D3" />
                                        <path d="M7 4.66699C7.48325 4.66699 7.875 4.27524 7.875 3.79199C7.875 3.30874 7.48325 2.91699 7 2.91699C6.51675 2.91699 6.125 3.30874 6.125 3.79199C6.125 4.27524 6.51675 4.66699 7 4.66699Z" fill="#2580D3" />
                                    </svg>
                                    Data Dictionary
                                </a>
                                <a class="btn btn-sm btn-blue fs-13 me-2">
                                    <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-1">
                                        <path d="M10.7694 3.22933L8.679 1.19583C7.8852 0.424667 6.8304 0 5.709 0H3C1.3458 0 0 1.30842 0 2.91667V11.0833C0 12.6916 1.3458 14 3 14H9C10.6542 14 12 12.6916 12 11.0833V6.11625C12 5.02483 11.5626 4.0005 10.7694 3.22933ZM9.921 4.05475C10.1118 4.23967 10.2732 4.44558 10.404 4.66725H7.7994C7.4682 4.66725 7.1994 4.40533 7.1994 4.08392V1.55108C7.4274 1.67825 7.6392 1.83517 7.83 2.02067L9.9204 4.05417L9.921 4.05475ZM10.8 11.0839C10.8 12.0487 9.9924 12.8339 9 12.8339H3C2.0076 12.8339 1.2 12.0487 1.2 11.0839V2.91667C1.2 1.95183 2.0076 1.16667 3 1.16667H5.709C5.8068 1.16667 5.904 1.17133 6 1.18008V4.08333C6 5.04817 6.8076 5.83333 7.8 5.83333H10.7862C10.7952 5.92667 10.8 6.02117 10.8 6.11625V11.0839ZM8.2242 9.39517C8.4588 9.62267 8.4588 9.99192 8.2242 10.22L7.2564 11.1615C6.9102 11.4981 6.4548 11.6667 6 11.6667C5.5452 11.6667 5.0898 11.4981 4.7436 11.1615L3.7758 10.22C3.5412 9.99192 3.5412 9.62267 3.7758 9.39517C4.0104 9.16708 4.3896 9.16708 4.6242 9.39517L5.4 10.1494V7.58392C5.4 7.26192 5.6682 7.00058 6 7.00058C6.3318 7.00058 6.6 7.26192 6.6 7.58392V10.1494L7.3758 9.39517C7.6104 9.16708 7.9896 9.16708 8.2242 9.39517Z" fill="#2580D3" />
                                    </svg>
                                    Export Chart
                                </a>
                                <a id="filter-button" class="btn btn-sm btn-primary fs-13 me-2 rounded-pill" onclick="$('#filter-fs-bottom').addClass('active');">
                                    <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.5739 1.344C11.4116 0.945778 11.1369 0.609778 10.8124 0.360889C10.4753 0.124444 10.0883 0 9.67629 0H2.0859C1.68641 0 1.28691 0.124444 0.949839 0.360889C0.612766 0.597333 0.350598 0.933333 0.175819 1.344C0.0135246 1.74222 -0.0364123 2.19022 0.0260087 2.61333C0.0884297 3.04889 0.263209 3.44711 0.525377 3.78311L4.27064 8.38756V11.6604C4.27064 11.7476 4.2956 11.8347 4.33306 11.9218C4.37051 12.0089 4.42045 12.0711 4.49535 12.1333L6.63015 13.888C6.71754 13.9627 6.8299 14 6.95474 14C7.09207 14 7.22939 13.9378 7.32927 13.8258C7.42914 13.7138 7.49156 13.5644 7.49156 13.4151V10.9387H6.41792V12.2453L5.34428 11.3742V8.16356C5.34428 8.01422 5.29434 7.87733 5.20695 7.76533L1.32437 3.01156C1.19952 2.84978 1.11213 2.65067 1.08717 2.43911C1.0622 2.22756 1.08717 2.016 1.16207 1.81689C1.23698 1.61778 1.3743 1.456 1.5366 1.344C1.69889 1.232 1.88615 1.16978 2.0859 1.16978H9.67629C9.87604 1.16978 10.0633 1.232 10.2256 1.344C10.3879 1.456 10.5252 1.63022 10.6001 1.81689C10.675 2.016 10.7125 2.22756 10.675 2.43911C10.6376 2.65067 10.5627 2.84978 10.4378 3.01156L6.56773 7.76533C6.46786 7.88978 6.41792 8.03911 6.41792 8.18845V8.848H7.49156V8.38756L11.2368 3.78311C11.499 3.45956 11.6738 3.04889 11.7362 2.61333C11.7986 2.17778 11.7362 1.74222 11.5739 1.33156V1.344Z" fill="white" />
                                        <path d="M9.507 9.5535V7.83984H9.04882L8.41245 8.58651V9.5535H6.71973V10.5817H8.41245V12.3198H9.507V10.5817H11.1997V9.5535H9.507Z" fill="white" />
                                    </svg>
                                    Filter
                                </a>
                            </div>
                        </div>

                        <div class="bar-light  mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <input type="hidden" name="type" id="type" value="1">
                                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                                        <path d="M11.3333 7.19267C8.76067 7.19267 6.66667 9.286 6.66667 11.8593C6.66667 14.418 8.76067 16.5 11.3333 16.5C13.906 16.5 16 14.4067 16 11.8333C16 9.27467 13.906 7.19267 11.3333 7.19267ZM11.3333 15.1667C9.49533 15.1667 8 13.6827 8 11.8593C8 10.0213 9.49533 8.526 11.3333 8.526C13.1713 8.526 14.6667 10.01 14.6667 11.8333C14.6667 13.6713 13.1713 15.1667 11.3333 15.1667ZM12.4713 12.0287C12.732 12.2893 12.732 12.7107 12.4713 12.9713C12.3413 13.1013 12.1707 13.1667 12 13.1667C11.8293 13.1667 11.6587 13.1013 11.5287 12.9713L10.862 12.3047C10.7367 12.1793 10.6667 12.01 10.6667 11.8333V10.5C10.6667 10.132 10.9647 9.83333 11.3333 9.83333C11.702 9.83333 12 10.132 12 10.5V11.5573L12.4713 12.0287ZM16 5.16667V6.5C16 6.868 15.702 7.16667 15.3333 7.16667C14.9647 7.16667 14.6667 6.868 14.6667 6.5V5.16667C14.6667 4.064 13.7693 3.16667 12.6667 3.16667H3.33333C2.23067 3.16667 1.33333 4.064 1.33333 5.16667V5.83333H7.33333C7.70133 5.83333 8 6.132 8 6.5C8 6.868 7.70133 7.16667 7.33333 7.16667H1.33333V13.1667C1.33333 14.2693 2.23067 15.1667 3.33333 15.1667H6C6.368 15.1667 6.66667 15.4653 6.66667 15.8333C6.66667 16.2013 6.368 16.5 6 16.5H3.33333C1.49533 16.5 0 15.0047 0 13.1667V5.16667C0 3.32867 1.49533 1.83333 3.33333 1.83333H4V1.16667C4 0.798667 4.29867 0.5 4.66667 0.5C5.03467 0.5 5.33333 0.798667 5.33333 1.16667V1.83333H10.6667V1.16667C10.6667 0.798667 10.9647 0.5 11.3333 0.5C11.702 0.5 12 0.798667 12 1.16667V1.83333H12.6667C14.5047 1.83333 16 3.32867 16 5.16667Z" fill="#3C3D48" />
                                    </svg>
                                    <div class="me-2">Current Financial Year</div>
                                    <select name="year" id="year" class="select-year me-2" onchange="getData();">
                                    </select>
                                    <button class="btn-refresh" onclick="destroy();">
                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.09648 1.0835C8.55331 1.08828 9.94769 1.67338 10.9688 2.70845H9.27135C8.97106 2.70845 8.72764 2.95094 8.72764 3.25008C8.72764 3.54923 8.97106 3.79172 9.27135 3.79172H11.524C12.0815 3.79142 12.5333 3.34126 12.5337 2.78588V0.541841C12.5337 0.2427 12.2902 0.000202792 11.9899 0.000202792C11.6897 0.000202792 11.4462 0.2427 11.4462 0.541841V1.66739C8.77285 -0.731097 4.65385 -0.516503 2.24619 2.1467C1.30397 3.18895 0.726058 4.50725 0.599057 5.90414C0.571123 6.2041 0.792578 6.4698 1.09368 6.49763C1.10999 6.49913 1.12638 6.49991 1.14279 6.49997C1.41838 6.50347 1.65136 6.29743 1.68054 6.02439C1.93138 3.2299 4.28011 1.08719 7.09648 1.0835Z" fill="#2580D3" />
                                            <path d="M13.0506 6.50004C12.775 6.49654 12.542 6.70258 12.5129 6.97562C12.2534 9.95165 9.62128 12.1547 6.63384 11.8962C5.34128 11.7843 4.13165 11.2151 3.22399 10.2916H4.92149C5.22177 10.2916 5.4652 10.0491 5.4652 9.74993C5.4652 9.45078 5.22177 9.20829 4.92149 9.20829H2.66886C2.11152 9.20798 1.65949 9.65784 1.65918 10.213C1.65918 10.2134 1.65918 10.2137 1.65918 10.2141V12.4582C1.65918 12.7573 1.9026 12.9998 2.20289 12.9998C2.50317 12.9998 2.7466 12.7573 2.7466 12.4582V11.3326C5.41998 13.7311 9.53896 13.5165 11.9466 10.8533C12.8889 9.81106 13.4668 8.49275 13.5938 7.09584C13.6217 6.79588 13.4003 6.53018 13.0992 6.50235C13.083 6.50088 13.0668 6.50009 13.0506 6.50004Z" fill="#2580D3" />
                                        </svg>
                                    </button>

                                    <div class="me-2 filterCurrency">Currency</div>
                                    <select name="currencyId" id="currencyId" class="select-year me-2 filterCurrency" onchange="getData();">
                                    </select>

                                    <div class="me-2 filterRate">Round Up</div>
                                    <select name="rate" id="rate" class="select-year me-2 filterRate" onchange="getData();">
                                        <option value="1">Normal</option>
                                        <option value="1000">Thousands</option>
                                        <option value="1000000">Millions</option>
                                    </select>
                                </div>
                                <div class="chart-tab-menu">
                                    <button class="menu-chart" type="button">
                                        <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.41873 5.24672C2.90529 5.24672 2.39185 5.05418 2.00677 4.66326L0.670661 3.33299C0.443113 3.10544 0.443113 2.73786 0.670661 2.51031C0.898208 2.28277 1.26578 2.28277 1.49333 2.51031L2.82361 3.84059C3.15034 4.16733 3.67545 4.16733 4.00219 3.84059L6.07929 1.76349C6.86112 0.981663 8.12721 0.981663 8.90904 1.76349L9.81923 2.67368C10.1343 2.98875 10.6827 2.98875 10.9978 2.67368L13.5067 0.170661C13.7342 -0.0568868 14.1018 -0.0568868 14.3293 0.170661C14.5569 0.398208 14.5569 0.765785 14.3293 0.993332L11.8322 3.49052C11.0795 4.24318 9.76089 4.24318 9.0024 3.49052L8.09221 2.58033C7.76547 2.25359 7.24036 2.25359 6.91363 2.58033L4.83653 4.65743C4.44561 5.04834 3.93217 5.24088 3.42457 5.24088L3.41873 5.24672ZM5.1691 13.4209V8.16983C5.1691 7.84893 4.90654 7.58637 4.58564 7.58637C4.26474 7.58637 4.00219 7.84893 4.00219 8.16983V13.4209C4.00219 13.7418 4.26474 14.0044 4.58564 14.0044C4.90654 14.0044 5.1691 13.7418 5.1691 13.4209ZM2.25182 13.4209V7.00292C2.25182 6.68202 1.98927 6.41946 1.66837 6.41946C1.34747 6.41946 1.08491 6.68202 1.08491 7.00292V13.4209C1.08491 13.7418 1.34747 14.0044 1.66837 14.0044C1.98927 14.0044 2.25182 13.7418 2.25182 13.4209ZM8.08637 13.4209V5.25255C8.08637 4.93165 7.82382 4.6691 7.50292 4.6691C7.18202 4.6691 6.91946 4.93165 6.91946 5.25255V13.4209C6.91946 13.7418 7.18202 14.0044 7.50292 14.0044C7.82382 14.0044 8.08637 13.7418 8.08637 13.4209ZM11.0036 13.4209V7.00292C11.0036 6.68202 10.7411 6.41946 10.4202 6.41946C10.0993 6.41946 9.83674 6.68202 9.83674 7.00292V13.4209C9.83674 13.7418 10.0993 14.0044 10.4202 14.0044C10.7411 14.0044 11.0036 13.7418 11.0036 13.4209ZM13.9209 13.4209V4.6691C13.9209 4.3482 13.6584 4.08564 13.3375 4.08564C13.0166 4.08564 12.754 4.3482 12.754 4.6691V13.4209C12.754 13.7418 13.0166 14.0044 13.3375 14.0044C13.6584 14.0044 13.9209 13.7418 13.9209 13.4209Z" fill="#30313D" />
                                        </svg>
                                    </button>
                                    <button class="menu-chart menu-tab active" type="button" data-id="#AnnualChart">Annual Chart</button>
                                    <button class="menu-chart menu-tab" type="button" data-id="#ContentAnalysis">Content Analysis</button>
                                    <button class="menu-chart menu-tab" type="button" data-id="#ComparisonAnalysis">Comparison Analysis</button>
                                </div>
                            </div>
                        </div>

                        <div class="chart-tab-content">
                            <div class="tab-content show" id="AnnualChart">
                                <div id="chart1">
                                </div>
                                <div class="d-flex">
                                    <div class="border-end pe-2">
                                        <strong class="fs-12 fw-200">Legends</strong><br>
                                        <table class="fw-100 fs-10">
                                            <tr>
                                                <td class="pe-3">Actual</td>
                                                <td>
                                                    <svg width="39" height="10" viewBox="0 0 39 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M37 4.83789L1.69434 4.83789" stroke="#7E7E7E" stroke-width="2.54779" stroke-linecap="round" />
                                                        <path d="M23.7962 4.83757C23.7962 2.50625 21.9062 0.616243 19.5749 0.616243C17.2435 0.616243 15.3535 2.50626 15.3535 4.83757C15.3535 7.16901 17.2435 9.05889 19.5749 9.05889C21.9062 9.05889 23.7962 7.16901 23.7962 4.83757Z" fill="#D2D2D2" stroke="#7E7E7E" stroke-width="0.767514" />
                                                    </svg>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pe-3">Forecasted</td>
                                                <td>
                                                    <svg width="38" height="2" viewBox="0 0 38 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M36.3056 1.1753L1 1.17529" stroke="#7E7E7E" stroke-width="1.53503" stroke-linecap="round" stroke-dasharray="2.3 3.84" />
                                                    </svg>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="ps-2">
                                        <strong class="fs-12 fw-200">Active Contents</strong> <a href="#" class="text-primary fs-12 fw-200">Change</a><br>
                                        <span class="badge fw-100 rounded-0 fs-12 text-white" style="background-color: #2580D3;">Sales</span>
                                        <span class="badge fw-100 rounded-0 fs-12 text-dark" style="background-color: #FFE100;">Variable Expense</span>
                                        <span class="badge fw-100 rounded-0 fs-12 text-white" style="background-color: #FF0000;">Labor Cost</span>
                                        <span class="badge fw-100 rounded-0 fs-12 text-white" style="background-color: #9687A0;">Fixed Expense (Other)</span>
                                        <span class="badge fw-100 rounded-0 fs-12 text-white" style="background-color: #4A7318;">Non-Operating Income</span>
                                        <span class="badge fw-100 rounded-0 fs-12 text-white" style="background-color: #668177;">Non-Operating Expense</span>
                                        <span class="badge fw-100 rounded-0 fs-12 text-white" style="background-color: #97825B;">Interest and Dividend Income</span>
                                        <span class="badge fw-100 rounded-0 fs-12 text-white" style="background-color: #474D6F;">Interest Expense</span>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-content " id="ContentAnalysis">
                                <div class=" d-flex">
                                    <div class="me-2" style="width:244px">
                                        <div class="pl-content-picker">
                                            <div class="fs-16 fw-400">PL Content Picker</div>
                                            <div class="fs-10 text-muted">Compare past performance, current results, targets, and next year's forecast—all in one view for smarter decisions.</div>
                                            <label class="pl-content-checkbox"> Sales
                                                <input type="radio" name="compare" onchange="getData();" value="0" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="pl-content-checkbox"> Variable Expense
                                                <input type="radio" name="compare" onchange="getData();" value="1">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="pl-content-checkbox"> Gross Profit (or Loss)
                                                <input type="radio" name="compare" onchange="getData();" value="2">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="pl-content-checkbox"> Labor Cost
                                                <input type="radio" name="compare" onchange="getData();" value="3">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="pl-content-checkbox"> Fixed Expense (Other)
                                                <input type="radio" name="compare" onchange="getData();" value="4">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="pl-content-checkbox"> Fixed Expense
                                                <input type="radio" name="compare" onchange="getData();" value="5">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="pl-content-checkbox"> Operating Profit (or Loss)
                                                <input type="radio" name="compare" onchange="getData();" value="6">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="pl-content-checkbox"> Non-Operating Income
                                                <input type="radio" name="compare" onchange="getData();" value="7">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="pl-content-checkbox"> Non-Operating Expense
                                                <input type="radio" name="compare" onchange="getData();" value="8">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="pl-content-checkbox"> Ordinary Profit (or Loss)
                                                <input type="radio" name="compare" onchange="getData();" value="9">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="pl-content-checkbox"> Break-Even Sales
                                                <input type="radio" name="compare" onchange="getData();" value="10">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="pl-content-checkbox"> Marginal Profit Ratio
                                                <input type="radio" name="compare" onchange="getData();" value="11">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" flex-grow-1">
                                        <div id="chart2" class="w-100">
                                        </div>
                                        <div class="ms-3">
                                            <div class="fs-16">Legends</div>
                                            <div class="d-flex">
                                                <div class="me-3">
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check me-4 fw-100 fs-14">
                                                                    <input class="form-check-input" type="checkbox" value="" id="Performance" checked onchange="getData();">
                                                                    <label class="form-check-label" for="Performance" id="labelPerformance">
                                                                        <!-- 2025 Performance -->
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <span class="d-inline-block" style="width: 15px;height:15px;background-color: #A9EC9F; border-radius: 2px;"></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check me-4 fw-100 fs-14">
                                                                    <input class="form-check-input" type="checkbox" value="" id="Target" checked onchange="getData();">
                                                                    <label class="form-check-label" for="Target" id="labelTarget">
                                                                        <!-- 2025 Target -->
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            </td>
                                                            <td>
                                                                <span class="d-inline-block" style="width: 15px;height:15px;background-color: #01724E; border-radius: 2px;"></span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="me-3">
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check me-4 fw-100 fs-14">
                                                                    <input class="form-check-input" type="checkbox" value="" id="Forecast" checked onchange="getData();">
                                                                    <label class="form-check-label" for="Forecast" id="labelForecast">
                                                                        <!-- 2026 Forecast -->
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <svg width="47" height="13" viewBox="0 0 47 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M45.9271 6.58985L1.26465 6.58984" stroke="#7E7E7E" stroke-width="1.94184" stroke-linecap="round" stroke-dasharray="2.91 4.85" />
                                                                    <path d="M29.2269 6.79504C29.2269 3.84588 26.836 1.45497 23.8868 1.45497C20.9376 1.45497 18.5468 3.84588 18.5468 6.79504C18.5468 9.74436 20.9376 12.1351 23.8868 12.1351C26.836 12.1351 29.2269 9.74437 29.2269 6.79504Z" fill="#D2D2D2" stroke="#7E7E7E" stroke-width="0.970922" />
                                                                </svg>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check me-4 fw-100 fs-14">
                                                                    <input class="form-check-input" type="checkbox" value="" id="LastYearPerformance" checked onchange="getData();">
                                                                    <label class="form-check-label" for="LastYearPerformance" id="labelLastYearPerformance">
                                                                        <!-- 2024 Performance -->
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            </td>
                                                            <td>
                                                                <svg width="47" height="11" viewBox="0 0 47 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M0.681641 7.95156C0.681641 7.95156 3.85002 8.44078 4.85296 8.77947C5.85591 9.11815 7.74782 10.36 8.9787 9.79553C10.2096 9.23105 10.9618 1.17783 13.1044 0.989667C15.2471 0.801508 15.5662 5.69365 17.2986 5.65602C19.0309 5.61839 20.1478 5.54312 21.4243 5.43023C22.7008 5.31733 24.6155 5.43023 25.5272 4.52706C26.439 3.6239 27.8522 2.75837 29.653 2.75837C31.4537 2.75837 32.3427 5.50549 33.8699 4.94101C35.3971 4.37654 36.2861 2.98416 38.0412 2.75837C39.7964 2.53257 40.7993 5.2797 42.0758 5.24207C43.3522 5.20444 46.2243 6.06997 46.2243 6.06997" stroke="#008BF0" stroke-width="1.26502" stroke-linecap="round" />
                                                                </svg>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content" id="ComparisonAnalysis">
                                <div class="row">
                                    <?php for ($i = 0; $i < 12; $i++): ?>
                                        <div class="col-lg-4 mb-3 p-3">
                                            <div class="card chart">
                                                <div class="card-body title">
                                                    <span class="label-title label-info me-2">PL</span> Sales
                                                </div>
                                                <div class="card-body">
                                                    <div class="bar-container">
                                                        <div class="label"><span class="label-title label-red me-2">LP</span> 2023</div>
                                                        <div class="bar">
                                                            <div class="bar-inner red"></div>
                                                        </div>
                                                        <div class="percentage">78%</div>
                                                    </div>
                                                    <div class="bar-container">
                                                        <div class="label fw-400"><span class="label-title label-red me-2">CP</span> 2024</div>
                                                        <div class="bar">
                                                            <div class="bar-inner green"></div>
                                                        </div>
                                                        <div class="percentage">45%</div>
                                                    </div>
                                                    <div class="bar-container">
                                                        <div class="label"><span class="label-title label-green me-2">CT</span> 2024</div>
                                                        <div class="bar">
                                                            <div class="bar-inner yellow"></div>
                                                        </div>
                                                        <div class="percentage">100%</div>
                                                    </div>
                                                    <div class="bar-container">
                                                        <div class="label"><span class="label-title label-yellow me-2">NT</span> 2025</div>
                                                        <div class="bar">
                                                            <div class="bar-inner blue"></div>
                                                        </div>
                                                        <div class="percentage">120%</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="filter-fs-bottom" id="filter-fs-bottom">
    <div class="filter-fs-detail">
        <div class="d-flex justify-content-between mb-3">
            <div class="fs-24">
                <svg width="24" height="30" viewBox="0 0 24 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M23.6202 3.45721C23.289 2.64451 22.7285 1.9588 22.066 1.45086C21.3781 0.968324 20.5883 0.714355 19.7475 0.714355H4.25694C3.44165 0.714355 2.62635 0.968324 1.93845 1.45086C1.25054 1.9334 0.715506 2.61912 0.358815 3.45721C0.0276011 4.26991 -0.0743107 5.1842 0.0530791 6.04769C0.180469 6.93658 0.53716 7.74928 1.0722 8.43499L8.71558 17.8318V24.5112C8.71558 24.689 8.76654 24.8667 8.84297 25.0445C8.91941 25.2223 9.02132 25.3493 9.17419 25.4763L13.5309 29.0572C13.7093 29.2096 13.9386 29.2858 14.1933 29.2858C14.4736 29.2858 14.7539 29.1588 14.9577 28.9302C15.1615 28.7017 15.2889 28.3969 15.2889 28.0921V23.0382H13.0978V25.7048L10.9067 23.9271V17.3747C10.9067 17.0699 10.8048 16.7905 10.6264 16.562L2.70279 6.86039C2.44801 6.53023 2.26966 6.12388 2.21871 5.69213C2.16775 5.26039 2.21871 4.82864 2.37157 4.42229C2.52444 4.01594 2.8047 3.68578 3.13591 3.45721C3.46713 3.22864 3.84929 3.10166 4.25694 3.10166H19.7475C20.1552 3.10166 20.5374 3.22864 20.8686 3.45721C21.1998 3.68578 21.48 4.04134 21.6329 4.42229C21.7858 4.82864 21.8622 5.26039 21.7858 5.69213C21.7093 6.12388 21.5565 6.53023 21.3017 6.86039L13.4035 16.562C13.1997 16.8159 13.0978 17.1207 13.0978 17.4255V18.7715H15.2889V17.8318L22.9323 8.43499C23.4673 7.77467 23.824 6.93658 23.9514 6.04769C24.0788 5.1588 23.9514 4.26991 23.6202 3.43182V3.45721Z" fill="#2580D3" />
                    <path d="M19.4022 20.2126V16.7153H18.4671L17.1684 18.2391V20.2126H13.7139V22.311H17.1684V25.8582H19.4022V22.311H22.8567V20.2126H19.4022Z" fill="#2580D3" />
                </svg>
                Filter
            </div>
            <div class="pointer" onclick="$('#filter-fs-bottom').removeClass('active');">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="15" cy="15" r="14" stroke="#30313D" stroke-width="2" />
                    <path d="M20.6769 10.5015L10.4951 20.6833M20.9951 21.0015L10.6527 10.6591" stroke="#30313D" stroke-width="2" stroke-linecap="round" />
                </svg>
            </div>
        </div>
        <div class="mb-3 fs-16 fw-200">
            Select components from the PL portal to display them on the chart. Your data will update dynamically based on your selection.
        </div>

        <div class="row">
            <div class="col-4">
                <div class="box-filter-fs">
                    <label class="filter-fs-checkbox text-white" style="background-color: #2580D3;">Sale
                        <input type="checkbox" id="salesCheckbox" name="annualFilter" value="1" checked>
                        <span class="filter-fs-checkmark"></span>
                    </label>
                    <div class="filter-fs-content">
                        <div class="d-flex justify-content-between">
                            <div class="">Actual</div>
                            <div class="">
                                <svg width="39" height="10" viewBox="0 0 39 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M37.5 5.00049L2.19434 5.00049" stroke="#2580D3" stroke-width="2.54779" stroke-linecap="round" />
                                    <path d="M24.0657 5.00017C24.0657 2.66885 22.1757 0.778841 19.8444 0.778841C17.513 0.778841 15.6231 2.66886 15.6231 5.00017C15.6231 7.3316 17.513 9.22149 19.8444 9.22149C22.1757 9.22149 24.0657 7.33161 24.0657 5.00017Z" fill="#2580D3" stroke="#2580D3" stroke-width="0.767514" />
                                </svg>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="">Forecasted</div>
                            <div class="">
                                <svg width="38" height="2" viewBox="0 0 38 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M36.5 1L1.19434 1" stroke="#2580D3" stroke-width="1.53503" stroke-linecap="round" stroke-dasharray="2.3 3.84" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="box-filter-fs">
                    <label class="filter-fs-checkbox" style="background-color: #FFE100;">Variable Expense
                        <input type="checkbox" id="variableExpenseCheckbox" value="2" name="annualFilter" checked>
                        <span class="filter-fs-checkmark"></span>
                    </label>
                    <div class="filter-fs-content">
                        <div class="d-flex justify-content-between">
                            <div class="">Actual</div>
                            <div class="">
                                <svg width="39" height="10" viewBox="0 0 39 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M37.5 5.00049L2.19434 5.00049" stroke="#FFE100" stroke-width="2.54779" stroke-linecap="round" />
                                    <path d="M24.0657 5.00017C24.0657 2.66885 22.1757 0.778841 19.8444 0.778841C17.513 0.778841 15.6231 2.66886 15.6231 5.00017C15.6231 7.3316 17.513 9.22149 19.8444 9.22149C22.1757 9.22149 24.0657 7.33161 24.0657 5.00017Z" fill="#FFE100" stroke="#FFE100" stroke-width="0.767514" />
                                </svg>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="">Forecasted</div>
                            <div class="">
                                <svg width="38" height="2" viewBox="0 0 38 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M36.5 1L1.19434 1" stroke="#FFE100" stroke-width="1.53503" stroke-linecap="round" stroke-dasharray="2.3 3.84" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="box-filter-fs">
                    <label class="filter-fs-checkbox text-white" style="background-color: #FF0000;">Labor Cost
                        <input type="checkbox" id="laborCostCheckbox" name="annualFilter" value="3" checked>
                        <span class="filter-fs-checkmark"></span>
                    </label>
                    <div class="filter-fs-content">
                        <div class="d-flex justify-content-between">
                            <div class="">Actual</div>
                            <div class="">
                                <svg width="39" height="10" viewBox="0 0 39 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M37.5 5.00049L2.19434 5.00049" stroke="#FF0000" stroke-width="2.54779" stroke-linecap="round" />
                                    <path d="M24.0657 5.00017C24.0657 2.66885 22.1757 0.778841 19.8444 0.778841C17.513 0.778841 15.6231 2.66886 15.6231 5.00017C15.6231 7.3316 17.513 9.22149 19.8444 9.22149C22.1757 9.22149 24.0657 7.33161 24.0657 5.00017Z" fill="#FF0000" stroke="#FF0000" stroke-width="0.767514" />
                                </svg>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="">Forecasted</div>
                            <div class="">
                                <svg width="38" height="2" viewBox="0 0 38 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M36.5 1L1.19434 1" stroke="#FF0000" stroke-width="1.53503" stroke-linecap="round" stroke-dasharray="2.3 3.84" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="box-filter-fs">
                    <label class="filter-fs-checkbox text-white" style="background-color: #9687A0;">Fixed Expense (Other)
                        <input type="checkbox" id="fixedExpenseCheckbox" name="annualFilter" value="4" checked>
                        <span class="filter-fs-checkmark"></span>
                    </label>
                    <div class="filter-fs-content">
                        <div class="d-flex justify-content-between">
                            <div class="">Actual</div>
                            <div class="">
                                <svg width="39" height="10" viewBox="0 0 39 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M37.5 5.00049L2.19434 5.00049" stroke="#9687A0" stroke-width="2.54779" stroke-linecap="round" />
                                    <path d="M24.0657 5.00017C24.0657 2.66885 22.1757 0.778841 19.8444 0.778841C17.513 0.778841 15.6231 2.66886 15.6231 5.00017C15.6231 7.3316 17.513 9.22149 19.8444 9.22149C22.1757 9.22149 24.0657 7.33161 24.0657 5.00017Z" fill="#9687A0" stroke="#9687A0" stroke-width="0.767514" />
                                </svg>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="">Forecasted</div>
                            <div class="">
                                <svg width="38" height="2" viewBox="0 0 38 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M36.5 1L1.19434 1" stroke="#9687A0" stroke-width="1.53503" stroke-linecap="round" stroke-dasharray="2.3 3.84" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="box-filter-fs">
                    <label class="filter-fs-checkbox text-white" style="background-color: #4A7318;">Non-Operating Income
                        <input type="checkbox" id="nonOperatingIncomeCheckbox" name="annualFilter" value="5" checked>
                        <span class="filter-fs-checkmark"></span>
                    </label>
                    <div class="filter-fs-content">
                        <div class="d-flex justify-content-between">
                            <div class="">Actual</div>
                            <div class="">
                                <svg width="39" height="10" viewBox="0 0 39 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M37.5 5.00049L2.19434 5.00049" stroke="#4A7318" stroke-width="2.54779" stroke-linecap="round" />
                                    <path d="M24.0657 5.00017C24.0657 2.66885 22.1757 0.778841 19.8444 0.778841C17.513 0.778841 15.6231 2.66886 15.6231 5.00017C15.6231 7.3316 17.513 9.22149 19.8444 9.22149C22.1757 9.22149 24.0657 7.33161 24.0657 5.00017Z" fill="#4A7318" stroke="#4A7318" stroke-width="0.767514" />
                                </svg>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="">Forecasted</div>
                            <div class="">
                                <svg width="38" height="2" viewBox="0 0 38 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M36.5 1L1.19434 1" stroke="#4A7318" stroke-width="1.53503" stroke-linecap="round" stroke-dasharray="2.3 3.84" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="box-filter-fs">
                    <label class="filter-fs-checkbox text-white" style="background-color: #668177;">Non-Operating Expense
                        <input type="checkbox" id="nonOperatingExpenseCheckbox" name="annualFilter" value="6" checked>
                        <span class="filter-fs-checkmark"></span>
                    </label>
                    <div class="filter-fs-content">
                        <div class="d-flex justify-content-between">
                            <div class="">Actual</div>
                            <div class="">
                                <svg width="39" height="10" viewBox="0 0 39 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M37.5 5.00049L2.19434 5.00049" stroke="#668177" stroke-width="2.54779" stroke-linecap="round" />
                                    <path d="M24.0657 5.00017C24.0657 2.66885 22.1757 0.778841 19.8444 0.778841C17.513 0.778841 15.6231 2.66886 15.6231 5.00017C15.6231 7.3316 17.513 9.22149 19.8444 9.22149C22.1757 9.22149 24.0657 7.33161 24.0657 5.00017Z" fill="#668177" stroke="#668177" stroke-width="0.767514" />
                                </svg>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="">Forecasted</div>
                            <div class="">
                                <svg width="38" height="2" viewBox="0 0 38 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M36.5 1L1.19434 1" stroke="#668177" stroke-width="1.53503" stroke-linecap="round" stroke-dasharray="2.3 3.84" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="box-filter-fs">
                    <label class="filter-fs-checkbox text-white" style="background-color: #97825B;">Interest and Dividend Income
                        <input type="checkbox" id="interestDividendIncomeCheckbox" name="annualFilter" value="7" checked>
                        <span class="filter-fs-checkmark"></span>
                    </label>
                    <div class="filter-fs-content">
                        <div class="d-flex justify-content-between">
                            <div class="">Actual</div>
                            <div class="">
                                <svg width="39" height="10" viewBox="0 0 39 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M37.5 5.00049L2.19434 5.00049" stroke="#97825B" stroke-width="2.54779" stroke-linecap="round" />
                                    <path d="M24.0657 5.00017C24.0657 2.66885 22.1757 0.778841 19.8444 0.778841C17.513 0.778841 15.6231 2.66886 15.6231 5.00017C15.6231 7.3316 17.513 9.22149 19.8444 9.22149C22.1757 9.22149 24.0657 7.33161 24.0657 5.00017Z" fill="#97825B" stroke="#97825B" stroke-width="0.767514" />
                                </svg>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="">Forecasted</div>
                            <div class="">
                                <svg width="38" height="2" viewBox="0 0 38 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M36.5 1L1.19434 1" stroke="#97825B" stroke-width="1.53503" stroke-linecap="round" stroke-dasharray="2.3 3.84" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="box-filter-fs">
                    <label class="filter-fs-checkbox text-white" style="background-color: #474D6F;">Interest Expense
                        <input type="checkbox" id="interestExpenseCheckbox" name="annualFilter" value="8" checked> Interest Expense
                        <span class="filter-fs-checkmark"></span>
                    </label>
                    <div class="filter-fs-content">
                        <div class="d-flex justify-content-between">
                            <div class="">Actual</div>
                            <div class="">
                                <svg width="39" height="10" viewBox="0 0 39 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M37.5 5.00049L2.19434 5.00049" stroke="#474D6F" stroke-width="2.54779" stroke-linecap="round" />
                                    <path d="M24.0657 5.00017C24.0657 2.66885 22.1757 0.778841 19.8444 0.778841C17.513 0.778841 15.6231 2.66886 15.6231 5.00017C15.6231 7.3316 17.513 9.22149 19.8444 9.22149C22.1757 9.22149 24.0657 7.33161 24.0657 5.00017Z" fill="#474D6F" stroke="#474D6F" stroke-width="0.767514" />
                                </svg>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="">Forecasted</div>
                            <div class="">
                                <svg width="38" height="2" viewBox="0 0 38 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M36.5 1L1.19434 1" stroke="#474D6F" stroke-width="1.53503" stroke-linecap="round" stroke-dasharray="2.3 3.84" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-end">
            <button type="button" class="btn btn-primary btn-sm fs-14" onclick="getData();">
                <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.7468 2.30513C15.526 1.76334 15.1523 1.30619 14.7107 0.967568C14.2521 0.645875 13.7255 0.476562 13.165 0.476562H2.83796C2.29443 0.476562 1.7509 0.645875 1.2923 0.967568C0.833695 1.28926 0.477004 1.7464 0.23921 2.30513C0.0184008 2.84693 -0.0495405 3.45646 0.035386 4.03212C0.120313 4.62471 0.358107 5.16651 0.714798 5.62365L5.81039 11.8882V16.3411C5.81039 16.4596 5.84436 16.5781 5.89532 16.6967C5.94627 16.8152 6.01421 16.8998 6.11612 16.9845L9.02061 19.3718C9.13951 19.4734 9.29238 19.5242 9.46223 19.5242C9.64907 19.5242 9.83591 19.4395 9.97179 19.2871C10.1077 19.1348 10.1926 18.9316 10.1926 18.7284V15.3591H8.73186V17.1369L7.27113 15.9517V11.5834C7.27113 11.3803 7.20319 11.194 7.08429 11.0416L1.80186 4.57392C1.632 4.35381 1.51311 4.08291 1.47914 3.79508C1.44517 3.50725 1.47914 3.21942 1.58105 2.94852C1.68296 2.67762 1.8698 2.45751 2.09061 2.30513C2.31142 2.15275 2.5662 2.0681 2.83796 2.0681H13.165C13.4368 2.0681 13.6916 2.15275 13.9124 2.30513C14.1332 2.45751 14.32 2.69455 14.4219 2.94852C14.5239 3.21942 14.5748 3.50725 14.5239 3.79508C14.4729 4.08291 14.371 4.35381 14.2011 4.57392L8.93569 11.0416C8.7998 11.211 8.73186 11.4141 8.73186 11.6173V12.5147H10.1926V11.8882L15.2882 5.62365C15.6449 5.18344 15.8827 4.62471 15.9676 4.03212C16.0525 3.43953 15.9676 2.84693 15.7468 2.2882V2.30513Z" fill="white" />
                    <path d="M12.9358 13.476V11.1445H12.3124L11.4466 12.1604V13.476H9.14355V14.8749H11.4466V17.2398H12.9358V14.8749H15.2388V13.476H12.9358Z" fill="white" />
                </svg>
                Apply Filter
            </button>
        </div>
    </div>
</div>

<?php include __DIR__ . "/footer.php"; ?>
<script src="../plugins/apexcharts/dist/apexcharts.js"></script>
<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const branchId = urlParams.get('id');

    $(document).ready(function() {
        getYear();
        getBranchDetail();

        $(".menu-chart.menu-tab").click(function(e) {
            let year = parseInt($("#year").val());
            $('#labelLastYearPerformance').html((year - 1) + ' Performance');
            $('#labelPerformance').html((year) + ' Performance');
            $('#labelTarget').html((year) + ' Target');
            $('#labelForecast').html((year + 1) + ' Forecast');

            switch ($(this).data('id')) {
                case '#AnnualChart':
                    $(".filterCurrency").show();
                    $(".filterRate").show();
                    $("#filter-button").show();
                    $('#type').val('1');
                    getDataAnnualChart();
                    break;
                case '#ContentAnalysis':
                    $(".filterCurrency").show();
                    $(".filterRate").show();
                    $("#filter-button").hide();
                    $('#type').val('2');
                    getDataContentAnalysis();
                    break;
                case '#ComparisonAnalysis':
                    $(".filterCurrency").hide();
                    $(".filterRate").hide();
                    $("#filter-button").hide();
                    $('#type').val('3');
                    getDataComparisonAnalysis();
                    break;
            }

            $(".menu-chart.menu-tab").removeClass('active');
            $(this).addClass('active');
            $(".chart-tab-content .tab-content").removeClass('show');
            $($(this).data('id')).addClass('show');
        });
    });

    function getData() {
        let year = parseInt($("#year").val());
        $('#labelLastYearPerformance').html((year - 1) + ' Performance');
        $('#labelPerformance').html((year) + ' Performance');
        $('#labelTarget').html((year) + ' Target');
        $('#labelForecast').html((year + 1) + ' Forecast');

        let type = $('#type').val();
        switch (type) {
            case '1':
                getDataAnnualChart();
                break;
            case '2':
                getDataContentAnalysis();
                break;
            case '3':
                getDataComparisonAnalysis();
                break;
        }
    }

    function getYear() {
        $.ajax({
            url: 'ajax/GoldenRatio/getYear.php',
            type: 'POST',
            dataType: 'html',
            data: {
                branchId: branchId
            },
            success: function(data) {
                Swal.close();
                $('#year').html(data);
                getCurrency();
            },
            error: function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect. Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error. ' + jqXHR.responseText;
                }

                Swal.fire({
                    title: 'Warning !',
                    text: "There was a recording problem. Please contact the system administrator. " + msg,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }

    function getCurrency() {
        $.ajax({

            url: 'ajax/FinancialDashboard/getCurrency.php',
            type: 'POST',
            dataType: 'html',
            data: {},
            success: function(data) {
                Swal.close();
                $('#currencyId').html(data);
                getDataAnnualChart();
            },
            error: function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect. Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error. ' + jqXHR.responseText;
                }

                Swal.fire({
                    title: 'Warning !',
                    text: "There was a recording problem. Please contact the system administrator. " + msg,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }

    function getBranchDetail() {
        $.ajax({

            url: 'ajax/FinancialConfiguration/getBranchDetail.php',
            type: 'POST',
            dataType: 'html',
            data: {
                branchId: branchId
            },
            success: function(data) {
                Swal.close();
                $('#showBranchDetail').html(data);
            },
            error: function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect. Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error. ' + jqXHR.responseText;
                }

                Swal.fire({
                    title: 'Warning !',
                    text: "There was a recording problem. Please contact the system administrator. " + msg,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }

    function getDataAnnualChart() {

        let year = parseInt($("#year").val());
        let rate = $("#rate").val();
        let currencyId = $("#currencyId").val();

        let currencyUnit = '';
        if (rate == 1) {
            currencyUnit = '';
        } else if (rate == 1000) {
            currencyUnit = 'k';
        } else {
            currencyUnit = 'm';
        }

        $.ajax({

            url: "ajax/AllExpandedView/getDataAnnualChart.php",
            type: 'POST',
            dataType: 'json',
            data: {
                year: year,
                rate: rate,
                currencyId: currencyId,
                branchId: branchId,
            },
            success: function(response) {
                Swal.close();

                let array_data = response;
                let currencySymbol = response.currencySymbol;

                let checkboxes = document.querySelectorAll('input[name="annualFilter"]');
                let seriesData = [];
                let seriesBudgetData = [];
                let colorData = [];
                let colorBudgetData = [];

                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        let checkboxValue = parseInt(checkbox.value);
                        // switch (checkboxValue) {
                        //     case 1:
                        //         seriesData.push({
                        //             name: "Sales",
                        //             data: array_data[0]['data']
                        //         });
                        //         colorData.push("#2580D3");
                        //         seriesBudgetData.push({
                        //             name: "Sales Budget",
                        //             data: array_data[0]['budget'],
                        //         });
                        //         colorBudgetData.push("#2580D3");
                        //         break;
                        //     case 2:
                        //         seriesData.push({
                        //             name: "Variable Expense",
                        //             data: array_data[1]['data']
                        //         });
                        //         colorData.push("#FFE100");
                        //         seriesBudgetData.push({
                        //             name: "Variable Expense Budget",
                        //             data: array_data[1]['budget']
                        //         });
                        //         colorBudgetData.push("#FFE100");
                        //         break;
                        //     case 3:
                        //         seriesData.push({
                        //             name: "Labor Cost",
                        //             data: array_data[2]['data']
                        //         });
                        //         colorData.push("#FF0000");
                        //         break;
                        //     case 4:
                        //         seriesData.push({
                        //             name: "Fixed Expense (Other)",
                        //             data: array_data[3]['data']
                        //         });
                        //         colorData.push("#9687A0");
                        //         break;
                        //     case 5:
                        //         seriesData.push({
                        //             name: "Non-Operating Income",
                        //             data: array_data[4]['data']
                        //         });
                        //         colorData.push("#4A7318");
                        //         break;
                        //     case 6:
                        //         seriesData.push({
                        //             name: "Non-Operating Expense",
                        //             data: array_data[5]['data'],
                        //         });
                        //         colorData.push("#668177");
                        //         break;
                        //     case 7:
                        //         seriesData.push({
                        //             name: "Interest and Devident Income",
                        //             data: array_data[6]['data']
                        //         });
                        //         colorData.push("#97825B");
                        //         break;
                        //     case 8:
                        //         seriesData.push({
                        //             name: "Variable Expense",
                        //             data: array_data[1]['data']
                        //         });
                        //         colorData.push("#474D6F");
                        //         break;
                        // }
                        switch (checkboxValue) {
                            case 1:
                                seriesData.push({
                                    name: "Sales",
                                    data: array_data[0]['data']
                                });
                                colorData.push("#2580D3");
                                seriesBudgetData.push({
                                    name: "Sales Budget",
                                    data: array_data[0]['budget'],
                                });
                                colorBudgetData.push("#2580D3");
                                break;
                            case 2:
                                seriesData.push({
                                    name: "Variable Expense",
                                    data: array_data[1]['data']
                                });
                                colorData.push("#FFE100");
                                seriesBudgetData.push({
                                    name: "Variable Expense Budget",
                                    data: array_data[1]['budget']
                                });
                                colorBudgetData.push("#FFE100");
                                break;
                            case 3:
                                seriesData.push({
                                    name: "Labor Cost",
                                    data: array_data[2]['data']
                                });
                                colorData.push("#FF0000");
                                seriesBudgetData.push({
                                    name: "Labor Cost Budget",
                                    data: array_data[2]['budget']
                                });
                                colorBudgetData.push("#FF0000");
                                break;
                            case 4:
                                seriesData.push({
                                    name: "Fixed Expense (Other)",
                                    data: array_data[3]['data']
                                });
                                colorData.push("#9687A0");
                                seriesBudgetData.push({
                                    name: "Fixed Expense (Other) Budget",
                                    data: array_data[3]['budget']
                                });
                                colorBudgetData.push("#9687A0");
                                break;
                            case 5:
                                seriesData.push({
                                    name: "Non-Operating Income",
                                    data: array_data[4]['data']
                                });
                                colorData.push("#4A7318");
                                seriesBudgetData.push({
                                    name: "Non-Operating Income Budget",
                                    data: array_data[4]['budget']
                                });
                                colorBudgetData.push("#4A7318");
                                break;
                            case 6:
                                seriesData.push({
                                    name: "Non-Operating Expense",
                                    data: array_data[5]['data'],
                                });
                                colorData.push("#668177");
                                seriesBudgetData.push({
                                    name: "Non-Operating Expense Budget",
                                    data: array_data[5]['budget']
                                });
                                colorBudgetData.push("#668177");
                                break;
                            case 7:
                                seriesData.push({
                                    name: "Interest and Devident Income",
                                    data: array_data[6]['data']
                                });
                                colorData.push("#97825B");
                                seriesBudgetData.push({
                                    name: "Interest and Devident Income Budget",
                                    data: array_data[6]['budget']
                                });
                                colorBudgetData.push("#97825B");
                                break;
                            case 8:
                                seriesData.push({
                                    name: "Interest Expense",
                                    data: array_data[7]['data']
                                });
                                colorData.push("#474D6F");
                                seriesBudgetData.push({
                                    name: "Interest Expense Budget",
                                    data: array_data[7]['budget']
                                });
                                colorBudgetData.push("#474D6F");
                                break;
                        }
                    }
                });

                let combinedSeriesData = seriesData.concat(seriesBudgetData);
                let combinedColorData = colorData.concat(colorBudgetData);

                let options = {
                    chart: {
                        type: 'line',
                        height: 582,
                        zoom: {
                            enabled: false
                        }
                    },
                    series: combinedSeriesData,
                    stroke: {
                        width: [3, 3], // ความหนาของเส้นแต่ละเส้น
                        dashArray: [0, 5], // เส้นปกติ (0) และเส้นปะ (5)
                        curve: "smooth"
                    },
                    markers: {
                        size: [5,
                            0
                        ] // กำหนดขนาดจุด
                    },
                    colors: combinedColorData,
                    xaxis: {
                        type: 'category',
                        labels: {
                            rotate: -45, // Rotate labels to avoid overlap
                        },
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return currencySymbol + value.toFixed(1) + currencyUnit; // เพิ่มหน่วยเงิน
                            }
                        },
                        forceNiceScale: true,
                    },
                    annotations: {
                        xaxis: [{
                                x: array_data[0]['data'][0]['x'], // Start of 2024
                                x2: array_data[0]['data'][12]['x'], // End of 2024
                                fillColor: '#e3f2fd', // Light blue background
                                opacity: 0.3, // Transparency
                                label: {
                                    text: (year - 1),
                                    textAnchor: 'middle',
                                    position: 'top',
                                    orientation: 'horizontal',
                                    offsetX: 20,
                                    offsetY: 0,
                                    style: {
                                        color: '#000',
                                        background: '#e3f2fd',
                                    },
                                },
                            },
                            {
                                x: array_data[0]['data'][12]['x'], // Start of 2024
                                x2: array_data[0]['data'][24]['x'], // End of 2024
                                fillColor: '#ffebee', // Light red background
                                opacity: 0.3, // Transparency
                                label: {
                                    text: year,
                                    textAnchor: 'middle',
                                    position: 'top',
                                    orientation: 'horizontal',
                                    offsetX: 20,
                                    offsetY: 0,
                                    style: {
                                        color: '#000',
                                        background: '#ffebee',
                                    },
                                },
                            },
                            {
                                x: array_data[0]['data'][24]['x'], // Start of 2024
                                x2: array_data[0]['data'][35]['x'], // End of 2024
                                fillColor: '#e8f5e9', // Light green background
                                opacity: 0.3, // Transparency
                                label: {
                                    text: (year + 1),
                                    textAnchor: 'middle',
                                    position: 'top',
                                    orientation: 'horizontal',
                                    offsetX: 20,
                                    offsetY: 0,
                                    style: {
                                        color: '#000',
                                        background: '#e8f5e9',
                                    },
                                },
                            },
                        ],
                    },
                    tooltip: {
                        y: {
                            formatter: function(value) {
                                return currencySymbol + value.toFixed(2) + currencyUnit; // เพิ่มหน่วยเงิน
                            }
                        }
                    },
                    legend: {
                        show: false
                    },
                    grid: {
                        show: true, // Set to false to completely remove the grid
                        borderColor: '#e0e0e0', // Color of the grid lines
                        xaxis: {
                            lines: {
                                show: true, // Show or hide vertical grid lines
                                dashArray: 4,
                            },
                        },
                        yaxis: {
                            lines: {
                                show: true, // Show or hide horizontal grid lines
                                dashArray: 0,
                            },
                        },
                    },
                };

                $('#chart1').html('');

                var chart = new ApexCharts(document.querySelector("#chart1"), options);
                chart.render();

                $('#filter-fs-bottom').removeClass('active');
            },
            error: function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect. Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error. ' + jqXHR.responseText;
                }

                Swal.fire({
                    title: 'Warning !',
                    text: "There was a recording problem. Please contact the system administrator. " + msg,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });

        // let currentDate = new Date(2024, 0); // Start from January 2024
        // let normalLineData = [];
        // let dashedLineData = [];

        // let monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        // let endDate = new Date(2026, 11); // End at December 2026

        // while (currentDate <= endDate) {
        //     let year = currentDate.getFullYear();
        //     let month = currentDate.getMonth(); // Months are zero-indexed

        //     normalLineData.push({
        //         x: `${monthNames[month]}${year.toString().slice(-2)}`, // Format as Jan24, Feb24, etc.
        //         y: Math.floor(Math.random() * 100) + 1, // Random value for solid line
        //     });

        //     dashedLineData.push({
        //         x: `${monthNames[month]}${year.toString().slice(-2)}`, // Format as Jan24, Feb24, etc.
        //         y: Math.floor(Math.random() * 100) + 1, // Random value for dashed line
        //     });

        //     currentDate.setMonth(currentDate.getMonth() + 1); // Increment to the next month
        // }

        // Chart configuration
        // let options = {
        //     chart: {
        //         type: 'line',
        //         height: 582,
        //         zoom: {
        //             enabled: false
        //         }
        //     },
        //     series: [{
        //             name: 'Normal Line',
        //             data: normalLineData, // Data for solid line
        //         },
        //         {
        //             name: 'Dashed Line',
        //             data: dashedLineData, // Data for dashed line
        //         },
        //     ],
        //     stroke: {
        //         width: [3, 3], // ความหนาของเส้นแต่ละเส้น
        //         dashArray: [0, 5], // เส้นปกติ (0) และเส้นปะ (5)
        //         curve: "smooth"
        //     },
        //     markers: {
        //         size: [5,
        //             0
        //         ] // กำหนดขนาดจุด
        //     },
        //     colors: ["#00CC8B", "#00CC8B"],
        //     xaxis: {
        //         type: 'category',
        //         labels: {
        //             rotate: -45, // Rotate labels to avoid overlap
        //         },
        //     },
        //     yaxis: {
        //         labels: {
        //             formatter: function(value) {
        //                 return "฿" + value.toFixed(1) + "m"; // เพิ่มหน่วยเงิน
        //             }
        //         }
        //     },
        //     annotations: {
        //         xaxis: [{
        //                 x: 'Jan24', // Start of 2024
        //                 x2: 'Jan25', // End of 2024
        //                 fillColor: '#e3f2fd', // Light blue background
        //                 opacity: 0.3, // Transparency
        //                 label: {
        //                     text: '2024',
        //                     textAnchor: 'middle',
        //                     position: 'top',
        //                     orientation: 'horizontal',
        //                     offsetX: 20,
        //                     offsetY: 0,
        //                     style: {
        //                         color: '#000',
        //                         background: '#e3f2fd',
        //                     },
        //                 },
        //             },
        //             {
        //                 x: 'Jan25', // Start of 2025
        //                 x2: 'Jan26', // End of 2025
        //                 fillColor: '#ffebee', // Light red background
        //                 opacity: 0.3, // Transparency
        //                 label: {
        //                     text: '2025',
        //                     textAnchor: 'middle',
        //                     position: 'top',
        //                     orientation: 'horizontal',
        //                     offsetX: 20,
        //                     offsetY: 0,
        //                     style: {
        //                         color: '#000',
        //                         background: '#ffebee',
        //                     },
        //                 },
        //             },
        //             {
        //                 x: 'Jan26', // Start of 2026
        //                 x2: 'Dec26', // End of 2026
        //                 fillColor: '#e8f5e9', // Light green background
        //                 opacity: 0.3, // Transparency
        //                 label: {
        //                     text: '2026',
        //                     textAnchor: 'middle',
        //                     position: 'top',
        //                     orientation: 'horizontal',
        //                     offsetX: 20,
        //                     offsetY: 0,
        //                     style: {
        //                         color: '#000',
        //                         background: '#e8f5e9',
        //                     },
        //                 },
        //             },
        //         ],
        //     },
        //     tooltip: {
        //         y: {
        //             formatter: function(value) {
        //                 return "฿" + value.toFixed(2) + "m"; // ปรับฟอร์แมตให้แสดงค่าแบบละเอียด
        //             }
        //         }
        //     },
        //     legend: {
        //         show: false
        //     },
        //     grid: {
        //         show: true, // Set to false to completely remove the grid
        //         borderColor: '#e0e0e0', // Color of the grid lines
        //         xaxis: {
        //             lines: {
        //                 show: true, // Show or hide vertical grid lines
        //                 dashArray: 4,
        //             },
        //         },
        //         yaxis: {
        //             lines: {
        //                 show: true, // Show or hide horizontal grid lines
        //                 dashArray: 0,
        //             },
        //         },
        //     },
        // };


        // var chart = new ApexCharts(document.querySelector("#chart1"), options);
        // chart.render();
    }

    function getDataContentAnalysis() {
        let year = parseInt($("#year").val());
        let rate = $("#rate").val();
        let currencyId = $("#currencyId").val();
        var compare = parseInt($("input[name='compare']:checked").val());

        let currencyUnit = '';
        if (rate == 1) {
            currencyUnit = '';
        } else if (rate == 1000) {
            currencyUnit = 'k';
        } else {
            currencyUnit = 'm';
        }

        $.ajax({

            url: "ajax/AllExpandedView/getDataContentAnalysis.php",
            type: 'POST',
            dataType: 'json',
            data: {
                year: year,
                rate: rate,
                currencyId: currencyId,
                branchId: branchId,
                compare: compare
            },
            success: function(response) {
                Swal.close();
                // console.log(response);
                let series = [];

                if ($('#LastYearPerformance').is(':checked')) {
                    series.push({
                        name: (year - 1) + ' Performance',
                        type: "area",
                        data: response.last_actual_amount
                    });
                } else {
                    series.push({
                        name: (year - 1) + ' Performance',
                        type: "area",
                        data: [null],
                    });
                }

                if ($('#Performance').is(':checked')) {
                    series.push({
                        name: year + ' Performance',
                        type: "column",
                        data: response.actual_amount
                    });
                } else {
                    series.push({
                        name: year + ' Performance',
                        type: "column",
                        data: [null],
                    });
                }

                if ($('#Target').is(':checked')) {
                    series.push({
                        name: year + ' Target',
                        type: "column",
                        data: response.target_amount
                    });
                } else {
                    series.push({
                        name: year + ' Target',
                        type: "column",
                        data: [null],
                    });
                }

                if ($('#Forecast').is(':checked')) {
                    series.push({
                        name: (year + 1) + ' Forecast',
                        type: "line",
                        data: response.next_target_amount
                    });
                } else {
                    series.push({
                        name: (year + 1) + ' Forecast',
                        type: "line",
                        data: [null],
                    });
                }

                var options2 = {
                    series: series,
                    chart: {
                        height: 600,
                        type: "line",
                        // stacked: false,
                        zoom: {
                            enabled: false
                        }
                    },
                    stroke: {
                        width: [3, 0, 0, 3], // ทำให้ Bar ไม่มีเส้นขอบ และเส้นอื่นๆ คมชัด
                        dashArray: [0, 0, 0, 5], // กำหนดให้เส้นเป้าหมายเป็นเส้นปะ
                        curve: "smooth"
                    },
                    markers: {
                        size: [5, 0, 0, 5] // เพิ่ม Marker เฉพาะเส้นปะและเส้นน้ำเงิน
                    },
                    fill: {
                        opacity: [0.2, 1, 0.5, 1] // ทำให้ Bar ไม่บังเส้นน้ำเงินที่อยู่ข้างหน้า
                    },
                    colors: ["#1976D2", "#2E7D32", "#81C784", "#D32F2F"], // เปลี่ยนสีให้สอดคล้องกับรูป
                    xaxis: {
                        categories: response.monthName
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return response.currencySymbol + value.toFixed(1) + currencyUnit;
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        shared: false,
                        y: {
                            formatter: function(value) {
                                return response.currencySymbol + value.toFixed(2) + currencyUnit;
                            }
                        }
                    },
                    legend: {
                        show: false
                    }
                };

                $('#chart2').html('');

                var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
                chart2.render();
            },
            error: function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect. Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error. ' + jqXHR.responseText;
                }

                Swal.fire({
                    title: 'Warning !',
                    text: "There was a recording problem. Please contact the system administrator. " + msg,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });

        // var options2 = {
        //     series: [{
        //             name: "2024 Performance",
        //             type: "area",
        //             data: [2.0, 1.9, 2.1, 2.6, 2.3, 3.1, 3.4, 3.3, 3.2, 3.1, 3.0, 2.9]
        //         },
        //         {
        //             name: "2024 Target",
        //             type: "column",
        //             data: [2.8, 3.1, 3.6, 4.0, 2.7, 3.8, 4.5, 3.2, 3.0, 3.9, 4.1, 3.5]
        //         },
        //         {
        //             name: "2023 Performance",
        //             type: "column",
        //             data: [2.5, 2.9, 3.3, 3.7, 2.4, 3.5, 4.2, 3.0, 2.8, 3.6, 3.8, 3.2]
        //         },
        //         {
        //             name: "2025 Forecast",
        //             type: "line",
        //             data: [3.0, 3.2, 3.4, 3.8, 3.6, 4.0, 4.2, 4.1, 4.0, 4.1, 4.3, 4.5]
        //         }

        //     ],
        //     chart: {
        //         height: 600,
        //         type: "line",
        //         // stacked: false,
        //         zoom: {
        //             enabled: false
        //         }
        //     },
        //     stroke: {
        //         width: [3, 0, 0, 3], // ทำให้ Bar ไม่มีเส้นขอบ และเส้นอื่นๆ คมชัด
        //         dashArray: [0, 0, 0, 5], // กำหนดให้เส้นเป้าหมายเป็นเส้นปะ
        //         curve: "smooth"
        //     },
        //     markers: {
        //         size: [5, 0, 0, 5] // เพิ่ม Marker เฉพาะเส้นปะและเส้นน้ำเงิน
        //     },
        //     fill: {
        //         opacity: [0.2, 1, 0.5, 1] // ทำให้ Bar ไม่บังเส้นน้ำเงินที่อยู่ข้างหน้า
        //     },
        //     colors: ["#1976D2", "#2E7D32", "#81C784", "#D32F2F"], // เปลี่ยนสีให้สอดคล้องกับรูป
        //     xaxis: {
        //         categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
        //     },
        //     yaxis: {
        //         labels: {
        //             formatter: function(value) {
        //                 return "฿" + value.toFixed(1) + "m";
        //             }
        //         }
        //     },
        //     tooltip: {
        //         enabled: true,
        //         shared: false,
        //         y: {
        //             formatter: function(value) {
        //                 return "฿" + value.toLocaleString();
        //             }
        //         }
        //     },
        //     legend: {
        //         show: false
        //     }
        // };

        // var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
        // chart2.render();
    }

    function getDataComparisonAnalysis() {
        let year = $("#year").val();
        $.ajax({

            url: "ajax/ComparisonAnalysis/getData.php",
            type: 'POST',
            dataType: 'html',
            data: {
                year: year,
                branchId: branchId,
            },
            success: function(data) {
                Swal.close();
                $('#ComparisonAnalysis').html(data);
            },
            error: function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect. Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error. ' + jqXHR.responseText;
                }
                Swal.fire({
                    title: 'Warning !',
                    text: "There was a recording problem. Please contact the system administrator. " + msg,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });

    }
</script>