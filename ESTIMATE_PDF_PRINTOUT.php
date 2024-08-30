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

    // function Footer()
    // {
    //     $this->SetY(-15);
    //     $this->SetFont('Arial', 'I', 8);
    //     $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    // }

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
        $this->Cell(98, 16, '# UT' . str_pad($this->data['estimate_no'], 6, '0', STR_PAD_LEFT), 1, 0, 'R', true);
        $this->Cell(1, 16, '', 1, 1, 'R', true);

        // Reset text color for the content
        $this->SetTextColor(0, 0, 0);

        // Company and Customer Details
        $this->Ln(8);
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(92, 184, 92); // #5cb85c
        $this->Cell(100, 6.5, getEntityNameByCountryId($this->data['connection'],$this->data['entity']['entity_country_id']), 0, 0, 'L');
        $this->Cell(0, 6.5, $this->data['customer']['customer_contact_name'], 0, 1, 'L');

        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 0); // Reset to black
        $this->Cell(100, 6.5, getCountryNameById($this->data['connection'],$this->data['entity']['entity_country_id'])." ".$this->data['entity']['entity_address'], 0, 0, 'L');
        $this->Cell(0, 6.5, $this->data['customer']['customer_company_name'], 0, 1, 'L');

        $this->Cell(100, 6.5, getCountryNameById( $this->data['connection'],$this->data['entity']['entity_country_id']).", ".getCityNameById($this->data['connection'] ,$this->data['entity']['entity_city_id']), 0, 0, 'L');
        $this->Cell(0, 6.5, $this->data['customer']['customer_billing_address']. " ,".$this->data['customer']['customer_city'], 0, 1, 'L');

        $this->Cell(100, 6.5, $this->data['entity']['entity_website'], 0, 0, 'L');
        $this->Cell(0, 6.5, 'Email:'.$this->data['customer']['customer_email'], 0, 1, 'L');

        $this->Cell(100, 6.5, 'Phone:'.$this->data['entity']['entity_phone_number'], 0, 0, 'L');
        $this->Cell(0, 6.5, 'Phone:'.$this->data['customer']['customer_phone_1'], 0, 1, 'L');

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
        $this->Cell(39.6, 9, $this->data['date'], 'BRL', 0, 'C');
        $this->Cell(39.6, 9, $this->data['package_gross_weight'] . 'kg', 'BRL', 0, 'C');
        $this->Cell(39.6, 9, 'USD ' . number_format($this->data['cargo_value'], 2), 'BRL', 0, 'C');
        $this->Cell(39.6, 9, getCountryNameById($this->data['connection'],$this->data['ship_from']), 'BRL', 0, 'C');
        $this->Cell(39.6, 9, getCountryNameById($this->data['connection'],$this->data['ship_to']), 'BRL', 1, 'C');

        // Table Header
        $this->Ln(8);
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
            ['IOR', '', number_format($this->data['ior'], 2)],
            ['Estimated Duty & Taxes', '', number_format($this->data['duty_tax'], 2)],
            ['Estimated VAT (20% of CIP cost + Duties)', '', number_format($this->data['estimated_vat'], 2)],
            ['Freight', '', $this->data['freight']],
            ['Customs Brokerage', '', number_format($this->data['customs_brokerage'], 2)],
            ['Handling Charges', '', number_format($this->data['handling_charges'], 2)],
            ['Import Permit/Approval', '', $this->data['import_permit_approval']],
            ['Admin & Bank Charges', '', number_format($this->data['admin_bank_charges'], 2)],
            ['Compliance & Certification', '', number_format($this->data['compliance_certification'], 2)],
            ['Storage', '', number_format($this->data['storage'], 2)],
            ['Last Mile Delivery', '', number_format($this->data['last_mile_delivery'], 2)],
        ];

        foreach ($items as $item) {
            $this->Cell(128, 8, $item[0], 1, 0, 'L');
            $this->Cell(35, 8, $item[1], 1, 0, 'C');
            $this->Cell(35, 8, $item[2], 1, 1, 'R');
        }

        // Notes Section with Background
        $this->Ln(8);

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
        $this->Cell(0, 8, 'USD ' . number_format($this->data['grand_total'], 2),  "TRB", 1, 'R');

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
        $this->Cell(0, 10,'USD ' . number_format($this->data['grand_total'], 2), "TRB", 1, 'R', true);
        $this->SetTextColor(0, 0, 0); // Reset to black
        $this->SetDrawColor(221, 221, 221); // #ddd


        // Customer Acceptance
        // $this->Ln(2);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(198, 10, 'Customer Acceptance (Sign below)', 0, 1, 'L');

        $this->SetFont('Arial', '', 8);
        $this->Cell(110, 10, 'Print Name:', 'B', 0, 'L');
        $this->Cell(88, 10, '', '0', 1, 'L');
        // $this->Cell(198, 10, '', 0, 1, 'L');

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
    // Retrieve POST data and validate as necessary
    $estimate_from	 = $_POST['estimate_from'];
    $customer_id	 = $_POST['customer'];
    $ship_from	 = $_POST['ship_from'];
    $ship_to	 = $_POST['ship_to'];
    $cargo_value	 = !empty($_POST['cargo_value']) ? round($_POST['cargo_value'],2) : 0;
    $ior	 = !empty($_POST['ior']) ? round($_POST['ior'] , 2 ) : 0;
    $duty_tax	 = !empty($_POST['duty_tax']) ? round($_POST['duty_tax'],2) : 0;
    $estimated_vat	 = !empty($_POST['estimated_vat']) ? round($_POST['estimated_vat'],2) : 0;
    $customs_brokerage	 = !empty($_POST['customs_brokerage']) ? round($_POST['customs_brokerage'],2) : 0;
    $handling_charges	 = !empty($_POST['handling_charges']) ? round($_POST['handling_charges'],2) : 0 ;
    $admin_bank_charges	 = !empty($_POST['admin_bank_charges']) ? round($_POST['admin_bank_charges'],2) : 0;
    $compliance_certification	 = !empty($_POST['compliance_certification']) ? round($_POST['compliance_certification'],2) : 0;
    $storage	 = !empty($_POST['storage']) ? round($_POST['storage'],2) : 0 ;
    $last_mile_delivery	 = !empty($_POST['last_mile_delivery']) ? round($_POST['last_mile_delivery'],2) : 0;
    $freight	 = !empty($_POST['freight']) ? round($_POST['freight'],2) : 0;
    $import_permit_approval	 = !empty($_POST['import_permit_approval']) ? round($_POST['import_permit_approval'],2) : 0;
    $volumetric_weight	 = !empty($_POST['volumetric_weight']) ? round($_POST['volumetric_weight'],2) : 0;
    $grand_total	 = !empty($_POST['grand_total']) ? $_POST['grand_total'] : 0;
    $package_gross_weight	 = $_POST['package_gross_weight'];
    $length	 = $_POST['length'];
    $width	 = $_POST['width'];
    $height	 = $_POST['height'];
    $package_dimension	 = $_POST['package_dimension'];
    $entity = getEntityById($connection, $estimate_from);
    if($entity)
    {
        $entity_country_id = $entity['country_id'];
        $entity_city_id = $entity['city_id'];
        $entity_address = $entity['address'];
        $entity_website = $entity['website'];
        $entity_phone_number = $entity['phone_number'];

    }
    $customer = getCustomerById($connection, $customer_id);
    if($customer)
    {
        $customer_contact_name = $customer['contact_name'];
        $customer_company_name = $customer['company_name'];
        $customer_email = $customer['email'];
        $customer_city = $customer['city'];
        $customer_billing_address = $customer['billing_address'];
        $customer_phone_1 = $customer['phone_1'];

    }
    $date = date("d-M-y");
    $data = [
        'estimate_no' => $_POST['estimate_no'] ?? '',
        'entity' => [
            'entity_country_id' => $entity_country_id,
            'entity_city_id' => $entity_city_id,
            'entity_address' => $entity_address,
            'entity_website' => $entity_website,
            'entity_phone_number' => $entity_phone_number,
        ],
        'customer' => [
            'customer_contact_name' => $customer_contact_name,
            'customer_company_name' => $customer_company_name,
            'customer_email' => $customer_email,
            'customer_city' => $customer_city,
            'customer_billing_address' => $customer_billing_address,
            'customer_phone_1' => $customer_phone_1,
        ],
        'date' => $date,
        'package_gross_weight' => $package_gross_weight,
        'cargo_value' => $cargo_value,
        'ship_from' => $ship_from,
        'ship_to' => $ship_to,
        'ior' => $ior,
        'duty_tax' => $duty_tax,
        'estimated_vat' => $estimated_vat,
        'customs_brokerage' => $customs_brokerage,
        'handling_charges' => $handling_charges,
        'admin_bank_charges' => $admin_bank_charges,
        'compliance_certification' => $compliance_certification,
        'storage' => $storage,
        'last_mile_delivery' => $last_mile_delivery,
        'freight' => $freight,
        'import_permit_approval' => $import_permit_approval,
        'volumetric_weight' => $volumetric_weight,
        'grand_total' => $grand_total,
        'connection' => $connection,
    ];

    $pdf = new EstimatePDF($data);
    $pdf->generateEstimate();
    // $pdf->Output();
}




// // Add a page
// $pdf->SetMargins(6, 6);
// // $pdf->AliasNbPages();
// $pdf->AddPage("P","A4",0);

// // Title Section with Header Background
// $pdf->SetFillColor(217, 83, 79); // #d9534f
// $pdf->SetTextColor(255, 255, 255); // white
// $pdf->SetDrawColor(217, 83, 79); // #d9534f
// // $pdf->SetLineWidth(1);
// $pdf->Cell(198, 1, '', 1, 1, 'C', true); // Creating the background rectangle

// $pdf->SetFont('Arial', 'B', 16);
// $pdf->Cell(1, 16, '', 1, 0, 'L', true);
// $pdf->Cell(98, 16, 'ESTIMATE', 1, 0, 'L', true);
// $pdf->SetFont('Arial', '', 12);
// $pdf->Cell(98, 16, '# UT60006', 1, 0, 'R', true);
// $pdf->Cell(1, 16, '', 1, 1, 'R', true);


// $pdf->Output();
