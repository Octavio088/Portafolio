<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Actualizar Carreras</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Tablas_incersion_masiva.css" />
</head>
<body>
    <div class="container">
        <?php
    // Load the database configuration file
    include_once 'dbConfig.php';

    // Get status message
    if(!empty($_GET['status'])){
        switch($_GET['status']){
            case 'succ':
                $statusType = 'alert-success';
                $statusMsg = 'Members data has been imported successfully.';
                break;
            case 'err':
                $statusType = 'alert-danger';
                $statusMsg = 'Some problem occurred, please try again.';
                break;
            case 'invalid_file':
                $statusType = 'alert-danger';
                $statusMsg = 'Please upload a valid CSV file.';
                break;
            default:
                $statusType = '';
                $statusMsg = '';
        }
    }
?>
<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>
<div class="row">
    <!-- Import & Export link -->
    <div class="col-md-12 head">
        <div class="float-right">
            <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
            <a href="export_carreras.php" class="btn btn-primary"><i class="exp"></i> Export</a>
            <a href="truncate_carreras.php" class="btn btn-primary"><i class="exp"></i> Truncate</a>
        </div>
    </div>
    <!-- CSV file upload form -->
    <div class="col-md-12" id="importFrm" style="display: none;">
        <form action="import_carreras.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
        </form>
    </div>
    
    <!-- Data list table --> 
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Carrera</th>
                <th>Nombre</th>
                <th>Semestre</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Get member rows
        $result = $db->query("SELECT * FROM carreras");
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
        ?>
            <tr>
                <td><?php echo $row['carrera']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['semestres']; ?></td>
            </tr>
        <?php } }else{ ?>
            <tr><td colspan="5">No member(s) found...</td></tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<a href='Menu.php'>Salir</a>
    </div>

<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
</body>
</html>