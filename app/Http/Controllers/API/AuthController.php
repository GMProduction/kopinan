<?php


namespace App\Http\Controllers\API;


use App\Helper\CustomController;
use App\Models\User;
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
            $username = $this->postField('username');
            $password = $this->postField('password');

            $user = User::with([])
                ->where('username', '=', $username)
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

    public function register()
    {
        try {
            $username = $this->postField('username');
            $email = $this->postField('email');
            $name = $this->postField('name');
            $password = Hash::make($this->postField('password'));
            $role = 'member';
            $phone = $this->postField('phone');

            $data_request = [
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'password' => $password,
                'role' => $role,
                'phone' => $phone
            ];

            User::create($data_request);
            return $this->jsonSuccessResponse('success');
        }catch (\Exception $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }
}
