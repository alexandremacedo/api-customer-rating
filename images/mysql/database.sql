CREATE USER 'userratingapi'@'%' IDENTIFIED BY PASSWORD 'passwordratingapi';
GRANT ALL ON data.* TO 'userratingapi'@'%';

CREATE DATABASE ratingapi;