<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    // ...
    protected $table = 'user';
    protected $primaryKey = 'userid';
    protected $useAutoIncrement = true;

    protected $allowedFields = ['userid', 'nama', 'email', 'password'];
}
