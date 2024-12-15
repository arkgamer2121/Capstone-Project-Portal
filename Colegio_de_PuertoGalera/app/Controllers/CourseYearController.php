<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseYearModel;
use App\Models\CourseModel;

class CourseYearController extends BaseController
{
   public function index()
{
    $model = new CourseYearModel();

    // Get filter inputs
    $filterCourse = $this->request->getGet('filterCourse');
    $filterYear = $this->request->getGet('filterYear');

    // Initialize the query
    $query = $model->select('*');

    // Apply filters if set
    if ($filterCourse) {
        $query->where('course', $filterCourse);
    }
    if ($filterYear) {
        $query->where('year', $filterYear);
    }

    // Execute the query and get results
    $data['coursesSections'] = $query->findAll();

    // Fetch sections based on the year and course (if necessary, adjust based on your model)
    $data['sections'] = $model->findAll(); // This assumes you have the sections in the same model

    // Pass data to the view
    return view('schedule/courses_sections_table', [
        'coursesSections' => $data['coursesSections'],
        'sections' => $data['sections'],
        'filterCourse' => $filterCourse,
        'filterYear' => $filterYear
    ]);
}

public function create()
{
    $courseModel = new CourseModel();

    $data['courses'] = $courseModel->findAll(); 

    return view('schedule/CourseYear', $data);
}

    public function store()
    {
        $courseYearModel = new CourseYearModel();

        // Get data from the POST request
        $course = $this->request->getPost('course');
        $year = $this->request->getPost('year');
        $sections = $this->request->getPost('sections'); // This will be an array of sections

        // Loop through each section and insert it into the database
        foreach ($sections as $section) {
            // Prepare data for insertion
            $data = [
                'course' => $course,
                'section' => $section,
                'year' => $year,
            ];

            // Attempt to insert the data
            if (!$courseYearModel->insert($data)) {
                return redirect()->back()->with('error', 'Failed to add sections');
            }
        }

        return redirect()->to('/courses-sections')->with('success', 'Sections added successfully');
    }

    public function edit($id)
    {
        $courseYearModel = new CourseYearModel();
        $data = $courseYearModel->find($id); // Find subject by ID

        if (!$subject) {
            return redirect()->to('/courses-sections')->with('error', 'Subject not found.');
        }

        return view('schedule/courses-sectyions', ['course' => $data]);
    }
    public function update($id)
    {
        // Code for updating a specific section
    }

    public function delete($id)
    {
        // Code for deleting a specific section
    }
}
