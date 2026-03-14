<?php
$_GET['id'] = $_GET['id'] ?? '';
$_GET['quarter'] = $_GET['quarter'] ?? '';
$_GET['rate'] = $_GET['rate'] ?? '3';
?>
<?php include __DIR__ . "/header.php"; ?>
<div class="wrapper-content">
    <h1 class="page-title" style="cursor: pointer;" onclick="location.href = '/fs/default/dashboard'">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16.5 0C12.294 0 9 1.977 9 4.5V7.087C8.517 7.03 8.015 7 7.5 7C3.294 7 0 8.977 0 11.5V19.5C0 22.023 3.294 24 7.5 24C10.907 24 13.716 22.703 14.66 20.869C15.258 20.956 15.874 21 16.5 21C20.706 21 24 19.023 24 16.5V4.5C24 1.977 20.706 0 16.5 0ZM22 12.5C22 13.68 19.648 15 16.5 15C15.988 15 15.486 14.965 15 14.897V12.913C15.49 12.97 15.992 13 16.5 13C18.694 13 20.64 12.462 22 11.589V12.5ZM2 14.589C3.36 15.462 5.306 16 7.5 16C9.694 16 11.64 15.462 13 14.589V15.5C13 16.68 10.648 18 7.5 18C4.352 18 2 16.68 2 15.5V14.589ZM22 8.5C22 9.68 19.648 11 16.5 11C15.965 11 15.44 10.962 14.934 10.888C14.741 10.001 14.134 9.204 13.228 8.565C14.212 8.845 15.32 9 16.5 9C18.694 9 20.64 8.462 22 7.589V8.5ZM16.5 2C19.648 2 22 3.32 22 4.5C22 5.68 19.648 7 16.5 7C13.352 7 11 5.68 11 4.5C11 3.32 13.352 2 16.5 2ZM7.5 9C10.648 9 13 10.32 13 11.5C13 12.68 10.648 14 7.5 14C4.352 14 2 12.68 2 11.5C2 10.32 4.352 9 7.5 9ZM7.5 22C4.352 22 2 20.68 2 19.5V18.589C3.36 19.462 5.306 20 7.5 20C9.694 20 11.64 19.462 13 18.589V19.5C13 20.68 10.648 22 7.5 22ZM16.5 19C15.988 19 15.486 18.965 15 18.897V16.913C15.49 16.97 15.992 17 16.5 17C18.694 17 20.64 16.462 22 15.589V16.5C22 17.68 19.648 19 16.5 19Z" fill="#30313D" />
        </svg>
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
            <li onclick="window.location.href='GoldenRatio?id=<?php echo $_GET['id']; ?>';"><img src="/fs/images/icons/Dark/48px/Golden-Ratio.png" style="width:18px"> Golden Ratio</li>
            <li onclick="window.location.href='ForecastAccounts?id=<?php echo $_GET['id']; ?>';"><img src="/fs/images/icons/Dark/48px/Designation-1.png" style="width:18px"> Forecast Accounts</li>
        </ul>
        <ul class="card-tab" id="showBranchDetail">

        </ul>

    </div>

    <div class="mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body pt-4" style="min-height: 80vh;">

                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="me-2 fs-20" style="cursor: pointer;" onclick="window.location.href = '/fs/default/dashboard';"><a class="text-primary"><i class="bi bi-caret-left-fill"></i>Back</a></div>
                                <div class="fs-20 me-2">Profit & Loss Flow Configuration</div>
                                <a class="btn btn-sm btn-primary fs-13 me-2" onclick="getModalCreate();">Create Flow <i class="bi bi-plus-circle"></i></a>
                                <!-- <a class="btn btn-sm btn-blue fs-13 me-2" data-bs-toggle="modal" data-bs-target="#modalImportConfiguration">Import Flow <i class="bi bi-file-earmark-arrow-up"></i></a> -->
                                <a class="btn btn-sm btn-outline-primary fs-13 me-2" data-bs-toggle="modal" data-bs-target="#modalImport">
                                    Import Data
                                    <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.305 3.76825L10.0208 1.46673C9.13658 0.575826 7.95764 0.130371 6.70501 0.130371H3.68395C1.84185 0.204614 0.368164 1.68946 0.368164 3.47128V12.6031C0.368164 14.3849 1.84185 15.8698 3.68395 15.8698H10.3155C12.1576 15.8698 13.6313 14.3849 13.6313 12.6031V7.03492C13.6313 5.84704 13.1155 4.65916 12.305 3.84249V3.76825ZM11.3471 4.7334C11.5682 4.95613 11.7155 5.17886 11.8629 5.40158H8.98922C8.62079 5.40158 8.32606 5.10461 8.32606 4.7334V1.91219C8.54711 2.06067 8.84185 2.20916 8.98922 2.43189L11.2734 4.7334H11.3471ZM12.305 12.5289C12.305 13.5683 11.4208 14.4592 10.3155 14.4592H3.68395C2.57869 14.4592 1.69448 13.5683 1.69448 12.5289V3.47128C1.69448 2.43189 2.57869 1.54098 3.68395 1.54098H6.70501C6.77869 1.54098 6.92606 1.54098 6.99974 1.54098V4.80764C6.99974 5.84704 7.88395 6.73795 8.98922 6.73795H12.305C12.305 6.81219 12.305 6.96067 12.305 7.03492V12.6031V12.5289ZM4.56816 10.5243C4.27343 10.3016 4.27343 9.85613 4.56816 9.6334L5.67343 8.59401C6.04185 8.2228 6.55764 8.00007 7.07343 8.00007C7.58922 8.00007 8.10501 8.2228 8.47343 8.59401L9.57869 9.6334C9.87343 9.85613 9.87343 10.3016 9.57869 10.5243C9.28395 10.747 8.91553 10.747 8.62079 10.5243L7.73658 9.70764V12.5289C7.73658 12.9001 7.44185 13.197 7.07343 13.197C6.70501 13.197 6.41027 12.9001 6.41027 12.5289V9.70764L5.52606 10.5243C5.23132 10.747 4.8629 10.747 4.56816 10.5243Z" fill="#2580D3" />
                                    </svg>
                                </a>
                                <button type="button" id="exportButton" class="btn btn-sm btn-light fs-13 me-2" onclick="exportExcel();">Download Flow <i class="bi bi-file-earmark-arrow-down"></i></button>
                            </div>

                            <div class="d-flex align-items-center">
                                <select name="MajorId" id="MajorId" class="filter me-2" onchange="getMedium('MediumId');getData(1);">
                                    <option value="">All Catagory</option>
                                </select>
                                <select name="MediumId" id="MediumId" class="filter me-2" onchange="getData(1);">
                                    <option value="">All Sub-Catagory</option>
                                </select>
                                <select name="BreakdownId" id="BreakdownId" class="filter me-2" onchange="getData(1);">
                                    <option value="">All Breakdown</option>
                                </select>
                                <!-- <button class="btn btn-primary btn-sm border" style="width: 100px;border-radius: 16px;" onclick="changeFilter(this);"><i class="bi bi-funnel"></i> Filter</button> -->
                            </div>
                        </div>

                        <div id="showData">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-finance-config" id="modalImport" tabindex="-1" aria-labelledby="modalImport" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 1200px;">
        <div class="modal-content">
            <form id="formImport">

                <div class="modal-body ">
                    <div class="fw-400 fs-22 svg-blue-link d-flex align-items-center justify-content-between mb-4">
                        <div class="">Import Profit & Loss Flow</div>
                        <div class="" data-bs-dismiss="modal">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="15" cy="15" r="14" stroke="#30313D" stroke-width="2" />
                                <path d="M20.6767 10.501L10.4949 20.6828M20.9949 21.001L10.6525 10.6586" stroke="#30313D" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                    </div>
                    <div class="row d-table w-100 mb-4">
                        <div class="col-1 d-table-cell align-content-center">
                            <div class="step">
                                <div class="step-number">
                                    <span>1</span>
                                    <div class="content-number">
                                        <strong>Step 1</strong>
                                        <div class="text-muted">Download the Import excel file</div>
                                    </div>
                                </div>
                                <div class="step-number down">
                                    <span>2</span>
                                    <div class="content-number">
                                        <strong>Step 2</strong>
                                        <div class="text-muted">Upload the excel file</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 d-table-cell align-content-center">
                            <div class="file-download">
                                <img src="/fs/asset/images/excel.png" alt="Excel Icon">
                                <div class="file-info">
                                    <div class="file-name fs-15 fw-400">Import Profit & Loss Flow.xlsx</div>
                                    <div class="file-size fs-15 fw-200">12 KB</div>
                                </div>
                                <a href="ajax/FinancialConfiguration/Import Profit & Loss Flow.xlsx" class="download-button"><i class="bi bi-file-earmark-arrow-down"></i> Download</a>
                            </div>
                        </div>
                        <div class="col-6 d-table-cell align-content-center">
                            <div class="d-inline-block border-start ps-3 fs-13 fw-300">
                                <strong>Hint</strong>
                                <div class="  text-muted">
                                    <p class="mb-1">1. Download the Excel file</p>
                                    <p class="mb-1">2. Open it and enter your values in the specified rows and columns.</p>
                                    <p class="mb-1">3. Do not change the format.</p>
                                    <p class="mb-1">4. Save the file as a CSV.</p>
                                    <p class="mb-1">5. Upload the CSV in the second box.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="configuration-browse">
                        <table class="w-100">
                            <tr>
                                <td>
                                    <div class=" d-table position-relative">
                                        <div class="d-table-cell align-content-center"></div>
                                        <img src="/fs/asset/images/Drag and Drop Icon.png" alt="" width="94">
                                        <div class="fs-18 ms-2 d-table-cell align-content-center ps-2">
                                            Drag & Drop <br>
                                            Your Files <br>
                                            Here
                                        </div>
                                        <input type="file" name="fileImport" id="fileImport" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;opacity: 0;" accept=".xlsx">
                                    </div>
                                </td>
                                <td class="fs-15 fw-400" style="width: 4%;">Or</td>
                                <td>
                                    <div class="text-center">
                                        <label for="fileImport" class="download-button"><i class="bi bi-database"></i> Browse</label>
                                        <div class="fs-11 fw-200 mt-2 text-muted">
                                            Open the file you downloaded in Step 1 and enter your values in the <br>
                                            specified rows and columns without changing the format. <br>
                                            Save the file as an XLSX. Please upload the file you saved after <br>
                                            inputting the data to the second box to continue.
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div class="text-center fs-12 mt-3">
                            <span class="text-muted">Acceptable file types:</span> .xlsx Only
                            <span class="text-muted ms-4">Maximum file Size:</span> 3 MB
                            <div class="mt-3" id="boxFileImport">
                                <img src="/fs/asset/images/excel.png" alt="Excel Icon" style="width: 100px;">
                                <div id="fileNameDisplay"></div>
                                <button class="btn btn-danger btn-sm" type="button" id="btnRemoveFileImport">Remove</button>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="9.5" cy="9.33398" r="8.2" stroke-width="1.6" />
                                <path d="M12.9089 6.63379L6.7998 12.7429M13.0998 12.9338L6.89436 6.72835" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary" onclick="importData();">
                            Create
                            <svg width="19" height="19" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 0.666992C9.62663 0.666992 7.30655 1.37078 5.33316 2.68936C3.35977 4.00793 1.8217 5.88208 0.913451 8.07479C0.00519943 10.2675 -0.232441 12.6803 0.230582 15.0081C0.693605 17.3358 1.83649 19.474 3.51472 21.1523C5.19295 22.8305 7.33115 23.9734 9.65892 24.4364C11.9867 24.8994 14.3995 24.6618 16.5922 23.7535C18.7849 22.8453 20.6591 21.3072 21.9776 19.3338C23.2962 17.3604 24 15.0404 24 12.667C23.9966 9.48545 22.7312 6.4352 20.4815 4.18551C18.2318 1.93582 15.1815 0.670433 12 0.666992ZM12 22.667C10.0222 22.667 8.08879 22.0805 6.4443 20.9817C4.79981 19.8829 3.51809 18.3211 2.76121 16.4938C2.00433 14.6666 1.8063 12.6559 2.19215 10.7161C2.578 8.77628 3.53041 6.99445 4.92894 5.59592C6.32746 4.1974 8.10929 3.24499 10.0491 2.85914C11.9889 2.47329 13.9996 2.67132 15.8268 3.4282C17.6541 4.18507 19.2159 5.4668 20.3147 7.11129C21.4135 8.75578 22 10.6892 22 12.667C21.9971 15.3183 20.9426 17.8601 19.0679 19.7348C17.1931 21.6096 14.6513 22.6641 12 22.667ZM17 12.667C17 12.9322 16.8946 13.1866 16.7071 13.3741C16.5196 13.5616 16.2652 13.667 16 13.667H13V16.667C13 16.9322 12.8946 17.1866 12.7071 17.3741C12.5196 17.5616 12.2652 17.667 12 17.667C11.7348 17.667 11.4804 17.5616 11.2929 17.3741C11.1054 17.1866 11 16.9322 11 16.667V13.667H8C7.73479 13.667 7.48043 13.5616 7.2929 13.3741C7.10536 13.1866 7 12.9322 7 12.667C7 12.4018 7.10536 12.1474 7.2929 11.9599C7.48043 11.7723 7.73479 11.667 8 11.667H11V8.66699C11 8.40177 11.1054 8.14742 11.2929 7.95988C11.4804 7.77235 11.7348 7.66699 12 7.66699C12.2652 7.66699 12.5196 7.77235 12.7071 7.95988C12.8946 8.14742 13 8.40177 13 8.66699V11.667H16C16.2652 11.667 16.5196 11.7723 16.7071 11.9599C16.8946 12.1474 17 12.4018 17 12.667Z" fill="#fff" />
                            </svg>
                        </button>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade modal-finance-config" id="modalConfiguration">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="showModalConfiguration">

        </div>
    </div>
</div>

<div class="modal fade modal-finance-confirm" id="confirmFinanceConfig" tabindex="-1" aria-labelledby="confirmFinanceConfigLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:494px">
        <div class="modal-content">
            <div class="modal-body px-4">
                <div class="fw-400 fs-20  d-flex align-items-center mb-3">
                    <span class="svg-blue-link d-inline-block me-2">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.00033 0.333984C7.35215 0.333984 5.74099 0.822726 4.37058 1.7384C3.00017 2.65408 1.93206 3.95557 1.30133 5.47829C0.670603 7.00101 0.505575 8.67656 0.827119 10.2931C1.14866 11.9096 1.94233 13.3944 3.10777 14.5599C4.27321 15.7253 5.75807 16.519 7.37458 16.8405C8.99108 17.1621 10.6666 16.997 12.1894 16.3663C13.7121 15.7356 15.0136 14.6675 15.9292 13.2971C16.8449 11.9267 17.3337 10.3155 17.3337 8.66732C17.3313 6.45791 16.4525 4.33968 14.8902 2.7774C13.328 1.21511 11.2097 0.336374 9.00033 0.333984ZM9.00033 15.6118C7.62685 15.6118 6.28421 15.2045 5.1422 14.4414C4.00019 13.6783 3.11011 12.5938 2.5845 11.3248C2.05889 10.0559 1.92137 8.65961 2.18932 7.31252C2.45727 5.96543 3.11867 4.72805 4.08986 3.75685C5.06106 2.78566 6.29844 2.12426 7.64553 1.85631C8.99262 1.58836 10.3889 1.72588 11.6579 2.25149C12.9268 2.7771 14.0114 3.66718 14.7744 4.80919C15.5375 5.9512 15.9448 7.29383 15.9448 8.66732C15.9427 10.5085 15.2105 12.2736 13.9086 13.5755C12.6067 14.8774 10.8415 15.6097 9.00033 15.6118Z" fill="#2580D3" />
                            <path d="M9.00022 7.2793H8.30577C8.12159 7.2793 7.94496 7.35246 7.81473 7.4827C7.68449 7.61293 7.61133 7.78956 7.61133 7.97374C7.61133 8.15792 7.68449 8.33455 7.81473 8.46479C7.94496 8.59502 8.12159 8.66819 8.30577 8.66819H9.00022V12.8349C9.00022 13.019 9.07338 13.1957 9.20361 13.3259C9.33385 13.4561 9.51048 13.5293 9.69466 13.5293C9.87884 13.5293 10.0555 13.4561 10.1857 13.3259C10.3159 13.1957 10.3891 13.019 10.3891 12.8349V8.66819C10.3891 8.29983 10.2428 7.94656 9.98231 7.68609C9.72184 7.42563 9.36857 7.2793 9.00022 7.2793Z" fill="#2580D3" />
                            <path d="M9.00065 5.88802C9.57595 5.88802 10.0423 5.42165 10.0423 4.84635C10.0423 4.27106 9.57595 3.80469 9.00065 3.80469C8.42535 3.80469 7.95898 4.27106 7.95898 4.84635C7.95898 5.42165 8.42535 5.88802 9.00065 5.88802Z" fill="#2580D3" />
                        </svg>
                    </span>
                    Chose Accounts Flow
                </div>
                <p class="fs-16 fw-300">
                    If your company isn't listed in the <span class="text-primary text-decoration-underline fw-400">Group Management</span> Module for financial configuration, please ensure it's registered under the group to proceed seamlessly
                </p>
                <div class="text-end mt-3">
                    <button class="btn btn-primary" data-bs-dismiss="modal">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9347 3.77076C13.4565 2.20538 12.2914 0.588867 10.6413 0.588867C9.86065 0.588867 9.12789 0.965901 8.67416 1.60119L4.70728 7.15478H1.43799L0.5 8.09277V17.4727L1.43799 18.4106H15.1497L18.0307 12.6486C18.8862 10.9376 18.5508 8.87118 17.1982 7.51847C16.3647 6.68503 15.2343 6.2168 14.0556 6.2168H12.1193L12.9347 3.77076ZM6.12797 8.39343L10.2007 2.69159C10.3024 2.5493 10.4665 2.46484 10.6413 2.46484C11.0109 2.46484 11.2719 2.82692 11.1549 3.17751L9.51659 8.09277H14.0556C14.7368 8.09277 15.39 8.36341 15.8717 8.84504C16.6534 9.6267 16.8472 10.8209 16.3528 11.8097L13.9903 16.5347H6.12797V8.39343ZM4.25199 16.5347H2.37598V9.03076H4.25199V16.5347Z" fill="white" />
                        </svg>
                        Great!
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-finance-confirm" id="warningModal" tabindex="-1" aria-labelledby="confirmFinanceConfigLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:494px">
        <div class="modal-content">
            <div class="modal-body px-4">
                <div class="fw-400 fs-20  d-flex align-items-center mb-3">
                    <span class="svg-blue-link d-inline-block me-2">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.00033 0.333984C7.35215 0.333984 5.74099 0.822726 4.37058 1.7384C3.00017 2.65408 1.93206 3.95557 1.30133 5.47829C0.670603 7.00101 0.505575 8.67656 0.827119 10.2931C1.14866 11.9096 1.94233 13.3944 3.10777 14.5599C4.27321 15.7253 5.75807 16.519 7.37458 16.8405C8.99108 17.1621 10.6666 16.997 12.1894 16.3663C13.7121 15.7356 15.0136 14.6675 15.9292 13.2971C16.8449 11.9267 17.3337 10.3155 17.3337 8.66732C17.3313 6.45791 16.4525 4.33968 14.8902 2.7774C13.328 1.21511 11.2097 0.336374 9.00033 0.333984ZM9.00033 15.6118C7.62685 15.6118 6.28421 15.2045 5.1422 14.4414C4.00019 13.6783 3.11011 12.5938 2.5845 11.3248C2.05889 10.0559 1.92137 8.65961 2.18932 7.31252C2.45727 5.96543 3.11867 4.72805 4.08986 3.75685C5.06106 2.78566 6.29844 2.12426 7.64553 1.85631C8.99262 1.58836 10.3889 1.72588 11.6579 2.25149C12.9268 2.7771 14.0114 3.66718 14.7744 4.80919C15.5375 5.9512 15.9448 7.29383 15.9448 8.66732C15.9427 10.5085 15.2105 12.2736 13.9086 13.5755C12.6067 14.8774 10.8415 15.6097 9.00033 15.6118Z" fill="#2580D3" />
                            <path d="M9.00022 7.2793H8.30577C8.12159 7.2793 7.94496 7.35246 7.81473 7.4827C7.68449 7.61293 7.61133 7.78956 7.61133 7.97374C7.61133 8.15792 7.68449 8.33455 7.81473 8.46479C7.94496 8.59502 8.12159 8.66819 8.30577 8.66819H9.00022V12.8349C9.00022 13.019 9.07338 13.1957 9.20361 13.3259C9.33385 13.4561 9.51048 13.5293 9.69466 13.5293C9.87884 13.5293 10.0555 13.4561 10.1857 13.3259C10.3159 13.1957 10.3891 13.019 10.3891 12.8349V8.66819C10.3891 8.29983 10.2428 7.94656 9.98231 7.68609C9.72184 7.42563 9.36857 7.2793 9.00022 7.2793Z" fill="#2580D3" />
                            <path d="M9.00065 5.88802C9.57595 5.88802 10.0423 5.42165 10.0423 4.84635C10.0423 4.27106 9.57595 3.80469 9.00065 3.80469C8.42535 3.80469 7.95898 4.27106 7.95898 4.84635C7.95898 5.42165 8.42535 5.88802 9.00065 5.88802Z" fill="#2580D3" />
                        </svg>
                    </span>
                    <text id="warningTopic"></text>
                </div>
                <p class="fs-16 fw-300" id="warningDetail">

                </p>
                <div class="text-end mt-3">
                    <button class="btn btn-primary" data-bs-dismiss="modal">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9347 3.77076C13.4565 2.20538 12.2914 0.588867 10.6413 0.588867C9.86065 0.588867 9.12789 0.965901 8.67416 1.60119L4.70728 7.15478H1.43799L0.5 8.09277V17.4727L1.43799 18.4106H15.1497L18.0307 12.6486C18.8862 10.9376 18.5508 8.87118 17.1982 7.51847C16.3647 6.68503 15.2343 6.2168 14.0556 6.2168H12.1193L12.9347 3.77076ZM6.12797 8.39343L10.2007 2.69159C10.3024 2.5493 10.4665 2.46484 10.6413 2.46484C11.0109 2.46484 11.2719 2.82692 11.1549 3.17751L9.51659 8.09277H14.0556C14.7368 8.09277 15.39 8.36341 15.8717 8.84504C16.6534 9.6267 16.8472 10.8209 16.3528 11.8097L13.9903 16.5347H6.12797V8.39343ZM4.25199 16.5347H2.37598V9.03076H4.25199V16.5347Z" fill="white" />
                        </svg>
                        Great!
                    </button>
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
        getBranchDetail();
        getMajor();
        getBreakdown();
        getData(1);

        $("#fileImport").change(function(e) {
            let fileInput = $(this)[0].files;

            if (fileInput.length > 0) {
                let fileName = fileInput[0].name;
                let fileExt = fileName.split('.').pop().toLowerCase(); // ดึงนามสกุลไฟล์

                if (fileExt === "xlsx") {
                    $("#fileNameDisplay").html(fileName); // แสดงชื่อไฟล์สีเขียวถ้าถูกต้อง
                    $("#boxFileImport").show();
                } else {
                    alert('กรุณาเลือกไฟล์ .xlsx เท่านั้น!');
                    $(this).val(""); // ล้างค่า input เพื่อบังคับให้เลือกใหม่
                    $("#boxFileImport").hide();
                }
            } else {
                $("#fileNameDisplay").html(""); // ล้างชื่อไฟล์ถ้าไม่มีการเลือก
                $("#boxFileImport").hide();
            }
        }).trigger('change');

        $("#btnRemoveFileImport").click(function(e) {
            $("#fileImport").val('').trigger('change');
        });

    });

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

    function getMajor() {
        $.ajax({
            url: 'ajax/FinancialConfiguration/getMajor.php',
            type: 'POST',
            dataType: 'html',
            data: {},
            success: function(data) {
                Swal.close();
                $('#MajorId').html(data);
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

    function getMedium(element) {
        let MajorId = '';
        if (element == 'MediumId') {
            MajorId = $('#MajorId').val();
        } else {
            MajorId = $('#pl_major_id').val();
        }

        $.ajax({
            url: 'ajax/FinancialConfiguration/getMedium.php',
            type: 'POST',
            dataType: 'html',
            data: {
                MajorId: MajorId,
                element: element
            },
            success: function(data) {
                Swal.close();
                $('#' + element).html(data);
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
            url: 'ajax/FinancialConfiguration/getBreakdown.php',
            type: 'POST',
            dataType: 'html',
            data: {},
            success: function(data) {
                Swal.close();
                $('#BreakdownId').html(data);
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

    function getData(page) {

        let MajorId = $('#MajorId').val();
        let MediumId = $('#MediumId').val();
        let BreakdownId = $('#BreakdownId').val();

        $.ajax({
            url: 'ajax/FinancialConfiguration/getData.php',
            type: 'POST',
            dataType: 'html',
            data: {
                MajorId: MajorId,
                MediumId: MediumId,
                BreakdownId: BreakdownId,
                page: page,
                branchId: branchId
            },
            success: function(data) {
                Swal.close();
                $('#showData').html(data);

                let countConfig = $('#countConfig').val();
                if (countConfig == '0') {
                    $('#exportButton').hide();
                } else {
                    $('#exportButton').show();
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

    function getModalCreate() {
        $.ajax({
            url: 'ajax/FinancialConfiguration/getModalCreate.php',
            type: 'POST',
            dataType: 'html',
            data: {
                branchId: branchId
            },
            success: function(data) {
                Swal.close();
                $('#showModalConfiguration').html(data);
                $('#modalConfiguration').modal("show");
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

    function createConfiguration() {
        let accountName = $('#accountName').val();
        let accountCode = $('#accountCode').val();
        let pl_major_id = $('#pl_major_id').val();
        let pl_medium_id = $('#pl_medium_id').val();
        let pl_breakdown_id = $('#pl_breakdown_id').val();

        if (accountName == '') {
            $('#warningTopic').html(`Enter Account Name`);
            $('#warningDetail').html(`If your company isn't listed in the <span class="text-primary text-decoration-underline fw-400">Group Management</span> Module for financial configuration, please ensure it's registered under the group to proceed seamlessly`);
            $("#warningModal").modal("show");
            return false;
        }

        if (accountCode == '') {
            $('#warningTopic').html(`Enter Account Code`);
            $('#warningDetail').html(`If your company isn't listed in the <span class="text-primary text-decoration-underline fw-400">Group Management</span> Module for financial configuration, please ensure it's registered under the group to proceed seamlessly`);
            $("#warningModal").modal("show");
            return false;
        }

        if (pl_major_id == null || pl_medium_id == null || pl_breakdown_id == null) {
            $('#warningTopic').html(`Chose Accounts Flow`);
            $('#warningDetail').html(`If your company isn't listed in the <span class="text-primary text-decoration-underline fw-400">Group Management</span> Module for financial configuration, please ensure it's registered under the group to proceed seamlessly`);
            $("#warningModal").modal("show");
            return false;
        }

        let formData = new FormData($("#formCreate")[0]);
        formData.append('branchId', branchId)

        customAlert({
            title: "Warning",
            message: "Do you want to save?",
            icon: "warning",
            confirmText: "Save",
            confirmColor: "btn-primary",
            cancelText: "Cancel",
            cancelColor: "btn-outline-secondary"
        }).then(() => {
            $.ajax({
                url: 'ajax/FinancialConfiguration/createConfigurationAccount.php',
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

    function getModalEdit(account_id) {
        $.ajax({
            url: 'ajax/FinancialConfiguration/getModalEdit.php',
            type: 'POST',
            dataType: 'html',
            data: {
                branchId: branchId,
                account_id: account_id
            },
            success: function(data) {
                Swal.close();
                $('#showModalConfiguration').html(data);
                $('#modalConfiguration').modal("show");
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

    function editConfiguration() {
        let accountName = $('#accountName').val();
        let accountCode = $('#accountCode').val();
        let pl_major_id = $('#pl_major_id').val();
        let pl_medium_id = $('#pl_medium_id').val();
        let pl_breakdown_id = $('#pl_breakdown_id').val();

        if (accountName == '') {
            $('#warningTopic').html(`Enter Account Name`);
            $('#warningDetail').html(`If your company isn't listed in the <span class="text-primary text-decoration-underline fw-400">Group Management</span> Module for financial configuration, please ensure it's registered under the group to proceed seamlessly`);
            $("#warningModal").modal("show");
            return false;
        }

        if (accountCode == '') {
            $('#warningTopic').html(`Enter Account Code`);
            $('#warningDetail').html(`If your company isn't listed in the <span class="text-primary text-decoration-underline fw-400">Group Management</span> Module for financial configuration, please ensure it's registered under the group to proceed seamlessly`);
            $("#warningModal").modal("show");
            return false;
        }

        if (pl_major_id == null || pl_medium_id == null || pl_breakdown_id == null) {
            $('#warningTopic').html(`Chose Accounts Flow`);
            $('#warningDetail').html(`If your company isn't listed in the <span class="text-primary text-decoration-underline fw-400">Group Management</span> Module for financial configuration, please ensure it's registered under the group to proceed seamlessly`);
            $("#warningModal").modal("show");
            return false;
        }

        let formData = new FormData($("#formEdit")[0]);
        formData.append('branchId', branchId)

        customAlert({
            title: "Warning",
            message: "Do you want to save?",
            icon: "warning",
            confirmText: "Save",
            confirmColor: "btn-primary",
            cancelText: "Cancel",
            cancelColor: "btn-outline-secondary"
        }).then(() => {
            $.ajax({
                url: 'ajax/FinancialConfiguration/editConfigurationAccount.php',
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

    function deleteConfigurationAccount(account_id) {

        Swal.fire({
            icon: 'question',
            title: "Do you want to delete this Configuration Account ?",
            showCancelButton: true,
            confirmButtonText: "Yes",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'ajax/FinancialConfiguration/deleteConfigurationAccount.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        account_id: account_id
                    },
                    success: function(response) {
                        if (response.result == 1) {
                            customAlert({
                                title: "Success!",
                                message: "Your action was successful.",
                                icon: "success",
                                timer: 1500
                            }).then(() => {
                                $('#acc_' + account_id).remove();
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

    $.extend({
        redirectPost: function(location, args) {
            var form = '';
            $.each(args, function(key, value) {
                form += '<input type="hidden" name="' + key + '" value="' + value + '">';
            });
            $('<form action="' + location + '" method="POST">' + form + '</form>').appendTo('body')
                .submit();
        }
    });

    function exportExcel() {

        let MajorId = $('#MajorId').val();
        let MediumId = $('#MediumId').val();
        let BreakdownId = $('#BreakdownId').val();
        var redirect = 'ajax/FinancialConfiguration/exportExcel.php';

        $.redirectPost(redirect, {

            branchId: branchId,
            MajorId: MajorId,
            MediumId: MediumId,
            BreakdownId: BreakdownId,

        });
    }

    function importData() {
        let excelFile = $('#fileImport').val();

        if (excelFile == '') {
            alert('please upload excel file!!')
            return false;
        }

        let formData = new FormData($("#formImport")[0]);
        formData.append('branchId', branchId)
        customAlert({
            title: "Warning",
            message: "Do you want to save?",
            icon: "warning",
            confirmText: "Save",
            confirmColor: "btn-primary",
            cancelText: "Cancel",
            cancelColor: "btn-outline-secondary"
        }).then(() => {
            $.ajax({
                url: 'ajax/FinancialConfiguration/importData.php',
                type: 'POST',
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.result == 0) {
                        Swal.fire({
                            icon: "error",
                            title: "An error occurred !",
                            text: "Please check the file.",
                            showConfirmButton: false,
                            timer: 1500
                        }).then((data) => {
                            window.open("ajax/FinancialConfiguration/ErrorFiles.xlsx", '_blank');
                        });
                    } else if (response.result == 1) {
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