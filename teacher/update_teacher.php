<?php
    include '../lib/Session.php';
    include '../lib/Teacher.php';
    include '../lib/Course.php';
?>

<?php
    $cl = new Course();
    $tc = new Teacher();

    $get_teacher = $tc->getSpecificTeacher($_SESSION['email']); //Returns all teacher list
    if($get_teacher) {
        while ($row = $get_teacher->fetch_assoc()) {
            $id = $row['teacher_id'];
            $name = $row['teacher_name'];
            $address = $row['teacher_address'];
            $email = $row['teacher_email'];
            $qualification = $row['teacher_qualification'];
            $doj = $row['teacher_doj'];
            $prevcourseCode = $row['teacher_course_code'];
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];

        $email = $_POST['email'];

        $pass = $_POST['pass'];
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        $address = $_POST['address'];
        $qualification = $_POST['qualification'];

        $rawDateOfJoining = htmlentities($_POST['doj']);
        $doj = date('Y-m-d', strtotime($rawDateOfJoining));

        $courseCode = $_POST['course-code'];

        $updateData = $tc->updateTeacher($id,$name,$email,$hashed_pass,$address,$qualification,$doj,$courseCode,$prevcourseCode);
    
        $_SESSION['username']=$name;
        $_SESSION['email']=$email;
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
                        <a class="nav-link" href="course_list.php">Take<br>Attendance</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="course_list.php">Course<br>List</a>
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
                <h1>Update Teacher Info</h1>
            </div>
            
            <div class="panel-body">
                <form method="post">
                    <div class="form-group">
                        <label for="name">Teacher Name</label>
                        <input type="text" name="name" class="form-control" value="<?php 
                        echo $name; ?>">
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" value="<?php 
                        echo $address; ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" value="<?php 
                        echo $email; ?>">
                    </div>

                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" name="pass" class="form-control" value="123">
                    </div>

                    <div class="form-group">
                        <label for="qualification">Qualification</label>
                        <input type="text" name="qualification" class="form-control" value="<?php 
                        echo $qualification; ?>">
                    </div>

                    <div class="form-group">
                        <label for="doj">Date of Joining</label>
                        <input type="date" name="doj" class="form-control" value="<?php 
                        echo $doj; ?>">
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