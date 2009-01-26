#
# Table structure for table 'pages'
#
CREATE TABLE pages (
	tx_glpagescat_category int(11) DEFAULT '0' NOT NULL
);

#
# Table structure for table 'pages_cat_mm'
#
CREATE TABLE pages_cat_mm (
  uid_local int(11) unsigned DEFAULT '0' NOT NULL,
  uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) unsigned DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);

