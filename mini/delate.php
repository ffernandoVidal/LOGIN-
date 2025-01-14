<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "LoginDB");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Eliminar usuario
if(isset($_POST['delete_user'])) {
    $id = $_POST['user_id'];
    $delete_sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Obtener usuarios
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Administración de Usuarios</h2>

        <!-- Botones de acciones -->
        <div class="mb-3">
            <a href="login.php" class="btn btn-secondary">Cerrar sesión</a>
            <a href="nuevo_registro.php" class="btn btn-primary">Nuevo Registro</a>
        </div>

        <!-- Tabla de usuarios -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['apellido'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>
                            <!-- Botón de editar (modificar según tu funcionalidad) -->
                            <a href='editar_usuario.php?id=" . $row['id'] . "' class='btn btn-warning'>Editar</a>

                            <!-- Formulario de eliminar usuario -->
                            <form action='dashboard.php' method='POST' style='display: inline;'>
                                <input type='hidden' name='user_id' id='user_id' value='" . $row['id'] . "'>
                                <button type='submit' class='btn btn-danger btn-delete' name='delete_user' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este usuario?\");'>Eliminar</button>
                            </form>
                        </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // Asignar el ID del usuario al formulario de eliminación
        $('.btn-delete').on('click', function() {
            var userId = $(this).closest('form').find('input[name="user_id"]').val();
            $('#user_id').val(userId);
        });
    </script>

</body>
</html>

<?php
$conn->close();
?>
