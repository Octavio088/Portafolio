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
                //fgetcsv($csvFile);
                // Parse data from CSV file line by line
                while(($line = fgetcsv($csvFile)) !== FALSE){
                    // Get row data
                    $clave_salon  = $line[0];
                    $nombre_salon  = $line[1];
                    $ubicacion_fisica   = $line[2];
                    // Check whether member already exists in the database with the same email
                    $prevQuery = "SELECT clave_salon FROM salones WHERE clave_salon = '".$line[0]."'";
                    $prevResult = $db->query($prevQuery);
                    if($prevResult->num_rows > 0){
                        // Update member data in the database
                        $db->query("UPDATE salones SET clave_salon = '".$clave_salon."', nombre_salon = '".$nombre_salon."', ubicacion_fisica = '".$ubicacion_fisica."' WHERE nombre_salon = '".$nombre_salon."'");
                    }else{
                        // Insert member data in the database
                        $db->query("INSERT INTO salones (clave_salon, nombre_salon, ubicacion_fisica) VALUES ('".$clave_salon."', '".$nombre_salon."','".$ubicacion_fisica."')");
                      }
                }
               // $db->query("DELETE FROM nombre_salon WHERE semestre = 0;");
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