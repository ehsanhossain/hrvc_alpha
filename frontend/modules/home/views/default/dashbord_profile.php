    <div>
        <div class="text-left position-relative">
            <div class="d-flex align-items-center">
                <div class="text-center position-relative" style="flex-shrink: 0;">
                    <img src="<?= Yii::$app->homeUrl ?><?= $employeeProfile['picture'] ?>"
                        class="profile-picture rounded-circle" alt="User Avatar"
                        style="width: 48px; height: 48px; object-fit: cover;">
                    <span class="condition-name badge position-absolute" style="bottom: -4px; left: 50%; transform: translateX(-50%); font-size: 9px; padding: 2px 8px; white-space: nowrap;">
                        <?= $employeeProfile['employeeConditionName'] ?>
                    </span>
                </div>
                <div class="ms-3" style="min-width: 0; flex: 1;">
                    <h6 class="profile-name mb-0">
                        <?= $employeeProfile['employeeFirstname'] ?> <?= $employeeProfile['employeeSurename'] ?>
                    </h6>
                    <p class="profile-role text-muted mb-0"><?= $employeeProfile['titleName'] ?>
                        <?php
                        if (!empty($employeeProfile['shortTag'])) {
                            echo "(" . $employeeProfile['shortTag'] . ")";
                        }
                        ?>
                    </p>
                    <p class="profile-rolesub text-muted mb-0"><?= $employeeProfile['titleName'] ?></p>
                </div>
            </div>
        </div>

        <ul class="profile-details list-unstyled mt-3 mb-0" style="font-size: 12px;">
            <li class="d-flex align-items-center" style="margin-bottom: 6px;">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/mail.svg" alt="Email" class="pim-icon"
                    style="width: 13px; height: 13px; margin-right: 6px; flex-shrink: 0;">
                <span class="text-truncate" style="max-width: 170px;"><?= $employeeProfile["email"] ?></span>
                <a href="javascript:copyToClipboard('<?= $employeeProfile['email'] ?>')" class="ms-1" style="flex-shrink: 0;">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/coppy.svg" alt="Copy"
                        style="width: 11px; height: 11px; opacity: 0.6;">
                </a>
            </li>
            <li class="d-flex align-items-center" style="margin-bottom: 6px;">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/employee.svg" alt="Employee" class="pim-icon"
                    style="width: 13px; height: 13px; margin-right: 6px; flex-shrink: 0;">
                <?= Yii::t('app', 'Employee ID:') ?>
                <strong class="ms-1"><?= $employeeProfile['employeeNumber'] ?></strong>
            </li>
            <li class="d-flex align-items-center">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/calendar.svg" alt="Calendar" class="pim-icon"
                    style="width: 13px; height: 13px; margin-right: 6px; flex-shrink: 0;">
                <?= Yii::t('app', 'Employee Since :') ?>
                <strong class="ms-1">
                    <?php
                    $formattedDate = date("jS F Y", strtotime($employeeProfile['joinDate']));
                    echo $formattedDate;
                    ?>
                </strong>
            </li>
        </ul>

        <hr class="custom-hr" style="margin: 10px 0 8px;">

        <div class="d-flex align-items-center">
            <img src="<?= Yii::$app->homeUrl ?><?= $employeeProfile['companyPicture'] ?>" class="profile-picture rounded-circle"
                alt="" style="width: 32px; height: 32px; object-fit: cover; flex-shrink: 0;">
            <div class="ms-2" style="min-width: 0;">
                <div style="font-size: 13px; font-weight: 600; color: #30313D; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $employeeProfile['companyName'] ?></div>
                <div style="font-size: 11px; color: #888; line-height: 1.3;">
                    <img src="<?= Yii::$app->homeUrl ?><?= $employeeProfile['flag'] ?>"
                        class="rounded-circle" alt=""
                        style="width: 12px; height: 12px; vertical-align: middle;">
                    <?= $employeeProfile['city'] ?>, <?= $employeeProfile['countryName'] ?>
                </div>
            </div>
        </div>
    </div>