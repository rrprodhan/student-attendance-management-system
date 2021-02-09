<?php 
    $filePath = realpath(dirname(__FILE__));
    include_once($filePath.'/Database.php')
?>

<?php 
    class Student {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function getStudents() {
            $query = "SELECT * FROM student_tbl";
            $result = $this->db->select($query);
            return $result;
        }

        public function getSpecificCourseStudents($courseCode) {
            $query = "SELECT * FROM student_tbl
            WHERE student_course_code LIKE '%{$courseCode}%'";
            $result = $this->db->select($query);
            return $result;
        }

        public function getSpecificStudent($email) {
            $query = "SELECT DISTINCT * FROM student_tbl
            WHERE student_email='$email'";
            $result = $this->db->select($query);
            return $result;
        }

        public function insertStudent($name,$email,$hashed_pass,$roll,$dob,$courseCode) {
            $name = mysqli_real_escape_string($this->db->link, $name);
            $email = mysqli_real_escape_string($this->db->link, $email);
            $hashed_pass = mysqli_real_escape_string($this->db->link, $hashed_pass);
            $roll = mysqli_real_escape_string($this->db->link, $roll);
            $dob = mysqli_real_escape_string($this->db->link, $dob);
            $courseCode = mysqli_real_escape_string($this->db->link, $courseCode);

            if(empty($name) || empty($email) || empty($hashed_pass) || empty($roll)|| 
               empty($dob)|| empty($courseCode)) {
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
                //Checking if student with same id, course code and email exists or not
                $query = "SELECT DISTINCT student_roll_number, 
                student_course_code, student_email FROM student_tbl";
                $result = $this->db->select($query);
                while($row = $result->fetch_assoc()) {
                    $db_roll = $row['student_roll_number'];
                    $db_courseCode = $row['student_course_code'];
                    $db_email = $row['student_email'];

                    if($roll == $db_roll && $courseCode == $db_courseCode && $email == $db_email) {
                        $msg = "<div class='alert alert-danger'>
                            Error! Student already registered!
                        </div>";

                        return $msg;
                    }
                }

                //Inserting student info
                $query2 = "INSERT INTO student_tbl(student_name,
                student_email, 
                student_password, 
                student_roll_number, 
                student_dob, 
                student_course_code,
                student_user_type) 
                VALUES('$name',
                '$email',
                '$hashed_pass',
                '$roll',
                '$dob',
                '$courseCode',
                'student')";

                $result2 = $this->db->insert($query2);
                
                if($result2) {
                    $msg = "<div class='alert alert-success'>
                        Success! New student added successfully!
                    </div>";

                    return $msg;
                } else {
                    $msg = "<div class='alert alert-danger'>
                        Error! Student data couldn't be added!
                    </div>";

                    return $msg;
                }
            }
        }

        public function insertAttendance($cur_date, $attendance = array(), $courseCode) {
            $query = "SELECT DISTINCT attendance_date, attendance_course_code FROM attendance_tbl";
            $result = $this->db->select($query);

            if($result)
            {
                while($row = $result->fetch_assoc()) {
                    $db_date = $row['attendance_date'];
                    $db_courseCode = $row['attendance_course_code'];
    
                    if($cur_date == $db_date && $courseCode == $db_courseCode) {
                        $msg = "<div class='alert alert-danger'>
                            Error! Attendance already taken!
                        </div>";
    
                        return $msg;
                    }
                }
            } 

            foreach($attendance as $key=>$value) {
                if($value == "present") {
                    $query2 = "INSERT INTO attendance_tbl(attendance_student_id,
                    attendance_status,
                    attendance_date,
                    attendance_course_code)
                    VALUES('$key', 'present', '$cur_date', '$courseCode')";

                    $result2 = $this->db->insert($query2);
                } elseif ($value == "absent") {
                    $query2 = "INSERT INTO attendance_tbl(attendance_student_id,
                    attendance_status,
                    attendance_date,
                    attendance_course_code)
                    VALUES('$key', 'absent', '$cur_date', '$courseCode')";

                    $result2 = $this->db->insert($query2);
                }
            }

            if($result2) {
                $msg = "<div class='alert alert-success'>
                    Success! Attendance data recorded successfully!
                </div>";

                return $msg;
            } else {
                $msg = "<div class='alert alert-danger'>
                    Error! Attendance data couldn't be recorded!
                </div>";

                return $msg;
            }
        }

        public function getDateCourseList() {
            $query = "SELECT DISTINCT attendance_course_code, attendance_date 
            FROM attendance_tbl ORDER BY attendance_course_code DESC, attendance_date DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function getAllData($dt) {
            $query = "SELECT student_tbl.student_name, 
            student_tbl.student_roll_number, 
            attendance_tbl.*
            FROM student_tbl INNER JOIN attendance_tbl
            ON student_tbl.student_course_code = attendance_tbl.attendance_course_code
            AND student_tbl.student_id = attendance_tbl.attendance_student_id
            WHERE attendance_date = '$dt'";
            $result = $this->db->select($query);
            return $result;
        }

        public function updateAttendance($dt, $attendance = array(), $courseCode) {
            foreach($attendance as $key=>$value) {
                if($value == "present") {
                    $query = "UPDATE attendance_tbl
                    SET attendance_status = 'present'
                    WHERE attendance_student_id = '".key."' 
                    AND attendance_course_code = '".$courseCode."'
                    AND attendance_date = '".$dt."'";

                    $result = $this->db->update($query);
                } elseif ($value == "absent") {
                    $query = "UPDATE attendance_tbl
                    SET attendance_status = 'absent'
                    WHERE attendance_student_id = '".key."' 
                    AND attendance_course_code = '".$courseCode."'
                    AND attendance_date = '".$dt."'";

                    $result = $this->db->update($query);
                }
            }

            if($result) {
                $msg = "<div class='alert alert-success'>
                    Success! Attendance data updated successfully!
                </div>";

                return $msg;
            } else {
                $msg = "<div class='alert alert-danger'>
                    Error! Attendance data couldn't be updated!
                </div>";

                return $msg;
            }
        }

        public function getDatewiseAttendReport($sd,$ed,$courseCode) {
            $query = "SELECT student_tbl.student_name, 
            student_tbl.student_roll_number, 
            attendance_tbl.*
            FROM student_tbl INNER JOIN attendance_tbl
            ON student_tbl.student_course_code LIKE '%{$courseCode}%'
            AND student_tbl.student_id = attendance_tbl.attendance_student_id
            WHERE attendance_date>='$sd' 
            AND attendance_date<='$ed' 
            AND attendance_course_code='$courseCode' 
            ORDER BY attendance_date DESC, student_roll_number ASC";
            $result = $this->db->select($query);
            return $result;
        }

        public function updateStudent($id,$name,$email,$hashed_pass,$roll,$dob,$courseCode,$prevcourseCode) {
            $id = mysqli_real_escape_string($this->db->link, $id);
            $name = mysqli_real_escape_string($this->db->link, $name);
            $email = mysqli_real_escape_string($this->db->link, $email);
            $hashed_pass = mysqli_real_escape_string($this->db->link, $hashed_pass);
            $roll = mysqli_real_escape_string($this->db->link, $roll);
            $dob = mysqli_real_escape_string($this->db->link, $dob);
            $courseCode = mysqli_real_escape_string($this->db->link, $courseCode);
            $prevcourseCode = mysqli_real_escape_string($this->db->link, $prevcourseCode);

            if(empty($name) || empty($email) || empty($hashed_pass) || empty($roll)|| 
               empty($dob)|| empty($courseCode)) {
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
                //Update student info
                $query = "UPDATE student_tbl 	
                SET student_name = '$name',
                student_email = '$email', 
                student_password = '$hashed_pass', 
                student_roll_number = '$roll', 
                student_dob = '$dob', 
                student_course_code = '$courseCode'
                WHERE student_id='$id' AND student_course_code = '$prevcourseCode'";

                $result = $this->db->update($query);
                
                if($result) {
                    $msg = "<div class='alert alert-success'>
                        Success! Student info updated successfully!
                    </div>";

                    return $msg;
                } else {
                    $msg = "<div class='alert alert-danger'>
                        Error! Student info couldn't be updated!
                    </div>";

                    return $msg;
                }
            }
        }

        public function deleteStudent($id,$courseCode) {
            //Delete student info
            $query = "DELETE FROM student_tbl 
            WHERE student_id='$id' AND student_course_code='$courseCode'";

            $result = $this->db->delete($query);
            
            if($result) {
                $msg = "<div class='alert alert-success'>
                    Success! Student info deleted successfully!
                </div>";

                return $msg;
            } else {
                $msg = "<div class='alert alert-danger'>
                    Error! Student info couldn't be deleted!
                </div>";

                return $msg;
            }
        }
    }
?>