<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RequestModel;
use CodeIgniter\HTTP\RedirectResponse;
use DateTime;

class ProfileController extends BaseController
{
    protected $helpers = ['custom_helper']; // Load custom helper

    public function index()
    {
        $requestModel = new RequestModel();
        $userModel = new UserModel();
        $session = session();
    
        // Get the current logged-in user's email
        $userEmail = $session->get('email');
        $user = $userModel->where('email', $userEmail)->first();
    
        // Redirect to login if the user is not found
        if (!$user) {
            return redirect()->to('/signin')->with('error', 'User not found. Please log in.');
        }
    
        // Define default profile picture if none is set
        $profilePicture = $user['profile_picture'] ? 'writable/uploads/' . $user['profile_picture'] : '/path/to/default/profile-picture.png';
    
        // Fetch only approved and rejected requests for the logged-in user
        $notifications = $requestModel->where('student_id', $user['student_id'])
                                      ->whereIn('status', ['Approved', 'Rejected'])
                                      ->orderBy('updated_at', 'DESC')
                                      ->findAll();
    
        // Format notifications for display
        foreach ($notifications as &$notification) {
            if ($notification['status'] == 'Approved') {
                $notification['message'] = "Your request for {$notification['request_type']} has been approved and scheduled on {$notification['schedule_date']} at {$notification['schedule_time']}.";
            } elseif ($notification['status'] == 'Rejected') {
                $notification['message'] = "Your request for {$notification['request_type']} has been rejected. Reason: {$notification['reject_reason']}.";
            }
    
            // Format the updated_at timestamp for display as time ago using the helper function
            $notification['time_ago'] = time_elapsed_string($notification['updated_at']);
        }
    
        // Load the profile view and pass the filtered notifications and user data
        return view('student_portal/profile_view', [
            'notifications' => $notifications,
            'badgeCount' => count($notifications), // Count of non-pending notifications
            'userName' => $user['name'],
            'user' => $user,
            'profile_picture' => $profilePicture // Pass profile picture path
        ]);
    }
    

    public function uploadImage()
    {
        $session = session();
        $userModel = new UserModel();
        $user = $userModel->where('email', $session->get('email'))->first();
        
        // Default name for profile picture if no valid image is uploaded
        $newName = $user['profile_picture']; 
    
        // Handle file upload
        if ($this->request->getFile('profile_picture')->isValid()) {
            $profileImage = $this->request->getFile('profile_picture');
            
            // Check size and file type
            if ($profileImage->getSize() < 5242880 && in_array($profileImage->getExtension(), ['jpg', 'jpeg', 'png'])) {
                $newName = $profileImage->getRandomName();
                $profileImage->move('writable/uploads', $newName);
            }
        }
    
        // Handle captured image (optional, if you plan to allow captured image updates)
        $capturedImage = $this->request->getPost('captured_image');
        if ($capturedImage) {
            // Convert base64 to an actual image file
            list($type, $data) = explode(';', $capturedImage);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            
            $newName = uniqid() . '.png';
            file_put_contents('writable/uploads/' . $newName, $data);
        }
    
        // Update user's profile picture in the database
        $userModel->update($user['id'], ['profile_picture' => $newName]);
        $session->set('profile_picture', $newName);
    

    // Redirect back to the profile page
    return redirect()->to('/profile');
    }
    
     
    public function update()
    {
        $session = session(); // Initialize session
        $model = new UserModel();
        $userId = $this->request->getPost('user_id'); // Assuming you pass the user ID in your form
        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            // Add other fields similarly...
        ];

        $model->update($userId, $data); // Update user data
        $session->setFlashdata('success', 'Profile updated successfully.'); // Optional success message
        return redirect()->to('/profile'); // Redirect to the profile page or wherever you like
    }

    public function profile()
    {
        $session = session(); // Initialize session
        // Fetch user data (adjust according to your logic)
        $userId = $session->get('user_id'); // Ensure you're getting the user ID from session or request
        $userModel = new UserModel();
        $userData = $userModel->find($userId); // Assuming $userId is available
        
        // Pass the user data to the view
        return view('login-register/profile_view', [
            'name' => $userData['name'],
            'email' => $userData['email'],
            'contact' => $userData['contact'],
            'gender' => $userData['gender'],
            'address' => $userData['address'],
            'otherinformation' => $userData['other_information'] // Pass sex data to the view
        ]);
    }
}
