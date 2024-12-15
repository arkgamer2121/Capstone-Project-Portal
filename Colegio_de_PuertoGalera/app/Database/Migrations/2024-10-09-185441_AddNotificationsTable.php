<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNotificationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'message' => ['type' => 'TEXT'],
            'is_read' => ['type' => 'BOOLEAN', 'default' => false],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('notifications');
    }
    
    public function down()
    {
        $this->forge->dropTable('notifications');
    }
}    