@if (session("message"))
{{-- data-auto-dismiss="5000" -> se borra el mensaje automáticamente en 5 segundos --}}
<div class="alert alert-info alert-dismissible" data-auto-dismiss="3000">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="nc-icon nc-check-2"></i>Mensaje sistema Contabilidad</h4>
    <ul>
              <li>{{ session("message") }}</li>
    </ul>
  </div>
@endif


@if (isset($message))

<div class="alert alert-info alert-dismissible" data-auto-dismiss="3000">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="nc-icon nc-check-2"></i> Mensaje sistema Contabilidad</h4>
    <ul>
              <li>{{$message}}</li>
    </ul>
  </div>
@endif