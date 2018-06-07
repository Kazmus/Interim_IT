<?php
	function dbConnexion() {
        $db = new PDO('mysql:host=localhost;port=3307;dbname=interim_it;charset=utf8', 'root', '');
   	 	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
?>