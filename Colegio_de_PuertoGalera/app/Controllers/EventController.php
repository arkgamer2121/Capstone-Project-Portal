<?php

namespace App\Controllers;
use App\Models\EventsModel;
use App\Controllers\BaseController;

class EventController extends BaseController
{
    public function addevents()
    {
        return view('admin/addevents');
    }

    public function store()
    {
        // Validate the input fields, you can use CodeIgniter's validation library if needed

        // Retrieve input data from the form
        $eventName = $this->request->getPost('event_name');
        $eventDate = $this->request->getPost('event_date');
        $eventStartTime = $this->request->getPost('event_start_time');
        $eventEndTime = $this->request->getPost('event_end_time');
        $eventDescription = $this->request->getPost('event_description');

        // Instantiate EventsModel
        $eventModel = new EventsModel();

        // Prepare data for insertion
        $data = [
            'event_name' => $eventName,
            'event_date' => $eventDate,
            'event_start_time' => $eventStartTime,
            'event_end_time' => $eventEndTime,
            'event_description' => $eventDescription
        ];

        // Insert the data into the database
        $eventModel->insert($data);

        // Optionally, you can redirect the user to a success page or back to the form
        return redirect()->to('/addevents')->with('success', 'Event added successfully!');
    }

    public function allevents()
    {
        $eventModel = new EventsModel();

        // Fetch all events
        $events = $eventModel->findAll();
    
        // Pass events to the view
        return view('admin/allevents', ['events' => $events]);
    }
    public function eventlist()
    {
        $eventModel = new EventsModel();

        // Fetch all events
        $events = $eventModel->findAll();
    
        // Pass events to the view
        return view('userpage/eventlist', ['events' => $events]);
    }
    public function edit($id)
    {
        $eventModel = new EventsModel();

        // Find the event by ID
        $event = $eventModel->find($id);

        // Check if the event exists
        if (!$event) {
            // If event not found, return an error or redirect to an error page
            return redirect()->to('/error-page');
        }

        // Pass the event data to the edit view
        return view('admin/editevent', ['event' => $event]);
    }

    public function update($id)
    {
        $eventModel = new EventsModel();

        // Retrieve input data from the form
        $eventName = $this->request->getPost('event_name');
        $eventDate = $this->request->getPost('event_date');
        $eventStartTime = $this->request->getPost('event_start_time');
        $eventEndTime = $this->request->getPost('event_end_time');
        $eventDescription = $this->request->getPost('event_description');

        // Prepare data for update
        $data = [
            'event_name' => $eventName,
            'event_date' => $eventDate,
            'event_start_time' => $eventStartTime,
            'event_end_time' => $eventEndTime,
            'event_description' => $eventDescription
        ];

        // Update the event data in the database
        $eventModel->update($id, $data);

        // Redirect back to the event listing page
        return redirect()->to('/allevents')->with('success', 'Event updated successfully');
    }
}
