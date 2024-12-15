<?php

namespace App\Controllers;

use App\Models\ChatModel;

class ChatController extends BaseController
{
    public function index()
    {
        $model = new ChatModel();
        $data['messages'] = $model->getMessages();
        return view('login-register/chat_view', $data);
    }

    public function sendMessage()
    {
        $model = new ChatModel();
        $data = [
            'sender' => $this->request->getPost('sender'),
            'message' => $this->request->getPost('message'),
            'type' => 'user', // Default to user
        ];
        $model->saveMessage($data);
    
        // Fetch messages again after saving
        $data['messages'] = $model->getMessages();
        return view('login-register/chat_view', $data);
    }
    
    public function sendAdminMessage()
{
    $adminMessage = $this->request->getPost('admin_message');
    $model = new ChatModel();

    // Save message to database
    $model->saveMessage([
        'sender' => 'Admin',
        'message' => $adminMessage,
        'type' => 'admin',
        'timestamp' => date('Y-m-d H:i:s')
    ]);

    return $this->response->setJSON(['success' => true]);
}

    public function adminChat()
{
    $model = new ChatModel();
    $data['messages'] = $model->getMessages();
    return view('login-register/admin_chat_view', $data);
}
public function fetchMessages()
{
    $model = new ChatModel();
    $messages = $model->getMessages(); // Get messages from the database

    return $this->response->setJSON($messages); // Return messages as JSON
}

}
