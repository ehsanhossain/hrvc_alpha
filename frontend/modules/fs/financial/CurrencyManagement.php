<?php include __DIR__ . "/header.php"; ?>
<div class="wrapper-content">
    <h1 class="page-title" style="cursor: pointer;" onclick="location.href = '/fs/default/dashboard'">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16.5 0C12.294 0 9 1.977 9 4.5V7.087C8.517 7.03 8.015 7 7.5 7C3.294 7 0 8.977 0 11.5V19.5C0 22.023 3.294 24 7.5 24C10.907 24 13.716 22.703 14.66 20.869C15.258 20.956 15.874 21 16.5 21C20.706 21 24 19.023 24 16.5V4.5C24 1.977 20.706 0 16.5 0ZM22 12.5C22 13.68 19.648 15 16.5 15C15.988 15 15.486 14.965 15 14.897V12.913C15.49 12.97 15.992 13 16.5 13C18.694 13 20.64 12.462 22 11.589V12.5ZM2 14.589C3.36 15.462 5.306 16 7.5 16C9.694 16 11.64 15.462 13 14.589V15.5C13 16.68 10.648 18 7.5 18C4.352 18 2 16.68 2 15.5V14.589ZM22 8.5C22 9.68 19.648 11 16.5 11C15.965 11 15.44 10.962 14.934 10.888C14.741 10.001 14.134 9.204 13.228 8.565C14.212 8.845 15.32 9 16.5 9C18.694 9 20.64 8.462 22 7.589V8.5ZM16.5 2C19.648 2 22 3.32 22 4.5C22 5.68 19.648 7 16.5 7C13.352 7 11 5.68 11 4.5C11 3.32 13.352 2 16.5 2ZM7.5 9C10.648 9 13 10.32 13 11.5C13 12.68 10.648 14 7.5 14C4.352 14 2 12.68 2 11.5C2 10.32 4.352 9 7.5 9ZM7.5 22C4.352 22 2 20.68 2 19.5V18.589C3.36 19.462 5.306 20 7.5 20C9.694 20 11.64 19.462 13 18.589V19.5C13 20.68 10.648 22 7.5 22ZM16.5 19C15.988 19 15.486 18.965 15 18.897V16.913C15.49 16.97 15.992 17 16.5 17C18.694 17 20.64 16.462 22 15.589V16.5C22 17.68 19.648 19 16.5 19Z" fill="#30313D" />
        </svg>
        Financial Planning
    </h1>

    <div class="mt-15">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body pt-4" style="min-height: 78vh;">
                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="me-2 fs-20" style="cursor: pointer;" onclick="window.history.back()"><a class="text-primary"><i class="bi bi-caret-left-fill"></i>Back</a></div>
                                <div class="fs-20 me-2">Currency Management</div>
                                <a href="CurrencyRegister" class="btn btn-sm btn-primary fs-13">Register Currency <i class="bi bi-sliders"></i></a>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="position-relative me-2">
                                    <input type="text" class="form-control form-control-sm rounded-pill bg-light" style="padding-left: 30px;" id="searchText" name="searchText">
                                    <a onclick="getButtonFooter(1);" class="filter-search" style="left: 10px;right:auto;"><i class="bi bi-search"></i></a>
                                </div>
                                <button class="btn btn-light btn-sm border" style="width: 100px;border-radius: 16px;" onclick="changeFilter(this);"><i class="bi bi-funnel"></i> A-Z</button>
                                <input type="hidden" id="filter" name="filter" value="1">
                            </div>
                        </div>

                        <ul class="currency-table-custom" id="showTable">

                        </ul>

                        <div class="row" id="showButtonFooter">
                            <!-- <div class="col-lg-3 text-lg-start text-center fw-300">
                                Showing <strong class="fw-700">11</strong> of <strong class="fw-700">60</strong> Currency Registry
                            </div>
                            <div class="col-lg-6 col-12 text-center">
                                <div class="pagination">
                                    <a href="#" class="disabled previous">&laquo; Previous</a>
                                    <a href="#" class="active">1</a>
                                    <a href="#">2</a>
                                    <a href="#">3</a>
                                    <span class="mx-2">...</span>
                                    <a href="#">20</a>
                                    <a href="#" class="next">Next &raquo;</a>
                                </div>
                            </div> -->
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modal-finance-config" id="modifyCurrency">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="showModal">

        </div>
    </div>
</div>

<?php include __DIR__ . "/footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    $(document).ready(function() {
        getButtonFooter(1);

        $('#searchText').keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                getButtonFooter(1);
            }
        });
    });

    function changeFilter(elm) {
        let filter = $('#filter').val();
        if (filter == '1') {
            $(elm).html('<i class="bi bi-funnel"></i> A-Z');
            $('#filter').val('2');
        } else {
            $(elm).html('<i class="bi bi-funnel"></i> Z-A');
            $('#filter').val('1');
        }

        getButtonFooter(1);
    }

    function getButtonFooter(page) {
        let searchText = $('#searchText').val();
        let filter = $('#filter').val();

        $.ajax({
            url: 'ajax/CurrencyManagement/getButtonFooter.php',
            type: 'POST',
            dataType: 'html',
            data: {
                filter: filter,
                page: page,
                searchText: searchText
            },
            success: function(data) {
                Swal.close();
                $('#showButtonFooter').html(data);
                getTable(page);
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

    function getTable(page) {
        let searchText = $('#searchText').val();
        let filter = $('#filter').val();

        $.ajax({
            url: 'ajax/CurrencyManagement/getTable.php',
            type: 'POST',
            dataType: 'html',
            data: {
                filter: filter,
                page: page,
                searchText: searchText
            },
            success: function(data) {
                Swal.close();
                $('#showTable').html(data);
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

    function getModalCurrency(currencyId) {
        $.ajax({
            url: 'ajax/CurrencyManagement/getModalCurrency.php',
            type: 'POST',
            dataType: 'html',
            data: {
                currencyId: currencyId
            },
            success: function(data) {
                Swal.close();
                $('#showModal').html(data);
                $('#countryId').select2({
                    templateResult: formatState,
                    templateSelection: formatState,
                    dropdownParent: $('#modifyCurrency'),
                    minimumResultsForSearch: Infinity
                });
                apiCurrency();
                $('#modifyCurrency').modal("show");
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

    function editCurrency() {
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
                url: 'ajax/CurrencyRegister/update.php',
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
                            window.location.href = '/fs/default/currency-management';
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

    function deleteCurrency() {
        let currencyId = $('#currencyId').val();

        customAlert({
            title: "Deletion Warning",
            message: "Do you want to delete?",
            icon: "warning",
            confirmText: `<i class="bi bi-trash"></i> Delete`,
            confirmColor: "btn-outline-danger",
            cancelText: `<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9347 3.77076C13.4565 2.20538 12.2914 0.588867 10.6413 0.588867C9.86065 0.588867 9.12789 0.965901 8.67416 1.60119L4.70728 7.15478H1.43799L0.5 8.09277V17.4727L1.43799 18.4106H15.1497L18.0307 12.6486C18.8862 10.9376 18.5508 8.87118 17.1982 7.51847C16.3647 6.68503 15.2343 6.2168 14.0556 6.2168H12.1193L12.9347 3.77076ZM6.12797 8.39343L10.2007 2.69159C10.3024 2.5493 10.4665 2.46484 10.6413 2.46484C11.0109 2.46484 11.2719 2.82692 11.1549 3.17751L9.51659 8.09277H14.0556C14.7368 8.09277 15.39 8.36341 15.8717 8.84504C16.6534 9.6267 16.8472 10.8209 16.3528 11.8097L13.9903 16.5347H6.12797V8.39343ZM4.25199 16.5347H2.37598V9.03076H4.25199V16.5347Z" fill="white" />
                        </svg> Cancel`,
            cancelColor: "btn-primary"
        }).then(() => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'ajax/CurrencyRegister/delete.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        currencyId: currencyId
                    },
                    success: function(response) {
                        if (response.result == 1) {
                            customAlert({
                                title: "Success!",
                                message: "Your action was successful.",
                                icon: "success",
                                timer: 1500
                            }).then(() => {
                                window.location.href = '/fs/default/currency-management';
                            });
                        } else if (response.result == 2) {
                            Swal.fire({
                                icon: "error",
                                title: "Cannot Delete!",
                                text: "This currency cannot be deleted because it is still in use by some branches. Please review and resolve the issue before proceeding.",
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
            }
        });
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

    function updateAllCurrency() {

        customAlert({
            title: "Warning",
            message: "Do you want update exchange rate for all currency?",
            icon: "warning",
            confirmText: "Save",
            confirmColor: "btn-primary",
            cancelText: "Cancel",
            cancelColor: "btn-outline-secondary"
        }).then(() => {
            $.ajax({
                url: 'ajax/CurrencyManagement/updateAllCurrency.php',
                type: 'POST',
                dataType: 'json',
                data: {},
                success: function(response) {
                    if (response.result == 1) {
                        customAlert({
                            title: "Success!",
                            message: "Your action was successful.",
                            icon: "success",
                            timer: 1500
                        }).then(() => {
                            getTable(1);
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