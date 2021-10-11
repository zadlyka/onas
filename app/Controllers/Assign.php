<?php

namespace App\Controllers;

use App\Models\AssignModel;
use App\Models\RoomModel;
use App\Models\UserModel;
use App\Models\FileModel;


class Assign extends BaseController
{
    protected $assignmodel, $roommodel, $filemodel, $session;
    public function __construct()
    {
        helper('text');
        $this->assignmodel = new AssignModel();
        $this->roommodel = new RoomModel();
        $this->filemodel = new FileModel();
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
            'active_menu' => 'assign',
            'assign' => $this->assignmodel->where('userid', $user['userid'])->findAll(),
            'statuslogin' => $statuslogin,
            'user' => $user
        ];

        return view('content/assignment', $data);
    }

    public function detail($id)
    {
        $statuslogin = '';
        $user = null;
        $assign = $this->assignmodel->find($id);

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
            'active_menu' => 'assign',
            'assign' => $assign,
            'file'  => $this->filemodel->where('assignid', $assign['assignid'])->findAll(),
            'statuslogin' => $statuslogin,
            'user' => $user
        ];
        return view('content/assign_detail', $data);
    }

    public function create()
    {
        $room = $this->roommodel->find($this->request->getPost('code'));
        if ($room) {
            do {
                $assignid = random_string('alnum', 30);
                $this->assignmodel->save([
                    'assignid' => $assignid,
                    'roomid' => $this->request->getPost('code'),
                    'userid' => $this->request->getPost('userid'),
                    'namaassign' => $this->request->getPost('nama'),
                    'namaroom' => $room['namaroom'],
                    'keterangan' => $this->request->getPost('keterangan'),
                    'nilai' => '',
                    'file' => '',
                    'pengirim' => $this->request->getPost('pengirim')
                ]);
            } while (!$this->assignmodel->find($assignid));

            $this->session->setFlashData('alert', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h5>Assignment telah dibuat</h5>
                <p>Nama Room : <strong>' . $room['namaroom'] . '</strong></p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        } else {
            $this->session->setFlashData('alert', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> Room tidak ditemukan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        }

        return redirect()->to('/Assign');
    }

    public function edit()
    {
        $room = $this->roommodel->find($this->request->getPost('code'));
        if ($room) {
            do {
                $this->assignmodel->save([
                    'assignid' => $this->request->getPost('assignid'),
                    'roomid' => $this->request->getPost('code'),
                    'namaassign' => $this->request->getPost('nama'),
                    'namaroom' => $room['namaroom'],
                    'keterangan' => $this->request->getPost('keterangan')
                ]);
            } while (!$this->assignmodel->find($this->request->getPost('assignid')));
        } else {
            $this->session->setFlashData('alert', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> Room tidak ditemukan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        }

        return redirect()->to('/Assign/detail/' . $this->request->getPost('assignid'));
    }

    public function delete($id)
    {
        $file = $this->filemodel->where('assignid', $id)->findAll();

        foreach ($file as $data) {
            unlink('file/' . $data['namafile']);
        }

        $this->assignmodel->delete($id);
        return redirect()->to('/Assign');
    }

    public function deleteassign($assignid, $roomid)
    {
        $file = $this->filemodel->where('assignid', $assignid)->findAll();

        foreach ($file as $data) {
            unlink('file/' . $data['namafile']);
        }

        $this->assignmodel->delete($assignid);
        return redirect()->to('/room/detail/' . $roomid);
    }

    public function setnilai()
    {
        $this->assignmodel->save([
            'assignid' => $this->request->getPost('assignid'),
            'nilai' => $this->request->getPost('nilai'),
        ]);

        return redirect()->to('/room/detail/' . $this->request->getPost('roomid'));
    }

    public function setfilefinal($id)
    {
        $file = $this->filemodel->find($id);
        $this->assignmodel->save([
            'assignid' => $file['assignid'],
            'file' => $file['namafile'],
        ]);

        $this->session->setFlashData('alert', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>' . $file['namafile'] . '</strong> merupakan file final.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

        return redirect()->to('/Assign/detail/' . $file['assignid']);
    }

    public function upload()
    {
        $file = $this->request->getFile('file');

        $filevalidate = $this->validate([
            'file' => [
                'uploaded[file]',
                'ext_in[file,png,jpg,pdf,csv,txt,doc,docx,ppt,pptx,xls,xlsx,zip,rar]',
                'max_size[file,4096]',
            ]
        ]);

        if (!$filevalidate) {
            $this->session->setFlashData('alert', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning!</strong> File tidak sesuai requirement.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
        } else {
            $this->filemodel->save([
                'assignid' => $this->request->getPost('assignid'),
                'namafile' => $file->getName(),
                'keterangan' => $this->request->getPost('keterangan'),
            ]);

            $file->move('file', $file->getName());

            $this->session->setFlashData('alert', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning!</strong> Set final pada file yang ingin dikirim pada room.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
        }

        return redirect()->to('/Assign/detail/' . $this->request->getPost('assignid'));
    }

    public function deletefile($id)
    {
        $file = $this->filemodel->find($id);

        $this->assignmodel->save([
            'assignid' => $file['assignid'],
            'file' => ''
        ]);

        $this->filemodel->delete($id);
        unlink('file/' . $file['namafile']);
        return redirect()->to('/Assign/detail/' . $file['assignid']);
    }

    public function downloadfile($id)
    {
        $file = $this->filemodel->find($id);
        return $this->response->download('file/' . $file['namafile'], null);
    }

    public function downloadpetunjuk()
    {
        return $this->response->download('file/Petunjuk.pdf', null);
    }

    public function downloadfinalfile($id)
    {
        $file = $this->assignmodel->find($id);
        return $this->response->download('file/' . $file['file'], null);
    }
}
