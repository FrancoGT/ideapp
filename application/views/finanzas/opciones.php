<style>
  section
  {
    background: url("<?php echo base_url();?>assets/img/items_finanzas.png");
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
<form method="POST" action="<?php echo base_url();?>index.php/finanza/modulo_presupuesto_obra">
  <button class="btn btn-lg btn-primary" name="presupuesto_obras" id="presupuesto_obras" type="submit">
    PRESUPUESTO DE OBRAS
  </button>
</form>
<br>
<br>
<br>
<form method="POST" action="<?php echo base_url();?>index.php/finanza/modulo_pagos_trabajadores">
  <button class="btn btn-lg btn-primary" name="pagos_trabajadores" id="pagos_trabajadores" type="submit">
    PAGOS A TRABAJADORES
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