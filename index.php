<?php
/*
Para el uso de este se utiliza tambien el paquete Dotenv, el cual nos deja leer desde un archivo
.env variables de entorno. Las cuales son:

- PHP_MAILER_USER= Correo de GMAIL (habilitar gmail con apps menos seguras en https://myaccount.google.com/lesssecureapps)
- PHP_MAILER_PASWORD= Contraseña
- PHP_MAILER_PORT= Puerto (Default 587)
*/

use Dotenv\Dotenv;

require_once('vendor/autoload.php');
require 'Mailer.php';
require 'EmailEnvelope.php';

//  Se crea Envoltorio de Email
$emailEnvelope = new EmailEnvelope(
    'Adrian',
    ['adriankiki98@gmail.com', 'pedrotrdz76@gmail.com'],
    'Prueba de Encabezado',
    'Esta es una prueba de Adrian'
);


// Se leen las variables de Ambiente
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Se crea objeto Mailer
$mailer = new Mailer();

// Se llama la funcion GetPHPMailer, que recibe un EmailEnvelope como parametro
try {
    echo ($mailer->GetSendGrid($emailEnvelope))->statusCode();
} catch (Exception $e) {
    echo $e->getMessage();
}
