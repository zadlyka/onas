<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    protected $usermodel, $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->usermodel = new UserModel();
    }

    public function index()
    {
        $statuslogin = '';
        $user = null;

        if ($this->session->get("userid")) {
            $user = $this->usermodel->find($this->session->get("userid"));
            $statuslogin = 'login';
        }

        $data = [
            'active_menu' => 'home',
            'statuslogin' => $statuslogin,
            'user' => $user
        ];

        return view('content/home', $data);
    }
}
