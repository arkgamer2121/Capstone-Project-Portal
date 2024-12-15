<?php

namespace App\Controllers;

use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Controllers\BaseController;

class StudentController extends BaseController
{
    public function index(){

        $userModel = new UserModel();
        // Fetch all students with a valid student_id
        $students = $userModel->where('student_id !=', null)->findAll(); // Adjust your query as needed
        echo view('admin/studentid_list', ['students' => $students]);

    }
    public function uploadExcel()
    {
        helper(['form', 'url']);

        // Validate if file is uploaded
        if ($this->request->getFile('excel_file')->isValid()) {

            $file = $this->request->getFile('excel_file');

            // Load PhpSpreadsheet to read the file
            $reader = new Xlsx();
            $spreadsheet = $reader->load($file->getTempName());
            $data = $spreadsheet->getActiveSheet()->toArray();

            $userModel = new UserModel();

            // Find the header row index
            $headerRow = array_map('strtolower', $data[0]);  // Convert header row to lowercase to avoid case sensitivity

            // Map column names to indexes
            $studentIdIndex = array_search('student no.', $headerRow);  // Find the index for 'STUDENT NO.' (case insensitive)
            if ($studentIdIndex === false) {
                $studentIdIndex = array_search('student number', $headerRow);  // Try with 'student number'
            }

            $nameIndex = array_search('name', $headerRow);  // Find the index for 'name' (case insensitive)
            if ($nameIndex === false) {
                $nameIndex = array_search('student name', $headerRow);  // Try with 'student name'
            }

            // Check if the required columns were found
            if ($studentIdIndex === false || $nameIndex === false) {
                return redirect()->to('/studentidList')->with('error', 'Required columns (Student No. and Name) not found in the Excel file.');
            }

            // Loop through the Excel data starting from row 2 (to skip headers)
            for ($i = 1; $i < count($data); $i++) {
                $row = $data[$i];

                // Prepare student data
                $studentData = [
                    'student_id' => $row[$studentIdIndex],  // Column mapped for student_id
                    'name' => $row[$nameIndex],  // Column mapped for name
                    'status' => 'inactive',  // Default status
                ];

                // Check if student_id already exists in the database
                $existingUser = $userModel->where('student_id', $studentData['student_id'])->first();

                if (!$existingUser) {
                    // Insert only if student_id doesn't exist to avoid duplicates
                    $userModel->insert($studentData);
                }
            }

            // Redirect with success message
            return redirect()->to('/studentidList')->with('success', 'Excel file uploaded and data inserted successfully!');
        } else {
            // Redirect with error if file upload fails
            return redirect()->to('/studentidList')->with('error', 'Please upload a valid Excel file.');
        }
    }
}
