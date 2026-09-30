<?php

namespace Hametuha\Yomigana;


use Hametuha\Yomigana\Pattern\Application;

/**
 * Gutenberg helper
 *
 * @package wp-yomigana
 */
class Gutenberg extends Application {

	/**
	 * Constructor
	 */
	protected function __construct() {
		add_action( 'init', array( $this, 'register_script' ), 10 );
		add_action( 'init', array( $this, 'register_block' ), 11 );
		add_action( 'enqueue_block_editor_assets', array( $this, 'block_editor_assets' ) );
	}

	/**
	 * Register script built by wp-scripts.
	 *
	 * @param string   $handle     Script handle.
	 * @param string   $name       File name without extension in assets/js/dist.
	 * @param string[] $extra_deps Additional dependencies.
	 */
	private function register_built_script( $handle, $name, $extra_deps = array() ) {
		$asset_file = $this->dir . '/assets/js/dist/' . $name . '.asset.php';
		$asset      = file_exists( $asset_file ) ? require $asset_file : array(
			'dependencies' => array(),
			'version'      => $this->version,
		);
		wp_register_script(
			$handle,
			$this->assets . '/js/dist/' . $name . '.js',
			array_merge( $asset['dependencies'], $extra_deps ),
			$asset['version'],
			true
		);
		wp_set_script_translations( $handle, 'wp-yomigana', $this->dir . '/languages' );
	}

	/**
	 * Register scripts.
	 */
	public function register_script() {
		// Ruby, etc.
		$this->register_built_script( 'wp-yomigana-gutenberg', 'wp-yomigana-gutenberg' );
		// Definition list.
		$this->register_built_script( 'wp-yomigana-dl', 'definition-list' );
		wp_register_style( 'wp-yomigana-dl', $this->assets . '/css/editor-dl.css', array(), $this->asset_version( 'css/editor-dl.css' ) );
		$this->register_built_script( 'wp-yomigana-dt', 'definition-term', array( 'wp-yomigana-dl' ) );
		$this->register_built_script( 'wp-yomigana-dd', 'definition-description', array( 'wp-yomigana-dl' ) );
	}

	/**
	 * Register gutenberg block.
	 */
	public function register_block() {
		register_block_type(
			'wp-yomigana/dl',
			array(
				'editor_style'  => 'wp-yomigana-dl',
				'editor_script' => 'wp-yomigana-dl',
			)
		);
		register_block_type(
			'wp-yomigana/term',
			array(
				'editor_script' => 'wp-yomigana-dt',
			)
		);
		register_block_type(
			'wp-yomigana/description',
			array(
				'editor_script' => 'wp-yomigana-dd',
			)
		);
	}

	/**
	 * Enqueue assets for ruby, small, q, cite.
	 */
	public function block_editor_assets() {
		wp_enqueue_script( 'wp-yomigana-gutenberg' );
	}
}
