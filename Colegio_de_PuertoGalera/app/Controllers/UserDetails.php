<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserDetails extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id'); // Assuming you store the user ID in the session

        if (!$userId) {
            return redirect()->to('/userdetails'); // Redirect to sign-in if user is not logged in
        }

        $userModel = new UserModel();
        $data['user'] = $userModel->find($userId); // Fetch user details from the database

        return view('userdetails', $data); // Load the view with user data
    }

    public function store()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/signin');
        }

        $userModel = new UserModel();

        // Validation rules
        $this->validate([
            'contact' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'age' => 'required|integer',
            'blood_type' => 'required',
        ]);

        // Update user details
        $userModel->update($userId, [
            'contact' => $this->request->getPost('contact'),
            'address' => $this->request->getPost('address'),
            'gender' => $this->request->getPost('gender'),
            'age' => $this->request->getPost('age'),
            'other_information' => $this->request->getPost('other_information'),
            'blood_type' => $this->request->getPost('blood_type'),
        ]);

        return redirect()->to('userdetails')->with('message', 'Profile updated successfully.');
    }
}
