function habilitar_boton(var_boton, input_id)
{
    if (document.getElementById(input_id).value != '')
    {
        document.getElementById(var_boton).style.visibility = "visible";
    }
}