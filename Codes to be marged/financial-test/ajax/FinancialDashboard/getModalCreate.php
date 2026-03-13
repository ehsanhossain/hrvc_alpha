<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$companyId = mysqli_real_escape_string($connection, $_POST['companyId']);

// $sqlGroup = "SELECT g.* FROM `group` g ;";
$sqlGroup = "SELECT g.* 
             FROM `company` c 
             LEFT JOIN `group` g ON g.groupId = c.groupId 
             WHERE c.companyId = '$companyId';";
$resGroup = mysqli_query($connection, $sqlGroup) or die($connection->error);
// $resGroup = mysqli_fetch_all($resGroup, MYSQLI_ASSOC);
$rowGroup =  mysqli_fetch_assoc($resGroup);
// echo "<pre>";
// var_dump($resGroup);
// echo "</pre>";

$sql = "SELECT * FROM branch b WHERE b.companyId = '$companyId' AND b.status = '1' AND b.financial_start_month IS NULL";
$res = mysqli_query($connection, $sql) or die($connection->error);
$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

?>
<form id="form_add">
    <div class="modal-body ">
        <div class="fw-400 fs-22 svg-blue-link d-flex align-items-center">
            <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-3">
                <path d="M12 0.666992C9.62663 0.666992 7.30655 1.37078 5.33316 2.68936C3.35977 4.00793 1.8217 5.88208 0.913451 8.07479C0.00519943 10.2675 -0.232441 12.6803 0.230582 15.0081C0.693605 17.3358 1.83649 19.474 3.51472 21.1523C5.19295 22.8305 7.33115 23.9734 9.65892 24.4364C11.9867 24.8994 14.3995 24.6618 16.5922 23.7535C18.7849 22.8453 20.6591 21.3072 21.9776 19.3338C23.2962 17.3604 24 15.0404 24 12.667C23.9966 9.48545 22.7312 6.4352 20.4815 4.18551C18.2318 1.93582 15.1815 0.670433 12 0.666992ZM12 22.667C10.0222 22.667 8.08879 22.0805 6.4443 20.9817C4.79981 19.8829 3.51809 18.3211 2.76121 16.4938C2.00433 14.6666 1.8063 12.6559 2.19215 10.7161C2.578 8.77628 3.53041 6.99445 4.92894 5.59592C6.32746 4.1974 8.10929 3.24499 10.0491 2.85914C11.9889 2.47329 13.9996 2.67132 15.8268 3.4282C17.6541 4.18507 19.2159 5.4668 20.3147 7.11129C21.4135 8.75578 22 10.6892 22 12.667C21.9971 15.3183 20.9426 17.8601 19.0679 19.7348C17.1931 21.6096 14.6513 22.6641 12 22.667ZM17 12.667C17 12.9322 16.8946 13.1866 16.7071 13.3741C16.5196 13.5616 16.2652 13.667 16 13.667H13V16.667C13 16.9322 12.8946 17.1866 12.7071 17.3741C12.5196 17.5616 12.2652 17.667 12 17.667C11.7348 17.667 11.4804 17.5616 11.2929 17.3741C11.1054 17.1866 11 16.9322 11 16.667V13.667H8C7.73479 13.667 7.48043 13.5616 7.2929 13.3741C7.10536 13.1866 7 12.9322 7 12.667C7 12.4018 7.10536 12.1474 7.2929 11.9599C7.48043 11.7723 7.73479 11.667 8 11.667H11V8.66699C11 8.40177 11.1054 8.14742 11.2929 7.95988C11.4804 7.77235 11.7348 7.66699 12 7.66699C12.2652 7.66699 12.5196 7.77235 12.7071 7.95988C12.8946 8.14742 13 8.40177 13 8.66699V11.667H16C16.2652 11.667 16.5196 11.7723 16.7071 11.9599C16.8946 12.1474 17 12.4018 17 12.667Z" fill="#2580D3" />
            </svg>
            Create New Financial Configuration
        </div>
        <hr class="mb-1">
        <div class="d-table w-100">
            <div class="d-table-cell w-50 px-2 align-middle">
                <div class="mb-3 fw-300 fs-18">Group Details</div>
                <div class="d-flex align-items-center mb-4">
                    <div class="me-3"><img src="https://tcg-hrvc-system.com/<?php echo $rowGroup['picture']; ?>" alt="" class="dd-circle" style="width:87px;height:87px;"></div>
                    <div>
                        <div class="fw-400 fs-24"><?php echo $rowGroup['groupName']; ?></div>
                        <div class="d-flex align-items-center">
                            <div class="me-2">
                                <img src="../asset/icon/comma.svg" alt="" width="9"><img src="../asset/icon/comma.svg" alt="" width="9">
                            </div>
                            <div class="fw-300 fs-14"><?php echo $rowGroup['tagLine']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-table w-100 mb-5">
            <div class="d-table-cell w-50 px-2 align-top mb-4">

                <div class="d-flex justify-content-between">
                    <div class="mb-3 fw-300 fs-18" onclick="$('#confirmFinanceConfig').modal('show')" style="cursor: pointer;">
                        <span class="text-danger">*</span> Select Branch
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.00033 0.333984C7.35215 0.333984 5.74099 0.822726 4.37058 1.7384C3.00017 2.65408 1.93206 3.95557 1.30133 5.47829C0.670603 7.00101 0.505575 8.67656 0.827119 10.2931C1.14866 11.9096 1.94233 13.3944 3.10777 14.5599C4.27321 15.7253 5.75807 16.519 7.37458 16.8405C8.99108 17.1621 10.6666 16.997 12.1894 16.3663C13.7121 15.7356 15.0136 14.6675 15.9292 13.2971C16.8449 11.9267 17.3337 10.3155 17.3337 8.66732C17.3313 6.45791 16.4525 4.33968 14.8902 2.7774C13.328 1.21511 11.2097 0.336374 9.00033 0.333984ZM9.00033 15.6118C7.62685 15.6118 6.28421 15.2045 5.1422 14.4414C4.00019 13.6783 3.11011 12.5938 2.5845 11.3248C2.05889 10.0559 1.92137 8.65961 2.18932 7.31252C2.45727 5.96543 3.11867 4.72805 4.08986 3.75685C5.06106 2.78566 6.29844 2.12426 7.64553 1.85631C8.99262 1.58836 10.3889 1.72588 11.6579 2.25149C12.9268 2.7771 14.0114 3.66718 14.7744 4.80919C15.5375 5.9512 15.9448 7.29383 15.9448 8.66732C15.9427 10.5085 15.2105 12.2736 13.9086 13.5755C12.6067 14.8774 10.8415 15.6097 9.00033 15.6118Z" fill="#2580D3" />
                            <path d="M9.00022 7.2793H8.30577C8.12159 7.2793 7.94496 7.35246 7.81473 7.4827C7.68449 7.61293 7.61133 7.78956 7.61133 7.97374C7.61133 8.15792 7.68449 8.33455 7.81473 8.46479C7.94496 8.59502 8.12159 8.66819 8.30577 8.66819H9.00022V12.8349C9.00022 13.019 9.07338 13.1957 9.20361 13.3259C9.33385 13.4561 9.51048 13.5293 9.69466 13.5293C9.87884 13.5293 10.0555 13.4561 10.1857 13.3259C10.3159 13.1957 10.3891 13.019 10.3891 12.8349V8.66819C10.3891 8.29983 10.2428 7.94656 9.98231 7.68609C9.72184 7.42563 9.36857 7.2793 9.00022 7.2793Z" fill="#2580D3" />
                            <path d="M9.00065 5.88802C9.57595 5.88802 10.0423 5.42165 10.0423 4.84635C10.0423 4.27106 9.57595 3.80469 9.00065 3.80469C8.42535 3.80469 7.95898 4.27106 7.95898 4.84635C7.95898 5.42165 8.42535 5.88802 9.00065 5.88802Z" fill="#2580D3" />
                        </svg>
                    </div>
                    <div class="">
                        <a href="#" class="text-primary">
                            <span class=" text-decoration-underline">
                                Select Form Branch
                            </span>
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 6.71429V1M9 1H3.28571M9 1L1 9" stroke="#2580D3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="custom-select-container mb-3">
                    <select class="custom-select" id="branchId" name="branchId" onchange="checkSelectBranch();">
                        <option value="" disabled selected>Select From Branch</option>
                        <?php foreach ($rows as $row) { ?>
                            <option value="<?php echo $row['branchId']; ?>"><?php echo $row['branchName']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="d-flex align-items-center" id="noBranch">
                    <div class="circle-icon-gray me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-2-3h4v-1h-4v1zm1-2h2v-6h-2v6z" />
                        </svg>
                    </div>
                    <div class="fs-14 fw-300 text-mute">
                        No Branch are Selected Yet
                    </div>
                </div>


            </div>
            <div class="d-table-cell w-50 px-2 align-top mb-4">

                <div class="d-flex justify-content-between">
                    <div class="mb-3 fw-300 fs-18">
                        <span class="text-danger">*</span> F.Y. Start Month
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.00033 0.333984C7.35215 0.333984 5.74099 0.822726 4.37058 1.7384C3.00017 2.65408 1.93206 3.95557 1.30133 5.47829C0.670603 7.00101 0.505575 8.67656 0.827119 10.2931C1.14866 11.9096 1.94233 13.3944 3.10777 14.5599C4.27321 15.7253 5.75807 16.519 7.37458 16.8405C8.99108 17.1621 10.6666 16.997 12.1894 16.3663C13.7121 15.7356 15.0136 14.6675 15.9292 13.2971C16.8449 11.9267 17.3337 10.3155 17.3337 8.66732C17.3313 6.45791 16.4525 4.33968 14.8902 2.7774C13.328 1.21511 11.2097 0.336374 9.00033 0.333984ZM9.00033 15.6118C7.62685 15.6118 6.28421 15.2045 5.1422 14.4414C4.00019 13.6783 3.11011 12.5938 2.5845 11.3248C2.05889 10.0559 1.92137 8.65961 2.18932 7.31252C2.45727 5.96543 3.11867 4.72805 4.08986 3.75685C5.06106 2.78566 6.29844 2.12426 7.64553 1.85631C8.99262 1.58836 10.3889 1.72588 11.6579 2.25149C12.9268 2.7771 14.0114 3.66718 14.7744 4.80919C15.5375 5.9512 15.9448 7.29383 15.9448 8.66732C15.9427 10.5085 15.2105 12.2736 13.9086 13.5755C12.6067 14.8774 10.8415 15.6097 9.00033 15.6118Z" fill="#2580D3" />
                            <path d="M9.00022 7.2793H8.30577C8.12159 7.2793 7.94496 7.35246 7.81473 7.4827C7.68449 7.61293 7.61133 7.78956 7.61133 7.97374C7.61133 8.15792 7.68449 8.33455 7.81473 8.46479C7.94496 8.59502 8.12159 8.66819 8.30577 8.66819H9.00022V12.8349C9.00022 13.019 9.07338 13.1957 9.20361 13.3259C9.33385 13.4561 9.51048 13.5293 9.69466 13.5293C9.87884 13.5293 10.0555 13.4561 10.1857 13.3259C10.3159 13.1957 10.3891 13.019 10.3891 12.8349V8.66819C10.3891 8.29983 10.2428 7.94656 9.98231 7.68609C9.72184 7.42563 9.36857 7.2793 9.00022 7.2793Z" fill="#2580D3" />
                            <path d="M9.00065 5.88802C9.57595 5.88802 10.0423 5.42165 10.0423 4.84635C10.0423 4.27106 9.57595 3.80469 9.00065 3.80469C8.42535 3.80469 7.95898 4.27106 7.95898 4.84635C7.95898 5.42165 8.42535 5.88802 9.00065 5.88802Z" fill="#2580D3" />
                        </svg>
                    </div>
                    <div class="">
                        <a href="#" class="text-primary">
                            <span class=" text-decoration-underline">
                                Select Form F.Y. Start Month
                            </span>
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 6.71429V1M9 1H3.28571M9 1L1 9" stroke="#2580D3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="custom-select-container mb-3">
                    <select class="custom-select" id="startMonth" name="startMonth" onchange="checkSelectStartMonth();">
                        <option value="" disabled selected>Select From F.Y. Start Month</option>
                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo date('F', mktime(0, 0, 0, $i, 1)); ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class=" d-flex align-items-center" id="noStartMonth">
                    <div class="circle-icon-gray me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-2-3h4v-1h-4v1zm1-2h2v-6h-2v6z" />
                        </svg>
                    </div>
                    <div class="fs-14 fw-300 text-mute">
                        No F.Y. Start Month are Selected Yet
                    </div>
                </div>
            </div>
        </div>
        <div class="fs-18 fw-500">Description</div>
        <textarea name="description" id="description" class="form-control p-3 fs-14 fw-300" rows="8" style="resize: none;" placeholder="In Turkey, the standard rule for issuing work permits (WP) to foreign employees requires a ratio of five local employees for every foreign employee (1:5 ratio). However, under certain circumstances, such as providing a strong reference letter, there may be flexibility in meeting this requirement. This exception allows companies to potentially bypass the ratio, making it easier to hire foreign talent while still aligning with Turkish labor regulations."></textarea>
        <div class="text-end mt-3">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="9.5" cy="9.33398" r="8.2" stroke-width="1.6" />
                    <path d="M12.9089 6.63379L6.7998 12.7429M13.0998 12.9338L6.89436 6.72835" stroke-width="2" stroke-linecap="round" />
                </svg>
                Cancel
            </button>
            <button class="btn btn-primary" type="button" onclick="createBranch();">
                Create
                <svg width="19" height="19" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 0.666992C9.62663 0.666992 7.30655 1.37078 5.33316 2.68936C3.35977 4.00793 1.8217 5.88208 0.913451 8.07479C0.00519943 10.2675 -0.232441 12.6803 0.230582 15.0081C0.693605 17.3358 1.83649 19.474 3.51472 21.1523C5.19295 22.8305 7.33115 23.9734 9.65892 24.4364C11.9867 24.8994 14.3995 24.6618 16.5922 23.7535C18.7849 22.8453 20.6591 21.3072 21.9776 19.3338C23.2962 17.3604 24 15.0404 24 12.667C23.9966 9.48545 22.7312 6.4352 20.4815 4.18551C18.2318 1.93582 15.1815 0.670433 12 0.666992ZM12 22.667C10.0222 22.667 8.08879 22.0805 6.4443 20.9817C4.79981 19.8829 3.51809 18.3211 2.76121 16.4938C2.00433 14.6666 1.8063 12.6559 2.19215 10.7161C2.578 8.77628 3.53041 6.99445 4.92894 5.59592C6.32746 4.1974 8.10929 3.24499 10.0491 2.85914C11.9889 2.47329 13.9996 2.67132 15.8268 3.4282C17.6541 4.18507 19.2159 5.4668 20.3147 7.11129C21.4135 8.75578 22 10.6892 22 12.667C21.9971 15.3183 20.9426 17.8601 19.0679 19.7348C17.1931 21.6096 14.6513 22.6641 12 22.667ZM17 12.667C17 12.9322 16.8946 13.1866 16.7071 13.3741C16.5196 13.5616 16.2652 13.667 16 13.667H13V16.667C13 16.9322 12.8946 17.1866 12.7071 17.3741C12.5196 17.5616 12.2652 17.667 12 17.667C11.7348 17.667 11.4804 17.5616 11.2929 17.3741C11.1054 17.1866 11 16.9322 11 16.667V13.667H8C7.73479 13.667 7.48043 13.5616 7.2929 13.3741C7.10536 13.1866 7 12.9322 7 12.667C7 12.4018 7.10536 12.1474 7.2929 11.9599C7.48043 11.7723 7.73479 11.667 8 11.667H11V8.66699C11 8.40177 11.1054 8.14742 11.2929 7.95988C11.4804 7.77235 11.7348 7.66699 12 7.66699C12.2652 7.66699 12.5196 7.77235 12.7071 7.95988C12.8946 8.14742 13 8.40177 13 8.66699V11.667H16C16.2652 11.667 16.5196 11.7723 16.7071 11.9599C16.8946 12.1474 17 12.4018 17 12.667Z" fill="#fff" />
                </svg>
            </button>
        </div>
    </div>
</form>