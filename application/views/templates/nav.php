<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="<?=base_url()?>Main" class="nav-link">
                <div class="profile-image">
                    <img class="img-xs rounded-circle" src="<?=base_url()?>assets/images/faces/face8.png" alt="profile image">
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                    <p class="profile-name"><?=$_SESSION['nombre']?></p>
                    <p class="designation"><?=$_SESSION['tipo']?></p>
                </div>
            </a>
        </li>
        <li class="nav-item nav-category">Main Menu</li>
        <?php if ($_SESSION['tipo']=='ADMIN'):?>
        <li class="nav-item">
            <a class="nav-link" href="<?=base_url()?>Configuration">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title"> <i class="fa fa-cog"></i> Controlar Configuracion</span>
            </a>
        </li>
         <li class="nav-item">
            <a class="nav-link" href="<?=base_url()?>User">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title"> <i class="fa fa-user"></i> Controlar Usuarios</span>
            </a>
        </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>Targetas">
                    <i class="menu-icon typcn typcn-shopping-bag"></i>
                    <span class="menu-title"> <i class="fa fa-credit-card"></i> Controlar targetas</span>
                </a>
            </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=base_url()?>Student">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title"> <i class="fa fa-user-circle-o"></i> Controlar estudiantes</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?=base_url()?>Target">
                <i class="menu-icon typcn typcn-th-large-outline"></i>
                <span class="menu-title"><i class="fa fa-address-card"> </i> Recargar targetas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=base_url()?>Cobro">
                <i class="menu-icon typcn typcn-th-large-outline"></i>
                <span class="menu-title"><i class="fa fa-usd"> </i> Cobro de targetas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=base_url()?>Caja">
                <i class="menu-icon typcn typcn-bell"></i>
                <span class="menu-title"><i class="fa fa-money"></i> Ver Caja</span>
            </a>
        </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>Report">
                    <i class="menu-icon typcn typcn-bell"></i>
                    <span class="menu-title"><i class="fa fa-file-pdf-o"></i> Imprimir montos del dia</span>
                </a>
            </li>
        <?php endif;?>
        <?php if ($_SESSION['tipo']=='RECARGA'):?>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>Student">
                    <i class="menu-icon typcn typcn-shopping-bag"></i>
                    <span class="menu-title"> <i class="fa fa-user-circle-o"></i> Controlar estudiantes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>Target">
                    <i class="menu-icon typcn typcn-th-large-outline"></i>
                    <span class="menu-title"><i class="fa fa-address-card"> </i> Regargar targetas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>Caja">
                    <i class="menu-icon typcn typcn-bell"></i>
                    <span class="menu-title"><i class="fa fa-money"></i> Ver Caja</span>
                </a>
            </li>
        <?php endif;?><?php if ($_SESSION['tipo']=='COBRADOR'):?>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>Cobro">
                    <i class="menu-icon typcn typcn-th-large-outline"></i>
                    <span class="menu-title"><i class="fa fa-usd"> </i> Cobro de targetas</span>
                </a>
            </li>
        <?php endif;?>

        <li class="nav-item">
            <a class="nav-link" href="<?=base_url()?>Welcome/logout">
                <i class="menu-icon typcn typcn-bell"></i>
                <span class="menu-title"><i class="fa fa-power-off"></i> Salir</span>
            </a>
        </li>
    </ul>
</nav>


<!-- partial -->
<div class="main-panel">
