<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $nombre2 = $_POST['nombre2'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $apellido_casada = $_POST['apellido_casada'];
    $dpi = $_POST['dpi'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $fecha_solicitud = $_POST['fecha_solicitud'];
    $escolaridad = $_POST['escolaridad'];
    $muestra_tecnica = $_POST['muestra_tecnica'];
    $entrevista_jefe = $_POST['entrevista_jefe'];
    $psicometria = $_POST['psicometria'];
    $dias_prueba = $_POST['dias_prueba'];
    $referencias = $_POST['referencias'];
    $poligrafo = $_POST['poligrafo'];
    $otra_fecha_aplico = $_POST['otra_fecha_aplico'];
    $correo_electronico = $_POST['correo_electronico'];
    $numero_telefono = $_POST['numero_telefono'];
    $plaza_aplico = $_POST['plaza_aplico'];
    $estado = $_POST['estado'];
    $observaciones = $_POST['observaciones'];

    $sql = "UPDATE usuarios SET 
            nombre = ?, 
            nombre2 = ?, 
            apellido1 = ?, 
            apellido2 = ?, 
            apellido_casada = ?,
            dpi = ?,
            fecha_nacimiento = ?,
            fecha_solicitud = ?,
            escolaridad = ?,
            muestra_tecnica = ?,
            entrevista_jefe = ?,
            psicometria = ?,
            dias_prueba = ?,
            referencias = ?,
            poligrafo = ?,
            otra_fecha_aplico = ?,
            correo_electronico = ?,
            numero_telefono = ?,
            plaza_aplico = ?,
            estado = ?,
            observaciones = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssssssssi", 
        $nombre, $nombre2, $apellido1, $apellido2, $apellido_casada,
        $dpi, $fecha_nacimiento, $fecha_solicitud, $escolaridad,
        $muestra_tecnica, $entrevista_jefe, $psicometria, $dias_prueba,
        $referencias, $poligrafo, $otra_fecha_aplico, $correo_electronico,
        $numero_telefono, $plaza_aplico, $estado, $observaciones, $id);
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
