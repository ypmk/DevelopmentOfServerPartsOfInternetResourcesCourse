<?php
if(isset($_POST["id"]) && !empty($_POST["id"])){
    require_once "config.php";
    
    $sql = "DELETE FROM students WHERE id = ?";
    //statement
    if($stmt = mysqli_prepare($link, $sql)){
       mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_POST["id"]);
        
        if(mysqli_stmt_execute($stmt)){
            header("location: index.php");
            exit();
        } else{
            echo "Что-то пошло не так";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else{
    if(empty(trim($_GET["id"]))){
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Удалить запись</title>
</head>
<body>

<h2>Удалить запись</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div>
        <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
        <p>Вы уверены, что хотите удалить запись данного студента?</p>
        <p>
            <input type="submit" value="Yes">
            <a href="index.php">Нет</a>
        </p>
    </div>
</form>
     
</body>
</html>