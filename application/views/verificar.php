<div class="content-wrapper">
<div class="row">
    <div class="col-sm-5">
        <h5>Datos de la targeta</h5>
        <div class="card" style="width: 18rem;">
            <img id="photo" src="" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title" id="name"></h5>
                <p class="card-text" id="carre"></p>
            </div>
        </div>
    </div>
    <div class="col-sm-7">
        <p class="card-text" id="idtargeta" hidden></p>
        <p class="card-text" id="numero"></p>
        <p class="card-text" id="estado"></p>
        <p class="card-text" id="monto"></p>
        <p class="card-text" id="fecha"></p>
        <p>
        </p>
    </div>
</div>
</div>
<script >
    window.onload=function (e) {

        function actualizar(numero) {
            $.ajax({
                url:'../Target/datos/'+numero,
                success:function(e) {
console.log(e);
                    $('#targeta').val('');
                    var dato=JSON.parse(e)[0];
                    console.log(dato);
                    if (dato==undefined){
                        alert('targeta no encontrada!!');
                    } else {
                        $('#name').html(dato.nombre);
                        $('#carre').html("Carrera:"+dato.sede);
                        $('#photo').prop('src',window.location+'/../../fotos/'+dato.ciestudiante+'.jpg');
                        $('#numero').html('<b>Numero:</b> '+dato.numero);
                        $('#idtargeta').html(dato.idtargeta);
                        $('#estado').html('<b>Estado:</b> '+dato.estado);
                        $('#monto').html('<b>Monto:</b> '+dato.monto);
                        $('#fecha').html('<b>Fecha de creacion:</b> '+dato.fecha);

                    }



                }
            })
        }
        actualizar( '<?=$numero?>');
    }
</script>
