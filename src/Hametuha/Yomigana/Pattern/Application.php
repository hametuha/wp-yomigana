<?php

namespace Hametuha\Yomigana\Pattern;

/**
 * Application base class
 *
 * @package Hametuha\Yomigana\Pattern
 * @property-read array $option
 * @property-read string $dir
 * @property-read string $assets
 * @property-read string $version
 */
abstract class Application extends Singleton {


	/**
	 * @const string
	 */
	const DOMAIN = 'wp-yomigana';

	/**
	 * @var array
	 */
	private $default_option = array(
		'ruby'  => array( 1, 1 ),
		'small' => false,
		'dl'    => false,
		'q'     => false,
		'cite'  => false,
	);

	/**
	 * Detect if browser supports ruby element.
	 *
	 * @deprecated 1.4.0
	 * @global string $is_gecko
	 * @global string $is_opera
	 * @return boolean
	 */
	protected function is_ruby_disabled() {
		// Opera, FF < 38 don't support ruby.
		global $is_gecko, $is_opera;

		return (
			$is_opera
			|| ( $is_gecko && floatval( preg_replace( '/.*rv:([0-9\.]+).*/u', '$1', $_SERVER['HTTP_USER_AGENT'] ) ) < 38 )
		);
	}

	/**
	 * Get specified tag's display row index
	 *
	 * @param string $tag
	 *
	 * @return int
	 */
	protected function get_row_index( $tag ) {
		if ( is_string( $tag ) && isset( $this->option[ $tag ] ) && is_array( $this->option[ $tag ] ) && isset( $this->option[ $tag ][0] ) ) {
			return (int) $this->option[ $tag ][0];
		} else {
			return 0;
		}
	}

	/**
	 * Get specified tag's display index
	 *
	 * @param string $tag
	 *
	 * @return int 0 means hidden.
	 */
	protected function get_column_index( $tag ) {
		if ( is_string( $tag ) && isset( $this->option[ $tag ] ) && is_array( $this->option[ $tag ] ) && isset( $this->option[ $tag ][1] ) ) {
			return (int) $this->option[ $tag ][1];
		} else {
			return 0;
		}
	}

	/**
	 * Load template
	 *
	 * @param string $template
	 * @param array $args
	 */
	protected function get_template( $template, $args = array() ) {
		$path = $this->search_template( $template );
		if ( $path ) {
			if ( $args ) {
				// phpcs:ignore WordPress.PHP.DontExtract.extract_extract -- Intentional: expose template args as variables to the included template.
				extract( $args );
			}
			include $path;
		}
	}

	/**
	 * Load template and return string
	 *
	 * @param string $template
	 * @param array $args
	 *
	 * @return string
	 */
	protected function get_template_string( $template, $args = array() ) {
		$path = $this->search_template( $template );
		if ( $path ) {
			if ( $args ) {
				// phpcs:ignore WordPress.PHP.DontExtract.extract_extract -- Intentional: expose template args as variables to the included template.
				extract( $args );
			}
			ob_start();
			include $path;
			$content = ob_get_contents();
			ob_end_clean();

			return $content;
		} else {
			return '';
		}
	}

	/**
	 * Get asset version from file modification time.
	 *
	 * @param string $rel_path Path relative to assets directory.
	 *
	 * @return string
	 */
	protected function asset_version( $rel_path ) {
		$path = $this->dir . '/assets/' . ltrim( $rel_path, '/' );

		return file_exists( $path ) ? (string) filemtime( $path ) : $this->version;
	}

	/**
	 * Search template
	 *
	 * @param string $template
	 *
	 * @return bool|string
	 */
	private function search_template( $template ) {
		$path = $this->dir . '/templates/' . $template . '.php';

		return file_exists( $path ) ? $path : false;
	}

	/**
	 * @param string $name
	 *
	 * @return string|array|null
	 */
	public function __get( $name ) {
		switch ( $name ) {
			case 'dir':
				return dirname( __DIR__, 4 );
				break;
			case 'version':
				static $version = null;
				if ( is_null( $version ) ) {
					$data    = get_file_data( $this->dir . '/wp-yomigana.php', array( 'version' => 'Version' ) );
					$version = $data['version'];
				}

				return $version;
			case 'assets':
				return untrailingslashit( plugin_dir_url( $this->dir . '/assets/hoge' ) );
				break;
			case 'option':
				// Override default with saved data.
				$saved_option = (array) get_option( 'wp_yomigana_options', array() );
				foreach ( $this->default_option as $key => $val ) {
					if ( ! isset( $saved_option[ $key ] ) ) {
						$saved_option[ $key ] = $val;
					}
				}

				return $saved_option;
				break;
			default:
				return null;
				break;
		}
	}
}
