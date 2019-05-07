<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_quiz extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),

                        'test_id' => array(
                                'type' => 'INT',
                                'constraint' => '11',
                        ),

                        'diff' => array(
                                'type' => 'SMALLINT',
                                'null' => false,
                        ),

                        'quiz' => array(
                                'type' => 'text',
                                'null' => false,
                        ),

                        'right_answer_num' => array(
                                'type' => 'SMALLINT',
                                'constraint' => '1',
                        ),

                ));

                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('quiz');
        }

        public function down()
        {
            $this->dbforge->drop_table('quiz');
        }
}
