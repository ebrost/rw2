<?php
App::uses('TCPDF','CakePdf.Vendor/tcpdf');
//require_once('tcpdf.php');
class RICTCPDF  extends TCPDF
{
	
	
	protected $footerText='';
	protected $logo='';
	
	public $FontFamily='helvetica';
	
	
	public function __construct($orientation='P', $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false, $pdfa=false){
	
		parent::__construct($orientation='P', $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false, $pdfa=false);
		
	}
	
	function Header(){
	
		if(!empty ($this->logo)){
			$this->setImageScale('1');
			/*
	TCPDF::Image	(	$ 	file,
	$ 	x = '',
	$ 	y = '',
	$ 	w = 0,
	$ 	h = 0,
	$ 	type = '',
	$ 	link = '',
	$ 	align = '',
	$ 	resize = false,
	$ 	dpi = 300,
	$ 	palign = '',
	$ 	ismask = false,
	$ 	imgmask = false,
	$ 	border = 0,
	$ 	fitbox = false,
	$ 	hidden = false,
	$ 	fitonpage = false,
	$ 	alt = false,
	$ 	altimgs = array() 
	)		
	*/
			$this->Image(IMAGES.$this->logo,0,0,0,0, '', '', 'N', false, 300, '', false, false,array('B'=>array('width'=>1,'color'=>array(0,0,0)) ));
			$imgy = $this->getImageRBY();
			$this->setTopMargin($imgy);
		}
	}
	
    function Footer()
    {
        $year = date('Y');
        $footertext = sprintf($this->footerText, $year);
        $this->SetY(-20);
        $this->SetTextColor(0, 0, 0);
        //$this->SetFont($this->xfooterfont,'',$this->xfooterfontsize);
        $this->Cell(0,8, $footertext,'T',1,'C');
    }
	
	function setFooterText($text){
		$this->footerText=$text;
	}
	
	
	function setLinkColor($colorArray){
	$this->htmlLinkColorArray=$colorArray;
	}
	
	
	function setLogo($logo){
		$this->logo=$logo;
	}
	
	
}


?>