
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
<div style="width:95%; margin:10px; height:800px;">

<center><b>{{$empresa->nombre}}</b></center>
<center><b>{{$empresa->nit}}</b></center>
<center><b>COMPROBANTE DE EGRESO E INGRESO</b></center>
<center>{{$fecha}}</center>
<hr>
<b>DATOS DE LA EMPRESA</b><br><br>

<div style="height:100px;">
<div style="float:left; display:block;">
<table>
    <tr>
      <td>CAJA MAYOR: </td>
      <td>$ {{number_format($empresa->caja_mayor)}}</td>
    </tr>

    <tr>
      <td>CAJA MENOR: </td>
      <td>$ {{number_format($empresa->caja_menor)}}</td>
    </tr>

    <tr>
      <td>NOMBRES: </td>
      <td>$ {{number_format($empresa->banco)}}</td>
    </tr>
  
</table>
</div>

<div style="margin-left:80px; float:left; display:block;">
<table>
    <tr>
      <td>DIRECCIÓN: </td>
      <td> {{$empresa->direccion}}</td>
    </tr>

    <tr>
      <td>CIUDAD: </td>
      <td>{{$empresa->ciudad}}</td>
    </tr>

    <tr>
      <td>TELEFONO: </td>
      <td>{{$empresa->telefono}}</td>
    </tr>
   
</table>
 </div>
</div>


 <table   cellspacing=0 cellpadding=2 bordercolor="6666" class="tabla">
        <thead>
          <tr>
               <th><center>CÓDIGO</center></th>
                <th><CENTER>COMPROBANTE</CENTER></th>
                <th><CENTER>CAJA</CENTER></th>
                <th><center>TERCERO</center></th>
                <th><center>DETALLE</center></th>
                <th><center>FECHA</center></th>
                <th><center>DEBITO</center></th>
                <th><center>CREDITO</center></th>
          </tr>

        </thead>
        <hr>
          <tbody style="border:#fff;">
          <!-- {{$sum1 = 0 }}--> <!-- {{$sum2 = 0 }}-->
           @foreach($comprobante as $data)
           <!--{{$tercero = App\Terceros::find($data->tercero_id)}}-->
            <tr>  

                <td><center>{{$data->codigo}}</center></td>
                <td><center>{{$data->tipo_dato}}</center></td>
                <td><center>{{$data->caja}}</center></td>
                <td><center>{{$tercero->nombre}}</center></td>
                <td><center>{{$data->detalle}}</center></td>
                <td><center>{{$data->fecha}}</center></td>
                @if($data->tipo_dato == 'INGRESO')
                  <td><center>${{number_format($data->valor)}}</center></td>
                  <td><center>0</center></td>
                    <!-- {{$sum1 += $data->valor}} -->
                @else
                <td><center>0</center></td>
                <td><center>${{number_format($data->valor)}}</center></td>
                  <!-- {{$sum2 += $data->valor}} -->
                @endif
              
            </tr>
         
            @endforeach

    
          </tbody>
      </table>
<table>
  <tr>
    <td>TOTAL COMPRBANTES: </td>
    <td>{{count($comprobante)}}</td>
  </tr>

  <tr>
   <td> TOTAL COMPROBANTE DE INGRESO:</td>
   <td>$ {{number_format($sum1)}}</td>    
  </tr>

  <tr>
   <td> TOTAL COMPROBANTE DE EGRESO:</td>
   <td>$ {{number_format($sum2)}}</td>
  </tr>
</table>

</div>

