<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MeetingRoom extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        if (!$db->tableExists('meettingRoom')) {
            $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'roomName'       => [
                'type'       => 'VARCHAR',
                'constraint' => '45',
            ],
            'roomCapacity' => [
                'type' => 'INT',
                'constraint'     => 3,
            ],
            'createAt' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'status' => [
                'type' => 'INT',
                'constraint'     => '1',
                'default' => '0',
            ],
        ]);

            $this->forge->addKey('id', true);
            $this->forge->createTable('meetingRoom');
        }
    }

    public function down()
    {
        $this->forge->dropTable('meetingRoom');
    }
}
