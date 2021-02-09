<?php
    include '../lib/Session.php';
    include '../lib/Teacher.php';
    include '../lib/Course.php';
?>

<?php
    $cl = new Course();

    $tc = new Teacher();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];

        $pass = $_POST['pass'];
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        $qualification = $_POST['qualification'];

        $rawDateOfJoining = htmlentities($_POST['doj']);
        $doj = date('Y-m-d', strtotime($rawDateOfJoining));

        $courseCode = $_POST['course-code'];

        $insertData = $tc->insertTeacher($name,$address,$email,$hashed_pass,$qualification,$doj,$courseCode);
    }
?>

<?php
    if(isset($insertData)) {
        echo $insertData;
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
                <h1>Add New Teacher</h1>
            </div>
            
            <div class="panel-body">
                <form method="post">
                    <div class="form-group">
                        <label for="name">Teacher Name</label>
                        <input type="text" name="name" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" name="pass" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="qualification">Qualification</label>
                        <input type="text" name="qualification" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="doj">Date of Joining</label>
                        <input type="date" name="doj" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="course-code">Available Course List:</label>
                        <select name="" class="form-control">
                            <?php
                                $get_course = $cl->getCourseList(); //Returns all course list
                                if($get_course) {
                                    while ($row = $get_course->fetch_assoc()) { 
                            ?>

                            <option>
                                <?php echo $row['course_code']; ?>
                            </option>

                            <?php 
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="course-code">Write course codes:</label>
                        <input type="text" name="course-code" class="form-control">
                    </div>

                    <input type="submit" name="submit" class="btn btn-dark btn-submit">
                </form>
            </div>
        </div>
    </header>
</body>

</html>