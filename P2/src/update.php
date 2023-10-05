<?php

require_once "config.php";
 

$name = $lastname = $groupnum = $coursenum = "";
$name_err = $lastname_err = $groupnum_err = $coursenum_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    $id = $_POST["id"];
    
    
    $input_name = trim($_POST["name"]);
    $name = $input_name;
    
    
    $input_lastname = trim($_POST["lastname"]);
    $lastname = $input_lastname;

    
    $input_groupnum = trim($_POST["groupnum"]);
    $groupnum = $input_groupnum;

    
    $input_coursenum = trim($_POST["coursenum"]);
    $coursenum = $input_coursenum;
    

    
    
    if(empty($name_err) && empty($lastname_err) && empty($groupnum_err) && empty($coursenum_err) ){
        
        $sql = "UPDATE students SET name=?, lastname=?, groupnum=?, coursenum=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ssssi", $param_name, $param_lastname, $param_groupnum, $param_coursenum, $param_id);
            
            
            $param_name = $name;
            $param_lastname = $lastname;
            $param_groupnum = $groupnum;
			$param_coursenum = $coursenum;
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: index.php");
                exit();
            } else{
                echo "Что-то пошло не так";
            }
        }
         
        
        mysqli_stmt_close($stmt);
    }
    
    
    mysqli_close($link);
} else{
    
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);
        
        
        $sql = "SELECT * FROM students WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
           
            $param_id = $id;
            
            
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
    }  else{
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Обновить запись</title>
</head>
<body>
    
<h2>Обновить запись</h2>
<p>Пожалуйста заполните форму для обновления записи о студенте.</p>
<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
    <div>
        <label>Имя</label>
        <input type="text" name="name" <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?> value="<?php echo $name; ?>">
        <span class="invalid-feedback"><?php echo $name_err;?></span>
    </div>
    <div class="form-group">
        <label>Фамилия</label>
        <textarea name="lastname"<?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>><?php echo $lastname; ?></textarea>
        <span class="invalid-feedback"><?php echo $lastname_err;?></span>
    </div>
    <div class="form-group">
        <label>Номер группы</label>
        <input type="text" name="groupnum"<?php echo (!empty($groupnum_err)) ? 'is-invalid' : ''; ?> value="<?php echo $groupnum; ?>">
        <span class="invalid-feedback"><?php echo $groupnum_err;?></span>
    </div>
    <div class="form-group">
        <label>Номер курса</label>
        <input type="text" name="coursenum"<?php echo (!empty($coursenum_err)) ? 'is-invalid' : ''; ?> value="<?php echo $coursenum; ?>">
        <span class="invalid-feedback"><?php echo $coursenum_err;?></span>
    </div>	
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    <input type="submit" value="Submit">
    <a href="index.php">Отмена</a>
</form>

</body>
</html>