<?php include __DIR__ . "/header.php"; ?>
<link rel="stylesheet" href="../plugins/apexcharts/dist/apexcharts.css">
<div class="wrapper-content">
    <h1 class="page-title" style="cursor: pointer;" onclick="location.href = 'FinancialDashboard'">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16.5 0C12.294 0 9 1.977 9 4.5V7.087C8.517 7.03 8.015 7 7.5 7C3.294 7 0 8.977 0 11.5V19.5C0 22.023 3.294 24 7.5 24C10.907 24 13.716 22.703 14.66 20.869C15.258 20.956 15.874 21 16.5 21C20.706 21 24 19.023 24 16.5V4.5C24 1.977 20.706 0 16.5 0ZM22 12.5C22 13.68 19.648 15 16.5 15C15.988 15 15.486 14.965 15 14.897V12.913C15.49 12.97 15.992 13 16.5 13C18.694 13 20.64 12.462 22 11.589V12.5ZM2 14.589C3.36 15.462 5.306 16 7.5 16C9.694 16 11.64 15.462 13 14.589V15.5C13 16.68 10.648 18 7.5 18C4.352 18 2 16.68 2 15.5V14.589ZM22 8.5C22 9.68 19.648 11 16.5 11C15.965 11 15.44 10.962 14.934 10.888C14.741 10.001 14.134 9.204 13.228 8.565C14.212 8.845 15.32 9 16.5 9C18.694 9 20.64 8.462 22 7.589V8.5ZM16.5 2C19.648 2 22 3.32 22 4.5C22 5.68 19.648 7 16.5 7C13.352 7 11 5.68 11 4.5C11 3.32 13.352 2 16.5 2ZM7.5 9C10.648 9 13 10.32 13 11.5C13 12.68 10.648 14 7.5 14C4.352 14 2 12.68 2 11.5C2 10.32 4.352 9 7.5 9ZM7.5 22C4.352 22 2 20.68 2 19.5V18.589C3.36 19.462 5.306 20 7.5 20C9.694 20 11.64 19.462 13 18.589V19.5C13 20.68 10.648 22 7.5 22ZM16.5 19C15.988 19 15.486 18.965 15 18.897V16.913C15.49 16.97 15.992 17 16.5 17C18.694 17 20.64 16.462 22 15.589V16.5C22 17.68 19.648 19 16.5 19Z" fill="#30313D" />
        </svg>
        Financial Planning
    </h1>

    <div class="card-nav-tab justify-content-between">
        <ul class="card-tab ">
            <li class="active"><img src="../images/icons/Dark/48px/PL-Forecast.png" style="width:18px"> PL Forcast</li>
            <li><img src="../images/icons/Dark/48px/Golden-Ratio.png" style="width:18px"> Golden Ratio</li>
            <li><img src="../images/icons/Dark/48px/Designation-1.png" style="width:18px"> Forecast Accounts</li>
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
                                <div class="fs-20 me-2">Charts & Analysis</div>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="#" class="btn btn-sm btn-blue fs-13 me-2">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-1">
                                        <path d="M7 0C5.61553 0 4.26215 0.410543 3.11101 1.17971C1.95987 1.94888 1.06266 3.04213 0.532846 4.32122C0.003033 5.6003 -0.13559 7.00776 0.134506 8.36563C0.404603 9.7235 1.07129 10.9708 2.05026 11.9497C3.02922 12.9287 4.2765 13.5954 5.63437 13.8655C6.99224 14.1356 8.3997 13.997 9.67879 13.4672C10.9579 12.9373 12.0511 12.0401 12.8203 10.889C13.5895 9.73785 14 8.38447 14 7C13.998 5.1441 13.2599 3.36479 11.9475 2.05247C10.6352 0.74015 8.8559 0.0020073 7 0ZM7 12.8333C5.84628 12.8333 4.71846 12.4912 3.75918 11.8502C2.79989 11.2093 2.05222 10.2982 1.61071 9.23232C1.16919 8.16642 1.05368 6.99353 1.27876 5.86197C1.50384 4.73042 2.05941 3.69102 2.87521 2.87521C3.69102 2.0594 4.73042 1.50383 5.86198 1.27875C6.99353 1.05367 8.16642 1.16919 9.23232 1.6107C10.2982 2.05221 11.2093 2.79989 11.8502 3.75917C12.4912 4.71846 12.8333 5.84627 12.8333 7C12.8316 8.54657 12.2165 10.0293 11.1229 11.1229C10.0293 12.2165 8.54658 12.8316 7 12.8333Z" fill="#2580D3" />
                                        <path d="M6.99674 5.83301H6.41341C6.2587 5.83301 6.11033 5.89447 6.00093 6.00386C5.89154 6.11326 5.83008 6.26163 5.83008 6.41634C5.83008 6.57105 5.89154 6.71942 6.00093 6.82882C6.11033 6.93822 6.2587 6.99967 6.41341 6.99967H6.99674V10.4997C6.99674 10.6544 7.0582 10.8028 7.1676 10.9122C7.277 11.0215 7.42537 11.083 7.58008 11.083C7.73479 11.083 7.88316 11.0215 7.99256 10.9122C8.10195 10.8028 8.16341 10.6544 8.16341 10.4997V6.99967C8.16341 6.69026 8.04049 6.39351 7.8217 6.17472C7.60291 5.95592 7.30616 5.83301 6.99674 5.83301Z" fill="#2580D3" />
                                        <path d="M7 4.66699C7.48325 4.66699 7.875 4.27524 7.875 3.79199C7.875 3.30874 7.48325 2.91699 7 2.91699C6.51675 2.91699 6.125 3.30874 6.125 3.79199C6.125 4.27524 6.51675 4.66699 7 4.66699Z" fill="#2580D3" />
                                    </svg>
                                    Data Dictionary
                                </a>
                                <a href="#" class="btn btn-sm btn-blue fs-13 me-2">
                                    <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-1">
                                        <path d="M10.7694 3.22933L8.679 1.19583C7.8852 0.424667 6.8304 0 5.709 0H3C1.3458 0 0 1.30842 0 2.91667V11.0833C0 12.6916 1.3458 14 3 14H9C10.6542 14 12 12.6916 12 11.0833V6.11625C12 5.02483 11.5626 4.0005 10.7694 3.22933ZM9.921 4.05475C10.1118 4.23967 10.2732 4.44558 10.404 4.66725H7.7994C7.4682 4.66725 7.1994 4.40533 7.1994 4.08392V1.55108C7.4274 1.67825 7.6392 1.83517 7.83 2.02067L9.9204 4.05417L9.921 4.05475ZM10.8 11.0839C10.8 12.0487 9.9924 12.8339 9 12.8339H3C2.0076 12.8339 1.2 12.0487 1.2 11.0839V2.91667C1.2 1.95183 2.0076 1.16667 3 1.16667H5.709C5.8068 1.16667 5.904 1.17133 6 1.18008V4.08333C6 5.04817 6.8076 5.83333 7.8 5.83333H10.7862C10.7952 5.92667 10.8 6.02117 10.8 6.11625V11.0839ZM8.2242 9.39517C8.4588 9.62267 8.4588 9.99192 8.2242 10.22L7.2564 11.1615C6.9102 11.4981 6.4548 11.6667 6 11.6667C5.5452 11.6667 5.0898 11.4981 4.7436 11.1615L3.7758 10.22C3.5412 9.99192 3.5412 9.62267 3.7758 9.39517C4.0104 9.16708 4.3896 9.16708 4.6242 9.39517L5.4 10.1494V7.58392C5.4 7.26192 5.6682 7.00058 6 7.00058C6.3318 7.00058 6.6 7.26192 6.6 7.58392V10.1494L7.3758 9.39517C7.6104 9.16708 7.9896 9.16708 8.2242 9.39517Z" fill="#2580D3" />
                                    </svg>
                                    Export Chart
                                </a>
                            </div>
                        </div>

                        <div class="bar-light  mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                                        <path d="M11.3333 7.19267C8.76067 7.19267 6.66667 9.286 6.66667 11.8593C6.66667 14.418 8.76067 16.5 11.3333 16.5C13.906 16.5 16 14.4067 16 11.8333C16 9.27467 13.906 7.19267 11.3333 7.19267ZM11.3333 15.1667C9.49533 15.1667 8 13.6827 8 11.8593C8 10.0213 9.49533 8.526 11.3333 8.526C13.1713 8.526 14.6667 10.01 14.6667 11.8333C14.6667 13.6713 13.1713 15.1667 11.3333 15.1667ZM12.4713 12.0287C12.732 12.2893 12.732 12.7107 12.4713 12.9713C12.3413 13.1013 12.1707 13.1667 12 13.1667C11.8293 13.1667 11.6587 13.1013 11.5287 12.9713L10.862 12.3047C10.7367 12.1793 10.6667 12.01 10.6667 11.8333V10.5C10.6667 10.132 10.9647 9.83333 11.3333 9.83333C11.702 9.83333 12 10.132 12 10.5V11.5573L12.4713 12.0287ZM16 5.16667V6.5C16 6.868 15.702 7.16667 15.3333 7.16667C14.9647 7.16667 14.6667 6.868 14.6667 6.5V5.16667C14.6667 4.064 13.7693 3.16667 12.6667 3.16667H3.33333C2.23067 3.16667 1.33333 4.064 1.33333 5.16667V5.83333H7.33333C7.70133 5.83333 8 6.132 8 6.5C8 6.868 7.70133 7.16667 7.33333 7.16667H1.33333V13.1667C1.33333 14.2693 2.23067 15.1667 3.33333 15.1667H6C6.368 15.1667 6.66667 15.4653 6.66667 15.8333C6.66667 16.2013 6.368 16.5 6 16.5H3.33333C1.49533 16.5 0 15.0047 0 13.1667V5.16667C0 3.32867 1.49533 1.83333 3.33333 1.83333H4V1.16667C4 0.798667 4.29867 0.5 4.66667 0.5C5.03467 0.5 5.33333 0.798667 5.33333 1.16667V1.83333H10.6667V1.16667C10.6667 0.798667 10.9647 0.5 11.3333 0.5C11.702 0.5 12 0.798667 12 1.16667V1.83333H12.6667C14.5047 1.83333 16 3.32867 16 5.16667Z" fill="#3C3D48" />
                                    </svg>
                                    <div class="me-2">Current Financial Year 2024</div>
                                    <select name="year" id="year" class="select-year me-2" onchange="getData();">
                                    </select>
                                    <button class="btn-refresh" onclick="getData();">
                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.09648 1.0835C8.55331 1.08828 9.94769 1.67338 10.9688 2.70845H9.27135C8.97106 2.70845 8.72764 2.95094 8.72764 3.25008C8.72764 3.54923 8.97106 3.79172 9.27135 3.79172H11.524C12.0815 3.79142 12.5333 3.34126 12.5337 2.78588V0.541841C12.5337 0.2427 12.2902 0.000202792 11.9899 0.000202792C11.6897 0.000202792 11.4462 0.2427 11.4462 0.541841V1.66739C8.77285 -0.731097 4.65385 -0.516503 2.24619 2.1467C1.30397 3.18895 0.726058 4.50725 0.599057 5.90414C0.571123 6.2041 0.792578 6.4698 1.09368 6.49763C1.10999 6.49913 1.12638 6.49991 1.14279 6.49997C1.41838 6.50347 1.65136 6.29743 1.68054 6.02439C1.93138 3.2299 4.28011 1.08719 7.09648 1.0835Z" fill="#2580D3" />
                                            <path d="M13.0506 6.50004C12.775 6.49654 12.542 6.70258 12.5129 6.97562C12.2534 9.95165 9.62128 12.1547 6.63384 11.8962C5.34128 11.7843 4.13165 11.2151 3.22399 10.2916H4.92149C5.22177 10.2916 5.4652 10.0491 5.4652 9.74993C5.4652 9.45078 5.22177 9.20829 4.92149 9.20829H2.66886C2.11152 9.20798 1.65949 9.65784 1.65918 10.213C1.65918 10.2134 1.65918 10.2137 1.65918 10.2141V12.4582C1.65918 12.7573 1.9026 12.9998 2.20289 12.9998C2.50317 12.9998 2.7466 12.7573 2.7466 12.4582V11.3326C5.41998 13.7311 9.53896 13.5165 11.9466 10.8533C12.8889 9.81106 13.4668 8.49275 13.5938 7.09584C13.6217 6.79588 13.4003 6.53018 13.0992 6.50235C13.083 6.50088 13.0668 6.50009 13.0506 6.50004Z" fill="#2580D3" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="chart-tab-menu">
                                    <button class="menu-chart" type="button">
                                        <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.41873 5.24672C2.90529 5.24672 2.39185 5.05418 2.00677 4.66326L0.670661 3.33299C0.443113 3.10544 0.443113 2.73786 0.670661 2.51031C0.898208 2.28277 1.26578 2.28277 1.49333 2.51031L2.82361 3.84059C3.15034 4.16733 3.67545 4.16733 4.00219 3.84059L6.07929 1.76349C6.86112 0.981663 8.12721 0.981663 8.90904 1.76349L9.81923 2.67368C10.1343 2.98875 10.6827 2.98875 10.9978 2.67368L13.5067 0.170661C13.7342 -0.0568868 14.1018 -0.0568868 14.3293 0.170661C14.5569 0.398208 14.5569 0.765785 14.3293 0.993332L11.8322 3.49052C11.0795 4.24318 9.76089 4.24318 9.0024 3.49052L8.09221 2.58033C7.76547 2.25359 7.24036 2.25359 6.91363 2.58033L4.83653 4.65743C4.44561 5.04834 3.93217 5.24088 3.42457 5.24088L3.41873 5.24672ZM5.1691 13.4209V8.16983C5.1691 7.84893 4.90654 7.58637 4.58564 7.58637C4.26474 7.58637 4.00219 7.84893 4.00219 8.16983V13.4209C4.00219 13.7418 4.26474 14.0044 4.58564 14.0044C4.90654 14.0044 5.1691 13.7418 5.1691 13.4209ZM2.25182 13.4209V7.00292C2.25182 6.68202 1.98927 6.41946 1.66837 6.41946C1.34747 6.41946 1.08491 6.68202 1.08491 7.00292V13.4209C1.08491 13.7418 1.34747 14.0044 1.66837 14.0044C1.98927 14.0044 2.25182 13.7418 2.25182 13.4209ZM8.08637 13.4209V5.25255C8.08637 4.93165 7.82382 4.6691 7.50292 4.6691C7.18202 4.6691 6.91946 4.93165 6.91946 5.25255V13.4209C6.91946 13.7418 7.18202 14.0044 7.50292 14.0044C7.82382 14.0044 8.08637 13.7418 8.08637 13.4209ZM11.0036 13.4209V7.00292C11.0036 6.68202 10.7411 6.41946 10.4202 6.41946C10.0993 6.41946 9.83674 6.68202 9.83674 7.00292V13.4209C9.83674 13.7418 10.0993 14.0044 10.4202 14.0044C10.7411 14.0044 11.0036 13.7418 11.0036 13.4209ZM13.9209 13.4209V4.6691C13.9209 4.3482 13.6584 4.08564 13.3375 4.08564C13.0166 4.08564 12.754 4.3482 12.754 4.6691V13.4209C12.754 13.7418 13.0166 14.0044 13.3375 14.0044C13.6584 14.0044 13.9209 13.7418 13.9209 13.4209Z" fill="#30313D" />
                                        </svg>
                                    </button>
                                    <button class="menu-chart menu-tab" type="button" onclick="window.location.href='AllExpandedView?id=<?php echo $_GET['id']; ?>';">Annual Chart</button>
                                    <button class="menu-chart menu-tab" type="button" onclick="window.location.href='AllExpandedView?id=<?php echo $_GET['id']; ?>';">Content Analysis</button>
                                    <button class="menu-chart menu-tab active" type="button" data-id="#ComparisonAnalysis">Comparison Analysis</button>
                                </div>
                            </div>
                        </div>

                        <div class="chart-tab-content">
                            <div class="tab-content show" id="ComparisonAnalysis">

                            </div>
                        </div>


                    </div>
                </div>
            </div>
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