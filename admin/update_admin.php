<?php
    include '../lib/Session.php';
    include '../lib/Admin.php';
?>

<?php
    $adm = new Admin();

    $get_admin = $adm->getSpecificAdmin($_SESSION['email']); //Returns all teacher list
    if($get_admin) {
        while ($row = $get_admin->fetch_assoc()) {
            $id = $row['admin_id'];
            $name = $row['admin_name'];
            $email = $row['admin_email'];
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];

        $email = $_POST['email'];

        $pass = $_POST['pass'];
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        $updateData = $adm->updateAdmin($id,$name,$email,$hashed_pass);

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
                        <label for="name">Admin Name</label>
                        <input type="text" name="name" class="form-control" value="<?php 
                        echo $name; ?>">
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

                    <input type="submit" name="submit" class="btn btn-dark btn-submit">
                </form>
            </div>
        </div>
    </header>
</body>

</html>