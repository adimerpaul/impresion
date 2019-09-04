<div class="content-wrapper">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-user-circle-o"></i>Registrar targetas
    </button>

    <!-- Modal -->
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
                    <div class="row">
                        <div class="col-sm-4">
                            <form method="post" id="insetartargetas">
                                <div class="form-group row">
                                    <label for="targeta" class="col-sm-6 col-form-label">targeta</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="targeta" class="form-control" id="targeta" placeholder="targeta" required>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6">
                            <form method="post" action="<?=base_url()?>Targetas/insert">
                                <div class="form-group row">

                                    <div class="col-sm-8">
                                        <h4>Targetas</h4>
                                        <div id="contenedor">

                                        </div>
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
        </div>
    </div>
    <table id="example" class="display responsive nowrap" style="width:100%;">
        <thead>
        <tr>
            <th>idtargeta</th>
            <th>numero</th>
            <th>fecha</th>
            <th>Estado</th>
            <th>opciones</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $query=$this->db->query("SELECT * FROM targeta");
        foreach ($query->result() as $row){
            if ($row->estado=="CREADO"){
                $c="success";
            }else{
                $c="warning";
            }
            echo "<tr>
                        <td>$row->idtargeta</td>
                        <td>$row->numero</td>
                        <td>$row->fecha</td>
                        <td><div class='badge badge-$c'>$row->estado</div></td>
                        <td>
                        <a href='".base_url()."Targetas/delete/$row->idtargeta' class='btn btn-danger btn-sm p-1 text-white eli'><i class='fa fa-trash'></i> Eliminar</a>
                        </td>
                      </tr>";
        }
        ?>

        </tbody>
    </table>
</div>
<script >
    window.onload=function (e) {
        var c=0;
        $('#insetartargetas').submit(function (e) {
            $.ajax({
               url:'Targetas/verificar/'+$('#targeta').val(),
                success:function (e) {
                   console.log(e);
                   if (e=='1'){
                       toastr.error('La targeta ya existe!!');
                   }else{
                     $('#contenedor').append('<div class="tar"> <b>'+$('#targeta').val()+'</b> <button type="button" class="btn btn-danger p-1"> <i class="fa fa-trash"></i></button> <input hidden name="t'+c+'" value="'+$('#targeta').val()+'"></div> ');
                       c++;
                   }
                   $('#targeta').val('');
                    $('#targeta').focus();

                }
            });

            $('.tar').click(function (e) {
                if (confirm('seguro de eliminar?'))
                $(this).remove();
            });

            return false;
        });
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

    }
</script>
