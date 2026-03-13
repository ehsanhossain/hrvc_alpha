<?php include __DIR__ . "/header.php"; ?>
<style>
    /* ตั้งค่าสำหรับ Container หลัก */
</style>
<div class="wrapper-content">
    <h1 class="page-title">
        <img src="../asset/icon/coins.svg" alt="">
        Financial Dashboard
    </h1>

    <div class="mt-15">
        <div class="row">
            <div class="mb-3 col-lg-4 col-12">
                <div class="border-0 card" id="showCompanyGroup">
                </div>
            </div>
            <div class="mb-3 col-lg-5 col-12">
                <div class="border-0 card" style="height: 240px;">
                    <div class="pb-2 card-body">
                        <div class="mb-2 d-flex align-items-center justify-content-between ">
                            <div class="d-flex align-items-center">
                                <div class="btn-group me-3" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-sm dd-btn-Leaderboard active" data-target="#table-data">
                                        <svg viewBox="0 0 17 13" width="17" height="13" fill="currentColor">
                                            <path d="M11.334 9.91H1.894a.983.983 0 0 0 0 1.97h9.44a.983.983 0 0 0 0-1.97ZM1.894 7.31h9.44a.983.983 0 1 0 0-1.97H1.894a.983.983 0 1 0 0 1.97ZM1.894 2.77h9.44a.983.983 0 1 0 0-1.97H1.894a.983.983 0 1 0 0 1.97ZM14.913 9.256a1.62 1.62 0 1 0 0 3.243 1.62 1.62 0 0 0 0-3.243ZM14.913 5.037a1.62 1.62 0 1 0 0 3.243 1.62 1.62 0 0 0 0-3.243ZM14.913.502a1.62 1.62 0 1 0 0 3.243A1.62 1.62 0 0 0 14.913.502Z" />
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-sm dd-btn-Leaderboard" data-target="#chart-data">
                                        <svg viewBox="0 0 17 17" width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.2" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.319 8.912c0-.777 0-1.165.242-1.406.242-.242.63-.242 1.407-.242s1.165 0 1.407.242c.242.241.242.629.242 1.406v4.94c0 .777 0 1.165-.242 1.406-.242.242-.63.242-1.407.242s-1.165 0-1.407-.242c-.242-.241-.242-.629-.242-1.406v-4.94ZM7.084 5.617c0-.777 0-1.165.241-1.406.242-.242.63-.242 1.407-.242s1.166 0 1.407.242c.242.241.242.629.242 1.406v8.235c0 .777 0 1.165-.242 1.406-.241.242-.63.242-1.407.242s-1.165 0-1.407-.242c-.241-.241-.241-.629-.241-1.406V5.617ZM12.845 3.147c0-.777 0-1.165.241-1.406.242-.242.63-.242 1.406-.242s1.165 0 1.407.242c.241.241.241.629.241 1.406v10.706c0 .777 0 1.165-.241 1.406-.242.242-.63.242-1.407.242s-1.164 0-1.406-.242c-.241-.241-.241-.629-.241-1.406V3.147Z" />
                                        </svg>
                                    </button>
                                </div>
                                <span class="text-primary fs-18">Leaderboard</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="fs-14 me-2">Currency</div>
                                <select class="border dd-drop-down me-2 fs-14" name="currencyId" id="currencyId" style="width: 116px;" onchange="getLeaderboard();">
                                </select>
                                <select class="dd-drop-down primary fs-14" name="breakdownId" id="breakdownId" style="width: 116px;" onchange="getLeaderboard();">
                                </select>
                            </div>

                        </div>
                        <div class="border-top">
                            <div id="table-data" class="dd-tab-Leaderboard">
                            </div>
                            <div id="chart-data" class="dd-tab-Leaderboard">
                                <!-- <div id="dd-chart-Leaderboard" class="w-100" height="164"></div> -->
                                <canvas id="dd-chart-Leaderboard" class="w-100" height="164"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-10 col-lg-3 col-12">
                <div class="border-0 card">
                    <div class="card-body">
                        <div class="mb-2 d-flex align-items-center justify-content-between">
                            <div class=""><span class="text-primary">Cerrency Management</span></div>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm btn-blue fs-13" onclick="window.location.href='CurrencyManagement';">Manage <i class="bi bi-sliders"></i></button>
                            </div>
                        </div>
                        <div class="border-top" id="showCurrency">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="pt-4 card-body" style="min-height: 62vh;">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="me-2 fs-20" style="cursor: pointer;" onclick="window.location.href = 'FinancialDashboard';"><a class="text-primary"><i class="bi bi-caret-left-fill"></i>Back</a></div>
                                <div class="fs-20">Profit & Loss Flow Configuration</div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between" id="showGroup">

                                <!-- <div class="position-relative me-2">
                                    <input type="text" class="form-control form-control-sm rounded-pill">
                                    <a href="#" class="filter-search"><i class="bi bi-search"></i></a>
                                </div>
                                <button class="btn btn-primary btn-sm" style="width: 100px;"><i class="bi bi-funnel"></i> Filter</button> -->
                            </div>
                        </div>

                        <div class="row" id="showData"></div>


                        <div id="formRegisterCurrency" class="p-4 form-currency">
                            <div class="position-relative dash-forecast-accounts" style="height: 55vh;">
                                <div class="position-middle content-no-config">
                                    <p><img src="../asset/images/no-config.png" alt="" width="82"></p>
                                    <div class="mb-2 fs-26 fw-700">No History Yet!</div>
                                    <p class="text-muted fs-15 fw-300">It will show when at least one financial year will be completed.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . "/footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->
<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const branchId = urlParams.get('id');
    const companyId = localStorage.getItem('companyId');

    $(document).ready(function() {
        getCurrency();
        getCompanyGroup();
        getGroup();
        getCurrencyManagement();
        getData();

        $(".dd-btn-Leaderboard").click(function(e) {
            $(".dd-btn-Leaderboard").removeClass("active");
            $(this).addClass("active");
            $(".dd-tab-Leaderboard").hide();
            $($(this).data("target")).show();
        });
        // $(".dd-tab-Leaderboard").hide();
        setTimeout(() => {
            $(".dd-btn-Leaderboard.active").trigger("click");
        }, 500);

        $('#searchText').keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                getButtonFooter(1);
            }
        });
    });

    function getCompanyGroup() {
        $.ajax({
            url: 'ajax/FinancialDashboard/getCompanyGroup.php',
            type: 'POST',
            dataType: 'html',
            data: {
                companyId: companyId,
            },
            success: function(data) {
                Swal.close();
                $('#showCompanyGroup').html(data);
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

    function getGroup() {
        $.ajax({
            url: 'ajax/FinancialHistory/getGroup.php',
            type: 'POST',
            dataType: 'html',
            data: {
                companyId: companyId,
            },
            success: function(data) {
                Swal.close();
                $('#showGroup').html(data);
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
                getBreakdown();
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

    function getBreakdown() {
        $.ajax({
            url: 'ajax/FinancialDashboard/getBreakdown.php',
            type: 'POST',
            dataType: 'html',
            data: {},
            success: function(data) {
                Swal.close();
                $('#breakdownId').html(data);
                getLeaderChart();
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

    function getCurrencyManagement() {
        $.ajax({
            url: 'ajax/FinancialDashboard/getCurrencyManagement.php',
            type: 'POST',
            dataType: 'html',
            data: {},
            success: function(data) {
                Swal.close();
                $('#showCurrency').html(data);
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

    function getLeaderboard() {
        let currencyId = $('#currencyId').val();
        let breakdownId = $('#breakdownId').val();
        $.ajax({
            url: 'ajax/FinancialDashboard/getLeaderboard.php',
            type: 'POST',
            dataType: 'html',
            data: {
                currencyId: currencyId,
                breakdownId: breakdownId,
                companyId: companyId
            },
            success: function(data) {
                Swal.close();
                $('#table-data').html(data);
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

    function getLeaderChart() {
        let currencyId = $('#currencyId').val();
        let breakdownId = $('#breakdownId').val();
        $.ajax({
            url: 'ajax/FinancialDashboard/getLeaderChart.php',
            type: 'POST',
            dataType: 'json',
            data: {
                currencyId: currencyId,
                breakdownId: breakdownId,
                companyId: companyId
            },

            success: function(response) {
                Swal.close();
                let branchData = [];
                let valueData = [];
                let imagePaths = [];

                response.forEach(item => {
                    branchData.push(item.branchName);
                    valueData.push(item.value);
                    imagePaths.push('https://tcg-hrvc-system.com/' + item.branchImage);
                });

                const canvas = document.getElementById("dd-chart-Leaderboard");
                canvas.style.height = "300px";
                canvas.style.width = "100%";

                const ctx = document.getElementById("dd-chart-Leaderboard").getContext("2d");

                const images = imagePaths.map(src => {
                    const img = new Image();
                    img.src = src;
                    img.isLoaded = false;
                    img.onload = () => {
                        img.isLoaded = true;
                    };
                    return img;
                });


                const imageLabelsPlugin = {
                    id: "imageLabels",
                    afterDatasetsDraw(chart) {
                        const xScale = chart.scales.x;
                        const ctx = chart.ctx;

                        xScale.ticks.forEach((tick, index) => {
                            const img = images[index];

                            if (img.isLoaded) {
                                const x = xScale.getPixelForValue(index) - 10;
                                const y = chart.chartArea.bottom + 4;

                                ctx.save();
                                ctx.globalAlpha = 1.0;
                                ctx.drawImage(img, x, y, 20, 20);
                                ctx.restore();
                            }
                        });
                    }
                };

                new Chart(ctx, {
                    type: "bar",
                    data: {
                        responsive: true,
                        maintainAspectRatio: false,
                        labels: branchData,
                        datasets: [{
                            label: "Sales",
                            data: valueData,
                            // data: [3000, 3000, 3000, 3000, 3000, 3000, 3000, 3000],
                            backgroundColor: "#2580D3",
                            borderRadius: 4,
                            borderSkipped: false
                        }]
                    },
                    options: {
                        layout: {
                            padding: {
                                bottom: 20
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    display: false
                                }
                            },
                            y: {
                                ticks: {
                                    callback: function(value) {
                                        return formatNumber(value); // ใช้ฟังก์ชัน formatNumber เพื่อแสดงค่าแบบย่อ
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        let value = tooltipItem.raw; // ค่าใน dataset
                                        return "Sales: " + formatNumber(value);
                                    }
                                }
                            }
                        }
                    },
                    plugins: [imageLabelsPlugin]
                });

                getLeaderboard();
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

    function formatNumber(value) {
        if (value >= 1e9) {
            return (value / 1e9).toFixed(2) + 'B'; // หน่วยพันล้าน
        } else if (value >= 1e6) {
            return (value / 1e6).toFixed(2) + 'M'; // หน่วยล้าน
        } else if (value >= 1e3) {
            return (value / 1e3).toFixed(2) + 'K'; // หน่วยพัน
        } else {
            return value.toFixed(2); // หน่วยปกติ
        }
    }

    function getData() {
        $.ajax({
            url: 'ajax/FinancialHistory/getData.php',
            type: 'POST',
            dataType: 'html',
            data: {
                companyId: companyId,
                branchId: branchId
            },
            success: function(data) {
                Swal.close();
                console.log(data);

                if (data != '') {
                    $('#formRegisterCurrency').hide();
                    $('#showData').html(data);
                }
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

    function deleteBranch(branchId) {

        customAlert({
            title: "Deletion Warning",
            message: "Deleting the Financial Configuration will permanently remove all related data from PL Portal, Golden Ratio, and Future Accounts, including all stored history.This action cannot be undone.Please confirm if you wish to proceed.",
            icon: "warning",
            confirmText: `<i class="bi bi-trash"></i> Delete`,
            confirmColor: "btn-outline-danger",
            cancelText: `<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9347 3.77076C13.4565 2.20538 12.2914 0.588867 10.6413 0.588867C9.86065 0.588867 9.12789 0.965901 8.67416 1.60119L4.70728 7.15478H1.43799L0.5 8.09277V17.4727L1.43799 18.4106H15.1497L18.0307 12.6486C18.8862 10.9376 18.5508 8.87118 17.1982 7.51847C16.3647 6.68503 15.2343 6.2168 14.0556 6.2168H12.1193L12.9347 3.77076ZM6.12797 8.39343L10.2007 2.69159C10.3024 2.5493 10.4665 2.46484 10.6413 2.46484C11.0109 2.46484 11.2719 2.82692 11.1549 3.17751L9.51659 8.09277H14.0556C14.7368 8.09277 15.39 8.36341 15.8717 8.84504C16.6534 9.6267 16.8472 10.8209 16.3528 11.8097L13.9903 16.5347H6.12797V8.39343ZM4.25199 16.5347H2.37598V9.03076H4.25199V16.5347Z" fill="white" />
                </svg> Cancel`,
            cancelColor: "btn-primary"
        }).then(() => {
            $.ajax({
                url: 'ajax/FinancialDashboard/deleteBranch.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    branchId: branchId
                },
                success: function(response) {
                    swal.close();
                    if (response.result == 1) {
                        customAlert({
                            title: "Success!",
                            message: "Your action was successful.",
                            icon: "success",
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "There was an issue saving your data. Please try again!",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    }
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
        });
    }
</script>