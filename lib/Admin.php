<?php 
    $filePath = realpath(dirname(__FILE__));
    include_once($filePath.'/Database.php')
?>

<?php 
    class Admin {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function getAdmins() {
            $query = "SELECT * FROM admin_tbl";
            $result = $this->db->select($query);
            return $result;
        }

        public function getSpecificAdmin($email) {
            $query = "SELECT DISTINCT * FROM admin_tbl
            WHERE admin_email='$email'";
            $result = $this->db->select($query);
            return $result;
        }

        public function updateAdmin($id,$name,$email,$hashed_pass) {
            $id = mysqli_real_escape_string($this->db->link, $id);
            $name = mysqli_real_escape_string($this->db->link, $name);
            $email = mysqli_real_escape_string($this->db->link, $email);
            $hashed_pass = mysqli_real_escape_string($this->db->link, $hashed_pass);

            if(empty($name) || empty($email) || empty($hashed_pass)) {
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
                $query = "UPDATE admin_tbl 	
                SET admin_name = '$name',
                admin_email = '$email', 
                admin_password = '$hashed_pass'
                WHERE admin_id='$id'";

                $result = $this->db->update($query);
                
                if($result) {
                    $msg = "<div class='alert alert-success'>
                        Success! Admin info updated successfully!
                    </div>";

                    return $msg;
                } else {
                    $msg = "<div class='alert alert-danger'>
                        Error! Admin info couldn't be updated!
                    </div>";

                    return $msg;
                }
            }
        }
    }
?>