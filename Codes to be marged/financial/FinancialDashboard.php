<?php include __DIR__ . "/header.php"; ?>

<div class="wrapper-content">
    <h1 class="page-title" style="cursor: pointer;" onclick="location.href = 'FinancialDashboard'">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16.5 0C12.294 0 9 1.977 9 4.5V7.087C8.517 7.03 8.015 7 7.5 7C3.294 7 0 8.977 0 11.5V19.5C0 22.023 3.294 24 7.5 24C10.907 24 13.716 22.703 14.66 20.869C15.258 20.956 15.874 21 16.5 21C20.706 21 24 19.023 24 16.5V4.5C24 1.977 20.706 0 16.5 0ZM22 12.5C22 13.68 19.648 15 16.5 15C15.988 15 15.486 14.965 15 14.897V12.913C15.49 12.97 15.992 13 16.5 13C18.694 13 20.64 12.462 22 11.589V12.5ZM2 14.589C3.36 15.462 5.306 16 7.5 16C9.694 16 11.64 15.462 13 14.589V15.5C13 16.68 10.648 18 7.5 18C4.352 18 2 16.68 2 15.5V14.589ZM22 8.5C22 9.68 19.648 11 16.5 11C15.965 11 15.44 10.962 14.934 10.888C14.741 10.001 14.134 9.204 13.228 8.565C14.212 8.845 15.32 9 16.5 9C18.694 9 20.64 8.462 22 7.589V8.5ZM16.5 2C19.648 2 22 3.32 22 4.5C22 5.68 19.648 7 16.5 7C13.352 7 11 5.68 11 4.5C11 3.32 13.352 2 16.5 2ZM7.5 9C10.648 9 13 10.32 13 11.5C13 12.68 10.648 14 7.5 14C4.352 14 2 12.68 2 11.5C2 10.32 4.352 9 7.5 9ZM7.5 22C4.352 22 2 20.68 2 19.5V18.589C3.36 19.462 5.306 20 7.5 20C9.694 20 11.64 19.462 13 18.589V19.5C13 20.68 10.648 22 7.5 22ZM16.5 19C15.988 19 15.486 18.965 15 18.897V16.913C15.49 16.97 15.992 17 16.5 17C18.694 17 20.64 16.462 22 15.589V16.5C22 17.68 19.648 19 16.5 19Z" fill="#30313D" />
        </svg>
        Financial Planning
    </h1>

    <div class="mt-15">
        <div class="row">
            <div class="mb-3 col-lg-4 col-12">
                <div class="border-0 card" id="showCompanyGroup" style="height: 240px;">
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
                <div class="border-0 card" style="height: 240px;">
                    <div class="card-body">
                        <div class="mb-2 d-flex align-items-center justify-content-between">
                            <div class="">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.5004 2.6624V5.2499C16.5004 5.44881 16.4214 5.63958 16.2808 5.78023C16.1401 5.92088 15.9494 5.9999 15.7504 5.9999H13.1254C13.0167 6.00113 12.909 5.97871 12.8098 5.93419C12.7107 5.88968 12.6223 5.82412 12.551 5.74208C12.4797 5.66004 12.427 5.56347 12.3967 5.45906C12.3664 5.35464 12.3591 5.24489 12.3754 5.1374C12.4107 4.95546 12.509 4.79179 12.6531 4.67519C12.7971 4.55858 12.9776 4.49651 13.1629 4.4999H14.0254C13.1519 3.52707 12.0146 2.82888 10.7517 2.49017C9.48886 2.15146 8.15482 2.18681 6.91168 2.59192C5.66853 2.99704 4.5698 3.75448 3.74899 4.77221C2.92817 5.78994 2.4206 7.02416 2.28794 8.3249C2.26928 8.51054 2.1821 8.68257 2.04342 8.80738C1.90474 8.93219 1.72452 9.00084 1.53794 8.9999C1.43281 9.00043 1.32874 8.97884 1.23248 8.93655C1.13623 8.89426 1.04995 8.83221 0.979225 8.75441C0.908504 8.67662 0.854928 8.58483 0.821975 8.48499C0.789021 8.38516 0.777425 8.27951 0.78794 8.1749C0.945454 6.60032 1.55249 5.10426 2.53667 3.86511C3.52085 2.62595 4.84064 1.69599 6.33868 1.1861C7.83673 0.676212 9.4498 0.607915 10.9856 0.989353C12.5214 1.37079 13.915 2.18587 15.0004 3.3374V2.6249C14.9992 2.51618 15.0216 2.4085 15.0661 2.30931C15.1107 2.21012 15.1762 2.12179 15.2583 2.05045C15.3403 1.97911 15.4369 1.92646 15.5413 1.89615C15.6457 1.86583 15.7554 1.85858 15.8629 1.8749C16.0449 1.91017 16.2085 2.00847 16.3252 2.15251C16.4418 2.29656 16.5038 2.47711 16.5004 2.6624Z" fill="#2580D3" />
                                    <path d="M1.50013 15.3375V12.75C1.50013 12.5511 1.57915 12.3603 1.7198 12.2197C1.86045 12.079 2.05122 12 2.25013 12H4.87513C4.98385 11.9988 5.09153 12.0212 5.19072 12.0657C5.28991 12.1102 5.37824 12.1758 5.44958 12.2578C5.52092 12.3399 5.57357 12.4364 5.60388 12.5409C5.6342 12.6453 5.64145 12.755 5.62513 12.8625C5.58986 13.0444 5.49156 13.2081 5.34752 13.3247C5.20348 13.4413 5.02292 13.5034 4.83763 13.5H3.97513C4.8487 14.4728 5.986 15.171 7.24885 15.5097C8.51171 15.8484 9.84575 15.8131 11.0889 15.408C12.332 15.0029 13.4308 14.2454 14.2516 13.2277C15.0724 12.21 15.58 10.9757 15.7126 9.67501C15.7313 9.48937 15.8185 9.31734 15.9571 9.19253C16.0958 9.06772 16.2761 8.99907 16.4626 9.00001C16.5678 8.99948 16.6718 9.02106 16.7681 9.06336C16.8643 9.10565 16.9506 9.1677 17.0213 9.2455C17.0921 9.32329 17.1456 9.41508 17.1786 9.51492C17.2116 9.61475 17.2231 9.7204 17.2126 9.82501C17.0551 11.3996 16.4481 12.8956 15.4639 14.1348C14.4797 15.374 13.1599 16.3039 11.6619 16.8138C10.1638 17.3237 8.55077 17.392 7.01499 17.0106C5.47921 16.6291 4.08553 15.814 3.00013 14.6625V15.375C3.00136 15.4837 2.97894 15.5914 2.93442 15.6906C2.88991 15.7898 2.82436 15.8781 2.74231 15.9495C2.66027 16.0208 2.5637 16.0734 2.45929 16.1038C2.35488 16.1341 2.24512 16.1413 2.13763 16.125C1.95569 16.0897 1.79203 15.9914 1.67542 15.8474C1.55881 15.7034 1.49674 15.5228 1.50013 15.3375Z" fill="#2580D3" />
                                    <path d="M9.26302 8.25C7.95052 7.9875 7.95052 7.7625 7.95052 7.575C7.95052 7.3875 8.02552 7.35 8.13802 7.2375C8.34491 7.12628 8.5785 7.07437 8.81302 7.0875C9.24875 7.08372 9.67704 7.20053 10.0505 7.425C10.1264 7.48695 10.2149 7.53163 10.3099 7.55593C10.4048 7.58024 10.5038 7.58359 10.6002 7.56575C10.6965 7.5479 10.7878 7.5093 10.8678 7.45262C10.9477 7.39593 11.0143 7.32253 11.063 7.2375C11.1273 7.16082 11.1747 7.07145 11.2022 6.97523C11.2296 6.87901 11.2365 6.77808 11.2223 6.67903C11.2082 6.57997 11.1733 6.48501 11.12 6.40032C11.0667 6.31563 10.9962 6.24312 10.913 6.1875C10.5564 5.9674 10.1624 5.81485 9.75052 5.7375V4.875C9.75052 4.67609 9.6715 4.48532 9.53085 4.34467C9.3902 4.20402 9.19943 4.125 9.00052 4.125C8.80161 4.125 8.61084 4.20402 8.47019 4.34467C8.32954 4.48532 8.25052 4.67609 8.25052 4.875V5.7C7.12552 5.8875 6.37552 6.6375 6.37552 7.65C6.37552 8.6625 7.61302 9.4875 8.81302 9.7125C10.013 9.9375 10.0505 10.2 10.0505 10.3875C10.0505 10.575 9.63802 10.9125 9.11302 10.9125C8.56087 10.9234 8.02052 10.7521 7.57552 10.425C7.49219 10.3696 7.39862 10.3314 7.30031 10.3127C7.202 10.294 7.10094 10.2952 7.0031 10.3162C6.90525 10.3372 6.81259 10.3775 6.73057 10.4348C6.64855 10.4921 6.57883 10.5653 6.52552 10.65C6.46639 10.7203 6.42224 10.802 6.39578 10.89C6.36932 10.978 6.3611 11.0705 6.37164 11.1617C6.38217 11.253 6.41123 11.3412 6.45703 11.4209C6.50284 11.5005 6.56443 11.57 6.63802 11.625C7.12056 11.9636 7.67064 12.1939 8.25052 12.3V13.125C8.25052 13.3239 8.32954 13.5147 8.47019 13.6553C8.61084 13.796 8.80161 13.875 9.00052 13.875C9.19943 13.875 9.3902 13.796 9.53085 13.6553C9.6715 13.5147 9.75052 13.3239 9.75052 13.125V12.3C10.1619 12.2393 10.55 12.0712 10.8755 11.8125C11.1106 11.6399 11.3012 11.4139 11.4316 11.1531C11.562 10.8922 11.6285 10.6041 11.6255 10.3125C11.6255 8.925 10.3505 8.475 9.26302 8.25Z" fill="#2580D3" />
                                </svg>
                                <span class="text-primary">Currency Management</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm btn-blue fs-13" onclick="window.location.href='CurrencyManagement';">
                                    Manage
                                    <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 3.3335H9M9 3.3335C9 4.43807 9.8954 5.3335 11 5.3335C12.1046 5.3335 13 4.43806 13 3.3335C13 2.22893 12.1046 1.3335 11 1.3335C9.8954 1.3335 9 2.22893 9 3.3335ZM5 8.66683H13M5 8.66683C5 9.77143 4.10457 10.6668 3 10.6668C1.89543 10.6668 1 9.77143 1 8.66683C1 7.56223 1.89543 6.66683 3 6.66683C4.10457 6.66683 5 7.56223 5 8.66683Z" stroke="#2580D3" stroke-width="1.57143" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                </button>
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
                                <div class="me-2 fs-20">Financial Configurations</div>
                                <button class="btn btn-primary btn-sm fs-14" onclick="getModalCreate();">Create Financial profile <i class="bi bi-plus-circle"></i></button>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="position-relative me-2">
                                    <input type="text" class="form-control form-control-sm rounded-pill ps-5" id="searchText" name="searchText" placeholder="Search Company Here">
                                    <a class="filter-search" onclick="getData(1);" style="left: 5%;right:auto;"><i class="bi bi-search"></i></a>
                                </div>
                                <input type="checkbox" style="display: none;" id="checkFilter" name="checkFilter" value="1">
                                <button class="btn btn-outline-primary btn-sm me-2" style="width: 100px;border-radius: 71px;" id="btnFilter"><i class="bi bi-funnel"></i> Filter</button>
                                <button class="btn btn-outline-primary btn-sm active" style="width: 100px;border-radius: 71px;" id="btnShowAll"><i class="bi bi-border-all"></i> Show All</button>
                            </div>
                        </div>
                        <div class="row" id="showData">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-finance-config" id="createFinanceConfig" tabindex="-1" aria-labelledby="createFinanceConfigLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="showModalCreate">
        </div>
    </div>
</div>

<div class="modal fade modal-finance-confirm" id="confirmFinanceConfig" tabindex="-1" aria-labelledby="confirmFinanceConfigLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:494px">
        <div class="modal-content">
            <div class="px-4 modal-body">
                <div class="mb-3 fw-400 fs-20 d-flex align-items-center">
                    <span class="svg-blue-link d-inline-block me-2">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.00033 0.333984C7.35215 0.333984 5.74099 0.822726 4.37058 1.7384C3.00017 2.65408 1.93206 3.95557 1.30133 5.47829C0.670603 7.00101 0.505575 8.67656 0.827119 10.2931C1.14866 11.9096 1.94233 13.3944 3.10777 14.5599C4.27321 15.7253 5.75807 16.519 7.37458 16.8405C8.99108 17.1621 10.6666 16.997 12.1894 16.3663C13.7121 15.7356 15.0136 14.6675 15.9292 13.2971C16.8449 11.9267 17.3337 10.3155 17.3337 8.66732C17.3313 6.45791 16.4525 4.33968 14.8902 2.7774C13.328 1.21511 11.2097 0.336374 9.00033 0.333984ZM9.00033 15.6118C7.62685 15.6118 6.28421 15.2045 5.1422 14.4414C4.00019 13.6783 3.11011 12.5938 2.5845 11.3248C2.05889 10.0559 1.92137 8.65961 2.18932 7.31252C2.45727 5.96543 3.11867 4.72805 4.08986 3.75685C5.06106 2.78566 6.29844 2.12426 7.64553 1.85631C8.99262 1.58836 10.3889 1.72588 11.6579 2.25149C12.9268 2.7771 14.0114 3.66718 14.7744 4.80919C15.5375 5.9512 15.9448 7.29383 15.9448 8.66732C15.9427 10.5085 15.2105 12.2736 13.9086 13.5755C12.6067 14.8774 10.8415 15.6097 9.00033 15.6118Z" fill="#2580D3" />
                            <path d="M9.00022 7.2793H8.30577C8.12159 7.2793 7.94496 7.35246 7.81473 7.4827C7.68449 7.61293 7.61133 7.78956 7.61133 7.97374C7.61133 8.15792 7.68449 8.33455 7.81473 8.46479C7.94496 8.59502 8.12159 8.66819 8.30577 8.66819H9.00022V12.8349C9.00022 13.019 9.07338 13.1957 9.20361 13.3259C9.33385 13.4561 9.51048 13.5293 9.69466 13.5293C9.87884 13.5293 10.0555 13.4561 10.1857 13.3259C10.3159 13.1957 10.3891 13.019 10.3891 12.8349V8.66819C10.3891 8.29983 10.2428 7.94656 9.98231 7.68609C9.72184 7.42563 9.36857 7.2793 9.00022 7.2793Z" fill="#2580D3" />
                            <path d="M9.00065 5.88802C9.57595 5.88802 10.0423 5.42165 10.0423 4.84635C10.0423 4.27106 9.57595 3.80469 9.00065 3.80469C8.42535 3.80469 7.95898 4.27106 7.95898 4.84635C7.95898 5.42165 8.42535 5.88802 9.00065 5.88802Z" fill="#2580D3" />
                        </svg>
                    </span>
                    Select Company
                </div>
                <p class="fs-16 fw-300">
                    If your company isn't listed in the <span class="text-primary text-decoration-underline fw-400">Group Management</span> Module for financial configuration, please ensure it's registered under the group to proceed seamlessly
                </p>
                <div class="mt-3 text-end">
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

<div class="modal fade modal-finance-delete" id="deleteFinanceConfig" tabindex="-1" aria-labelledby="deleteFinanceConfigLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:683px">
        <div class="modal-content">
            <div class="px-4 modal-body">
                <div class="mb-3 fw-400 fs-20 d-flex align-items-center">
                    <span class="me-3">
                        <svg width="28" height="25" viewBox="0 0 28 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.8724 14.2143V7.35714C12.8724 6.72857 13.3789 6.21429 13.998 6.21429C14.6171 6.21429 15.1236 6.72857 15.1236 7.35714V14.2143C15.1236 14.8429 14.6171 15.3571 13.998 15.3571C13.3789 15.3571 12.8724 14.8429 12.8724 14.2143ZM13.998 16.5C13.0638 16.5 12.3096 17.2657 12.3096 18.2143C12.3096 19.1629 13.0638 19.9286 13.998 19.9286C14.9323 19.9286 15.6865 19.1629 15.6865 18.2143C15.6865 17.2657 14.9323 16.5 13.998 16.5ZM27.0327 22.0771C26.2448 23.62 24.5901 24.5 22.519 24.5H5.48831C3.40591 24.5 1.7625 23.62 0.974566 22.0771C0.175374 20.5229 0.400499 18.5343 1.53738 16.8657L10.5874 2.32857C11.3866 1.16286 12.6473 0.5 13.998 0.5C15.3488 0.5 16.6095 1.16286 17.3749 2.29429L26.4699 16.8886C27.6068 18.5571 27.8207 20.5343 27.0215 22.0771H27.0327ZM24.6126 18.1686C24.6126 18.1686 24.5901 18.1457 24.5901 18.1229L15.5064 3.55143C15.1799 3.08286 14.6171 2.78571 13.998 2.78571C13.3789 2.78571 12.8161 3.08286 12.4672 3.59714L3.40591 18.1229C2.70802 19.1286 2.55044 20.2257 2.95566 21.0143C3.34963 21.7914 4.25013 22.2143 5.47706 22.2143H22.4965C23.7234 22.2143 24.6239 21.7914 25.0179 21.0143C25.4231 20.2257 25.2655 19.1286 24.6014 18.1686H24.6126Z" fill="#FFCD29" />
                        </svg>
                    </span>
                    Deletion Warning
                </div>
                <p class="fs-16 fw-300">Deleting the Financial Configuration will permanently remove all related data from PL Portal, Golden Ratio, and Future Accounts, including all stored history. This action cannot be undone. Please confirm if you wish to proceed.</p>
                <div class="mt-3 text-end">
                    <button class="btn btn-primary" data-bs-dismiss="modal">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9347 3.77076C13.4565 2.20538 12.2914 0.588867 10.6413 0.588867C9.86065 0.588867 9.12789 0.965901 8.67416 1.60119L4.70728 7.15478H1.43799L0.5 8.09277V17.4727L1.43799 18.4106H15.1497L18.0307 12.6486C18.8862 10.9376 18.5508 8.87118 17.1982 7.51847C16.3647 6.68503 15.2343 6.2168 14.0556 6.2168H12.1193L12.9347 3.77076ZM6.12797 8.39343L10.2007 2.69159C10.3024 2.5493 10.4665 2.46484 10.6413 2.46484C11.0109 2.46484 11.2719 2.82692 11.1549 3.17751L9.51659 8.09277H14.0556C14.7368 8.09277 15.39 8.36341 15.8717 8.84504C16.6534 9.6267 16.8472 10.8209 16.3528 11.8097L13.9903 16.5347H6.12797V8.39343ZM4.25199 16.5347H2.37598V9.03076H4.25199V16.5347Z" fill="white" />
                        </svg>
                        Cancel
                    </button>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                        <i class="bi bi-trash"></i>
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="popup-filter" id="popupFilter">
    <form id="form_filer">
        <div class="popup-filter-content">
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <img src="../asset/images/filter.png" alt="" width="24">
                    <div class="fs-24 ps-2">Filter</div>
                </div>
                <div class="" onclick="$('#popupFilter').removeClass('active')">
                    <img src="../asset/images/close-circle.png" class="popup-filter-close" alt="">
                </div>
            </div>
            <div class="my-3 fs-16">Sort the companies based on the status in specific critera</div>
            <table class="table">
                <tbody>
                    <tr>
                        <td class="py-4">
                            <span class="label-title label-red me-2">LP</span>
                            Last Year’s Performance
                        </td>
                        <td class="py-4">
                            <label class="container-checkbox">
                                <span class="badge rounded-pill dd-bg-blue">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 12 13" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.15095 4.29244L8.85295 5.00494L5.95645 7.85844C5.76295 8.05194 5.50845 8.14844 5.25295 8.14844C4.99745 8.14844 4.74045 8.05094 4.54495 7.85594L3.15395 6.50794L3.85045 5.78944L5.24695 7.14294L8.15095 4.29244ZM12.002 6.14844C12.002 9.45694 9.31045 12.1484 6.00195 12.1484C2.69345 12.1484 0.00195312 9.45694 0.00195312 6.14844C0.00195312 2.83994 2.69345 0.148438 6.00195 0.148438C9.31045 0.148438 12.002 2.83994 12.002 6.14844ZM11.002 6.14844C11.002 3.39144 8.75895 1.14844 6.00195 1.14844C3.24495 1.14844 1.00195 3.39144 1.00195 6.14844C1.00195 8.90544 3.24495 11.1484 6.00195 11.1484C8.75895 11.1484 11.002 8.90544 11.002 6.14844Z" />
                                    </svg>
                                    Done
                                </span>
                                <input type="checkbox" id="ly_done" name="ly_done" value="1" checked onchange="getData(1);">
                                <span class="checkbox-checkmark"></span>
                            </label>
                        </td>
                        <td class="py-4">
                            <label class="container-checkbox">
                                <span class="badge rounded-pill dd-bg-green">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 12 13" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M1.202 6.14868C1.202 8.79517 3.35489 10.9485 6.00219 10.9485C7.30545 10.9485 8.50789 10.4253 9.39173 9.53794L7.80227 7.9486H11.4024V11.5485L10.2396 10.3851C9.13432 11.4951 7.63125 12.1484 6.00219 12.1484C2.69306 12.1484 0.00195312 9.45694 0.00195312 6.14868H1.202ZM6.00171 0.148438C9.31085 0.148438 12.002 2.83993 12.002 6.1482H10.8019C10.8019 3.5017 8.64902 1.34839 6.00171 1.34839C4.69846 1.34839 3.49602 1.87157 2.61218 2.75893L4.20164 4.34827H0.601503V0.748415L1.76434 1.91116C2.86959 0.801815 4.37265 0.148438 6.00171 0.148438Z" />
                                    </svg>
                                    In Progress
                                </span>
                                <input type="checkbox" id="ly_progress" name="ly_progress" value="2" checked onchange="getData(1);">
                                <span class="checkbox-checkmark"></span>
                            </label>
                        </td>
                        <td class="py-4">
                            <label class="container-checkbox">
                                <span class="badge rounded-pill dd-bg-yellow">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 12 13" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0)">
                                            <path d="M5.50166 6.64844V3.64844C5.50166 3.37344 5.72666 3.14844 6.00166 3.14844C6.27666 3.14844 6.50166 3.37344 6.50166 3.64844V6.64844C6.50166 6.92344 6.27666 7.14844 6.00166 7.14844C5.72666 7.14844 5.50166 6.92344 5.50166 6.64844ZM6.00166 7.64844C5.58666 7.64844 5.25166 7.98344 5.25166 8.39844C5.25166 8.81344 5.58666 9.14844 6.00166 9.14844C6.41666 9.14844 6.75166 8.81344 6.75166 8.39844C6.75166 7.98344 6.41666 7.64844 6.00166 7.64844ZM11.7917 10.0884C11.4417 10.7634 10.7067 11.1484 9.78666 11.1484H2.22166C1.29666 11.1484 0.566661 10.7634 0.216661 10.0884C-0.138339 9.40844 -0.0383389 8.53844 0.466661 7.80844L4.48666 1.44844C4.84166 0.938437 5.40166 0.648438 6.00166 0.648438C6.60166 0.648438 7.16166 0.938437 7.50166 1.43344L11.5417 7.81844C12.0467 8.54844 12.1417 9.41344 11.7867 10.0884H11.7917Z" />
                                        </g>
                                    </svg>
                                    Not Yet
                                </span>
                                <input type="checkbox" id="ly_yet" name="ly_yet" value="0" checked onchange="getData(1);">
                                <span class="checkbox-checkmark"></span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-4">
                            <span class="label-title label-green me-2">CP</span>
                            Current Progress
                        </td>
                        <td class="py-4">
                            <label class="container-checkbox">
                                <span class="badge rounded-pill dd-bg-blue">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 12 13" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.15095 4.29244L8.85295 5.00494L5.95645 7.85844C5.76295 8.05194 5.50845 8.14844 5.25295 8.14844C4.99745 8.14844 4.74045 8.05094 4.54495 7.85594L3.15395 6.50794L3.85045 5.78944L5.24695 7.14294L8.15095 4.29244ZM12.002 6.14844C12.002 9.45694 9.31045 12.1484 6.00195 12.1484C2.69345 12.1484 0.00195312 9.45694 0.00195312 6.14844C0.00195312 2.83994 2.69345 0.148438 6.00195 0.148438C9.31045 0.148438 12.002 2.83994 12.002 6.14844ZM11.002 6.14844C11.002 3.39144 8.75895 1.14844 6.00195 1.14844C3.24495 1.14844 1.00195 3.39144 1.00195 6.14844C1.00195 8.90544 3.24495 11.1484 6.00195 11.1484C8.75895 11.1484 11.002 8.90544 11.002 6.14844Z" />
                                    </svg>
                                    Done
                                </span>
                                <input type="checkbox" id="cp_done" name="cp_done" value="1" checked onchange="getData(1);">
                                <span class="checkbox-checkmark"></span>
                            </label>
                        </td>
                        <td class="py-4">
                            <label class="container-checkbox">
                                <span class="badge rounded-pill dd-bg-green">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 12 13" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M1.202 6.14868C1.202 8.79517 3.35489 10.9485 6.00219 10.9485C7.30545 10.9485 8.50789 10.4253 9.39173 9.53794L7.80227 7.9486H11.4024V11.5485L10.2396 10.3851C9.13432 11.4951 7.63125 12.1484 6.00219 12.1484C2.69306 12.1484 0.00195312 9.45694 0.00195312 6.14868H1.202ZM6.00171 0.148438C9.31085 0.148438 12.002 2.83993 12.002 6.1482H10.8019C10.8019 3.5017 8.64902 1.34839 6.00171 1.34839C4.69846 1.34839 3.49602 1.87157 2.61218 2.75893L4.20164 4.34827H0.601503V0.748415L1.76434 1.91116C2.86959 0.801815 4.37265 0.148438 6.00171 0.148438Z" />
                                    </svg>
                                    In Progress
                                </span>
                                <input type="checkbox" id="cp_progress" name="cp_progress" value="2" checked onchange="getData(1);">
                                <span class="checkbox-checkmark"></span>
                            </label>
                        </td>
                        <td class="py-4">
                            <label class="container-checkbox">
                                <span class="badge rounded-pill dd-bg-yellow">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 12 13" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0)">
                                            <path d="M5.50166 6.64844V3.64844C5.50166 3.37344 5.72666 3.14844 6.00166 3.14844C6.27666 3.14844 6.50166 3.37344 6.50166 3.64844V6.64844C6.50166 6.92344 6.27666 7.14844 6.00166 7.14844C5.72666 7.14844 5.50166 6.92344 5.50166 6.64844ZM6.00166 7.64844C5.58666 7.64844 5.25166 7.98344 5.25166 8.39844C5.25166 8.81344 5.58666 9.14844 6.00166 9.14844C6.41666 9.14844 6.75166 8.81344 6.75166 8.39844C6.75166 7.98344 6.41666 7.64844 6.00166 7.64844ZM11.7917 10.0884C11.4417 10.7634 10.7067 11.1484 9.78666 11.1484H2.22166C1.29666 11.1484 0.566661 10.7634 0.216661 10.0884C-0.138339 9.40844 -0.0383389 8.53844 0.466661 7.80844L4.48666 1.44844C4.84166 0.938437 5.40166 0.648438 6.00166 0.648438C6.60166 0.648438 7.16166 0.938437 7.50166 1.43344L11.5417 7.81844C12.0467 8.54844 12.1417 9.41344 11.7867 10.0884H11.7917Z" />
                                        </g>
                                    </svg>
                                    Not Yet
                                </span>
                                <input type="checkbox" id="cp_yet" name="cp_yet" value="0" checked onchange="getData(1);">
                                <span class="checkbox-checkmark"></span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-4">
                            <span class="label-title label-yellow me-2">CT</span>
                            Current Year Target
                        </td>
                        <td class="py-4">
                            <label class="container-checkbox">
                                <span class="badge rounded-pill dd-bg-blue">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 12 13" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.15095 4.29244L8.85295 5.00494L5.95645 7.85844C5.76295 8.05194 5.50845 8.14844 5.25295 8.14844C4.99745 8.14844 4.74045 8.05094 4.54495 7.85594L3.15395 6.50794L3.85045 5.78944L5.24695 7.14294L8.15095 4.29244ZM12.002 6.14844C12.002 9.45694 9.31045 12.1484 6.00195 12.1484C2.69345 12.1484 0.00195312 9.45694 0.00195312 6.14844C0.00195312 2.83994 2.69345 0.148438 6.00195 0.148438C9.31045 0.148438 12.002 2.83994 12.002 6.14844ZM11.002 6.14844C11.002 3.39144 8.75895 1.14844 6.00195 1.14844C3.24495 1.14844 1.00195 3.39144 1.00195 6.14844C1.00195 8.90544 3.24495 11.1484 6.00195 11.1484C8.75895 11.1484 11.002 8.90544 11.002 6.14844Z" />
                                    </svg>
                                    Done
                                </span>
                                <input type="checkbox" id="cpt_done" name="cpt_done" value="1" checked onchange="getData(1);">
                                <span class="checkbox-checkmark"></span>
                            </label>
                        </td>
                        <td class="py-4">
                            <label class="container-checkbox">
                                <span class="badge rounded-pill dd-bg-green">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 12 13" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M1.202 6.14868C1.202 8.79517 3.35489 10.9485 6.00219 10.9485C7.30545 10.9485 8.50789 10.4253 9.39173 9.53794L7.80227 7.9486H11.4024V11.5485L10.2396 10.3851C9.13432 11.4951 7.63125 12.1484 6.00219 12.1484C2.69306 12.1484 0.00195312 9.45694 0.00195312 6.14868H1.202ZM6.00171 0.148438C9.31085 0.148438 12.002 2.83993 12.002 6.1482H10.8019C10.8019 3.5017 8.64902 1.34839 6.00171 1.34839C4.69846 1.34839 3.49602 1.87157 2.61218 2.75893L4.20164 4.34827H0.601503V0.748415L1.76434 1.91116C2.86959 0.801815 4.37265 0.148438 6.00171 0.148438Z" />
                                    </svg>
                                    In Progress
                                </span>
                                <input type="checkbox" id="cpt_progress" name="cpt_progress" value="2" checked onchange="getData(1);">
                                <span class="checkbox-checkmark"></span>
                            </label>
                        </td>
                        <td class="py-4">
                            <label class="container-checkbox">
                                <span class="badge rounded-pill dd-bg-yellow">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 12 13" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0)">
                                            <path d="M5.50166 6.64844V3.64844C5.50166 3.37344 5.72666 3.14844 6.00166 3.14844C6.27666 3.14844 6.50166 3.37344 6.50166 3.64844V6.64844C6.50166 6.92344 6.27666 7.14844 6.00166 7.14844C5.72666 7.14844 5.50166 6.92344 5.50166 6.64844ZM6.00166 7.64844C5.58666 7.64844 5.25166 7.98344 5.25166 8.39844C5.25166 8.81344 5.58666 9.14844 6.00166 9.14844C6.41666 9.14844 6.75166 8.81344 6.75166 8.39844C6.75166 7.98344 6.41666 7.64844 6.00166 7.64844ZM11.7917 10.0884C11.4417 10.7634 10.7067 11.1484 9.78666 11.1484H2.22166C1.29666 11.1484 0.566661 10.7634 0.216661 10.0884C-0.138339 9.40844 -0.0383389 8.53844 0.466661 7.80844L4.48666 1.44844C4.84166 0.938437 5.40166 0.648438 6.00166 0.648438C6.60166 0.648438 7.16166 0.938437 7.50166 1.43344L11.5417 7.81844C12.0467 8.54844 12.1417 9.41344 11.7867 10.0884H11.7917Z" />
                                        </g>
                                    </svg>
                                    Not Yet
                                </span>
                                <input type="checkbox" id="cpt_yet" name="cpt_yet" value="0" checked onchange="getData(1);">
                                <span class="checkbox-checkmark"></span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-4">
                            <span class="label-title label-purple me-2">NT</span>
                            Next Year’s Target
                        </td>
                        <td class="py-4">
                            <label class="container-checkbox">
                                <span class="badge rounded-pill dd-bg-blue">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 12 13" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.15095 4.29244L8.85295 5.00494L5.95645 7.85844C5.76295 8.05194 5.50845 8.14844 5.25295 8.14844C4.99745 8.14844 4.74045 8.05094 4.54495 7.85594L3.15395 6.50794L3.85045 5.78944L5.24695 7.14294L8.15095 4.29244ZM12.002 6.14844C12.002 9.45694 9.31045 12.1484 6.00195 12.1484C2.69345 12.1484 0.00195312 9.45694 0.00195312 6.14844C0.00195312 2.83994 2.69345 0.148438 6.00195 0.148438C9.31045 0.148438 12.002 2.83994 12.002 6.14844ZM11.002 6.14844C11.002 3.39144 8.75895 1.14844 6.00195 1.14844C3.24495 1.14844 1.00195 3.39144 1.00195 6.14844C1.00195 8.90544 3.24495 11.1484 6.00195 11.1484C8.75895 11.1484 11.002 8.90544 11.002 6.14844Z" />
                                    </svg>
                                    Done
                                </span>
                                <input type="checkbox" id="nt_done" name="nt_done" value="1" checked onchange="getData(1);">
                                <span class="checkbox-checkmark"></span>
                            </label>
                        </td>
                        <td class="py-4">
                            <label class="container-checkbox">
                                <span class="badge rounded-pill dd-bg-green">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 12 13" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M1.202 6.14868C1.202 8.79517 3.35489 10.9485 6.00219 10.9485C7.30545 10.9485 8.50789 10.4253 9.39173 9.53794L7.80227 7.9486H11.4024V11.5485L10.2396 10.3851C9.13432 11.4951 7.63125 12.1484 6.00219 12.1484C2.69306 12.1484 0.00195312 9.45694 0.00195312 6.14868H1.202ZM6.00171 0.148438C9.31085 0.148438 12.002 2.83993 12.002 6.1482H10.8019C10.8019 3.5017 8.64902 1.34839 6.00171 1.34839C4.69846 1.34839 3.49602 1.87157 2.61218 2.75893L4.20164 4.34827H0.601503V0.748415L1.76434 1.91116C2.86959 0.801815 4.37265 0.148438 6.00171 0.148438Z" />
                                    </svg>
                                    In Progress
                                </span>
                                <input type="checkbox" id="nt_progress" name="nt_progress" value="2" checked onchange="getData(1);">
                                <span class="checkbox-checkmark"></span>
                            </label>
                        </td>
                        <td class="py-4">
                            <label class="container-checkbox">
                                <span class="badge rounded-pill dd-bg-yellow">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 12 13" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0)">
                                            <path d="M5.50166 6.64844V3.64844C5.50166 3.37344 5.72666 3.14844 6.00166 3.14844C6.27666 3.14844 6.50166 3.37344 6.50166 3.64844V6.64844C6.50166 6.92344 6.27666 7.14844 6.00166 7.14844C5.72666 7.14844 5.50166 6.92344 5.50166 6.64844ZM6.00166 7.64844C5.58666 7.64844 5.25166 7.98344 5.25166 8.39844C5.25166 8.81344 5.58666 9.14844 6.00166 9.14844C6.41666 9.14844 6.75166 8.81344 6.75166 8.39844C6.75166 7.98344 6.41666 7.64844 6.00166 7.64844ZM11.7917 10.0884C11.4417 10.7634 10.7067 11.1484 9.78666 11.1484H2.22166C1.29666 11.1484 0.566661 10.7634 0.216661 10.0884C-0.138339 9.40844 -0.0383389 8.53844 0.466661 7.80844L4.48666 1.44844C4.84166 0.938437 5.40166 0.648438 6.00166 0.648438C6.60166 0.648438 7.16166 0.938437 7.50166 1.43344L11.5417 7.81844C12.0467 8.54844 12.1417 9.41344 11.7867 10.0884H11.7917Z" />
                                        </g>
                                    </svg>
                                    Not Yet
                                </span>
                                <input type="checkbox" id="nt_yet" name="nt_yet" value="0" checked onchange="getData(1);">
                                <span class="checkbox-checkmark"></span>
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary btn-sm" style="width: 100px;" id="submitFilter">Submit</button>
        </div>
    </form>
</div>

<?php include __DIR__ . "/footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function() {
        getCurrency();
        getCompanyGroup();
        getCurrencyManagement();
        getData(1);

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

        $("#btnFilter").click(function(e) {
            e.stopPropagation(); // ป้องกันการส่งเหตุการณ์ไปยัง document
            $('#popupFilter').addClass('active');
        });
        $("#submitFilter").click(function(e) {
            $('#btnFilter').addClass('active');
            $('#checkFilter').attr('checked', true);
            $('#btnShowAll').removeClass('active');
            $('#popupFilter').removeClass('active');
            getData(1);
        });
        $("#btnShowAll").click(function(e) {
            $('#btnFilter').removeClass('active');
            $('#checkFilter').attr('checked', false);
            $('#btnShowAll').addClass('active');
            $('#searchText').val('');
            getData(1);
        });

        $('#searchText').keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                getData(1);
            }
        });
    });

    $(document).on('click', function(e) {
        // ตรวจสอบว่าคลิกไม่ได้อยู่ใน `.popup-filter-content` และไม่ใช่ปุ่มเปิด `#btnFilter`
        if (!$(e.target).closest('.popup-filter-content').length && !$(e.target).is('#btnFilter')) {
            $('#popupFilter').removeClass('active'); // ปิด popup
        }
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

                for (let index = branchData.length; index < 8; index++) {
                    branchData.push('');
                    valueData.push(0);
                    imagePaths.push('');
                }

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

    function getData(page) {
        let searchText = $('#searchText').val();
        let filterStatus = 0;
        if ($('#checkFilter').is(':checked')) {
            filterStatus = 1;
            $('#btnFilter').addClass('active');
            if (searchText != '') {
                $('#searchText').addClass('border border-primary');
                $('#btnShowAll').removeClass('active');
            } else {
                $('#searchText').removeClass('border border-primary');
                $('#btnShowAll').removeClass('active');
            }
        } else {
            $('#btnFilter').removeClass('active');
            if (searchText != '') {
                $('#searchText').addClass('border border-primary');
                $('#btnShowAll').removeClass('active');
            } else {
                $('#searchText').removeClass('border border-primary');
                $('#btnShowAll').addClass('active');
            }
        }

        let formData = new FormData($("#form_filer")[0]);
        formData.append('companyId', companyId);
        formData.append('page', page);
        formData.append('searchText', searchText);
        formData.append('filterStatus', filterStatus);

        $.ajax({
            url: 'ajax/FinancialDashboard/getData.php',
            type: 'POST',
            dataType: 'html',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                Swal.close();
                $('#showData').html(data);
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
            url: 'ajax/FinancialDashboard/getModalCreate.php',
            type: 'POST',
            dataType: 'html',
            data: {
                companyId: companyId
            },
            success: function(data) {
                Swal.close();
                $('#showModalCreate').html(data);
                $("#createFinanceConfig").modal("show");
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

    function checkSelectBranch() {
        let branchId = $('#branchId').val();
        if (branchId === null || branchId === '') {
            $('#noBranch').show();
        } else {
            $('#noBranch').html('');
        }
    }

    function checkSelectStartMonth() {
        let branchId = $('#startMonth').val();
        if (branchId === null || branchId === '') {
            $('#noStartMonth').show();
        } else {
            $('#noStartMonth').html('');
        }
    }

    function createBranch() {
        let formData = new FormData($("#form_add")[0]);

        customAlert({
            title: "Warning",
            message: "Do you want to save?",
            icon: "warning",
            confirmText: "Create",
            confirmColor: "btn-primary",
            cancelText: "Cancel",
            cancelColor: "btn-outline-secondary"
        }).then(() => {
            $.ajax({
                url: 'ajax/FinancialDashboard/createBranch.php',
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.close();
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