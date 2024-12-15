<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'request_id',
        'message',
        'is_read',
        'reject_reason',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true; // Automatically manage created_at and updated_at

    // Method to get notifications for a specific user
    public function getNotificationsByUserId($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    // Method to mark a notification as read
    public function markAsRead($notificationId)
    {
        return $this->update($notificationId, ['is_read' => 1]);
    }

    // Method to create a new notification
    public function createNotification($data)
    {
        return $this->insert($data);
    }

    // Method to delete a notification
    public function deleteNotification($notificationId)
    {
        return $this->delete($notificationId);
    }
}
