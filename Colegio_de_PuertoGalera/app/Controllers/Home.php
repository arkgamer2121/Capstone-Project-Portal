<?php

namespace App\Controllers;
use App\Models\TeachersModel;
use App\Models\EventsModel;
use App\Models\NewsModel;
use App\Models\SubjectModel;
use App\Models\AdminProfileModel;
use App\Models\RequestModel;
use App\Models\UserModel;
use App\Models\GformlinkModel;
use App\Models\CourseModel;

class Home extends BaseController
{
        public function __construct() {
        $this->GformlinkModel = new GformlinkModel(); 
    }
     protected $helpers = ['custom_helper']; // Add this line to load your custom helper

    protected function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
        
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = [
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        ];
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    
        public function getLiveVisitors()
    {
 // Define your API URL and necessary headers
    $url = 'https://simpleanalytics.com/colegiodepuertogalera.online.json?version=5&fields=histogram';
    $apiKey = 'sa_api_key_KCErnPZxtHI2hyNsBlEhWkZmCF3ucjSEhxGH'; // Replace with your API key

    // Initialize cURL session
    $ch = curl_init($url);
    
    // Set the required options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Api-Key: ' . $apiKey,
    ]);

    // Execute the cURL session and get the response
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if (curl_errno($ch)) {
        return $this->response->setJSON(['error' => 'Failed to fetch data from API']);
    }

    // Close cURL session
    curl_close($ch);
    
    // Decode the response
    $data = json_decode($response, true);

    // Prepare arrays for dates and visitor counts
    $dates = [];
    $visitors = [];

    // Check if histogram data is available
    if (isset($data['histogram']) && is_array($data['histogram'])) {
        foreach ($data['histogram'] as $entry) {
            $dates[] = $entry['date']; // Get the date
            $visitors[] = $entry['visitors']; // Get the visitor count
        }
    }

    // Return the visitor counts and dates as JSON
    return $this->response->setJSON(['dates' => $dates, 'visitors' => $visitors]);
    }



    public function index()
    {
        $teacherModel = new TeachersModel();
        $teachers = $teacherModel->findAll(); // Fetch all teachers from the database
    
        // Fetch upcoming events
        $eventModel = new EventsModel();
        $events = $eventModel->where('event_date >=', date('Y-m-d'))
                            ->orderBy('event_date', 'asc')
                            ->findAll(4); // Fetch 4 upcoming events
    
        // Format the event time to display as a range
        foreach ($events as &$event) {
            $event['event_time'] = date('h:i A', strtotime($event['event_start_time'])) . ' - ' . date('h:i A', strtotime($event['event_end_time']));
        }
    
        return view('userpage/index', ['teachers' => $teachers, 'events' => $events]);
    }
    

    public function aboutus()
    {
        $teacherModel = new TeachersModel();

        // Fetch all teachers from the database
        $teachers = $teacherModel->findAll();

        // Pass the teachers data to the view
        return view('userpage/aboutus', ['teachers' => $teachers]);
        
    }

  
    public function courses()
    {
        $courseModel = new CourseModel();
    
        // Get all the courses
        $data['courses'] = $courseModel->findAll();
        
        // Load the view with the courses data, but now with the 'userpage/courses' layout
        return view('userpage/courses', $data);
    }

    public function admission()
    {
        // Load the model to get the latest Google Form link
        $formLinkData = $this->GformlinkModel->where('show_link', 1)->orderBy('id', 'DESC')->first();
    
        $googleFormLink = $formLinkData['form_link'] ?? null;
        $showLink = isset($formLinkData['show_link']) ? (bool)$formLinkData['show_link'] : false; // Cast to boolean
    
        return view('userpage/admission', [
            'googleFormLink' => $googleFormLink,
            'showLink' => $showLink
        ]);
    }

    public function teachers()
    {
        $teacherModel = new TeachersModel();

        // Fetch all teachers from the database
        $teachers = $teacherModel->findAll();

        return view('userpage/teachers',  ['teachers' => $teachers]);
    }

//contact
        public function contact()
            {
                return view('userpage/contact');
            }


    //admin

    public function admin()
    {
        $teacherModel = new TeachersModel();
        $eventsModel = new EventsModel();
        $newsModel = new NewsModel();
        $subjectsModel = new SubjectModel();
        $userModel = new UserModel();
        // Fetch all teachers from the database
        $teachers = $teacherModel->findAll();
        
        // Fetch all events from the database
        $events = $eventsModel->findAll();
        
        // Fetch all news from the database
        $news = $newsModel->findAll();
        $users = $userModel->findAll();

        $subject = $subjectsModel->findAll();
    
        // Calculate the total count of teachers, events, and news
        $totalTeachers = count($teachers);
        $totalEvents = count($events);
        $totalNews = count($news);
        $totalSubjects = count( $subject);
        $totalUser = count( $users);
        $totalRequest = count( $request );

 
    
        return view('admin/index', [
            'teachers' => $teachers,
            'totalTeachers' => $totalTeachers,
            'totalEvents' => $totalEvents,
            'totalNews' => $totalNews,
            'totalSubjects' =>  $totalSubjects,
            'totalRequest' => $totalRequest
        ]);
    
    }
      public function dashboard()
{
    $teacherModel = new TeachersModel();
    $eventsModel = new EventsModel();
    $newsModel = new NewsModel();
    $subjectsModel = new SubjectModel();
    $adminProfileModel = new AdminProfileModel();
    $requestModel = new RequestModel();
    $userModel = new UserModel();
    
    // Fetch all data
    $teachers = $teacherModel->findAll();
    $events = $eventsModel->findAll();
    $news = $newsModel->findAll();
    $subjects = $subjectsModel->findAll();
    $adminProfile = $adminProfileModel->getProfileById(1);
    $users = $userModel->findAll();
    
    // Fetch requests for notifications
    $notifications = $requestModel->where('status', 'Pending')->findAll();
    
    // Format notification messages and timestamps
    //Format notification messages and timestamps
    foreach ($notifications as &$notification) {
        $notification['message'] = "{$notification['name']} has requested for {$notification['request_type']} in {$notification['course']}.";
        // Format the created_at timestamp for display
        $notification['time_ago'] = time_elapsed_string($notification['created_at']);
    }

    // Log fetched notifications for debugging
    log_message('debug', 'Fetched Notifications: ' . print_r($notifications, true));
    
    return view('admin/dashboard', [
        'teachers' => $teachers,
        'totalTeachers' => count($teachers),
        'totalEvents' => count($events),
        'totalNews' => count($news),
        'totalRequest' => count($request),
        'totalSubjects' => count($subjects),
        'adminProfile' => $adminProfile,
        'notifications' => $notifications,
        'totalNotifications' => count($notifications),
        'totalUser' => count($users)
    ]);
}

    

    
    
    
public function getNotifications()
{
    $requestModel = new RequestModel();
    $notifications = $requestModel->getLatestNotifications(5);
    
    // Format notification messages
    foreach ($notifications as &$notification) {
        $notification['message'] = "{$notification['name']} has requested for {$notification['request_type']} in {$notification['course']}.";
        $notification['time_ago'] = time_elapsed_string($notification['created_at']); // Assuming 'created_at' is the datetime field
    }

    return $this->response->setJSON($notifications);
}


    

    
    public function upcomingEvents()
        {
            $eventModel = new \App\Models\EventsModel();
            $data['events'] = $eventModel->where('event_date >=', date('Y-m-d'))->orderBy('event_date', 'asc')->findAll(4); // Fetch 4 upcoming events
            
            // Load view with upcoming events
            return view('upcoming_events', $data);
        }

    public function addTeacher()
    {
        $teacherModel = new TeacherModel();

        // Get data from the form
        $data = [
            'first_name'   => $this->request->getPost('first_name'),
            'last_name'    => $this->request->getPost('last_name'),
            'phone_number' => $this->request->getPost('phone_number'),
            'sex'          => $this->request->getPost('sex'),
            'role'         => $this->request->getPost('role'),
            'employee_id'  => $this->request->getPost('employee_id'),
            'birth_date'   => $this->request->getPost('birth_date')
        ];

        // Insert data into the database
        if ($teacherModel->insert($data)) {
            // Data inserted successfully
            echo "Teacher details added successfully.";
        } else {
            // Failed to insert data
            echo "Failed to add teacher details.";
        }
    }
}
