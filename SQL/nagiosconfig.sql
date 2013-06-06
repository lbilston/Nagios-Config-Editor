
CREATE TABLE IF NOT EXISTS `devices` (
  `IP` varchar(13) DEFAULT NULL,
  `Name` varchar(29) DEFAULT NULL,
  `Roles` varchar(37) DEFAULT NULL,
  `hostgroup` varchar(7) DEFAULT NULL,
  `Sort` int(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `hostGroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostgroup` varchar(25) NOT NULL,
  `hostgroupAlias` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

