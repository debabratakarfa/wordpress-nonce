<?php

use DebabrataKarfa\Nonce\Nonce;

class Test_Nonce extends WP_UnitTestCase {

	public function testCreateNonce() {
		$nonce = new Nonce();

		$set_nonce = $nonce->create_nonce();
		// Check if nonce is stored correctly in $set_nonce.
		self::assertSame( $set_nonce, $nonce->get_nonce() );
	}

	public function testVerifyNonce() {
		$nonce = new Nonce();

		$set_nonce = $nonce->create_nonce( 'test-nonce' );
		$this->assertEquals( $nonce->verify_nonce( $set_nonce, 'test-nonce' ), 1 );

		$not_valid = $nonce->verify_nonce( $set_nonce . '-failure' );
		$this->assertFalse( $not_valid );
	}

	public function testNonceField() {
		$nonce = new Nonce();

		$nonce_field = $nonce->nonce_field( 'test-nonce', '_wptestnonce', true, false );

		$dom = new DOMDocument();
		$dom->loadHTML( $nonce_field );

		$input = $dom->getElementsByTagName( 'input' )->item( 0 );
		if ( ! empty( $input ) ) {
			$get_nonce = $input->getAttribute( 'value' );
			$this->assertNotEquals( $nonce->verify_nonce( $get_nonce, 'test-nonce' ), 1 );
		} else {
			$this->assertTrue( false );
		}
	}

	public function testCreateURL() {
		$this->action   = 'action';
		$this->request  = 'request';
		$url = 'http://example.com/';

		$nonce = new Nonce();

		$url_with_nonce = $nonce->create_url( $url );
		self::assertSame( $url_with_nonce, $nonce->get_url() );
		self::assertSame( $nonce->set_url( 'abc' ), 'abc' );
	}

	public function testNonceAys( $value = '' ) {
		# code...
		return 'Welcome';
	}


}
