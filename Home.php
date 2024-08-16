<?php
include_once('database/database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freight Cost Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            color: #333;
            margin-top: 10px;
        }

        input[type="number"], .insurance-options {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .insurance-options {
            display: flex;
            align-items: center;
        }

        .insurance-options label {
            margin-left: 10px;
            margin-right: 20px;
        }

        button {
            padding: 10px;
            margin-top: 20px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4cae4c;
        }

        .clear-button {
            margin-top: 10px;
            background-color: #d9534f;
        }

        .clear-button:hover {
            background-color: #c9302c;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .location {
            font-size: 0.9em;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Freight Cost Calculator</h1>
        <form id="shippingForm">
            <label for="weight">Enter Parcel Weight (kg):</label>
            <input type="number" id="weight" name="weight" step="0.1" required>
            
            <label for="length">Enter Length (cm):</label>
            <input type="number" id="length" name="length" required>
            
            <label for="width">Enter Width (cm):</label>
            <input type="number" id="width" name="width" required>
            
            <label for="height">Enter Height (cm):</label>
            <input type="number" id="height" name="height" required>
            
            <label for="pickupPincode">Enter Pickup Pincode:</label>
            <input type="number" id="pickupPincode" name="pickupPincode" required>
            <p id="pickupLocation" class="location"></p>
            
            <label for="deliveryPincode">Enter Delivery Pincode:</label>
            <input type="number" id="deliveryPincode" name="deliveryPincode" required>
            <p id="deliveryLocation" class="location"></p>

            <label for="shipmentValue">Enter Shipment Value (₹):</label>
            <input type="number" id="shipmentValue" name="shipmentValue" required>

            <label>Insurance Required (₹100 if value > ₹3000):</label>
            <div class="insurance-options">
                <input type="radio" id="insuranceYes" name="insurance" value="yes">
                <label for="insuranceYes">Yes</label>
                <input type="radio" id="insuranceNo" name="insurance" value="no" checked>
                <label for="insuranceNo">No</label>
            </div>

            <p id="insuranceError" class="error"></p>
            <p id="shipmentValueError" class="error"></p>

            <button type="submit">Calculate Cost</button>
            <button type="button" class="clear-button" onclick="clearForm()">Clear</button>
        </form>
        <p id="result"></p>
        <p id="error" class="error"></p>
    </div>
    <script>
        document.getElementById('shippingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            calculateCost();
        });

        function calculateCost() {
            const weight = parseFloat(document.getElementById('weight').value);
            const length = parseFloat(document.getElementById('length').value);
            const width = parseFloat(document.getElementById('width').value);
            const height = parseFloat(document.getElementById('height').value);
            const pickupPincode = document.getElementById('pickupPincode').value;
            const deliveryPincode = document.getElementById('deliveryPincode').value;
            const shipmentValue = parseFloat(document.getElementById('shipmentValue').value);
            const insurance = document.querySelector('input[name="insurance"]:checked').value === 'yes';
            const errorElement = document.getElementById('error');
            const resultElement = document.getElementById('result');
            const insuranceErrorElement = document.getElementById('insuranceError');
            const shipmentValueErrorElement = document.getElementById('shipmentValueError');
            errorElement.textContent = '';
            resultElement.textContent = '';

            // Validate Shipment Value
            if (shipmentValue > 10000) {
                shipmentValueErrorElement.textContent = 'Error: Shipment value cannot exceed ₹10,000.';
                return;
            } else {
                shipmentValueErrorElement.textContent = '';
            }

            // Validate Insurance
            if (shipmentValue > 3000 && !insurance) {
                insuranceErrorElement.textContent = 'Insurance is mandatory for shipments over ₹3000.';
                return;
            } else {
                insuranceErrorElement.textContent = '';
            }

            if (weight > 10) {
                errorElement.textContent = 'Error: Weight above 10 kg cannot be shipped.';
                return;
            }

            validatePincode(pickupPincode, 'pickupLocation', function(isValidPickup) {
                if (!isValidPickup) {
                    errorElement.textContent = 'Invalid Pickup Pincode';
                    return;
                }

                validatePincode(deliveryPincode, 'deliveryLocation', function(isValidDelivery) {
                    if (!isValidDelivery) {
                        errorElement.textContent = 'Invalid Delivery Pincode';
                        return;
                    }

                    let actualWeight = weight;
                    let volumetricWeight = (length * width * height) / 5000;
                    let finalWeight = Math.max(actualWeight, volumetricWeight);

                    let cost = 0;

                    if (finalWeight <= 0.5) {
                        cost = 75;
                    } else if (finalWeight <= 4) {
                        cost = 75 + Math.ceil((finalWeight - 0.5) / 0.5) * 72;
                    } else if (finalWeight <= 5) {
                        cost = 626;
                    } else if (finalWeight <= 9) {
                        cost = 626 + Math.ceil((finalWeight - 5) / 1) * 49;
                    } else if (finalWeight <= 10) {
                        cost = 873;
                    }

                    if (insurance) {
                        cost += 100;
                    }

                    resultElement.textContent = `The estimated shipping cost is ₹${cost}.`;
                });
            });
        }

        function validatePincode(pincode, locationElementId, callback) {
            if (pincode.length === 6) {
                fetch(`https://api.postalpincode.in/pincode/${pincode}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data[0].Status === "Success") {
                            const location = data[0].PostOffice[0].District + ", " + data[0].PostOffice[0].State;
                            document.getElementById(locationElementId).textContent = `Location: ${location}`;
                            callback(true);
                        } else {
                            document.getElementById(locationElementId).textContent = 'Invalid Pincode';
                            callback(false);
                        }
                    });
            } else {
                document.getElementById(locationElementId).textContent = '';
                callback(false);
            }
        }

        function clearForm() {
            document.getElementById('shippingForm').reset();
            document.getElementById('pickupLocation').textContent = '';
            document.getElementById('deliveryLocation').textContent = '';
            document.getElementById('result').textContent = '';
            document.getElementById('error').textContent = '';
            document.getElementById('insuranceError').textContent = '';
            document.getElementById('shipmentValueError').textContent = '';
        }
    </script>
</body>
</html>