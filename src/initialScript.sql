DROP DATABASE IF EXISTS ScanSpect;
CREATE DATABASE ScanSpect;

USE ScanSpect;

DROP TABLE IF EXISTS people;
CREATE TABLE people(
    id INT PRIMARY KEY AUTO_INCREMENT,
    date DATE,
    hours INT,
    minutes INT,
    seconds INT
);

DROP TABLE IF EXISTS user;
CREATE TABLE user(
    username varchar(30) PRIMARY KEY, 
    password varchar(30),
    admin boolean
);

DROP USER IF EXISTS 'normalUser'@'localhost';
CREATE USER 'normalUser'@'localhost' identified by "Normal_1";
GRANT SELECT, INSERT on ScanSpect.user to 'normalUser'@'localhost';
GRANT SELECT on ScanSpect.people to 'normalUser'@'localhost';

#Utilizzare la password mysql_native_password. Decommentare la riga sotto qualora non fosse così
#ALTER USER 'normalUser'@'localhost' IDENTIFIED WITH mysql_native_password BY 'Normal_1';

DROP USER IF EXISTS 'adminUser'@'localhost';
CREATE USER 'adminUser'@'localhost' identified by "!Ciao123";
GRANT ALL on ScanSpect.* to 'adminUser'@'localhost';

#Utilizzare la password mysql_native_password. Decommentare la riga sotto qualora non fosse così
#ALTER USER 'adminUser'@'localhost' IDENTIFIED WITH mysql_native_password BY '!Ciao123';
