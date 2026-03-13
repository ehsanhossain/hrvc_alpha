<?php include("header.php"); ?>

<?php include("footer.php"); ?>

<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const id = urlParams.get('__id');

    $(document).ready(function() {
        checkUser();
    });

    function checkUser() {
        $.ajax({
            url: 'auth.php',
            type: 'POST',
            data: {
                __id: id,
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);

                if (response.result == 1) {
                    localStorage.setItem('userId', response.userId);
                    localStorage.setItem('employeeId', response.employeeId);
                    localStorage.setItem('employeeFirstname', response.employeeFirstname);
                    localStorage.setItem('employeeSurename', response.employeeSurename);
                    localStorage.setItem('employeePicture', response.employeePicture);
                    localStorage.setItem('companyId', response.companyId);
                    localStorage.setItem('companyName', response.companyName);
                    localStorage.setItem('branchId', response.branchId);
                    localStorage.setItem('branchName', response.branchName);
                    localStorage.setItem('departmentId', response.departmentId);
                    localStorage.setItem('departmentName', response.departmentName);
                    localStorage.setItem('titleId', response.titleId);
                    localStorage.setItem('titleName', response.titleName);
                    localStorage.setItem('financial_start_month', response.financial_start_month);
                    localStorage.setItem('currency_default', response.currency_default);
                    localStorage.setItem('firstBranchId', response.firstBranchId);

                    window.location.href = 'FinancialDashboard';
                } else if (response.result == 2) {
                    Swal.fire({
                        title: "Warning?",
                        text: "No user found in the system.Please try logging in again.",
                        icon: "warning",
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Close"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'https://tcg-hrvc-system.com/site/login';
                        }
                    });
                } else if (response.result == 9) {
                    Swal.fire({
                        title: "Warning?",
                        text: "Unable to contact database Please contact the system administrator.!",
                        icon: "warning",
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Close"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'https://tcg-hrvc-system.com/site/login';
                        }
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
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'https://tcg-hrvc-system.com/site/login';
                    }
                });
            }
        });
    }
</script>