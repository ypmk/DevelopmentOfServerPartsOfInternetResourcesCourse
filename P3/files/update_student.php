<html lang="en">
<head>
    <title>Изменение записи студента</title>
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
        echo "<h1>Текущая запись</h1>";
        echo "<p>Имя: {$row['name']}</p>";
        echo "<p>Фамилия: {$row['surname']}</p>";
        echo "<p>Группа: {$row['group_name']}</p>";

        echo "<h1>Изменение записи</h1>";
        echo "<form action='update_student.php' method='post'>";
        echo "<input type='hidden' name='id' value='$id'/>";
        echo "<p>Новое Имя: <input type='text' name='name' value='{$row['name']}'/></p>";
        echo "<p>Новая Фамилия: <input type='text' name='surname' value='{$row['surname']}'/></p>";
        echo "<p>Новая Группа: <input type='text' name='group_name' value='{$row['group_name']}'/></p>";
        echo "<input type='submit' />";
        echo "</form>";

    } else {
        echo "<p>Запись с {$id} не найдена</p>";
    }
} else if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['group_name'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $group_name = $_POST['group_name'];
    $mysqli = new mysqli("db", "user", "password", "appDB");
    $mysqli->query("UPDATE students SET name='$name', surname='$surname', group_name='$group_name' WHERE id=$id");

    echo "<p>Запись обновлена</p>";
} else {
    echo "<p>Неверный запрос</p>";
}
?>
</div>
<a href="index.php">Назад</a>
</body>
</html>