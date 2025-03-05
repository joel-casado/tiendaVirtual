$(document).ready(function(){
    $('.btn-editar').click(function(){
        var productoId = $(this).data('id');
        // Rellenar el formulario del modal con datos de la fila
        var precio = $(this).closest('tr').find('td:eq(4)').text().trim();
        var stock = $(this).closest('tr').find('td:eq(5)').text().trim();

        $('#producto-id').val(productoId);
        $('#producto-precio').val(precio);
        $('#producto-stock').val(stock);

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
