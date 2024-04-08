<?php 
/** 
 * Convert HTML to MS Word document 
 * @name html_to_doc 
 * @version 2.0 
 * @author TutorialsWebsite 
 * @link https://www.tutorialswebsite.com 
 */ 
class HTML_TO_DOC 
{ 
    var $docFile  = ''; 
    var $title    = ''; 
    var $htmlHead = ''; 
    var $htmlBody = ''; 
     
    /** 
     * Constructor 
     * 
     * @return void 
     */ 
    function __construct(){ 
        $this->title = ''; 
        $this->htmlHead = ''; 
        $this->htmlBody = ''; 
    } 
     
    /** 
     * Set the document file name 
     * 
     * @param String $docfile  
     */ 
    function setDocFileName($docfile){ 
        $this->docFile = $docfile; 
        if(!preg_match("/\.doc$/i",$this->docFile) && !preg_match("/\.docx$/i",$this->docFile)){ 
            $this->docFile .= '.doc'; 
        } 
        return;  
    } 
     
    /** 
     * Set the document title 
     * 
     * @param String $title  
     */ 
    function setTitle($title){ 
        $this->title = $title; 
    } 
     
    /** 
     * Return header of MS Doc 
     * 
     * @return String 
     */ 
    function getHeader(){ 
        $return = '
        <html xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:w="urn:schemas-microsoft-com:office:word" 
        xmlns="http://www.w3.org/TR/REC-html40">
        <head><title>Pharmacometric Analysis Dataset Specification</title>
    <style>  
       @page{
            mso-page-orientation: landscape;
            size:29.7cm 21cm;   
            margin:1cm 1cm 1cm 1cm;
        }
        @page Section1 { }
div.Section1 { page:Section1; }
</style>
<xml>
<w:WordDocument>
<w:View>Print</w:View>
<w:Zoom>100</w:Zoom>
<w:DoNotOptimizeForBrowser/>
</w:WordDocument>
</xml>
</head>
          '; 
       
        return $return; 
    } 
     
    /** 
     * Return Document footer 
     * 
     * @return String 
     */ 
    function getFotter(){ 
        return "<hr/></body></html>"; 
    } 
 
    /** 
     * Create The MS Word Document from given HTML 
     * 
     * @param String $html :: HTML Content or HTML File Name like path/to/html/file.html 
     * @param String $file :: Document File Name 
     * @param Boolean $download :: Wheather to download the file or save the file 
     * @return boolean  
     */ 
    function createDoc($html, $file, $download = false){ 
        if(is_file($html)){ 
            $html = @file_get_contents($html); 
        } 
         
        $this->_parseHtml($html); 
        $this->setDocFileName($file); 
        $doc = $this->getHeader();
       // $doc .= $this->title; 
        $doc .= $this->htmlBody; 
        //$doc .= $this->getFotter(); 
                         
        if($download){ 
            @header("Cache-Control: ");// leave blank to avoid IE errors 
            @header("Pragma: ");// leave blank to avoid IE errors 
            @header("Content-type: application/octet-stream"); 
            @header("Content-Disposition: attachment; filename=\"$this->docFile\""); 
            echo $doc; 
            return true; 
        }else { 
            return $this->write_file($this->docFile, $doc); 
        } 
    } 
     
    /** 
     * Parse the html and remove <head></head> part if present into html 
     * 
     * @param String $html 
     * @return void 
     * @access Private 
     */ 
    function _parseHtml($html){ 
        $html = preg_replace("/<!DOCTYPE((.|\n)*?)>/ims", "", $html); 
        $html = preg_replace("/<script((.|\n)*?)>((.|\n)*?)<\/script>/ims", "", $html); 
        preg_match("/<head>((.|\n)*?)<\/head>/ims", $html, $matches); 
        $head = !empty($matches[1])?$matches[1]:''; 
        preg_match("/<title>((.|\n)*?)<\/title>/ims", $head, $matches); 
        $this->title = !empty($matches[1])?$matches[1]:''; 
        $html = preg_replace("/<head>((.|\n)*?)<\/head>/ims", "", $html); 
        $head = preg_replace("/<title>((.|\n)*?)<\/title>/ims", "", $head); 
        $head = preg_replace("/<\/?head>/ims", "", $head); 
        $html = preg_replace("/<\/?body((.|\n)*?)>/ims", "", $html); 
        $this->htmlHead = $head; 
    
        $this->htmlBody = $html; 
        return; 
    } 
     
    /** 
     * Write the content in the file 
     * 
     * @param String $file :: File name to be save 
     * @param String $content :: Content to be write 
     * @param [Optional] String $mode :: Write Mode 
     * @return void 
     * @access boolean True on success else false 
     */ 
    function write_file($file, $content, $mode = "w"){ 
        $fp = @fopen($file, $mode); 
        if(!is_resource($fp)){ 
            return false; 
        } 
        fwrite($fp, $content); 
        fclose($fp); 
        return true; 
    } 
}