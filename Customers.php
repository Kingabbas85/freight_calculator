<?php
include_once("includes/session.php");
include_once('database/database.php');

if (isset($_SESSION['user_email']) == true) {
    // Fetch customers
    $query = "SELECT * FROM customers";
    $result = mysqli_query($connection, $query);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Customers</title>
        <?php include_once('includes/header.php'); ?>
    </head>

    <body>
        <?php include_once('includes/navbar.php'); ?>
        <?php include_once('includes/alerts.php'); ?>
        <div class="layout" id="layout">
            <div class="inner-layout">
                <div class="d-flex justify-content-between page-heading">
                    <div>Customers</div>
                    <div class="add_new">
                        <a href="NewCustomer"> <i class="fas fa-plus"></i>&nbsp; Add New Customer </a>
                    </div>
                </div>
                <div class="line-break"></div>

                <div class="mt-4 context">
                    <table  id="CustomersTable" class="table-sm w-100 table_style mt-2" style="min-width:1000px;">
                        <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Contact Name</th>
                                <th>Company Name</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['customer_id']; ?></td>
                                    <td><?php echo $row['contact_name']; ?></td>
                                    <td><?php echo $row['company_name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['city']; ?></td>
                                    <td>
                                        <a href="EditCustomer?id=<?php echo md5($row['Id']); ?>" class="text-primary"><i class="fas fa-edit"></i></a>&nbsp
                                        <a href="javascript:void(0);"class="delete-customer" data-id="<?php echo $row['Id']; ?>"><i class="fas fa-trash text-danger"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/customers.js?clear_cache=<?php echo time(); ?>"></script>

    </html>
<?php
} else {
    header('location: login');
}
?>
