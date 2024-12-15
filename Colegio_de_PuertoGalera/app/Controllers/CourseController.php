<?php

namespace App\Controllers;

use App\Models\CourseModel;
use CodeIgniter\Controller;

class CourseController extends Controller
{
    public function index()
    {
        $model = new CourseModel();
        $data['courses'] = $model->findAll();
        return view('courses/course_list', $data);
    }

    public function create()
    {
        return view('courses/course_form');
    }

    public function store()
    {
        $model = new CourseModel();

        $image = $this->request->getFile('image');
        $imageName = $image ? $image->getRandomName() : null;
        
        if ($image) {
            $image->move('uploads/', $imageName);
        }

        $data = [
            'image' => $imageName,
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'course' => $this->request->getPost('course'),
            'course_unit' => $this->request->getPost('course_unit'),
            'subject' => $this->request->getPost('subject'),
            'course_year' => $this->request->getPost('course_year'), // New field for course year
            'sections' => json_encode($this->request->getPost('sections')), // New field for sections
        ];

        $model->save($data);
        return redirect()->to('/courses');
    }

    public function edit($id)
    {
        $model = new CourseModel();
        $data['course'] = $model->find($id);
        return view('courses/course_form', $data);
    }

    public function update($id)
    {
        $model = new CourseModel();
        $course = $model->find($id);

        $image = $this->request->getFile('image');
        if ($image && $image->isValid()) {
            $imageName = $image->getRandomName();
            $image->move('uploads/', $imageName);
            if ($course['image']) {
                unlink('uploads/' . $course['image']); // delete old image
            }
        } else {
            $imageName = $course['image'];
        }

        $data = [
            'image' => $imageName,
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'course' => $this->request->getPost('course'),
            'course_unit' => $this->request->getPost('course_unit'),
            'subject' => $this->request->getPost('subject'),
            'course_year' => $this->request->getPost('course_year'), // New field for course year
            'sections' => json_encode($this->request->getPost('sections')), // New field for sections
        ];

        $model->update($id, $data);
        return redirect()->to('/courses');
    }

    public function delete($id)
    {
        $model = new CourseModel();
        $course = $model->find($id);
        if ($course['image']) {
            unlink('uploads/' . $course['image']); // delete image
        }
        $model->delete($id);
        return redirect()->to('/courses');
    }
}
