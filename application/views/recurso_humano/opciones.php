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
<form method="POST" action="<?php echo base_url();?>index.php/recurso_humano/modulo_trabajadores">
  <button class="btn btn-lg btn-primary" name="trabajadores" id="trabajadores" type="submit">
  TRABAJADORES
  </button>
</form>
<br>
<form method="POST" action="<?php echo base_url();?>index.php/recurso_humano/modulo_areas_cargos">
  <button class="btn btn-lg btn-primary" name="areas_cargos" id="areas_cargos" type="submit">
  ÁREAS Y CARGOS
  </button>
</form>
<br>
<form method="POST" action="<?php echo base_url();?>index.php/recurso_humano/modulo_usuarios">
  <button class="btn btn-lg btn-primary" name="usuarios" id="usuarios" type="submit">
  PERFIL DE USUARIO
  </button>
</form>
<br>
<br>
</div>
</section>