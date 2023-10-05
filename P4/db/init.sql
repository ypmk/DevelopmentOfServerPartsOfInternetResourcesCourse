CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT,DELETE,CREATE,REFERENCES ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;

CREATE TABLE IF NOT EXISTS users (
  user_id INT(10) NOT NULL AUTO_INCREMENT,
  user_name VARCHAR(20) NOT NULL,
  user_password VARCHAR(40) NOT NULL,
  PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS sets (
  set_id INT(10) NOT NULL AUTO_INCREMENT,
  set_name VARCHAR(20) NOT NULL,
  set_description VARCHAR(20),
  set_author_id INT(10) NOT NULL,
  FOREIGN KEY (set_author_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (set_id)
);

INSERT INTO users (user_name, user_password)
SELECT * FROM (SELECT 'Root', '12345') AS tmp
WHERE NOT EXISTS (
    SELECT user_name FROM users WHERE user_name = 'Root' AND user_password = '12345'
) LIMIT 1;

-- INSERT INTO users (name, surname)
-- SELECT * FROM (SELECT 'Bob', 'Marley') AS tmp
-- WHERE NOT EXISTS (
--     SELECT name FROM users WHERE name = 'Bob' AND surname = 'Marley'
-- ) LIMIT 1;

-- INSERT INTO users (name, surname)
-- SELECT * FROM (SELECT 'Alex', 'Rover') AS tmp
-- WHERE NOT EXISTS (
--     SELECT name FROM users WHERE name = 'Alex' AND surname = 'Rover'
-- ) LIMIT 1;

-- INSERT INTO users (name, surname)
-- SELECT * FROM (SELECT 'Kate', 'Yandson') AS tmp
-- WHERE NOT EXISTS (
--     SELECT name FROM users WHERE name = 'Kate' AND surname = 'Yandson'
-- ) LIMIT 1;

-- INSERT INTO users (name, surname)
-- SELECT * FROM (SELECT 'Lilo', 'Black') AS tmp
-- WHERE NOT EXISTS (
--     SELECT name FROM users WHERE name = 'Lilo' AND surname = 'Black'
-- ) LIMIT 1;

-- create table if not exists users (
--   user_id INT(11) NOT NULL auto_increment,
--   user_name VARCHAR(20) NOT NULL,
--   user_password VARCHAR(20) NOT NULL,
--   PRIMARY KEY (user_id)
-- );

-- INSERT INTO users (user_name, user_password)
-- SELECT * FROM (SELECT 'Alex', '1234') AS tmp
-- WHERE NOT EXISTS (
--     SELECT user_name FROM users WHERE user_name = 'Alex' AND user_password = '1234'
-- ) LIMIT 1;

-- INSERT INTO users (name, surname)
-- SELECT * FROM (SELECT 'Bob', 'Marley') AS tmp
-- WHERE NOT EXISTS (
--     SELECT name FROM users WHERE name = 'Bob' AND surname = 'Marley'
-- ) LIMIT 1;

-- INSERT INTO users (name, surname)
-- SELECT * FROM (SELECT 'Alex', 'Rover') AS tmp
-- WHERE NOT EXISTS (
--     SELECT name FROM users WHERE name = 'Alex' AND surname = 'Rover'
-- ) LIMIT 1;

-- INSERT INTO users (name, surname)
-- SELECT * FROM (SELECT 'Kate', 'Yandson') AS tmp
-- WHERE NOT EXISTS (
--     SELECT name FROM users WHERE name = 'Kate' AND surname = 'Yandson'
-- ) LIMIT 1;

-- INSERT INTO users (name, surname)
-- SELECT * FROM (SELECT 'Lilo', 'Black') AS tmp
-- WHERE NOT EXISTS (
--     SELECT name FROM users WHERE name = 'Lilo' AND surname = 'Black'
-- ) LIMIT 1;