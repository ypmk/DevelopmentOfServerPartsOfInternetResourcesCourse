<html lang="en">
    <meta charset="UTF-8">
    <head>
        <title>Update page</title>
        <link rel="stylesheet" href="css/style.css" type="text/css"/>
    </head>
    <body>
    <style>
        /* внешние границы таблицы серого цвета толщиной 1px */
        table {
            border: 1px solid grey;
            background-color: Lavender;
            margin-left: 0;
        }
        /* границы ячеек первого ряда таблицы */
        th {
            border: 1px solid rgb(126, 123, 123);
            font-size: 170%;
        }
        /* границы ячеек тела таблицы */
        td {
            border: 1px solid grey;
            font-size: 170%;
        }
        h1 {
            margin-left: 0;
            text-align: left;
        }
    </style>
        <?php
            include dirname(__FILE__) . "/navigation.php";
        ?>
        <hr>
        <table>
            <tr><th>Id</th><th>Name</th><th>Password</th></tr>
        <?php
            $mysqli = new mysqli("db", "user", "password", "appDB");
            if (isset($_POST['user_id']) && isset($_POST['user_password'])) {
                $id = $_POST['user_id'];
                $password = $_POST['user_password'];

                $mysqli->query("UPDATE users
                                SET user_password = '$password'
                                WHERE user_id = $id");
            }
            $mysqli = new mysqli("db", "user", "password", "appDB");
            $result = $mysqli->query("SELECT * FROM users");
            foreach ($result as $row){
                echo "<tr><td>{$row['user_id']}</td><td>{$row['user_name']}</td><td>{$row['user_password']}</td></tr>";
            }
        ?>
        </table>
        <form action='update.php' method='post'>
            <p>Обновить</p>
            <label for='user_id'>Id</label>
            <input type='text' id='user_id' name='user_id'/><br>
            <label for='user_password'>Password</label>
            <input type='text' id='user_password' name='user_password'/><br>
            <input type='submit'>
        </form>
    </body>
</html>