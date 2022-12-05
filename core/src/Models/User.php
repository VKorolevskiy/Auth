<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $fullname
 * @property string $email
 * @property string $code_verified
 * @property int $role_id
 * @property bool $active
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $code_verified_at
 * @property string $remember_token
 * @property-read UserToken[] $tokens
 */
class User extends \Vesp\Models\User
{
    protected $fillable = ['username', 'code_verified', 'phone', 'remember_token','password',  'fullname', 'email', 'role_id', 'active'];

    public function tokens(): HasMany
    {
        return $this->hasMany(UserToken::class);
    }
}
