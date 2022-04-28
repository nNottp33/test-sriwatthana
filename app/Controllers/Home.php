<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $roomModel;
    protected $appointModel;
    protected $db;
    
    public function __construct()
    {
        $forge = \Config\Database::forge();
        $forge->createDatabase(env('database.default.database'), true);
        $this->db = \Config\Database::connect();

        $this->roomModel =  new \App\Models\RoomModel();
        $this->appointModel =  new \App\Models\AppointModel();
    }

    public function index()
    {
        return view('booking');
    }

    public function getRoomList()
    {
        // if ($this->request->isAJAX()) {
        $data['room'] = $this->roomModel->findAll();
        $data['countRoom'] = $this->appointModel->select('COUNT(appoint.roomId) as total')->join('meetingRoom', 'meetingRoom.id = appoint.roomId')->groupBy('appoint.roomId')->findAll();

        echo "<pre>" ;
        print_r($data);
        die();

        $response = [
                'status' => 200,
                'message' =>'ดึงข้อมูลสำเร็จ',
                'data' => $data
            ];
       
        return $this->response->setJSON($response);
        // } else {
        //     $response = [
        //         'status' => 500,
        //         'message' =>'Server internal error',
        //         'data' => []
        //     ];
        //     return $this->response->setJSON($response);
        // }
    }
}
