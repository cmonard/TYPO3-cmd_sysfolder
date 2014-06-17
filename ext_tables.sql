#
# Table structure for table 'tx_cmdsysfolder_icon'
#
CREATE TABLE tx_cmdsysfolder_icon (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    cruser_id int(11) DEFAULT '0' NOT NULL,
    name varchar(255) DEFAULT '' NOT NULL,
    icon text,
	tables varchar(255) DEFAULT 'pages' NOT NULL,
    
    PRIMARY KEY (uid),
    KEY parent (pid)
);