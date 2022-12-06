<?php

namespace App\Controllers\Security;

use App\Models\User;
use Psr\Http\Message\ResponseInterface;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Registration extends \Vesp\Controllers\Security\Login
{
    protected $model = User::class;
    public function post(): ResponseInterface
    {

        $username = trim($this->getProperty('username', ''));
        $password = trim($this->getProperty('password', ''));
        $fullname = trim($this->getProperty('fullname', ''));
        $email = trim($this->getProperty('email', ''));
        $code_action = '12345'; //  for sms or email  verificatio


        $mail = new PHPMailer(true);

            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = getenv('APP_SMTP_HOST');
            $mail->SMTPAuth   = true;
            $mail->Username   = getenv('APP_SMTP_USERNAME');
            $mail->Password   = getenv('APP_SMTP_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->setFrom(getenv('APP_SMTP_USERNAME'), getenv('APP_NAME'));
            $mail->addAddress($email, $fullname);     //Add a recipient
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Finish creating your account on '.getenv('APP_NAME');
            $mail->Body    = 'Almost there!<br>Your login code is:<br><b>'.$code_action.'</b>';
            $mail->send();


        $data = [
            'password' => $password,
            'fullname' => $fullname,
            'email' => $email,
            'role_id' => 2,
            'active' => 0,
            'code_verified' => $code_action,
        ];

        if (!$user = User::query()->where('username', $username)->first()) {
            $user = new User(['username' => $username]);
            $user->fill($data);
            $user->save();
        }

        if ($user = User::query()->where(['username' => $username, 'active' => 0])->first()) {
            $code = ['id' => $user->id];
            return $this->success($code);
        }
        else {
            return $this->failure('errors.security.active');
        }

    }
}
