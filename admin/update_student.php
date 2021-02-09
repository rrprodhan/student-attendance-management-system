<?php
    include '../lib/Session.php';
    include '../lib/Student.php';
    include '../lib/Course.php';
?>

<?php
    $cl = new Course();

    $id = $_GET['id'];
    $name = $_GET['name'];
    $roll = $_GET['roll'];
    $email = $_GET['email'];
    $dob = $_GET['dob'];
    $prevcourseCode = $_GET['courseCode'];

    $stu = new Student();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];

        $email = $_POST['email'];

        $pass = $_POST['pass'];
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        $roll = $_POST['roll'];

        $rawDateOfBirth = htmlentities($_POST['dob']);
        $dob = date('Y-m-d', strtotime($rawDateOfBirth));

        $courseCode = $_POST['course-code'];

        $updateData = $stu->updateStudent($id,$name,$email,$hashed_pass,$roll,$dob,$courseCode,$prevcourseCode);
    }
?>

<?php
    if(isset($updateData)) {
        echo $updateData;
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
                <h1>Update Student Info</h1>
            </div>
            
            <div class="panel-body">
                <form method="post">
                    <div class="form-group">
                        <label for="name">Student Name</label>
                        <input type="text" name="name" class="form-control" value="<?php 
                        echo $name; ?>">
                    </div>

                    <div class="form-group">
                        <label for="roll">Student Email</label>
                        <input type="text" name="email" class="form-control" value="<?php 
                        echo $email; ?>">
                    </div>

                    <div class="form-group">
                        <label for="pass">Student Password</label>
                        <input type="password" name="pass" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="roll">Student ID</label>
                        <input type="text" name="roll" class="form-control" value="<?php 
                        echo $roll; ?>">
                    </div>

                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" value="<?php 
                        echo $dob; ?>">
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
                        <input type="text" name="course-code" class="form-control" value="<?php 
                        echo $prevcourseCode; ?>">
                    </div>

                    <input type="submit" name="submit" class="btn btn-dark btn-submit">
                </form>
            </div>
        </div>
    </header>
</body>

</html>