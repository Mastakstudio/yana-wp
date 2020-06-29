<?php

use setasign\Fpdi\Fpdi;

//require (get_template_directory().'/core/fonts/robotoMaker.php');


class CertificateManager  {

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
		$userManager = UserManager::getInstance();
		$currentUser = $userManager->GetCurrentUser();
		if ( !$currentUser->IsAuthorized() ){
			$userManager->RedirectToSignIn();
		}

		$templateID = self::$certificates[0]['certificate_id'];
		$source = get_attached_file($templateID);
		$fileName= explode('.', $source);

		if (end($fileName) !== 'pdf') 	return;

		$pdf = new Fpdi();
		$pdf->AddFont('opensans', '', 'opensans.php');
		$fontSize = '32';

		$pdf->AddPage();
		$pdf->setSourceFile($source);
		$tplId = $pdf->importPage(1);
		$pdf->useTemplate($tplId);
		$pdf->setPageFormat([200, 297],"L");

		$textFirstName = $currentUser->GetFirstName();
		$textFirstName = iconv('UTF-8', 'cp1251', $textFirstName);
		$leftFirstName = 297/2 - (strlen($textFirstName) * 2.4);
		$topFirstName = 164;

		$textSecondName = $currentUser->GetLastName();
		$textSecondName = iconv('UTF-8', 'cp1251', $textSecondName);
		$leftSecondName = 297/2 - (strlen($textSecondName) * 2.4);
		$topSecondName = 151;

		$pdf->SetFont('opensans', '', $fontSize);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->Text($leftFirstName, $topFirstName, $textFirstName);
		$pdf->Text($leftSecondName, $topSecondName, $textSecondName);

		$pdf->Output('I','certificate.pdf');
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