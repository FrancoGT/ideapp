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

    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/chartist.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/slice.css">
    <script type="text/javascript" src="https://unpkg.com/vue@2.1.8/dist/vue.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/vue.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/vue-resource.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.easy-autocomplete.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/funciones_auxiliares.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/<?php echo $link;?>"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/<?php echo $otro_link;?>"></script>

    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/chartist.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/chart.min.js"></script>

<ul class="nav justify-content-center bg-dark text-light">
  <li class="nav-item">
        <a class="nav-link text-white h4"> <h1>Sistema de RRHH de <img src="<?php echo base_url();?>assets/img/civue.png" width="100" height="100"> </h1> 
        <div align="center"> 
            <h6>
            <?php 
                $obj = &get_instance();
                $obj->load->model('usuario_model');
                if ($obj->usuario_model->get_id_user() == NULL)
                {
                    redirect("login/index");
                }
                else
                {
                    echo 'Bienvenid@, ' .$obj->usuario_model->get_full_name($obj->usuario_model->get_id_user());
                }
            ?>
            </h6>
        </div> 
           
        </a>
  </li>
</ul>
<style type="text/css">
    .group 
    {
        margin-top: 10px;

    }
</style>
</head>
<body class="bg-light">