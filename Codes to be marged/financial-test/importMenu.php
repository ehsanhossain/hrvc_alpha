<?php
$currentFile = basename($_SERVER['PHP_SELF']);
$branchId = '';
if ($_GET['id'] != '') {
    $branchId = $_GET['id'];
} else {
    $branchId = $_SESSION['firstBranchId'];
}
?>
<div class="sidebar">
    <img src="../asset/logo/menu.png" alt="" class="menu-logo">
    <ul>
        <li class="home">
            <a href="#"><img src="../asset/icon/menu-home.svg" alt="" class=""> Home</a>
        </li>

        <li class="menu-item collapsed">
            <a href="#">
                <img src="../asset/icon/sm-groupmanagement/condo.svg" alt="" class=""> Group Management
            </a>
            <div class="menu-dropdown">
                <ul>
                    <li><a href="#"><img src="../asset/icon/sm-groupmanagement/condo.svg" alt="" class=""> Group Configuration</a></li>
                    <li><a href="#"><img src="../asset/icon/sm-groupmanagement/condo-home.svg" alt="" class=""> Company Information</a></li>
                    <li><a href="#"><img src="../asset/icon/sm-groupmanagement/branch.png" alt="" class=""> Branch</a></li>
                    <li><a href="#"><img src="../asset/icon/sm-groupmanagement/department.svg" alt="" class=""> Department</a></li>
                    <li><a href="#"><img src="../asset/icon/sm-groupmanagement/employee.svg" alt="" class=""> Employees</a></li>
                    <li><a href="#"><img src="../asset/icon/sm-groupmanagement/teams.svg" alt="" class=""> Team</a></li>
                    <li><a href="#"><img src="../asset/icon/sm-groupmanagement/title.svg" alt="" class=""> Title</a></li>
                    <li><a href="#"><img src="../asset/icon/sm-groupmanagement/layer.svg" alt="" class=""> Management layer</a></li>
                </ul>
            </div>
        </li>

        <li class="menu-item collapsed <?php if (in_array($currentFile, ['FinancialDashboard.php', 'FinancialConfiguration.php', 'CurrencyManagement.php'])): ?> show-menu <?php endif; ?>">
            <a href="#">
                <img src="../asset/icon/sm-financial/financial.svg" alt="" class=""> Financial System
            </a>
            <div class="menu-dropdown">
                <ul>
                    <li><a href="FinancialDashboard"><img src="../asset/icon/menu-dashboard.svg" alt="" class=""> Dashboard</a></li>
                    <li><a href="FinancialProfitLossPortal?branch=<?php echo $branchId; ?>"><img src="../asset/icon/sm-financial/pl-forecast.svg" alt="" class=""> PL Forecast</a></li>
                    <li><a href="FinancialConfiguration?branch=<?php echo $branchId; ?>"><img src="../asset/icon/sm-financial/pl-configuration.svg" alt="" class=""> PL Configuration</a></li>
                    <li><a href="GoldenRatio?branch=<?php echo $branchId; ?>"><img src="../asset/icon/sm-financial/golden-ratio.svg" alt="" class=""> Gloden Ratio</a></li>
                    <li><a href="ForecastAccounts?branch=<?php echo $branchId; ?>"><img src="../asset/icon/sm-financial/forecast-account.svg" alt="" class=""> Forecast Accounts</a></li>
                    <li><a href="CurrencyManagement"><img src="../asset/icon/sm-financial/currency.svg" alt="" class=""> Currency Management</a></li>
                </ul>
            </div>
        </li>

        <li class="menu-item collapsed">
            <a href="#">
                <img src="../asset/icon/sm-performance/performance.svg" alt="" class=""> Performance Matrices
            </a>
            <div class="menu-dropdown">
                <ul>
                    <li><a href="#"><img src="../asset/icon/menu-dashboard.svg" alt="" class=""> Dashboard</a></li>
                    <li class="menu-item collapsed">
                        <a href="#">
                            <img src="../asset/icon/sm-performance/financial.svg" alt="" class=""> Financials
                        </a>
                        <div class="menu-dropdown">
                            <ul>
                                <li><a href="#"><img src="../asset/icon/sm-performance/home-condo.svg" alt="" class=""> Company KFI</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item collapsed">
                        <a href="#">
                            <img src="../asset/icon/sm-performance/goals.png" alt="" class=""> Goals
                        </a>
                        <div class="menu-dropdown">
                            <ul>
                                <li><a href="#"><img src="../asset/icon/sm-performance/home-condo.svg" alt="" class=""> Company KGI</a></li>
                                <li><a href="#"><img src="../asset/icon/sm-groupmanagement/teams.svg" alt="" class=""> Team KGI</a></li>
                                <li><a href="#"><img src="../asset/icon/sm-groupmanagement/employee.svg" alt="" class=""> Self KGI</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item collapsed">
                        <a href="#">
                            <img src="../asset/icon/sm-performance/performance-sub.svg" alt="" class=""> Performance
                        </a>
                        <div class="menu-dropdown">
                            <ul>
                                <li><a href="#"><img src="../asset/icon/sm-performance/home-condo.svg" alt="" class=""> Company KPI</a></li>
                                <li><a href="#"><img src="../asset/icon/sm-groupmanagement/teams.svg" alt="" class=""> Team KPI</a></li>
                                <li><a href="#"><img src="../asset/icon/sm-groupmanagement/employee.svg" alt="" class=""> Self KPI</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="#"><img src="../asset/icon/sm-performance/approvals.svg" alt="" class=""> Approvals</a></li>
                </ul>
            </div>
        </li>

        <li class="menu-item collapsed">
            <a href="#">
                <img src="../asset/icon/sm-evaluation/evaluaton-system.svg" alt="" class=""> Evaluation System
            </a>
            <div class="menu-dropdown">
                <ul>
                    <li class="menu-item collapsed">
                        <a href="#">
                            <img src="../asset/icon/sm-evaluation/evaluation-env.svg" alt="" class=""> Evaluation Environment
                        </a>
                        <div class="menu-dropdown">
                            <ul>
                                <li><a href="#"><img src="../asset/icon/sm-evaluation/evaluation-env.svg" alt="" class=""> Progress Dashboard</a></li>
                                <li><a href="#"><img src="../asset/icon/sm-evaluation/salary.svg" alt="" class=""> Salary Registration</a></li>
                                <li><a href="#"><img src="../asset/icon/sm-evaluation/bonus.svg" alt="" class=""> Bonus Config</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="menu-item collapsed">
                        <a href="#">
                            <img src="../asset/icon/menu-building.svg" alt="" class=""> Performance
                        </a>
                        <div class="menu-dropdown">
                            <ul>
                                <li><a href="#"><img src="../asset/icon/sm-evaluation/performance.svg" alt="" class=""> Company Performance</a></li>
                                <li><a href="#"><img src="../asset/icon/sm-evaluation/self-pfm.svg" alt="" class=""> Self Performance</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </li>


        <li class="menu-item collapsed">
            <a href="#">
                <img src="../asset/icon/sm-behavioral/behavioral.svg" alt="" class=""> Behavioral Evaluation
            </a>
            <div class="menu-dropdown">
                <ul>
                    <li><a href="#"><img src="../asset/icon/sm-behavioral/company-dashboard.svg" alt="" class=""> Company Dashboard</a></li>
                    <li><a href="#"><img src="../asset/icon/sm-behavioral/self.svg" alt="" class=""> Self Dashboard</a></li>
                    <li><a href="#"><img src="../asset/icon/sm-behavioral/360.svg" alt="" class=""> 360 Degree Evaluation</a></li>
                    <li class="menu-item collapsed">
                        <a href="#">
                            <img src="../asset/icon/sm-behavioral/tools.svg" alt="" class=""> Tools
                        </a>
                        <div class="menu-dropdown">
                            <ul>
                                <li><a href="#"><img src="../asset/icon/sm-behavioral/registration.svg" alt="" class=""> Registration & Config</a></li>
                                <li><a href="#"><img src="../asset/icon/sm-behavioral/behavioral.svg" alt="" class=""> behavioral indicators</a></li>
                                <li><a href="#"><img src="../asset/icon/sm-behavioral/360.svg" alt="" class=""> 360 Degree Evaluation</a></li>
                                <li><a href="#"><img src="../asset/icon/sm-behavioral/template.svg" alt="" class=""> Template Board</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </li>

        <li class="home">
            <a href="#"><img src="../asset/icon/side-menu/setting.svg" alt="" class=""> Settings</a>
        </li>

    </ul>
</div>