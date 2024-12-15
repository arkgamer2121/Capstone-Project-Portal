<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
                'unsigned' => true
            ],
            'first_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'last_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'birth_month' => ['type' => 'VARCHAR', 'constraint' => 20],
            'birth_day' => ['type' => 'INT'],
            'birth_year' => ['type' => 'INT'],
            'street_address' => ['type' => 'VARCHAR', 'constraint' => 255],
            'street_address2' => ['type' => 'VARCHAR', 'constraint' => 255],
            'city' => ['type' => 'VARCHAR', 'constraint' => 100],
            'state' => ['type' => 'VARCHAR', 'constraint' => 100],
            'postcode' => ['type' => 'VARCHAR', 'constraint' => 20],
            'phone_number' => ['type' => 'VARCHAR', 'constraint' => 20],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100],
            'emergency_contact_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'emergency_contact_phone' => ['type' => 'VARCHAR', 'constraint' => 20],
            'citizenship' => ['type' => 'VARCHAR', 'constraint' => 100],
            'veteran_status' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'disabilities' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'school_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'program_title' => ['type' => 'VARCHAR', 'constraint' => 100],
            'reports_to' => ['type' => 'VARCHAR', 'constraint' => 100],
            'employment_type' => ['type' => 'VARCHAR', 'constraint' => 50],
            'start_month' => ['type' => 'VARCHAR', 'constraint' => 20],
            'start_day' => ['type' => 'INT'],
            'start_year' => ['type' => 'INT'],
            'end_month' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'end_day' => ['type' => 'INT', 'null' => true],
            'end_year' => ['type' => 'INT', 'null' => true],
            'created_at' => ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('students');
    }

    public function down()
    {
        $this->forge->dropTable('students');
    }
}
