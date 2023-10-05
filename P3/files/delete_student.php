<html lang="en">
<head>
    <title>Удаление записи студента</title>
</head>
<body>
<div>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $mysqli = new mysqli("db", "user", "password", "appDB");
    $result = $mysqli->query("SELECT * FROM students WHERE id=$id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<p>Имя: {$row['name']}</p>";
        echo "<p>Фамилия: {$row['surname']}</p>";
        echo "<p>Группа: {$row['group_name']}</p>";

        echo "<h1>Удаление записи</h1>";
        echo "<form class='delete_form' onsubmit='return confirm(\"Вы уверены?\");' action='delete_student.php' method='post'>";
        echo "<input type='hidden' name='id' value='$id'/>";
        echo "<input type='submit' value='Удалить запись $id'/>";
        echo "</form>";
    } else {
        echo "<p>Запись с {$id}не найдена</p>";
    }
} else if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $mysqli = new mysqli("db", "user", "password", "appDB");
    $mysqli->query("DELETE FROM students WHERE id=$id");

    echo "<p>Запись удалена</p>";
} else {
    echo "<p>Неверный запрос</p>";
}
?>
</div>
<a href="index.php">Назад</a>
</body>
</html>