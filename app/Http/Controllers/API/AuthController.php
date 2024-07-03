<?php


namespace App\Http\Controllers\API;


use App\Helper\CustomController;
use http\Client\Curl\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        try {
            $email = $this->postField('email');
            $password = $this->postField('password');

            $user = User::with([])
                ->where('username', '=', $email)
                ->first();
            if (!$user) {
                return $this->jsonNotFoundResponse('user not found!');
            }

            $isPasswordValid = Hash::check($password, $user->password);
            if (!$isPasswordValid) {
                return $this->jsonUnauthorizedResponse('username and password did not match...');
            }

            $token = auth('api')->setTTL(null)->tokenById($user->id);
            return $this->jsonSuccessResponse('success', [
                'access_token' => $token
            ]);
        } catch (\Exception $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }
}
