<?php include __DIR__ . "/header.php"; ?>
<div class="wrapper-content">
    <h1 class="page-title">
        <img src="../asset/icon/coins.svg" alt="">
        Financial Planning
    </h1>

    <div class="mt-15">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body pt-4" style="min-height: 78vh;">
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-2 fs-20" style="cursor: pointer;" onclick="window.history.back()"><a class="text-primary"><i class="bi bi-caret-left-fill"></i>Back</a></div>
                            <div class="fs-20 me-2">Register New Currency</div>
                        </div>

                        <form id="formRegisterCurrency" method="post" class="form-currency">
                            <div class="row justify-content-center py-5">
                                <div class="col-4">
                                    <div class="mb-5">
                                        <div class="fs-18 fw-300 mb-1">
                                            <span class="text-danger">*</span> Currency Name
                                        </div>
                                        <input type="text" class="form-control" id="currencyName" name="currencyName" placeholder="e.g., Turkish Lira, Thai Baht">
                                    </div>
                                    <div class="mb-5">
                                        <div class="fs-18 fw-300 mb-1">
                                            <span class="text-danger">*</span> Currency Code
                                        </div>
                                        <input type="text" class="form-control" id="currencyCode" name="currencyCode" placeholder="e.g., TRY, THB (ISO 4217 standard)" onchange="apiCurrency();">
                                    </div>
                                    <div class="mb-5">
                                        <div class="fs-18 fw-300 mb-1">
                                            <span class="text-danger">*</span> Currency Sign
                                        </div>
                                        <input type="text" class="form-control" id="currencySymbol" name="currencySymbol" placeholder="e.g., ₺, ฿">
                                    </div>


                                    <div class="mb-5">
                                        <div class="fs-18 fw-300 mb-1">
                                            <span class="text-danger">*</span> Country
                                        </div>
                                        <select class="form-control" id="countryId" name="countryId">
                                            <option value="" selected disabled>Country or region where the currency is used</option>
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <div class="fs-18 fw-300 mb-1">
                                            <span class="text-danger">*</span> Dollar Unit
                                        </div>
                                        <input type="text" class="form-control bg-light" id="dollarUnit" name="dollarUnit" placeholder="Default is set to 1.0 USD" readonly>
                                    </div>
                                </div>
                                <div class="col-4 offset-1">
                                    <div class="mb-3">
                                        <div class="fs-18 fw-300 mb-2">
                                            <span class="text-danger">*</span> Exchange Rate
                                        </div>
                                        <div class="btn-group btn-rate">
                                            <button type="button" class="btn active" data-target="#exchangeAPI">API</button>
                                            <button type="button" class="btn" data-target="#exchangeManual">Manual</button>
                                        </div>
                                    </div>

                                    <div id="exchangeAPI">
                                        <div class="fs-18 fw-300 mb-2">
                                            <svg width="18" height="17" viewBox="0 0 18 17" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.00033 0.333984C7.35215 0.333984 5.74099 0.822726 4.37058 1.7384C3.00017 2.65408 1.93206 3.95557 1.30133 5.47829C0.670603 7.00101 0.505575 8.67656 0.827119 10.2931C1.14866 11.9096 1.94233 13.3944 3.10777 14.5599C4.27321 15.7253 5.75807 16.519 7.37458 16.8405C8.99108 17.1621 10.6666 16.997 12.1894 16.3663C13.7121 15.7356 15.0136 14.6675 15.9292 13.2971C16.8449 11.9267 17.3337 10.3155 17.3337 8.66732C17.3313 6.45791 16.4525 4.33968 14.8902 2.7774C13.328 1.21511 11.2097 0.336374 9.00033 0.333984ZM9.00033 15.6118C7.62685 15.6118 6.28421 15.2045 5.1422 14.4414C4.00019 13.6783 3.11011 12.5938 2.5845 11.3248C2.05889 10.0559 1.92137 8.65961 2.18932 7.31252C2.45727 5.96543 3.11867 4.72805 4.08986 3.75685C5.06106 2.78566 6.29844 2.12426 7.64553 1.85631C8.99262 1.58836 10.3889 1.72588 11.6579 2.25149C12.9268 2.7771 14.0114 3.66718 14.7744 4.80919C15.5375 5.9512 15.9448 7.29383 15.9448 8.66732C15.9427 10.5085 15.2105 12.2736 13.9086 13.5755C12.6067 14.8774 10.8415 15.6097 9.00033 15.6118Z" "/>
                                            <path d=" M9.00022 7.2793H8.30577C8.12159 7.2793 7.94496 7.35246 7.81473 7.4827C7.68449 7.61293 7.61133 7.78956 7.61133 7.97374C7.61133 8.15792 7.68449 8.33455 7.81473 8.46479C7.94496 8.59502 8.12159 8.66819 8.30577 8.66819H9.00022V12.8349C9.00022 13.019 9.07338 13.1957 9.20361 13.3259C9.33385 13.4561 9.51048 13.5293 9.69466 13.5293C9.87884 13.5293 10.0555 13.4561 10.1857 13.3259C10.3159 13.1957 10.3891 13.019 10.3891 12.8349V8.66819C10.3891 8.29983 10.2428 7.94656 9.98231 7.68609C9.72184 7.42563 9.36857 7.2793 9.00022 7.2793Z" "/>
                                            <path d=" M9.00065 5.88802C9.57595 5.88802 10.0423 5.42165 10.0423 4.84635C10.0423 4.27106 9.57595 3.80469 9.00065 3.80469C8.42535 3.80469 7.95898 4.27106 7.95898 4.84635C7.95898 5.42165 8.42535 5.88802 9.00065 5.88802Z" />
                                            </svg>
                                            Application Programming Interface (API)
                                        </div>

                                        <div class="fs-14 fw-200 mb-3">
                                            Our <span class="fw-400">API</span> dynamically fetches real-time exchange rates, continuously updated from trusted sources. Rates are converted from USD to the selected country’s currency, ensuring accurate and up-to-date conversions for financial calculations and transactions
                                        </div>
                                    </div>
                                    <div id="exchangeManual">
                                        <input type="hidden" id="source" name="source" value="1">
                                        <input type="text" class="form-control mb-3 py-3 " id="equivalent" name="equivalent" placeholder="enter value that equivalent to 1 USD" readonly onchange="numberFormat(this);">
                                        <input type="text" class="form-control mb-3 py-3 " id="equivalentManual" name="equivalentManual" placeholder="enter value that equivalent to 1 USD" onchange="numberFormat(this);">
                                        <div class="fs-18 fw-300 mb-2">
                                            <svg width="18" height="17" viewBox="0 0 18 17" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.00033 0.333984C7.35215 0.333984 5.74099 0.822726 4.37058 1.7384C3.00017 2.65408 1.93206 3.95557 1.30133 5.47829C0.670603 7.00101 0.505575 8.67656 0.827119 10.2931C1.14866 11.9096 1.94233 13.3944 3.10777 14.5599C4.27321 15.7253 5.75807 16.519 7.37458 16.8405C8.99108 17.1621 10.6666 16.997 12.1894 16.3663C13.7121 15.7356 15.0136 14.6675 15.9292 13.2971C16.8449 11.9267 17.3337 10.3155 17.3337 8.66732C17.3313 6.45791 16.4525 4.33968 14.8902 2.7774C13.328 1.21511 11.2097 0.336374 9.00033 0.333984ZM9.00033 15.6118C7.62685 15.6118 6.28421 15.2045 5.1422 14.4414C4.00019 13.6783 3.11011 12.5938 2.5845 11.3248C2.05889 10.0559 1.92137 8.65961 2.18932 7.31252C2.45727 5.96543 3.11867 4.72805 4.08986 3.75685C5.06106 2.78566 6.29844 2.12426 7.64553 1.85631C8.99262 1.58836 10.3889 1.72588 11.6579 2.25149C12.9268 2.7771 14.0114 3.66718 14.7744 4.80919C15.5375 5.9512 15.9448 7.29383 15.9448 8.66732C15.9427 10.5085 15.2105 12.2736 13.9086 13.5755C12.6067 14.8774 10.8415 15.6097 9.00033 15.6118Z" />
                                                <path d="M9.00022 7.2793H8.30577C8.12159 7.2793 7.94496 7.35246 7.81473 7.4827C7.68449 7.61293 7.61133 7.78956 7.61133 7.97374C7.61133 8.15792 7.68449 8.33455 7.81473 8.46479C7.94496 8.59502 8.12159 8.66819 8.30577 8.66819H9.00022V12.8349C9.00022 13.019 9.07338 13.1957 9.20361 13.3259C9.33385 13.4561 9.51048 13.5293 9.69466 13.5293C9.87884 13.5293 10.0555 13.4561 10.1857 13.3259C10.3159 13.1957 10.3891 13.019 10.3891 12.8349V8.66819C10.3891 8.29983 10.2428 7.94656 9.98231 7.68609C9.72184 7.42563 9.36857 7.2793 9.00022 7.2793Z" />
                                                <path d="M9.00065 5.88802C9.57595 5.88802 10.0423 5.42165 10.0423 4.84635C10.0423 4.27106 9.57595 3.80469 9.00065 3.80469C8.42535 3.80469 7.95898 4.27106 7.95898 4.84635C7.95898 5.42165 8.42535 5.88802 9.00065 5.88802Z" />
                                            </svg>
                                            Manual Currency Rate
                                        </div>

                                        <div class="fs-14 fw-200">
                                            Enter the exchange rate manually if you'd prefer to set your own. This option is useful when you need custom rates that are not tied to real-time data. Ensure the rates are accurate to maintain consistency in your financial calculations.
                                        </div>
                                    </div>


                                    <div class="text-end mt-5">
                                        <button type="button" class="btn btn-outline-info" id="btnRefresh" onclick="apiCurrency();">
                                            <i class="bi bi-arrow-repeat"></i>
                                            Refresh API
                                        </button>

                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="9.5" cy="9.33398" r="8.2" stroke-width="1.6" />
                                                <path d="M12.9089 6.63379L6.7998 12.7429M13.0998 12.9338L6.89436 6.72835" stroke-width="2" stroke-linecap="round" />
                                            </svg>
                                            Cancel
                                        </button>
                                        <button type="button" class="btn btn-primary" onclick="insertCurrency();">
                                            Register
                                            <svg width="19" height="19" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 0.666992C9.62663 0.666992 7.30655 1.37078 5.33316 2.68936C3.35977 4.00793 1.8217 5.88208 0.913451 8.07479C0.00519943 10.2675 -0.232441 12.6803 0.230582 15.0081C0.693605 17.3358 1.83649 19.474 3.51472 21.1523C5.19295 22.8305 7.33115 23.9734 9.65892 24.4364C11.9867 24.8994 14.3995 24.6618 16.5922 23.7535C18.7849 22.8453 20.6591 21.3072 21.9776 19.3338C23.2962 17.3604 24 15.0404 24 12.667C23.9966 9.48545 22.7312 6.4352 20.4815 4.18551C18.2318 1.93582 15.1815 0.670433 12 0.666992ZM12 22.667C10.0222 22.667 8.08879 22.0805 6.4443 20.9817C4.79981 19.8829 3.51809 18.3211 2.76121 16.4938C2.00433 14.6666 1.8063 12.6559 2.19215 10.7161C2.578 8.77628 3.53041 6.99445 4.92894 5.59592C6.32746 4.1974 8.10929 3.24499 10.0491 2.85914C11.9889 2.47329 13.9996 2.67132 15.8268 3.4282C17.6541 4.18507 19.2159 5.4668 20.3147 7.11129C21.4135 8.75578 22 10.6892 22 12.667C21.9971 15.3183 20.9426 17.8601 19.0679 19.7348C17.1931 21.6096 14.6513 22.6641 12 22.667ZM17 12.667C17 12.9322 16.8946 13.1866 16.7071 13.3741C16.5196 13.5616 16.2652 13.667 16 13.667H13V16.667C13 16.9322 12.8946 17.1866 12.7071 17.3741C12.5196 17.5616 12.2652 17.667 12 17.667C11.7348 17.667 11.4804 17.5616 11.2929 17.3741C11.1054 17.1866 11 16.9322 11 16.667V13.667H8C7.73479 13.667 7.48043 13.5616 7.2929 13.3741C7.10536 13.1866 7 12.9322 7 12.667C7 12.4018 7.10536 12.1474 7.2929 11.9599C7.48043 11.7723 7.73479 11.667 8 11.667H11V8.66699C11 8.40177 11.1054 8.14742 11.2929 7.95988C11.4804 7.77235 11.7348 7.66699 12 7.66699C12.2652 7.66699 12.5196 7.77235 12.7071 7.95988C12.8946 8.14742 13 8.40177 13 8.66699V11.667H16C16.2652 11.667 16.5196 11.7723 16.7071 11.9599C16.8946 12.1474 17 12.4018 17 12.667Z" fill="#fff" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . "/footer.php"; ?>

<script>
    $(document).ready(function() {
        getCountry();
    });

    $(".btn-rate .btn").click(function(e) {
        $(".btn-rate .btn").removeClass('active');
        $(this).addClass('active');
        // exchangeManual
        if ($(this).data('target') == "#exchangeAPI") {
            $('#source').val(1);
            $('#equivalentManual').hide();
            $('#equivalent').show();
            $('#btnRefresh').show();
            // $("#equivalent").attr("readonly", "true").addClass('bg-light');
            $("#exchangeAPI svg").css("color", "#2580D3");
            $("#exchangeManual svg").css("color", "#979797");
        } else {
            $('#source').val(2);
            $('#equivalentManual').show();
            $('#equivalent').hide();
            $('#btnRefresh').hide();
            // $("#equivalent").removeAttr("readonly").removeClass('bg-light');
            // $("#equivalent").attr("readonly", "false").removeClass('bg-light');
            $("#exchangeAPI svg").css("color", "#979797");
            $("#exchangeManual svg").css("color", "#2580D3");
        }
    });
    $(".btn-rate .btn.active").click();

    function getCountry() {
        $.ajax({
            url: 'ajax/CurrencyRegister/getCountry.php',
            type: 'POST',
            dataType: 'html',
            data: {},
            success: function(data) {
                Swal.close();
                $('#countryId').html(data);
                $('#countryId').select2({
                    templateResult: formatState,
                    templateSelection: formatState,
                    // dropdownParent: $('#modifyCurrency'),
                    minimumResultsForSearch: Infinity
                });
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

    function insertCurrency() {
        let currencyName = $('#currencyName').val();
        let currencyCode = $('#currencyCode').val();
        let currencySymbol = $('#currencySymbol').val();
        let countryId = $('#countryId').val();
        let equivalent = $('#equivalent').val();

        if (!currencyName || !currencyCode || !currencySymbol || !countryId || !equivalent) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Data',
                text: 'Please fill in all fields before submitting!',
            });
            return false;
        }

        customAlert({
            title: "Warning",
            message: "Do you want to save?",
            icon: "warning",
            confirmText: "Save",
            confirmColor: "btn-primary",
            cancelText: "Cancel",
            cancelColor: "btn-outline-secondary"
        }).then(() => {
            let formData = new FormData($("#formRegisterCurrency")[0]);
            $.ajax({
                url: 'ajax/CurrencyRegister/insert.php',
                type: 'POST',
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.result == 1) {
                        customAlert({
                            title: "Success!",
                            message: "Your action was successful.",
                            icon: "success",
                            timer: 1500
                        }).then(() => {
                            window.location.href = 'CurrencyManagement';
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

    function apiCurrency() {
        let currencyCode = $('#currencyCode').val();
        let source = $('#source').val();

        if (source == 1) {
            $.ajax({
                url: 'ajax/CurrencyRegister/apiCurrency.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    currencyCode: currencyCode
                },
                success: function(response) {
                    console.log(response);

                    if (response.result == 1) {
                        Swal.close();
                        $('#equivalent').val(Comma((Number(response.exchangeRate)).toFixed(8)));
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Can not get API currency. Please check Currency Code and try again.",
                            showConfirmButton: false,
                            timer: 1500
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
        }
    }

    function numberFormat(elm) {
        let value = elm.value;
        $(elm).val(Comma((Number(value)).toFixed(8)));
    }

    function Comma(Num) {
        Num += '';
        Num = Num.replace(/,/g, '');
        x = Num.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        return x1 + x2;
    }


    function formatState(state) {
        if (!state.id) {
            return state.text;
        }

        // ตรวจสอบสถานะและเพิ่ม class
        const statusClass = state.element.dataset.status.includes("Already in Use") ? 'active' : '';

        // ใช้ data-icon เป็นรูปภาพ
        const iconHtml = state.element.dataset.icon ?
            '<img src="' + state.element.dataset.icon + '" style="width: 16px; height: 16px; margin-right: 5px;">' :
            '';

        // สร้าง HTML ที่มี class และรูปภาพ
        var $state = $(
            '<span class="option-country ' + statusClass + '">' +
            iconHtml + state.text +
            ' <span style="float:right; font-size:0.9em;">' + state.element.dataset.status + '</span></span>'
        );
        return $state;
    }
</script>