class ProductoEditor {
    constructor() {
        this.init();
    }

    init() {
        this.bindEditButtons();
        this.bindCloseModal();
        this.bindFormSubmit();
    }

    bindEditButtons() {
        $('.btn-editar').on('click', (e) => {
            const $btn = $(e.currentTarget);
            const productoId = $btn.data('id');
            const $row = $btn.closest('tr');
            const precio = $row.find('td:eq(4)').text().trim();
            const stock = $row.find('td:eq(5)').text().trim();
            const destacadoText = $row.find('td:eq(6)').text().trim();

            $('#producto-id').val(productoId);
            $('#producto-precio').val(precio);
            $('#producto-stock').val(stock);
            $('#producto-destacado').val(destacadoText === "Sí" ? "1" : "0");

            $('#modal-editar').show();
        });
    }

    bindCloseModal() {
        $('#cerrar-modal').on('click', () => {
            $('#modal-editar').hide();
        });
    }

    bindFormSubmit() {
        $('#form-editar').on('submit', (e) => {
            e.preventDefault();
            $.ajax({
                url: $('#form-editar').attr('action'),
                method: 'POST',
                data: $('#form-editar').serialize(),
                success: () => {
                    alert('Producto actualizado correctamente');
                    location.reload();
                },
                error: () => {
                    alert('Error al actualizar el producto');
                }
            });
        });
    }
}

$(document).ready(function() {
    new ProductoEditor();
});
