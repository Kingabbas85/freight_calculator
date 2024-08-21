$(document).ready(function () {
    // Initialize the DataTable
    $("#RatesTable").DataTable({
        scrollX: true,
        scrollCollapse: true,
        processing: true,
        lengthChange: true,
        lengthMenu: [10, 25, 100, 200],
        pageLength: 10,
        searching: true,
        language: {
            paginate: {
                previous: "&laquo;",
                next: "&raquo;",
            },
        },
    });

    // Form validation and submission for new rate
    $(".rate-form .submit-btn").click(function (e) {
        e.preventDefault();
        $(".submit-btn").prop("disabled", true);

        var region_id = $("#region_id").val();
        var country_id = $("#country_id").val();
        var tgs_sla_zone = $("#tgs_sla_zone").val();
        var tbs_priority = $("#tbs_priority").val();
        var duty_tax = $("#duty_tax").val();
        var customs_brokerage = $("#customs_brokerage").val();
        var handling = $("#handling").val();
        var ior = $("#ior").val();

        var isRequired = 0;

        if (!region_id) {
            $("#region_id").css("border", "1px solid red");
            isRequired++;
        }
        if (!country_id) {
            $("#country_id").css("border", "1px solid red");
            isRequired++;
        }

        if (isRequired) {
            swal({
                text: "* fields are required!",
                icon: "warning",
                button: "OK",
            }).then(function () {
                $(".submit-btn").prop("disabled", false);
            });
        } else {
            $(".loader-div").show();
            $.ajax({
                url: 'ajaxcallforrates.php',
                method: 'POST',
                data: $("#rate-form").serialize() + '&action=NewRate',
                success: function (response) {
                    $(".loader-div").hide();
                    if (response == 1) {
                        $(".success-alert-text").text("Rate added successfully");
                        $(".success-alert").css("display", "flex");
                        fadeOutAlertMessage();
                        setTimeout(() => {
                            window.location = "rates";
                        }, 3000);
                    } else if (response == "RATE_ALREADY_EXIST") {
                        $(".warning-alert-text").text("Rate already exists");
                        $(".warning-alert").css("display", "flex");
                        fadeOutAlertMessage();
                        setTimeout(() => {
                            $(".submit-btn").prop("disabled", false);
                        }, 3000);
                    } else {
                        $(".error-alert-text").text("Something went wrong!");
                        $(".error-alert").css("display", "flex");
                        fadeOutAlertMessage();
                    }
                },
            });
        }
    });

    // Form validation and submission for editing a rate
    $(".edit-rate-form .submit-btn").click(function (e) {
        e.preventDefault();
        $(".submit-btn").prop("disabled", true);

        var region_id = $("#region_id").val();
        var country_id = $("#country_id").val();
        var tgs_sla_zone = $("#tgs_sla_zone").val();
        var tbs_priority = $("#tbs_priority").val();
        var duty_tax = $("#duty_tax").val();
        var customs_brokerage = $("#customs_brokerage").val();
        var handling = $("#handling").val();
        var ior = $("#ior").val();

        var isRequired = 0;

        if (!region_id) {
            $("#region_id").css("border", "1px solid red");
            isRequired++;
        }
        if (!country_id) {
            $("#country_id").css("border", "1px solid red");
            isRequired++;
        }

        if (isRequired) {
            swal({
                text: "* fields are required!",
                icon: "warning",
                button: "OK",
            }).then(function () {
                $(".submit-btn").prop("disabled", false);
            });
        } else {
            $(".loader-div").show();
            $.ajax({
                url: 'ajaxcallforrates.php',
                method: 'POST',
                data: $("#edit-rate-form").serialize() + '&action=EditRate',
                success: function (response) {
                    $(".loader-div").hide();
                    if (response == 1) {
                        $(".success-alert-text").text("Rate updated successfully");
                        $(".success-alert").css("display", "flex");
                        fadeOutAlertMessage();
                        setTimeout(() => {
                            window.location = "rates";
                        }, 3000);
                    } else {
                        $(".error-alert-text").text("Something went wrong!");
                        $(".error-alert").css("display", "flex");
                        fadeOutAlertMessage();
                    }
                },
            });
        }
    });

    // Delete rate logic
    $(".delete-rate-btn").click(function () {
        var rate_id = $(this).data("id");
        swal({
            text: "Are you sure you want to delete this rate?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $(".loader-div").show();
                $.ajax({
                    url: 'ajaxcallforrates.php',
                    method: 'POST',
                    data: {
                        action: "DeleteRate",
                        id: rate_id,
                    },
                    success: function (response) {
                        $(".loader-div").hide();
                        if (response == 1) {
                            $(".success-alert-text").text("Rate deleted successfully");
                            $(".success-alert").css("display", "flex");
                            fadeOutAlertMessage();
                            window.location.reload();
                        } else {
                            swal({
                                text: "Error deleting rate!",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });

    /* -------------------------------------------------------------------------- */
	/*                                      Dependant country on region           */
	/* -------------------------------------------------------------------------- */

	$('#region_id').change(function() {
        var regionId = $(this).val();
        if (regionId) {
            $(".loader-div").show();
            $.ajax({
                url: 'ajaxcallforrates.php',
                type: 'POST',
                data: { region_id: regionId, action: 'getCountriesByRegion' },
                success: function(response) {
                    $(".loader-div").hide();
                    $('#country_id').html(response);
                }
            });
        } else {
            $('#country_id').html('<option value="">Select Country</option>');
        }
    });
});
