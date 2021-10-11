<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $usermodel, $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->usermodel = new UserModel();
    }

    public function signup()
    {
        $this->usermodel->save([
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => md5($this->request->getPost('password'))
        ]);

        return redirect()->to('/Home');
    }

    public function login()
    {
        $user = $this->usermodel->where('email', $this->request->getPost('email'))->first();
        if ($user) {
            if ($user['password'] == md5($this->request->getPost('password'))) {
                $this->session->set('userid', $user['userid']);
                return redirect()->to('/home');
            } else {
                $this->session->setFlashData('alert', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning!</strong> Password yang diinput salah.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');

                $data = [
                    'active_menu' => 'home',
                    'statuslogin' => '',
                    'user' => null
                ];

                return view('content/home', $data);
            }
        } else {
            $this->session->setFlashData('alert', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> User tidak ditemukan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');

            $data = [
                'active_menu' => 'home',
                'statuslogin' => '',
                'user' => null
            ];

            return view('content/home', $data);
        }
    }

    public function edit($id)
    {
        $this->usermodel->save([
            'userid' => $id,
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => md5($this->request->getPost('password'))
        ]);

        return redirect()->to('/home');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/Home');
    }
}
