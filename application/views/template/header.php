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

    <script src="<?php echo base_url()?>assets/js/vue.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/axios.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/fullcalendar.css" />
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/fullcalendar.min.js"></script>

<!-- ejemplo de href: href="<?php echo base_url();?>user" -->
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
<script>
    function addZero(i) 
    {
        if (i < 10) 
        {
            i = '0' + i;
        }
        return i;
    }
    var hoy = new Date();
    var dd = hoy.getDate();
    if(dd<10) 
    {
        dd='0'+dd;
    } 
    if(mm<10) 
    {
        mm='0'+mm;
    }
    var mm = hoy.getMonth()+1;
    var yyyy = hoy.getFullYear();
    dd=addZero(dd);
    mm=addZero(mm);
    $(document).ready(function() 
    {
        $('#calendar').fullCalendar(
        {
            header: 
            {
                left: 'prev,next',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: yyyy+'-'+mm+'-'+dd,
            buttonIcons: true, // show the prev/next text
            weekNumbers: false,
            editable: true,
            eventLimit: true, // allow "more" link when too many events 
            events: 
            {
                url: "get_proyecto_construccion_json_calendario"
            },
            dayClick: function (date, jsEvent, view) 
            {
                alert('Has hecho click en: '+ date.format());
            }, 
            eventClick: function (calEvent, jsEvent, view) 
            {
                //$('#event-title').text(calEvent.title);
                //$('#event-description').html(calEvent.description);
                //$('#modal-event').modal();
            },  
        });
    });
</script>
</head>
<body class="bg-light">

