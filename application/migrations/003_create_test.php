<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_test extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'test' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),

                        'created_at' => array(
                                'type' => 'datetime'
                        ),

                        'createdby_id' => array(
                                'type' => 'int',
                                'constraint' => '11',
                        ),


                ));

                $this->dbforge->add_key('id', TRUE);

                $this->dbforge->create_table('test');
        }

        public function down()
        {
              $this->dbforge->drop_table('test');
        }
}
