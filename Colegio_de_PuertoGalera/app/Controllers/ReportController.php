<?php

namespace App\Controllers;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\FacultyModel;
use App\Models\Schedule;


use App\Controllers\BaseController;

class ReportController extends BaseController
{
    protected $facultyModel;
    protected $scheduleModel;

    public function __construct()
    {
        // Initialize the models in the constructor
        $this->facultyModel = new FacultyModel();
        $this->scheduleModel = new Schedule();
    }
    public function generatePdfPreview($id)
    {
            // Fetch faculty details
    $faculty = $this->facultyModel->find($id);

    // Initialize schedules array
    $schedules = [];

    if (!empty($faculty)) {
        // Extract the faculty's name
        $facultyName = $faculty['last_name'] . ', ' . $faculty['first_name'];

        // Fetch schedules associated with the faculty member
        $schedules = $this->scheduleModel->like('faculty_name', $facultyName)->findAll();
    }

    if (!empty($faculty) && is_array($faculty)) {
        // Generate the HTML content for the PDF
        $html = view('admin/pdf_template', compact('faculty', 'schedules'));

        // Initialize Dompdf
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $dompdf = new Dompdf($options);

        // Load the HTML into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation (optional)
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        // Stream the PDF to the browser
        $dompdf->stream('report-preview.pdf', ['Attachment' => false]);
    } else {
        // Render an error view or return an appropriate response
        return view('admin/details_not_found', ['id' => $id]);
    }
    exit();
}
}
