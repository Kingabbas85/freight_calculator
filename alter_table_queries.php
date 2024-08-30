<?php
include_once("includes/session.php");
include_once('database/database.php');
    
if (isset($_SESSION['user_email']) == true) {
?>

<!DOCTYPE html>
        <html>

        <head>
            <title>DAS - Altertable</title>
            <?php include_once('includes/header.php'); ?>
            <style>
                /* .close {
			background:none;
			border:none;
			font-size:26px;
		} */
            </style>
        </head>

        <body>
            <?php //include_once('includes/navbar.php'); ?>
            <div class="layout" id="layout">
                <div class="inner-layout">
                    <div class="d-flex justify-content-between page-heading">
                        <div> Create Database Tables </div>
                    </div>
                    <?php

                                        /* -------------------------------------------------------------------------- */
                    /*                      // Check if the 'regions' table exists                */
                    /* -------------------------------------------------------------------------- */
                    $checkTableQuery = "SHOW TABLES LIKE 'regions'";
                    $tableExists = $connection->query($checkTableQuery)->num_rows > 0;

                    if (!$tableExists) {
                        $createTableSQL = "CREATE TABLE regions (
                            Id INT AUTO_INCREMENT PRIMARY KEY,
                            name VARCHAR(255) NOT NULL,
                            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";

                        if ($connection->query($createTableSQL) === TRUE) {
                            echo '<div class="alert alert-success">Table "regions" created successfully.</div>';
                        } else {
                            echo '<div class="alert alert-danger">Error creating the table: ' . $connection->error . '</div>';
                        }
                    } else {
                        echo '<div class="alert alert-warning">Table "regions" already exists. No action needed.</div>';
                    }

                    /* -------------------------------------------------------------------------- */
                    /*                     // Check if the 'countries' table exists               */
                    /* -------------------------------------------------------------------------- */
                    $checkTableQuery = "SHOW TABLES LIKE 'countries'";
                    $tableExists = $connection->query($checkTableQuery)->num_rows > 0;

                    if (!$tableExists) {
                        $createTableSQL = "CREATE TABLE countries (
                            Id INT AUTO_INCREMENT PRIMARY KEY,
                            name VARCHAR(255) NOT NULL,
                            country_code VARCHAR(10) NOT NULL,
                            region_id INT NOT NULL,
                            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                            FOREIGN KEY (region_id) REFERENCES regions(Id)
                        )";

                        if ($connection->query($createTableSQL) === TRUE) {
                            echo '<div class="alert alert-success">Table "countries" created successfully.</div>';
                        } else {
                            echo '<div class="alert alert-danger">Error creating the table: ' . $connection->error . '</div>';
                        }
                    } else {
                        echo '<div class="alert alert-warning">Table "countries" already exists. No action needed.</div>';
                    }
                    /* -------------------------------------------------------------------------- */
                    /*                       // Check if the 'rates' table exists                 */
                    /* -------------------------------------------------------------------------- */
                    $checkTableQuery = "SHOW TABLES LIKE 'rates'";
                    $tableExists = $connection->query($checkTableQuery)->num_rows > 0;

                    if (!$tableExists) {
                        $createTableSQL = "CREATE TABLE rates (
                            Id INT AUTO_INCREMENT PRIMARY KEY,
                            region_id INT NOT NULL,
                            country_id INT NOT NULL,
                            duty_tax DECIMAL(10, 2) NOT NULL,
                            customs_brokerage DECIMAL(10, 2) NOT NULL,
                            handling DECIMAL(10, 2) NOT NULL,
                            ior DECIMAL(10, 2) NOT NULL,
                            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                            FOREIGN KEY (region_id) REFERENCES regions(Id),
                            FOREIGN KEY (country_id) REFERENCES countries(Id)
                        )";

                        if ($connection->query($createTableSQL) === TRUE) {
                            echo '<div class="alert alert-success">Table "rates" created successfully.</div>';
                        } else {
                            echo '<div class="alert alert-danger">Error creating the table: ' . $connection->error . '</div>';
                        }
                    } else {
                        echo '<div class="alert alert-warning">Table "rates" already exists. No action needed.</div>';
                    }

                     /* -------------------------------------------------------------------------- */
                    /*                      // Check if the 'cities' table exists                 */
                    /* -------------------------------------------------------------------------- */
                    $checkTableQuery = "SHOW TABLES LIKE 'cities'";
                    $tableExists = $connection->query($checkTableQuery)->num_rows > 0;

                    if (!$tableExists) {
                        $createTableSQL = "CREATE TABLE cities (
                            Id INT AUTO_INCREMENT PRIMARY KEY,
                            name VARCHAR(255) NOT NULL,
                            country_id INT NOT NULL,
                            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                            FOREIGN KEY (country_id) REFERENCES countries(Id)
                        )";

                        if ($connection->query($createTableSQL) === TRUE) {
                            echo '<div class="alert alert-success">Table "cities" created successfully.</div>';
                        } else {
                            echo '<div class="alert alert-danger">Error creating the table: ' . $connection->error . '</div>';
                        }
                    } else {
                        echo '<div class="alert alert-warning">Table "cities" already exists. No action needed.</div>';
                    }

                    /* -------------------------------------------------------------------------- */
                    /*                      // Check if the 'entity' table exists                 */
                    /* -------------------------------------------------------------------------- */
                    $checkTableQuery = "SHOW TABLES LIKE 'entity'";
                    $tableExists = $connection->query($checkTableQuery)->num_rows > 0;

                    if (!$tableExists) {
                        $createTableSQL = "CREATE TABLE entity (
                            Id INT AUTO_INCREMENT PRIMARY KEY,
                            country_id INT NOT NULL,
                            city_id INT NOT NULL,
                            address TEXT NOT NULL,
                            website VARCHAR(255),
                            phone_number VARCHAR(20),
                            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                            FOREIGN KEY (country_id) REFERENCES countries(Id)
                            -- FOREIGN KEY (city_id) REFERENCES cities(Id) -- Assuming 'cities' table exists
                        )";

                        if ($connection->query($createTableSQL) === TRUE) {
                            echo '<div class="alert alert-success">Table "entity" created successfully.</div>';
                        } else {
                            echo '<div class="alert alert-danger">Error creating the table: ' . $connection->error . '</div>';
                        }
                    } else {
                        echo '<div class="alert alert-warning">Table "entity" already exists. No action needed.</div>';
                    }

                    /* -------------------------------------------------------------------------- */
                    /*                    // Check if the 'customers' table exists                */
                    /* -------------------------------------------------------------------------- */
                    $checkTableQuery = "SHOW TABLES LIKE 'customers'";
                    $tableExists = $connection->query($checkTableQuery)->num_rows > 0;

                    if (!$tableExists) {
                        $createTableSQL = "CREATE TABLE customers (
                            Id INT AUTO_INCREMENT PRIMARY KEY,
                            customer_id VARCHAR(50) NOT NULL,
                            company_name VARCHAR(255) NOT NULL,
                            contact_name VARCHAR(255),
                            phone_1 VARCHAR(20),
                            phone_2 VARCHAR(20),
                            email VARCHAR(255),
                            city VARCHAR(255),
                            mailing_address TEXT,
                            billing_address TEXT,
                            notes TEXT,
                            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";

                        if ($connection->query($createTableSQL) === TRUE) {
                            echo '<div class="alert alert-success">Table "customers" created successfully.</div>';
                        } else {
                            echo '<div class="alert alert-danger">Error creating the table: ' . $connection->error . '</div>';
                        }
                    } else {
                        echo '<div class="alert alert-warning">Table "customers" already exists. No action needed.</div>';
                    }


                    /* -------------------------------------------------------------------------- */
                    /*                   // Check if the 'settings' table exists                  */
                    /* -------------------------------------------------------------------------- */
                    $checkSettingsTableQuery = "SHOW TABLES LIKE 'settings'";
                    $settingsTableExists = $connection->query($checkSettingsTableQuery)->num_rows > 0;

                    if (!$settingsTableExists) {
                        // Define the new table name
                        $newTableName = 'settings';

                        // SQL statement to create the table
                        $createTableSQL = "CREATE TABLE $newTableName (
                            Id INT AUTO_INCREMENT PRIMARY KEY,
                            name VARCHAR(255) NOT NULL,
                            val TEXT NOT NULL,
                            `group` VARCHAR(255) NOT NULL,
                            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";

                        // Execute the query and check the result
                        if ($connection->query($createTableSQL) === TRUE) {
                            echo '<div class="alert alert-success">Table "' . $newTableName . '" created successfully.</div>';
                        } else {
                            echo '<div class="alert alert-danger">Error creating the table: ' . $connection->error . '</div>';
                        }
                    } else {
                        // Table exists, show message
                        echo '<div class="alert alert-warning">Table "settings" already exists. No action needed.</div>';
                    }

                    /* -------------------------------------------------------------------------- */
                    /*                   // Check if the 'count_number' table exists                  */
                    /* -------------------------------------------------------------------------- */
                    $checkcount_numberTableQuery = "SHOW TABLES LIKE 'count_number'";
                    $count_numberTableExists = $connection->query($checkcount_numberTableQuery)->num_rows > 0;

                    if (!$count_numberTableExists) {
                        // Define the new table name
                        $newTableName = 'count_number';

                        // SQL statement to create the table
                        $createTableSQL = "CREATE TABLE $newTableName (
                            Id INT AUTO_INCREMENT PRIMARY KEY,
                            type VARCHAR(255) NOT NULL,
                            count  INT NOT NULL,
                            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";

                        // Execute the query and check the result
                        if ($connection->query($createTableSQL) === TRUE) {
                            echo '<div class="alert alert-success">Table "' . $newTableName . '" created successfully.</div>';
                        } else {
                            echo '<div class="alert alert-danger">Error creating the table: ' . $connection->error . '</div>';
                        }
                    } else {
                        // Table exists, show message
                        echo '<div class="alert alert-warning">Table "count_number" already exists. No action needed.</div>';
                    }
                   





?>

</div>
</div>
</body>

</html>
<?php

} else {
header('location: Unauthorized');
}
?>