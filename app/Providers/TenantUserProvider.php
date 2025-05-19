<?php
namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class TenantUserProvider extends EloquentUserProvider
{
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return $user->getAuthIdentifier() === $credentials['phone']
            && $user->id_number === $credentials['id_number'];
    }
}
