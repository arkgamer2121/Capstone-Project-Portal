<?php

namespace App\Controllers;

use App\Models\RequestModel;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\NotificationModel;

class RequestController extends Controller
{
    public function index()
    {
        $requestModel = new RequestModel();
        $data['requests'] = $requestModel->findAll(); // Fetch all requests

        // Initialize session
        $session = session();
        $userModel = new UserModel();
        $user = $userModel->where('email', $session->get('email'))->first();

        // Define default profile picture if none is set
        $data['profile_picture'] = $user['profile_picture'] ? 'writable/uploads/' . $user['profile_picture'] : '/path/to/default/profile-picture.png';
        $data['name'] = $user['name']; // Add user name to data

        return view('student_portal/request_form', $data);
    }
    public function approveRequest($requestId)
    {
        $requestModel = new RequestModel();
        $request = $requestModel->find($requestId);
        
        if (!$request) {
            return $this->response->setStatusCode(404, 'Request not found.');
        }
    
        // Update request status to approved
        $requestModel->update($requestId, ['status' => 'Approved']);
    
        // Add notification
        $notificationModel = new NotificationModel();
        $notificationModel->save([
            'user_id' => $request['user_id'],
            'message' => 'Your request for ' . $request['request_type'] . ' has been approved.',
        ]);
    
        return $this->response->setJSON(['message' => 'Request approved successfully!']);
    }
    
    
    
public function markAsRead($notificationId)
{
    $this->notificationModel->update($notificationId, ['is_read' => 1]);
    return redirect()->back()->with('message', 'Notification marked as read.');
}

public function create()
{
    $requestModel = new RequestModel();
    
    $data = [
        'request_type' => $this->request->getPost('request_type'),
        'name' => $this->request->getPost('name'),
        'student_id' => $this->request->getPost('student_id'), // New field
        'contact_number' => $this->request->getPost('contact_number'),
        'purpose_of_request' => $this->request->getPost('purpose'), // New field
        'specific_documents' => $this->request->getPost('specific_documents'), // New field
        'course' => $this->request->getPost('course'),
        'year' => $this->request->getPost('year'),
        'section' => $this->request->getPost('section'), // New field
        'status' => 'Pending', // Default status
        'created_at' => date('Y-m-d H:i:s'), // Add timestamp
        'updated_at' => date('Y-m-d H:i:s')  // Add timestamp
    ];

    // Debugging: Log data to ensure correctness
    log_message('debug', 'Request data: ' . print_r($data, true));

    if ($requestModel->save($data)) {
        return redirect()->to('/request')->with('message', 'Request submitted successfully!');
    } else {
        // Handle errors if save fails
        return redirect()->back()->withInput()->with('error', 'Failed to submit request.');
    }
}
public function submittedRequests()
{
    $requestModel = new RequestModel();
    
    // Fetch all requests instead of just 'Pending'
    $data['requests'] = $requestModel->findAll();

    // Load the view and pass the requests data
    return view('admin/submitted_requests', $data);
}

    public function showRequestForm()
    {
       $requestModel = new RequestModel();
    
    // Fetch all requests instead of just 'Pending'
    $data['requests'] = $requestModel->findAll();

    // Load the view and pass the requests data
    return view('admin/submitted_requests', $data);
    
    }
    
   private function sendSmsOrder($phone, $message)
{
    $ch = curl_init();
    $parameters = [
        'apikey' => 'f71a7a35ce364e0d4fd657a323a31c5e', // Replace with your Semaphore API key
        'number' => $phone,
        'message' => $message,
        'sendername' => 'CDPG'    // Replace with your registered sender name
    ];

    curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Send the request and store the response
    $output = curl_exec($ch);

    // Check for cURL errors
    if ($output === false) {
        $error = curl_error($ch);
        log_message('error', 'cURL Error: ' . $error);
        curl_close($ch);
        return false; // Failed to send SMS
    }

    $response = json_decode($output, true);
    curl_close($ch);

    // Check if the response indicates a success
    if (isset($response['status']) && $response['status'] === 'success') {
        log_message('info', 'SMS sent successfully to ' . $phone);
        return true; // SMS sent successfully
    } else {
        log_message('error', 'SMS failed to send: ' . json_encode($response));
        return false; // SMS failed to send
    }
}


public function reject($id)
{
    $reason = $this->request->getPost('reason');
    
    if (empty($reason)) {
        return $this->response->setStatusCode(400, 'Rejection reason is required');
    }

    $model = new RequestModel();
    $data = [
        'status' => 'Rejected',
        'reject_reason' => $reason
    ];
    
    if ($model->update($id, $data)) {
        $request = $model->find($id);
        $contactNumber = $request['contact_number'];

        $message = "Your request has been rejected. Reason: $reason.";
        $this->sendSmsOrder($contactNumber, $message);

        return $this->response->setJSON(['message' => 'Request rejected successfully!']);
    }
    
    return $this->response->setStatusCode(404, 'Request not found.');
}

public function approve($id)
{
    $model = new RequestModel();
    $scheduleDate = $this->request->getPost('schedule_date');
    $scheduleTime = $this->request->getPost('schedule_time');
    
    if (!$scheduleDate || !$scheduleTime) {
        return $this->response->setStatusCode(400)->setJSON(['error' => 'Schedule date and time are required.']);
    }

    $data = [
        'status' => 'Approved',
        'schedule_date' => $scheduleDate,
        'schedule_time' => $scheduleTime,
    ];
    
    if ($model->update($id, $data)) {
        $request = $model->find($id);
        $contactNumber = $request['contact_number'];

        $message = "Your request has been approved. Scheduled on $scheduleDate at $scheduleTime.";
        $this->sendSmsOrder($contactNumber, $message);

        return $this->response->setStatusCode(200)->setJSON(['success' => true, 'message' => 'Request approved successfully with schedule date and time.']);
    } else {
        return $this->response->setStatusCode(500)->setJSON(['error' => 'Error approving the request']);
    }
}


public function statusRequest()
{
    // Initialize session
    $session = session();

    // Load the UserModel to get user information
    $userModel = new UserModel();
    $user = $userModel->where('email', $session->get('email'))->first();

    // Define default profile picture if none is set
    $data['profile_picture'] = $user['profile_picture'] ? 'writable/uploads/' . $user['profile_picture'] : '/path/to/default/profile-picture.png';
    $data['name'] = $user['name']; // Add user name to data
    $data['student_id'] = $user['student_id']; // Add student ID to data

    // Load the RequestModel
    $requestModel = new RequestModel();

    // Fetch requests for the logged-in student
    $requests = $requestModel->where('student_id', $data['student_id'])->findAll();

    // Pass the requests data along with user profile data to the view
    $data['requests'] = $requests;

    return view('student_portal/status_request', $data);
}
}