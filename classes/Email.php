<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        // Crear el objeto de mail
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'Appsalon.com');
        $mail->Subject = 'Confima tu cuenta';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "
        <html>
        <head>
            <meta charset='UTF-8'>
        </head>
        <body style='margin:0;padding:0;background-color:#f4f4f4;font-family:Arial,Helvetica,sans-serif;'>

            <table width='100%' cellpadding='0' cellspacing='0' style='background-color:#f4f4f4;padding:40px 0;'>
                <tr>
                    <td align='center'>

                        <table width='600' cellpadding='0' cellspacing='0' style='background-color:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 15px rgba(0,0,0,0.1);'>

                            <tr>
                                <td style='background-color:#1e293b;padding:30px;text-align:center;'>
                                    <h1 style='color:#ffffff;margin:0;'>Confirma tu cuenta</h1>
                                </td>
                            </tr>

                            <tr>
                                <td style='padding:40px;'>

                                    <p style='font-size:18px;color:#333333;margin-top:0;'>
                                        Hola <strong>" . $this->nombre . "</strong>,
                                    </p>

                                    <p style='font-size:16px;color:#555555;line-height:1.6;'>
                                        Gracias por registrarte. Tu cuenta fue creada correctamente.
                                        Para activar tu cuenta y comenzar a utilizar todos nuestros servicios,
                                        debes confirmar tu dirección de correo electrónico.
                                    </p>

                                    <div style='text-align:center;margin:35px 0;'>
                                        <a href='" . $_ENV['APP_URL'] . "/confirmar-cuenta?token=" . $this->token . "'
                                        style='background-color:#2563eb;
                                                color:#ffffff;
                                                text-decoration:none;
                                                padding:15px 35px;
                                                border-radius:8px;
                                                font-size:16px;
                                                font-weight:bold;
                                                display:inline-block;'>
                                            Confirmar Cuenta
                                        </a>
                                    </div>

                                    <p style='font-size:14px;color:#777777;line-height:1.6;'>
                                        Si no solicitaste esta cuenta, puedes ignorar este mensaje.
                                    </p>

                                    <hr style='border:none;border-top:1px solid #e5e7eb;margin:30px 0;'>

                                    <p style='font-size:12px;color:#999999;text-align:center;margin:0;'>
                                        Este es un correo automático, por favor no respondas a este mensaje.
                                    </p>

                                </td>
                            </tr>

                        </table>

                    </td>
                </tr>
            </table>

            </body>
            </html>
            ";

        $mail->Body = $contenido;

        // Enviar el mail
        $mail->send();
    } 

    public function enviarInstrucciones() {
        // Crear el objeto de mail
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'Appsalon.com');
        $mail->Subject = 'Reestablece tu Contraseña.';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "
        <html>
        <head>
            <meta charset='UTF-8'>
        </head>
        <body style='margin:0;padding:0;background-color:#f4f4f4;font-family:Arial,Helvetica,sans-serif;'>

            <table width='100%' cellpadding='0' cellspacing='0' style='background-color:#f4f4f4;padding:40px 0;'>
                <tr>
                    <td align='center'>

                        <table width='600' cellpadding='0' cellspacing='0' style='background-color:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 15px rgba(0,0,0,0.1);'>

                            <tr>
                                <td style='background-color:#1e293b;padding:30px;text-align:center;'>
                                    <h1 style='color:#ffffff;margin:0;'>Confirma tu cuenta</h1>
                                </td>
                            </tr>

                            <tr>
                                <td style='padding:40px;'>

                                    <p style='font-size:18px;color:#333333;margin-top:0;'>
                                        Hola <strong>" . $this->nombre . "</strong>,
                                    </p>
                                    <p style='font-size:16px;color:#555555;line-height:1.6;'>
                                        Has solicitado reestablecer tu contraseña, sigue el siguiente enlace para hacerlo.
                                    </p>

                                    <div style='text-align:center;margin:35px 0;'>
                                        <a href='" . $_ENV['APP_URL'] . "/recuperar?token=" . $this->token . "'
                                        style='background-color:#2563eb;
                                                color:#ffffff;
                                                text-decoration:none;
                                                padding:15px 35px;
                                                border-radius:8px;
                                                font-size:16px;
                                                font-weight:bold;
                                                display:inline-block;'>
                                            Reestablecer Contraseña
                                        </a>
                                    </div>

                                    <p style='font-size:14px;color:#777777;line-height:1.6;'>
                                        Si no solicitaste este cambio, puedes ignorar este mensaje.
                                    </p>

                                    <hr style='border:none;border-top:1px solid #e5e7eb;margin:30px 0;'>

                                </td>
                            </tr>

                        </table>

                    </td>
                </tr>
            </table>

            </body>
            </html>
            ";

        $mail->Body = $contenido;

        // Enviar el mail
        $mail->send();
    }
}