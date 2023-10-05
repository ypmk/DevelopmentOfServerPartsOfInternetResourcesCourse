<?php
include_once 'Database.php';
include_once 'CourseDB.php';
include_once 'StudentDB.php';


class EnrollmentDB extends Database
{
    private $courseDB;
    private $studentDB;

    public function __construct()
    {
        parent::__construct();
        $this->courseDB = new CourseDB();
        $this->studentDB = new StudentDB();
    }

    public function getEnrollmentJSON($limit)
    {
        $result = $this->db->query("SELECT * FROM enrollment LIMIT $limit");
        $enrollment = [];
        while ($row = $result->fetch_assoc()) {
            // resolve course
            $course = $this->courseDB->getCourseById($row['course_id']);
            // resolve student
            $student = $this->studentDB->getStudentById($row['student_id']);

            $enrollment[] = [
                'id' => $row['id'],
                'course' => [
                    'id' => $course->getId(),
                    'name' => $course->getName()
                ],
                'student' => [
                    'id' => $student->getId(),
                    'name' => $student->getName(),
                    'surname' => $student->getSurname(),
                    'group_name' => $student->getGroupName()
                ]
            ];
        }
        return $enrollment;
    }

    public function getEnrollmentForStudentJSON($student_id)
    {
        $result = $this->db->query("SELECT * FROM enrollment WHERE student_id=$student_id");
        $enrollment = [];

        while ($row = $result->fetch_assoc()) {
            // resolve course
            $course = $this->courseDB->getCourseById($row['course_id']);
            // resolve student
            $student = $this->studentDB->getStudentById($row['student_id']);

            $enrollment[] = [
                'id' => $row['id'],
                'course' => [
                    'id' => $course->getId(),
                    'name' => $course->getName()
                ]
            ];
        }
        return $enrollment;
    }

    public function getEnrollmentForCourseJSON($course_id)
    {
        $result = $this->db->query("SELECT * FROM enrollment WHERE course_id=$course_id");
        $enrollment = [];

        while ($row = $result->fetch_assoc()) {
            $course = $this->courseDB->getCourseById($row['course_id']);
            $student = $this->studentDB->getStudentById($row['student_id']);

            $enrollment[] = [
                'id' => $row['id'],
                'student' => [
                    'id' => $student->getId(),
                    'name' => $student->getName(),
                    'surname' => $student->getSurname(),
                    'group_name' => $student->getGroupName()
                ]
            ];
        }
        return $enrollment;
    }

    public function createEnrollment($course_id, $student_id)
    {
        $result = $this->db->query("SELECT * FROM enrollment WHERE course_id=$course_id AND student_id=$student_id");
        if ($result->num_rows > 0) {
            return false;
        }

        $sql = "INSERT INTO enrollment (course_id, student_id) VALUES ($course_id, $student_id)";
        return $this->db->query($sql);
    }

    public function deleteEnrollment($course_id, $student_id)
    {
        $result = $this->db->query("SELECT * FROM enrollment WHERE course_id=$course_id AND student_id=$student_id");

        if ($result->num_rows == 0) {
            return false;
        }

        $sql = "DELETE FROM enrollment WHERE course_id=$course_id AND student_id=$student_id";
        return $this->db->query($sql);
    }
}