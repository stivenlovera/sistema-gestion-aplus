$(document).on("click", "#new", function () {
    $("#cotizacion").modal("show");
    $('#cotizacion .modal-title').text('Nueva Cotizacion');
    $('#save').removeClass('store update');
    $('#save').addClass('store');
});
/*
 * tabla items
*/
$(document).on("click", "#añadir_item", function () {
    HTMLItem = `
    <tr>
        <td>
            <input class="form-control" name="item_id[]" type="text" value="" hidden>
            <input class="form-control" name="item_nombre[]" type="text" value="">
        </td>
        <td>
            <input class="form-control" name="item_codigo[]" type="text" value="">
        </td>
        <td>
            <input class="form-control" name="item_descripcion[]" type="text" value="">
        </td>
        <td>
            <input class="form-control" name="item_cantidad[]" type="number" value="">
        </td>
        <td>
            <input class="form-control" name="item_precio_unitario[]" type="number" value="">
        </td>
        <td>
            <input class="form-control" name="item_precio_total[]" type="number" value="">
        </td>
        <td>
            <button class="btn btn-pill btn-danger d-block eliminar_item"
                type="button"><i
                    class="fas fa-trash"></i></button>
        </td>
    </tr>`;
    $('#items').append(HTMLItem);

});
$(document).on("click", ".eliminar_item", function () {
    $(this).parent().parent().remove();
});

$('.select2').select2()