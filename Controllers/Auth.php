<?php
namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController {
    public function login() {
        return view('auth/login');
    }

    public function processLogin() {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id'    => $user['id'],
                'full_name'  => $user['full_name'],
                'username'   => $user['username'],
                'avatar'     => $user['avatar'],
                'isLoggedIn' => true,
            ]);
            return redirect()->to('/products');
        }

        return redirect()->back()->with('error', 'Invalid username or password.');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }
}