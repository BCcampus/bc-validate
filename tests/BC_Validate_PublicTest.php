<?php

/**
 * Created by PhpStorm.
 * User: bpayne
 * Date: 2016-04-26
 * Time: 9:04 AM
 */
class BC_Validate_PublicTest extends WP_UnitTestCase {


	/**
	 *
	 */
	public function test_checkDomain() {
		$emails = array(
			'foo@ubc.ca',
			'roger@geog.ubc.ca',
			'cat@cnc.bc.ca',
		);
		$t      = new BC_Validate_Public( 'test_validate', 'test_version' );

		$post   = array();
		$result = $t->signupUserBC( $post );
		$this->assertFalse( $result );

	}

	/**
	 * A single example test.
	 */
	function test_sample() {
		// Replace this with some actual testing code.
		$this->assertTrue( true );
	}

}
