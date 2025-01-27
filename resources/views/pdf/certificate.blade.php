<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Certificate</title>
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&family=Montserrat:wght@400;500&display=swap"
        rel="stylesheet">
    <style>
        .certificate {
            position: relative;
            
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .certificate img {
            width: 100%;
            height: auto;
        }

        .certificate .certificate-text {
            position: absolute;
            width: 100%;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
          
            justify-content: center;
            height: 100%;
        }

        .name {
            text-align: center;
            margin-top: 50px;
            font-size: 60px;
            color: black;
            font-family: 'Parisienne', cursive;
            text-align: center;
        }

        .course_name {
            text-align: start;
            margin-top: 147px;
            font-size: 14px;
            color: black;
            font-family: 'Montserrat', sans-serif;
            text-align: start;
            margin-left: 288px;
            align-items: flex-start;
        }
    </style>
</head>

<body>

    <div id="certificate-container" class="certificate">
        <!-- Dynamically loaded certificate image -->
        <img src="{{ $imagePath }}" alt="Certificate Template">
        <div class="certificate-text">
            <!-- Dynamic user name -->
            <div class="name">{{ $userName ?? 'Uzair' }}</div>
        </div>
        <div class="certificate-text">
            <div class="course_name"><u>{{ $courseName ?? 'courseName' }}</u></div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(() => {
                const element = document.getElementById('certificate-container');
                const courseName = "{{ $courseName ?? 'Default Course Name' }}"; // Get course name from Blade
    
                html2canvas(element, { scale: 2 }).then(canvas => {
                    const imgData = canvas.toDataURL('image/png');
                    const pdf = new jspdf.jsPDF('landscape', 'mm', 'a4');
                    const pdfWidth = pdf.internal.pageSize.getWidth();
                    const pdfHeight = (canvas.height * pdfWidth) / canvas.width;
    
                    // Add the certificate image to PDF
                    pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
    
                    // Add course name to PDF (you can adjust positioning as needed)
                    pdf.setFontSize(16); // Set font size
                    pdf.text(courseName, 150, 250); // Set position of the course name (x, y)
    
                    // Save the PDF
                    pdf.save('certificate.pdf');
                    
                    // Redirect to /tests.index route after download
                    window.location.href = "{{ route('tests.index') }}"; // Using Laravel's named route
                });
            }, 3000); // Delay of 1 second
        });
    </script>
    
    
    
    
</body>


</html>
