<div class="content-wrapper">
    <form class="form-inline">
        <label for="date1" class="col-sm-2 col-form-label">Desde</label>
        <div class="col-sm-3">
            <input type="date" class="form-control" id="date1" >
        </div>
        <label for="date2" class="col-sm-2 col-form-label">Hasta</label>
        <div class="col-sm-3">
            <input type="date" class="form-control" id="date2" >
        </div>
        <button type="submit" class="btn btn-primary mb-2" id="verificar"> <i class="fa fa-check"></i> Verificar</button>
    </form>
    <h3>Recargas realizadas</h3>
    <iframe id="pdf_preview" type="application/pdf" src="" width="100%" height="100%"></iframe>
    <hr>
<!--    <table  class="table display responsive nowrap" style="width:50%;">-->
<!--        <thead>-->
<!--        <tr>-->
<!--            <th>#</th>-->
<!--            <th>targeta</th>-->
<!--            <th>usuario</th>-->
<!--            <th>monto</th>-->
<!--            <th>estudiante</th>-->
<!--            <th>fecha</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        --><?php
//        $query=$this->db->query("SELECT r.idrecarga,u.nombre,r.monto,numero,e.nombre as estudiante,carrera,r.fecha,r.tipo
//FROM targeta t
//INNER JOIN compra c ON c.idtargeta=t.idtargeta
//INNER JOIN estudiante e ON c.idestudiante=e.idestudiante
//INNER JOIN recarga r ON r.idcompra=c.idcompra
//INNER JOIN usuario u ON u.idusuario=r.idusuario
//WHERE r.tipo='REGARGA'");
//        $con=0;
//        foreach ($query->result() as $row){
//            $con++;
//            echo "<tr>
//                        <td scope='row'>$con</td>
//                        <td>$row->numero</td>
//                        <td>$row->nombre</td>
//                        <td>$row->monto</td>
//                        <td>$row->estudiante</td>
//                        <td>$row->fecha</td>
//                      </tr>";
//        }
//        ?>
<!---->
<!--        </tbody>-->
<!--    </table>-->
</div>
<script >
    window.onload=function (e) {
        $('#example , #example2, #example3').DataTable( {
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
        $('#date1').val(moment().format('YYYY-MM-DD'));
        $('#date2').val(moment().format('YYYY-MM-DD'));
        function datos(date1,date2) {
            $.ajax({
                url:'Report/datos/'+date1+'/'+date2,
                success:function (e) {
                    // console.log(e);
                    var dat=JSON.parse(e);
                    var cont=0;
                    var data = [];
                    var total=0;
                    dat.forEach(function (e) {
                        // console.log(e);
                        cont++;
                        total= parseFloat(total)+parseFloat(e.monto);
                        data.push([cont, e.numero, e.nombre, e.monto,e.estudiante,e.fecha]);
                    });
                    data.push(['', '', '', '','TOTAL:',total]);
                    // console.log(datos);
                    var pdf = new jsPDF();
                    if ($('#date1').val()==$('#date2').val()){
                        pdf.text(20,10,"Recargas en fecha "+$('#date1').val() );
                    }else {
                        pdf.text(20,10,"Recargas de las fechas "+$('#date1').val() +' al '+ $('#date2').val());
                    }
                    var columns = ["Id", "Targeta", "Usuario", "Monto","Estudiante","Fecha"];

                    console.log(data);

                    pdf.autoTable(columns,data,
                        { margin:{ top: 20 }}
                    );
                    // doc.save('Test.pdf');
                    $("#pdf_preview").attr("src", pdf.output('datauristring'));
                }
            });
        }
        datos($('#date1').val(),$('#date2').val());

        $('#verificar').click(function (e) {
            datos($('#date1').val(),$('#date2').val());
            e.preventDefault();
        });

    }
</script>
