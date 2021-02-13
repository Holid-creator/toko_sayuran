<?php
$content = "<page><h1>Contoh</h1><br>
Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod, numquam.<a href='http://html2pdf.fr/'>HTML2PDF</a></page>";

require_once('../assets/html2pdf/html2pdf.class.php');

$html2pdf = new HTML2PDF('P', 'A4', 'en');
$html2pdf->writeHTML($content);
$html2pdf->output('example.pdf');
