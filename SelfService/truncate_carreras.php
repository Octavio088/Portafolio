<?php 
   include_once 'dbConfig.php';
   $result = $db->query("SET FOREIGN_KEY_CHECKS = 0;");
   $result = $db->query("TRUNCATE TABLE carreras;");
   $result = $db->query("SET FOREIGN_KEY_CHECKS = 1;");
   header("Location: menu.php".$qstring);
?>