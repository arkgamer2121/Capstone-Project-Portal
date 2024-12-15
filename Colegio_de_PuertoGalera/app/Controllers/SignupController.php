<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SignupController extends BaseController
{
    public function index()
    {
        helper(['form']);
        echo view('login-register/signup');
    }
    public function userdata()
    {
        $userModel = new UserModel();
        $userData = $userModel->findAll(); // Retrieve all user data from the database
        
        // Pass user data to the view
        return view('admin/allusers', ['users' => $userData]);
    }


    public function delete($id)
    {
        $userModel = new UserModel();

        // Find the user by ID
        $user = $userModel->find($id);

        // Check if the user exists
        if (!$user) {
            // If user not found, return an error or redirect to an error page
            return redirect()->to('/error-page');
        }

        // Delete the user from the database
        $userModel->delete($user['id']);

        // Redirect back to the user listing page
        return redirect()->to('/allusers')->with('success', 'user deleted successfully');
    }

    protected $validation; // Define $validation property

    public function __construct()
    {
        $this->validation = \Config\Services::validation(); // Load validation library
    }

//     public function store()
// {
//     helper(['form']);

//     // Validation rules
//     $rules = [
//         'name' => 'required|min_length[2]|max_length[50]',
//         'email' => [
//             'rules' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
//             'errors' => [
//                 'is_unique' => 'This email is already registered. Please use another email address.'
//             ]
//         ],
//         'password' => 'required|min_length[8]|max_length[50]',
//         'confirmpassword' => [
//             'rules' => 'required|matches[password]',
//             'errors' => [
//                 'matches' => 'Passwords do not match. Please try again.'
//             ]
//         ],
//     ];

//      // Run validation
//     if (!$this->validation->setRules($rules)->withRequest($this->request)->run()) {
//         // Redirect back to the signup form with validation errors
//         return redirect()->back()->withInput()->with('validation', $this->validation);
//     }

//     // If validation passes, proceed with saving the user data

//     // Generate a verification code for email verification
//     $verificationCode = uniqid();

//     // Hash the password before storing it in the database
//     $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

//     // Prepare user data for database insertion
//     $userData = [
//         'name' => $this->request->getPost('name'),
//         'email' => $this->request->getPost('email'),
//         'password' => $hashedPassword,
//         'verification_code' => $verificationCode,
//         'verification_code_expires_at' => date('Y-m-d H:i:s', time() + 3600), // Verification code expires in 1 hour
//         'is_super_admin' => $this->determineSuperAdminStatus($this->request->getPost('email')), // Super admin logic
//     ];

//     // Insert user data into the database
//     $userModel = new UserModel();
//     $userModel->insert($userData);

//     // Send a verification email to the user
//     $this->sendVerificationEmail($userData['email'], $verificationCode);

//     // Set the email in session for future verification
//     session()->set('email', $userData['email']);

//     // Redirect the user to the verification page
//     return redirect()->to('/verification_form');
// }

    public function store()
    {
        helper(['form']);
    
        // Validation rules
        $rules = [
             'student_id' => 'required|regex_match[/^[0-9]{4}-[0-9]+$/]',  // Allows formats like 2024-0, 2024-000, or 2024-0000  // Match format like 2021-00000
            'email' => 'required|min_length[4]|max_length[100]|valid_email',
            'password' => 'required|min_length[8]|max_length[50]',
            'confirmpassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'matches' => 'Passwords do not match. Please try again.'
                ]
            ],
        ];
    
        // Run validation
        if (!$this->validation->setRules($rules)->withRequest($this->request)->run()) {
            return redirect()->to('/signup')->withInput()->with('validation', $this->validation);
        }
    
        // Load the User model
        $userModel = new UserModel();
    
        // Get student_id and email from form input
        $studentId = $this->request->getPost('student_id');
        $email = $this->request->getPost('email');
    
        // Check if student_id exists in the database (it should already exist)
        $existingUser = $userModel->where('student_id', $studentId)->first();
    
        if (!$existingUser) {
            // If the student ID doesn't exist, return an error
            return redirect()->to('/signup')->with('error', 'Invalid student ID. You are not registered.');
        }
    
        // Check if the student_id already has an associated email
        if (!empty($existingUser['email'])) {
            // If the student_id already has an email, do not allow further sign-ups
            return redirect()->to('/signup')->with('error', 'This student ID is already associated with an email. Sign-up not allowed.');
        }
    
        // Check if the email already exists in the database (to prevent duplicate emails)
        $existingEmail = $userModel->where('email', $email)->first();
    
        if ($existingEmail) {
            // If the email already exists, return an error
            return redirect()->to('/signup')->with('error', 'Email already exists. Please use a different email.');
        }
    
        // Prepare user data to update
        $verificationCode = uniqid();
        $expirationTime = time() + 600; // 10 minutes expiration for verification
    
        $updatedUserData = [
            'email' => $email,
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // Hash the password
            'verification_code' => $verificationCode,
            'verification_code_expires_at' => date('Y-m-d H:i:s', $expirationTime),
            'is_super_admin' => $this->determineSuperAdminStatus($email),
            'status' => 'inactive', // Set status to inactive until email verification
        ];
    
        // Update the existing record in the database based on student_id
        $userModel->update($existingUser['id'], $updatedUserData);
    
        // Send verification email
        $this->sendVerificationEmail($email, $verificationCode);
    
        // Store email in session for verification process
        session()->set('email', $email);
    
        // Redirect to verification form page
        return redirect()->to('/verification_form');
    }

    
    // Function to determine super admin status based on email
    private function determineSuperAdminStatus($email)
    {
        // Example: Check if the email belongs to a super admin domain
        $superAdminDomains = ['degaleracolegio@gmail.com']; // Replace with your super admin domains
        $domain = explode('@', $email)[1];
        
        return in_array($domain, $superAdminDomains) ? 1 : 0;
       
    }
    public function edit($id)
    {
        $userModel = new UserModel();

        // Fetch the user by ID
        $user = $userModel->find($id);

        // Check if the user exists
        if (!$user) {
            // If not found, redirect to an error page or show a 404 error
            return redirect()->to('/error-page');
        }

        // Pass the user data to the edit view
        return view('admin/edituser', ['user' => $user]);
    }

    public function update($id)
    {
        $userModel = new UserModel();

        // Fetch the user by ID
        $user = $userModel->find($id);

        // Check if the user exists
        if (!$user) {
            // If not found, redirect to an error page or show a 404 error
            return redirect()->to('/error-page');
        }

        // Handle profile picture upload
        $file = $this->request->getFile('profile_picture');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('./uploads', $newName);
            $profilePicture = $newName;
        } else {
            $profilePicture = $user['profile_picture']; // Use existing profile picture if no new picture is uploaded
        }

        // Get the updated data from the form
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'profile_picture' => $profilePicture,
            'verification_code' => $this->request->getPost('verification_code'),
            'verified' => $this->request->getPost('verified'),
            // Add other fields as needed
        ];

        // Update user data in the database
        $userModel->update($id, $data);

        // Redirect back to the user listing page with a success message
        return redirect()->to('/allusers')->with('success', 'User updated successfully');
    }

    // Function to send verification email
    private function sendVerificationEmail($recipientEmail, $verificationCode)
    {
        // PHPMailer configuration
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Update with your SMTP host
            $mail->SMTPAuth = true;
            $mail->Username = 'degaleracolegio@gmail.com'; // SMTP username
            $mail->Password = 'hrxlrwtdyjguxivk'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('degaleracolegio@gmail.com', 'ColegiodePuertoGalera');
            $mail->addAddress($recipientEmail); // Add a recipient
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Email Verification';
            $mail->Body    = 'Your verification code is: ' . $verificationCode;

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        } 
    }
}
