<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUniqueConstraintToCoursesSections extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('courses_sections', [
            'section' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'unique' => true, // Add this line to enforce uniqueness
            ],
        ]);

        // You can also create a unique composite key
        $this->forge->addUniqueKey(['course', 'year', 'section']);
    }

    public function down()
    {
        // Remove unique constraint
        $this->forge->dropUniqueKey('courses_sections', ['course', 'year', 'section']);
    }
}

