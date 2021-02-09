<?php 
    $filePath = realpath(dirname(__FILE__));
    include_once($filePath.'/Database.php')
?>

<?php 
    class Course {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function getCourseList() {
            $query = "SELECT * FROM course_tbl ORDER BY course_code";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>