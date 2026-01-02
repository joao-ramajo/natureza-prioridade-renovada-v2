<?php declare(strict_types=1);

namespace App\Action\Auth;

use App\Exceptions\AuthException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginAction
{
    public function execute(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new AuthException(AuthException::invalidCredentials(), 401);
        }

        $token = $user->createToken('api')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }
}
