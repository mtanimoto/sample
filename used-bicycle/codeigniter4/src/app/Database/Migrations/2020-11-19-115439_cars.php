<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cars extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'     => [
                    'type'           => 'CHAR',
                    'constraint'     => 32,
            ],
            'type'   => [
                    'type'           => 'TEXT',
            ],
            'price'  => [
                    'type'           => 'INT',
                    'constraint'     => 32,
            ],
            'color'  => [
                    'type'           => 'TEXT',
            ],
            'remark' => [
                    'type'           => 'TEXT',
                    'null'           => true,
            ],
            'status' => [
                    'type'           => 'ENUM',
                    'constraint'     => ['onsale', 'sold'],
                    'default'        => 'onsale',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cars');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('cars');
    }
}
