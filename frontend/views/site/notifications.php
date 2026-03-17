<?php
/** @var yii\web\View $this */
/** @var array $notifications */
$this->title = 'Notifications — HRVC';
$homeUrl = Yii::$app->homeUrl;

$typeIcons = [
    'info'     => ['bg' => '#EAF5FF', 'color' => '#2580D3', 'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"/><path d="M12 16v-4M12 8h.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>'],
    'action'   => ['bg' => '#FFF3E0', 'color' => '#F59E0B', 'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 9v4M12 17h.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>'],
    'system'   => ['bg' => '#E8F9EE', 'color' => '#34C759', 'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 15a3 3 0 100-6 3 3 0 000 6z" stroke="currentColor" stroke-width="1.5"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 11-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 110-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 114 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 110 4h-.09a1.65 1.65 0 00-1.51 1z" stroke="currentColor" stroke-width="1.5"/></svg>'],
    'team'     => ['bg' => '#F0F0FF', 'color' => '#6366F1', 'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="1.5"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
    'approval' => ['bg' => '#FFF0F6', 'color' => '#EC4899', 'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M16 2v4M8 2v4M3 10h18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>'],
];

$unreadCount = 0;
foreach ($notifications as $n) {
    if (!$n['is_read']) $unreadCount++;
}
?>

<style>
.noti-page { padding: 24px 0; max-width: 820px; }

.noti-header {
    display: flex; align-items: center; gap: 12px; margin-bottom: 24px;
}

.noti-header-icon {
    width: 40px; height: 40px; border-radius: 6px;
    background: linear-gradient(135deg, #2580D3, #1A5A94);
    display: flex; align-items: center; justify-content: center;
}

.noti-header h1 {
    font-family: 'Inter', sans-serif; font-size: 24px; font-weight: 700; color: #1A1A1A; margin: 0;
}

.noti-header p {
    font-family: 'Inter', sans-serif; font-size: 13px; color: #888; margin: 2px 0 0;
}

.noti-actions {
    margin-left: auto; display: flex; gap: 8px; align-items: center;
}

.noti-badge {
    background: #EAF5FF; color: #1A5A94; font-size: 12px; font-weight: 700;
    padding: 4px 10px; border-radius: 6px;
}

.noti-btn-mark {
    padding: 8px 16px; border-radius: 6px; border: 1px solid #E2E8F0;
    font-family: 'Inter', sans-serif; font-size: 13px; font-weight: 500;
    color: #475569; background: #F8FAFC; cursor: pointer;
    transition: all 0.15s ease;
}

.noti-btn-mark:hover { background: #E2E8F0; }

.noti-list { display: flex; flex-direction: column; gap: 0; }

.noti-item {
    display: flex; align-items: flex-start; gap: 14px;
    padding: 16px 18px; background: #FFFFFF;
    border: 1px solid #F0F0F0; border-radius: 6px;
    margin-bottom: -1px; cursor: pointer;
    transition: all 0.15s ease; position: relative;
}

.noti-item:first-child { border-radius: 6px 6px 0 0; }
.noti-item:last-child { border-radius: 0 0 6px 6px; margin-bottom: 0; }
.noti-item:only-child { border-radius: 6px; }

.noti-item:hover { background: #FAFBFC; z-index: 1; }

.noti-item.unread {
    background: #F8FBFF; border-left: 3px solid #2580D3;
}

.noti-item.unread::after {
    content: ''; position: absolute; top: 18px; right: 18px;
    width: 8px; height: 8px; border-radius: 50%; background: #2580D3;
}

.noti-icon {
    width: 36px; height: 36px; min-width: 36px; border-radius: 6px;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}

.noti-body { flex: 1; min-width: 0; }

.noti-title {
    font-family: 'Inter', sans-serif; font-size: 14px; font-weight: 600;
    color: #1A1A1A; line-height: 1.3; margin-bottom: 4px;
}

.noti-message {
    font-family: 'Inter', sans-serif; font-size: 13px; font-weight: 400;
    color: #666; line-height: 1.45;
}

.noti-time {
    font-family: 'Inter', sans-serif; font-size: 11px; color: #A3A3A3;
    margin-top: 6px;
}

.noti-empty {
    text-align: center; padding: 60px 20px; color: #999;
}

.noti-empty svg { margin-bottom: 12px; }
</style>

<div class="noti-page">
    <div class="noti-header">
        <div class="noti-header-icon">
            <img src="<?= $homeUrl ?>image/notification-ring.svg" width="22" height="22">
        </div>
        <div>
            <h1>Notifications</h1>
            <p><?= $unreadCount ?> unread notification<?= $unreadCount !== 1 ? 's' : '' ?></p>
        </div>
        <div class="noti-actions">
            <?php if ($unreadCount > 0): ?>
            <span class="noti-badge"><?= $unreadCount ?> new</span>
            <button class="noti-btn-mark" onclick="markAllRead()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:4px;"><path d="M5 13l4 4L19 7" stroke="#475569" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Mark all as read
            </button>
            <?php endif; ?>
        </div>
    </div>

    <?php if (empty($notifications)): ?>
    <div class="noti-empty">
        <img src="<?= $homeUrl ?>image/no-notification.svg" width="48" height="48">
        <p>No notifications yet.</p>
    </div>
    <?php else: ?>
    <div class="noti-list">
        <?php foreach ($notifications as $n):
            $type = $n['type'] ?? 'info';
            $t = $typeIcons[$type] ?? $typeIcons['info'];
            $isUnread = !$n['is_read'];
            $dt = new DateTime($n['create_datetime']);
            $timeAgo = timeAgo($dt);
        ?>
        <div class="noti-item <?= $isUnread ? 'unread' : '' ?>" data-id="<?= $n['notificationId'] ?>"
             onclick="readNotification(<?= $n['notificationId'] ?>, '<?= htmlspecialchars($n['link'] ?? '') ?>')">
            <div class="noti-icon" style="background:<?= $t['bg'] ?>;color:<?= $t['color'] ?>;">
                <?= $t['icon'] ?>
            </div>
            <div class="noti-body">
                <div class="noti-title"><?= htmlspecialchars($n['title']) ?></div>
                <div class="noti-message"><?= htmlspecialchars($n['message'] ?? '') ?></div>
                <div class="noti-time"><?= $timeAgo ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php
function timeAgo(DateTime $dt) {
    $now = new DateTime();
    $diff = $now->getTimestamp() - $dt->getTimestamp();
    if ($diff < 60) return 'Just now';
    if ($diff < 3600) return floor($diff / 60) . ' min ago';
    if ($diff < 86400) return floor($diff / 3600) . ' hr ago';
    if ($diff < 604800) return floor($diff / 86400) . ' day' . (floor($diff / 86400) > 1 ? 's' : '') . ' ago';
    return $dt->format('M j, Y');
}
?>

<script>
function readNotification(id, link) {
    var item = document.querySelector('.noti-item[data-id="' + id + '"]');
    if (item && item.classList.contains('unread')) {
        // Mark as read via AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= $homeUrl ?>site/mark-notification-read', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var csrf = '<?= Yii::$app->request->csrfParam ?>=<?= urlencode(Yii::$app->request->csrfToken) ?>';
        xhr.onload = function() {
            item.classList.remove('unread');
            if (link) window.location.href = '<?= $homeUrl ?>' + link.replace(/^\//, '');
        };
        xhr.send(csrf + '&notificationId=' + id);
    } else if (link) {
        window.location.href = '<?= $homeUrl ?>' + link.replace(/^\//, '');
    }
}

function markAllRead() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?= $homeUrl ?>site/mark-all-read', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    var csrf = '<?= Yii::$app->request->csrfParam ?>=<?= urlencode(Yii::$app->request->csrfToken) ?>';
    xhr.onload = function() { location.reload(); };
    xhr.send(csrf);
}
</script>
