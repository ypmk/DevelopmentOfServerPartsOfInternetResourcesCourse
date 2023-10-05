<?php
include_once 'Database.php';
include_once '../models/Student.php';


class StudentDB extends Database
{
    public function getStudents($limit)
    {
        $result = $this->db->query("SELECT * FROM students LIMIT $limit");
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = new Student($row['id'], $row['name'], $row['surname'], $row['group_name']);
        }
        return $students;
    }

    public function getStudentsJSON($limit)
    {
        $students = $this->getStudents($limit);
        $studentsJSON = [];
        foreach ($students as $student) {
            $studentsJSON[] = [
                'id' => $student->getId(),
                'name' => $student->getName(),
                'surname' => $student->getSurname(),
                'group_name' => $student->getGroupName()
            ];
        }
        return $studentsJSON;
    }

    public function getStudentById($id)
    {
        $result = $this->db->query("SELECT * FROM students WHERE id=$id");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Student($row['id'], $row['name'], $row['surname'], $row['group_name']);
        } else {
            return null;
        }
    }

    public function getStudentByIdJSON($id)
    {
        $student = $this->getStudentById($id);
        if ($student != null) {
            return [
                'id' => $student->getId(),
                'name' => $student->getName(),
                'surname' => $student->getSurname(),
                'group_name' => $student->getGroupName()
            ];
        } else {
            return null;
        }
    }

    public function createStudent($name, $surname, $group_name)
    {
        $sql = "INSERT INTO students (name, surname, group_name) VALUES ('$name', '$surname', '$group_name')";
        return $this->db->query($sql);
    }

    public function updateStudent($id, $name, $surname, $group_name)
    {
        $student = $this->getStudentById($id);
        if ($student == null) {
            return false;
        }

        $sql = "UPDATE students SET name='$name', surname='$surname', group_name='$group_name' WHERE id=$id";
        return $this->db->query($sql);
    }

    public function deleteStudent($id)
    {
        $student = $this->getStudentById($id);
        if ($student == null) {
            return false;
        }

        $sql = "DELETE FROM students WHERE id=$id";
        return $this->db->query($sql);
    }
}