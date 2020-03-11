<style>
  section
  {
    background: url("<?php echo base_url();?>assets/img/recursos_humanos.png");
    background-repeat: no-repeat;
    background-position: center;
  }
</style>
<section>
<div align="center">
<br>   
<br>
<br>
<br>
<form method="POST" action="<?php echo base_url();?>index.php/recurso_humano/modulo_trabajadores">
  <button class="btn btn-lg btn-primary" name="trabajadores" id="trabajadores" type="submit">
  TRABAJADORES
  </button>
</form>
<br>
<br>
<br>
<form method="POST" action="<?php echo base_url();?>index.php/recurso_humano/modulo_usuarios">
  <button class="btn btn-lg btn-primary" name="usuarios" id="usuarios" type="submit">
  USUARIOS
  </button>
</form>
<br>
<br>
<br>
<br>
<br>
<br>
</div>
</section>