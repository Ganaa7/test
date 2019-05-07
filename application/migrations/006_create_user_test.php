<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_User_test extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),

                        'trainee_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'null' => false,
                        ),

                        'test_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'null' => false,
                        ),

                        'created_at' => array(
                                'type' => 'datetime',
                                'null' => true,
                        ),

                ));

                $this->dbforge->add_key('id', TRUE);

                $this->dbforge->create_table('user_test');
        }

        public function down()
        {
            $this->dbforge->drop_table('user_test');
        }
}
