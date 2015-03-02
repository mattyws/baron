<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Theme_Baroes extends Theme {

    public $name			= 'Barões';
    public $author			= 'Infocorp Contultoria';
    public $author_website	= 'http://infocorpconsultoria.com.br';    
    public $description		= 'Tema do site Barões baseado no tema default.';
    public $version			= '1.0.0';
	public $options 		= array('show_breadcrumbs' => 	array('title' 		=> 'Show Breadcrumbs',
																'description'   => 'Would you like to display breadcrumbs?',
																'default'       => 'yes',
																'type'          => 'radio',
																'options'       => 'yes=Yes|no=No',
																'is_required'   => true),
									'layout' => 			array('title' => 'Layout',
																'description'   => 'Which type of layout shall we use?',
																'default'       => '2 column',
																'type'          => 'select',
																'options'       => '2 column=Two Column|full-width=Full Width|full-width-home=Full Width Home Page',
																'is_required'   => true),
								   );
}

/* End of file theme.php */
