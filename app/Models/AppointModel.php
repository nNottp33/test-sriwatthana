<?php
namespace App\Models;

use CodeIgniter\Model;

class AppointModel extends Model
{
    protected $table = 'appoint';
    protected $allowedFields = ['id', 'roomId', 'booker', 'createAt'];
}
