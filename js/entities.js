$(document).ready(function () {
    // Initialize the datatable
    $("#EntityTable").DataTable({
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

    // Load cities based on selected country
    function loadCities(country_id) {
        $.ajax({
            url: Domain + "/ajaxcallforentities.php",
            method: "POST",
            data: { action: "GetCities", country_id: country_id },
            success: function (response) {
                $('#city_id').html(response);
            }
        });
    }

    $('#country_id').change(function () {
        var country_id = $(this).val();
        loadCities(country_id);
    });

    // Form validation and submission for new entity
    $(".entity-form .submit-btn").click(function (e) {
        e.preventDefault();
        $(".submit-btn").prop("disabled", true);

        var country_id = $("#country_id").val();
        var city_id = $("#city_id").val();
        var address = $("#address").val();

        var isRequired = 0;

        if (!country_id) {
            $("#country_id").css("border", "1px solid red");
            isRequired++;
        }
        if (!city_id) {
            $("#city_id").css("border", "1px solid red");
            isRequired++;
        }
        if (!address) {
            $("#address").css("border", "1px solid red");
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
                url: Domain + "/ajaxcallforentities.php",
                method: "POST",
                data: $("#entity-form").serialize(),
                success: function (response) {
                    $(".loader-div").hide(); 
                    if (response == 1) {
                        $(".success-alert-text").text("Entity added successfully");
                        $(".success-alert").css("display", "flex");
                        fadeOutAlertMessage();
                        setTimeout(() => {
                            window.location = "Entities";
                        }, 3000);
                    } else if (response == "ENTITY_ALREADY_EXIST") {
                        $(".warning-alert-text").text("Entity already exists");
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

    // Edit entity
    $(".edit-entity-form .submit-btn").click(function (e) {
        e.preventDefault();
        $(".submit-btn").prop("disabled", true);

        var country_id = $("#country_id").val();
        var city_id = $("#city_id").val();
        var address = $("#address").val();

        var isRequired = 0;

        if (!country_id) {
            $("#country_id").css("border", "1px solid red");
            isRequired++;
        }
        if (!city_id) {
            $("#city_id").css("border", "1px solid red");
            isRequired++;
        }
        if (!address) {
            $("#address").css("border", "1px solid red");
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
                url: Domain + "/ajaxcallforentities.php",
                method: "POST",
                data: $("#edit-entity-form").serialize(),
                success: function (response) {
                    $(".loader-div").hide(); 
                    if (response == 1) {
                        $(".success-alert-text").text("Entity updated successfully");
                        $(".success-alert").css("display", "flex");
                        fadeOutAlertMessage();
                    } else {
                        swal({
                            text: "Error updating entity!",
                            icon: "error",
                        });
                    }
                    setTimeout(function () {
                        window.location.href = "Entities";
                    }, 2000);
                },
            });
        }
    });

    // Delete entity
    $(".delete-entity-btn").click(function () {
        var entity_id = $(this).data("id");
        swal({
            text: "Are you sure you want to delete this entity?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $(".loader-div").show(); 
                $.ajax({
                    url: Domain + "/ajaxcallforentities.php",
                    method: "POST",
                    data: {
                        action: "DeleteEntity",
                        id: entity_id,
                    },
                    success: function (response) {
                        $(".loader-div").hide(); 
                        if (response == 1) {
                            $(".success-alert-text").text("Entity deleted successfully");
                            $(".success-alert").css("display", "flex");
                            fadeOutAlertMessage();
                            window.location.reload();
                        } else {
                            swal({
                                text: "Error deleting entity!",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });
});
