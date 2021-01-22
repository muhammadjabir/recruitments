<?php
namespace App\Services\API\AuthServices;
use App\Models\User;

class RegisterServices {
    public function handle($request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->save();
        return $user;
    }
}
