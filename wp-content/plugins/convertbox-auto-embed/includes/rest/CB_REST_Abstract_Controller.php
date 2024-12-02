<?php

abstract class CB_REST_Abstract_Controller extends WP_REST_Controller {
	protected $namespace = 'cb/v1';

	public function get_items_permissions_check( $request ) {
		$uuid = $request->get_param( 'uuid' );
		if ( null === $uuid ) {
			return false;
		}

		$savedUUID = get_option( "convbox_embed_id", null );

		if ( null === $savedUUID ) {
			return false;
		}

		if ($uuid === hash("crc32b", $savedUUID)) {
			return true;
		}

		return false;
	}
}
