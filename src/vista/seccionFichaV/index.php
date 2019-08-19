<?php
require 'src/vista/templates/header.php';
require_once 'src/vista/seccionFichaV/actualizar.php';
require_once 'src/vista/seccionFichaV/insertar.php';
require_once 'src/vista/seccionFichaV/eliminar.php';
 ?>

<br>



  <div class="row">
      <div class="col-sm-8" >
     
        <?php   
        if(isset($tiposSeccion)){
          foreach ($tiposSeccion as $ts) {
            echo "<input type='hidden' class='tiposSeccion' value='{$ts->id}'>
                  <input type='hidden' class='tiposSeccion' value='{$ts->tipoficha}'>";   
          }  
        }     
               
        ?>
        
        <div class="active-cyan-4 mb-4" style="width: 90%;margin-left:10%;" >
          <input class="form-control" type="text" placeholder="Buscar..." aria-label="Search" id="busqueda" name="busqueda" value="<?php if(isset($key)){echo $key;} ?>" ></div>
        </div>
      <div class="col-sm-4"> 
        <button type="button" class="btn btn-success insertarBtn" data-toggle='modal' data-target='#insertarSeccion'>Nuevo</button>
      </div>
    
    </div>
  </div>

 



<table class="table table-hover" style="width: 90%"  align="center" >
  <thead >
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tipo</th>
      <th scope="col">Nombre</th>
      <th scope="col">Acción</th>
    </tr>
  </thead>
  <tbody>

  <?php
        
        if (isset($secciones)) {
            foreach($secciones as $seccion){
              
              echo "<tr>
              <th scope='row'>{$seccion[0]}</th>
              <td>{$seccion[1]}</td>
              <td>{$seccion[2]}</td>
              <td style='display:none;'>{$seccion[4]}</td>
              <td><button type='button' class='btn btn-primary actualizarBtn'
              data-toggle='modal' data-target='#actualizarSeccion'>Actualizar</button>
              <button type='button' class='btn btn-danger eliminarBtn' 
              data-toggle='modal' data-target='#eliminarSeccion'>Eliminar</button></td>
              </tr>";
              

             }

        }
        
       
  ?>
    
    
  </tbody>
</table>


<?php
require 'src/vista/templates/footer.php';
 ?>

<script>
  $(document).ready(function(){
    $('.actualizarBtn').on('click',function(){
      $('#actualizarSeccion').modal('show');
        $tr_a = $(this).closest('tr');
        var contador_a=0;
        
        var datos_a1 = $tr_a.children("th").map(function(){
          
        
           return $(this).text();
        

        }).get();

        var datos_a2 = $tr_a.children("td").map(function(){
          contador_a++;
          if(contador_a<4){
           return $(this).text();
          }

        }).get();

        var datos_a =datos_a1.concat(datos_a2)

        console.log(datos_a);

        $('#nombreSeccion').val(datos_a[2]);
        $('#idSeccion').val(datos_a[0]);
        $('#listaTiposActualizar').val(datos_a[3]);
        
       
    });
  }
  );

  

$(document).ready(function(){
    $('.eliminarBtn').on('click',function(){
      $('#eliminarSeccion').modal('show');
        $tr_e = $(this).closest('tr');
        var contador_e=0;
        
        var datos_e1 = $tr_e.children("th").map(function(){
          
        
           return $(this).text();
        

        }).get();

        var datos_e2 = $tr_e.children("td").map(function(){
          contador_e++;
          if( contador_e<4){
           return $(this).text();
          }

        }).get();

        var datos_e =datos_e1.concat(datos_e2)

        console.log(datos_e);

        $('#nombreSeccionE').val(datos_e[2]);
        $('#idSeccionE').val(datos_e[0]);        
        $('#listaTiposEliminar').val(datos_e[3]);
        
    });
  }
  );




    var b = document.getElementById("busqueda");

    if (b){
        b.addEventListener("keydown", function (e) {
          if (String(b.value).trim() !="" && e.keyCode === 13) {  
            window.location.href = "<?php echo constant('URL'); ?>seccionFicha/buscar?key="+b.value;
            
          }
      });
    }
    


        var selIn = document.getElementById("listaTiposInsertar"); 
        var dimIn= document.getElementsByClassName("tiposSeccion").length; 
      
        

        for(var i = 0; i<=dimIn-2; i+=2) {
            var elIn = document.createElement("option");
            elIn.textContent = document.getElementsByClassName("tiposSeccion")[i+1].value;
            elIn.value = document.getElementsByClassName("tiposSeccion")[i].value;
            selIn.appendChild(elIn);
        }


    
        var selAc = document.getElementById("listaTiposActualizar"); 
        var dimAc= document.getElementsByClassName("tiposSeccion").length; 
      
        

        for(var j = 0; j<=dimAc-2; j+=2) {
            var elAc = document.createElement("option");
            elAc.textContent = document.getElementsByClassName("tiposSeccion")[j+1].value;
            elAc.value = document.getElementsByClassName("tiposSeccion")[j].value;
            selAc.appendChild(elAc);
        }


    
    var selEl = document.getElementById("listaTiposEliminar"); 
    var dimEl= document.getElementsByClassName("tiposSeccion").length; 
  
    

    for(var k = 0; k<=dimEl-2; k+=2) {
        var elEl = document.createElement("option");
        elEl.textContent = document.getElementsByClassName("tiposSeccion")[k+1].value;
        elEl.value = document.getElementsByClassName("tiposSeccion")[k].value;
        selEl.appendChild(elEl);
    }

</script>


