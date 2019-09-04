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
                    <label for="targeta" class="col-sm-2 col-form-label">Recarga</label>
                    <div class="col-sm-4">
                        <input type="text" name="correo" autofocus  class="form-control" id="dinero" placeholder="00.00" required>
                    </div>
                    <div class="col-sm-5">
                        <button class="btn btn-warning"> <i class="fa fa-money"></i> Regargar targeta</button>
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

            if (confirm('Seguro de recargar el monto de ' + $('#dinero').val()) ){
                var datos={
                    'monto':$('#dinero').val(),
                    'idtargeta':$('#idtargeta').html()
                };
                $.ajax({
                    data:datos,
                    type:'post',
                    url:'Target/insertrecarga',
                    success:function(e) {
                        console.log(e);
                        if (e=='1'){

                            toastr.success('Guardado correctamnte!!');
                            var pdf = new jsPDF({
                                // orientation: 'landscape',
                                unit: 'mm',
                                format: [750, 550]
                            })
                            pdf.setFontSize(10);
                            pdf.setFontStyle("bold");
                            pdf.text(6,10,"UNIVERSIDAD TÉCNICA DE ORURO");
                            pdf.text(5,15,"FACULTAD NACIONAL DE INGENIERÍA");
                            pdf.text(4,20,"INGENIERÍA DE SISTEMAS E INFORMÁTICA");

                            pdf.text(4,30,"RECIBO por la recarga targeta");
                            pdf.setFontStyle("normal");
                            pdf.text(4,35,"El monto de  "+$('#dinero').val());

                            // pdf.text(6,6,"INGENIERÍA DE SISTEMAS E INFORMÁTICA");
                            // doc.save('Test.pdf');
                            var cont='<iframe id="pdf_preview" type="application/pdf"  src="'+pdf.output('datauristring')+'" width="750" height="550"></iframe>';
                            var myWindow=window.open('', "Imprimir credencial", "width=600, height=600");
                            myWindow.document.write(cont);

                            $('#dinero').focus();
                            $('#dinero').val('');
                            actualizar(numero);

                        }else{
                            toastr.error('formato no correcto!!');
                        }

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
