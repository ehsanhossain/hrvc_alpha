<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$currencyId = mysqli_real_escape_string($connection, $_POST['currencyId']);

$sql = "SELECT a.*,b.countryName,b.flag FROM tbl_currency a
LEFT JOIN country b ON a.countryId = b.countryId 
WHERE a.currencyId = '$currencyId';";
$res = mysqli_query($connection, $sql)  or die($connection->error);
$row = mysqli_fetch_assoc($res);
?>

<form id="formRegisterCurrency" method="post" class="form-currency">
    <input type="hidden" id="currencyId" name="currencyId" value="<?php echo $currencyId; ?>">
    <div class="modal-body ">
        <div class="fw-400 fs-22 svg-blue-link d-flex align-items-center justify-content-between mb-4">
            <div class="">Modify Currency Configuration</div>
            <div class="" data-bs-dismiss="modal">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="15" cy="15" r="14" stroke="#30313D" stroke-width="2" />
                    <path d="M20.6767 10.501L10.4949 20.6828M20.9949 21.001L10.6525 10.6586" stroke="#30313D" stroke-width="2" stroke-linecap="round" />
                </svg>
            </div>
        </div>
        <div class="row">
            <div class="col-6 pe-4">
                <div class="mb-5">
                    <div class="fs-18 fw-300 mb-1">
                        <span class="text-danger">*</span> Currency Name
                    </div>
                    <input type="text" class="form-control" placeholder="e.g., Turkish Lira, Thai Baht" id="currencyName" name="currencyName" value="<?php echo $row['currencyName']; ?>">
                </div>
                <div class="mb-5">
                    <div class="fs-18 fw-300 mb-1">
                        <span class="text-danger">*</span> Currency Code
                    </div>
                    <input type="text" class="form-control" placeholder="e.g., TRY, THB (ISO 4217 standard)" id="currencyCode" name="currencyCode" value="<?php echo $row['currencyCode']; ?>" onchange="apiCurrency();">
                </div>
                <div class="mb-5">
                    <div class="fs-18 fw-300 mb-1">
                        <span class="text-danger">*</span> Currency Sign
                    </div>
                    <input type="text" class="form-control" placeholder="e.g., ₺, ฿" id="currencySymbol" name="currencySymbol" value="<?php echo $row['currencySymbol']; ?>">
                </div>

                <div class="mb-5">
                    <div class="fs-18 fw-300 mb-1">
                        <span class="text-danger">*</span> Country
                    </div>
                    <select class="form-control" id="countryId" name="countryId" style="width: 100%;">
                        <?php
                        $sql_country = "SELECT c.*,d.currencyId
                        FROM country c
                        LEFT JOIN tbl_currency d ON c.countryId = d.countryId
                        ORDER BY countryName ASC;";
                        $res_country = mysqli_query($connection, $sql_country) or die($connection->error);
                        ?>
                        <option value="" selected>Country or region where the currency is used</option>
                        <?php while ($row_country = mysqli_fetch_assoc($res_country)) {
                            if ($row_country['currencyId'] != '') {
                                $data_status = "<i class='bi bi-check-circle'></i> Already in Use";
                            } else {
                                $data_status = " Not Set Yet";
                            }
                        ?>
                            <option value="<?php echo $row_country['countryId']; ?>" <?php echo $row_country['countryId'] == $row['countryId'] ? 'selected' : ''; ?> data-status="<?php echo $data_status; ?>" data-icon="https://tcg-hrvc-system.com/<?php echo $row_country['flag'] == '' ? 'images/no-img.png' : $row_country['flag']; ?>"><?php echo $row_country['countryName']; ?></option>
                        <?php } ?>
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
                        <button type="button" class="btn <?php echo $row['source'] == '1' ? 'active' : ''; ?>" data-target="#exchangeAPI">API</button>
                        <button type="button" class="btn <?php echo $row['source'] == '2' ? 'active' : ''; ?>" data-target="#exchangeManual">Manual</button>
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
                    <input type="hidden" id="source" name="source" value="<?php echo $row['source']; ?>">
                    <input type="text" class="form-control mb-3 py-3 " id="equivalent" name="equivalent" placeholder="enter value that equivalent to 1 USD" readonly onchange="numberFormat(this);" value="<?php echo $row['exchangeRate']; ?>">
                    <input type="text" class="form-control mb-3 py-3 " id="equivalentManual" name="equivalentManual" placeholder="enter value that equivalent to 1 USD" onchange="numberFormat(this);" value="<?php echo $row['exchangeRate']; ?>">
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

                    <button type="button" class="btn btn-outline-danger" onclick="deleteCurrency();">
                        <i class="bi bi-trash"></i>
                        Delete
                    </button>
                    <button type="button" class="btn btn-primary" onclick="editCurrency();">
                        <i class="bi bi-floppy"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>

    </div>
</form>

<script>
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
</script>