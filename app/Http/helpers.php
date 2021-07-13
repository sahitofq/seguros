<?php

function printcode($code)
{
    ?>
  <pre style="font-family: Fira Code;">
<?php print_r($code)?>
</pre>
<?php
}

function calculada_edad($fechanacimiento)
{

    list($ano, $mes, $dia) = explode("-", $fechanacimiento);

    $ano_diferencia = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia = date("d") - substr($dia, 0, 2);
    if ($dia_diferencia < 0 || $mes_diferencia < 0) {
        $ano_diferencia--;
    }
    return $ano_diferencia;
}

function calculada_nombre($nombre)
{

    $name = explode(" ", $nombre);
    if (count($name) == 1) {
        $nombre = $name[0];
        $apellido = $name[0];
    }
    if (count($name) == 2) {
        $nombre = $name[0];
        $apellido = $name[1];
    }
    if (count($name) == 3) {
        $nombre = $name[0] . " " . $name[1];
        $apellido = $name[2];
    }
    if (count($name) == 4) {
        $nombre = $name[0] . " " . $name[1];
        $apellido = $name[2] . " " . $name[3];
    }
    $nombrec = array(
        "nombre" => $nombre,
        "apellido" => $apellido,
    );
    return $nombrec;
}
