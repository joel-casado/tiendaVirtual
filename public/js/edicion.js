$(document).ready(function(){
    $('.btn-editar').click(function(){
        var productoId = $(this).data('id');

        // Obtener los valores de la fila correspondiente:
        var precio = $(this).closest('tr').find('td:eq(4)').text().trim();
        var stock = $(this).closest('tr').find('td:eq(5)').text().trim();
        var destacadoText = $(this).closest('tr').find('td:eq(6)').text().trim();

        // Rellenar el formulario del modal:
        $('#producto-id').val(productoId);
        $('#producto-precio').val(precio);
        $('#producto-stock').val(stock);
        // Si el texto es "Sí", asigna valor "1"; si es "No", asigna "0"
        $('#producto-destacado').val( destacadoText === "Sí" ? "1" : "0" );

        // Mostrar el modal
        $('#modal-editar').show();
    });

    $('#cerrar-modal').click(function(){
        $('#modal-editar').hide();
    });

    $('#form-editar').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert('Producto actualizado correctamente');
                location.reload();
            },
            error: function(error) {
                alert('Error al actualizar el producto');
            }
        });
    });
});
