<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'=>'INT',
                'auto_increment'=>true
            ],
            'name'=>[
                'type'=>'VARCHAR',
                'constraint'=>50
            ],
            'mobile'=>[
                'type'=>'VARCHAR',
                'constraint'=>50,
            ],
            'email'=>[
                'type'=>'VARCHAR',
                'constraint'=>100,
            ],
            'status'=>[
                'type'=>'tinyint',
                'constraint' => 1,
                'default'=>'1'
            ],
            'createdat datetime default current_timestamp',
            'updatedat datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('customers');
    }

    public function down()
    {
        $this->forge->dropTable('customers');
    }
}
