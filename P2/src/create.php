<?php
require_once "config.php";
 
$name = $lastname = $groupnum = $coursenum = "";
$name_err = $lastname_err = $groupnum_err = $coursenum_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input_name = trim($_POST["name"]);
    $name = $input_name;
	
    $input_lastname = trim($_POST["lastname"]);
    $lastname = $input_lastname;
    
    $input_groupnum = trim($_POST["groupnum"]);
    $groupnum = $input_groupnum;	

    $input_coursenum = trim($_POST["coursenum"]);
    $coursenum = $input_coursenum;
    

    if(empty($name_err) && empty($lastname_err) && empty($groupnum_err) && empty($coursenum_err) ){
        $sql = "INSERT INTO students (name, lastname, groupnum, coursenum) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_lastname, $param_groupnum, $param_coursenum);
            
            $param_name = $name;
            $param_lastname = $lastname;
            $param_groupnum = $groupnum;
			$param_coursenum = $coursenum;
            
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Создать запись</title>
</head>
<body>
    
<h2 >Создать запись</h2>
<p>Пожалуйста заполните форму для добавления новой записи в БД.</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div>
        <label>Имя</label>
        <input type="text" name="name"<?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?> value="<?php echo $name; ?>">
        <span><?php echo $name_err;?></span>
    </div>
    <div>
        <label>Фамилия</label>
        <textarea name="lastname" <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>><?php echo $lastname; ?></textarea>
        <span class="invalid-feedback"><?php echo $lastname_err;?></span>
    </div>
    <div>
        <label>Номер группы</label>
        <input type="text" name="groupnum"<?php echo (!empty($groupnum_err)) ? 'is-invalid' : ''; ?> value="<?php echo $groupnum; ?>">
        <span><?php echo $groupnum_err;?></span>
    </div>
    <div>
        <label>Номер курса</label>
        <input type="text" name="coursenum" <?php echo (!empty($coursenum_err)) ? 'is-invalid' : ''; ?> value="<?php echo $coursenum; ?>">
        <span><?php echo $coursenum_err;?></span>
    </div>						
    <input type="submit" value="Submit">
    <a href="index.php" >отмена</a>
</form>
</body>
</html>