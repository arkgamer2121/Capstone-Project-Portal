<?php

namespace App\Controllers;

use App\Models\SectionModel;
use App\Models\EnrolledStudentModel;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


use App\Controllers\BaseController;

class SectionController extends BaseController
{
    protected $sectionModel;
    protected $studentModel;

    public function __construct()
    {
        $this->sectionModel = new SectionModel();
        $this->studentModel = new EnrolledStudentModel();
    }

    public function sectioning(){

        return view('admin/sectioning');
    }

    public function upload()
    {
        helper(['form', 'url']);
    
        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('file');
    
            if ($file && $file->isValid() && $file->getExtension() === 'xlsx') {
                $reader = new Xlsx();
                $spreadsheet = $reader->load($file->getTempName());
                $sheet = $spreadsheet->getActiveSheet();
                $data = $sheet->toArray();
    
                $headers = array_shift($data); // Get the first row as headers
                $nameIndex = array_search('NAME', $headers);
    
                if ($nameIndex === false) {
                    return redirect()->back()->with('error', 'The file must contain a "Name" column.');
                }
    
                // Get input data
                $numSections = $this->request->getPost('num_sections');
                $sectionNames = $this->request->getPost('section_names'); // Array of section names
                $year = $this->request->getPost('year');
                $course = $this->request->getPost('course');
    
                if (count($sectionNames) != $numSections) {
                    return redirect()->back()->with('error', 'Please provide names for all sections.');
                }
    
                // Shuffle and split students into sections
                shuffle($data);
                $sections = array_chunk($data, ceil(count($data) / $numSections));
    
                // Insert sections and assign students
                foreach ($sections as $i => $students) {
                    $sectionData = [
                        'name' => $sectionNames[$i], // Use the dynamic section name
                        'year' => $year,
                        'course' => $course,
                    ];
    
                    $this->sectionModel->insert($sectionData);
                    $sectionId = $this->sectionModel->getInsertID();
    
                    foreach ($students as $student) {
                        $this->studentModel->insert([
                            'name' => $student[$nameIndex],
                            'section_id' => $sectionId,
                        ]);
                    }
                }
    
                return redirect()->back()->with('success', 'Sections created successfully.');
            }
    
            return redirect()->back()->with('error', 'Invalid file upload.');
        }
    
        return view('admin/sectioning');
    }
    

    public function list()
    {
        // Get filter values from GET request
        $course = $this->request->getGet('course');
        $year = $this->request->getGet('year');
        $section = $this->request->getGet('section');
    
        // Prepare conditions array for filtering
        $conditions = [];
    
        if ($course) {
            $conditions['sections.course'] = $course; // Qualify with table name
        }
    
        if ($year) {
            $conditions['sections.year'] = $year; // Qualify with table name
        }
    
        if ($section) {
            $conditions['sections.name'] = $section; // Qualify with table name
        }
    
        // Fetch sections based on filters using the model
        $sections = $this->sectionModel
            ->select('sections.id, sections.name as section_name, sections.year, sections.course, enrolled_students.name as student_name')
            ->join('enrolled_students', 'sections.id = enrolled_students.section_id', 'left')
            ->where($conditions)
            ->orderBy('sections.course', 'ASC')
            ->findAll();
    
        // Fetch distinct courses, years, and sections for filtering options
        $courses = $this->sectionModel->distinct()->select('course')->findAll();
        $years = $this->sectionModel->distinct()->select('year')->findAll();
        $sectionNames = $this->sectionModel->distinct()->select('name')->findAll();
    
        // If the request is an AJAX request, return data as JSON
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'sections' => $sections,
                'courses' => $courses,
                'years' => $years,
                'sectionNames' => $sectionNames,
            ]);
        }
    
        // Regular response (for non-AJAX requests)
        return view('admin/section_list', [
            'sections' => $sections,
            'courses' => $courses,
            'years' => $years,
            'sectionNames' => $sectionNames,
            'selectedCourse' => $course,
            'selectedYear' => $year,
            'selectedSection' => $section,
        ]);
    }


    

}
