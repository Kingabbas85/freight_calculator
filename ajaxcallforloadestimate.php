<?php
include_once('database/database.php');
include_once('includes/helpers.php');


if (isset($_POST["getEstimateModalContent"]) && $_POST["getEstimateModalContent"] == 1) {

    $estimate_no = 0;
    $query3 = "Select * FROM count_number where Id = '1'";
    $result3 = mysqli_query($connection, $query3);
    if (mysqli_num_rows($result3) > 0) {
        while ($row3 = mysqli_fetch_assoc($result3)) {
            $estimate_no = $row3['count'];
        }
    }
    $estimate_no = $estimate_no + 1;
    $update_count = "Update `count_number` SET count = '$estimate_no' WHERE Id = '1'";
    mysqli_query($connection, $update_count);
    // pre_r($_POST);
    $estimate_from     = $_POST['estimate_from'];
    $customer_id     = $_POST['customer'];
    $ship_from     = $_POST['ship_from'];
    $ship_to     = $_POST['ship_to'];
    $cargo_value     = !empty($_POST['cargo_value']) ? round($_POST['cargo_value'], 2) : 0;
    $ior     = !empty($_POST['ior']) ? round($_POST['ior'], 2) : 0;
    $duty_tax     = !empty($_POST['duty_tax']) ? round($_POST['duty_tax'], 2) : 0;
    $estimated_vat     = !empty($_POST['estimated_vat']) ? round($_POST['estimated_vat'], 2) : 0;
    $customs_brokerage     = !empty($_POST['customs_brokerage']) ? round($_POST['customs_brokerage'], 2) : 0;
    $handling_charges     = !empty($_POST['handling_charges']) ? round($_POST['handling_charges'], 2) : 0;
    $admin_bank_charges     = !empty($_POST['admin_bank_charges']) ? round($_POST['admin_bank_charges'], 2) : 0;
    $compliance_certification     = !empty($_POST['compliance_certification']) ? round($_POST['compliance_certification'], 2) : 0;
    $storage     = !empty($_POST['storage']) ? round($_POST['storage'], 2) : 0;
    $last_mile_delivery     = !empty($_POST['last_mile_delivery']) ? round($_POST['last_mile_delivery'], 2) : 0;
    $freight     = !empty($_POST['freight']) ? round($_POST['freight'], 2) : 0;
    $import_permit_approval     = !empty($_POST['import_permit_approval']) ? round($_POST['import_permit_approval'], 2) : 0;
    $volumetric_weight     = !empty($_POST['volumetric_weight']) ? round($_POST['volumetric_weight'], 2) : 0;
    $grand_total     = !empty($_POST['grand_total']) ? round($_POST['grand_total'], 2) : 0;
    $total_package_gross_weight     = !empty($_POST['total_package_gross_weight']) ? round($_POST['total_package_gross_weight'], 2) : 0;
    $custom_field_name     = !empty($_POST['custom_field_name']) ? $_POST['custom_field_name'] : 'Custom Field' ;
    $custom_field_value     = !empty($_POST['custom_field_value']) ? round($_POST['custom_field_value'], 2) : 0;
    $length     = $_POST['length'];
    $width     = $_POST['width'];
    $height     = $_POST['height'];
    $package_dimension     = $_POST['package_dimension'];

    // $grand_total = $ior + $estimated_vat + $duty_tax  + $freight + $customs_brokerage + $import_permit_approval + $volumetric_weight + $admin_bank_charges + $compliance_certification + $storage;
    $entity = getEntityById($connection, $estimate_from);
    if ($entity) {
        $entity_country_id = $entity['country_id'];
        $entity_city_id = $entity['city_id'];
        $entity_address = $entity['address'];
        $entity_website = $entity['website'];
        $entity_phone_number = $entity['phone_number'];
    }
    $customer = getCustomerById($connection, $customer_id);
    if ($customer) {
        $customer_contact_name = $customer['contact_name'];
        $customer_company_name = $customer['company_name'];
        $customer_email = $customer['email'];
        $customer_city = $customer['city'];
        $customer_billing_address = $customer['billing_address'];
        $customer_phone_1 = $customer['phone_1'];
    }
    $date = date("d-M-y");

?>
    <div style="background-color: #fff; padding: 0; border-radius: 6px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <div class="header-bg text-center">
            <div class="row">
                <div class="col-md-9 col-xs-6 text-left">
                    <h4><strong>ESTIMATE</strong></h4>
                </div>
                <div class="col-md-3 col-xs-6 text-right">
                    <h5># UT<?php echo CreateSixDigitNumber($estimate_no) ?> </h5>
                </div>
            </div>
        </div>

        <div style="padding: 30px;">
            <div class="row bordered-div">
                <div class="col-sm-6">
                    <p class="section-title"><?php echo getEntityNameByCountryId($connection, $entity_country_id); ?></p>
                    <p><?php echo getCountryNameById($connection, $entity_country_id) . " " . $entity_address; ?> </p>
                    <p><?php echo getCountryNameById($connection, $entity_country_id) . ", " . getCityNameById($connection, $entity_city_id); ?> </p>
                    <p>Website: <a href="https:/<?php echo $entity_website ?>"><?php echo $entity_website; ?></a></p>
                    <p>Phone: <?php echo $entity_phone_number; ?></p>
                </div>
                <div class="col-sm-6">
                    <p class="section-title"><?php echo $customer_contact_name; ?></p>
                    <p><?php echo $customer_company_name; ?></p>
                    <p><?php echo $customer_billing_address; ?> , <?php echo $customer_city; ?></p>
                    <p>Email: <?php echo $customer_email; ?></p>
                    <p>Phone: <?php echo $customer_phone_1; ?></p>
                </div>
            </div>

            <div class="row bordered-div top_table text-center">
                <div class="col-xs-2 bordered-right">
                    <p><strong>DATE</strong></p>
                    <p><?php echo $date;  ?></p>
                </div>
                <div class="col-xs-3 bordered-right">
                    <p><strong>CHARGEBLE WEIGHT</strong></p>
                    <p><?php echo $total_package_gross_weight;  ?> &nbsp;Kg</p>
                </div>
                <div class="col-xs-3 bordered-right">
                    <p><strong>CARGO VALUE</strong></p>
                    <p>USD &nbsp;<?php echo $cargo_value;  ?></p>
                </div>
                <div class="col-xs-2 bordered-right">
                    <p><strong>SHIP FROM</strong></p>
                    <p><?php echo getCountryNameById($connection, $ship_from);  ?></p>
                </div>
                <div class="col-xs-2">
                    <p><strong>SHIP TO</strong></p>
                    <p><?php echo  getCountryNameById($connection, $ship_to);  ?></p>
                </div>
            </div>

            <div class="row">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="col-xs-6">DESCRIPTION</th>
                            <th class="col-xs-3 text-center">TAXED</th>
                            <th class="col-xs-3 text-right">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $skippedRows = 1; // Initialize counter for skipped rows
                        if ($ior != 0) { ?>
                            <tr>
                                <td>IOR</td>
                                <td class="text-center"></td>
                                <td class="text-right"><?php echo number_format($ior, 2); ?></td>
                            </tr>
                        <?php } else {
                            $skippedRows++; // Increment skipped rows
                        }
                        ?>

                        <?php if ($duty_tax != 0) { ?>
                            <tr>
                                <td>Estimated Duty & Taxes</td>
                                <td class="text-center"></td>
                                <td class="text-right"><?php echo number_format($duty_tax, 2); ?></td>
                            </tr>
                        <?php } else {
                            $skippedRows++; // Increment skipped rows
                        }
                        ?>

                        <?php if ($estimated_vat != 0) { ?>
                            <tr>
                                <td>Estimated VAT (20% of CIP cost + Duties )</td>
                                <td class="text-center"></td>
                                <td class="text-right"><?php echo number_format($estimated_vat, 2); ?></td>
                            </tr>
                        <?php } else {
                            $skippedRows++; // Increment skipped rows
                        }
                        ?>

                        <?php if ($freight != 0) { ?>
                            <tr>
                                <td>Freight</td>
                                <td class="text-center"></td>
                                <td class="text-right"><?php echo number_format($freight, 2); ?></td>
                            </tr>
                        <?php } else {
                            $skippedRows++; // Increment skipped rows
                        }
                        ?>

                        <?php if ($customs_brokerage != 0) { ?>
                            <tr>
                                <td>Customs Brokerage</td>
                                <td class="text-center"></td>
                                <td class="text-right"><?php echo number_format($customs_brokerage, 2); ?></td>
                            </tr>
                        <?php } else {
                            $skippedRows++; // Increment skipped rows
                        }
                        ?>

                        <?php if ($handling_charges != 0) { ?>
                            <tr>
                                <td>Handling Charges</td>
                                <td class="text-center"></td>
                                <td class="text-right"><?php echo number_format($handling_charges, 2); ?></td>
                            </tr>
                        <?php } else {
                            $skippedRows++; // Increment skipped rows
                        }
                        ?>

                        <?php if ($import_permit_approval != 0) { ?>
                            <tr>
                                <td>Import Permit/Approval</td>
                                <td class="text-center"></td>
                                <td class="text-right"><?php echo number_format($import_permit_approval, 2); ?></td>
                            </tr>
                        <?php } else {
                            $skippedRows++; // Increment skipped rows
                        }
                        ?>

                        <?php if ($admin_bank_charges != 0) { ?>
                            <tr>
                                <td>Admin & Bank Charges</td>
                                <td class="text-center"></td>
                                <td class="text-right"><?php echo number_format($admin_bank_charges, 2); ?></td>
                            </tr>
                        <?php } else {
                            $skippedRows++; // Increment skipped rows
                        }
                        ?>

                        <?php if ($compliance_certification != 0) { ?>
                            <tr>
                                <td>Compliance & Certification</td>
                                <td class="text-center"></td>
                                <td class="text-right"><?php echo number_format($compliance_certification, 2); ?></td>
                            </tr>
                        <?php } else {
                            $skippedRows++; // Increment skipped rows
                        }
                        ?>

                        <?php if ($storage != 0) { ?>
                            <tr>
                                <td>Storage</td>
                                <td class="text-center"></td>
                                <td class="text-right"><?php echo number_format($storage, 2); ?></td>
                            </tr>
                        <?php } else {
                            $skippedRows++; // Increment skipped rows
                        }
                        ?>
                        <?php if ($custom_field_value) { ?>
                            <tr>
                                <td><?php echo $custom_field_name ?> </td>
                                <td class="text-center"></td>
                                <td class="text-right"><?php echo number_format($custom_field_value, 2); ?></td>
                            </tr>
                        <?php } else {
                            $skippedRows++; // Increment skipped rows
                        }?>

                        <?php if ($last_mile_delivery != 0) { ?>
                            <tr>
                                <td>Last Mile Delivery</td>
                                <td class="text-center"></td>
                                <td class="text-right"><?php echo number_format($last_mile_delivery, 2); ?></td>
                            </tr>
                        <?php } else {
                            $skippedRows++; // Increment skipped rows
                        }
                        // Add empty rows for each skipped row
                        for ($i = 0; $i < $skippedRows; $i++) { ?>
                            <tr class="empty-row">
                                <td></td> <!-- Empty row -->
                                <td></td> <!-- Empty row -->
                                <td></td> <!-- Empty row -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>

            <div class="row">
                <div class="col-sm-8 table-bordered">
                    <div class="note-bg">NOTE</div>
                    <ol class="footer-note">
                        <li>The content of this document is proprietary, confidential, and intended solely for the recipient.</li>
                        <li>No part of this document may be disclosed, reproduced, or forwarded to anyone without the written authorization of Company Name.</li>
                    </ol>
                    <p><strong>Customer Acceptance (Sign below)</strong></p>
                    <div style="border-top: 1px solid #ddd; margin-top: 40px; padding-top: 10px;">
                        <p>Print Name:</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Subtotal:</td>
                                <td class="text-right"><strong><?php echo number_format($grand_total, 2); ?></strong></td>
                            </tr>
                            <tr>
                                <td>Taxable:</td>
                                <td class="text-right"><strong>-</strong></td>
                            </tr>
                            <tr>
                                <td>Tax rate:</td>
                                <td class="text-right"><strong>6.250%</strong></td>
                            </tr>
                            <tr>
                                <td>Tax due:</td>
                                <td class="text-right"><strong>-</strong></td>
                            </tr>
                            <tr>
                                <td>Other:</td>
                                <td class="text-right"><strong>-</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="total-bg">
                        <div class="row">
                            <div class="col-xs-6">
                                TOTAL:
                            </div>
                            <div class="col-xs-6 text-right">
                                USD &nbsp;<?php echo  number_format($grand_total, 2); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row disclaimer-section">
                <div class="disclaimer-bg">Disclaimer :</div>
                <p>The charges in this quote are based on current package dimensions and declared value. Final charges will be calculated from precise measurements and weights verified at shipment processing. 'Variable' charges are estimates and will be billed according to actual costs, depending on factors like cargo size, weight, storage duration, required approvals, and destination regulations. The final invoice may differ from estimated amounts. Clients should verify dimensions and values and consult us for clarifications before confirming shipment to ensure final charge accuracy.</p>
            </div>
            <input type="hidden" name="estimate_no" class="estimate_no" id="estimate_no" value="<?php echo CreateSixDigitNumber($estimate_no); ?>"
                </div>
        </div>

    <?php
}
    ?>