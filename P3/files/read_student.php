<html lang="en">
<head>
    <title>Чтение записи студента</title>
</head>
<body>
<div>
    <h1>Просмотр записи</h1>
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
        } else {
            echo "<p>Запись с id {$id} не найдена</p>";
        }
    } else {
        echo "<p>Неверный запрос</p>";
    }
    ?>
</div>
<form action='read_student.php' method='get'>
    <p>Введите id студента для просмотра записи: <input type='text' name='id'/></p>
    <input type='submit'/>
</form>

<a href="index.php">Назад</a>
</body>
</html>