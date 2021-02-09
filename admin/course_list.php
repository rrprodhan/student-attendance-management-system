<?php
    include '../lib/Session.php';
    include '../lib/Course.php';
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
                        <a class="nav-link" href="report.php">Attendance<br>Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="teacher_list.php">Teacher<br>List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="student_list.php">Student<br>List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="update_admin.php">Update<br>Profile</a>
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
                                $cl = new Course();
                                $get_course = $cl->getCourseList(); //Returns all course list
                                if($get_course) {
                                    while ($row = $get_course->fetch_assoc()) { 
                            ?>

                            <tr>
                                <td><?php echo $row['course_code']; ?></td> 
                                <td>
                                    <a class="btn btn-dark" href="take_attendance.php?courseCode=<?php
                                    echo $row['course_code'];?>">Join</a>
                                </td>
                            </tr>

                            <?php 
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