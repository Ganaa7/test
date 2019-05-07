<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users extends CI_Migration {

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
                        'username' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),                        
                        'email' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'group' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'password' => array(
                           
                           'type' => 'VARCHAR',

                           'constraint' => '100',                                
                        ),
                        'recovery' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),

                        'created_at' => array(
                                'type' => 'datetime'                                
                        ),
                ));

                $this->dbforge->add_key('id', TRUE);
                
                $this->dbforge->create_table('users');
        }

        public function down()
        {
                $this->dbforge->drop_table('users');
        }
}