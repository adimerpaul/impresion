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
</div>
<hr>
<div class="content-wrapper">
    <form class="form-inline">
        <label for="date12" class="col-sm-2 col-form-label">Desde</label>
        <div class="col-sm-3">
            <input type="date" class="form-control" id="date1" >
        </div>
        <label for="date22" class="col-sm-2 col-form-label">Hasta</label>
        <div class="col-sm-3">
            <input type="date" class="form-control" id="date2" >
        </div>
        <button type="submit" class="btn btn-primary mb-2" id="verificar2"> <i class="fa fa-check"></i> Verificar</button>
    </form>
    <h3>Ventas de targetas del dia</h3>
    <iframe id="pdf_preview2" type="application/pdf" src="" width="100%" height="100%"></iframe>
</div>
<script >
    window.onload=function (e) {
        $('#date1').val(moment().format('YYYY-MM-DD'));
        $('#date2').val(moment().format('YYYY-MM-DD'));
        $('#date12').val(moment().format('YYYY-MM-DD'));
        $('#date22').val(moment().format('YYYY-MM-DD'));
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
        function datos2(date1,date2) {
            $.ajax({
                url:'Report/datos2/'+date1+'/'+date2,
                success:function (e) {
                    // console.log(e);
                    var dat=JSON.parse(e);
                    var cont=0;
                    var data = [];
                    var total=0;
                    dat.forEach(function (e) {
                        // console.log(e);
                        cont++;
                        total= parseFloat(total)+parseFloat(e.costo);
                        data.push([cont,  e.costo,e.estudiante,e.fecha]);
                    });
                    data.push(['', '','TOTAL:',total]);
                    // console.log(datos);
                    var pdf = new jsPDF();
                    if ($('#date1').val()==$('#date2').val()){
                        pdf.text(20,10,"Ventas en fecha "+$('#date1').val() );
                    }else {
                        pdf.text(20,10,"Ventas de las fechas "+$('#date1').val() +' al '+ $('#date2').val());
                    }
                    var columns = ["Id",  "Monto","Estudiante","Fecha"];

                    console.log(data);

                    pdf.autoTable(columns,data,
                        { margin:{ top: 20 }}
                    );
                    // doc.save('Test.pdf');
                    $("#pdf_preview2").attr("src", pdf.output('datauristring'));
                }
            });
        }
        datos($('#date1').val(),$('#date2').val());
        datos2($('#date1').val(),$('#date2').val());
        $('#verificar').click(function (e) {
            datos($('#date1').val(),$('#date2').val());
            e.preventDefault();
        });
        $('#verificar2').click(function (e) {
            datos2($('#date12').val(),$('#date22').val());
            e.preventDefault();
        });

    }
</script>
