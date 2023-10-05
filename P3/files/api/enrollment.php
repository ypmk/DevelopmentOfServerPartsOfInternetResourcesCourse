<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "../data/EnrollmentDB.php";

$enrollmentDB = new EnrollmentDB();

// if GET,
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['student_id'])) {
        $enrollment = $enrollmentDB->getEnrollmentForStudentJSON($_GET['student_id']);
        if ($enrollment != null) {
            http_response_code(200);
            echo json_encode($enrollment);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Enrollment for student not found."));
        }
    } elseif (isset($_GET['course_id'])) {
        $enrollment = $enrollmentDB->getEnrollmentForCourseJSON($_GET['course_id']);
        if ($enrollment != null) {
            http_response_code(200);
            echo json_encode($enrollment);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Enrollment for course not found."));
        }
    } else {
        $enrollment = $enrollmentDB->getEnrollmentJSON(100);
        if ($enrollment != null) {
            http_response_code(200);
            echo json_encode($enrollment);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Enrollment not found."));
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->course_id) && isset($data->student_id)) {
        $success = $enrollmentDB->createEnrollment($data->course_id, $data->student_id);
        if (!$success) {
            http_response_code(500);
            echo json_encode(array("message" => "Unable to create enrollment."));
            return;
        }

        http_response_code(201);
        echo json_encode(array("message" => "Enrollment created."));
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create enrollment. Data is incomplete."));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->course_id) && isset($data->student_id)) {
        $success = $enrollmentDB->deleteEnrollment($data->course_id, $data->student_id);
        if (!$success) {
            http_response_code(500);
            echo json_encode(array("message" => "Unable to delete enrollment."));
            return;
        }

        http_response_code(200);
        echo json_encode(array("message" => "Enrollment deleted."));
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Unable to delete enrollment. Data is incomplete."));
    }
}