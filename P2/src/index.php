<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Доска</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
  
<div>
    <h2 class="pull-left">Отчет по студентам</h2>
    <a href="create.php">Добавить студента</a>
</div>
<?php

require_once "config.php";
                    
                   
$sql = "SELECT * FROM students";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo '<table class="table table-bordered table-striped">';
            echo "<thead>";
                echo "<tr>";
                    echo "<th>#</th>";
                    echo "<th>Имя</th>";
                    echo "<th>Фамилия</th>";
                    echo "<th>Номер группы</th>";
                    echo "<th>Номер курса</th>";
                    echo "<th>Действие</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['lastname'] . "</td>";
                    echo "<td>" . $row['groupnum'] . "</td>";
                    echo "<td>" . $row['coursenum'] . "</td>";
                    echo "<td>";
                        echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="Просмотр записи" data-toggle="tooltip">Прочитать</a>';
                        echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Обновление записи" data-toggle="tooltip">Изменить</span></a>';
                        echo '<a href="delete.php?id='. $row['id'] .'" title="Удаление записи" data-toggle="tooltip">Удалить</a>';
                    echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";                            
        echo "</table>";
        
        mysqli_free_result($result);
    } else{
        echo '<div class="alert alert-danger"><em>Не найдено ни одной записи.</em></div>';
    }
} else{
    echo "Что-то пошло не так";
}


mysqli_close($link);
?>
               
</body>
</html>