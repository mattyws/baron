<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Members extends Public_Controller {

    public function __construct() {
        parent::__construct();
        // Load all the required classes
        $this->load->model('members_m');
        $this->load->library('form_validation');
        $this->lang->load('members');
        // Set the validation rules
        $this->item_validation_rules = array(
            array(
                'field' => 'name',
                'label' => 'members::name',
                'rules' => 'trim|max_length[70]|required'
            ),
            array(
                'field' => 'course',
                'label' => 'members::course',
                'rules' => 'trim|max_length[70]|required'
            ),
            array(
                'field' => 'campus',
                'label' => 'members::campus',
                'rules' => 'trim|max_length[70]|required'
            ),
            array(
                'field' => 'rga',
                'label' => 'members::rga',
                'rules' => 'trim|max_length[15]|required'
            ),
            array(
                'field' => 'tel',
                'label' => 'members::tel',
                'rules' => 'trim|max_length[15]|required'
            ),
            array(
                'field' => 'birth',
                'label' => 'members::birth',
                'rules' => 'trim|max_length[15]|required'
            ),
            array(
                'field' => 'email',
                'label' => 'members::email',
                'rules' => 'trim|max_length[100]|required'
            ),
        );
        // We'll set the partials and metadata here since they're used everywhere
        $config['upload_path'] = './uploads/members/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '300';
        $config['max_width'] = '2048';
        $config['max_height'] = '1600';

        $this->load->library('upload', $config);
        $this->template->append_css('module::members.css')->append_js('module::mask.js');
    }

    /**
     * Display the register form
     */
    public function index() {
        // Build the view with sample/views/admin/items.php        
        $this->template
                ->title($this->module_details['name'])
                ->build('register');
    }

    public function register() {
        // Set the validation rules from the array above
        $this->form_validation->set_rules($this->item_validation_rules);
        $member = array();
        // check if the form validation passed
        if ($this->form_validation->run()) {
            # TODO : passar a variável $post para $member            
            $this->upload->do_upload("userfile");
            $data = $this->upload->data();
            $post = $this->input->post();
            $post['absolute'] = $data['full_path'];
            $post['relative'] = './uploads/members/' . $data['file_name'];
            if (!($data['file_name'])) {
                $post['absolute'] = $post['absolute'] . "nophoto.jpg";
                $post['relative'] = $post['relative'] . "nophoto.jpg";
            }

            if ($this->members_m->insert($post)) {
                redirect('members/register');
            } else {                
                redirect('members/register');
            }
        }
        $this->template
                ->set('member', $member)
                ->build('register');
    }

}
