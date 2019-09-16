<div class="content-wrapper">
    <!-- Button trigger modal -->
<!--    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModal">-->
<!--        <i class="fa fa-user-circle-o"></i>Nuevo Estudiante-->
<!--    </button>-->

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
                            <label for="nombre2" class="col-sm-1 col-form-label">nombre2</label>
                            <div class="col-sm-2">
                                <input type="text" name="nombre2" class="form-control" id="nombre2" placeholder="nombre2" required>
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
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="card" style="width: 18rem;">
                                    <img id="photo" src="" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title" id="name"></h5>
                                        <p class="card-text" id="carre"></p>
                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9 p-3">
                                <form method="post" action="<?=base_url()?>User/update">
                                <div class="form-group row">
                                    <label for="ciestudiante"  class="col-sm-2 col-form-label">ciestudiante</label>
                                    <div class="col-sm-4">
                                        <input type="text" disabled name="ciestudiante" class="form-control" id="ciestudiante" placeholder="ciestudiante" required>
                                    </div>
                                    <label for="nombre" class="col-sm-2 col-form-label">nombre</label>
                                    <div class="col-sm-4">
                                        <input type="text" disabled name="nombre" class="form-control" id="nombre" placeholder="nombre" required>
                                    </div>
                                    <label for="celular" class="col-sm-2 col-form-label">celular</label>
                                    <div class="col-sm-4">
                                        <input type="text" disabled name="celular" class="form-control" id="celular" placeholder="celular" required>
                                    </div>
                                    <label for="correo" class="col-sm-2 col-form-label">correo</label>
                                    <div class="col-sm-4">
                                        <input type="text" disabled name="correo" class="form-control" id="correo" placeholder="correo" required>
                                    </div>
                                    <label for="carrera" class="col-sm-2 col-form-label">carrera</label>
                                    <div class="col-sm-4">
                                        <select name="carrera" disabled id="carrera" required class="form-control">
                                            <option value="">Selecionar..</option>
                                            <option value="INGENIERIA DE SISTEMAS">INGENIERIA DE SISTEMAS</option>
                                            <option value="INGENIERIA INFORMATICA">INGENIERIA INFORMATICA</option>
                                        </select>
                                    </div>
                                    <label for="sede" class="col-sm-2 col-form-label">sede</label>
                                    <div class="col-sm-4">
                                        <select name="sede" disabled id="sede" required class="form-control">
                                            <option value="">Selecionar..</option>
                                            <option value="UTO-ORURO">UTO-ORURO</option>
                                            <option value="UTO-HUANUNI-ORURO">UTO-HUANUNI-ORURO</option>
                                            <option value="UTO-CHALLAPATA-ORURO">UTO-CHALLAPATA-ORURO</option>
                                        </select>
                                    </div>
                                </div>

                                </form>
                                <div class="row p-3">
                                    <form class="form-inline" method="post" id="insertartargeta">
                                        <label for="targeta" class="col-sm-2 col-form-label">Targeta</label>
                                        <div class="col-sm-5">
                                            <input type="password" name="correo"  class="form-control" id="targeta" placeholder="Numero de targeta" required>
                                        </div>
                                        <div class="col-sm-5">
                                            <button type="submit" class="btn btn-primary p-1"> <i class="fa fa-credit-card-alt"></i> Agregar Targeta</button>
                                        </div>

                                    </form>
                                    <table class="table">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">id</th>
                                            <th scope="col">Fecha  de compra</th>
                                            <th scope="col">Saldo</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tar">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
            $.ajax({
                url:'Student/Ver/'+id,
                success:function(e) {
                   var dato=JSON.parse(e)[0];
                   $('#ciestudiante').val(dato.ciestudiante);
                   $('#nombre').val(dato.nombre);
                    $('#celualr').val(dato.celualr);
                    $('#correo').val(dato.correo);
                    $('#carrera').val(dato.carrera);
                    $('#sede').val(dato.sede);
                    $('#name').html(dato.nombre);
                    $('#carre').html("Carrera:"+dato.sede);
                    $('#photo').prop('src',window.location+'/../fotos/'+dato.ciestudiante+'.jpg');
                    llenado(id);
                    $('#targeta').focus();
                    $('#targeta').val('');
                }
            })
        })
        function llenado(id){
            $('#tar').html('');
            $.ajax({
                url:'Student/targetas/'+id,
                success:function(e) {
                    //console.log(e);
                    var dato=JSON.parse(e);
                    dato.forEach(function (e) {
                        $('#tar').append('<tr>\n' +
                            '                                            <th scope="row">'+e.idcompra+'</th>\n' +
                            '                                            <td>'+e.fecha+'</td>\n' +
                            '                                            <td>'+e.monto+'</td>\n' +
                            '                                            <td>'+e.estado+'</td>\n' +
                            '                                            <td><a href="'+window.location+'/target/'+e.idcompra+'" target="_blank" class="btn btn-info btn-sm p-1" > <i class="fa fa-credit-card"></i> Print target</a></td>\n' +
                            '                                        </tr>');
                    });
                    // $('.imprimir').click(function (e) {
                    //     var nombre = $('#nombre').val();
                    //     var total = $(this).data('monto');
                    //     $.ajax({
                    //         url:'Student/configuracion',
                    //         success:function (e) {
                    //             var dato= JSON.parse(e);
                    //
                    //             var monto=dato[0].estado;
                    //             var costo=dato[1].estado;
                    //             var myWindow=window.open('', "Imprimir credencial", "width=600, height=600");
                    //             var html="<!doctype html>" +
                    //                 "<html lang='es'>" +
                    //                 "<head>" +
                    //                 "<meta charset='UTF-8'>             " +
                    //                 "<meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>                         <meta http-equiv='X-UA-Compatible' content='ie=edge'>             " +
                    //                 "<title>Document</title>" +
                    //                 "<style>" +
                    //                 ".titulo " +
                    //                 "{ font-size: 10px;" +
                    //                 "text-align: center" +
                    //                 "}" +
                    //                 ".contenido{ " +
                    //                 "font-size: 13px;" +
                    //                 "}" +
                    //                 "</style>" +
                    //                 "</head>" +
                    //                 "<body>" +
                    //                 "</html>" +
                    //                 "<table>" +
                    //                 "<tr>" +
                    //                 "<td> <img src='"+window.location+"../../assets/images/sis.png' alt=''></td>" +
                    //                 "<td><div class='titulo'>FACULTAD NACIONAL DE INGENIERIA <br> INGENIERIA DE SISTEMAS E  INFORMATICA <br>CENTRO DE IMPRESIONES</div></td>" +
                    //                 "<td> <img src='"+window.location+"../../assets/images/inf.png'></td>" +
                    //                 "</tr>" +
                    //                 "<tr>" +
                    //                 "<td colspan='3'> <p class='contenido'><b>Estudiante: </b> "+nombre+" <br><b>Costo de la targeta: </b>"+costo+" <br> <b>Credito cargado: </b> "+monto+"<br><b>Credito TOTAL : </b>"+total+"</p></td>" +
                    //                 "</tr>" +
                    //                 "</table>" +
                    //                 "</body>";
                    //             myWindow.onload=function () {
                    //                 myWindow.document.write(html);
                    //                 setTimeout(function () {
                    //                     myWindow.print() ;
                    //                     myWindow.close();
                    //                 }, 500)
                    //
                    //             }
                    //             //myWindow.document.write(html);
                    //
                    //         }
                    //     });
                    //
                    //     e.preventDefault();
                    // });
                }
            })
        };
        $('#insertartargeta').submit(function (e) {
            if (confirm('Seguro de agregar la targeta ' + $('#targeta').val())){
               var datos={
                  'numero':$('#targeta').val(),
                   'idestudiante':id
               } ;
                $.ajax({
                    data:datos,
                    type:'post',
                    url:'Student/inserttargeta',
                    success:function(e) {
                        console.log(e);
                        if (e=='1'){
                            llenado(id);
                            $('#targeta').focus();
                            $('#targeta').val('');
                            toastr.success('Guardado correctamnte!!');
                        }else {
                            toastr.error('No se reconoce la targeta!!');
                        }

                    }
                })
            }
            $('#targeta').focus();
            $('#targeta').val('');
             return false;
        });


    }
</script>
