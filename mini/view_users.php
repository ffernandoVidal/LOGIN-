<?php
session_start();
include 'db.php';

// Manejar la eliminación de usuario
if(isset($_POST['delete_user'])) {
    $id = $_POST['user_id'];
    $delete_sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    exit; // Asegúrate de salir después de manejar la solicitud
}

// Obtener todos los usuarios con todos los campos
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        body {
            padding: 20px;
            background-color: #f7f9fc;
        }
        .container-fluid {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .btn-add {
            margin-bottom: 20px;
        }
        .dataTables_wrapper {
            margin-top: 20px;
        }
        .btn-edit, .btn-delete {
            padding: 5px 10px;
            margin: 0 2px;
        }
        .modal-xl {
            max-width: 95%;
        }
        table {
            width: 100% !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <h2 class="text-center mb-4">Visualizar Registros</h2>
        
        <a href="dashboard.php" class="btn btn-primary btn-add">NUEVO REGISTRO</a>

        <div class="table-responsive">
            <table id="userTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nombre Completo</th>
                        <th>DPI</th>
                        <th>Fecha Nacimiento</th>
                        <th>Fecha Solicitud</th>
                        <th>Escolaridad</th>
                        <th>Muestra Técnica</th>
                        <th>Entrevista Jefe</th>
                        <th>Psicometría</th>
                        <th>Días Prueba</th>
                        <th>Referencias</th>
                        <th>Polígrafo</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Plaza</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $count = 1;
                        while($row = $result->fetch_assoc()) {
                            $nombreCompleto = $row['nombre'] . ' ' . $row['nombre2'] . ' ' . 
                                            $row['apellido1'] . ' ' . $row['apellido2'] . 
                                            ($row['apellido_casada'] ? ' de ' . $row['apellido_casada'] : '');
                            echo "<tr>";
                            echo "<td>" . $count . "</td>";
                            echo "<td>" . $nombreCompleto . "</td>";
                            echo "<td>" . $row['dpi'] . "</td>";
                            echo "<td>" . $row['fecha_nacimiento'] . "</td>";
                            echo "<td>" . $row['fecha_solicitud'] . "</td>";
                            echo "<td>" . $row['escolaridad'] . "</td>";
                            echo "<td>" . $row['muestra_tecnica'] . "</td>";
                            echo "<td>" . $row['entrevista_jefe'] . "</td>";
                            echo "<td>" . $row['psicometria'] . "</td>";
                            echo "<td>" . $row['dias_prueba'] . "</td>";
                            echo "<td>" . $row['referencias'] . "</td>";
                            echo "<td>" . $row['poligrafo'] . "</td>";
                            echo "<td>" . $row['correo_electronico'] . "</td>";
                            echo "<td>" . $row['numero_telefono'] . "</td>";
                            echo "<td>" . $row['plaza_aplico'] . "</td>";
                            echo "<td>" . $row['estado'] . "</td>";
                            echo "<td>" . $row['observaciones'] . "</td>";
                            echo "<td>
                                    <button class='btn btn-info btn-edit' data-id='" . $row['id'] . "'
                                    <button class='btn btn-info btn-edit' data-id='" . $row['id'] . "'
                                    data-bs-toggle='modal' data-bs-target='#editModal'
                                    data-info='" . htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') . "'>
                                    Edit
                                  </button>
                                    <button class='btn btn-danger btn-delete' data-id='" . $row['id'] . "'>Delete</button>
                                  </td>";
                            echo "</tr>";
                            $count++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

  <!-- Modal de Edición -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="edit_nombre" class="form-label">Nombre 1</label>
                                <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="edit_nombre2" class="form-label">Nombre 2</label>
                                <input type="text" class="form-control" id="edit_nombre2" name="nombre2">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="edit_apellido1" class="form-label">Apellido 1</label>
                                <input type="text" class="form-control" id="edit_apellido1" name="apellido1" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="edit_apellido2" class="form-label">Apellido 2</label>
                                <input type="text" class="form-control" id="edit_apellido2" name="apellido2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="edit_apellido_casada" class="form-label">Apellido de Casada</label>
                                <input type="text" class="form-control" id="edit_apellido_casada" name="apellido_casada">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="edit_dpi" class="form-label">DPI</label>
                                <input type="text" class="form-control" id="edit_dpi" name="dpi" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="edit_escolaridad" class="form-label">Escolaridad</label>
                                <input type="text" class="form-control" id="edit_escolaridad" name="escolaridad" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="edit_fecha_nacimiento" name="fecha_nacimiento" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_fecha_solicitud" class="form-label">Fecha de Solicitud</label>
                                <input type="date" class="form-control" id="edit_fecha_solicitud" name="fecha_solicitud" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="edit_muestra_tecnica" class="form-label">Muestra Técnica</label>
                                <select class="form-select" id="edit_muestra_tecnica" name="muestra_tecnica" required>
                                    <option value="aprobó">Aprobó</option>
                                    <option value="no aprobó">No Aprobó</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="edit_entrevista_jefe" class="form-label">Entrevista Jefe</label>
                                <select class="form-select" id="edit_entrevista_jefe" name="entrevista_jefe" required>
                                    <option value="✓">✓</option>
                                    <option value="x">X</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="edit_psicometria" class="form-label">Psicometría</label>
                                <select class="form-select" id="edit_psicometria" name="psicometria" required>
                                    <option value="✓">✓</option>
                                    <option value="x">X</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="edit_dias_prueba" class="form-label">Días Prueba</label>
                                <select class="form-select" id="edit_dias_prueba" name="dias_prueba" required>
                                    <option value="✓">✓</option>
                                    <option value="x">X</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="edit_referencias" class="form-label">Referencias</label>
                                <select class="form-select" id="edit_referencias" name="referencias" required>
                                    <option value="✓">✓</option>
                                    <option value="x">X</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="edit_poligrafo" class="form-label">Polígrafo</label>
                                <select class="form-select" id="edit_poligrafo" name="poligrafo" required>
                                    <option value="✓">✓</option>
                                    <option value="x">X</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_correo_electronico" class="form-label">Email</label>
                                <input type="email" class="form-control" id="edit_correo_electronico" name="correo_electronico" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_numero_telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="edit_numero_telefono" name="numero_telefono" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="edit_otra_fecha_aplico" class="form-label">Otra Fecha Aplicó</label>
                                <input type="text" class="form-control" id="edit_otra_fecha_aplico" name="otra_fecha_aplico">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="edit_plaza_aplico" class="form-label">Plaza Aplicó</label>
                                <input type="text" class="form-control" id="edit_plaza_aplico" name="plaza_aplico" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="edit_estado" class="form-label">Estado</label>
                                <select class="form-select" id="edit_estado" name="estado" required>
                                    <option value="Aplicable">Aplicable</option>
                                    <option value="No recomendable">No recomendable</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_observaciones" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="edit_observaciones" name="observaciones" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#userTable').DataTable
    <!-- Código del Modal se mantiene igual -->



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            // Iniciar DataTables con búsqueda activada
            $('#userTable').DataTable({
                "paging": true,
                "searching": true, // Habilitar búsqueda
                "ordering": true,
                "info": true
            });
        });
$(document).ready(function() {
    // Iniciar DataTables
    $('#userTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true
    });

    // Manejar el evento de clic en el botón de editar
    $(document).on('click', '.btn-edit', function() {
        var userInfo = $(this).data('info');
        $('#edit_id').val(userInfo.id);
        $('#edit_nombre').val(userInfo.nombre);
        $('#edit_nombre2').val(userInfo.nombre2);
        $('#edit_apellido1').val(userInfo.apellido1);
        $('#edit_apellido2').val(userInfo.apellido2);
        $('#edit_apellido_casada').val(userInfo.apellido_casada);
        $('#edit_dpi').val(userInfo.dpi);
        $('#edit_fecha_nacimiento').val(userInfo.fecha_nacimiento);
        $('#edit_fecha_solicitud').val(userInfo.fecha_solicitud);
        $('#edit_escolaridad').val(userInfo.escolaridad);
        $('#edit_muestra_tecnica').val(userInfo.muestra_tecnica);
        $('#edit_entrevista_jefe').val(userInfo.entrevista_jefe);
        $('#edit_psicometria').val(userInfo.psicometria);
        $('#edit_dias_prueba').val(userInfo.dias_prueba);
        $('#edit_referencias').val(userInfo.referencias);
        $('#edit_poligrafo').val(userInfo.poligrafo);
        $('#edit_correo_electronico').val(userInfo.correo_electronico);
        $('#edit_numero_telefono').val(userInfo.numero_telefono);
        $('#edit_plaza_aplico').val(userInfo.plaza_aplico);
        $('#edit_estado').val(userInfo.estado);
        $('#edit_observaciones').val(userInfo.observaciones);
    });

    // Manejar el evento de clic en el botón de guardar cambios
    $(document).on('click', '#saveChanges', function() {
        var formData = $('#editForm').serialize();
        $.ajax({
            type: 'POST',
            url: 'update-user.php',
            data: formData,
            success: function(response) {
                if (response.trim() === "success") {
                    alert("Guardado exitosamente");
                    location.reload(); // Recargar la página para ver los cambios
                } else {
                    alert("Error al guardar: " + response);
                }
            }
        });
    });

    // Manejar el evento de clic en el botón de eliminar
    $(document).on('click', '.btn-delete', function() {
        var userId = $(this).data('id');
        if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
            $.ajax({
                type: 'POST',
                url: 'view_users.php', // Asegúrate de que esta URL sea correcta
                data: { delete_user: true, user_id: userId },
                success: function(response) {
                    if (response.trim() === "success") {
                        alert("Registro eliminado exitosamente");
                        location.reload(); // Recargar la página para ver los cambios
                    } else {
                        alert("Error al eliminar: " + response);
                    }
                },
                error: function() {
                    alert("Error al eliminar el registro");
                }
            });
        }
    });
});
//NUEVO


    </script>
</body>
</html>
