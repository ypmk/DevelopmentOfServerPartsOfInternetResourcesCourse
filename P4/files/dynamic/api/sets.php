<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $mysqli = new mysqli("db", "user", "password", "appDB");

    $method = $_SERVER['REQUEST_METHOD'];
    $error = json_encode(array("message" => "Something went wrong"));

    if ($method == "GET") {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $data = $mysqli->query("SELECT * FROM sets WHERE set_id = '$id'");
            $result = array();
            foreach ($data as $row){
                $result[] = $row;
            }
            if (isset($result[0])) {
                echo json_encode($result[0]);
            } else {
                echo json_encode(array("Message" => "There are no set with id = $id"));
            }
        } else {
            $data = $mysqli->query("SELECT * FROM sets");
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
            if (isset($req['set_name']) && isset($req['set_description']) && isset($req['set_author_id'])) {
                $name = $req['set_name'];
                $description = $req['set_description'];
                $author = $req['set_author_id'];
                $mysqli->query("INSERT INTO sets (set_name, set_description, set_author_id) VALUES ('$name', '$description', $author)");
                echo json_encode(array("message" => "Success"));
            } else {
                echo $error;
            }
            break;

        case "PUT": 
            if (isset($req['set_id']) && isset($req['set_name']) && isset($req['set_description']) && isset($req['set_author_id'])) {
                $id = $req['set_id'];
                $name = $req['set_name'];
                $description = $req['set_description'];
                $author = $req['set_author_id'];

                $mysqli->query("UPDATE sets
                                SET set_name = '$name', set_description = '$description', set_author_id = $author
                                WHERE set_id = $id");
                echo json_encode(array("message" => "Success"));
            } else {
                echo $error;
            }
            break;

        case "DELETE":
            if (isset($req['set_id'])) {
                $id = $req['set_id'];
                $mysqli->query("DELETE from sets
                                WHERE set_id = $id");
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