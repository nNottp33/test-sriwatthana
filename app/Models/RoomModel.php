<?php
namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    protected $table = 'meetingRoom';
    protected $allowedFields = ['id', 'roomName', 'roomCapacity', 'createAt', 'status'];
}
