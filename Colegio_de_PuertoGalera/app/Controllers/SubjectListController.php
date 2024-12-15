<?php

namespace App\Controllers;

use App\Models\SubjectModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;

class SubjectListController extends BaseController
{
    public function create()
    {
        return view('admin/subject_list'); // Return the view for the form
    }
    public function index()
    {
        $subjectModel = new SubjectModel();

        // Get all subjects from the database
        $subjects = $subjectModel->findAll();

        // Pass the data to the view
        return view('admin/subject_list_table', ['subjects' => $subjects]);
    }

    public function store()
{
    $subjectModel = new SubjectModel();

    // Get the data from the POST request
    $data = [
        'course' => $this->request->getPost('course'),       // Course from the dropdown
        'year' => $this->request->getPost('year'),           // Year from the input
        'unit' => $this->request->getPost('unit'),           // Unit from the input
        'name' => $this->request->getPost('name'),           // Subject code from the input
        'description' => $this->request->getPost('description'), // Subject description from the input
        'semester' => $this->request->getPost('semester'), 
    ];

    // Attempt to insert the data into the database
        $subjectModel->insert($data);
        return redirect()->to('/teacherform');
}

    public function edit($id)
    {
        $subjectModel = new SubjectModel();
        $subject = $subjectModel->find($id); // Find subject by ID

        if (!$subject) {
            return redirect()->to('/subject_list')->with('error', 'Subject not found.');
        }

        return view('admin/subject_edit', ['subject' => $subject]);
    }

    public function update($id)
    {
        $subjectModel = new SubjectModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];

        $subjectModel->update($id, $data); // Update subject
        return redirect()->to('/subject_list')->with('success', 'Subject updated successfully.');
    }

    public function delete($id)
    {
        $subjectModel = new SubjectModel();
    
        // Check if the subject exists before trying to delete it
        if ($subjectModel->find($id)) {
            $subjectModel->delete($id); // Delete subject by ID
            return redirect()->to('/subject_list')->with('success', 'Subject deleted successfully.');
        } else {
            return redirect()->to('/subject_list')->with('error', 'Subject not found.');
        }
    }

}
