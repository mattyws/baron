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
class Members_m extends MY_Model {

    public function __construct() {
        parent::__construct();       
        $this->_table = 'members';
    }
}
