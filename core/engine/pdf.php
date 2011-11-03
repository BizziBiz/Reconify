<?php
class pdf{
	static public function generatePDF($inputHTML){
		// Delete file, if it exists
		if(file_exists(pdf::getPDFPath()))
			unlink(pdf::getPDFPath());
		
		$docraptor = new DocRaptor(DOCRAPTOR_API);
		$docraptor->setDocumentContent($inputHTML)->setDocumentType('pdf')->setTest(DOCRAPTOR_TEST)->setName(pdf::getPDFName());
		$file = $docraptor->fetchDocument();
		
		$fp = fopen(pdf::getPDFPath(), 'w');
		fwrite($fp, $file);
		fclose($fp);
	}
	
	static public function getPDFPath(){
		return PDF_DIR . pdf::getPDFName();
	}
	
	static public function getPDFName(){
		$pos = strpos(URL,'//');	
		return substr(URL, $pos + 2) . '.pdf';
	}
	
	static public function download($file){
		$path = PDF_DIR.$file;
	
		if (file_exists($path) && is_readable($path)) {
			header("Content-Disposition: attachment; filename=$file");
			readfile($path);
		}
	}
}
?>