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
//		$pdf->setPageFormat([297, 210],"P");
		$pdf->setPageFormat([290, 290],"L");

		// The new content
		$fontSize = '15';
		$fontColor = `255,0,0`;
		$left = 16;
		$top = 40;
		$text = 'Sample Text over overlay';

		$pdf->SetFont("helvetica", "B", 15);
		$pdf->SetTextColor($fontColor);
		$pdf->Text($left,$top,$text);

		$TemplateSize = $pdf->getTemplateSize($tplId );
//		$TemplateSize = $pdf->getPage;

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