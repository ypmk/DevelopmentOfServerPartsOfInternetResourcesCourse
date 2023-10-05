<html lang="en">
<head>
    <title>Создание записи студента</title>
</head>
<body>
<div>
<h1>Создание записи</h1>
<?php
echo "<form action='create_student.php' method='post'>";
echo "<p>Имя: <input type='text' name='name' /></p>";
echo "<p>Фамилия: <input type='text' name='surname' /></p>";
echo "<p>Группа: <input type='text' name='group_name' /></p>";
echo "<input type='submit' />";
echo "</form>";

if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['group_name'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $group_name = $_POST['group_name'];
    $mysqli = new mysqli("db", "user", "password", "appDB");
    $mysqli->query("INSERT INTO students (name, surname, group_name) VALUES ('$name', '$surname', '$group_name')");
    echo "<p>Запись создана</p>";
}
?>
</div>
<a href="index.php">Назад</a>
</body>
</html>