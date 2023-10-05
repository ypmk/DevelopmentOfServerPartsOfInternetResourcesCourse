<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "../data/StudentDB.php";

$studentDB = new StudentDB();

// if GET,
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $student = $studentDB->getStudentByIdJSON($_GET['id']);
        if ($student != null) {
            http_response_code(200);
            echo json_encode($student);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Student not found."));
        }
    } else {
        $students = $studentDB->getStudentsJSON(100);
        if ($students != null) {
            http_response_code(200);
            echo json_encode($students);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Students not found."));
        }
    }
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->name) && isset($data->surname) && isset($data->group_name)) {
        $success = $studentDB->createStudent($data->name, $data->surname, $data->group_name);
        if (!$success) {
            http_response_code(500);
            echo json_encode(array("message" => "Unable to create student."));
            return;
        }

        http_response_code(201);
        echo json_encode(array("message" => "Student created."));
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create student. Data is incomplete."));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT'){
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->id) && isset($data->name) && isset($data->surname) && isset($data->group_name)) {
        $success = $studentDB->updateStudent($data->id, $data->name, $data->surname, $data->group_name);
        if (!$success) {
            http_response_code(500);
            echo json_encode(array("message" => "Unable to update student."));
            return;
        }

        http_response_code(200);
        echo json_encode(array("message" => "Student updated."));
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Unable to update student. Data is incomplete."));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->id)) {
        $success = $studentDB->deleteStudent($data->id);
        if (!$success) {
            http_response_code(500);
            echo json_encode(array("message" => "Unable to delete student."));
            return;
        }

        http_response_code(200);
        echo json_encode(array("message" => "Student deleted."));
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Unable to delete student. Data is incomplete."));
    }
}
