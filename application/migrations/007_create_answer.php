<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_answer extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),

                        'quiz_id' => array(
                                'type' => 'INT',
                                'constraint' => '11',
                        ),

                        'answer_num' => array(
                                'type' => 'SMALLINT',
                                'constraint' => '1'
                        ),

                        'answer' => array(
                                'type' => 'text',
                                'null' => false,
                        ),

                ));

                $this->dbforge->add_key('id', TRUE);

                $this->dbforge->create_table('answer');
        }

        public function down()
        {
            $this->dbforge->drop_table('answer');
        }
}
