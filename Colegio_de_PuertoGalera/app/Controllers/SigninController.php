<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class SigninController extends BaseController
{
    public function index()
    {
        helper(['form']);
        echo view('login-register/signin');
    } 
    
    public function logout()
{
    log_message('info', 'Logout method called.');
    session()->destroy();
    session()->setFlashdata('success', 'You have been logged out successfully.');

    // Redirect to the login page or homepage
    return redirect()->to('/signin');
}

  
public function loginAuth()
{
    $session = session();
    $userModel = new UserModel();
    $email = $this->request->getVar('email');
    $password = $this->request->getVar('password');
    $verificationCode = $this->request->getVar('verification_code'); // Assuming you have a field for verification code in your form

    // Check if the email is verified before allowing login
    if (!$userModel->isEmailVerified($email)) {
        if ($verificationCode !== 'correct_verification_code') { // Replace 'correct_verification_code' with the actual correct verification code
            $session->setFlashdata('error', 'Your account is not verified. Please provide the correct verification code.');
            $session->set('incorrect_verification_code', true); // Set session variable indicating incorrect verification code
            return redirect()->to('/signin');
        } else {
            // Mark email as verified
            $userModel->markEmailAsVerified($email); // Assuming you have a method to mark email as verified in your UserModel
            $session->setFlashdata('success', 'Your account is verified. Welcome to Colegio de Puerto Galera!');
        }
    }

    $data = $userModel->where('email', $email)->first();

    if ($data) {
        $pass = $data['password'];
        $authenticatePassword = password_verify($password, $pass);
        if ($authenticatePassword) {
            $ses_data = [
                'id' => $data['id'],
                'name' => $data['name'],
                'email' => $data['email'],
                'student_id' => $data['student_id'], // Add this line if applicable
                'isLoggedIn' => TRUE
            ];
            $session->set($ses_data);

            // Check if the logged-in user is the admin
            if ($email === 'degaleracolegio@gmail.com') {
                $redirectUrl = '/admin/profile/1'; // Admin route
            } else {
                $redirectUrl = '/profile'; // Regular user route
            }
            
            // Redirect the user
            return redirect()->to($redirectUrl);
        } else {
            $session->setFlashdata('error', 'Password is incorrect.');
            return redirect()->to('/signin');
        }
    } else {
        $session->setFlashdata('msg', 'Email does not exist.');
        return redirect()->to('/signin');
    }
}

    
    // Function to determine redirect URL based on user's email
    private function getRedirectUrl($email)
    {
        // Check if the user is degaleracolegio@gmail.com
        if ($email === 'degaleracolegio@gmail.com') {
            return '/admin'; // Redirect to the admin page
        } else {
            return '/currentenroll'; // Redirect to the currentenroll page for other users
        }
    }
}
