<?php
    // Load the database configuration file
    include_once 'dbConfig.php';
    if(isset($_POST['importSubmit'])){
        // Allowed mime types
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        // Validate whether selected file is a CSV file
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
            // If the file is uploaded
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                // Open uploaded CSV file with read-only mode
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                // Skip the first line
                fgetcsv($csvFile);
                // Parse data from CSV file line by line
                while(($line = fgetcsv($csvFile)) !== FALSE){
                    // Get row data
                    $tipo   = $line[0];
                    $hora_lunes = $line[1];
                    $hora_martes  = $line[2];
                    $hora_miercoles  = $line[3];
                    $hora_jueves   = $line[4];
                    $hora_viernes  = $line[5];
                    // Check whether member already exists in the database with the same email
                    $prevQuery = "SELECT tipo FROM horarios WHERE tipo = '".$line[0]."' AND hora_lunes = '".$line[1]."'";
                    $prevResult = $db->query($prevQuery);
                    // Insert member data in the database
                    $db->query("INSERT INTO horarios (tipo, hora_lunes, hora_martes , hora_miercoles , hora_jueves, hora_viernes) VALUES ('".$tipo."', '".$hora_lunes."','".$hora_martes."','".$hora_miercoles."','".$hora_jueves."','".$hora_viernes."')");
                }
                // Close opened CSV file
                fclose($csvFile);
                $qstring = '?status=succ';
            }else{
                $qstring = '?status=err';
            }
        }else{
            $qstring = '?status=invalid_file';
        }
    }
    // Redirect to the listing page
    header("Location: menu.php".$qstring);
?>