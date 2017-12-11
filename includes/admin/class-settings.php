<?php

//░░░░░░░░░░░░░░░░░░░░░░░░
//
//     DIRECTORY
//
//     _Constructor
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
	public function __construct($args="PLUGIN_LABEL"){
		$this->version = PLUGIN_GLOBAL_VERSION;
		$this->prefix  = PLUGIN_GLOBAL_PREFIX;

		$this->label  = is_array($args) ? $args['label']  : $args;
		$this->slug   = is_array($args) ? $args['slug']   : sanitize_title($args);
		$this->fields = is_array($args) ? $args['fields'] : array();
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
		PLUGIN_PREFIX_get_template_part("admin/settings/{$this->slug}/page");
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
	// ∟Register
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
				$label = is_array($field) ? $field['label'] : $field;
				$slug  = is_array($field) ? $field['slug']  : sanitize_title($field);
				$type  = is_array($field) ? $field['type']  : false;

				add_settings_field(
					$slug,
					$label,
					array($this, 'render_field'),
					$this->slug,
					"{$this->slug}_section",
					array(
						'label' => $label,
						'slug'  => $slug,
						'type'  => $type
					)
				);
			}
		}
	}

	//∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
	// ∟Render
	//∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
	public function render_field($args){
		$type = $args['type'] ? $args['type'] : $args['slug'];
		PLUGIN_PREFIX_get_template_part("admin/settings/{$this->slug}/fields/{$type}");
	}

	//∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
	// ∟Save
	//∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴∵∴
	public function save_fields($input){
		$save = array();

		if ( !empty($this->fields) ) {
			foreach ($this->fields as $field) {
				$slug = is_array($field) ? $field['slug']  : sanitize_title($field);

				if (isset($input[$slug])) {
					$save[$slug] = $input[$slug];
				}
			}
		}

		return $save;
	}
}