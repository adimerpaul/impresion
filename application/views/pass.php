<div class="content-wrapper">
    <form class="form-inline" action="<?=base_url()?>Pass/update" method="post">
        <label for="pass1" class="col-sm-2 col-form-label">Password actual</label>
        <div class="col-sm-3">
            <input type="password"  class="form-control" id="pass1" name="pass1"  required>
        </div>
        <label for="pass2" class="col-sm-2 col-form-label">Nuevo password</label>
        <div class="col-sm-3">
            <input type="password"  class="form-control" id="pass2" name="pass2" required>
        </div>
        <button type="submit" class="btn btn-primary mb-2" id="verificar"> <i class="fa fa-check"></i> Cambiar</button>
    </form>
</div>
