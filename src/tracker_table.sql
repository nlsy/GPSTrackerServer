CREATE TABLE  `trackerdata`(
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `serial` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `gpstime` time NOT NULL,
  `lat` double,
  `lon` double,
  `gsm` string
)