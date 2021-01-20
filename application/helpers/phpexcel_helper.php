<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('PHPExcel/PHPExcel.php');

function xlsx_new($title, $description = '')
{
	$xlsx = new PHPExcel();
	
	$xlsx->getProperties()
						->setCreator('SIGD')
						->setLastModifiedBy('SIGD')
						->setTitle($title)
						->setSubject($title)
						->setDescription($description);
	
	return $xlsx;
}

function xlsx_write($xlsx, $filename)
{
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');
	header('Cache-Control: max-age=0');
	
	header('Expires: Sun, 17 May 1987 10:00:00 GMT+7');
	header('Last-Modified: '.date('D, d M Y H:i:s').' GMT+7');
	header('Cache-Control: cache, must-revalidate');
	header('Pragma: public');
	
	$writer = PHPExcel_IOFactory::createWriter($xlsx, 'Excel2007');
	$writer->save('php://output');
}

/* End of file phpexcel_helper.php */
/* Location: ./application/helpers/phpexcel_helper.php */