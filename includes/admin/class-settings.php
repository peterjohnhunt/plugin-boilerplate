<?php

//░░░░░░░░░░░░░░░░░░░░░░░░
//
//     DIRECTORY
//
//     _Constructor
//     _Page
//       ∟AddPage
//       ∟RenderPage
//     _Styles
//     _Scripts
//     _Settings
//       ∟RegisterSettings
//       ∟RenderSettings
//       ∟SaveSetting
//
//░░░░░░░░░░░░░░░░░░░░░░░░

namespace PLUGIN_NAMESPACE\Includes\Admin;

Class Settings{

	private $version;

	private $prefix;

	private $label;

	private $slug;

	private $fields;

	//≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡
	// _Constructor
	//≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡
	public function __construct($args="Plugin Settings"){
		$this->version = PLUGIN_GLOBAL_VERSION;
		$this->prefix  = PLUGIN_GLOBAL_PREFIX;

		if (!is_array($args)) {
			$args = array('label' => $args);
		}

		$args = wp_parse_args( $args, array(
			'slug'   => sanitize_title($args['label']),
			'fields' => array(),
		) );

		$this->label  = $args['label'];
		$this->slug   = $args['slug'];
		$this->fields = array();

		if ( $args['fields'] ) {
			foreach ($args['fields'] as $field_label => $field_args) {

				if ( !is_array($field_args) ) {
					$field_label = $field_args;
					$field_args  = array();
				}

				$this->fields[] = wp_parse_args( $field_args, array(
					'option' => $this->slug,
					'label'  => $field_label,
					'slug'   => sanitize_title($field_label),
					'type'   => sanitize_title($field_label),
				) );
			}
		}
	}


	//≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡
	// _Page
	//≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡
	//∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
	// ∟AddPage
	//∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
	public function add_page(){
		add_options_page(
			$this->label,
			$this->label,
			'manage_options',
			$this->slug,
			array($this, 'render_page')
		);
	}

	//∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
	// ∟RenderPage
	//∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
	public function render_page() {
		PLUGIN_PREFIX_locate_template(array(
			"admin/settings/{$this->slug}/settings.php",
			"admin/settings/settings.php"
		), true);
	}


	//≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡
	// _Styles
	//≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡
	public function enqueue_styles( $page ) {
		if ( 'settings_page_'.$this->slug !== $page) return;

		wp_enqueue_style(
			"{$this->prefix}-admin-settings-{$this->slug}",
			PLUGIN_PREFIX_get_asset("settings.{$this->slug}.min.css", 'css'),
			array(),
			$this->version,
			false
		);
	}


	//≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡
	// _Scripts
	//≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡
	public function enqueue_scripts( $page ) {
		if ( 'settings_page_'.$this->slug !== $page) return;

		wp_enqueue_script(
			"{$this->prefix}-admin-settings-{$this->slug}",
			PLUGIN_PREFIX_get_asset("settings.{$this->slug}.min.js", 'js'),
			array(),
			$this->version,
			false
		);
	}


	//≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡
	// _Settings
	//≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡
	//∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
	// ∟RegisterSettings
	//∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
	public function register_settings() {
		register_setting( $this->slug, $this->slug, array($this, 'save_fields') );

		add_settings_section(
			"{$this->slug}_section",
			false,
			false,
			$this->slug
		);

		if ( !empty($this->fields) ) {
			foreach ($this->fields as $field) {
				add_settings_field(
					$field['slug'],
					$field['label'],
					array($this, 'render_field'),
					$field['option'],
					"{$field['option']}_section",
					$field
				);
			}
		}
	}

	//∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
	// ∟RenderSettings
	//∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
	public function render_field($args){
		extract($args);
		include(PLUGIN_PREFIX_locate_template(array(
			"admin/settings/{$option}/fields/{$type}.php",
			"admin/settings/fields/{$type}.php"
		)));
	}

	//∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
	// ∟SaveSettings
	//∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
	public function save_fields($input){
		$save = array();

		if ( !empty($this->fields) ) {
			foreach ($this->fields as $field) {
				if (isset($input[$field['slug']])) {
					$save[$field['slug']] = $input[$field['slug']];
				}
			}
		}

		return $save;
	}
}