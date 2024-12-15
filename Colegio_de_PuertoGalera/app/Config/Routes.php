<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// Webhook route
$routes->post('/webhook', 'MessengerWebhook::receive');


//course year section
$routes->match(['get', 'post'],'/courses-sections', 'CourseYearController::index');
$routes->match(['get', 'post'],'/course_section/create', 'CourseYearController::create');
$routes->match(['get', 'post'],'/course_section/store', 'CourseYearController::store');
$routes->get('/courses-sections/edit/(:num)', 'CourseYearController::edit/$1');
$routes->post('/courses-sections/update/(:num)', 'CourseYearController::update/$1');
$routes->get('/courses-sections/delete/(:num)', 'CourseYearController::delete/$1');

//$routes->match(['get', 'post'],'/getCoursesByYear/(:num)', 'ScheduleController::getCoursesByYear/$1');


//user

$routes->get('analytics/live-visitors', 'Home::getLiveVisitors');

$routes->get('/', 'Home::index');
$routes->get('/homepage', 'Home::homepage');  // If you want to access it via /homepage
$routes->get('/aboutus', 'Home::aboutus');
$routes->get('/courses', 'Home::courses');
$routes->get('/admission', 'Home::admission');
$routes->get('/teachers', 'Home::teachers');
$routes->get('/contact', 'Home::contact');
$routes->post('/contact/sendEmail', 'ContactController::sendEmail');
$routes->get('/events', 'EventController::eventlist');
$routes->get('/news', 'NewsController::news');

//login
// $routes->get('/enroll', 'SignupController::index');
$routes->get('/logout', 'SigninController::logout');
$routes->get('/signup', 'SignupController::index');
$routes->match(['get', 'post'], 'SignupController/store', 'SignupController::store');
$routes->match(['get', 'post'], 'SigninController/loginAuth', 'SigninController::loginAuth');
$routes->get('/signin', 'SigninController::index');
$routes->match(['get', 'post'],'admin/profile/(:num)', 'AdminProfileController::adminProfile/$1');
$routes->post('admin/updateProfile', 'AdminProfileController::updateProfile');
$routes->post('admin/uploadProfilePicture', 'AdminProfileController::uploadProfilePicture');
$routes->get('/profile', 'ProfileController::index');
$routes->post('/profile/uploadImage', 'ProfileController::uploadImage');


$routes->get('/verification_form', 'VerificationController::index');
$routes->post('/verify', 'VerificationController::verify');
$routes->get('/login-register/signin', 'SigninController::index');



//forgot password 
$routes->get('/forgot_password', 'ForgotPasswordController::forgotPassword');
$routes->post('/forgot_password/send', 'ForgotPasswordController::sendVerificationCode');
$routes->get('/forgot_password/verify', 'ForgotPasswordController::verifyCode');
$routes->post('/forgot_password/check_code', 'ForgotPasswordController::checkVerificationCode');
$routes->get('/forgot_password/new_password', 'ForgotPasswordController::newPassword');
$routes->post('/forgot_password/update', 'ForgotPasswordController::updatePassword');



    
     //requestform
    $routes->get('/request', 'RequestController::index');
    $routes->post('/request/create', 'RequestController::create');
    $routes->get('/admin/requests', 'RequestController::index');
    $routes->match(['get', 'post'],'/request/approve/(:num)', 'RequestController::approve/$1');
    $routes->match(['get', 'post'],'/request/reject/(:num)', 'RequestController::reject/$1');
    $routes->get('submitted-requests', 'RequestController::submittedRequests');
    $routes->match(['get', 'post'],'/reqStatus', 'RequestController::statusRequest');

$routes->group('', ['filter' => 'admin'], function($routes) {
    // Admin routes
    $routes->get('/admin', 'Home::dashboard');
    $routes->get('/dashboard', 'Home::dashboard');
    $routes->get('/examinationdata', 'ExamController::getExamData');
    $routes->get('/addevents', 'EventController::addevents');
    $routes->get('/allevents', 'EventController::allevents');
    $routes->post('/eventStore', 'EventController::store');
    $routes->get('/eventedit(:num)', 'EventController::edit/$1');
    $routes->post('/eventupdate(:num)', 'EventController::update/$1');

    // Adding/retrieving teacher
    $routes->get('/teacherform', 'TeacherController::teacher');
    $routes->get('/allteachers', 'TeacherController::show');
    $routes->get('/teacheredit(:num)', 'TeacherController::edit/$1');
    $routes->post('/teacherupdate(:num)', 'TeacherController::update/$1');
    $routes->post('/addteacher', 'TeacherController::insert');
    $routes->get('/deleteteachers(:num)', 'TeacherController::delete/$1');
    $routes->get('generate-report', 'TeacherController::generateReport');

    // News
    $routes->get('/addnews', 'NewsController::addnews');
    $routes->post('/newsinsert', 'NewsController::insert');
    $routes->get('/allnews', 'NewsController::show');
    $routes->get('/newsedit(:num)', 'NewsController::edit/$1');
    $routes->post('/newsupdate(:num)', 'NewsController::update/$1');
    $routes->get('/deletenews(:num)', 'NewsController::delete/$1');

    // User list
    $routes->get('/allusers', 'SignupController::userdata');
    $routes->get('/deleteuser(:num)', 'SignupController::delete/$1');

    // Enrollment
    $routes->get('/applicationform', 'ApplicationFormController::applicationform');
    $routes->post('/submitApplication', 'ApplicationFormController::submitApplication');
    $routes->get('/currentenroll', 'ApplicationFormController::currentenroll');
    $routes->match(['get', 'post'],'/sidenav', 'ApplicationFormController::sidenav');

    // Exam controller
    $routes->post('/submitExam', 'ExamController::submitExam');
    $routes->get('/show_result', 'ExamController::showResult');

    // Faculty
    $routes->get('/faculty', 'FacultyController::index');
    $routes->get('/facultycreate', 'FacultyController::create');
    $routes->get('/facultyadd', 'FacultyController::create');
    $routes->post('/faculty/store', 'FacultyController::store');
    $routes->get('/faculty/edit/(:num)', 'FacultyController::edit/$1');
    $routes->post('/faculty/update/(:num)', 'FacultyController::update/$1');
    $routes->match(['get', 'post'],'/faculty/delete/(:num)', 'FacultyController::delete/$1');
    $routes->match(['get', 'post'],'/details(:num)', 'FacultyController::details/$1');
    $routes->get('generate-report-sched(:num)', 'FacultyController::generateReport/$1');

    // Schedule
    $routes->get('/schedule', 'ScheduleController::index');
    $routes->match(['get', 'post'], '/schedule/create', 'ScheduleController::create');
    $routes->get('/scheduledelete/(:num)', 'ScheduleController::delete/$1');
    $routes->post('/schedule/update/(:num)', 'ScheduleController::update/$1');
    $routes->post('send-schedule/(:num)', 'FacultyController::sendSchedule/$1');
    $routes->get('/filter-schedules', 'ScheduleController::filterSchedules');

    // History for schedule
    $routes->get('/history', 'ScheduleHistoryController::index'); 

    // Subject list
    $routes->get('/subject_list_add', 'SubjectListController::create');
    $routes->post('/subject_list/store', 'SubjectListController::store');
    $routes->get('/subject_list', 'SubjectListController::index');
    $routes->get('/subject_list/edit/(:num)', 'SubjectListController::edit/$1');
    $routes->post('/subject_list/update/(:num)', 'SubjectListController::update/$1');
    $routes->post('/subject_list/delete/(:num)', 'SubjectListController::delete/$1');
    
    //courses
    $routes->get('/course', 'CourseController::index');
    $routes->get('courses/create', 'CourseController::create');
    $routes->post('/courses/store', 'CourseController::store');
    $routes->get('/courses/edit/(:num)', 'CourseController::edit/$1');
    $routes->post('/courses/update/(:num)', 'CourseController::update/$1');
    $routes->post('/courses/delete/(:num)', 'CourseController::delete/$1');

    
    //GLInkform
    $routes->get('/admin/uploadForm', 'AdminController::uploadGoogleFormLink');
    $routes->post('/admin/uploadGoogleFormLink', 'AdminController::uploadGoogleFormLink');
    $routes->get('/gformlinkpage', 'AdminController::showGFormlinkpage');
    $routes->post('/admin/toggleLinkVisibility', 'AdminController::toggleLinkVisibility');
    
    //adminprofile
    $routes->match(['get', 'post'],'admin/profile/(:num)', 'AdminProfileController::adminProfile/$1');
    $routes->post('admin/updateProfile', 'AdminProfileController::updateProfile');
    $routes->post('admin/uploadProfilePicture', 'AdminProfileController::uploadProfilePicture');
    
    //upload student id list
    $routes->post('/uploadExcel', 'StudentController::uploadExcel');
    $routes->match(['get', 'post'],'/studentidList', 'StudentController::index');
    
        //qrcode
    $routes->get('/uploadexcel', 'AdminController::viewTable');
    $routes->post('/admin/uploadExcel', 'AdminController::uploadExcel');
    $routes->post('/admin/updateStatus/(:num)/(:alpha)', 'AdminController::updateStatus/$1/$2');
    $routes->post('/admin/scanQRCode/(:any)', 'AdminController::scanQRCode/$1');
    $routes->get('/scanqrpage', 'AdminController::scanqrpage');
    $routes->post('/admin/scanQRCode/(:any)', 'AdminController::scanQRCode/$1');
    
    //sectioning
    $routes->match(['get', 'post'], '/sectioning', 'SectionController::sectioning');
    $routes->post('/section/upload', 'SectionController::upload');
    $routes->get('/listsection', 'SectionController::list');

    //generTE REPORT SCHED FACULTY

    $routes->get('/generate-pdf-preview/(:num)', 'ReportController::generatePdfPreview/$1');
        
   
});