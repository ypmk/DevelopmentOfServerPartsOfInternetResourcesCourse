<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $mysqli = new mysqli("db", "user", "password", "appDB");

    $method = $_SERVER['REQUEST_METHOD'];
    $error = json_encode(array("message" => "Something went wrong"));

    if ($method == "GET") {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $data = $mysqli->query("SELECT * FROM users WHERE user_id = '$id'");
            $result = array();
            foreach ($data as $row){
                $result[] = $row;
            }
            if (isset($result[0])) {
                echo json_encode($result[0]);
            } else {
                echo json_encode(array("Message" => "There are no user with id = $id"));
            }
            
        } else {
            $data = $mysqli->query("SELECT * FROM users");
            $result = array();
            foreach ($data as $row){
                $result[] = $row;
            } 
            echo json_encode($result);
        }
        return;
    }

    $req = json_decode(file_get_contents('php://input'), true);

    switch ($method) {
        case "POST":
            if (isset($req['user_name']) && isset($req['user_password'])) {
                $name = $req['user_name'];
                $password = $req['user_password'];
                $mysqli->query("INSERT INTO users (user_name, user_password) VALUES ('$name', '$password')");
                echo json_encode(array("message" => "Success"));
            } else {
                echo $error;
            }
            break;

        case "PUT": 
            if (isset($req['user_id']) && isset($req['user_name']) && isset($req['user_password'])) {
                $id = $req['user_id'];
                $name = $req['user_name'];
                $password = $req['user_password'];
                $mysqli->query("UPDATE users
                                SET user_name = '$name', user_password = '$password'
                                WHERE user_id = $id");
                echo json_encode(array("message" => "Success"));
            } else {
                echo $error;
            }
            break;

        case "DELETE":
            if (isset($req['user_id'])) {
                $id = $req['user_id'];
                $mysqli->query("DELETE from users
                                WHERE user_id = $id");
                echo json_encode(array("message" => "Success"));
            } else {
                echo $error;
            }
            break;
        
        default:
            echo json_encode(array("message" => "Unsupported method"));
            break;
    }
?>