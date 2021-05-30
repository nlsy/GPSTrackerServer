-- SQL Table structure
CREATE TABLE `trackerdata_` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `datetime` DATETIME NOT NULL ,
  `gpstime` TIME NOT NULL ,
  `lat` DOUBLE NOT NULL ,
  `lon` DOUBLE NOT NULL ,
  `gsm` TEXT NULL ,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;