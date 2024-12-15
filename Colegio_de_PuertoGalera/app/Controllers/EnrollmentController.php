<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;

class EnrollmentController extends Controller
{
    public function index()
    {
        return view('enrollment/exam_list');
    }

    public function generateQrCode($studentId)
    {
        // In a real application, retrieve student details from the database
        $studentName = "Student Name"; // Replace with actual student name

        $qrCode = new QrCode($studentId . ' - ' . $studentName);
        $qrCode->setSize(300);
        $qrCode->setMargin(10);
        $qrCode->setEncoding(new Encoding('UTF-8'));

        // Instantiate ErrorCorrectionLevel class
        $errorCorrectionLevel = new ErrorCorrectionLevel(ErrorCorrectionLevel::LOW);

        // Set error correction level
        $qrCode->setErrorCorrectionLevel($errorCorrectionLevel);

        $writer = new PngWriter();
        $data = $writer->write($qrCode);

        $qrCodeDataUri = 'data:image/png;base64,' . base64_encode($data);

        return view('enrollment/qr_code', ['qrCodeDataUri' => $qrCodeDataUri, 'studentId' => $studentId, 'studentName' => $studentName]);
    }

    public function scanQrCode()
    {
        // Handle QR code scanning and validation here
        // For simplicity, we'll just return a success message
        return view('enrollment/scan_success');
    }
}
