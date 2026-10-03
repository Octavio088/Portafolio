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
                    $nombre_materia   = $line[0];
                    $clave_materia  = $line[1];
                    $numero_horas   = $line[2];
                    $creditos  = $line[3];
                    $semestre   = $line[4];
                    $materia_anterior  = $line[5];
                    $area   = $line[6];
                    $carrera  = $line[7];

                    // Check whether member already exists in the database with the same email
                    $prevQuery = "SELECT nombre_materia FROM materias WHERE nombre_materia = '".$line[0]."'";
                    $prevResult = $db->query($prevQuery);
                    if($prevResult->num_rows > 0){
                        // Update member data in the database
                        $db->query("UPDATE materias SET nombre_materia = '".$nombre_materia."', clave_materia = '".$clave_materia."', numero_horas = '".$numero_horas."', creditos = '".$creditos."', semestre = '".$semestre."' , materia_anterior = '".$materia_anterior."', area = '".$area."', carrera = '".$carrera."' WHERE nombre_materia = '".$nombre_materia."'");
                    }else{
                        // Insert member data in the database
                        $db->query("SET foreign_key_checks = 0");
                            $db->query("INSERT INTO materias (nombre_materia, clave_materia, numero_horas , creditos , semestre, materia_anterior, area, carrera) VALUES ('".$nombre_materia."', '".$clave_materia."','".$numero_horas."','".$creditos."','".$semestre."','".$materia_anterior."', '".$area."','".$carrera."')");
                        $db->query("SET foreign_key_checks = 1");
                      }
                }
                $db->query("UPDATE materias SET materia_anterior = NULL WHERE materia_anterior = 0;");
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