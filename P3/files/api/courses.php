<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "../data/CourseDB.php";

$coursesDB = new CourseDB();

// if GET,
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $course = $coursesDB->getCourseByIdJSON($_GET['id']);
        if ($course != null) {
            http_response_code(200);
            echo json_encode($course);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Course not found."));
        }
    } else {
        $courses = $coursesDB->getCoursesJSON(100);
        if ($courses != null) {
            http_response_code(200);
            echo json_encode($courses);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Courses not found."));
        }
    }
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->name)) {
        $success = $coursesDB->createCourse($data->name);
        if (!$success) {
            http_response_code(500);
            echo json_encode(array("message" => "Unable to create course."));
            return;
        }

        http_response_code(201);
        echo json_encode(array("message" => "Course created."));
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create course. Data is incomplete."));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT'){
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->id) && isset($data->name)) {
        $success = $coursesDB->updateCourse($data->id, $data->name);
        if (!$success) {
            http_response_code(500);
            echo json_encode(array("message" => "Unable to update course."));
            return;
        }

        http_response_code(200);
        echo json_encode(array("message" => "Course updated."));
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Unable to update course. Data is incomplete."));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->id)) {
        $success = $coursesDB->deleteCourse($data->id);
        if (!$success) {
            http_response_code(500);
            echo json_encode(array("message" => "Unable to delete course."));
            return;
        }

        http_response_code(200);
        echo json_encode(array("message" => "Course deleted."));
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Unable to delete course. Data is incomplete."));
    }
}
else {
    http_response_code(405);
    echo json_encode(['message' => 'Method not allowed']);
}