<div class="schedule-card">
    <div class="tab-Navigation">
        <!-- Navigation -->
        <ul class="nav nav-pills schedule-tabs mb-0" role="tablist" style="display: flex; flex-wrap: nowrap; padding: 6px 8px; gap: 4px; margin: 0;">
            <li class="nav-item" style="flex: 1; min-width: 0;">
                <a class="nav-link active" id="upcoming-schedule-tab" data-bs-toggle="tab" href="#upcoming-schedule"
                    role="tab" aria-controls="upcoming-schedule" aria-selected="true"
                    style="white-space: nowrap; padding: 6px 8px; font-size: 11px; display: flex; align-items: center; justify-content: center; gap: 4px;">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/calendar-time.svg" alt="Upcoming"
                        style="width: 13px; height: 13px; flex-shrink: 0;">
                    <?= Yii::t('app', 'Upcoming') ?>
                </a>
            </li>
            <li class="nav-item" style="flex: 1; min-width: 0;">
                <a class="nav-link" id="pending-approvals-tab" data-bs-toggle="tab" href="#pending-approvals" role="tab"
                    aria-controls="pending-approvals" aria-selected="false"
                    style="white-space: nowrap; padding: 6px 8px; font-size: 11px; display: flex; align-items: center; justify-content: center; gap: 4px;">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/3person.svg" alt="Pending"
                        style="width: 13px; height: 13px; flex-shrink: 0;">
                    <?= Yii::t('app', 'Pending') ?>
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content" style="padding: 8px;">
        <!-- Upcoming Schedule -->
        <div class="tab-pane fade show active" id="upcoming-schedule" role="tabpanel"
            aria-labelledby="upcoming-schedule-tab">
            <?= $this->render('upcoming') ?>
        </div>

        <!-- Pending Approvals -->
        <div class="tab-pane fade" id="pending-approvals" role="tabpanel" aria-labelledby="pending-approvals-tab">
            <?= $this->render('waiting_approval', [
                'pendingApprove' => $pendingApprove
            ]) ?>
        </div>
    </div>
</div>
<!-- View All button -->
<div class="text-ViewAllbutton">
    <a href="#" class="view-all-link"><?= Yii::t('app', 'View All') ?> </a>
</div>