<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminProfileModel;
use App\Models\RequestModel;
use DateTime;

class AdminProfileController extends BaseController
{
     protected $adminProfileModel;
    protected $helpers = ['custom_helper']; // Load custom helper

    public function __construct()
    {
        $this->adminProfileModel = new AdminProfileModel();
    }

    protected function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = [
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        ];
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
        public function updateProfile()
{
    $id = 1; // Replace with the actual ID of the admin if needed
    $data = [
        'name'           => $this->request->getPost('name'),
        'date_of_birth'  => $this->request->getPost('date_of_birth'),
        'email'          => $this->request->getPost('email'),
        'mobile'         => $this->request->getPost('mobile'),
        'address'        => $this->request->getPost('address'),
        // Include other fields as necessary
    ];

    // Update the profile
    $this->adminProfileModel->update($id, $data);

    // Redirect or return the updated profile
    return redirect()->to(base_url('admin/profile/' . $id)); // Redirect back to the profile page
}

    public function adminProfile($id)
    {
        $adminProfileModel = new AdminProfileModel();
        $requestModel = new RequestModel();

        $adminProfile = $adminProfileModel->getProfileById($id); // Use dynamic ID

        // Fetch requests for notifications
        $notifications = $requestModel->where('status', 'Pending')->findAll();

        foreach ($notifications as &$notification) {
            $notification['message'] = "{$notification['name']} has requested for {$notification['request_type']} in {$notification['course']}.";
            // Format the created_at timestamp for display
            $notification['time_ago'] = $this->time_elapsed_string($notification['created_at']);
        }

        // Pass the $adminProfile array properly to the view
        return view('admin/profile', [
            'adminProfile' => $adminProfile,
            'notifications' => $notifications,
            'totalNotifications' => count($notifications),
        ]);
    }
public function uploadProfilePicture()
{
    $file = $this->request->getFile('profile_picture');

    // Check if the file is valid
    if ($file->isValid() && !$file->hasMoved()) {
        // Define the path to store the uploaded file
        $newFileName = $file->getRandomName();
        
        // Move the file to the desired directory
        if ($file->move('assets/img/profiles', $newFileName)) {
            // Get the user ID from the hidden field
            $userId = $this->request->getVar('id');
            
            // Update the user's profile picture in the database
            $this->adminProfileModel->update($userId, [
                'user_image' => $newFileName
            ]);

            // Set a success message and redirect
            session()->setFlashdata('success', 'Profile picture updated successfully.');
        } else {
            // Set an error message if the move fails
            session()->setFlashdata('error', 'Failed to move uploaded file.');
        }
    } else {
        // Set an error message if the upload fails
        session()->setFlashdata('error', 'Failed to upload profile picture. Error: ' . $file->getErrorString());
    }

    log_message('info', 'Uploaded file: ' . $newFileName);
log_message('info', 'Upload Error: ' . $file->getErrorString());


    // Redirect to the profile page
    return redirect()->to('/admin/profile/' . $userId);
}
}