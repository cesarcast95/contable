
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
<div style="width:790px; margin:10px; height:800px;">

<center><b>{{$empresa->nombre}}</b></center>
<center><b>{{$empresa->nit}}</b></center>
<center><b>ESTADO DE RESULTADOS DESDE {{$fecha_1}} - {{$fecha_2}}</b></center>
<center>{{$fecha}}</center>
<hr>
<div style="height:80px;">
<div style="float:left; display:block;">
<table>
    <tr>
      <td><b>INGRESO TOTAL: </b></td>
      <td>$ {{number_format($suma_ventas + $suma_c_ingreso)}}</td>
    </tr>

    <tr>
      <td>INGRESOS: </td>
      <td>$ {{number_format($suma_ventas)}}</td>
    </tr>

    <tr>
      <td>OTROS INGRESOS: </td>
      <td>$ {{number_format($suma_c_ingreso)}}</td>
    </tr>
  
</table>
</div>

<div style="margin-left:80px; float:left; display:block;">
<table>

   <tr>
      <td><b>COSTOS DE VENTAS</b></td>
      <td></td>
    </tr>
    <tr>
      <td>COSTOS DE MERCANCIA VENDIDA:</td>
      <td>$ {{number_format($suma_p_u)}}</td>
    </tr>

   

</table>
 </div>
</div><hr>
<div style="height:24px;">
<div style="float:left; display:block;">

  <table>
    <tr>
      <td><b>UTILIDAD BRUTA EN VENTAS: </b></td>
      <td>$ {{number_format($suma_ventas)}}</td>
    </tr>
  </table>
  <hr>
  </div></div><hr>
<div style="height:80px;">
<div style="float:left; display:block;">
<table>
    <tr>
      <td><b>GASTOS</b></td>
      <td>$ {{number_format($suma_c_egreso + $suma_pagos + $suma_c_g)}}</td>
    </tr>

    <tr>
      <td>GASTOS OPERACIONALES DE ADMINISTRACIÓN:</td>
      <td>$ {{number_format($suma_c_g+$suma_c_egreso)}}</td>
    </tr>

    <tr>
      <td>GASTOS DE TRABAJADOR:</td>
      <td>$ {{number_format($suma_pagos)}}</td>
    </tr>
  
</table>
</div>
</div><hr>


<div style="height:40px;">
<div style="float:left; display:block;">
<table>
    <tr>
      <td><b>UTILIDAD ANTE IMPUESTOS</b></td>
      <td></td>
    </tr>

    <tr>
      <td>IMPUESTO POR VENTAS:</td>
      <td>$ {{number_format($suma_impuesto)}}</td>
    </tr>
  
</table>
</div>
</div><hr>

<div style="height:20px;">
<div style="float:left; display:block;">
<table>
    <tr>
      <td><b>UTILIDAD NETA</b></td>
      <td>$ {{number_format($utilidad)}}</td>
    </tr>
  
</table>
</div>
</div><hr>



</div>

