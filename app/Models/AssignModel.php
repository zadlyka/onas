<?php

namespace App\Models;

use CodeIgniter\Model;

class AssignModel extends Model
{
    // ...
    protected $table = 'assign';
    protected $primaryKey = 'assignid';
    protected $useAutoIncrement = false;
    protected $useTimestamps = true;

    protected $allowedFields = ['assignid', 'roomid',    'userid',    'namaassign',    'namaroom',    'keterangan',    'nilai', 'file',    'pengirim'];
}
