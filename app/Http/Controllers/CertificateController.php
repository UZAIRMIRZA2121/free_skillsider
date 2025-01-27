<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    /**
     * Generate and download the certificate as a PDF.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadCertificate($course_id)
    {

        $course = Courses::find($course_id);
        // Path to your certificate image (update the path as per your structure)
       // Get the app URL from the .env file
       $appUrl = env('APP_URL');

       // Path to your certificate image (update the path as per your structure)
       $imagePath = $appUrl . 'certificate/certificate-template.png';

      
   
        $userName = Auth::user()->first_name .' '.  Auth::user()->last_name;
        $courseName = $course->course_title;
      

          // Generate PDF in landscape orientation
    // $pdf = PDF::loadView('pdf.certificate', $data)
    // ->setPaper('a4', 'landscape');  // Set the orientation to landscape
    return view('pdf.certificate' , compact('imagePath','userName','courseName'));

        // return $pdf->download('certificate.pdf');
    }
}
