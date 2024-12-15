<?php

namespace App\Controllers;

use App\Models\Schedule;
use App\Models\ScheduleHistory; 
use App\Models\FacultyModel;
use App\Models\SubjectModel;
use App\Models\CourseYearModel;
use App\Controllers\BaseController;

class ScheduleController extends BaseController
{
    public function index()
    {
        $scheduleModel = new Schedule();
        $facultyModel = new FacultyModel();
        $subjectModel = new SubjectModel();
        
        // Get distinct years from the SubjectModel
        $years = $subjectModel->getDistinctYears();
        
        // Get all subjects
        $subjects = $subjectModel->findAll();
        
        // Group subjects by year for course filtering
        $coursesByYear = [];
        foreach ($subjects as $subject) {
            $coursesByYear[$subject['year']][] = $subject['course'];
        }
    
        $data = [
            'schedules' => $scheduleModel->findAll(),
            'faculty' => $facultyModel->findAll(),
            'subjects' => $subjects,
            'coursesByYear' => $coursesByYear,  // Pass courses grouped by year to the view
            'years' => $years,  // Pass distinct years to the view
        ];
    
        return view('schedule/index', $data);
    }

    
    
    public function create()
    {
        $facultyModel = new FacultyModel();
        $subjectModel = new SubjectModel();
       
    
        // Pass necessary data to the view
        $data = [
            'faculty' => $facultyModel->findAll(),
            'subjects' => $subjectModel->findAll(),
            
        ];
    
        if ($this->request->getMethod() === 'post') {
            $scheduleModel = new Schedule();
    
            // Collect and validate form data
            $scheduleData = [
                'faculty_name'   => $this->request->getPost('faculty_select'),
                'days_of_week'   => $this->request->getPost('days_of_week'),
                'year'           => $this->request->getPost('year'),
                'course'         => $this->request->getPost('course'),
                'section'        => $this->request->getPost('section'),
                'subject_code'   => $this->request->getPost('subject_code'),
                'subject'        => $this->request->getPost('subject'),
                'time_from'      => $this->request->getPost('time_from'),
                'time_to'        => $this->request->getPost('time_to'),
                'room'           => $this->request->getPost('room'),
                'description'    => $this->request->getPost('description'),
                'schedule_type'  => $this->request->getPost('schedule_type'),
                'sem'            => $this->request->getPost('sem'),
            ];
    
            // Validate required fields
            if (empty($scheduleData['faculty_name']) || empty($scheduleData['days_of_week']) || empty($scheduleData['year']) || 
                empty($scheduleData['course']) || empty($scheduleData['section']) || empty($scheduleData['subject_code']) || 
                empty($scheduleData['time_from']) || empty($scheduleData['time_to'])) {
                return redirect()->back()->with('error', 'All fields are required.');
            }
    
            // Insert data into the database
            $scheduleModel->insert($scheduleData);
    
            return redirect()->to('/schedule')->with('success', 'Schedule created successfully!');
        }
    
        return view('schedule/create', $data);

    }
    
    public function update($id)
    {
        if ($this->request->getMethod() === 'post') {
            $model = new Schedule();
            $historyModel = new ScheduleHistory();
    
            $data = [
            'faculty_name'   => $this->request->getPost('faculty_name'),
            'days_of_week'   => $this->request->getPost('days_of_week'),
            'subject_code'   => $this->request->getPost('subject_code'),
            'subject'        => $this->request->getPost('subject'),
            'time_from'      => $this->request->getPost('time_from'),
            'time_to'        => $this->request->getPost('time_to'),
            'room'           => $this->request->getPost('room'),
            'sem'            => $this->request->getPost('sem'),
            'description'    => $this->request->getPost('description'),
            'year'           => $this->request->getPost('year'),
            'section'        => $this->request->getPost('section'),
            'schedule_type'  => $this->request->getPost('schedule_type')
            ];
    
            $model->update($id, $data);
    
            // Log the update into the history model
            $historyData = [
                'schedule_id' => $id,
                'updated_by' => 'admin', // Update to reflect the actual user
                'update_time' => date('Y-m-d H:i:s'),
            ];
    
            $historyModel->insert($historyData);
    
            // Set a flash message to indicate success
            session()->setFlashdata('update_success', 'Schedule updated successfully.');
    
            return redirect()->to('/schedule');
        }
    
        return view('schedule/edit', ['id' => $id]);
    }
    
    public function delete($id)
{
    $scheduleModel = new Schedule();

    // Find the schedule by ID
    $schedule = $scheduleModel->find($id);

    // Delete the schedule from the database
    $scheduleModel->delete($id);

    // Redirect back to the schedule listing page
    return redirect()->to('/schedule')->with('success', 'Schedule deleted successfully');
}




}
