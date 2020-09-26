<?php
require_once 'dompdf/autoload.inc.php';
include 'config.php';
include 'invoice.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$options->set('debugKeepTemp', TRUE);
$options->set('isHtml5ParserEnabled', true);
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream();
