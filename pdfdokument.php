<?php 
	if (isset($_GET['pdfdokument'])) {
		$filename=$_GET['pdfdokument'];
		$PDFfilename='dokumenter/' . $filename;
		$pdf = file_get_contents($PDFfilename);

       header('Content-Type: application/pdf');
        header('Content-Length: '.strlen($pdf));
        header('Content-Disposition: inline; filename="'.basename($PDFfilename).'";');
        ob_clean(); 
        flush(); 
        echo $pdf;  
    }
 ?>