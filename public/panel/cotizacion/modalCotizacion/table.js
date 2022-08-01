/*
 * tabla items
*/
$(document).on("click", "#añadir_item", function () {
    HTMLItem = `
    <tr>
        <td>
            <input class="form-control" name="item_id[]" type="text" value="" hidden>
            <input class="form-control" name="item_numero[]" type="text" value="" readonly>
        </td>
        <td>
            <input class="form-control" name="item_codigo[]" type="text" value="">
        </td>
        <td>
            <input class="form-control" name="item_descripcion[]" type="text" value="">
        </td>
        <td>
            <input class="form-control item_cantidad" name="item_cantidad[]" type="number" value="" >
        </td>
        <td  style="background-color: #f1fdea">
            <input class="form-control item_utilidad" name="item_utilidad[]" type="number" value="" >
        </td>
        <td  style="background-color: #f1fdea">
            <input class="form-control item_precio_unitario_compra" name="item_precio_unitario_compra[]" type="number" value="" >
        </td>
        <td  style="background-color: #f1fdea">
            <input class="form-control" name="item_precio_total_compra[]" type="number" value="" readonly >
        </td>
        <td>
            <input class="form-control" name="item_precio_unitario[]" type="number" value="" readonly >
        </td>
        <td>
            <input class="form-control" name="item_precio_total[]" type="number" value="" readonly >
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
    calculo_total();
    porcentajes();
});

$(document).on("keyup", ".item_cantidad", function () {
    var cantidad = $(this).val();
    var utilidad = $($(this).parent().next().children()[0]).val();
    var precio_compra = parseInt($($(this).parent().next().next().children()[0]).val());

    const resultado = calculo_precio(cantidad, utilidad, precio_compra)

    var input_precio_total_compra = $($(this).parent().next().next().next().children()[0]);
    input_precio_total_compra.val(resultado.input_precio_total_compra)

    var input_precio_unitario = $($(this).parent().next().next().next().next().children()[0]);
    input_precio_unitario.val(resultado.input_precio_unitario)

    var input_precio_total = $($(this).parent().next().next().next().next().next().children()[0]);
    input_precio_total.val(resultado.input_precio_total);

    calculo_total();
    porcentajes();
});
$(document).on("keyup", ".item_utilidad", function () {
    var cantidad = $($(this).parent().prev().children()[0]).val();
    var utilidad = $(this).val();
    var precio_compra = parseInt($($(this).parent().next().children()[0]).val());

    const resultado = calculo_precio(cantidad, utilidad, precio_compra)

    var input_precio_total_compra = $($(this).parent().next().next().children()[0]);
    input_precio_total_compra.val(resultado.input_precio_total_compra)

    var input_precio_unitario = $($(this).parent().next().next().next().children()[0]);
    input_precio_unitario.val(resultado.input_precio_unitario)

    var input_precio_total = $($(this).parent().next().next().next().next().children()[0]);
    input_precio_total.val(resultado.input_precio_total);

    calculo_total();
    porcentajes();
});
$(document).on("keyup", ".item_precio_unitario_compra", function () {
    var cantidad = $($(this).parent().prev().prev().children()[0]).val();
    var utilidad = $($(this).parent().prev().children()[0]).val();
    var precio_compra = $(this).val();

    const resultado = calculo_precio(cantidad, utilidad, precio_compra)

    var input_precio_total_compra = $($(this).parent().next().children()[0]);
    input_precio_total_compra.val(resultado.input_precio_total_compra)

    var input_precio_unitario = $($(this).parent().next().next().children()[0]);
    input_precio_unitario.val(resultado.input_precio_unitario)

    var input_precio_total = $($(this).parent().next().next().next().children()[0]);
    input_precio_total.val(resultado.input_precio_total);

    calculo_total();
    porcentajes();
});
function calculo_precio(cantidad, utilidad, precio_compra) {
    cantidad = parseInt(cantidad);
    utilidad = parseInt(utilidad);
    precio_compra = parseFloat(precio_compra);
    utilidad = (utilidad / 100);//parce porcentaje
    var calculo = (precio_compra * utilidad) + precio_compra;

    input_precio_total_compra = (cantidad * precio_compra).toFixed(2)
    input_precio_unitario = (calculo).toFixed(2);
    input_precio_total = (cantidad * calculo).toFixed(2);
    return {
        input_precio_total_compra,
        input_precio_unitario,
        input_precio_total
    }
}
function calculo_total() {
    var total_precio = 0;
    var total_compra = 0;
    var items = 1;
    $('#items').children().each(
        (i, campos) => {
            $(campos).children().each(
                (index, item) => {
                    //console.log(item)
                    switch (index) {
                        case 0:
                            $($(item).children()[1]).val(i + items);
                            break;
                        case 8:
                            //console.log($(item).children()[0])
                            const precio_total = parseFloat($($(item).children()[0]).val());
                            total_precio += precio_total;
                            break;
                        case 6:
                            //console.log($(item).children()[0])
                            const compra_total = parseFloat($($(item).children()[0]).val());
                            total_compra += compra_total;
                            break;
                        default:
                            break;
                    }
                }
            )
        }
    )
    $('#total').val(total_precio);
    $('#total_costo').val(total_compra);
}
function porcentajes() {
    var porcenataje_a = 0.13;
    var porcenataje_b = 0.03;
    var porcenataje_c = 0.015;
    /* input */
    var total = parseFloat($('#total').val());
    var total_costo = parseFloat($('#total_costo').val());

    $('#porcentaje_a').val(((total - total_costo) * porcenataje_a).toFixed(2));
    $('#porcentaje_b').val((total * porcenataje_b).toFixed(2));
    $('#porcentaje_c').val((total * porcenataje_c).toFixed(2));
    $('#utilidades').val((total - total_costo - parseFloat($('#porcentaje_a').val()) - parseFloat($('#porcentaje_b').val()) - parseFloat($('#porcentaje_c').val())).toFixed(2));
}