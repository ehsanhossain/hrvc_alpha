<?php
$this->title = "Dashboard";
?>
<style>
    .dashboard-container {
        margin-top: 60px;
        padding: 0 0 20px;
        box-sizing: border-box;
    }
    .dashboard-container .pim-body {
        border-radius: 12px;
        background: #FFFFFF;
        border: none;
    }
</style>
<div class="dashboard-container">
    <div class="row">
        <div class="alert pim-body bg-white" style="margin: 0; padding: 16px;">

            <div class="row g-3">
                <!-- Chart -->
                <div class="col-lg-9">
                    <div class="dashboard-chart h-100">
                        <?= $this->render('dashboard_chart') ?>
                    </div>
                </div>

                <!-- Profile -->
                <div class="col-lg-3">
                    <div class="profile-card h-100">
                        <?= $this->render('dashbord_profile', ['employeeProfile' => $employeeProfile]) ?>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-2">
                <!-- Tabs -->
                <div class="col-lg-9">
                    <div class="dashboard-tabs">
                        <?= $this->render('dashbord_tabs', [
                            'companyId' => $employeeProfile['companyId'],
                            'teamId' => $employeeProfile['teamId'],
                            'employeeId' => $employeeProfile['employeeId']
                        ]) ?>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="col-lg-3">
                    <div class="dashboard-navigation">
                        <?= $this->render('dashbord_navigation', [
                            'pendingApprove' => $pendingApprove
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>