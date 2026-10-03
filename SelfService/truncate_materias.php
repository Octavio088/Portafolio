<?php 
   include_once 'dbConfig.php';
   $result = $db->query("SET FOREIGN_KEY_CHECKS = 0;");
   $result = $db->query("TRUNCATE TABLE materias;");
   $result = $db->query("SET FOREIGN_KEY_CHECKS = 1;");
   $result = $db->query("ALTER TABLE materias AUTO_INCREMENT = 0;");
   header("Location: menu.php".$qstring);
?>