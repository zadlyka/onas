<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    // ...
    protected $table = 'room';
    protected $primaryKey = 'roomid';
    protected $useAutoIncrement = false;

    protected $allowedFields = ['roomid', 'namaroom', 'keterangan', 'pembuat', 'userid'];
}
