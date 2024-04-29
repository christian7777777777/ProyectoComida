<?php

session_start();

require_once '../pdf/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Destruir la sesión
session_unset();
session_destroy();

// Recibir los datos del formulario
$emailCliente = $_POST['emailCliente'];
$nombreCliente = $_POST['nombreCliente'];
$valorPedido = $_POST['valorPedido'];
$mesaCliente = $_POST['mesaCliente'];

// Crear una instancia de Dompdf con opciones
$options = new Options();
$options->set('isHtml5ParserEnabled', true); // Habilitar el analizador HTML5

$dompdf = new Dompdf($options);

// Agregar contenido al PDF
$html = "
<!DOCTYPE html>
<html>
<head>
    <title>Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Factura</h1>
    <table>
        <tr>
            <th>Email Cliente</th>
            <td>$emailCliente</td>
        </tr>
        <tr>
            <th>Nombre Cliente</th>
            <td>$nombreCliente</td>
        </tr>
        <tr>
            <th>Valor Pedido</th>
            <td>$valorPedido</td>
        </tr>
        <tr>
            <th>Mesa Cliente</th>
            <td>$mesaCliente</td>
        </tr>
    </table>
</body>
</html>
";

$dompdf->loadHtml($html);

// Renderizar el PDF
$dompdf->render();

// Generar el archivo PDF
$dompdf->stream('factura.pdf', array('Attachment' => 1)); // Descargar automáticamente el archivo

// Redirigir al index principal
header("location: ./ProyectoComida/");
exit();

?>
