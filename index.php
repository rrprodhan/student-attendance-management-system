<?php
    include 'lib/Admin.php';
    include 'lib/Student.php';
    include 'lib/Teacher.php';
?>

<?php
    $adm = new Admin();
    $tc = new Teacher();
    $std = new Student();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $verified = false;

        $getData = $adm->getAdmins();
        if($getData && !$verified) {
            while ($row = $getData->fetch_assoc()) {
                if($row['admin_email'] == $email && 
                   password_verify($pass, $row['admin_password'])) {
                    $verfied = true;
                    session_start();
                    $_SESSION['auth']='true';
                    $_SESSION['email']=$row['admin_email'];
                    $_SESSION['user_type']=$row['admin_user_type'];
                    $_SESSION['username']=$row['admin_name'];

                    header('Location: admin/course_list.php');
                }
            }
        }

        $getData2 = $tc->getTeachers();
        if($getData2 && !$verified) {
            while ($row = $getData2->fetch_assoc()) {
                if($row['teacher_email'] == $email && 
                   password_verify($pass, $row['teacher_password'])) {
                    $verfied = true;
                    session_start();
                    $_SESSION['auth']='true';
                    $_SESSION['email']=$row['teacher_email'];
                    $_SESSION['user_type']=$row['teacher_user_type'];
                    $_SESSION['username']=$row['teacher_name'];
                    
                    header('Location: teacher/course_list.php');
                }
            }
        }

        $getData3 = $std->getStudents();
        if($getData3 && !$verified) {
            while ($row = $getData3->fetch_assoc()) {
                if($row['student_email'] == $email && 
                   password_verify($pass, $row['student_password'])) {
                    $verfied = true;
                    session_start();
                    $_SESSION['auth']='true';
                    $_SESSION['email']=$row['student_email'];
                    $_SESSION['user_type']=$row['student_user_type'];
                    $_SESSION['username']=$row['student_name'];
                    
                    header('Location: student/update_student.php');
                }
            }
        }

        if(!$verified) {
            echo "<div class='alert alert-danger'>
                Error! Invalid email and password!
            </div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Student Attendance Management System</title>

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/login.css">
    </head>
</head>

<body>
    <header class="header" style="height: 93vh;">
        <h1 class="heading-text">
            STUDENT ATTENDANCE MANAGEMENT SYSTEM
        </h1>

        <div class="panel panel-default container">
            <div class="panel-heading">
                <h1>Login Form</h1>
            </div>
            
            <div class="panel-body">
                <form method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" name="pass" class="form-control" required>
                    </div>

                    <input type="submit" name="submit" class="btn btn-dark" value="Submit">
                </form>
            </div>
        </div>
    </header>
</body>

</html>