<?php
	if (!defined('WEB_ROOT')) {
		header('Location: ../index.php');
		exit;
	}
?>

<link href="<?php echo WEB_ROOT; ?>style/notification.css" rel="stylesheet" />

<!-- Shopping Details Section Start -->
<div class="notifications-container">
    <div class="notifications-header">
        <h1 class="notifications-title">Notifications</h1>
        <div class="notifications-tabs">
            <div class="tab active" onclick="filterNotifications('all')">All</div>
            <div class="tab" onclick="filterNotifications('unread')">Unread</div>
        </div>
    </div>
    <div id="notificationsList">
        <!-- Notifications will be inserted here -->
    </div>
</div>

<script>
// Initialize notifications array before the PHP loop
let notifications = [];
</script>

<?php
$notificationsSQL = $conn->prepare("SELECT * FROM tbl_notifications WHERE user_id = :userId ORDER BY date_created DESC");
$notificationsSQL->bindParam(':userId', $userId, PDO::PARAM_INT);
$notificationsSQL->execute();

while ($notificationData = $notificationsSQL->fetch(PDO::FETCH_ASSOC)) {
    $notificationId = $notificationData['n_id'];
    $notificationMessage = $notificationData['notification_message'];
    $notificationTime = $notificationData['date_created'];
    $notificationType = $notificationData['notification_type'];
    $notificationUnread = $notificationData['is_read'] == '0' ? true : false; // Changed to '0' for unread
    
    $today_date1 = new DateTime(date('Y-m-d H:i:s'));
    $notification_date = new DateTime($notificationTime);
    $interval = $today_date1->diff($notification_date);
    
    // Format the interval into a readable string
	$timeAgo = '';
	if ($interval->y > 0) {
		$timeAgo = $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
	} elseif ($interval->m > 0) {
		$timeAgo = $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
	} elseif ($interval->d > 0) {
		$timeAgo = $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
	} elseif ($interval->h > 0) {
		$timeAgo = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
	} elseif ($interval->i > 0) {
		$timeAgo = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
	} else {
		$timeAgo = 'Just now';
	}

    ?>
    <script>
    // Push each notification into the array
    notifications.push({
        id: <?php echo $notificationId; ?>,
        message: <?php echo json_encode($notificationMessage); ?>,
        time: <?php echo json_encode($timeAgo); ?>,
        unread: <?php echo $notificationUnread ? 'true' : 'false'; ?>,
        type: <?php echo json_encode($notificationType); ?>
    });
    </script>
    <?php
}
?>

<script>
function getIconForType(type) {
    const icons = {
        success: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                  </svg>`,
        error: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 15h-1v-1h2v1h-1zm1-4h-2v-5h2v5z"/>
                </svg>`,
        task: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                </svg>`,
        info: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-6h2v6zm0-8h-2V7h2v4z"/>
               </svg>`,
    };
    return icons[type] || icons.booking;
}

function getBackgroundForType(type) {
    const backgrounds = {
        success: '#28a745', // Green
        error: '#dc3545',   // Red
        task: '#007bff',    // Blue
        info: '#17a2b8',    // Teal
    };
    return backgrounds[type] || '#6c757d'; // Default: Gray
}

function renderNotifications(filter = 'all') {
    const list = document.getElementById('notificationsList');
    const filteredNotifications = filter === 'all' 
        ? notifications 
        : notifications.filter(n => n.unread);

    if (filteredNotifications.length === 0) {
        list.innerHTML = `
            <div class="empty-state">
                No notifications to show
            </div>
        `;
        return;
    }

    list.innerHTML = filteredNotifications.map(notification => `
        <div class="notification-item ${notification.unread ? 'unread' : ''}" 
             onclick="markAsRead(${notification.id})">
            <div class="notification-avatar" style="background: ${getBackgroundForType(notification.type)};">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    ${getIconForType(notification.type)}
                </svg>
            </div>
            <div class="notification-content">
                <div class="notification-message">
                    ${notification.message}
                </div>
                <div class="notification-time">
                    ${notification.time}
                </div>
            </div>
        </div>
    `).join('');
}


function markAsRead(id) {
    // AJAX call to update the database
    fetch('mark_notification_read.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'notification_id=' + id
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const notification = notifications.find(n => n.id === id);
            if (notification) {
                notification.unread = false;
                renderNotifications(getCurrentFilter());
            }
        }
    });
}

function getCurrentFilter() {
    return document.querySelector('.tab.active').textContent.toLowerCase();
}

function filterNotifications(filter) {
    document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
        if (tab.textContent.toLowerCase() === filter) {
            tab.classList.add('active');
        }
    });
    renderNotifications(filter);
}

// Initial render
renderNotifications('all');
</script>
<!-- Shopping Details Section End -->

<?php

$notificationsSQL = $conn->prepare("UPDATE tbl_notifications SET is_read = '1' WHERE user_id = :userId");
$notificationsSQL->bindParam(':userId', $userId, PDO::PARAM_INT);
$notificationsSQL->execute();
?>