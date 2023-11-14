<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');

class Pdf
{
    function createPDF($html, $filename = '', $stream = true, $download = false, $paper = 'A4', $orientation = 'portrait'){
        /* Create instance */
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadhtml($html, 'UTF-8');
        
        /* Options */
        $options = $dompdf->getOptions();
        //$options->setDefaultFont('Times New Roman');
        $options->set('isRemoteEnabled', true);
        $options->set('isFontSubsettingEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        //$options->set('dpi','120');

        $dompdf->setOptions($options);

        /* Set Paper */
        $dompdf->setpaper($paper, $orientation);

        /* Render */
        $dompdf->render();

        $ret = null;

        /* Stream */
        if($stream) :
            if($download) :
                $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
            else :
                $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
            endif;
        else: 
            $ret = $dompdf->output(); 
        endif;

        return $ret;
    }
}
?>