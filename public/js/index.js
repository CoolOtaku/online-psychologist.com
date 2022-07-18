let api_key = $("#api_key").val();
Start();
loadUser();

function Start() {
    let formData = new FormData();
    formData.append("api_key", api_key);
    $.ajax({
        type: "POST",
        url: 'api/getTestsForSite',
        contentType: false,
        processData: false,
        dataType: "json",
        data: formData,
        success: function (response) {
            response.forEach((value, i) => {
                $("#data-tests").append("<div class=\"col-md-3 col-sm-6 md-margin-b-4\"><div class=\"service bg-color-base\" data-height=\"height\"><div class=\"service-element\"><img class=\"service-icon\" src=\"" + value.img + "\"></div><div class=\"service-info\"><h3 class=\"color-white\">" + value.title + "</h3></div><a href=\"" + value.url + "\" class=\"content-wrapper-link\"></a></div></div>")
            })
        }
    });
    /*$.ajax({
        type: "POST",
        url: 'api/getVideos',
        contentType: false,
        processData: false,
        dataType: "json",
        data: formData,
        success: function (response) {
            response.forEach((value, index) => {
                $("#data-videos").append("<div class=\"col-sm-4 sm-margin-b-50\"><div class=\"margin-b-20\"><div><iframe class=\"img-responsive\" src=\"" + value + "\" frameborder=\"0\" allow=\"accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe></div></div></div>")
            })
        }
    });*/
}

function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    if (!profile.getId()) {
        Swal.fire({
            icon: 'error',
            title: data.title,
            text: data.res
        })
    } else {
        $.cookie('user_id', profile.getId());
        $.cookie('user_full_name', profile.getName());
        $.cookie('user_image', profile.getImageUrl());
        $.cookie('user_email', profile.getEmail());
        loadUser();
    }
}

function loadUser() {
    if ($.cookie('user_id')) {
        $("#BTN_Login").html('<img id="login-img" src="public/img/people.svg" onclick="ShowProfile();">');
        if ($.cookie('user_image')) {
            $("#login-img").attr('src', $.cookie('user_image'));
        }
    }
}

function ShowProfile() {
    if ($.cookie('user_id')) {
        Swal.fire({
            title: $.cookie('user_full_name'),
            imageUrl: $.cookie('user_image'),
            imageWidth: 150,
            imageHeight: 150,
            imageAlt: 'Custom image',
            html:
                '<a href="#" onclick="signOut();">Вийти з профілю</a><br><br>' +
                '<div id="AdminPanelButton"></div>',
        })
        formData = new FormData();
        formData.append("api_key", api_key);
        formData.append("email", $.cookie('user_email'));
        $.ajax({
            type: "POST",
            url: 'api/verifyAdmin',
            contentType: false, processData: false, dataType: "json",
            data: formData,
            success: function (response) {
                if (response.res) {
                    $("#AdminPanelButton").append(response.button)
                }
            }
        });
    }
}

function signOut() {
    Swal.fire({
        title: 'Вихід з профілю',
        text: "Ви дійсно хочете вийти з профілю?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Ні',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Так'
    }).then((result) => {
        if (result.isConfirmed) {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
                $.cookie('user_id', "");
                $.cookie('user_full_name', "");
                $.cookie('user_image', "");
                $.cookie('user_email', "");
                document.location.href = "/";
            });
        }
    })
}