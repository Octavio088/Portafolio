<?php 
    // Load the database configuration file 
    include_once 'dbConfig.php'; 
    $filename = "materias_" . date('Y-m-d') . ".csv"; 
    $delimiter = ","; 
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
    // Set column headers 
    $fields = array('Materia', 'Nombre_Materia', 'Clave_Materia', 'Numero_horas', 'Creditos', 'Semestres','Materia_Anterior','Area','carrera'); 
    fputcsv($f, $fields, $delimiter); 
   $result = $db->query("SELECT materias.materia,materias.nombre_materia,materias.clave_materia,materias.numero_horas,materias.creditos,materias.semestre,materias.materia_anterior,materias.area,
        carreras.nombre AS nombre_carrera FROM materias INNER JOIN carreras ON materias.carrera = carreras.carrera ORDER BY materias.materia DESC");
    if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){ 
            $lineData = array(
                $row['materia'],
                $row['nombre_materia'],
                $row['clave_materia'],
                $row['numero_horas'], 
                $row['creditos'], 
                $row['semestre'], 
                $row['materia_anterior'], 
                $row['area'], 
                $row['nombre_carrera']  // Cambia de carrera a nombre_carrera
            ); 
            fputcsv($f, $lineData, $delimiter); 
        } 
    }
     
    // Move back to beginning of file 
    fseek($f, 0); 
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
    // Output all remaining data on a file pointer 
    fpassthru($f); 
    // Exit from file 
    exit();
?>