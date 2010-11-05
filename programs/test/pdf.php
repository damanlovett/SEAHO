<?php
		$pdf = PDF_new();
        PDF_open_file($pdf); 
		
	PDF_set_info($pdf, "author", "John Coggeshall"); 
    PDF_set_info($pdf, "title", "Zend.com Example"); 
    PDF_set_info($pdf, "creator", "Zend.com"); 
    PDF_set_info($pdf, "subject", "Code Gallery  Spotlight");
	
	PDF_begin_page($pdf, 450, 450); 
	
	$font = PDF_findfont($pdf, "Helvetica-Bold",  "winansi",0);  
	
	PDF_setfont($pdf, $font, 12); 
	
	PDF_show_xy($pdf, "Hello, Dynamic PDFs!", 5, 225); 
	
	PDF_end_page($pdf); 
	
	PDF_close($pdf); 
	
	$buffer = PDF_get_buffer($pdf); 
	
	header("Content-type: application/pdf");
	header("Content-Length: ".strlen($buffer));
	header("Content-Disposition: inline; filename=zend.pdf"); 
	
	echo $buffer;
	
	    PDF_delete($pdf);
?> 