<?php
require '../helpers/response.helper.php';
require '../controllers/mail.controllers.php';
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        http_response_code(403);
        $response = array(
            'success' => false,
            'message' => 'Without authorization'
        );
        break;
    case 'POST':
        $message = [];

        if (!isset($_POST['name']) || empty($_POST['name'])) {
            array_push($message, 'Debes indicar tu nombre');
        }
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            array_push($message, 'Debes indicar tu email');
        }
        if (!isset($_POST['phone']) || empty($_POST['phone'])) {
            array_push($message, 'Debes indicar el asunto');
        }
        if (!isset($_POST['message']) || empty($_POST['message'])) {
            array_push($message, 'Debes indicar el mensaje');
        }

        if (count($message) === 0) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $message = $_POST['message'];
            $receiver = 'viosomos@gmail.com';
            if (isset($_POST['to']) && !empty($_POST['to'])) {
                $receiver = $_POST['to'];
            }

            $subject = 'Nuevo formulario de contacto recibido en la web';

            $content = '
                <h2>Nuevo contacto recibido desde la web</h2>
                <h3>Datos recopilados</h3>
                <table>
                    <tr>
                        <th>Nombre:</th>
                        <td>' . $name . '</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>' . $email . '</td>
                    </tr>
                    <tr>
                        <th>Telefono:</th>
                        <td>' . $phone . '</td>
                    </tr>
                    <tr>
                        <th>Mensaje:</th>
                        <td>' . $message . '</td>
                    </tr>
                </table>
            ';

            $response = send_mail($email, $receiver, $subject, $content);
        } else {
            // http_response_code(400);
            $response = array(
                'success' => false,
                'message' => 'Campos incompletos',
                'extra' => $message
            );
        }

        break;
    case 'DELETE':
        http_response_code(403);
        $response = array(
            'success' => false,
            'message' => 'Without authorization'
        );
        break;
    default:
        http_response_code(403);
        $response = array(
            'success' => false,
            'message' => 'Without authorization'
        );
        break;
}
print_all($response);