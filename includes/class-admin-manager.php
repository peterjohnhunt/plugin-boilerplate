<?php

//░░░░░░░░░░░░░░░░░░░░░░░░
//
//     DIRECTORY
//
//     _Constructor
//
//░░░░░░░░░░░░░░░░░░░░░░░░

namespace PLUGIN_NAMESPACE\Includes;
	  use PLUGIN_NAMESPACE\Includes\Admin;

Class Admin_Manager{

	private $version;

	public $settings;

	//≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡
	// _Constructor
	//≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡
	public function __construct(){
		$this->version = PLUGIN_GLOBAL_VERSION;

		$this->settings = new Admin\Settings(array(
			'label'  => 'PLUGIN_LABEL',
			'slug'   => 'PLUGIN_SLUG',
			'fields' => array(
				'Field'
			)
		));
	}
}