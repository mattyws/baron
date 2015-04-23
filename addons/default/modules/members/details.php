<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_Members extends Module {

    public $version = '1.0';

    public function info() {
        return array(
            'name' => array(
                'en' => 'Membros',
                'pt' => 'Membros'
            ),
            'description' => array(
                'en' => 'This module manages the members.',
                'pt' => 'Este módulo é para gerenciamento de membros.'
            ),
            'frontend' => TRUE,
            'backend' => TRUE,
            'menu' => 'content', // You can also place modules in their top level menu. For example try: 'menu' => 'Sample',            
        );
    }

    public function install() {
        $this->dbforge->drop_table('members');
        $sample = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '70'
            ),
            'course' => array(
                'type' => 'VARCHAR',
                'constraint' => '70'
            ),
            'relative' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'absolute' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'campus' => array(
                'type' => 'VARCHAR',
                'constraint' => '70'
            ),
            'rga' => array(
                'type' => 'VARCHAR',
                'constraint' => '15'
            ),
            'tel' => array(
                'type' => 'VARCHAR',
                'constraint' => '15'
            ),
            'birth' => array(
                'type' => 'VARCHAR',
                'constraint' => '15'
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'payment' => array(
                'type' => 'date',
                'null' => TRUE
            ),
            'nextPayment' => array(
                'type' => 'date',
                'null' => TRUE
            ),
        );
        $this->dbforge->add_key('id', TRUE);
        if ($this->dbforge->create_table('members') AND
                is_dir($this->upload_path . 'members') OR @ mkdir($this->upload_path . 'members', 0777, TRUE)) {
            return TRUE;
        }
    }

    public function uninstall() {
        $this->dbforge->drop_table('members');
        return TRUE;
    }

    public function upgrade($old_version) {
        // Your Upgrade Logic
        return TRUE;
    }

    public function help() {
        // Return a string containing help info
        // You could include a file and return it here.
        return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
    }

}

/* End of file details.php */