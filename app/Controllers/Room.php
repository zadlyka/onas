<?php

namespace App\Controllers;

use App\Models\AssignModel;
use App\Models\RoomModel;
use App\Models\UserModel;

class Room extends BaseController
{
    protected $assignmodel, $usermodel, $roommodel, $session;
    public function __construct()
    {
        helper('text');
        $this->assignmodel = new AssignModel();
        $this->roommodel = new RoomModel();
        $this->usermodel = new UserModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $statuslogin = '';
        $user = null;

        if ($this->session->get("userid")) {
            $user = $this->usermodel->find($this->session->get("userid"));
            $statuslogin = 'login';
        } else {
            $this->session->setFlashData('alert', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning!</strong> Silahkan login terlebih dahulu.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');

            $data = [
                'active_menu' => 'home',
                'statuslogin' => '',
                'user' => null
            ];

            return view('content/home', $data);
        }

        $data = [
            'active_menu' => 'room',
            'room' => $this->roommodel->where('userid', $user['userid'])->findAll(),
            'statuslogin' => $statuslogin,
            'user' => $user
        ];

        return view('content/room', $data);
    }

    public function create()
    {
        do {
            $roomid = random_string('alnum', 30);
            $this->roommodel->save([
                'roomid' => $roomid,
                'namaroom' => $this->request->getPost('nama'),
                'keterangan' => $this->request->getPost('keterangan'),
                'pembuat' => $this->request->getPost('pembuat'),
                'userid' => $this->request->getPost('userid')
            ]);
        } while (!$this->roommodel->find($roomid));

        $this->session->setFlashData('alert', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <h5>Room telah dibuat</h5>
            <p>Code Room : <strong>' . $roomid . '</strong></p> 
            <h6 class="text-danger">*Bagikan code room untuk upload tugas</h6>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

        return redirect()->to('/Room');
    }

    public function edit()
    {
        $this->roommodel->save([
            'roomid' => $this->request->getPost('roomid'),
            'namaroom' => $this->request->getPost('nama'),
            'keterangan' => $this->request->getPost('keterangan')
        ]);

        return redirect()->to('/Room/detail/' . $this->request->getPost('roomid'));
    }

    public function delete($id)
    {
        $this->roommodel->delete($id);
        return redirect()->to('/Room');
    }

    public function detail($id)
    {
        $statuslogin = '';
        $user = null;

        $room = $this->roommodel->find($id);

        if ($this->session->get("userid")) {
            $user = $this->usermodel->find($this->session->get("userid"));
            $statuslogin = 'login';
        } else {
            $this->session->setFlashData('alert', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning!</strong> Silahkan login terlebih dahulu.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');

            $data = [
                'active_menu' => 'home',
                'statuslogin' => '',
                'user' => null
            ];

            return view('content/home', $data);
        }

        $data = [
            'active_menu' => 'room',
            'room' => $room,
            'assign' => $this->assignmodel->where('roomid', $room['roomid'])->findAll(),
            'statuslogin' => $statuslogin,
            'user' => $user
        ];
        return view('content/room_detail', $data);
    }
}
