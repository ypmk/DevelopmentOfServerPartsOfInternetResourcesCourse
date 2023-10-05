<?php
include_once 'Database.php';
include_once '../models/Course.php';

class CourseDB extends Database
{
    public function getCourses($limit)
    {
        $result = $this->db->query("SELECT * FROM courses LIMIT $limit");
        $courses = [];
        while ($row = $result->fetch_assoc()) {
            $courses[] = new Course($row['id'], $row['name']);
        }
        return $courses;
    }

    public function getCoursesJSON($limit)
    {
        $courses = $this->getCourses($limit);
        $coursesJSON = [];
        foreach ($courses as $course) {
            $coursesJSON[] = [
                'id' => $course->getId(),
                'name' => $course->getName()
            ];
        }

        return $coursesJSON;
    }

    public function getCourseById($id)
    {
        $result = $this->db->query("SELECT * FROM courses WHERE id=$id");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Course($row['id'], $row['name']);
        } else {
            return null;
        }
    }

    public function getCourseByIdJSON($id)
    {
        $course = $this->getCourseById($id);
        if ($course != null) {
            return [
                'id' => $course->getId(),
                'name' => $course->getName()
            ];
        } else {
            return null;
        }
    }

    public function createCourse($name)
    {
        $sql = "INSERT INTO courses (name) VALUES ('$name')";
        return $this->db->query($sql);
    }

    public function updateCourse($id, $name)
    {
        $course = $this->getCourseById($id);
        if ($course == null) {
            return false;
        }

        $sql = "UPDATE courses SET name='$name' WHERE id=$id";
        return $this->db->query($sql);
    }

    public function deleteCourse($id)
    {
        $course = $this->getCourseById($id);
        if ($course == null) {
            return false;
        }

        $sql = "DELETE FROM courses WHERE id=$id";
        return $this->db->query($sql);
    }
}