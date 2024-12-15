<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table = 'chat_messages';
    protected $allowedFields = ['sender', 'message', 'type', 'timestamp'];

    public function getMessages()
    {
        return $this->orderBy('timestamp', 'ASC')->findAll();
    }

    public function saveMessage($data)
    {
        return $this->insert($data);
    }
}
