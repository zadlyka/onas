<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    // ...
    protected $table = 'file';
    protected $primaryKey = 'fileid';
    protected $useAutoIncrement = true;

    protected $allowedFields = ['fileid', 'assignid', 'namafile', 'keterangan'];
}
