<?php
namespace App\Controllers;

use App\Models\SupportingDocumentsModel;
use App\Models\UserModel;

class SupportingDocuments extends BaseController
{
    public function index()
    {
        $model = new SupportingDocumentsModel();
        $data['documents'] = $model->getDocuments();

        // Initialize session
        $session = session();
        $userModel = new UserModel();
        $user = $userModel->where('email', $session->get('email'))->first();

        // Define default profile picture if none is set
        $data['profile_picture'] = $user['profile_picture'] ? 'writable/uploads/' . $user['profile_picture'] : '/path/to/default/profile-picture.png';
        $data['name'] = $user['name']; // Add user name to data

        return view('supporting_documents', $data);
    }

    public function upload()
    {
        $model = new SupportingDocumentsModel();

        // Validate the form data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'type' => 'required',
            'title' => 'required',
            'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,png,jpg,jpeg,pdf,docx]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->to('/supporting-documents')->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle file upload
        $file = $this->request->getFile('file');

        if ($file->isValid() && !$file->hasMoved()) {
            // Move the file to the desired location
            $filePath = 'uploads/' . $file->getName();
            $file->move('uploads/', $file->getName());

            // Save the document details to the database
            $model->save([
                'type' => $this->request->getPost('type'),
                'title' => $this->request->getPost('title'),
                'file_name' => $file->getName(), // Add this line
                'date_uploaded' => date('Y-m-d H:i:s'),
                'status' => 'active',
            ]);
        }

        return redirect()->to('/supporting-documents');
    }

    public function displayDocuments()
    {
        $model = new SupportingDocumentsModel();
        $data['documents'] = $model->getDocuments(); // Ensure this method retrieves the necessary document data

        return view('documents_display', $data);
    }
}
