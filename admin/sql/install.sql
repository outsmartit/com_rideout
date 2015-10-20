CREATE TABLE IF NOT EXISTS #__myrides (
id int(11) NOT NULL AUTO_INCREMENT,
title varchar(100),
submitter_id int(11),
category_id int(11),
description text,
eventdate datetime DEFAULT '0000.00.00 00:00:00',
date_registered datetime DEFAULT '0000.00.00 00:00:00',
distance int(3),
starting_point varchar(40),
status varchar(10),
PRIMARY KEY(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;