<?php

namespace App\Auth\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Auth\Domain\User;

class EmailVerificationController extends Controller
{
    public function __invoke($id, $hash)
    {
        $user = User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->email))) {
            return response()->json([
                'message' => 'Link inválido'
            ], 403);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email já verificado,'
            ], 200);
        }

        $user->markEmailAsVerified();

        return response()->json([
            'message' => 'Email verificado com sucesso.',
        ], 200);
    }
}
