<?php 
    $filePath = realpath(dirname(__FILE__));
    include_once($filePath.'/Database.php')
?>

<?php 
    class Teacher {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function getTeachers() {
            $query = "SELECT * FROM teacher_tbl";
            $result = $this->db->select($query);
            return $result;
        }

        public function getTeacherCourseList($email) {
            $query = "SELECT teacher_course_code FROM teacher_tbl 
            WHERE teacher_email='$email'";
            $result = $this->db->select($query);
            return $result;
        }

        public function getSpecificTeacher($email) {
            $query = "SELECT DISTINCT * FROM teacher_tbl
            WHERE teacher_email='$email'";
            $result = $this->db->select($query);
            return $result;
        }

        public function insertTeacher($name,$address,$email,$hashed_pass,$qualification,$doj,$courseCode) {
            $name = mysqli_real_escape_string($this->db->link, $name);
            $address = mysqli_real_escape_string($this->db->link, $address);
            $email = mysqli_real_escape_string($this->db->link, $email);
            $hashed_pass = mysqli_real_escape_string($this->db->link, $hashed_pass);
            $qualification = mysqli_real_escape_string($this->db->link, $qualification);
            $doj = mysqli_real_escape_string($this->db->link, $doj);
            $courseCode = mysqli_real_escape_string($this->db->link, $courseCode);

            if(empty($name) || empty($address) || empty($email) || empty($hashed_pass) ||
               empty($qualification)|| empty($doj)|| empty($courseCode)) {
                $msg = "<div class='alert alert-danger'>
                    Error! Fields can't be left blank!
                </div>";

                return $msg;
            } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $msg = "<div class='alert alert-danger'>
                        Error! Invalid email format!
                    </div>";

                return $msg;
            } else {
                //Checking if teacher with course code and email exists or not
                $query = "SELECT DISTINCT teacher_course_code, teacher_email FROM teacher_tbl";
                $result = $this->db->select($query);
                while($row = $result->fetch_assoc()) {
                    $db_courseCode = $row['teacher_course_code'];
                    $db_email = $row['teacher_email'];

                    if($courseCode == $db_courseCode && $email == $db_email) {
                        $msg = "<div class='alert alert-danger'>
                            Error! Teacher already registered!
                        </div>";

                        return $msg;
                    }
                }

                //Inserting teacher info
                $query2 = "INSERT INTO teacher_tbl(teacher_name,
                teacher_address,
                teacher_email, 
                teacher_password, 
                teacher_qualification, 
                teacher_doj, 
                teacher_course_code,
                teacher_user_type) 
                VALUES('$name',
                '$address',
                '$email',
                '$hashed_pass',
                '$qualification',
                '$doj',
                '$courseCode',
                'teacher')";

                $result2 = $this->db->insert($query2);
                
                if($result2) {
                    $msg = "<div class='alert alert-success'>
                        Success! New teacher added successfully!
                    </div>";

                    return $msg;
                } else {
                    $msg = "<div class='alert alert-danger'>
                        Error! teacher data couldn't be added!
                    </div>";

                    return $msg;
                }
            }
        }

        public function updateTeacher($id,$name,$email,$hashed_pass,$address,$qualification,$doj,$courseCode,$prevcourseCode) {
            $id = mysqli_real_escape_string($this->db->link, $id);
            $name = mysqli_real_escape_string($this->db->link, $name);
            $email = mysqli_real_escape_string($this->db->link, $email);
            $hashed_pass = mysqli_real_escape_string($this->db->link, $hashed_pass);
            $address = mysqli_real_escape_string($this->db->link, $address);
            $qualification = mysqli_real_escape_string($this->db->link, $qualification);
            $doj = mysqli_real_escape_string($this->db->link, $doj);
            $courseCode = mysqli_real_escape_string($this->db->link, $courseCode);
            $prevcourseCode = mysqli_real_escape_string($this->db->link, $prevcourseCode);

            if(empty($name) || empty($email) || empty($hashed_pass) || empty($address)|| 
               empty($doj)|| empty($qualification)|| empty($courseCode)) {
                $msg = "<div class='alert alert-danger'>
                    Error! Fields can't be left blank!
                </div>";

                return $msg;
            } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $msg = "<div class='alert alert-danger'>
                        Error! Invalid email format!
                    </div>";

                return $msg;
            } else {
                //Update teacher info
                $query = "UPDATE teacher_tbl 	
                SET teacher_name = '$name',
                teacher_email = '$email', 
                teacher_password = '$hashed_pass', 
                teacher_address = '$address',
                teacher_qualification = '$qualification', 
                teacher_doj = '$doj', 
                teacher_course_code = '$courseCode'
                WHERE teacher_id='$id' AND teacher_course_code = '$prevcourseCode'";

                $result = $this->db->update($query);
                
                if($result) {
                    $msg = "<div class='alert alert-success'>
                        Success! Teacher info updated successfully!
                    </div>";

                    return $msg;
                } else {
                    $msg = "<div class='alert alert-danger'>
                        Error! Teacher info couldn't be updated!
                    </div>";

                    return $msg;
                }
            }
        }

        public function deleteTeacher($id,$courseCode) {
            //Delete teacher info
            $query = "DELETE FROM teacher_tbl 
            WHERE teacher_id='$id' AND teacher_course_code='$courseCode'";

            $result = $this->db->delete($query);
            
            if($result) {
                $msg = "<div class='alert alert-success'>
                    Success! Teacher info deleted successfully!
                </div>";

                return $msg;
            } else {
                $msg = "<div class='alert alert-danger'>
                    Error! Teacher info couldn't be deleted!
                </div>";

                return $msg;
            }
        }
    }
?>