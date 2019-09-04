<div class="content-wrapper">
    <div class="alert alert-success" >
        Porfavor ingresar targeta!!!
    </div>
    <form class="form-inline" method="post" id="insertartargeta">
        <label for="targeta" class="col-sm-2 col-form-label">Targeta</label>
        <div class="col-sm-4">
            <input type="text" name="correo" autofocus  class="form-control" id="targeta" placeholder="Numero de targeta" required>
        </div>
        <div class="col-sm-5">
            <button type="submit" class="btn btn-success p-1"> <i class="fa fa-credit-card-alt"></i> Ver Targeta</button>
        </div>

    </form>
    <hr>
    <div id="contenedor">
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
                <form class="form-inline" method="post" id="recarga">
                    <label for="targeta" class="col-sm-2 col-form-label">COBRAR</label>
                    <div class="col-sm-4">
                        <input type="text" name="correo" autofocus  class="form-control" id="dinero" placeholder="Monto a recargar" required>
                    </div>
                    <div class="col-sm-5">
                        <button class="btn btn-warning"> <i class="fa fa-money"></i> Cobrar targeta</button>
                    </div>

                </form>

                </p>
            </div>
        </div>
    </div>
</div>
<script >
    window.onload=function (e) {
        $('#contenedor').hide();
        var numero;
        $('#insertartargeta').submit(function (e) {
            numero=$('#targeta').val();
            actualizar(numero);
            return false;
        })
        $('#recarga').submit(function (e) {
            if (confirm('Seguro de cobrar el monto de ' + $('#dinero').val()) ){
                var datos={
                    'monto':$('#dinero').val(),
                    'idtargeta':$('#idtargeta').html()
                };
                $.ajax({
                    data:datos,
                    type:'post',
                    url:'Cobro/cobrorecarga',
                    success:function(e) {
                        console.log(e);
                        if (e=='1'){
                            $('#dinero').focus();
                            $('#dinero').val('');
                            actualizar(numero);
                        }
                        toastr.success('Guardado correctamnte!!');
                    }
                })
            }
            return false;
        });
        function actualizar(numero) {
            $.ajax({
                url:'Target/datos/'+numero,
                success:function(e) {
                    $('#targeta').val('');
                    var dato=JSON.parse(e)[0];
                    console.log(dato);
                    if (dato==undefined){
                        alert('targeta no encontrada!!');
                        $('#targeta').focus();

                    } else {
                        $('#dinero').focus();
                        $('#contenedor').show();
                        $('#name').html(dato.nombre);
                        $('#carre').html("Carrera:"+dato.sede);
                        $('#photo').prop('src',window.location+'/../fotos/'+dato.ciestudiante+'.jpg');

                        $('#numero').html('<b>Numero:</b> '+dato.numero);
                        $('#idtargeta').html(dato.idtargeta);
                        $('#estado').html('<b>Estado:</b> '+dato.estado);
                        $('#monto').html('<b>Monto:</b> '+dato.monto);
                        $('#fecha').html('<b>Fecha de creacion:</b> '+dato.fecha);
                        if (dato.estado=='ACTIVO'){
                            $('#recarga').show();
                        }else {
                            $('#recarga').hide();
                        }
                    }



                }
            })
        }
    }
</script>
