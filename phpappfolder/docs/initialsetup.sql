CREATE DATABASE  `WebBasedControlSystem` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE  `WebBasedControlSystem`.`user` (
`id` INT NOT NULL AUTO_INCREMENT ,
`name` VARCHAR( 64 ) NOT NULL ,
`email` VARCHAR( 64 ) NOT NULL ,
`username` VARCHAR( 64 ) NOT NULL ,
`password` VARCHAR( 32 ) NOT NULL ,
`phonenumber` VARCHAR( 16 ) NOT NULL ,
PRIMARY KEY (  `id` )
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE USER 'wbcs'@'localhost' IDENTIFIED BY  'wbcs1234';

GRANT SELECT , INSERT , UPDATE , DELETE ON  `WebBasedControlSystem` . * TO  'wbcs'@'localhost';
