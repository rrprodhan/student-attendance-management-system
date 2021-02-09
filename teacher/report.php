<?php
    include '../lib/Session.php';
    include '../lib/Student.php';
    include '../lib/Teacher.php'; 
?>

<?php
    $tc = new Teacher();

    $stu = new Student();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $rawStartingDate = htmlentities($_POST['sd']);
        $sd = date('Y-m-d', strtotime($rawStartingDate));

        $rawEndingDate = htmlentities($_POST['ed']);
        $ed = date('Y-m-d', strtotime($rawEndingDate));

        $courseCode = $_POST['course-code']; 

        require('../fpdf/fpdf.php'); 
        $pdf = new FPDF('p','mm','A4');
        
        $pdf->AddPage();

        $pdf->SetFont('Arial','B',14);
        $pdf->cell(190,10,"Attendance Report",1,1,'C');
        $pdf->cell(190,10,$courseCode,1,1,'C');

        $pdf->SetFont('Arial','B',14);
        $pdf->cell(47,10,"Date",1,0,'C');
        $pdf->cell(66,10,"Student Name",1,0,'C');
        $pdf->cell(47,10,"Student ID",1,0,'C');
        $pdf->cell(30,10,"Status",1,1,'C');

        $pdf->SetFont('Arial','',14);
        $get_data = $stu->getDatewiseAttendReport($sd,$ed,$courseCode); //Returns all attendance records
        if($get_data) {
            while ($row = $get_data->fetch_assoc()) {
                $pdf->cell(47,10,date('d-m-Y', strtotime($row['attendance_date'])),1,0,'C');
                $pdf->cell(66,10,$row['student_name'],1,0,'C');
                $pdf->cell(47,10,$row['student_roll_number'],1,0,'C');
                $pdf->cell(30,10,$row['attendance_status'],1,1,'C');    
            }
        }

        $pdf->OutPut();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Student Attendance Management System</title>

        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/add.css">
        <link rel="stylesheet" href="../css/navbar.css">
    </head>
</head>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="course_list.php">Student<br>Attendance<br>Management<br>System</a>

            <div class="username">
                <?php 
                    include '../lib/CurrentUserInfo.php';
                ?>
            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="course_list.php">Course<br>List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="update_teacher.php">Edit<br>Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="course_list.php">Take<br>Attendance</a>
                    </li>
                    <li class="nav-item btn btn-dark logout">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="panel panel-default container">
            <div class="panel-heading">
                <h1>Download Attendance Report</h1>
            </div>
            
            <div class="panel-body">
                <form method="post">
                    <div class="form-group">
                        <label for="sd">Oldest Date</label>
                        <input type="date" name="sd" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="ed">Recent Date</label>
                        <input type="date" name="ed" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="course-code">Choose a course:</label>
                        <select name="course-code" class="form-control">
                            <?php
                                error_reporting(0);
                                $tc = new Teacher();
                                $get_course = $tc->getTeacherCourseList($_SESSION['email']); //Returns all course list
                                if($get_course) {
                                    while ($row = $get_course->fetch_assoc()) { 
                                        $courseList = (explode(",",$row['teacher_course_code']));
                                        for($i=0; $courseList[$i]; $i++) {
                            ?>

                            <option value="<?php echo $courseList[$i]; ?>">
                                <?php echo $courseList[$i]; ?>
                            </option>

                            <?php 
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <input type="submit" name="submit" class="btn btn-dark btn-submit" value="Download">
                </form>
            </div>
        </div>
    </header>
</body>

</html>