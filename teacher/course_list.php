<?php
    include '../lib/Session.php';
    include '../lib/Teacher.php';
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

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
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
                    Course List
                </h1>
            </div>

            <div class="panel-body">
                <form  method="post">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Course Code</th> 
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                error_reporting(0);
                                $tc = new Teacher();
                                $get_course = $tc->getTeacherCourseList($_SESSION['email']); //Returns all course list
                                if($get_course) {
                                    while ($row = $get_course->fetch_assoc()) { 
                                        $courseList = (explode(",",$row['teacher_course_code']));
                                        for($i=0; $courseList[$i]; $i++) {
                            ?>

                            <tr>
                                <td><?php echo $courseList[$i]; ?></td> 
                                <td>
                                    <a class="btn btn-dark" href="take_attendance.php?courseCode=<?php
                                    echo $courseList[$i];?>">Join</a>
                                </td>
                            </tr>

                            <?php 
                                        }
                                    }
                                }
                            ?>
                        </tbody>
                    </table>                
                </form>
            </div>
        </div>
    </header>
</body>

</html>