
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
<center><b>RECAUDO CARTERA</b></center>
<center>{{$fecha}}</center>
<hr>
<center><b>DATOS DE LA EMPRESA</b></center><hr>

<div style="height:80px;">
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
<hr>

</div>

