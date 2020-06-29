<?php

use setasign\Fpdi\Fpdi;
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

		if (end($fileName) !== 'pdf'){
			return;
		}

		$pdf = new Fpdi();

		$pdf->AddPage();
		$pdf->setSourceFile($source);
		$tplId = $pdf->importPage(1);
		$pdf->useTemplate($tplId);
		$pdf->setPageFormat([200, 297],"L");

		$fontSize = '32';
//		$leftFirstName = 120;
//		$topFirstName = 151;
		$leftFirstName = 297/2 - (strlen($currentUser->GetFirstName()) * 2.4);
		$topFirstName = 164;
		$textFirstName = $currentUser->GetFirstName();

//		$leftSecondName = 120;
//		$topSecondName = 164;
		$leftSecondName = 297/2 - (strlen($currentUser->GetLastName()) * 2.4);
		$topSecondName = 151;
		$textSecondName = $currentUser->GetLastName();

		$pdf->SetFont('Arial', '', $fontSize);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->Text($leftFirstName, $topFirstName, $textFirstName);
		$pdf->Text($leftSecondName, $topSecondName, $textSecondName);

		$pdf->Output('I','azaza.pdf');
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