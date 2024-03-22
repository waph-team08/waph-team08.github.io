drop table if exists `users`;
create table users(
  username varchar(50) PRIMARY KEY,
  password varchar(100) NOT NULL);

LOCK TABLES `users` WRITE;
INSERT INTO users(username,password) VALUES ('waph_team08',md5('Pa$$w0rd'));
UNLOCK TABLES;
