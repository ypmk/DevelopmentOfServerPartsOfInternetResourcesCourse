<html lang="en">
<head>
<title>Hello world page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<div>
<h1>Таблица студентов</h1>
<table>
    <tr><th>Id</th><th>Имя</th><th>Фамилия</th><th>Группа</th><th>Операции</th></tr>
<?php
$mysqli = new mysqli("db", "user", "password", "appDB");
$result = $mysqli->query("SELECT * FROM students");
foreach ($result as $row){
    echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['surname']}</td><td>{$row['group_name']}</td>
    <td><a class='button' href='read_student.php?id={$row['id']}'>Просмотреть</a>
    <a class='button' href='update_student.php?id={$row['id']}'>Изменить</a>
    <a class='button' href='delete_student.php?id={$row['id']}'>Удалить</a></td></tr>";
}
?>
</table>
</div>
<a class='button' href="create_student.php">Создать запись</a>
</body>
</html>