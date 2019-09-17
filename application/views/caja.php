<div class="content-wrapper">
<?php if ($_SESSION['tipo']=='ADMIN'):?>
<h3>Targetas entregadas</h3>
    <table id="example" class="display responsive nowrap" style="width:50%;">
        <thead>
        <tr>
            <th>idtargeta</th>
            <th>numero</th>
            <th>estado</th>
            <th>estudiante</th>
            <th>carrera</th>
            <th>monto</th>
            <th>fecha</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $query=$this->db->query("SELECT * FROM targeta t 
INNER JOIN compra c ON c.idtargeta=t.idtargeta
INNER JOIN estudiante e ON c.idestudiante=e.idestudiante");
        foreach ($query->result() as $row){
            if ($row->estado=="ACTIVO"){
                $c="success";
            }else{
                $c="warning";
            }
            echo "<tr>
                        <td>$row->idtargeta</td>
                        <td>$row->numero</td>
                        <td><div class='badge badge-$c'>$row->estado</div></td>
                        <td>$row->nombre</td>
                        <td>$row->carrera</td>
                        <td>$row->monto</td>
                        <td>$row->fecha</td>
                      </tr>";
        }
        ?>

        </tbody>
    </table>
    <h3>Recargas realizadas</h3>
    <table id="example2" class="display responsive nowrap" style="width:50%;">
        <thead>
        <tr>
            <th>idrecarga</th>
            <th>targeta</th>
            <th>usuario</th>
            <th>monto</th>
            <th>tigo</th>
            <th>estudiante</th>
            <th>carrera</th>
            <th>fecha</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $query=$this->db->query("SELECT r.idrecarga,u.nombre,r.monto,numero,e.nombre as estudiante,r.tipo,carrera,r.fecha 
FROM targeta t 
INNER JOIN compra c ON c.idtargeta=t.idtargeta
INNER JOIN estudiante e ON c.idestudiante=e.idestudiante
INNER JOIN recarga r ON r.idcompra=c.idcompra
INNER JOIN usuario u ON u.idusuario=r.idusuario");
        foreach ($query->result() as $row){
            echo "<tr>
                        <td>$row->idrecarga</td>
                        <td>$row->numero</td>
                        <td>$row->nombre</td>
                        <td>$row->monto</td>
                        <td>$row->tipo</td>
                        <td>$row->estudiante</td>
                        <td>$row->carrera</td>
                        <td>$row->fecha</td>
                      </tr>";
        }
        ?>

        </tbody>
    </table>
<?php endif;?>
    <h3>Monto cobrados</h3>
    <table id="example3" class="display responsive nowrap" style="width:50%;">
        <thead>
        <tr>
            <th>idcobro</th>
            <th>targeta</th>
            <th>usuario</th>
            <th>monto</th>
            <th>estudiante</th>
            <th>carrera</th>
            <th>fecha</th>
        </tr>
        </thead>
        <tbody>

        <?php
        if ($_SESSION['tipo']=='ADMIN'){
            $consulta="";
        }else{
            $consulta="WHERE date(co.fecha)=date(now())";
        }
        $query=$this->db->query("SELECT co.idcobro,u.nombre,co.monto,numero,e.nombre as estudiante,carrera,co.fecha 
FROM targeta t 
INNER JOIN compra c ON c.idtargeta=t.idtargeta
INNER JOIN estudiante e ON c.idestudiante=e.idestudiante
INNER JOIN cobro co ON co.idcompra=c.idcompra
INNER JOIN usuario u ON u.idusuario=co.idusuario
$consulta");
        foreach ($query->result() as $row){
            echo "<tr>
                        <td>$row->idcobro</td>
                        <td>$row->numero</td>
                        <td>$row->nombre</td>
                        <td>$row->monto</td>
                        <td>$row->estudiante</td>
                        <td>$row->carrera</td>
                        <td>$row->fecha</td>
                      </tr>";
        }
        ?>

        </tbody>
    </table>
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
    }
</script>
