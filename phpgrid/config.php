<?php
// PHP Grid database connection settings
define("PHPGRID_DBTYPE","Mysql"); // or mysqli
define("PHPGRID_DBHOST","localhost");
define("PHPGRID_DBUSER","jigzenco_ngrdev");
define("PHPGRID_DBPASS","jigzen1234aA");
define("PHPGRID_DBNAME","jigzenco_demo_live");

// Automatically make db connection inside lib
define("PHPGRID_AUTOCONNECT",0);

// Basepath for lib
define("PHPGRID_LIBPATH",dirname(__FILE__).DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR);
