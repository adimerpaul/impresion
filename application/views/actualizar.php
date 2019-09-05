<div class="content-wrapper">
        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-user-circle-o"></i>Nuevo Estudiante
        </button>

<!--     Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?=base_url()?>Actualizar/insert" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="ci" class="col-sm-1 col-form-label">ci</label>
                            <div class="col-sm-2">
                                <input type="text" name="ci" class="form-control" "ci" placeholder="ci" required>
                            </div>
                            <label for="nombre" class="col-sm-1 col-form-label">nombre</label>
                            <div class="col-sm-2">
                                <input type="text" name="nombre" class="form-control" "nombre" placeholder="nombre" required>
                            </div>
                            <label for="celular" class="col-sm-1 col-form-label">celular</label>
                            <div class="col-sm-2">
                                <input type="text" name="celular" class="form-control" "celular" placeholder="celular" required>
                            </div>
                            <label for="correo" class="col-sm-1 col-form-label">correo</label>
                            <div class="col-sm-2">
                                <input type="text" name="correo" class="form-control" "correo" placeholder="correo" required>
                            </div>
                            <label for="carrera" class="col-sm-1 col-form-label">carrera</label>
                            <div class="col-sm-2">
                                <select name="carrera" "carrera" required class="form-control">
                                    <option value="">Selecionar..</option>
                                    <option value="INGENIERIA DE SISTEMAS">INGENIERIA DE SISTEMAS</option>
                                    <option value="INGENIERIA INFORMATICA">INGENIERIA INFORMATICA</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
                            </div>
                            <label for="sede" class="col-sm-1 col-form-label">sede</label>
                            <div class="col-sm-2">
                                <select name="sede" "sede" required class="form-control">
                                    <option value="">Selecionar..</option>
                                    <option value="UTO-ORURO">UTO-ORURO</option>
                                    <option value="UTO-CHALLAPATA-ORURO">UTO-CHALLAPATA-ORURO</option>
                                    <option value="UTO-HUANUNI-ORURO">UTO-HUANUNI-ORURO</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
                            </div>
                            <label for="foto" class="col-sm-1 col-form-label">foto</label>
                            <div class="col-sm-5">
                                <input type="file" name="foto" class="form-control" id="foto" placeholder="foto" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-trash-o"></i> Close</button>
                            <button type="submit" class="btn btn-success"> <i class="fa fa-plus"></i>Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table id="example" class="display responsive nowrap" style="width:100%;">
        <thead>
        <tr>
            <th>nombre</th>
            <th>celular</th>
            <th>correo</th>
            <th>carrera</th>
            <th>sede</th>
            <th>opciones</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $query=$this->db->query("SELECT * FROM estudiante");
        foreach ($query->result() as $row){
//            if ($row->estado=="ACTIVO"){
//                $c="success";
//            }else{
//                $c="warning";
//            }
            echo "<tr>
                        <td>$row->nombre</td>
                        <td>$row->celular</td>
                        <td>$row->correo</td>
                        <td>$row->carrera</td>
                        <td>$row->sede</td>
                        <td>
                        <button  data-toggle='modal' data-target='#ver' data-idestudiante='$row->idestudiante' class='btn btn-info btn-sm p-1 text-white'><i class='fa fa-eye'></i> Ver</button>
                        </td>
                      </tr>";
        }
        ?>

        </tbody>
    </table>
    <div class="modal fade" id="ver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ver</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?=base_url()?>Actualizar/update" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card" style="width: 18rem;">
                                <a id="url" href="" target="_blank"><img id="photo" src="" class="card-img-top" alt="..."></a>
                                <div class="card-body">
                                    <h5 class="card-title" id="name"></h5>
                                    <p class="card-text" id="carre"></p>
                                    <div class="row">
                                        <label for="foto" class="col-sm-3 col-form-label">foto</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="foto" class="form-control" id="foto" placeholder="foto" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9 p-3">
                            
                                <div class="form-group row">
                                    <label for="ciestudiante" class="col-sm-2 col-form-label">ciestudiante</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="idestudiante" name="id" hidden>
                                        <input type="text" name="ci" class="form-control" id="ciestudiante" placeholder="ciestudiante" required>
                                    </div>
                                    <label for="nombre" class="col-sm-2 col-form-label">nombre</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="nombre" required>
                                    </div>
                                    <label for="celular" class="col-sm-2 col-form-label">celular</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="celular" class="form-control" id="celular" placeholder="celular" required>
                                    </div>
                                    <label for="correo" class="col-sm-2 col-form-label">correo</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="correo" class="form-control" id="correo" placeholder="correo" required>
                                    </div>
                                    <label for="carrera" class="col-sm-2 col-form-label">carrera</label>
                                    <div class="col-sm-4">
                                        <select name="carrera" id="carrera" required class="form-control">
                                            <option value="">Selecionar..</option>
                                            <option value="INGENIERIA DE SISTEMAS">INGENIERIA DE SISTEMAS</option>
                                            <option value="INGENIERIA INFORMATICA">INGENIERIA INFORMATICA</option>
                                            <option value="OTROS">OTROS</option>
                                        </select>
                                    </div>
                                    <label for="sede" class="col-sm-2 col-form-label">sede</label>
                                    <div class="col-sm-4">
                                        <select name="sede" id="sede" required class="form-control">
                                            <option value="">Selecionar..</option>
                                            <option value="UTO-ORURO">UTO-ORURO</option>
                                            <option value="UTO-HUANUNI-ORURO">UTO-HUANUNI-ORURO</option>
                                            <option value="UTO-CHALLAPATA-ORURO">UTO-CHALLAPATA-ORURO</option>
                                            <option value="OTROS">OTROS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-warning"> <i class="fa fa-pencil"></i>Modificar datos estudiante</button>
                                </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-trash-o"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script >
    window.onload=function (e) {
        $('#example').DataTable( {
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        } );
        $('.eli').click(function (e) {
            if (!confirm("Seguro de eliminar?")){
                e.preventDefault();
            }
        });
        var id;
        $('#ver').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            id = button.data('idestudiante');
            $('#idestudiante').val(id);
            $.ajax({
                url:'Student/Ver/'+id,
                success:function(e) {
                    var dato=JSON.parse(e)[0];
                    $('#ciestudiante').val(dato.ciestudiante);
                    $('#nombre').val(dato.nombre);
                    $('#celular').val(dato.celular);
                    $('#correo').val(dato.correo);
                    $('#carrera').val(dato.carrera);
                    $('#sede').val(dato.sede);
                    $('#name').html(dato.nombre);
                    $('#carre').html("Carrera:"+dato.sede);
                    $('#photo').prop('src',window.location+'/../fotos/'+dato.ciestudiante+'.jpg');
                    $('#url').prop('href',window.location+'/../fotos/'+dato.ciestudiante+'.jpg');
                    $('#targeta').focus();
                    $('#targeta').val('');
                }
            })
        })


    }
</script>
