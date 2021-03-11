
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
<center><b>PRODUCTOS AL LIMITE DE AGOTAR</b></center>
<center>{{$fecha}}</center>

<hr>


<table cellspacing=0 cellpadding=2 bordercolor="6666" class="tabla">
                    <thead class=" text-primary">
          
                      <th><center>CÓDIGO</center></th>
                      <th><CENTER>PRODUCTO</CENTER></th>
                      <th><center>CANTIDAD ALMACEN</center></th>
                      <th><center>CANTIDAD BODEGA</center></th>
                      <th><center>CANTIDAD TOTAL</center></th>
                    </thead>
                    <tbody>
                    @foreach($inventario as $data)
                    <!--{{$producto = App\Producto::find($data->producto_id)}}-->
                      <tr>
                       
                        <td><center>{{$data->codigo}}</center></td>
                        <td><center>{{$producto->nombre}}</center></td>
                        <td><center>{{number_format($data->almacen)}}</center></td>
                        <td><center>{{number_format($data->bodega)}}</center></td>
                        <td><center>{{number_format($data->existencia)}}</center></td>

                     </tr>
                    @endforeach
                    </tbody>
    </table>
</div>

