<?php
/**
 * TinyMCE button registration test
 *
 * @package wp-yomigana
 */

use Hametuha\Yomigana\Bootstrap;

/**
 * Test default and saved button options.
 */
class Yomigana_Buttons_Test extends WP_UnitTestCase {

	/**
	 * Remove saved option before each test.
	 */
	public function set_up() {
		parent::set_up();
		delete_option( 'wp_yomigana_options' );
	}

	/**
	 * Ruby button is displayed at first row by default.
	 */
	public function test_ruby_is_displayed_by_default() {
		$bootstrap = Bootstrap::get_instance();
		$this->assertSame( array( 'ruby', 'bold', 'italic' ), $bootstrap->register_buttons_1( array( 'bold', 'italic' ) ) );
		$this->assertSame( array( 'strikethrough' ), $bootstrap->register_buttons_2( array( 'strikethrough' ) ) );
	}

	/**
	 * Saved setting "Do not display" is respected.
	 */
	public function test_saved_option_hides_ruby() {
		update_option(
			'wp_yomigana_options',
			array(
				'ruby'  => false,
				'small' => false,
				'dl'    => false,
				'q'     => false,
				'cite'  => false,
			)
		);
		$this->assertSame( array( 'bold' ), Bootstrap::get_instance()->register_buttons_1( array( 'bold' ) ) );
	}

	/**
	 * Saved row and priority are respected.
	 */
	public function test_saved_option_moves_ruby() {
		update_option(
			'wp_yomigana_options',
			array(
				'ruby' => array( 2, 2 ),
			)
		);
		$bootstrap = Bootstrap::get_instance();
		$this->assertSame( array( 'bold' ), $bootstrap->register_buttons_1( array( 'bold' ) ) );
		$this->assertSame( array( 'strikethrough', 'ruby', 'hr', 'forecolor' ), $bootstrap->register_buttons_2( array( 'strikethrough', 'hr', 'forecolor' ) ) );
	}
}
