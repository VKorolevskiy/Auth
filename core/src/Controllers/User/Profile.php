<?php

namespace App\Controllers\User;

use Psr\Http\Message\ResponseInterface;


class Profile extends \Vesp\Controllers\User\Profile
{
    protected $scope = 'profile';

    public function patch(): ResponseInterface
    {
        foreach (['username', 'fullname', 'phone', 'email'] as $key) {
            if ($value = trim($this->getProperty($key, ''))) {
                $this->user->setAttribute($key, $value);
            }
        }

        $oldpassword = trim($this->getProperty('oldpassword', ''));
        $newpassword = trim($this->getProperty('newpassword', ''));

        if($newpassword != '') {
            if ($this->user->verifyPassword($oldpassword)) {
                $this->user->setAttribute('password', $newpassword);
            }
            else {
                return $this->failure('Wrong password');
            }

        }



        $this->user->save();

        return $this->get();
    }
}
