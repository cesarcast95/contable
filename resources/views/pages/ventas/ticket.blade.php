
<style type="text/css" media="print">
 .imprimir{
     display: block;
     float:right;
    }

@media print {
 @page { margin-bottom: 0; }

 .boton{display:none;}

}
</style>

<div class="imprimir">
   <input type="button" value="Imprimir" class="boton" onclick="javascript:window.print()" />
   <a href="{{route('ventas.create')}}" class="boton">volver</a>
</div>


<div  width="200" height="300">
 <!-- {{$sum = 0 }}-->
<pre>     
         {{$empresa->nombre}}
  {{$empresa->direccion}} - {{$empresa->ciudad}} 
      NIT: {{$empresa->nit}}
    {{$fecha}}
 -----------------------------
     DATOS DE FACTURA
 -----------------------------
 CAJERO:   {{$factura->cajero}}          
 RECIBO:   {{$factura->consecutivo}}
 FECHA:    {{$factura->fecha_elaboracion}}
-----------------------------
     DATOS DEL CLIENTE
-----------------------------
 CEDULA:   {{$cliente->cedula}}
 NOMBRE:   {{$cliente->nombre}}
 CÓDIGO:   {{$cliente->id}}
 ------------------------------
 PRODUCTO  CANTIDAD  TOTAL   
 ------------------------------
 @foreach($facturas as $dato)
<!-- {{$producto = App\Producto::find($dato->producto_id)}}-->{{$producto->nombre}}     {{$dato->cantidad}}      ${{number_format($dato->total)}}<!-- {{$sum += $dato->total}} -->
 @endforeach
 ----------------------------
 TOTAL: $ {{number_format($sum)}}

</pre>

</div>  