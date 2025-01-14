$(document).ready(function () {
    // Iniciar DataTables
    $('#userTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true
    });

    // Manejar el evento de clic en el botón de editar
    $('.btn-edit').on('click', function () {
        var userId = $(this).data('id');
        // Redirigir a la página de edición con el ID del usuario como parámetro
        window.location.href = "editar_usuario.php?id=" + userId;
    });

    // Manejar el evento de clic en el botón de eliminar
    $('.btn-delete').on('click', function () {
        var userId = $(this).data('id');
        if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
            $.ajax({
                type: 'POST',
                url: 'usuarios.php',
                data: { delete_user: true, user_id: userId },
                success: function (response) {
                    alert("Usuario eliminado con éxito.");
                    location.reload(); // Recargar la página para ver los cambios
                },
                error: function () {
                    alert("Ocurrió un error al eliminar el usuario.");
                }
            });
        }
    });
});
