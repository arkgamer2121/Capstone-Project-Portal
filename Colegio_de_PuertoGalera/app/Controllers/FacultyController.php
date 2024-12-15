<?php

namespace App\Controllers;
use App\Models\FacultyModel;
use App\Models\Schedule;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Dompdf\Dompdf;
use Dompdf\Options;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use App\Controllers\BaseController;

class FacultyController extends BaseController
{
     protected $facultyModel;

    public function __construct()
    {
        $this->facultyModel = new FacultyModel();
        $this->scheduleModel = new Schedule();
    }

    public function index()
    {
        // Fetch all faculty records from the model
        $data['faculty'] = $this->facultyModel->findAll();

        // Pass the data to the view
        return view('admin/faculty_list', $data);
    }

    public function create()
    {
        return view('admin/faculty_create');
    }

    public function store()
    {
        $this->facultyModel->save([
            'id_no' => $this->request->getPost('id_no'),
            'last_name' => $this->request->getPost('last_name'),
            'first_name' => $this->request->getPost('first_name'),
            'middle_name' => $this->request->getPost('middle_name'),
            'email' => $this->request->getPost('email'),
            'contact' => $this->request->getPost('contact'),
            'gender' => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
        ]);

        return redirect()->to('/faculty');
    }

    public function edit($id)
    {
        $data['faculty'] = $this->facultyModel->find($id);
        return view('admin/faculty_edit', $data);
    }

    public function update($id)
    {
        $this->facultyModel->update($id, [
            'id_no' => $this->request->getPost('id_no'),
            'last_name' => $this->request->getPost('last_name'),
            'first_name' => $this->request->getPost('first_name'),
            'middle_name' => $this->request->getPost('middle_name'),
            'email' => $this->request->getPost('email'),
            'contact' => $this->request->getPost('contact'),
            'gender' => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
        ]);

        return redirect()->to('/faculty');
    }

    public function delete($id)
    {
        $this->facultyModel->delete($id);
        return redirect()->to('/faculty');
    }
    public function details($id)
    {
        $faculty = $this->facultyModel->find($id);
        $schedules = []; // Initialize schedules array
        
        // Fetch schedules associated with the faculty member
        if (!empty($faculty)) {
            // Extract first and last name of faculty member
            $facultyName = $faculty['last_name'] . ', ' . $faculty['first_name'];
            
            // Fetch schedules where faculty name matches (using LIKE condition)
            $schedules = $this->scheduleModel->like('faculty_name', $facultyName)->findAll();
        }
        
        // Check if $faculty is not empty and is an array
        if (!empty($faculty) && is_array($faculty)) {
            $data['faculty'] = $faculty;
            $data['schedules'] = $schedules; // Pass schedules data to the view
            return view('admin/facultyscheduledetails', $data);
        } else {
            // Render an error view
            return view('admin/details_not_found', ['id' => $id]);
        }
    }
    
    public function generateReport($id)
    {
        $facultyModel = new FacultyModel();
        $scheduleModel = new Schedule();
    
        // Fetch specific faculty member by ID
        $faculty = $facultyModel->find($id);
    
        // Fetch schedules associated with the specific faculty member
        $schedules = [];
        if (!empty($faculty)) {
            $facultyName = $faculty['last_name'] . ', ' . $faculty['first_name'] . ' ' .$faculty['middle_name'];
            $schedules = $scheduleModel->like('faculty_name', $facultyName)->findAll();
        }
    
        // Pass the faculty and schedules data to the report view
        $data['faculty'] = $faculty;
        $data['schedules'] = $schedules;
    
        // Load the report view file
        $content = view('admin/facultyschedreport', $data);
    
        // Generate the PDF report using DOMPDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($content);
        $dompdf->setPaper('A4', 'portrait'); // Change 'landscape' to 'portrait'
        $dompdf->render();
        $dompdf->stream('facultysched_report.pdf', ['Attachment' => true]);
    }
   public function sendSchedule($id)
    {
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $message = $this->request->getPost('message');
            $attachment = $_FILES['attachment'];

            // Configure PHPMailer
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'degaleracolegio@gmail.com';                       // SMTP username
                $mail->Password   = 'hrxlrwtdyjguxivk';                        // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                            // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for PHPMailer::ENCRYPTION_SMTPS above

                // Recipients
                $mail->setFrom('degaleracolegio@gmail.com', 'ColegiodePuertoGalera');
                $mail->addAddress($email);                                 // Add a recipient

                // Attach file
                $mail->addAttachment($attachment['tmp_name'], $attachment['name']);    // Optional name

                // Content
                $mail->isHTML(true);                                      // Set email format to HTML
                $mail->Subject = 'Schedule';
                $mail->Body    = $message;

                $mail->send();
                // If sending successful, redirect with success message
                return redirect()->to('/faculty')->with('success', 'Email sent successfully');
            } catch (Exception $e) {
                // If sending fails, redirect with error message
                return redirect()->to('/faculty')->with('error', 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
            }
        } else {
            // If accessed directly without POST method, redirect to the faculty page
            return redirect()->to('/faculty');
        }
    }


}