<?php
    include '../lib/Session.php';
    include '../lib/Student.php';
?>

<?php
    $stu = new Student();
    $cur_date = date('Y-m-d');
    $courseCode = $_GET['courseCode'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $attendance = $_POST['attendance'];
        $insertAttendance = $stu->insertAttendance($cur_date, $attendance, $courseCode);
    }
?>

<?php
    if(isset($insertAttendance)) {
        echo $insertAttendance;
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
        <link rel="stylesheet" href="../css/take_attendance.css">
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
            <div class="custom-date">
                Date: <?php 
                    $customDate = date('d-m-Y');
                    echo $customDate; 
                ?> 
            </div>
            <div class="course-code">
                <?php 
                    echo $courseCode;
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
                        <a class="nav-link" href="report.php">Attendance<br>Report</a>
                    </li>
                    <li class="nav-item btn btn-dark logout">
                        <a class="nav-link" href="../logout.php">Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="panel panel-default container">
            <div class="panel-heading">
                <h1>
                    Attendance Sheet
                </h1>
            </div>

            <div class="panel-body">
                <form  method="post">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Student Name</th> 
                                <th>Student ID</th> 
                                <th>Attendance</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $get_student = $stu->getSpecificCourseStudents($courseCode); //Returns all student list
                                if($get_student) {
                                    while ($row = $get_student->fetch_assoc()) { 
                            ?>

                            <tr>
                                <td><?php echo $row['student_name']; ?></td> 
                                <td><?php echo $row['student_roll_number']; ?></td> 
                                <td>
                                    Present <input type="radio" name="attendance[<?php echo $row['student_id']; ?>]" value="present" required>
                                    Absent <input type="radio" name="attendance[<?php echo $row['student_id']; ?>]" value="absent" required>
                                </td>
                            </tr>

                            <?php 
                                    }
                                }
                            ?>
                        </tbody>
                    </table> 
                    
                    <input type="submit" class="btn btn-dark custom-submit-btn" name="submit" value="Record Attendance">               
                </form>
            </div>
        </div>
    </header>
</body>

</html>