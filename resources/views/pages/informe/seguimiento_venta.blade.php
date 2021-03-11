
<style type="text/css">
@page {
            margin-top: 0.2em;
            margin-left: 0.2em;
        }
  body {font-family: Arial, Helvetica, sans-serif; 
    padding: 0px; 
    margin:0px;
    font-family: Arial;
    font-family: courier;


  }
  .tabla{
    width:100%; border-left:#fff !important; border-right:#fff !important; 
  }


    p{
      font-size: 15px;
      text-align: justify;
       font-family: courier;
    }

    .color-oscuro{
      color:black;
    }
    
    .imprimir{
     display: block;
     float:right;
    }


</style>

<style type="text/css" media="print">
@media print {
 @page { margin-bottom: 0; }

 .boton{display:none;}

}
</style>

<div class="imprimir">
   <input type="button" value="Imprimir" class="boton" onclick="javascript:window.print()" />
</div>
<div style="width:80%; margin:10px; height:800px;">

<center><b>{{$empresa->nombre}}</b></center>
<center><b>{{$empresa->nit}}</b></center>
<center><b>ESTADO EMPRESA</b></center>
<center>{{$fecha}}</center>

<hr>

<center><b>VENTAS DESDE {{$fecha_1}} - {{$fecha_2}}</b></center> 
 <table   cellspacing=0 cellpadding=2 bordercolor="6666" class="tabla">
        <thead>
          <tr>
            <th>FECHA</th>
            <th>CONSECUTIVO</th>
            <th>TRANSACCION</th>
            <th>UBICACION</th>
            <th>CANTIDAD</th>
            <th>CLIENTE</th>
            <th>PRODUCTO</th>
            <th>VALOR</th>
            <th>CAJA</th>
            <th>CAJERO</th>
            
            
         
          </tr>

        </thead>
        <hr>
          <tbody style="border:#fff;">
          <!-- {{$sum = 0 }}-->
           @foreach($ventas as $dato)

            <tr>
              <td><center>{{$dato->fecha_elaboracion}}</center></td>
              <td><center>{{$dato->consecutivo}}</center></td>
              <td><center> {{$dato->tipo_transaccion_id}}</center></td>
              <td><center>{{ $dato->tipo_estado_id}}</center></td>
              <td><center>{{ $dato->cantidad}}</center></td>
              <td><center>{{ $dato->cliente_id}}</center></td>
              <td><center>{{ $dato->producto_id}}</center></td>
              <td><center>$ {{number_format($dato->total)}}</center></td>
              <td><center>{{ $dato->caja_tipo}}</center></td>
              <td><center>{{ $dato->cajero}}</center></td>
            </tr>
           <!-- {{$sum += $dato->total}} -->
            @endforeach

    
          </tbody>
      </table>
<table>

  <tr>
   <td> TOTAL:</td>
    <td>$ {{number_format($sum)}}</td>
    
  </tr>
</table>

</div>

