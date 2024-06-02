$(document).ready(function () {

    // Resgister user own self
    $("#close-popup").click(function () {
        $("#reg-popup").hide();
        $("#login-popup").hide();
        $("#search-user-popup").hide();
        $("#home-popup").hide();
        $("#admin-login-popup").hide();
        $("#std-reg-popup").hide();
    })

    $("#register-form").submit(function (e) {
        e.preventDefault();

        const name = $("#reg-name").val();
        const email = $("#reg-email").val();
        const pass = $("#reg-pass").val();

        const formData = new FormData(this);
        const avatar = $("#reg-avatar")[0].files;

        formData.append('name', name);
        formData.append('email', email);
        formData.append('pass', pass);
        formData.append('user_avatar', avatar[0]);

        $.ajax({
            url: "./register-user.php",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);

                switch (response) {

                    case "emt_err":
                        $("#reg-popup").fadeIn(300);
                        $("#reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Please fill the form').css("color", "red");
                        break;
                    case "name_err":
                        $("#reg-popup").fadeIn(300);
                        $("#reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Only letters and white space allowed in name field').css("color", "red");
                        break;
                    case "email_err":
                        $("#reg-popup").fadeIn(300);
                        $("#reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Invalid email format').css("color", "red");
                        break;
                    case "alr_err":
                        $("#reg-popup").fadeIn(300);
                        $("#reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> User already exsist').css("color", "red");
                        break;
                    case "failed":
                        $("#reg-popup").fadeIn(300);
                        $("#reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Registation Failed').css("color", "red");
                        break;
                    case "success":
                        $("#reg-popup").fadeIn(300);
                        $("#reg-popup-msg").html('<i class="fa-regular fa-circle-check"></i> Registation Success').css("color", "green");
                        function timeOut() {
                            console.log("object")
                            window.location.href = "login.php";
                        };
                        setTimeout(timeOut, 2000);
                        break;
                }
            }
        });
    })


    // User Login

    $("#login-form").submit(function (e) {

        e.preventDefault();

        const log_email = $("#user-login-email").val();
        const log_pass = $("#user-login-pass").val();

        $.ajax({
            url: "./login-user.php",
            method: "POST",
            data: {
                email: log_email,
                pass: log_pass
            },
            success: function (response) {
                console.log(response)
                switch (response) {

                    case "emt_err":
                        $("#login-popup").fadeIn(300);
                        $("#login-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Please fill the form').css("color", "red");
                        break;
                    case "email_err":
                        $("#login-popup").fadeIn(300);
                        $("#login-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Invalid email format').css("color", "red");
                        break;
                    case "user_err":
                        $("#login-popup").fadeIn(300);
                        $("#login-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> User not exsist').css("color", "red");
                        break;
                    case "failed":
                        $("#login-popup").fadeIn(300);
                        $("#login-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Email and password not match').css("color", "red");
                        break;
                    case "success":
                        $("#login-popup").fadeIn(300);
                        $("#login-popup-msg").html('<i class="fa-regular fa-circle-check"></i> login Success').css("color", "green");
                        function timeOut() {
                            console.log("object")
                            window.location.href = "index.php";
                        };
                        setTimeout(timeOut, 1000);
                        break;
                }
            }
        })
    })


    //Logout
    $("#logout-btn").click(function () {
        window.location.href = "logout.php"
    });

    $("#admin-logout-btn").click(function () {
        window.location.href = "admin-logout.php"
    });



    //User profile view

    $("#user-account-show-btn").click(function () {
        $.ajax({
            url: "./user-profile.php",
            method: "post",
            success: function (response) {
                $("#user-profile-show").html(response);
            }
        })
    });



    // function view_profile() {
    //     $.ajax({
    //         url: "./user-profile.php",
    //         method: "post",
    //         success: function (response) {
    //             $("#user-profile-show").html(response);
    //         }
    //     })
    // }

    //User profile edit
    $("#user-profile-edit-btn").click(function () {
        $.ajax({
            url: "./user-profile-edit.php",
            method: "POST",
            success: function (response) {
                $("#user-profile-edit-form").html(response);
            }
        })
    })

    //User Profile update
    $("#user-profile-edit-form").submit(function (e) {
        e.preventDefault();
        // console.log(e);

        const name = $("#user-update-name").val();
        const email = $("#user-update-email").val();

        const formData = new FormData(this);
        const avatar = $("#user-update-avatar")[0].files;

        formData.append('name', name);
        formData.append('email', email);
        formData.append('user_avatar', avatar[0]);

        $.ajax({
            url: "./user-profile-update.php",
            method: "post",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);

                switch (response) {
                    case "emt_err":
                        $("#update-err-msg").text("*Fill the name and email field");
                        break;
                    case "name_err":
                        $("#update-err-msg").text("*Fill the valid name");
                        break;
                    case "email_err":
                        $("#update-err-msg").text("*Fill the valid email");
                        break;
                    case "alr_err":
                        $("#update-err-msg").text("*User alredy exsist.");
                        break;
                    case "failed":
                        $("#update-err-msg").text("*Update data failed");
                        break;
                    case "success":
                        $("#update-err-msg").css("color", "green").text("*Update data successful.");

                        $.ajax({
                            url: "./user-profile.php",
                            method: "post",
                            success: function (response) {
                                $("#user-profile-show").html(response);
                            }
                        })

                        break;
                }
            }
        })
    })


    // User listed books

    $(".book-list-link").click(function () {
        $(".main-table-inner").hide();

        $(".main-table-inner-book-user").show();

        $.ajax({
            url: "./show-user-book.php",
            method: "POST",
            success: function (response) {
                // console.log(response);

                $("#listed-book-user").html(response);
            }
        })

    })

    $("#list-book-search-user").on("keyup", function () {
        // var userSearch = $(this).val();

        $.ajax({
            url: "./user-search-book.php",
            method: "POST",
            data: {
                search: $(this).val()
            },
            success: function (response) {
                // console.log(response);
                $("#listed-book-user").html(response);
            }
        });
    })

    $(document).on("click", ".user-book-view", function () {
        $.ajax({
            url: "./user-book-details.php",
            method: "POST",
            data: {
                id: $(this).attr("data-id")
            },
            success: function (response) {
                // console.log(response);
                $("#modal-content-book").html(response);
            }
        });
    });

    // User issued books

    $(".issue-book-info-box-user").click(function () {
        $(".main-table-inner").hide();

        $(".main-table-inner-issue-book-user").show();

        $.ajax({
            url: "./show-user-issue-book.php",
            method: "POST",
            success: function (response) {
                // console.log(response);

                $("#issue-book-user").html(response);
            }
        })

    })

    $("#issue-book-search-user").on("keyup", function () {
        // var userSearch = $(this).val();

        $.ajax({
            url: "./user-search-issue-book.php",
            method: "POST",
            data: {
                search: $(this).val()
            },
            success: function (response) {
                // console.log(response);
                $("#issue-book-user").html(response);
            }
        });
    })


    // User not return books

    $(".not-return-book-info-box-user").click(function () {
        $(".main-table-inner").hide();

        $(".main-table-inner-nrb-book-user").show();

        $.ajax({
            url: "./show-user-not-return-book.php",
            method: "POST",
            success: function (response) {
                // console.log(response);

                $("#nrb-book-user").html(response);
            }
        })

    })

    $("#nrb-book-search-user").on("keyup", function () {
        // var userSearch = $(this).val();

        $.ajax({
            url: "./user-search-not-return-book.php",
            method: "POST",
            data: {
                search: $(this).val()
            },
            success: function (response) {
                // console.log(response);
                $("#nrb-book-user").html(response);
            }
        });
    })




    // Admin login-----------------------------------------

    $("#admin-login-form").submit(function (e) {
        e.preventDefault();

        const email = $("#admin-login-email").val();
        const pass = $("#admin-login-pass").val();

        $.ajax({
            url: "./login-admin.php",
            method: "POST",
            data: {
                email: email,
                pass: pass
            },
            success: function (response) {
                console.log(response);

                switch (response) {

                    case "emt_err":
                        $("#admin-login-popup").fadeIn(300);
                        $("#admin-login-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Please fill the form').css("color", "red");
                        break;
                    case "email_err":
                        $("#admin-login-popup").fadeIn(300);
                        $("#admin-login-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Invalid email format').css("color", "red");
                        break;
                    case "user_err":
                        $("#admin-login-popup").fadeIn(300);
                        $("#admin-login-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> User not exsist').css("color", "red");
                        break;
                    case "failed":
                        $("#admin-login-popup").fadeIn(300);
                        $("#admin-login-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Email and password not match').css("color", "red");
                        break;
                    case "success":
                        $("#admin-login-popup").fadeIn(300);
                        $("#admin-login-popup-msg").html('<i class="fa-regular fa-circle-check"></i> login Success').css("color", "green");
                        function timeOut() {
                            window.location.href = "admin-dashboard.php";
                        };
                        setTimeout(timeOut, 1000);
                        break;
                }
            }
        })
    })

    // Admin profile view

    $("#admin-account-show-btn").click(function () {
        $.ajax({
            url: "./admin-profile.php",
            method: "post",
            success: function (response) {
                $("#admin-profile-show").html(response);
            }
        })
    });


    //Admin profile edit
    $("#admin-profile-edit-btn").click(function () {
        $.ajax({
            url: "./admin-profile-edit.php",
            method: "POST",
            success: function (response) {
                $("#admin-profile-edit-form").html(response);
            }
        })
    });



    //Admin Profile update
    $("#admin-profile-edit-form").submit(function (e) {
        e.preventDefault();
        console.log(e);

        const name = $("#admin-update-name").val();
        const email = $("#admin-update-email").val();

        const formData = new FormData(this);
        const avatar = $("#admin-update-avatar")[0].files;

        formData.append('name', name);
        formData.append('email', email);
        formData.append('admin_avatar', avatar[0]);

        $.ajax({
            url: "./admin-profile-update.php",
            method: "post",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);

                switch (response) {
                    case "emt_err":
                        $("#update-err-msg").text("*Fill the name and email field");
                        break;
                    case "name_err":
                        $("#update-err-msg").text("*Fill the valid name");
                        break;
                    case "email_err":
                        $("#update-err-msg").text("*Fill the valid email");
                        break;
                    case "alr_err":
                        $("#update-err-msg").text("*User alredy exsist.");
                        break;
                    case "failed":
                        $("#update-err-msg").text("*Update data failed");
                        break;
                    case "success":
                        $("#update-err-msg").css("color", "green").text("*Update data successful.");

                        $.ajax({
                            url: "./admin-profile.php",
                            method: "post",
                            success: function (response) {
                                $("#admin-profile-show").html(response);
                            }
                        })

                        break;
                }
            }
        })
    })





    // Admin dashboard

    // Admin Student Registation

    $(".add-std").click(function () {
        $.ajax({
            url: "./student-register-form.php",
            method: "POST",
            success: function (response) {
                // console.log(response);
                $("#modal-content-1").html(response);
            }
        })
    })

    $(document).on("submit", "#std-reg-form", function (e) {
        e.preventDefault();
        // console.log(e);

        const name = $("#std-reg-name").val();
        const email = $("#std-reg-email").val();

        const formData = new FormData(this);
        const avatar = $("#std-reg-avatar")[0].files;

        formData.append('name', name);
        formData.append('email', email);
        formData.append('user_avatar', avatar[0]);

        $.ajax({
            url: "./student-register.php",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);

                switch (response) {

                    case "emt_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Please fill the form').css("color", "red");
                        break;
                    case "name_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Only letters and white space allowed in name field').css("color", "red");
                        break;
                    case "email_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Invalid email format').css("color", "red");
                        break;
                    case "alr_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> User already exsist').css("color", "red");
                        break;
                    case "failed":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Registation Failed').css("color", "red");
                        break;
                    case "success":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-check"></i> Registation Success').css("color", "green");
                        location.reload();
                        break;
                }
            }
        })
    });





    // Main table inner user ------------------------------------------------------------
    $(".reg-user-info-box").click(function () {
        $(".main-table-inner").hide();
        $(".main-table-inner-user").show(200);

        show_user();
        // $.ajax({
        //     url: "./show-user.php",
        //     method: "POST",
        //     success: function (response) {
        //         // console.log(response);

        //         $("#registred-user").html(response);
        //     }
        // });
    });

    function show_user() {
        $.ajax({
            url: "./show-user.php",
            method: "POST",
            success: function (response) {
                // console.log(response);

                $("#registred-user").html(response);
            }
        });
    }

    // Admin student profile view

    $("#registred-user-search").on("keyup", function () {
        // var userSearch = $(this).val();

        $.ajax({
            url: "./search-user.php",
            method: "POST",
            data: {
                search: $(this).val()
            },
            success: function (response) {
                // console.log(response);
                $("#registred-user").html(response);
            }
        });
    })

    $(document).on("click", ".registred-user-view", function () {

        // console.log($(this).attr("data-id"));

        $.ajax({
            url: "./student-profile.php",
            method: "POST",
            data: {
                user_id: $(this).attr("data-id")
            },
            success: function (response) {
                // console.log(response);
                $("#modal-content-1").html(response);
            }
        });

    });

    $(document).on("click", "#std-profile-edit-btn", function (e) {
        $.ajax({
            url: "./student-profile-edit.php",
            method: "POST",
            data: {
                user_id: $(this).attr("data-id")
            },
            success: function (response) {
                $("#modal-content-2").html(response);
            }
        });
    });

    $(document).on("submit", "#std-profile-edit-form", function (e) {
        e.preventDefault();

        const id = $("#std-update-id").val();
        const name = $("#std-update-name").val();
        const email = $("#std-update-email").val();

        $.ajax({
            url: "./student-profile-update.php",
            method: "POST",
            data: {
                id: id,
                name: name,
                email: email
            },
            success: function (response) {
                // console.log(response);

                switch (response) {

                    case "emt_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Please fill the form').css("color", "red");
                        break;
                    case "name_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Only letters and white space allowed in name field').css("color", "red");
                        break;
                    case "email_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Invalid email format').css("color", "red");
                        break;
                    case "alr_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> User already exsist').css("color", "red");
                        break;
                    case "failed":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Update Failed').css("color", "red");
                        break;
                    case "success":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-check"></i> Update Success').css("color", "green");
                        // location.reload();
                        show_user();

                        break;
                }
            }
        });
    });

    $(document).on("click", ".registred-user-delete", function () {

        // console.log($(this).attr("data-id"));

        $.ajax({
            url: "./student-profile-delete.php",
            method: "POST",
            data: {
                id: $(this).attr("data-id")
            },
            success: function (response) {

                switch (response) {

                    case "failed":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Something Went Wrong').css("color", "red");
                        break;
                    case "success":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-check"></i> User Deleted Successfuly').css("color", "green");
                        // location.reload();
                        show_user();
                        break;
                }
            }
        });

    });



    // Main table inner cate --------------------------------------------------------------
    $(".listed-gategory-info-box").click(function () {
        $(".main-table-inner").hide();

        $(".main-table-inner-cate").show();
        show_cate();
        // $.ajax({
        //     url: "./show-categories.php",
        //     method: "POST",
        //     success: function (response) {
        //         // console.log(response);
        //         $("#listed-categories").html(response);
        //     }
        // });
    });

    function show_cate() {
        $.ajax({
            url: "./show-categories.php",
            method: "POST",
            success: function (response) {
                // console.log(response);
                $("#listed-categories").html(response);
            }
        });
    }

    // Add category

    $("#list-cate-search").on("keyup", function () {
        // var userSearch = $(this).val();

        $.ajax({
            url: "./search-categories.php",
            method: "POST",
            data: {
                search: $(this).val()
            },
            success: function (response) {
                // console.log(response);
                $("#listed-categories").html(response);
            }
        });
    })

    $("#add-cate").click(function () {

        $.ajax({
            url: "./add-category-form.php",
            method: "POST",
            success: function (response) {
                // console.log(response);

                $("#modal-content-1").html(response);
            }
        })
    });

    $(document).on("submit", "#add-cate-form", function (e) {

        e.preventDefault();
        // console.log(e);

        const name = $("#add-cate-name").val();
        const desc = $("#add-cate-desc").val();


        $.ajax({
            url: "./add-category.php",
            method: "POST",
            data: {
                name: name,
                desc: desc
            },
            success: function (response) {
                // console.log(response);

                switch (response) {

                    case "emt_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Please fill the form').css("color", "red");
                        break;
                    case "name_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Only letters and white space allowed in name field').css("color", "red");
                        break;
                    case "failed":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Registation Failed').css("color", "red");
                        break;
                    case "success":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-check"></i> Registation Success').css("color", "green");
                        $("#add-cate-name").val("");
                        $("#add-cate-desc").val("");
                        show_cate();
                        $("#std-reg-popup").fadeOut(100);
                        break;
                }
            }
        });
    });

    $(document).on("click", ".view-category", function () {

        $.ajax({
            url: "./category-details.php",
            method: "POST",
            data: {
                id: $(this).attr("data-id")
            },
            success: function (response) {
                // console.log(response);
                $("#modal-content-1").html(response);
            }
        });
    });

    $(document).on("click", "#cate-details-edit-btn", function (e) {
        $.ajax({
            url: "./category-edit.php",
            method: "POST",
            data: {
                id: $(this).attr("data-id")
            },
            success: function (response) {
                $("#modal-content-2").html(response);
            }
        });
    });

    $(document).on("submit", "#cate-edit-form", function (e) {
        e.preventDefault();

        const id = $("#cate-update-id").val();
        const name = $("#cate-update-name").val();
        const desc = $("#cate-update-desc").val();

        $.ajax({
            url: "./category-update.php",
            method: "POST",
            data: {
                id: id,
                name: name,
                desc: desc
            },
            success: function (response) {
                // console.log(response);

                switch (response) {

                    case "emt_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Please fill the form').css("color", "red");
                        break;
                    case "name_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Only letters and white space allowed in name field').css("color", "red");
                        break;
                    case "failed":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Update Failed').css("color", "red");
                        break;
                    case "success":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-check"></i> Update Success').css("color", "green");
                        // location.reload();
                        show_cate();
                        break;
                }
            }
        });
    });

    $(document).on("click", ".delete-category", function () {

        // console.log($(this).attr("data-id"));

        $.ajax({
            url: "./category-delete.php",
            method: "POST",
            data: {
                id: $(this).attr("data-id")
            },
            success: function (response) {

                switch (response) {

                    case "failed":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Something Went Wrong').css("color", "red");
                        break;
                    case "success":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-check"></i> Category Deleted Successfuly').css("color", "green");
                        // location.reload();
                        show_cate();
                        break;
                }
            }
        });

    });








    // Main table inner author -----------------------------------------------------------------
    $(".main-info-author-box").click(function () {
        $(".main-table-inner").hide();
        $(".main-table-inner-author").show();

        show_author();
    });

    function show_author() {
        $.ajax({
            url: "./show-author.php",
            method: "POST",
            success: function (response) {
                // console.log(response);
                $("#listed-author").html(response);
            }
        });
    }

    // Add author

    $("#list-author-search").on("keyup", function () {
        // var userSearch = $(this).val();

        $.ajax({
            url: "./search-author.php",
            method: "POST",
            data: {
                search: $(this).val()
            },
            success: function (response) {
                // console.log(response);
                $("#listed-author").html(response);
            }
        });
    })

    $("#add-author").click(function () {

        $.ajax({
            url: "./add-author-form.php",
            method: "POST",
            success: function (response) {

                $("#modal-content-1").html(response);
            }
        })
    });

    $(document).on("submit", "#add-author-form", function (e) {

        e.preventDefault();
        // console.log(e);

        const name = $("#add-author-name").val();


        $.ajax({
            url: "./add-author.php",
            method: "POST",
            data: {
                name: name,
            },
            success: function (response) {
                // console.log(response);

                switch (response) {

                    case "emt_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Please fill the form').css("color", "red");
                        break;
                    // case "name_err":
                    //     $("#std-reg-popup").fadeIn(300);
                    //     $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Only letters and white space allowed in name field').css("color", "red");
                    //     break;
                    case "failed":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Add Author Failed').css("color", "red");
                        break;
                    case "success":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-check"></i> Add Author Success').css("color", "green");
                        $("#add-author-name").val("");
                        show_author();
                        $("#std-reg-popup").fadeOut(100);
                        break;
                }
            }
        });
    });

    $(document).on("click", ".edit-author", function (e) {
        $.ajax({
            url: "./author-edit.php",
            method: "POST",
            data: {
                id: $(this).attr("data-id")
            },
            success: function (response) {
                $("#modal-content-1").html(response);
            }
        });
    });

    $(document).on("submit", "#author-edit-form", function (e) {
        e.preventDefault();

        const id = $("#author-update-id").val();
        const name = $("#author-update-name").val();

        $.ajax({
            url: "./author-update.php",
            method: "POST",
            data: {
                id: id,
                name: name
            },
            success: function (response) {
                // console.log(response);

                switch (response) {

                    case "emt_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Please fill the form').css("color", "red");
                        break;
                    case "name_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Only letters and white space allowed in name field').css("color", "red");
                        break;
                    case "failed":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Update Failed').css("color", "red");
                        break;
                    case "success":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-check"></i> Update Success').css("color", "green");
                        // location.reload();
                        show_author();
                        break;
                }
            }
        });
    });

    $(document).on("click", ".delete-author", function () {

        // console.log($(this).attr("data-id"));

        $.ajax({
            url: "./author-delete.php",
            method: "POST",
            data: {
                id: $(this).attr("data-id")
            },
            success: function (response) {

                switch (response) {

                    case "failed":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Something Went Wrong').css("color", "red");
                        break;
                    case "success":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-check"></i> Author Deleted Successfuly').css("color", "green");
                        // location.reload();
                        show_author();
                        break;
                }
            }
        });

    });





    // Main table inner book ------------------------------------------------------------------
    $(".main-info-book-box").click(function () {
        $(".main-table-inner").hide();
        $(".main-table-inner-book").show();

        show_books();

    });

    function show_books() {
        $.ajax({
            url: "./show-book.php",
            method: "POST",
            success: function (response) {
                // console.log(response);
                $("#listed-book").html(response);
            }
        });
    }



    $(".dropdown-cate").click(function () {
        $(".main-table-inner").hide();
        $(".main-table-inner-book").show();

        $.ajax({
            url: "./show-book.php",
            method: "POST",
            data: {
                cate_id: $(this).attr("data-cateId")
            },
            success: function (response) {
                // console.log(response);
                $("#listed-book").html(response);
            }
        });
    });

    $("#list-book-search").on("keyup", function () {
        // var userSearch = $(this).val();

        $.ajax({
            url: "./search-book.php",
            method: "POST",
            data: {
                search: $(this).val()
            },
            success: function (response) {
                // console.log(response);
                $("#listed-book").html(response);
            }
        });
    })



    // Add book

    $("#add-book").click(function () {

        $.ajax({
            url: "./add-book-form.php",
            method: "POST",
            success: function (response) {
                // console.log(response);
                $("#modal-content-1").html(response);
            }
        })
    });

    $(document).on("submit", "#add-book-form", function (e) {

        e.preventDefault();
        // console.log(e);

        const title = $("#add-book-title").val();
        const desc = $("#add-book-desc").val();

        const formData = new FormData(this);
        const img = $("#add-book-img")[0].files;

        const author = $("#add-book-author").val();
        const cate = $("#add-book-cate").val();

        formData.append('title', title);
        formData.append('desc', desc);
        formData.append('img', img[0]);
        formData.append('author', author);
        formData.append('cate', cate);


        $.ajax({
            url: "./add-book.php",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);

                switch (response) {

                    case "emt_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Please fill the form').css("color", "red");
                        break;
                    case "failed":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Add Book Failed').css("color", "red");
                        break;
                    case "success":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-check"></i> Add Book Success').css("color", "green");
                        // $("#add-author-name").val("");
                        // show_author();
                        $("#std-reg-popup").fadeOut(100);
                        break;
                }
            }
        });
    });

    $(document).on("click", ".book-edit", function (e) {
        $.ajax({
            url: "./book-edit.php",
            method: "POST",
            data: {
                id: $(this).attr("data-id")
            },
            success: function (response) {
                // console.log(response);
                $("#modal-content-1").html(response);
            }
        });
    });

    $(document).on("submit", "#book-edit-form", function (e) {
        e.preventDefault();

        const id = $("#book-update-id").val();
        const formData = new FormData(this);
        const img = $("#book-update-img")[0].files;
        const title = $("#book-update-title").val();
        const desc = $("#book-update-desc").val();
        const author = $("#book-update-author").val();
        const cate = $("#book-update-cate").val();

        formData.append('id', id);
        formData.append('img', img[0]);
        formData.append('title', title);
        formData.append('desc', desc);
        formData.append('author', author);
        formData.append('cate', cate);

        $.ajax({
            url: "./book-update.php",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // console.log(response);

                switch (response) {

                    case "emt_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Please fill the form').css("color", "red");
                        break;
                    case "failed":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Update Failed').css("color", "red");
                        break;
                    case "success":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-check"></i> Update Success').css("color", "green");
                        // location.reload();
                        show_books();
                        break;
                }
            }
        });
    });

    $(document).on("click", ".book-delete", function () {

        // console.log($(this).attr("data-id"));

        $.ajax({
            url: "./book-delete.php",
            method: "POST",
            data: {
                id: $(this).attr("data-id")
            },
            success: function (response) {

                switch (response) {

                    case "failed":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Something Went Wrong').css("color", "red");
                        break;
                    case "success":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-check"></i> Author Deleted Successfuly').css("color", "green");
                        // location.reload();
                        show_books();
                        break;
                }
            }
        });

    });



    // Main table inner issued book ------------------------------------------------------------------
    $(".issue-book-info-box").click(function () {
        $(".main-table-inner").hide();
        $(".main-table-inner-issued-book").show();

        show_issuedBooks();

    });

    function show_issuedBooks() {
        $.ajax({
            url: "./show-issued-book.php",
            method: "POST",
            data: { status: "ib" },
            success: function (response) {
                // console.log(response);
                $("#listed-issued-book").html(response);
            }
        });
    }

    $(".not-return-book-info-box").click(function () {
        $(".main-table-inner").hide();
        $(".main-table-inner-issued-book").show();

        show_notReturnBooks();

    });

    function show_notReturnBooks() {
        $.ajax({
            url: "./show-issued-book.php",
            method: "POST",
            data: { status: "nrb" },
            success: function (response) {
                // console.log(response);
                $("#listed-issued-book").html(response);
            }
        });
    }



    // $("#list-book-search").on("keyup", function () {
    //     // var userSearch = $(this).val();

    //     $.ajax({
    //         url: "./search-book.php",
    //         method: "POST",
    //         data: {
    //             search: $(this).val()
    //         },
    //         success: function (response) {
    //             // console.log(response);
    //             $("#listed-book").html(response);
    //         }
    //     });
    // })



    // Add issued book

    $(document).on("click", ".book-issue", function () {

        $.ajax({
            url: "./add-issued-book-form.php",
            method: "POST",
            data: {
                book_id: $(this).attr("data-id")
            },
            success: function (response) {
                // console.log(response);
                $("#modal-content-1").html(response);
            }
        })
    });

    $(document).on("submit", "#add-issued-book-form", function (e) {

        e.preventDefault();
        // console.log(e);

        const bookId = $("#add-issued-book-id").val();
        const email = $("#add-issued-book-email").val();

        $.ajax({
            url: "./add-issued-book.php",
            method: "POST",
            data: {
                book_id: bookId,
                email: email
            },
            success: function (response) {
                console.log(response);

                switch (response) {

                    case "emt_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Please fill the form').css("color", "red");
                        break;
                    case "email_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Invalid email format').css("color", "red");
                        break;
                    case "dne_err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> User does not exesit.').css("color", "red");
                        break;
                    case "failed":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Add Book Failed').css("color", "red");
                        break;
                    case "success":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-check"></i> Add Book Success').css("color", "green");
                        $("#std-reg-popup").fadeOut(100);
                        break;
                }
            }
        });

    })

    $(document).on("click", ".issued-book-view", function () {

        $.ajax({
            url: "./issue-book-details.php",
            method: "POST",
            data: {
                id: $(this).attr("data-id"),
                status: $(this).attr("data-status")
            },
            success: function (response) {
                // console.log(response);
                $("#modal-content-1").html(response);
            }
        });

    })

    $(document).on("submit", "#issue-book-update-form", function (e) {

        e.preventDefault();

        const status = $("#issue-book-status").val();
        const id = $("#issue-book-id").val();

        $.ajax({
            url: "./issue-book-update.php",
            method: "POST",
            data: {
                status: status,
                id: id
            },
            success: function (response) {
                // console.log(response);

                switch (response) {
                    case "failed":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Update Issue Book Failed').css("color", "red");
                        break;
                    case "success":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-check"></i> Update Issue Book Success').css("color", "green");
                        $("#std-reg-popup").fadeOut(100);
                        show_issuedBooks();
                        show_notReturnBooks();
                        break;
                }
            }
        })
    })

    $(document).on("click", ".issued-book-delete", function () {

        // console.log($(this).attr("data-id"));

        $.ajax({
            url: "./issue-book-delete.php",
            method: "POST",
            data: {
                id: $(this).attr("data-id")
            },
            success: function (response) {
                console.log(response);

                switch (response) {

                    case "err":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> This book is not returned yet.').css("color", "red");
                        break;
                    case "failed":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-xmark"></i> Something Went Wrong').css("color", "red");
                        break;
                    case "success":
                        $("#std-reg-popup").fadeIn(300);
                        $("#std-reg-popup-msg").html('<i class="fa-regular fa-circle-check"></i> Issue Book Deleted Successfuly').css("color", "green");
                        // location.reload();
                        $("#std-reg-popup").fadeOut(100);
                        show_issuedBooks();
                        show_notReturnBooks();
                        break;
                }
            }
        });

    });




});