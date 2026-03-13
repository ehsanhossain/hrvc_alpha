<?php
/**
 * Shim footer.php for Yii2 integration.
 * Closes the wrapper div and provides the custom alert modal + FS-specific JavaScript.
 * jQuery, Bootstrap etc. are loaded by Yii2's asset system via the controller.
 */
?>
</div><!-- /.wrapper-content -->
</div><!-- /.fs-wrapper -->

<div class="modal fade" id="customAlertModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 683px;">
        <div class="modal-content">
            <div class="modal-body px-4">
                <div class="fw-400 fs-20 d-flex align-items-center mb-3">
                    <span id="customAlertIcon" class="me-3"></span>
                    <span id="customAlertTitle">Deletion Warning</span>
                </div>
                <p class="fs-16 fw-300" id="customAlertMessage">
                    Deleting the Financial Configuration will permanently remove all related data. This action cannot be undone.
                </p>
                <div class="text-end mt-3">
                    <button class="btn btn-primary" data-bs-dismiss="modal" id="customAlertCancel">Cancel</button>
                    <button type="button" class="btn btn-outline-danger" id="customAlertConfirm">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Register the FS-specific JavaScript inline
$fsJs = <<<'FSJS'
    var $baseUrl = window.location.protocol + "//" + window.location.host + "/";

    function linkMenu(id, menu) {
        window.location.replace($baseUrl + 'fs/default/fs-menu?id=' + id + '&menu=' + menu);
    }

    function customAlert(options) {
        return new Promise((resolve, reject) => {
            $("#customAlertTitle").text(options.title || "Alert");
            $("#customAlertMessage").html(options.message || "Are you sure?");
            $("#customAlertConfirm").html(options.confirmText || "OK");
            $("#customAlertCancel").html(options.cancelText || "Cancel");

            if (options.confirmColor) {
                $("#customAlertConfirm").removeClass().addClass(`btn ${options.confirmColor}`);
            } else {
                $("#customAlertConfirm").hide();
            }
            if (options.cancelColor) {
                $("#customAlertCancel").removeClass().addClass(`btn ${options.cancelColor}`);
            } else {
                $("#customAlertCancel").hide();
            }

            let iconHTML = "";
            switch (options.icon) {
                case "success":
                    iconHTML = `<svg width="28" height="28" viewBox="0 0 28 28" fill="none"><circle cx="9.5" cy="9" r="8.2" stroke="#2D7F06" stroke-width="1.6"/><path d="M5.90039 9.77123L7.92539 11.6998L14.0004 6.2998" stroke="#2D7F06" stroke-width="1.6" stroke-linecap="square" stroke-linejoin="round"/></svg>`;
                    break;
                case "error":
                    iconHTML = `<svg width="28" height="28" viewBox="0 0 28 28" fill="none"><circle cx="9.5" cy="9.33398" r="8.2" stroke="#EC1D42" stroke-width="1.6"/><path d="M 5 5 L 14 14 M 14 5 L 5 14" stroke="#EC1D42" stroke-width="1.6"/></svg>`;
                    break;
                case "info":
                    iconHTML = `<svg width="27" height="27" viewBox="0 0 27 27" fill="none"><path d="M13.918 0.970703C11.3468 0.970703 8.8334 1.73314 6.69556 3.1616C4.55772 4.59006 2.89148 6.62038 1.90754 8.99582C0.923601 11.3713 0.666158 13.9851 1.16777 16.5069C1.66937 19.0286 2.9075 21.345 4.72559 23.1631C6.54367 24.9812 8.86005 26.2193 11.3818 26.7209C13.9036 27.2225 16.5174 26.9651 18.8929 25.9811C21.2683 24.9972 23.2986 23.331 24.7271 21.1931C26.1555 19.0553 26.918 16.5419 26.918 13.9707C26.9142 10.524 25.5434 7.2196 23.1062 4.78243C20.6691 2.34527 17.3646 0.974431 13.918 0.970703ZM13.918 24.804C11.7753 24.804 9.68083 24.1687 7.8993 22.9783C6.11776 21.7879 4.72923 20.096 3.90928 18.1164C3.08933 16.1369 2.87479 13.9587 3.2928 11.8572C3.71081 9.75576 4.74258 7.82545 6.25765 6.31038C7.77272 4.79531 9.70303 3.76354 11.8045 3.34553C13.906 2.92752 16.0842 3.14206 18.0637 3.96201C20.0432 4.78196 21.7352 6.17049 22.9256 7.95202C24.1159 9.73356 24.7513 11.8281 24.7513 13.9707C24.7481 16.8429 23.6058 19.5966 21.5748 21.6275C19.5438 23.6585 16.7902 24.8009 13.918 24.804Z" fill="#2580D3"/></svg>`;
                    break;
                case "warning":
                    iconHTML = `<svg width="28" height="25" viewBox="0 0 28 25" fill="none"><path d="M12.8724 14.2143V7.35714C12.8724 6.72857 13.3789 6.21429 13.998 6.21429C14.6171 6.21429 15.1236 6.72857 15.1236 7.35714V14.2143C15.1236 14.8429 14.6171 15.3571 13.998 15.3571C13.3789 15.3571 12.8724 14.8429 12.8724 14.2143ZM13.998 16.5C13.0638 16.5 12.3096 17.2657 12.3096 18.2143C12.3096 19.1629 13.0638 19.9286 13.998 19.9286C14.9323 19.9286 15.6865 19.1629 15.6865 18.2143C15.6865 17.2657 14.9323 16.5 13.998 16.5ZM27.0327 22.0771C26.2448 23.62 24.5901 24.5 22.519 24.5H5.48831C3.40591 24.5 1.7625 23.62 0.974566 22.0771C0.175374 20.5229 0.400499 18.5343 1.53738 16.8657L10.5874 2.32857C11.3866 1.16286 12.6473 0.5 13.998 0.5C15.3488 0.5 16.6095 1.16286 17.3749 2.29429L26.4699 16.8886C27.6068 18.5571 27.8207 20.5343 27.0215 22.0771H27.0327ZM24.6126 18.1686C24.6126 18.1686 24.5901 18.1457 24.5901 18.1229L15.5064 3.55143C15.1799 3.08286 14.6171 2.78571 13.998 2.78571C13.3789 2.78571 12.8161 3.08286 12.4672 3.59714L3.40591 18.1229C2.70802 19.1286 2.55044 20.2257 2.95566 21.0143C3.34963 21.7914 4.25013 22.2143 5.47706 22.2143H22.4965C23.7234 22.2143 24.6239 21.7914 25.0179 21.0143C25.4231 20.2257 25.2655 19.1286 24.6014 18.1686H24.6126Z" fill="#FFCD29"/></svg>`;
                    break;
            }
            $("#customAlertIcon").html(iconHTML);

            var modal = new bootstrap.Modal(document.getElementById("customAlertModal"), { keyboard: false });
            modal.show();

            $("#customAlertConfirm").off("click").on("click", function() {
                modal.hide();
                resolve(true);
            });

            $("#customAlertCancel").off("click").on("click", function() {
                modal.hide();
                reject(false);
            });

            if (options.timer) {
                setTimeout(function() {
                    modal.hide();
                    resolve(true);
                }, options.timer);
            }
        });
    }
FSJS;
$this->registerJs($fsJs, \yii\web\View::POS_END);
?>
