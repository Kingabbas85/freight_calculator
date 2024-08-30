<?php
include_once('database/database.php');
include_once('includes/helpers.php');
include_once("packages/fpdf/fpdf.php");
class EstimatePDF extends FPDF
{

    private $data;

    public function __construct($data)
    {
        parent::__construct();  // Call the parent constructor
        $this->data = $data;
    }

    function Header()
    {
        // No specific header content, could be added here
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function generateEstimate()
    {
        // Add a page
        $this->SetMargins(6, 6);
        // $this->AliasNbPages();
        $this->AddPage("P", "A4", 0);

        // Title Section with Header Background
        $this->SetFillColor(217, 83, 79); // #d9534f
        $this->SetTextColor(255, 255, 255); // white
        $this->SetDrawColor(217, 83, 79); // #d9534f
        // $this->SetLineWidth(1);
        $this->Cell(198, 0.5, '', 1, 1, 'C', true); // Creating the background rectangle

        $this->SetFont('Arial', 'B', 16);
        $this->Cell(1, 16, '', 1, 0, 'L', true);
        $this->Cell(98, 16, 'ESTIMATE', 1, 0, 'L', true);
        $this->Cell(98, 16, '# UT60006', 1, 0, 'R', true);
        $this->Cell(1, 16, '', 1, 1, 'R', true);

        // Reset text color for the content
        $this->SetTextColor(0, 0, 0);

        // Company and Customer Details
        $this->Ln(8);
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(92, 184, 92); // #5cb85c
        $this->Cell(100, 6.5, 'UAE ENTITY', 0, 0, 'L');
        $this->Cell(0, 6.5, 'CUSTOMER', 0, 1, 'L');

        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 0); // Reset to black
        $this->Cell(100, 6.5, 'UAE street address', 0, 0, 'L');
        $this->Cell(0, 6.5, 'Customer-2', 0, 1, 'L');

        $this->Cell(100, 6.5, 'City, UAE', 0, 0, 'L');
        $this->Cell(0, 6.5, '373 Downing St, Georgia, 30045', 0, 1, 'L');

        $this->Cell(100, 6.5, 'Website: www.UAEentity.com', 0, 0, 'L');
        $this->Cell(0, 6.5, 'Lawrenceville', 0, 1, 'L');

        $this->Cell(100, 6.5, 'Phone: 00000 00 000 0000', 0, 0, 'L');
        $this->Cell(0, 6.5, 'United States', 0, 1, 'L');

        // $this->SetXY(6, 20.5); // #ddd
        // $this->Cell(198, 50, '', 0, 0, 'C');
        // $this->SetXY(6, 52.5); // #ddd
        // // Border around sections
        // $this->Ln(10);
        $this->SetDrawColor(221, 221, 221); // #ddd
        // $this->Cell(190, 10, '', 0, 1, 'C'); // Spacing

        // Date and Shipping Info
        $this->Ln(8);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(39.6, 9, 'DATE', 'TRL', 0, 'C');
        $this->Cell(39.6, 9, 'CHARGEBLE WEIGHT', 'TRL', 0, 'C');
        $this->Cell(39.6, 9, 'CARGO VALUE', 'TRL', 0, 'C');
        $this->Cell(39.6, 9, 'SHIP FROM', 'TRL', 0, 'C');
        $this->Cell(39.6, 9, 'SHIP TO', 'TRL', 1, 'C');

        $this->SetFont('Arial', '', 8);
        $this->Cell(39.6, 9, '26-08-24', 'BRL', 0, 'C');
        $this->Cell(39.6, 9, '18.1kg', 'BRL', 0, 'C');
        $this->Cell(39.6, 9, 'USD 1,980.00', 'BRL', 0, 'C');
        $this->Cell(39.6, 9, 'United States', 'BRL', 0, 'C');
        $this->Cell(39.6, 9, 'Vietnam', 'BRL', 1, 'C');

        // Table Header
        $this->Ln(10);
        $this->SetFillColor(217, 83, 79); // #d9534f
        $this->SetTextColor(255, 255, 255); // white
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(128, 8, 'DESCRIPTION', 1, 0, 'L', true);
        $this->Cell(35, 8, 'TAXED', 1, 0, 'C', true);
        $this->Cell(35, 8, 'AMOUNT', 1, 1, 'R', true);

        // Table Content
        $this->SetFont('Arial', '', 9);
        $this->SetTextColor(0, 0, 0); // Reset to black
        $this->SetDrawColor(221, 221, 221); // #ddd

        $items = [
            ['IOR', '', '500.00'],
            ['Estimated Duty & Taxes', '', '435.60'],
            ['Estimated VAT (20% of CIP cost + Duties)', '', '435.60'],
            ['Customs Brokerage', '', '450.00'],
            ['Handling Charges', '', '400.00'],
            ['Admin & Bank Charges', '', '250.00'],
            ['Compliance & Certification', '', '750.00'],
            ['Storage', '', '250.00'],
            ['Last Mile Delivery', '', '350.00'],
        ];

        foreach ($items as $item) {
            $this->Cell(128, 8, $item[0], 1, 0, 'L');
            $this->Cell(35, 8, $item[1], 1, 0, 'C');
            $this->Cell(35, 8, $item[2], 1, 1, 'R');
        }

        // Notes Section with Background
        $this->Ln(10);

        // Left side - Note Section
        $this->SetFillColor(217, 83, 79); // #d9534f
        $this->SetTextColor(255, 255, 255); // white
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 10, 'NOTE', 1, 1, 'L', true); // Use Cell to keep it on the same line

        $this->SetTextColor(0, 0, 0); // Reset to black
        $this->SetFont('Arial', '', 9);

        $this->MultiCell(110, 8, "1. The content of this document is proprietary, confidential, and intended solely for the recipient.\n2. No part of this document may be disclosed, reproduced, or forwarded to anyone without the written authorization of Company Name.", 1, 'L');

        // Right side - Totals Section
        $this->SetXY(120, $this->GetY() - 42); // Move to the right side
        $this->SetFont('Arial', '', 10);
        $this->Cell(78, 8, 'Subtotal:', 'TLB', 0, 'L');
        $this->Cell(0, 8, 'USD 3,385.60', "TRB", 1, 'R');

        $this->SetXY(120, $this->GetY()); // Align the next row
        $this->Cell(78, 8, 'Taxable:', 'TLB', 0, 'L');
        $this->Cell(0, 8, '-', "TRB", 1, 'R');

        $this->SetXY(120, $this->GetY()); // Align the next row
        $this->Cell(78, 8, 'Tax rate:', 'TLB', 0, 'L');
        $this->Cell(0, 8, '6.250%', "TRB", 1, 'R');

        $this->SetXY(120, $this->GetY()); // Align the next row
        $this->Cell(78, 8, 'Tax due:', 'TLB', 0, 'L');
        $this->Cell(0, 8, '-', "TRB", 1, 'R');

        $this->SetXY(120, $this->GetY()); // Align the next row
        $this->Cell(78, 8, 'Other:', 'TLB', 0, 'L');
        $this->Cell(0, 8, '-', "TRB", 1, 'R');

        // Total row with background
        $this->SetXY(120, $this->GetY()); // Align the next row
        $this->SetFillColor(217, 83, 79); // #d9534f
        $this->SetTextColor(255, 255, 255); // white
        $this->SetDrawColor(217, 83, 79); // #d9534f

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(78, 10, 'TOTAL:', 'TLBR', 0, 'L', true);
        $this->Cell(0, 10, 'USD 3,385.60', "TRB", 1, 'R', true);
        $this->SetTextColor(0, 0, 0); // Reset to black
        $this->SetDrawColor(221, 221, 221); // #ddd


        // Customer Acceptance
        $this->Ln(2);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(198, 10, 'Customer Acceptance (Sign below)', 0, 1, 'L');

        $this->SetFont('Arial', '', 12);
        $this->Cell(110, 10, 'Print Name:', 'B', 0, 'L');
        $this->Cell(88, 10, '', '0', 1, 'L');
        $this->Cell(198, 10, '', 0, 1, 'L');

        // $pdf->output();
        $this->Output("assets/estimates/UT_" . $this->data['estimate_no'] . ".pdf", "F");
        $file = "assets/estimates/UT_" . $this->data['estimate_no'] . ".pdf";
        if (file_exists($file)) {
            echo 1;
        } else {
            echo "NOT_SAVED";
        }
    }
}
// if (isset($_POST['getEstimateModalPDF'])) {
// $pdf = new EstimatePDF();
// $pdf->generateEstimate();
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdf = new EstimatePDF($_POST);
    $pdf->generateEstimate();
}