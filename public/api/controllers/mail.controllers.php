<?php
require '../../tools/PHPMailer/PHPMailerAutoload.php';


function send_mail($sender, $receiver, $subject, $content)
{
    if (isset($sender) && !empty($sender)) {
        if (isset($receiver) && !empty($receiver)) {
            if (isset($subject) && !empty($subject)) {
                if (isset($content) && !empty($content)) {
                    $mail = new PHPMailer;
                    $mail->isSMTP();
                    $mail->SMTPDebug = 0;
                    $mail->Host = 'smtp.hostinger.com';
                    $mail->Port = 587;
                    $mail->SMTPAuth = true;
                    $mail->Username = 'no-reply@viosomos.com';
                    $mail->Password = 'Chuvaca6013.';
                    $mail->setFrom('no-reply@viosomos.com', $sender);
                    $mail->addReplyTo($sender, $sender);
                    $mail->addAddress($receiver, $receiver);
                    $mail->CharSet = 'UTF-8';
                    $mail->isHTML(true);
                    $mail->Subject = $subject;

                    $mail->Body = $content;
                    if ($mail->send()) {

                        $response = array(
                            'success' => true,
                            'message' => 'El mail se envio correctamente'
                        );
                    } else {

                        $response = array(
                            'success' => false,
                            'message' => 'El mail no se pudo enviar',
                            'error' => $mail->ErrorInfo
                        );
                    }
                } else {
                    $response = array(
                        'success' => false,
                        'message' => 'Debes indicar el texto del mail'
                    );
                }
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Debes indicar el asunto del mail'
                );
            }
        } else {
            $response = array(
                'success' => false,
                'message' => 'Debes indicar el asunto del mail'
            );
        }
    } else {
        $response = array(
            'success' => false,
            'message' => 'Debes indicar el remitente del mail'
        );
    }
    return $response;
}
