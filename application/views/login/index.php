<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IDEA INVERSIONES PROMOTORA INMOBILIARIA E.I.R.L</title>
<link rel="icon" href="<?php echo base_url()?>assets/img/civue.png">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bulma.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/animate.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css">


<ul class="nav justify-content-center bg-dark text-light">
  <li class="nav-item">
        <a class="nav-link text-white h4"> <h1>Sistema de RRHH de <img src="<?php echo base_url();?>assets/img/civue.png" width="100" height="100"> </h1> 
        <p></p> <br><br> <!-- Opcional: Indicar si inicioo cerro sesion -->
        </a>
  </li>
</ul>
</head>
<style type="text/css">
    .group 
    {
        margin-top: 10px;

    }
</style>
<body class="bg-light">
<br>
	<div align="center">
		<h1 class="text-center login-title">Iniciar Sesi&oacute;n</h1>
                <?php if(isset($error)) { echo $error; }; ?>
	</div>
        <div class="group">
            <div class="d-flex justify-content-center">
                <div align="center" class="account-wall">
                	<br>
                    <img class="profile-img" src="<?php echo base_url();?>assets/img/logo_usuario.gif"
                        width="150" height="200">
                        <br>
                    <form class="form-signin" method="POST" action="<?php echo base_url() ?>index.php/login">
                        <br>
                    <div class="form-group">
                        <input autocomplete="off" type="text" class="form-control" name="username" placeholder="Usuario" autofocus>
                        <?php echo form_error('username'); ?>
                    </div>
                    <div class="form-group">
                        <input autocomplete="off" type="password" name="password" class="form-control" placeholder="Contraseña">
                        <?php echo form_error('password'); ?>
                    </div>

                    <button class="btn btn-lg btn-primary btn-block" name="btn-login" id="btn-login" type="submit">
                        Ingresar</button>


                    <a href="#" class="pull-right need-help">  </a><span class="clearfix"></span>
                    </form>
                </div>
                <div id="error" style="margin-top: 10px"></div>
            </div>
        </div>
<br>
</body>
<div align="center">
</div>
<br>
</html>