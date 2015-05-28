<?php	 
	// get language preference
	if (isset($_GET["lang"])) {
		$language = $_GET["lang"];
	}
	else if (isset($_SESSION["lang"])) {
		$language  = $_SESSION["lang"];
	}
	else {
		$language = "en_US";
	}
	
	// save language preference for future page requests
	$_SESSION["lang"]  = $language;
	 
	$folder = "Locale";
	$domain = "gathering-data";
	$encoding = "UTF-8";
	 
	putenv("LANG=" . $language); 
	setlocale(LC_ALL, $language);
	 
	bindtextdomain($domain, $folder); 
	bind_textdomain_codeset($domain, $encoding);
	
	bindtextdomain("errors", "Locale"); 
	bind_textdomain_codeset("errors", "UTF-8");
	 
	textdomain($domain);
	

?>

<?php
	if($language == "es_ES") { ?>
		<style>
			ul.lang-menu > li > a {
				padding-left: 10px;
				padding-right: 10px;
			}
		</style>
	<?php }
?>