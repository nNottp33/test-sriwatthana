<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Home extends BaseController
{
    protected $roomModel;
    protected $appointModel;
    protected $db;
    protected $time;
    
    public function __construct()
    {
        $forge = \Config\Database::forge();
        $forge->createDatabase(env('database.default.database'), true);
        $this->db = \Config\Database::connect();

        $this->time = Time::now('Asia/Bangkok', 'th');
        $this->roomModel =  new \App\Models\RoomModel();
        $this->appointModel =  new \App\Models\AppointModel();
    }

    public function index()
    {
        return view('booking');
    }

    public function getRoomList()
    {
        if ($this->request->isAJAX()) {
            $data = $this->roomModel->findAll();
            $countRoom =  $this->appointModel->select('COUNT(appoint.roomId) as total')->join('meetingRoom', 'meetingRoom.id = appoint.roomId')->groupBy('appoint.roomId')->findAll();
           
            for ($i = 0; $i < sizeof($data); $i++) {
                $data[$i]['total'] =  $count[$i]['total'] = $countRoom ? $countRoom[$i]['total'] : 0;

                if ($data[$i]['total'] >= $data[$i]['roomCapacity']) {
                    $this->roomModel->update($data[$i]['id'], ['status' => 1]);
                } else {
                    $this->roomModel->update($data[$i]['id'], ['status' => 0]);
                }
            }
        
            $response = [
                'status' => 200,
                'message' =>'ดึงข้อมูลสำเร็จ',
                'data' => $data,
            ];
       
            return $this->response->setJSON($response);
        } else {
            $response = [
                'status' => 500,
                'message' =>'Server internal error',
                'data' => []
            ];
            return $this->response->setJSON($response);
        }
    }

    public function appointRoom()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $booker = $this->request->getPost('booker');

            $data = [
                'roomId' => $id,
                'booker' => $booker,
                'createAt' => $this->time->getTimestamp()
            ];

            $getRoom = $this->roomModel->where('id', $id)->find();
            $checkRoom = $this->appointModel->select('COUNT(roomId) as total')->where('roomId', $id)->groupBy('roomId')->findAll();


            if ($checkRoom[0]['total'] >= $getRoom[0]['roomCapacity'] || $getRoom[0]['status'] == 1) {
                $response = [
                        'status' => 400,
                        'title' => 'Error',
                        'message' =>'ห้องเต็มแล้ว',
                    ];
                return $this->response->setJSON($response);
            } else {
                if ($this->appointModel->insert($data)) {
                    $response = [
                        'status' => 200,
                        'title' => 'Success',
                        'message' =>'จองห้องสำเร็จ',
                    ];

                    return $this->response->setJSON($response);
                } else {
                    $response = [
                        'status' => 404,
                        'title' => 'Error',
                        'message' =>'ไม่สามารถจองห้องได้',
                    ];

                    return $this->response->setJSON($response);
                }
            }
        } else {
            $response = [
                'status' => 500,
                'title' => 'Error',
                'message' =>'Server internal error',
                'data' => []
            ];
            return $this->response->setJSON($response);
        }
    }


    public function getBookedList()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $data = $this->appointModel->where('roomId', $id)->findAll();
           
            if ($data) {
                $response = [
                'status' => 200,
                'title' => 'Success',
                'message' =>'ดึงข้อมูลสำเร็จ',
                'data' => $data,
            ];

                return $this->response->setJSON($response);
            } else {
                $response = [
                'status' => 404,
                'title' => 'Error',
                'message' =>'ไม่พบข้อมูล',
                'data' => [],
            ];

                return $this->response->setJSON($response);
            }
        } else {
            $response = [
                'status' => 500,
                'title' => 'Error',
                'message' =>'Server internal error',
                'data' => []
            ];
            return $this->response->setJSON($response);
        }
    }
    public function getBookerName()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $data = $this->appointModel->where('id', $id)->findColumn('booker');
             
            if ($data) {
                $response = [
                    'status' => 200,
                    'title' => 'Success',
                    'message' =>'ดึงข้อมูลสำเร็จ',
                    'data' => $data,
                ];
    
                return $this->response->setJSON($response);
            } else {
                $response = [
                    'status' => 404,
                    'title' => 'Error',
                    'message' =>'ไม่พบข้อมูล',
                    'data' => [],
                ];
    
                return $this->response->setJSON($response);
            }
        } else {
            $response = [
                'status' => 500,
                'title' => 'Error',
                'message' =>'Server internal error',
                'data' => []
            ];
            return $this->response->setJSON($response);
        }
    }

    public function editBooked()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $booker = $this->request->getPost('booker');

            $data = [
                'booker' => $booker
            ];

            if ($this->appointModel->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'title' => 'Success',
                    'message' =>'แก้ไขข้อมูลสำเร็จ',
                ];

                return $this->response->setJSON($response);
            } else {
                $response = [
                    'status' => 404,
                    'title' => 'Error',
                    'message' =>'ไม่สามารถแก้ไขข้อมูลได้',
                ];

                return $this->response->setJSON($response);
            }
        } else {
            $response = [
                'status' => 500,
                'title' => 'Error',
                'message' =>'Server internal error',
                'data' => []
            ];
            return $this->response->setJSON($response);
        }
    }
    public function deleteBooked()
    {
        if ($this->request->isAJAX()) {
            if ($this->appointModel->where('id', $this->request->getPost('id'))->delete()) {
                $response = [
                'status' => 200,
                'title' => 'Success',
                'message' =>'ลบข้อมูลสำเร็จ',
                'data' => [],
            ];
                return $this->response->setJSON($response);
            } else {
                $response = [
                'status' => 404,
                'title' => 'Error',
                'message' =>'ไม่สามารถลบข้อมูลได้',
                'data' => [],
            ];
                return $this->response->setJSON($response);
            }
        } else {
            $response = [
                'status' => 500,
                'title' => 'Error',
                'message' =>'Server internal error',
                'data' => []
            ];
            return $this->response->setJSON($response);
        }
    }
}
