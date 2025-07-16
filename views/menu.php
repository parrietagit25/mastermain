<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MasterMain</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php?pag=main">Inicio</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Usuarios
          </a>
          <ul class="dropdown-menu">
          <?php if($_SESSION['tipo_usuario'] == 'admin' || $_SESSION['tipo_usuario'] == 'rrhh'){ ?>
            <li><a class="dropdown-item" href="index.php?pag=reg_user">Usuarios</a></li>
             <?php } ?>
          </ul>
         
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Kuruma
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="index.php?pag=finanzas">FINANZAS</a></li>
          <li><a class="dropdown-item" href="index.php?pag=comercial">COMERCIAL</a></li>
              <?php if($_SESSION['tipo_usuario'] == 'admin' || $_SESSION['tipo_usuario'] == 'rrhh'){ ?>
              <li><a class="dropdown-item" href="index.php?pag=reg_colab">Registrar Colaborador</a></li>
              <li><a class="dropdown-item" href="index.php?pag=rep_comisiones">Reporte PayDay</a></li>
              <li><a class="dropdown-item" href="index.php?pag=rep_comisiones_anio">Reporte de comisiones</a></li>
              <li><a class="dropdown-item" href="index.php?pag=form_int">Formulario de Ingreso</a></li>
            
            <?php } ?>
          </ul>
        </li>
        <?php if($_SESSION['tipo_usuario'] == 'admin' || $_SESSION['tipo_usuario'] == 'reporteria' || $_SESSION['tipo_usuario'] == 'comi-repor' || $_SESSION['tipo_usuario'] == 'no_definido'){ ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reportes
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?pag=duebacks">Reporte DueBacks</a></li>
            <li><a class="dropdown-item" href="index.php?pag=overdue">Reporte OverDue</a></li>
            <li><a class="dropdown-item" href="index.php?pag=retenciones">Retenciones</a></li>
            <li><a class="dropdown-item" href="index.php?pag=reservadiaanterior">Reserva dia Anterior</a></li>
            <li><a class="dropdown-item" href="index.php?pag=rep_comisiones_corp">Reporte de comisiones Corp</a></li>
            <li><a class="dropdown-item" href="index.php?pag=rep_pag_web">Reporte de Pagina web</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php if($_SESSION['tipo_usuario'] == 'admin' || $_SESSION['tipo_usuario'] == 'pbi'){ ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            PBI
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?pag=cumplimiento">PBI Cumplimiento</a></li>
          </ul>
        </li>
        <?php } ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reservas
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?pag=reservas">Horario Reservas</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Perfil
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?pag=salir">Salir</a></li>
          </ul>
        </li>
      </ul>
      <!--<form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>-->
    </div>
  </div>
</nav>