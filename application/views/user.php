<div class="content-wrapper">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-user-circle-o"></i>Nuevo usuario
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
                    <form method="post" action="<?=base_url()?>User/insert">
                        <div class="form-group row">
                            <label for="nombre" class="col-sm-1 col-form-label">nombre</label>
                            <div class="col-sm-2">
                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="nombre" required>
                            </div>
                            <label for="usuario" class="col-sm-1 col-form-label">usuario</label>
                            <div class="col-sm-2">
                                <input type="text" name="usuario" class="form-control" id="usuario" placeholder="usuario" required>
                            </div>
                            <label for="tipo" class="col-sm-1 col-form-label">tipo</label>
                            <div class="col-sm-2">
                                <select name="tipo" id="tipo" required class="form-control">
                                    <option value="">Selecionar..</option>
                                    <option value="ADMIN">ADMIN</option>
                                    <option value="RECARGA">RECARGA</option>
                                    <option value="COBRADOR">COBRADOR</option>
                                </select>
                            </div>
                            <label for="clave" class="col-sm-1 col-form-label">clave</label>
                            <div class="col-sm-2">
                                <input type="password" name="clave" class="form-control" id="clave" placeholder="clave">
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
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Tipo</th>
            <th>Estado</th>
            <th>opciones</th>
        </tr>
        </thead>
        <tbody>

            <?php
            $query=$this->db->query("SELECT * FROM usuario");
            foreach ($query->result() as $row){
                if ($row->estado=="ACTIVO"){
                    $c="success";
                }else{
                    $c="warning";
                }
                echo "<tr>
                        <td>$row->nombre</td>
                        <td>$row->usuario</td>
                        <td>$row->tipo</td>
                        <td><div class='badge badge-$c'>$row->estado</div></td>
                        <td>
                        <a href='".base_url()."User/delete/$row->idusuario' class='btn btn-danger btn-sm p-1 text-white eli'><i class='fa fa-trash'></i> Eliminar</a>
                        </td>
                      </tr>";
            }
            ?>

        </tbody>
    </table>
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
    }
</script>
