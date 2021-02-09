<?php
    include '../lib/Session.php';
    include '../lib/Student.php';
?>

<?php
    $id = $_GET['id'];
    $courseCode = $_GET['courseCode'];

    $stu = new Student();
    $deleteData = $stu->deleteStudent($id,$courseCode);
?>

<?php
    if(isset($deleteData)) {
        echo $deleteData;
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
        <link rel="stylesheet" href="../css/list_view.css">
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
                        <a class="nav-link" href="course_list.php">Take<br>Attendance</a>
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
                    Student List
                </h1>
            </div>

            <a href="add_student.php">
                <button class="btn btn-dark custom-submit-btn">Add</button>
            </a>
            <a href="update_student_list.php">
                <button class="btn btn-dark custom-submit-btn">Update</button>
            </a>

            <div class="panel-body">
                <form method="post">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Student Name</th> 
                                <th>Student ID</th> 
                                <th>Email</th>
                                <th>Date of Birth</th>
                                <th>Course Code</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $stu = new Student();
                                $get_student = $stu->getStudents(); //Returns all student list
                                if($get_student) {
                                    while ($row = $get_student->fetch_assoc()) { 
                            ?>

                            <tr>
                                <td><?php echo $row['student_name']; ?></td> 
                                <td><?php echo $row['student_roll_number']; ?></td> 
                                <td><?php echo $row['student_email']; ?></td> 
                                <td>
                                    <?php $d=date("d-m-Y", strtotime($row['student_dob']));
                                    echo $d; ?>
                                </td> 
                                <td><?php echo $row['student_course_code']; ?></td> 
                                <td>
                                    <a class="btn btn-dark" href="delete_student.php?id=<?php
                                    echo $row['student_id'];?>&courseCode=<?php
                                    echo $row['student_course_code'];?>">Delete</a>
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