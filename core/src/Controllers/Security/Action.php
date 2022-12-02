<?php

namespace App\Controllers\Security;

use App\Models\User;
use Psr\Http\Message\ResponseInterface;
use Vesp\Controllers\Controller;

class Action extends Controller
{
    public function post(): ResponseInterface
    {
        $action_code= trim($this->getProperty('action_code', ''));
        $id = trim($this->getProperty('id', ''));
        if ($user = User::query()->where('id', $id)->first()) {
            if ($user->code_verified_at == $action_code) {
                $user->setAttribute('active', 1);
                $user->save();
                return $this->success();
            }
        }

    }
}
