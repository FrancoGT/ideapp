<style>
  section
  {
    background: url("<?php echo base_url();?>assets/img/obra_en_construccion.png");
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
<form method="POST" action="<?php echo base_url();?>index.php/servicio/modulo_obras_construccion">
  <button class="btn btn-lg btn-primary" name="obras" id="obras" type="submit">
  OBRAS DE CONSTRUCCI&Oacute;N
  </button>
</form>
<br>
<br>
<br>
<form method="POST" action="<?php echo base_url();?>index.php/servicio/modulo_materiales_obra">
  <button class="btn btn-lg btn-primary" name="materiales" id="materiales" type="submit">
  RECEPCI&Oacute;N DE MATERIALES
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