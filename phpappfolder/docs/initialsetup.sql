CREATE DATABASE  `p07224405db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE USER 'p07224405_web'@'mysql.t10.tech.dmu.ac.uk' IDENTIFIED BY  'imbUe+97';
GRANT SELECT , INSERT , UPDATE , DELETE ON  `p07224405db` . * TO  'p07224405_web'@'mysql.t10.tech.dmu.ac.uk';


CREATE TABLE `soapy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ident` varchar(32) NOT NULL,
  `soapmsg` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ident` (`ident`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE  `user` (
`id` INT NOT NULL AUTO_INCREMENT ,
`name` VARCHAR( 64 ) NOT NULL ,
`email` VARCHAR( 64 ) NOT NULL ,
`username` VARCHAR( 64 ) NOT NULL ,
`password` VARCHAR( 32 ) NOT NULL ,
`phonenumber` VARCHAR( 16 ) NOT NULL ,
PRIMARY KEY (  `id` )
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

