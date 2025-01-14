<?php
session_start();
include 'db.php'; // Conexión a la base de datos

// Procesar cierre de sesión
if (isset($_POST['cerrar_sesion'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// Procesar formulario de guardado
if (isset($_POST['guardar'])) {
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

    $sql = "INSERT INTO usuarios (
        nombre, nombre2, apellido1, apellido2, apellido_casada, dpi, 
        fecha_nacimiento, fecha_solicitud, escolaridad, muestra_tecnica, 
        entrevista_jefe, psicometria, dias_prueba, referencias, poligrafo,
        otra_fecha_aplico, correo_electronico, numero_telefono, plaza_aplico,
        estado, observaciones
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssssssss", 
        $nombre, $nombre2, $apellido1, $apellido2, $apellido_casada, $dpi,
        $fecha_nacimiento, $fecha_solicitud, $escolaridad, $muestra_tecnica,
        $entrevista_jefe, $psicometria, $dias_prueba, $referencias, $poligrafo,
        $otra_fecha_aplico, $correo_electronico, $numero_telefono, $plaza_aplico,
        $estado, $observaciones
    );

    if ($stmt->execute()) {
        $mensaje = "Datos guardados exitosamente.";
    } else {
        $error = "Error al guardar los datos: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            overflow-y: auto;
        }
        .form-container {
            max-width: 800px;
            width: 100%;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-top: 60px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        h2::after {
            content: "";
            display: block;
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, #ff7e5f, #feb47b); /* Degradado */
            margin: 10px auto;
        }
        .section {
            margin-bottom: 15px;
        }
        .section.double {
            display: flex;
            justify-content: space-between;
        }
        .mensaje, .error {
            text-align: center;
            margin-top: 10px;
        }
        .mensaje {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Formulario de Registro de Usuario</h2>
        <?php if (isset($mensaje)) echo "<p class='mensaje'>$mensaje</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="POST" action="dashboard.php">
            <!-- Campos del formulario centrados -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre 1</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" required>
                </div>
                <div class="col-md-6">
                    <label for="nombre2" class="form-label">Nombre 2</label>
                    <input type="text" class="form-control" name="nombre2" id="nombre2">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="apellido1" class="form-label">Apellido 1</label>
                    <input type="text" class="form-control" name="apellido1" id="apellido1" required>
                </div>
                <div class="col-md-6">
                    <label for="apellido2" class="form-label">Apellido 2</label>
                    <input type="text" class="form-control" name="apellido2" id="apellido2">
                </div>
            </div>

            <!-- Apellido de Casada, DPI, Fecha de Nacimiento, Fecha de Solicitud y Escolaridad no centrados -->
            <div class="mb-3">
                <label for="apellido_casada" class="form-label">Apellido de Casada (opcional)</label>
                <input type="text" class="form-control" name="apellido_casada" id="apellido_casada">
            </div>
            <div class="mb-3">
                <label for="dpi" class="form-label">DPI</label>
                <input type="text" class="form-control" name="dpi" id="dpi" required>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" required>
                </div>
                <div class="col-md-6">
                    <label for="fecha_solicitud" class="form-label">Fecha de Solicitud</label>
                    <input type="date" class="form-control" name="fecha_solicitud" id="fecha_solicitud" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="escolaridad" class="form-label">Escolaridad</label>
                <input type="text" class="form-control" name="escolaridad" id="escolaridad" required>
            </div>

            <!-- El resto de los campos centrados -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="muestra_tecnica" class="form-label">Muestra Técnica</label>
                    <select class="form-select" name="muestra_tecnica" id="muestra_tecnica" required>
                        <option value="aprobó">Aprobó</option>
                        <option value="no aprobó">No Aprobó</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="entrevista_jefe" class="form-label">Entrevista con Jefe</label>
                    <select class="form-select" name="entrevista_jefe" id="entrevista_jefe" required>
                        <option value="✓">✓</option>
                        <option value="x">X</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="psicometria" class="form-label">Psicometría</label>
                    <select class="form-select" name="psicometria" id="psicometria" required>
                        <option value="✓">✓</option>
                        <option value="x">X</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="dias_prueba" class="form-label">Días de Prueba</label>
                    <select class="form-select" name="dias_prueba" id="dias_prueba" required>
                        <option value="✓">✓</option>
                        <option value="x">X</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="referencias" class="form-label">Referencias</label>
                    <select class="form-select" name="referencias" id="referencias" required>
                        <option value="✓">✓</option>
                        <option value="x">X</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="poligrafo" class="form-label">Polígrafo</label>
                    <select class="form-select" name="poligrafo" id="poligrafo" required>
                        <option value="✓">✓</option>
                        <option value="x">X</option>
                    </select>
                </div>
            </div>
  <?php if (isset($mensaje)) echo "<p class='mensaje text-success'>$mensaje</p>"; ?>
        <?php if (isset($error)) echo "<p class='error text-danger'>$error</p>"; ?>

        <form method="POST" action="dashboard.php">
            <!-- Nuevos Campos -->
            <div class="mb-3">
                <label for="otra_fecha_aplico" class="form-label">Otra Fecha Aplico</label>
                <input type="text" class="form-control" name="otra_fecha_aplico" id="otra_fecha_aplico">
            </div>
            <div class="mb-3">
                <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="correo_electronico" id="correo_electronico" required>
            </div>
            <div class="mb-3">
                <label for="numero_telefono" class="form-label">Número de Teléfono</label>
                <input type="text" class="form-control" name="numero_telefono" id="numero_telefono" required>
            </div>
            <div class="mb-3">
                <label for="plaza_aplico" class="form-label">Plaza Aplicó</label>
                <textarea class="form-control" name="plaza_aplico" id="plaza_aplico" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" name="estado" id="estado" required>
                    <option value="Aplicable">Aplicable</option>
                    <option value="No recomendable">No recomendable</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea class="form-control" name="observaciones" id="observaciones" rows="4"></textarea>
            </div>

            <button type="submit" name="guardar" class="btn btn-primary w-100">Guardar</button>
        </form>
       <a href="view_users.php" class="btn btn-success w-100 mt-3 mb-3">Visualizar Datos</a>
        <form method="POST">
            <button type="submit" name="cerrar_sesion" class="btn btn-danger w-100 mt-3">Cerrar sesión</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
