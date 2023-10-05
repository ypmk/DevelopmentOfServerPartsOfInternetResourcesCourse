<?php
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    require_once "config.php";
    
    $sql = "SELECT * FROM students WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_GET["id"]);
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                $name = $row["name"];
                $lastname = $row["lastname"];
                $groupnum = $row["groupnum"];
				$coursenum = $row["coursenum"];
            } else{
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Что-то пошло не так";
        }
    }
     
    mysqli_stmt_close($stmt);
    
    mysqli_close($link);
} else{
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Просмотр записей</title>
</head>
<body>
    
<h1>Просмотр</h1>
<div>
    <label>Имя</label>
    <p><b><?php echo $row["name"]; ?></b></p>
</div>
<div>
    <label>Фамилия</label>
    <p><b><?php echo $row["lastname"]; ?></b></p>
</div>
<div>
    <label>Номер группы</label>
    <p><b><?php echo $row["groupnum"]; ?></b></p>
</div>					
<div>
    <label>Номер курса</label>
    <p><b><?php echo $row["coursenum"]; ?></b></p>
</div>
<p><a href="index.php">Назад</a></p>

</body>
</html>