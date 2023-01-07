<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="col-sm-10"><br>
    <div class="text-center well" style="color: white;background: #337AB7;">
        <h2>Gestiones llamada</h2>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <nav class="float-right"><?php ?><a href="#" onclick="asignar_fecha()" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Agregar nueva gestion</a><?php ?><br><br></nav>
                <table class="table table-striped" id="mydata">
                    <thead>
                        <tr>  
                            <th>Origen llamada</th>
                            <th>Tipo llamada</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Gestion</th>     

                            <th>Acciones</th>      
                        </tr>
                    </thead>
                    <tbody id="show_data">
                        <?php foreach ($gestion as $ges) {
                                echo "<tr>";
                                echo "<td>".$ges->origen_llamada."</td>";
                                echo "<td>".$ges->tipo_llamada."</td>";
                                echo "<td>".$ges->nombre."</td>";
                                echo "<td>".$ges->telefono."</td>";
                                echo "<td>".$ges->gestion."</td>";

          
                                echo "<td>";
                                echo "<a class='btn btn-success' title='Editar gestion' onclick='editar(".$ges->id_gestion.")'><span class='glyphicon glyphicon-edit'></span></a>";
                
                                echo " <a class='btn btn-danger' onclick='eliminar(".$ges->id_gestion .")' title='Eliminar gestion'><span class='glyphicon glyphicon-trash'></span></a>";
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
            <h3 class="modal-title" id="exampleModalLabel">Agregar nueva gestion</h3>
            </div>
           <div class="modal-body">
	           	<div class="col-md-12">
				    <div id="validacion" style="color:red"></div>
				</div>

                <div class="form-group row">
                    <div class="col-md-12">
                      <label class="col-form-label">Tipo llamada:</label>
                      <select class="form-control" name="tipo" id="tipo" class="form-control">
                        <?php
                        foreach ($tipo_llamada as $tipo) {
                          echo "<option value=" . $tipo->id_tipo_llamada . ">" . $tipo->tipo_llamada . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-12">
                      <label class="col-form-label">Origen llamada:</label>
                      <select class="form-control" name="origen" id="origen" class="form-control">
                        <?php
                        foreach ($origen_llamada as $origen) {
                          echo "<option value=" . $origen->id_origen_llamada . ">" . $origen->origen_llamada . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                </div>

                 <div class="form-group row">
                    <div class="col-md-12">
                        <label class="col-form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre gestion">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="col-form-label">Telefono:</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono gestion">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="col-form-label">Gestion:</label>
                        <input required type="datetime-local" placeholder="Fecha y Hora" class="form-control" id="gestion">
                    </div>
                </div>

            </div>

            
            <div class="modal-footer">
	            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	            
	            <button type="button" id="btn_save" class="btn btn-primary" onclick="save_gestion();">
	            Guardar</button>

            </div>
            </div>
        </div>
        </div>
</form>
<!--END MODAL ADD-->

<!-- MODAL EDIT -->
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
                      <label class="col-form-label">Tipo llamada:</label>
                      <select class="form-control" name="tipo_edit" id="tipo_edit" class="form-control">
                        <?php
                        foreach ($tipo_llamada as $tipo) {
                          echo "<option value=" . $tipo->id_tipo_llamada . ">" . $tipo->tipo_llamada . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-12">
                      <label class="col-form-label">Origen llamada:</label>
                      <select class="form-control" name="origen_edit" id="origen_edit" class="form-control">
                        <?php
                        foreach ($origen_llamada as $origen) {
                          echo "<option value=" . $origen->id_origen_llamada . ">" . $origen->origen_llamada . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                </div>

                 <div class="form-group row">
                    <div class="col-md-12">
                        <label class="col-form-label">Nombre:</label>
                        <input type="text" name="nombre_edit" id="nombre_edit" class="form-control" placeholder="Nombre gestion">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="col-form-label">Telefono:</label>
                        <input type="text" name="telefono_edit" id="telefono_edit" class="form-control" placeholder="Telefono gestion">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="col-form-label">Gestion:</label>
                        <input required type="datetime-local" placeholder="Fecha y Hora" class="form-control" id="gestion_edit" name="gestion_edit">
                    </div>
                </div>

                </div>

            
            <div class="modal-footer">
	            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	            
	            <button type="button" id="btn_save" class="btn btn-primary" onclick="edit_gestion();">
	            Editar</button>

            </div>
            </div>
        </div>
        </div>
    </div>
</form>
<!--END MODAL EDIT-->

<!--MODAL DELETE-->
        <form>
        <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar gestion</h5>
               
                </div>
                <div class="modal-body">
                    <strong>¿Seguro que desea eliminar esta gestion?</strong>
                </div>
                <div class="modal-footer">
                <input type="hidden" name="code_gestion" id="code_gestion" class="form-control" readonly>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_delete" class="btn btn-primary" onclick="delete_gestion();">Aceptar</button>
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

    function asignar_fecha(){

        var hoy = new Date()
        var fecha = hoy.getFullYear() + '-' + ('0' + (hoy.getMonth() + 1)).slice(-2) + '-' + ('0' + hoy.getDate()).slice(-2) ;
        var hora = ('0' + hoy.getHours()).slice(-2) + ':' + ('0' + hoy.getMinutes()).slice(-2);

        var fecha_hora = fecha +'T'+ hora;
        document.getElementById('gestion').value = fecha_hora;

        document.getElementById('validacion').innerHTML = '';

    }


    //Funcion que se manda a llamar al darle click al boton guardar
    function save_gestion() {
        var tipo = $('#tipo').val();
        var origen = $('#origen').val();
        var nombre = $('#nombre').val();
        var telefono = $('#telefono').val();
        var gestion = $('#gestion').val();

        $.ajax({
            type : "POST",
            url  : "<?php echo site_url('Gestiones/guardar_gestion')?>",
            dataType : "JSON",
            
            data : {tipo:tipo,origen:origen, nombre:nombre, telefono:telefono, gestion:gestion},
            success: function(data){
                if(data == null){
                    document.getElementById('validacion').innerHTML = '';
                    $("#Modal_Add").modal('toggle');
                    Swal.fire(
                        'Ingreso!',
                        'Origen ingresado con exito!!',
                        'success'
                    ).then(() => { location.reload();});
                    //alert('Gestion ingresada con exito!!');
                    
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
            url  : "<?php echo site_url('Gestiones/get_datos')?>",
            dataType : "JSON",
            data : {code:code},
            success: function(data){
                //console.log(data);
                $('[name="id_edit"]').val(code);
                $('[name="tipo_edit"]').val(data[0].tipo_llamada_id);
                $('[name="origen_edit"]').val(data[0].origen_llamada_id);
                $('[name="nombre_edit"]').val(data[0].nombre);
                $('[name="telefono_edit"]').val(data[0].telefono);
                $('[name="gestion_edit"]').val(data[0].gestion);

                    
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
    function edit_gestion(){
        var code = $('#id_edit').val();
        var tipo_edit = $('#tipo_edit').val();
        var origen_edit = $('#origen_edit').val();
        var nombre_edit = $('#nombre_edit').val();
        var telefono_edit = $('#telefono_edit').val();
        var gestion_edit = $('#gestion_edit').val();

        $.ajax({
            type : "POST",
            url  : "<?php echo site_url('Gestiones/editar_gestion')?>",
            dataType : "JSON",
            
            data : {code:code,tipo_edit:tipo_edit, origen_edit:origen_edit, nombre_edit:nombre_edit, telefono_edit:telefono_edit, gestion_edit:gestion_edit},
            success: function(data){
                if(data == null){
                    document.getElementById('validacion_edit').innerHTML = '';
                    $("#Modal_Edit").modal('toggle');
                    Swal.fire(
                        'Editar!',
                        'Gestion se edito con exito!!',
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
        $('[name="code_gestion"]').val(code); 
        $('#Modal_Delete').modal('show');

    }

    function delete_gestion(){
        var code= $('#code_gestion').val();

        $.ajax({
            type : "POST",
            url  : "<?php echo site_url('Gestiones/eliminar_gestion')?>",
            dataType : "JSON",
           
            data : {code:code},
            success: function(data){

                $("#Modal_Delete").modal('toggle');
                Swal.fire(
                    'Eliminar!',
                    'Gestion se elimino con exito!!',
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
