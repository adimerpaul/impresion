<div class="content-wrapper">
    <table id="example" class="display responsive nowrap" style="width:100%;">
        <thead>
        <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>configuracion</th>
            <th>opciones</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $query=$this->db->query("SELECT * FROM configuracion");
        foreach ($query->result() as $row){

            echo "<tr>
                        <td>$row->idconfiguracion</td>
                        <td>$row->nombre</td>
                        <td>$row->estado</td>
                        <td>
                        <button data-toggle='modal' data-target='#exampleModal' data-id='$row->idconfiguracion' data-whatever='$row->estado' class='btn btn-warning btn-sm p-1 text-white eli'><i class='fa fa-pencil-square'></i> Modificar</button>
                        </td>
                      </tr>";
        }
        ?>

        </tbody>
    </table>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?=base_url()?>Configuration/update">
                        <div class="form-group">
                            <input type="text" value="" id="idconfiguracion" name="idconfiguracion" hidden>
                            <label for="recipient-name" class="col-form-label">Monto:</label>
                            <input type="text" class="form-control" id="recipient-name" name="estado">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send message</button>
                        </div>
                    </form>
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
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever')
            var id = button.data('id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
            $('#idconfiguracion').val(id);
        })
    }
</script>
