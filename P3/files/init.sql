
CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT, UPDATE, INSERT, DELETE ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
CREATE TABLE IF NOT EXISTS students
(
    id         INT(11)     NOT NULL AUTO_INCREMENT,
    name       VARCHAR(40) NOT NULL,
    surname    VARCHAR(50) NOT NULL,
    group_name VARCHAR(40) NOT NULL,
    PRIMARY KEY (id)
);



INSERT INTO students (id, name, surname, group_name)
VALUES (1, N'Иван', N'Петров', N'ИКБО-01-21'),
       (2, N'Алексей', N'Сидоров', N'ИКБО-01-21'),
       (3, N'Александр', N'Иванов', N'ИКБО-01-21'),
       (4, N'Андрей', N'Смирнов', N'ИКБО-01-21'),
       (5, N'Антон', N'Кузнецов', N'ИКБО-03-21'),
       (6, N'Артём', N'Васильев', N'ИКБО-03-21'),
       (7, N'Владимир', N'Попов', N'ИКБО-03-21'),
       (8, N'Владислав', N'Соколов', N'ИКБО-03-21'),
       (9, N'Даниил', N'Михайлов', N'ИКБО-03-21'),
       (10, N'Денис', N'Новиков', N'ИКБО-03-21');


CREATE TABLE IF NOT EXISTS courses
(
    id   INT(11)     NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);



INSERT INTO courses (id, name)
VALUES (1, N'Математический анализ'),
       (2, N'Алгебра и геометрия'),
       (3, N'Информатика'),
       (4, N'Физика'),
       (5, N'Иностранный язык'),
       (6, N'Физическая культура'),
       (7, N'История'),
       (8, N'Философия'),
       (9, N'Экономика'),
       (10, N'Право');


CREATE TABLE IF NOT EXISTS enrollment
(
    id         INT(11) NOT NULL AUTO_INCREMENT,
    student_id INT(11) NOT NULL,
    course_id  INT(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses (id) ON DELETE CASCADE
);



INSERT INTO enrollment (student_id, course_id)
VALUES (1, 1),
       (1, 2),
       (1, 5),
       (1, 6),
       (2, 9),
       (2, 10),
       (3, 1),
       (3, 6),
       (3, 10),
       (4, 2),
       (4, 3),
       (4, 4),
       (5, 5),
       (5, 6),
       (5, 7),
       (6, 8),
       (6, 9),
       (6, 10),
       (7, 1),
       (7, 2),
       (7, 3),
       (8, 4),
       (8, 5),
       (8, 6),
       (9, 7),
       (9, 8),
       (9, 9),
       (10, 10),
       (10, 1),
       (10, 2);