<?php
require_once 'header.php';
use setasign\Fpdi\Fpdi;

// TODO check if it is in array 500 1000 2000
$amount = filter_input(INPUT_GET, 'amount');
$EAN = filter_input(INPUT_GET, 'EAN');

?>
<div class="container">
    <?php
    $generatorHTML = new Picqer\Barcode\BarcodeGeneratorHTML();
    //echo $generatorHTML->getBarcode($EAN, $generatorHTML::TYPE_EAN_13, 1);

    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
    $file = $generatorPNG->getBarcode($EAN, $generatorPNG::TYPE_EAN_13, 1);
    file_put_contents("test.png", $file);
    ?>
</div>
<?php


(!file_exists('output')) ? mkdir('output') : null;
(!file_exists('staticEAN')) ? mkdir('staticEAN') : null;

define('SIZE', array(228.6, 117.602));
$filepath = 'assets' . DIRECTORY_SEPARATOR . $amount . '.pdf';


$pdf = new Fpdi();

$pdf->AddPage('L', SIZE);
$pdf->setSourceFile($filepath);
$tplId1 = $pdf->importPage(1);
$pdf->useTemplate($tplId1, 0, 0);

$pdf->AddPage('L', SIZE);
$tplId2 = $pdf->importPage(2);
$pdf->useTemplate($tplId2, 0, 0);


$pdf->SetFont('Courier', null, 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(20, 96);
$pdf->Text(12.5, 108, $EAN);
$pdf->Image('test.png', 14, 96);


$staticEAN = array('500' => '2011000086145', '1000' => '2011000086121', '2000' => '2011000861469');

$amountEAN = $generatorPNG->getBarcode($staticEAN[$amount], $generatorPNG::TYPE_EAN_13, 1);
file_put_contents("staticEAN/$amount.png", $amountEAN);


switch ($amount) {
    case 500:
        $pdf->Image('staticEAN/500.png', 190, 96);
        $pdf->Text(189, 108, $staticEAN[$amount]);
        break;
    
    case 1000:
        $pdf->Image('staticEAN/1000.png', 190, 96);
        $pdf->Text(189, 108, $staticEAN[$amount]);
        break;

    case 2000:
        $pdf->Image('staticEAN/2000.png', 190, 96);
        $pdf->Text(189, 108, $staticEAN[$amount]);
        break;

    default:
        throw new Exception("Invalid amount!", 1);
        break;
}


$pdf->Output('F', "output" . DIRECTORY_SEPARATOR . "output.pdf");

?>
<div class="text-center mt-5">
    <img src="staticEAN/<?= $amount ?>.png" alt="" class="src">
<div>
<?php




require_once 'footer.php';