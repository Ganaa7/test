<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_trainee extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),

                        'firstname' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'lastname' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),

                        'register' => array(
                                'type' => 'varchar',
                                'constraint' => '10',
                        ),

                        'test_id' => array(
                                'type' => 'INT',
                                'null' => true,
                        ),

                        'user_test_id' => array(
                                'type' => 'INT',
                                'null' => true,
                        ),

                        'test_given' => array(
                                'type' => 'varchar',
                                'constraint' => '1',
                        ),

                        'test_score' => array(
                                'type' => 'float',
                                'null' => true,
                        ),

                        'given_at' => array(
                                'type' => 'datetime',
                                'null' => true,
                        ),

                        'created_at' => array(
                                'type' => 'datetime',
                                'null' => true,
                        ),

                ));

                $this->dbforge->add_key('id', TRUE);

                $this->dbforge->create_table('trainee');
        }

        public function down()
        {
           $this->dbforge->drop_table('trainee');
        }
}
