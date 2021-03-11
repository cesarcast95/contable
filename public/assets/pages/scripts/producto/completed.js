$('#ganancia_id').on('change', function () {
// ganancia_activada
    var data = {
        ganancia_attr: $(this).attr('data-id'),
        ganancia_id: $(this).val(),
        _token: $('input[name=_token]').val()
    };

    if ($(this).is(':checked')) {
        data.estado = 1
    } else {
        data.estado = 0
    }
    ajaxRequest('/productos/complete_ganancia', data);
});
$('#descuento_id').on('change', function () {
    // descuento_activado
        var data = {
            descuento_attr: $(this).attr('data-id'),
            descuento_id: $(this).val(),
            _token: $('input[name=_token]').val()
        };
    
        if ($(this).is(':checked')) {
            data.estado = 1
        } else {
            data.estado = 0
        }
        ajaxRequest('/productos/complete_descuento', data);
    });

$('#promocion_id').on('change', function () {
    // descuento_activado
        var data = {
            promocion_attr: $(this).attr('data-id'),
            promocion_id: $(this).val(),
            _token: $('input[name=_token]').val()
        };
    
        if ($(this).is(':checked')) {
            data.estado = 1
        } else {
            data.estado = 0
        }
        ajaxRequest('/productos/complete_promocion', data);
    });

function ajaxRequest (url, data) {
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function (respuesta) {
            console.log(respuesta);
            Contable.notificaciones(respuesta.respuesta, 'Contable', 'success');
        }
    });
}
