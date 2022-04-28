<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Appoint extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        if (!$db->tableExists('appoint')) {
            $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'roomId'       => [
                'type'       => 'INT',
                'constraint' => '3',
            ],
            'booker' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
            ],
            'createAt' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            ]);

            $this->forge->addKey('id', true);
            $this->forge->createTable('appoint');
        }
    }

    public function down()
    {
        $this->forge->dropTable('appoint');
    }
}
