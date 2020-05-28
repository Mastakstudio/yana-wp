<?php
	/**
	 * Created by PhpStorm.
	 * User: alexandrzanko
	 * Date: 12/4/18
	 * Time: 5:19 PM
	 */

	class Assets {
		const ASSETS = __DIR__ . '/../src/assets.json';

		public static function getJs( $key ) {

			$assets = self::getData( $key );
			if ( isset( $assets ) and isset( $assets["js"] ) ) {
				return BASE_URL . $assets["js"];
			}

			return null;
		}

		public static function getCss( $key ) {
			$assets = self::getData( $key );
			if ( isset( $assets ) and isset( $assets["css"] ) ) {
				return BASE_URL . $assets["css"];
			}

			return null;
		}

		private static function getData( $key ) {

			$assets = json_decode( file_get_contents( self::ASSETS ), true );
			if ( isset( $assets[ $key ] ) ) {
				return $assets[ $key ];
			}

			return null;
		}
	}