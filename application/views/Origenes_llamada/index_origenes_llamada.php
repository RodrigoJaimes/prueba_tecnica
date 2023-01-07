<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="col-sm-10"><br>
    <div class="text-center well" style="color: white;background: #337AB7;">
        <h2>Origenes llamada</h2>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <nav class="float-right"><?php ?><a href="#" onclick="Limpiar()" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Agregar nuevo origen</a><?php ?><br><br></nav>
                <table class="table table-striped" id="mydata">
                    <thead>
                        <tr>  
                            <th>Origen llamada</th>
                            <th>Fecha ingreso</th>      

                            <th>Acciones</th>      
                        </tr>
                    </thead>
                    <tbody id="show_data">
                        <?php foreach ($origen_llamada as $org) {
                                echo "<tr>";
                                echo "<td>".$org->origen_llamada."</td>";
                                echo "<td>".$org->fecha_ingreso."</td>";
          
                                echo "<td>";
                                echo "<a class='btn btn-success' title='Editar origen' onclick='editar(".$org->id_origen_llamada.")'><span class='glyphicon glyphicon-edit'></span></a>";
                
                                echo " <a class='btn btn-danger' onclick='eliminar(".$org->id_origen_llamada .")' title='Eliminar origen'><span class='glyphicon glyphicon-trash'></span></a>";
                                echo "</td>";
                                echo "</tr>";

                            }
                        ?>
                    </tbody>
                </table>
            </div>
       	</div>
    </div>
</div>

<!-- MODAL ADD -->
<form id="frmDepto">
    <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Agregar nuevo origen</h3>
            </div>
           <div class="modal-body">
	           	<div class="col-md-12">
				    <div id="validacion" style="color:red"></div>
				</div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="col-form-label">Origen llamada:</label>
                        <input type="text" name="origen" id="origen" class="form-control" placeholder="Origen de la llamada">
                    </div>
                </div>

            </div>

            
            <div class="modal-footer">
	            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	            
	            <button type="button" id="btn_save" class="btn btn-primary" onclick="save_origen();">
	            Guardar</button>

            </div>
            </div>
        </div>
        </div>
</form>
<!--END MODAL ADD-->

<!-- MODAL ADD -->
<form id="frmDepto">
    <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Editar origen llamada</h3>
      
            </div>
           <div class="modal-body">
	           	<div class="col-md-12">
				    <div id="validacion_edit" style="color:red"></div>
                    <input type="hidden" name="id_edit" id="id_edit" class="form-control">
				</div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="col-form-label">Origen llamada:</label>
                        <input type="text" name="origen_edit" id="origen_edit" class="form-control" placeholder="Origen de la llamada">
                    </div>
                </div>

                </div>

            
            <div class="modal-footer">
	            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	            
	            <button type="button" id="btn_save" class="btn btn-primary" onclick="edit_origen();">
	            Editar</button>

            </div>
            </div>
        </div>
        </div>
    </div>
</form>
<!--END MODAL ADD-->

<!--MODAL DELETE-->
        <form>
        <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar origen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <strong>¿Seguro que desea eliminar este origen?</strong>
                </div>
                <div class="modal-footer">
                <input type="hidden" name="code_origen" id="code_origen" class="form-control" readonly>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_delete" class="btn btn-primary" onclick="delete_origen();">Aceptar</button>
                </div>
            </div>
            </div>
        </div>
        </form>
        <!--END MODAL DELETE-->


<script type="text/javascript">
    $('#mydata').dataTable({
        "bAutoWidth": false,
        "oLanguage": {
            "sSearch": "Buscador: "
        }
    });

    function Limpiar() {
        document.getElementById('validacion').innerHTML = '';
    }


    //Funcion que se manda a llamar al darle click al boton guardar
    function save_origen() {
        var origen = $('#origen').val();

        $.ajax({
            type : "POST",
            url  : "<?php echo site_url('Origenes/guardar_origen')?>",
            dataType : "JSON",
            
            data : {origen:origen},
            success: function(data){
                if(data == null){
                    document.getElementById('validacion').innerHTML = '';
                    $("#Modal_Add").modal('toggle');
                    Swal.fire(
                        'Ingreso!',
                        'Origen ingresado con exito!!',
                        'success'
                    ).then(() => { location.reload();});
                    //alert('Origen ingresada con exito!!');
                    
                }else{
                    document.getElementById('validacion').innerHTML = data;
                }
            },  
        error: function(data){
            var a =JSON.stringify(data['responseText']);
            alert(a);
            this.disabled=false;
            }

        });
        
    }


    function editar(code){
        document.getElementById('validacion_edit').innerHTML = '';

        $.ajax({
            type : "POST",
            url  : "<?php echo site_url('Origenes/get_datos')?>",
            dataType : "JSON",
            data : {code:code},
            success: function(data){
                console.log(data);
                $('[name="id_edit"]').val(code);
                $('[name="origen_edit"]').val(data[0].origen_llamada);
             
                    
                $('#Modal_Edit').modal('show');

            },  
            error: function(data){
                var a =JSON.stringify(data['responseText']);
                alert(a);
                this.disabled=false;
            }
        });
    }

    //Funcion para editar origen
    function edit_origen(){
        var id_edit = $('#id_edit').val();
        var origen_edit = $('#origen_edit').val();
    
        $.ajax({
            type : "POST",
            url  : "<?php echo site_url('Origenes/editar_origen')?>",
            dataType : "JSON",
            
            data : {id_edit:id_edit,origen_edit:origen_edit},
            success: function(data){
                if(data == null){
                    document.getElementById('validacion_edit').innerHTML = '';
                    $("#Modal_Edit").modal('toggle');
                    Swal.fire(
                        'Editar!',
                        'Origen se edito con exito!!',
                        'success'
                    )
                    .then(() => { location.reload();});
                   
                }else{
                    document.getElementById('validacion_edit').innerHTML = data;
                }
            },  
        error: function(data){
            var a =JSON.stringify(data['responseText']);
            alert(a);
            this.disabled=false;
            }

        });
    }

    function eliminar(code){
        $('[name="code_origen"]').val(code); 
        $('#Modal_Delete').modal('show');

    }

    function delete_origen(){
        var code= $('#code_origen').val();

        $.ajax({
            type : "POST",
            url  : "<?php echo site_url('Origenes/eliminar_origen')?>",
            dataType : "JSON",
           
            data : {code:code},
            success: function(data){

                $("#Modal_Delete").modal('toggle');
                Swal.fire(
                    'Eliminar!',
                    'Origen se elimino con exito!!',
                    'success'
                )
                .then(() => { location.reload();});
                   
                
            },  
        error: function(data){
            var a =JSON.stringify(data['responseText']);
            alert(a);
            this.disabled=false;
            }

        });
    }

</script>
