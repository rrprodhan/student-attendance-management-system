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
                    Teacher List
                </h1>
            </div>

            <a href="add_teacher.php">
                <button class="btn btn-dark custom-submit-btn">Add</button>
            </a>
            <a href="delete_teacher_list.php">
                <button class="btn btn-dark custom-submit-btn">Delete</button>
            </a>

            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Teacher Name</th> 
                            <th>Address</th> 
                            <th>Email</th>
                            <th>Qualification</th>
                            <th>Date of Joining</th>
                            <th>Course Code</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $tc = new Teacher();
                            $get_teacher = $tc->getTeachers(); //Returns all student list
                            if($get_teacher) {
                                while ($row = $get_teacher->fetch_assoc()) { 
                        ?>

                        <tr>
                            <td><?php echo $row['teacher_name']; ?></td> 
                            <td><?php echo $row['teacher_address']; ?></td> 
                            <td><?php echo $row['teacher_email']; ?></td>
                            <td><?php echo $row['teacher_qualification']; ?></td>  
                            <td>
                                <?php $d=date("d-m-Y", strtotime($row['teacher_doj']));
                                echo $d; ?>
                            </td> 
                            <td><?php echo $row['teacher_course_code']; ?></td> 
                            <td>
                                <a class="btn btn-dark" href="update_teacher.php?id=<?php
                                echo $row['teacher_id'];?>&name=<?php
                                echo $row['teacher_name'];?>&address=<?php
                                echo $row['teacher_address'];?>&email=<?php
                                echo $row['teacher_email'];?>&qualification=<?php
                                echo $row['teacher_qualification'];?>&doj=<?php
                                echo $row['teacher_doj'];?>&courseCode=<?php
                                echo $row['teacher_course_code'];?>">Update</a>
                            </td>
                        </tr>

                        <?php 
                                }
                            }
                        ?>
                    </tbody>
                </table> 
            </div>
        </div>
    </header>
</body>

</html>