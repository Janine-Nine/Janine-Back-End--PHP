<?php
class EmailHelper {
    // Função para envio de e-mail
    $mail->Subject = "Confirmação do Pedido";
$mail->Body = "Olá! Seu pedido foi recebido com sucesso. Valor total: R$ {$total}";
}

<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailHelper
{
    public static function send($to, $name, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {

            // Configuração SMTP
            $mail->isSMTP();
            $mail->Host       = env('MAIL_HOST');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME');
            $mail->Password   = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = env('MAIL_PORT');

            // Remetente
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));

            // Destinatário
            $mail->addAddress($to, $name);

            // Conteúdo
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();

            return [
                'success' => true,
                'message' => 'Email enviado com sucesso.'
            ];

        } catch (Exception $e) {

            return [
                'success' => false,
                'message' => $mail->ErrorInfo
            ];
        }
    }
}