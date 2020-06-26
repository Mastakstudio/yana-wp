<?php
use setasign\Fpdi\Fpdi;

class CertificateManager extends Fpdi{

	private static $instances = [];

	/**
	 * @var array
	 */
	private static $certificates;

	private function __construct() {
		$certificateRole = carbon_get_theme_option( PREFIX.'certificate_role' );

		self::$certificates = $certificateRole;
	}

	public static function createPersonalCertificate(){
		$templateID = self::$certificates[0]['certificate_id'];
		$source = get_attached_file($templateID);
		$fileName= explode('.', $source);
		if (end($fileName) !== 'pdf'){
			return;
		}

		$baseDir = wp_upload_dir()['basedir'];
		if (!is_dir($baseDir.'/certificate')){
			mkdir($baseDir.'/certificate');
		}
		$newFile = $baseDir.'/certificate/test.pdf';
		if (!copy($source, $newFile)) {
			echo "не удалось скопировать $source...\n";
		}
		$pdf = new Fpdi();



	}



	public static function getInstance(): CertificateManager {
		$cls = static::class;
		if ( ! isset( self::$instances[ $cls ] ) ) {
			self::$instances[ $cls ] = new static;
		}

		return self::$instances[ $cls ];
	}

	public function __wakeup() {
		throw new \Exception( "Cannot unserialize a singleton." );
	}

	protected function __clone() {}
}