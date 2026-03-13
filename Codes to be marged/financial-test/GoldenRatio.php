<?php include __DIR__ . "/header.php"; ?>
<div class="wrapper-content">
    <h1 class="page-title">
        <img src="../asset/icon/coins.svg" alt="">
        Financial Planning
    </h1>

    <div class="card-nav-tab justify-content-between">
        <ul class="card-tab ">
            <li onclick="window.location.href='FinancialProfitLossPortal?id=<?php echo $_GET['id']; ?>';">
                <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                    <path d="M2.64966 19.999C2.52414 19.9661 2.39696 19.9374 2.27311 19.8998C0.819688 19.4612 0.281527 17.7399 1.25233 16.6356C1.30065 16.5808 1.35063 16.5271 1.40395 16.4687C0.538667 15.4823 0.530892 14.4949 1.39617 13.5044C0.54311 12.3224 0.542555 11.5342 1.40506 10.5557C1.38895 10.5327 1.37396 10.5046 1.3523 10.4816C0.716388 9.8103 0.580876 9.04718 0.960754 8.23503C1.34341 7.41662 2.05318 7.01915 3.00344 7.00767C3.53715 7.00141 4.07087 7.00663 4.60459 7.00663C4.67901 7.00663 4.75399 7.00663 4.84063 7.00663V5.3938C4.62292 5.3938 4.41021 5.39276 4.1975 5.3938C3.69488 5.39693 3.30556 5.2055 3.08285 4.7783C2.86015 4.35058 2.93846 3.94789 3.25058 3.57598C4.12141 2.53849 4.98669 1.49735 5.85752 0.460389C6.37291 -0.153028 7.22875 -0.15355 7.74359 0.459345C8.62331 1.50674 9.49747 2.55779 10.3772 3.60519C10.6832 3.9698 10.7315 4.36257 10.5205 4.7736C10.3083 5.18672 9.94011 5.38806 9.45193 5.3938C9.23089 5.39641 9.00985 5.3938 8.77215 5.3938V6.99724C8.8399 7.00037 8.91266 7.00663 8.98597 7.00663C9.52635 7.00767 10.0673 7.00193 10.6077 7.00819C11.6662 7.02071 12.4743 7.60179 12.7703 8.55425C12.7814 8.59076 12.7959 8.62676 12.8114 8.67005C13.6212 8.75299 14.3948 8.95224 15.0979 9.33615C17.1761 10.4701 18.2858 12.1659 18.2491 14.4302C18.2036 17.2673 16.0271 19.5305 13.0397 19.9499C12.9314 19.9651 12.8231 19.9833 12.7148 20H2.64966V19.999ZM17.0106 14.3139C17.0123 11.8091 14.8569 9.81708 12.1433 9.81499C9.59522 9.8129 7.42425 11.8613 7.42202 14.2685C7.4198 16.7853 9.54079 18.8258 12.1594 18.8269C14.8624 18.8279 17.009 16.8307 17.0106 14.3144V14.3139ZM11.4829 8.66588C11.2669 8.31118 10.9509 8.18078 10.5555 8.18078C8.04738 8.1813 5.53929 8.17973 3.0312 8.18443C2.8757 8.18443 2.7102 8.21155 2.56746 8.26736C2.15704 8.4275 1.941 8.8474 2.03097 9.26417C2.11816 9.66946 2.50748 9.96156 2.98289 9.96208C4.72178 9.96521 6.46122 9.96469 8.20011 9.95948C8.29286 9.95948 8.4006 9.91618 8.47558 9.86193C9.10871 9.405 9.80071 9.05917 10.5727 8.86305C10.8643 8.78898 11.1619 8.73525 11.4829 8.6664V8.66588ZM6.80111 1.23081C5.96582 2.23022 5.14831 3.20824 4.30246 4.22017C4.54905 4.22017 4.74732 4.21756 4.94559 4.22017C5.58817 4.22956 6.08801 4.69328 6.09967 5.29782C6.10689 5.66817 6.10133 6.03904 6.10133 6.40938C6.10133 6.60238 6.10133 6.79537 6.10133 6.99098H7.50366C7.50366 6.90596 7.50366 6.83606 7.50366 6.76564C7.50366 6.29097 7.49922 5.81631 7.50478 5.34164C7.51255 4.67189 7.99962 4.22278 8.71272 4.21913C8.89489 4.21809 9.0765 4.21913 9.29976 4.21913C8.45336 3.20668 7.63807 2.23179 6.80056 1.22977L6.80111 1.23081ZM8.52167 18.8149C7.87132 18.3235 7.35871 17.7753 6.96217 17.1317C6.93329 17.0842 6.84054 17.0461 6.77779 17.0461C5.51041 17.0414 4.24359 17.0388 2.97622 17.0451C2.55747 17.0471 2.24479 17.2349 2.0804 17.6016C1.8177 18.1879 2.27811 18.8222 2.97344 18.8243C4.78065 18.83 6.58785 18.8264 8.3956 18.8258C8.4217 18.8258 8.44781 18.8217 8.52167 18.8149ZM7.19987 11.1368C5.76644 11.1368 4.37411 11.1347 2.98122 11.1378C2.43362 11.1388 2.02153 11.516 2.01264 12.012C2.00431 12.5081 2.40141 12.9092 2.94901 12.9155C4.03699 12.9275 5.12498 12.9175 6.21297 12.9222C6.33904 12.9228 6.37291 12.8696 6.40346 12.7684C6.5623 12.24 6.8 11.7434 7.1149 11.2797C7.13934 11.2432 7.15989 11.2046 7.19932 11.1368H7.19987ZM6.12855 14.1037C6.14465 14.1115 6.13299 14.1011 6.12133 14.1011C5.02668 14.1011 3.93203 14.088 2.83793 14.1073C2.37863 14.1152 2.02153 14.5199 2.01375 14.9654C2.00542 15.4109 2.34753 15.8407 2.80405 15.85C3.99423 15.8746 5.18496 15.8584 6.34681 15.8584C6.27461 15.2752 6.20241 14.6983 6.12855 14.1042V14.1037Z" fill="#30313D" />
                    <path d="M10.2381 14.1482H11.0178L9.81543 11.6602H11.0745L12.343 14.4482L13.6114 11.6602H14.8705L13.6681 14.1482H14.4478V14.8629H13.3204L12.935 15.6568H14.4473V16.3448H12.935V17.3593H11.7515V16.3448H10.2392V15.6568H11.7515L11.366 14.8629H10.2386L10.2381 14.1482Z" fill="#30313D" />
                </svg>
                PL Forcast
            </li>
            <li class="active"><img src="../images/icons/Dark/48px/Golden-Ratio.png" style="width:18px"> Golden Ratio</li>
            <li onclick="window.location.href='ForecastAccounts?id=<?php echo $_GET['id']; ?>';"><img src="../images/icons/Dark/48px/Designation-1.png" style="width:18px"> Forecast Accounts</li>
        </ul>
        <ul class="card-tab" id="showBranchDetail">

        </ul>

    </div>
    <div class="mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-4" style="min-height: 78vh;">
                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="me-2 fs-20" style="cursor: pointer;" onclick="window.location.href = 'FinancialConfiguration?id=<?php echo $_GET['id']; ?>';"><a class="text-primary"><i class="bi bi-caret-left-fill"></i>Back to Portal</a></div>
                                <div class="fs-20 me-2">Golden Ratio</div>
                                <!-- <a href="#" class="btn btn-sm btn-primary fs-13 me-2">
                                    Setup Ratio
                                    <svg class="ms-2" width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 3.85714H10.4286M10.4286 3.85714C10.4286 5.15896 11.4839 6.21429 12.7857 6.21429C14.0876 6.21429 15.1429 5.15895 15.1429 3.85714C15.1429 2.55533 14.0876 1.5 12.7857 1.5C11.4839 1.5 10.4286 2.55533 10.4286 3.85714ZM5.71429 10.1429H15.1429M5.71429 10.1429C5.71429 11.4447 4.65895 12.5 3.35714 12.5C2.05533 12.5 1 11.4447 1 10.1429C1 8.84101 2.05533 7.78571 3.35714 7.78571C4.65895 7.78571 5.71429 8.84101 5.71429 10.1429Z" stroke="white" stroke-width="1.57143" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a> -->
                            </div>
                        </div>

                        <div class="d-table w-100">
                            <div class="p-1 d-table-cell align-content-center" style="width: 506px;">
                                <div class="bar-light  mb-3" style="width: 498px;">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                                                <path d="M11.3333 7.19267C8.76067 7.19267 6.66667 9.286 6.66667 11.8593C6.66667 14.418 8.76067 16.5 11.3333 16.5C13.906 16.5 16 14.4067 16 11.8333C16 9.27467 13.906 7.19267 11.3333 7.19267ZM11.3333 15.1667C9.49533 15.1667 8 13.6827 8 11.8593C8 10.0213 9.49533 8.526 11.3333 8.526C13.1713 8.526 14.6667 10.01 14.6667 11.8333C14.6667 13.6713 13.1713 15.1667 11.3333 15.1667ZM12.4713 12.0287C12.732 12.2893 12.732 12.7107 12.4713 12.9713C12.3413 13.1013 12.1707 13.1667 12 13.1667C11.8293 13.1667 11.6587 13.1013 11.5287 12.9713L10.862 12.3047C10.7367 12.1793 10.6667 12.01 10.6667 11.8333V10.5C10.6667 10.132 10.9647 9.83333 11.3333 9.83333C11.702 9.83333 12 10.132 12 10.5V11.5573L12.4713 12.0287ZM16 5.16667V6.5C16 6.868 15.702 7.16667 15.3333 7.16667C14.9647 7.16667 14.6667 6.868 14.6667 6.5V5.16667C14.6667 4.064 13.7693 3.16667 12.6667 3.16667H3.33333C2.23067 3.16667 1.33333 4.064 1.33333 5.16667V5.83333H7.33333C7.70133 5.83333 8 6.132 8 6.5C8 6.868 7.70133 7.16667 7.33333 7.16667H1.33333V13.1667C1.33333 14.2693 2.23067 15.1667 3.33333 15.1667H6C6.368 15.1667 6.66667 15.4653 6.66667 15.8333C6.66667 16.2013 6.368 16.5 6 16.5H3.33333C1.49533 16.5 0 15.0047 0 13.1667V5.16667C0 3.32867 1.49533 1.83333 3.33333 1.83333H4V1.16667C4 0.798667 4.29867 0.5 4.66667 0.5C5.03467 0.5 5.33333 0.798667 5.33333 1.16667V1.83333H10.6667V1.16667C10.6667 0.798667 10.9647 0.5 11.3333 0.5C11.702 0.5 12 0.798667 12 1.16667V1.83333H12.6667C14.5047 1.83333 16 3.32867 16 5.16667Z" fill="#3C3D48" />
                                            </svg>
                                            <div class="me-2">Current Financial Year</div>
                                        </div>
                                        <div class="d-flex">

                                            <select name="year" id="year" class="select-year me-2" onchange="getData();">
                                            </select>
                                            <input type="hidden" name="type" id="type" value="1">
                                            <!-- <button class="btn-refresh">
                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M7.09648 1.0835C8.55331 1.08828 9.94769 1.67338 10.9688 2.70845H9.27135C8.97106 2.70845 8.72764 2.95094 8.72764 3.25008C8.72764 3.54923 8.97106 3.79172 9.27135 3.79172H11.524C12.0815 3.79142 12.5333 3.34126 12.5337 2.78588V0.541841C12.5337 0.2427 12.2902 0.000202792 11.9899 0.000202792C11.6897 0.000202792 11.4462 0.2427 11.4462 0.541841V1.66739C8.77285 -0.731097 4.65385 -0.516503 2.24619 2.1467C1.30397 3.18895 0.726058 4.50725 0.599057 5.90414C0.571123 6.2041 0.792578 6.4698 1.09368 6.49763C1.10999 6.49913 1.12638 6.49991 1.14279 6.49997C1.41838 6.50347 1.65136 6.29743 1.68054 6.02439C1.93138 3.2299 4.28011 1.08719 7.09648 1.0835Z" fill="#2580D3" />
                                                    <path d="M13.0506 6.50004C12.775 6.49654 12.542 6.70258 12.5129 6.97562C12.2534 9.95165 9.62128 12.1547 6.63384 11.8962C5.34128 11.7843 4.13165 11.2151 3.22399 10.2916H4.92149C5.22177 10.2916 5.4652 10.0491 5.4652 9.74993C5.4652 9.45078 5.22177 9.20829 4.92149 9.20829H2.66886C2.11152 9.20798 1.65949 9.65784 1.65918 10.213C1.65918 10.2134 1.65918 10.2137 1.65918 10.2141V12.4582C1.65918 12.7573 1.9026 12.9998 2.20289 12.9998C2.50317 12.9998 2.7466 12.7573 2.7466 12.4582V11.3326C5.41998 13.7311 9.53896 13.5165 11.9466 10.8533C12.8889 9.81106 13.4668 8.49275 13.5938 7.09584C13.6217 6.79588 13.4003 6.53018 13.0992 6.50235C13.083 6.50088 13.0668 6.50009 13.0506 6.50004Z" fill="#2580D3" />
                                                </svg>
                                            </button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-1 d-table-cell align-content-center">
                                <div class="bar-light mb-3">
                                    <div class="d-flex justify-content-between">

                                        <div class="">

                                            <div class="filter-content" id="filter">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2">Currency</div>
                                                    <select name="currencyId" id="currencyId" class="select-year px-2 me-2 text-primary" style="width:auto;" onchange="getData();">
                                                    </select>
                                                    <div class="me-2">Round Up</div>
                                                    <select name="rate" id="rate" class="select-year px-2 me-2" style="width:auto;" onchange="getData();">
                                                        <option value="1">Normal</option>
                                                        <option value="2">Thousands</option>
                                                        <option value="3">Millions</option>
                                                        <option value="4">Billions</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="chart-tab-menu">
                                            <button class="menu-chart" type="button">
                                                <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.5723 4.03465C12.6679 2.60031 10.6107 0.193848 7 0.193848C3.38934 0.193848 1.3321 2.60031 0.427685 4.03465C0.148096 4.47501 0 4.9825 0 5.50022C0 6.01794 0.148096 6.52543 0.427685 6.96579C1.3321 8.40013 3.38934 10.8066 7 10.8066C10.6107 10.8066 12.6679 8.40013 13.5723 6.96579C13.8519 6.52543 14 6.01794 14 5.50022C14 4.9825 13.8519 4.47501 13.5723 4.03465ZM12.5781 6.37127C11.8014 7.60119 10.0433 9.67093 7 9.67093C3.95671 9.67093 2.19861 7.60119 1.4219 6.37127C1.25579 6.10953 1.16781 5.80791 1.16781 5.50022C1.16781 5.19253 1.25579 4.89091 1.4219 4.62917C2.19861 3.39925 3.95671 1.32951 7 1.32951C10.0433 1.32951 11.8014 3.39698 12.5781 4.62917C12.7442 4.89091 12.8322 5.19253 12.8322 5.50022C12.8322 5.80791 12.7442 6.10953 12.5781 6.37127Z" fill="#3C3D48" />
                                                    <path d="M7.00543 2.6626C6.42878 2.6626 5.86508 2.82911 5.38562 3.14108C4.90615 3.45305 4.53245 3.89647 4.31178 4.41525C4.09111 4.93404 4.03337 5.5049 4.14587 6.05564C4.25837 6.60638 4.53605 7.11227 4.9438 7.50933C5.35155 7.90639 5.87106 8.1768 6.43663 8.28635C7.0022 8.39589 7.58842 8.33967 8.12118 8.12478C8.65393 7.90989 9.10928 7.54599 9.42965 7.0791C9.75002 6.6122 9.92102 6.06328 9.92102 5.50175C9.92009 4.74904 9.61262 4.02741 9.06604 3.49516C8.51946 2.96291 7.77841 2.6635 7.00543 2.6626ZM7.00543 7.20524C6.65944 7.20524 6.32122 7.10533 6.03354 6.91815C5.74586 6.73097 5.52165 6.46492 5.38924 6.15365C5.25684 5.84237 5.22219 5.49986 5.28969 5.16941C5.35719 4.83897 5.5238 4.53544 5.76845 4.2972C6.0131 4.05896 6.32481 3.89672 6.66415 3.83099C7.00349 3.76526 7.35523 3.799 7.67488 3.92793C7.99453 4.05686 8.26774 4.2752 8.45996 4.55534C8.65219 4.83548 8.75478 5.16483 8.75478 5.50175C8.75478 5.95354 8.57048 6.38683 8.24241 6.7063C7.91434 7.02576 7.46939 7.20524 7.00543 7.20524Z" fill="#3C3D48" />
                                                </svg>
                                            </button>
                                            <button class="menu-chart menu-tab active" type="button" data-id="#IdealGoldenRatio">Ideal Golden Ratio</button>
                                            <button class="menu-chart menu-tab" type="button" data-id="#LastYearPerformance" data-filter="#filter">Last Year Performance</button>
                                            <button class="menu-chart menu-tab" type="button" data-id="#CurrentYearTarget" data-filter="#filter">Current Year Target</button>
                                            <button class="menu-chart menu-tab" type="button" data-id="#NextYearTarget" data-filter="#filter">Next Year Target</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="chart-tab-content">
                            <div class="tab-content show" id="IdealGoldenRatio">
                                1
                            </div>
                            <div class="tab-content" id="LastYearPerformance">
                                2
                            </div>
                            <div class="tab-content" id="CurrentYearTarget">
                                3
                            </div>
                            <div class="tab-content" id="NextYearTarget">
                                4
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include __DIR__ . "/footer.php"; ?>
<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const branchId = urlParams.get('id');

    $(document).ready(function() {
        getYear();
        getCurrency();
        getBranchDetail();

        $(".menu-chart.menu-tab").click(function(e) {
            switch ($(this).data('id')) {
                case '#IdealGoldenRatio':
                    $('#type').val('1');
                    getData();
                    break;
                case '#LastYearPerformance':
                    $('#type').val('2');
                    getData();
                    break;
                case '#CurrentYearTarget':
                    $('#type').val('3');
                    getData();
                    break;
                case '#NextYearTarget':
                    $('#type').val('4');
                    getData();
                    break;
            }
            $(".menu-chart.menu-tab").removeClass('active');
            $(this).addClass('active');
            $(".chart-tab-content .tab-content").removeClass('show');
            $($(this).data('id')).addClass('show');
            $(".filter-content").removeClass('show');
            $($(this).data('filter')).addClass('show');

        });

    });

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
                getData();
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

    function getData() {
        let type = $('#type').val();
        let url = '';
        let tab = '';
        if (type == 1) {
            url = 'ajax/GoldenRatio/getIGR.php';
            tab = 'IdealGoldenRatio';
        } else if (type == 2) {
            url = 'ajax/GoldenRatio/getLYP.php';
            tab = 'LastYearPerformance';
        } else if (type == 3) {
            url = 'ajax/GoldenRatio/getCYT.php';
            tab = 'CurrentYearTarget';
        } else if (type == 4) {
            url = 'ajax/GoldenRatio/getNYT.php';
            tab = 'NextYearTarget';
        }

        let rate = $("#rate").val();
        let year = $("#year").val();
        let currencyId = $("#currencyId").val();
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'html',
            data: {
                rate: rate,
                year: year,
                branchId: branchId,
                currencyId: currencyId
            },
            success: function(data) {
                Swal.close();
                $('#' + tab).html(data);
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
                })
            }
        });

    }
</script>