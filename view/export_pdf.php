<?php session_start() ?>
<?php
    $content = $_SESSION['format_pdf'];

    require_once('../html2pdf_v4.03/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('exemple.pdf');
?>