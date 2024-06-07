<?php
header('Content-Type: application/json; charset=utf-8');
header('Application: VIOSOMOS');
header('Developer: ');

/**
 * Muestra todos los datos de una colección como JSON
 * @param $collection Colección de datos
 */

function print_all($collection)
{
    echo json_encode($collection, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}