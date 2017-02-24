<?php

namespace DebabrataKarfa\Nonce;

if ( ! class_exists( 'Nonce' ) ) {

	/**
	 * Class Nonce
	 *
	 * @package DebabrataKarfa\Nonce
	 */
	class Nonce {

		/**
		 * The name of the action
		 *
		 * @var string
		 */
		private $action = '';

		/**
		 * The name of the request
		 *
		 * @var string
		 */
		private $request_name = '';

		/**
		 * The Nonce
		 *
		 * @var string
		 */
		private $nonce = '';

		/**
		 * The field
		 *
		 * @var string
		 **/
		private $field = '';

		/**
		 * The url
		 *
		 * @var string
		 */
		private $url = '';

		/**
		 * The query_arg
		 *
		 * @var string
		 */
		private $query_arg = '';

		/**
		 * Set the Nonce
		 *
		 * @param string $new_nonce Nonce to verify.
		 */
		public function set_nonce( string $new_nonce ) {
			$this->nonce = $new_nonce;
			return $this->get_nonce();
		}

		/**
		 * Get the Nonce
		 *
		 * @return string $nonce The Nonce
		 */
		public function get_nonce() {
			return $this->nonce;
		}

		/**
		 * Set the Nonce
		 *
		 * @param string $new_action Nonce to verify.
		 */
		public function set_action( string $new_action ) {
			$this->action = $new_action;
			return $this->get_action();
		}

		/**
		 * Get the Action
		 *
		 * @return string The action.
		 */
		public function get_action() {
			return $this->action;
		}

		/**
		 * Set the request name
		 *
		 * @param  string $new_request_name The new request name.
		 */
		public function set_request_name( string $new_request_name ) {
			$this->request_name = $new_request_name;
			return $this->get_request_name();
		}

		/**
		 * Get the Request name
		 *
		 * @return string The request name.
		 */
		public function get_request_name() {
			return $this->request_name;
		}

		/**
		 * Set the URL
		 *
		 * @param string $new_url The new URL.
		 * @return string $nonce  The URL
		 */
		public function set_url( string $new_url ) {
			$this->url = $new_url;
			return $this->get_url();
		}

		/**
		 * Get the URL
		 *
		 * @return string $url The URL
		 */
		public function get_url() {
			return $this->url;
		}

		/**
		 * Set the Query argument
		 *
		 * @param string $query_arg The new Query argument
		 */
		public function set_query_arg( string $query_arg ) {
			$this->query_arg = $query_arg;
			return $this->query_arg;
		}

		/**
		 * Get the Query argument
		 *
		 * @return string $query_arg The Query argument
		 */
		public function get_query_arg() {
			return $this->query_arg;
		}

		/**
		 * Set the Field
		 *
		 * @param string $new_field The new Field
		 */
		public function set_field( string $new_field ) {
			$this->field = $new_field;
			return $this->get_field();
		}

		/**
		 * Get the Field
		 *
		 * @return string $field The field
		 */
		public function get_field() {
			return $this->field;
		}

		/**
		 * Create WordPress Nonce and return
		 *
		 * @param  string $data Action name. Should give the context to what is taking place. Optional but recommended. By default it is -1.
		 * @return string The one use form token.
		 */
		public function create_nonce( $nonce = -1 ) {

			$this->set_nonce( wp_create_nonce( $this->get_action() ) );
			return $this->get_nonce();

		}

		/**
		 * Verify a WordPress Nonce
		 *
		 * @param string $nonce   The nonce to verify.
		 * @return boolean $valid Whether the nonce is valid or not.
		 */
		public function verify_nonce( string $nonce = null ) {

			if ( null !== $nonce ) {
				$this->set_nonce( $nonce );
			}

			$valid = wp_verify_nonce( $this->get_nonce(), $this->get_action() );

			if ( false === $valid ) {
				return false;
			}

			return true;

		}

		/**
		 * Display 'Are you sure you want to do this?' message to confirm the action being taken.
		 *
		 * @param  string $action (required) The nonce action.
		 * @return void This function does not return a value.
		 */
		public function nonce_ays( $nonce ) {

			return wp_nonce_ays( $this->get_action() );

		}


		/**
		 * The nonce field is used to validate that the contents of the form request came from the current site and not somewhere else
		 * @param  string $action (optional) Action name. Should give the context to what is taking place.
		 * @param  string $name (optional) Nonce name. This is the name of the nonce hidden form field to be created.
		 * @param  boolean $referer (optional) Whether also the referer hidden form field should be created.
		 * @param  boolean $echo (optional) Whether to display or return the nonce hidden form field.
		 * @return string The nonce hidden form field, optionally followed by the referer hidden form field if the $referer argument is set to true.
		 */
		public function nonce_field( bool $referer = null, bool $echo = null ) {

			$referer = (bool) $referer;
			$echo = (bool) $echo;

			// Let's create a nonce to populate $nonce.
			$this->create_nonce();
			$field = wp_nonce_field( $this->get_action(), $this->get_request_name(), $referer, false );
			$this->set_field( $field );

			if ( true === $echo ) {
				echo wp_kses(
					$this->get_field(),
					array(
						'input' => array(
							'type'  => array(),
							'id'    => array(),
							'name'  => array(),
							'value' => array(),
						),
					)
				);
			}

			return $this->get_field();

		}

		/**
		 * Verify retrieve URL with nonce added to URL query.
		 *
		 * @param string $url URL to add nonce action
		 * @return string $nonce URL with nonce action added.
		 **/
		public function create_url( string $url ) {

			// Let's create a nonce to populate $nonce.
			$this->create_nonce();
			$url = wp_nonce_url( $url, $this->get_action(), $this->get_request_name() );
			$this->set_url( $url );
			return $this->get_url();

		}

		/**
		 * Tests either if the current request carries a valid nonce, or if the current request was referred from an administration screen; depending on whether the $action argument is given (which is prefered), or not, respectively.
		 * @param  string $action    (optional) Action name. Should give the context to what is taking place.
		 * @param  string  $query_arg (optional) Where to look for nonce in the $_REQUEST PHP variable.
		 * @return string             To return boolean true, in the case of the obsolete usage
		 */
		public function nonce_check_admin_referer() {

			$valid = check_admin_referer( $this->get_action(), $this->get_query_arg() );

			if ( true === $valid ) {
				return true;
			}

			return false;
		}

		/**
		 * Nonce verifies the AJAX request, to prevent any processing of requests which are passed in by third-party sites or systems
		 * @return boolean This function will return a boolean of true if the check passes or false if the check fails.
		 */
		public function nonce_check_ajax_referer() {

			$die = false;
			$valid = check_ajax_referer( $this->get_action(), $this->get_query_arg(), $die );

			if ( true === $valid ) {
				return true;
			}

			return false;
		}

		/**
		 * The referer field value will be the value of the 'REQUEST_URI' element of the $_SERVER PHP superglobal variable
		 * @return string Referer field.
		 */
		public function nonce_referer_field() {

			$this->create_nonce();
			$field = wp_referer_field( $this->get_request_name() );
			$this->set_field( $field );
			return $this->get_field( $field );

		}
	}

}
