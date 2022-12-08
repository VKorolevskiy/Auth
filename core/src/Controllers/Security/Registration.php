<?php

namespace App\Controllers\Security;

use App\Models\User;
use Psr\Http\Message\ResponseInterface;
use App\Controllers\PhpMail;


class Registration extends \Vesp\Controllers\Security\Login
{
    protected $model = User::class;
    public function post(): ResponseInterface
    {

        $username = trim($this->getProperty('username', ''));
        $password = trim($this->getProperty('password', ''));
        $fullname = trim($this->getProperty('fullname', ''));
        $email = trim($this->getProperty('email', ''));
        $code_action = rand(10000, 100000);  //  for sms or email  verificatio
        $subject = 'Finish creating your account on ' . getenv('APP_NAME');
        $messages = 'Almost there!<br>Your login code is:<br><b>'.$code_action.'</b>';



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
           // PhpMail::composeEmail($email, $fullname, $messages, $subject);
           return  $this->success($code);


        }
        else {
            return $this->failure('errors.security.active');
        }

    }
}
