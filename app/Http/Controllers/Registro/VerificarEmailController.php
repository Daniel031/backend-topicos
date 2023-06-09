<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Carbon\Carbon;

use App\Models\User;

class VerificarEmailController extends Controller
{
    

    public function formularioDatos(){
        return view('formulario');
    }


    public function enviar(Request $request){
            // $email = $request['email'];
            // $mensaje = $request['mensaje'];

            // $mail = new PHPMailer(true);

            // try {
            //     //Server settings
            //     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            //     $mail->isSMTP();                                            //Send using SMTP
            //     $mail->Host       = 'smtp.gmail.com';                    //Set the SMTP server to send through
            //     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            //     $mail->Username   = 'dilker72@gmail.com';                     //SMTP username
            //     $mail->Password   = 'opfexbzzwbbagutj';                               //SMTP password
            //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            //     $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //     //Recipients
            //     $mail->setFrom('dilker72@gmail.com', 'Denuncias Santa Cruz');
            //     $mail->addAddress($email);     //Add a recipient
            //     // $mail->addAddress('ellen@example.com');               //Name is optional
            //     // $mail->addReplyTo('info@example.com', 'Information');
            //     // $mail->addCC('cc@example.com');
            //     // $mail->addBCC('bcc@example.com');

            //     //Attachments
            //     // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //     // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //     //Content
            //     $mail->isHTML(true);                                  //Set email format to HTML
            //     $mail->Subject = 'Test Mailer';
            //     $mail->Body    = $mensaje.' '.Carbon::now();
            //     // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            //     $mail->send();
            //     echo 'Message has been sent';
            // } catch (Exception $e) {
            //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            // }


    }

    public function emailNoRegistrado(Request $request) {
        $email = $request['email'];
        $user = User::where('email', $request['email'])->first();
        if ($user) {
            if ($user->email_verified_at) {
                return response()->json([
                    'res' => false,
                    'mensaje' => 'El usuario ya se encuentra registrado'
                ],409);
            }else{
                return response()->json([
                    'res' => true,
                    'mensaje' => 'El usuario necesita verificar su correo'
                ],200);
            }
        } else {
            return response()->json([
                'res' => false,
                'mensaje' => 'El usuario no se encuentra registrado'
            ],400);
        }
    }

    //metodo que escribio jose luis padilla
    public function VerificarCodigoEmail(Request $request){

        $email = $request['email'];
        $codigo = $request['codigo_verificacion'];

        $user = User::where('email', $request['email'])->first();

        if($user){

            if($user->codigo_verificacion == $codigo){
                $fechaActual = Carbon::now();
                $user->email_verified_at = $fechaActual;
                $user->save();
                return response()->json([
                    'res' => true,
                    'mensaje' => "el codigo fue verificado correctamente",
                ]);
            }else{
                return response()->json([
                    'res' => false,
                    'mensaje' => "el codigo no pudo ser verficado",
                ]);
            }

        }

        return response()->json([
            'res' => false,
            'mensaje' => "el correo electronico no pertenence a ningun usuario",
        ]);

    }
}
