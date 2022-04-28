<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use \CodeIgniter\I18n\Time;
use App\Models\RoomModel;

class RoomSeed extends Seeder
{
    public function run()
    {
        $RoomModel = new RoomModel();

        $time = Time::now('Asia/Bangkok', 'th');

        $data = [
      [
        'roomName'        => 'ห้อง P',
        'roomCapacity'     => '8',
        'createAt'  => $time->getTimestamp(),
      ],
      [
        'roomName'        => 'ห้อง I',
        'roomCapacity'    => '6',
        'createAt'  => $time->getTimestamp(),
      ],
      [
        'roomName'       => 'ห้อง E',
        'roomCapacity'   => '30',
        'createAt'  => $time->getTimestamp(),
      ]
    ];

        // Using Query Builder
        $RoomModel->insertBatch($data);
    }
}
