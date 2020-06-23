<div  align="center">
    <br>
        <h5>Ingrese el nombre de Proyecto de obra</h5>
        <br>
        <form method="POST" action="<?php echo base_url();?>index.php/finanza/ver_pagos">
            <input type="text" id="provider-json" value=''/>
            <input type="hidden" id="data-holder" name="data-holder" value=''/>
            <br><br>
            <button class="btn btn-lg btn-primary" name="buscar" id="buscar" type="submit" style="visibility:hidden;">
                VER PAGOS
            </button>
        </form>
    </div>
        <script>
            var options = {
                url: "<?php echo base_url();?>finanza/get_data_proyecto_construccion",
                getValue: "nombre_proyecto",
                list: {
                    match: {
                        enabled: true
                    },
                    onClickEvent: function() 
                    {
                        var value = $("#provider-json").getSelectedItemData().id_proyecto_construccion;

                        $("#data-holder").val(value).trigger("change");
                        habilitar_boton("buscar", "data-holder");
                    },
                    onKeyEnterEvent: function()
                    {
                        var value = $("#provider-json").getSelectedItemData().id_proyecto_construccion;

                        $("#data-holder").val(value).trigger("change");
                        habilitar_boton("buscar", "data-holder");
                    }
                },
                theme: "square"
            };
            $("#provider-json").easyAutocomplete(options);
        </script>