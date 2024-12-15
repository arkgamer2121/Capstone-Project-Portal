<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NewsModel;


class NewsController extends BaseController
{
    public function addnews()
    {
        return view('admin/addnews');
    }
    public function news()
    {
        $model = new NewsModel();

        // Fetch all news articles
        $data['news'] = $model->findAll();

        // Pass the data to the view
        return view('userpage/news', $data);
    }
    public function show()
    {
        $newsModel = new NewsModel();

        // Fetch all news from the database
        $news = $newsModel->findAll();

        // Pass the news data to the view
        return view('admin/allnews', ['news' => $news]);
    }

    public function insert()
    {
        // Load the NewsModel
        $newsModel = new NewsModel();

        // Handle image upload
        $file = $this->request->getFile('image');
        $newName = $file->getRandomName();
        $file->move('./uploads', $newName);

        // Example data, replace this with actual data received from form inputs
        $data = [
            'title' => $this->request->getPost('title'),
            'image_url' => $newName, // Store the image name in the database
            'date_published' => date('Y-m-d'), // Assuming today's date for now
            'author' => $this->request->getPost('author'),
            'content' => $this->request->getPost('content'),
            // Add other fields as needed
        ];

        // Insert news data into the database
        $newsModel->insert($data);

        // Redirect back to the news listing page
        return redirect()->to('/addnews');
    }

    public function edit($id)
    {
        $newsModel = new NewsModel();

        // Fetch the news item by ID
        $news = $newsModel->find($id);

        // Check if the news item exists
        if (!$news) {
            // If not found, redirect to an error page or show a 404 error
            return redirect()->to('/error-page');
        }

        // Pass the news data to the edit view
        return view('admin/editnews', ['news' => $news]);
    }

    public function update($id)
    {
        $newsModel = new NewsModel();

        // Fetch the news item by ID
        $news = $newsModel->find($id);

        // Check if the news item exists
        if (!$news) {
            // If not found, redirect to an error page or show a 404 error
            return redirect()->to('/error-page');
        }

        // Handle image upload
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('./uploads', $newName);
            $imageUrl = $newName;
        } else {
            $imageUrl = $news['image_url']; // Use existing image if no new image is uploaded
        }

        // Example data, replace this with actual data received from form inputs
        $data = [
            'title' => $this->request->getPost('title'),
            'image_url' => $imageUrl, // Store the image name in the database
            'date_published' => $this->request->getPost('date_published'),
            'author' => $this->request->getPost('author'),
            'content' => $this->request->getPost('content'),
            // Add other fields as needed
        ];

        // Update news data in the database
        $newsModel->update($id, $data);

        // Redirect back to the news listing page
        return redirect()->to('/allnews')->with('success', 'News updated successfully');
    }
    public function delete($id)
{
    $newsModel = new NewsModel();

    // Find the teacher by ID
    $news = $newsModel->find($id);

    // Check if the news exists
    if (!$news) {
        // If news not found, return an error or redirect to an error page
        return redirect()->to('/error-page');
    }

    // Delete the news from the database
    $newsModel->delete($news['id']); 

    // Redirect back to the news listing page
    return redirect()->to('/allnews')->with('success', 'news deleted successfully');
}

}
