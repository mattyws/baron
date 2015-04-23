<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This is a members module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        // Load all the required classes
        $this->load->model('members_m');
        $this->load->library('form_validation');
        $this->lang->load('members');
        // Set the validation rules
        $this->validation_rules = array(
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
     * List all items
     */
    public function index() {
        // here we use MY_Model's get_all() method to fetch everything
        $members = $this->members_m->get_all();
        // Build the view with members/views/admin/items.php
        $this->template
                ->title($this->module_details['name'])
                ->set('members', $members)
                ->build('admin/index');
    }

    public function doPayment($id = 0) {
        $member = $this->members_m->get($id);
        $member OR redirect('admin/members');

        $today = new DateTime();
        $today = $today->format("Y-m-d");
        $nextPayment = new DateTime();
        $nextPayment->add(new DateInterval('P6M'));
        $nextPayment = $nextPayment->format("Y-m-d");
        $member->payment = $today;
        $member->nextPayment = $nextPayment;
        if ($this->members_m->update($id, $member)) {
            Events::trigger('member_updated', $id);
            $this->session->set_flashdata('success', sprintf(lang('members:edit_success'), $member->name));
            redirect('admin/members');
        } else {
            $this->session->set_flashdata('error', sprintf(lang('members:edit_error'), $member->name));
            redirect('admin/members' . $id);
        }
    }

    public function edit($id = 0) {
        $member = $this->members_m->get($id);

        // Make sure we found something
        $member or redirect('admin/members');

        if ($_POST) {
            $post = $this->input->post();
            unset($post['btnAction']);
            if (!$this->upload->do_upload()) {
                $post['absolute'] = $member->absolute;
                $post['relative'] = $member->relative;
            } else {
                $data = $this->upload->data();
                $post['absolute'] = $data['full_path'];
                $post['relative'] = './uploads/members/' . $data['file_name'];
                if (strcmp($member->relative, "./uploads/members/nophoto.jpg")) {
                    unlink($member->absolute);
                }
            }
            $this->form_validation->set_rules($this->validation_rules);

            $name = $this->input->post('name');
            if ($this->form_validation->run()) {
                $d = DateTime::createFromFormat("d/m/Y", $post['payment']);
                $post['payment'] = $d->format("Y-m-d"); // or any you want
                $d = DateTime::createFromFormat("d/m/Y", $post['nextPayment']);
                $post['nextPayment'] = $d->format("Y-m-d"); // or any you want                
                if ($this->members_m->update($post['id'], $post)) {
                    Events::trigger('member_updated', $id);
                    $this->session->set_flashdata('success', sprintf(lang('members:edit_success'), $name));
                    redirect('admin/members');
                } else {
                    $this->session->set_flashdata('error', sprintf(lang('members:edit_error'), $name));
                    redirect('admin/members/edit/' . $id);
                }
            }
        }
        $member->payment = date("d/m/Y", strtotime($member->payment));
        $member->nextPayment = date("d/m/Y", strtotime($member->nextPayment));
        $this->template
                ->set('member', $member)
                ->build('admin/form');
    }

}
