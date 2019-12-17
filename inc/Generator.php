<?php
namespace Superzoo;

use setasign\Fpdi\Fpdi;
use Picqer\Barcode\BarcodeGeneratorPNG;

class Generator
{
    private $barcode;
    private $pdf;
    private const PDF_SIZE = array(228.6, 117.602);
    private const STATIC_EANS = array('500' => '2011000086145', '1000' => '2011000086121', '2000' => '2011000861469');

    public function __construct()
    {
        $this->barcode = new BarcodeGeneratorPNG();
        $this->pdf = new Fpdi();
    }

    /**
     * Build PDF.
     *
     * @param int $EAN User inputted EAN.
     * @param int $amount Coupon value.
     * @return void
     */
    public function buildPDF($EAN, $amount)
    {
        $this->checkDirectories();
        $this->generateBarcode($EAN);

        $filepath = "assets/$amount.pdf";
        $pdf = $this->pdf;

        $pdf->AddPage('L', self::PDF_SIZE);
        $pdf->setSourceFile($filepath);
        $tplId1 = $pdf->importPage(1);
        $pdf->useTemplate($tplId1, 0, 0);

        $pdf->AddPage('L', self::PDF_SIZE);
        $tplId2 = $pdf->importPage(2);
        $pdf->useTemplate($tplId2, 0, 0);


        $pdf->SetFont('Courier', null, 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(20, 96);
        $pdf->Text(12.5, 108, $EAN);
        $pdf->Image('barcode.png', 14, 96);

        $this->generateStaticBarcode($amount);

        $pdf->SetTitle("darkovy-poukaz-$EAN.pdf");
        $pdf->Output('I', "darkovy-poukaz-$EAN.pdf");
    }

    /**
     * Generates Barcode based on EAN input from user form.
     *
     * @param int $EAN User inputted EAN.
     * @return void
     */
    private function generateBarcode($EAN)
    {
        try {
            $file = $this->barcode->getBarcode($EAN, $this->barcode::TYPE_EAN_13, 1);
            file_put_contents("barcode.png", $file);
        } catch (\Throwable $e) {
            echo "Neplatný EAN!";
            exit();
        }
    }

    /**
     * Generates Barcode for static amount depending of coupon type.
     * (500, 1000, 2000)
     *
     * @param int $amount Coupon value.
     * @return void
     */
    private function generateStaticBarcode($amount)
    {
        $pdf = $this->pdf;

        $staticEAN = $this->barcode->getBarcode(self::STATIC_EANS[$amount], $this->barcode::TYPE_EAN_13, 1);
        file_put_contents("staticEAN/$amount.png", $staticEAN);


        switch ($amount) {
            case 500:
                $pdf->Image('staticEAN/500.png', 190, 96);
                $pdf->Text(189, 108, self::STATIC_EANS[$amount]);
                break;
    
            case 1000:
                $pdf->Image('staticEAN/1000.png', 190, 96);
                $pdf->Text(189, 108, self::STATIC_EANS[$amount]);
                break;

            case 2000:
                $pdf->Image('staticEAN/2000.png', 190, 96);
                $pdf->Text(189, 108, self::STATIC_EANS[$amount]);
                break;

            default:
                throw new \Exception("Invalid amount!", 1);
                break;
        }
    }

    /**
     * Checks if directories for saved PNGs and PDFs exist.
     *
     * @return bool On success.
     */
    private function checkDirectories()
    {
        (!file_exists('output')) ? mkdir('output') : null;
        (!file_exists('staticEAN')) ? mkdir('staticEAN') : null;
        return true;
    }
}

