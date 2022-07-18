let api_key = $("#api_key").val();

let booksList = null;
let testsList = null;
let videosList = null;

let book = {
    book: ""
};
let test = {
    img: "",
    title: "",
    url: ""
};
let video = {
    video_url: ""
};

let formData = new FormData();
formData.append("api_key", api_key);
formData.append("email", $.cookie('user_email'));
$.ajax({
    type: "POST",
    url: 'api/verifyAdmin',
    contentType: false, processData: false, dataType: "json",
    data: formData,
    success: function (response) {
        if (!response.res) {
            document.location.href = "/";
        }
    }
});

Start();
function Start() {
    formData = new FormData();
    formData.append("api_key", api_key);

    $.ajax({
        type: "POST",
        url: 'api/getBooksForSite',
        contentType: false, processData: false, dataType: "json",
        data: formData,
        success: function (response) {
            response.forEach((value, index) => {
                $("#List-Books").append("<tr class=\"row\"><th class=\"col-md-6\"><a target=\"_blanck\" href=\"" + value.book + "\">" + value.book + "</a></th><td class=\"col text-end\"><a class=\"link-secondary me-3\" href=\"javascript: editBooks('" + value.id + "');\"><img src=\"public/img/edit.svg\"></a><a class=\"link-secondary\" href=\"javascript: deleteBooks('" + value.id + "');\"><img src=\"public/img/delete.svg\"></a></td></tr>")
            })
            booksList = response;
        }
    });

    $.ajax({
        type: "POST",
        url: 'api/getTestsForSite',
        contentType: false, processData: false, dataType: "json",
        data: formData,
        success: function (response) {
            response.forEach((value, index) => {
                $("#List-Tests").append("<tr class=\"row\"><th class=\"col text-center\"><img class=\"rounded quizzes-img\" src=\"" + value.img + "\"></th><td class=\"col-md-6 text-center\"><h5>" + value.title + "</h5><a target=\"_blanck\" href=\"" + value.url + "\">" + value.url + "</a></td><td class=\"col text-center\"><a class=\"link-secondary me-3\" href=\"javascript: editTests('" + value.id + "');\"><img src=\"public/img/edit.svg\"></a><a class=\"link-secondary\" href=\"javascript: deleteTests('" + value.id + "');\"><img src=\"public/img/delete.svg\"></a></td></tr>")
            })
            testsList = response;
        }
    });

    $.ajax({
        type: "POST",
        url: 'api/getVideosForSite',
        contentType: false, processData: false, dataType: "json",
        data: formData,
        success: function (response) {
            response.forEach((value, index) => {
                $("#List-Videos").append("<tr class=\"row\"><th class=\"col-md-6\"><a target=\"_blanck\" href=\"" + value.video_url + "\">" + value.video_url + "</a></th><td class=\"col text-end\"><a class=\"link-secondary me-3\" href=\"javascript: editVideos('" + value.id + "');\"><img src=\"public/img/edit.svg\"></a><a class=\"link-secondary\" href=\"javascript: deleteVideos('" + value.id + "');\"><img src=\"public/img/delete.svg\"></a></td></tr>")
            })
            videosList = response;
        }
    });

    $.ajax({
        type: "POST",
        url: 'api/getAdministrators',
        contentType: false, processData: false, dataType: "json",
        data: formData,
        success: function (response) {
            response.forEach((value, index) => {
                $("#List-Administrators").append("<li class=\"nav-item text-center bg-color2 mb-1\">" + value.email + "<p><a class=\"link-secondary\" href=\"javascript: deleteAdministrators('" + value.email + "');\"><img src=\"public/img/delete.svg\"></a></p></li>")
            })
        }
    });
}

function addBooks() {
    if (book.id) {
        book = {
            book: ""
        };
    }
    viewBooksForm("add");
}

function bookSave() {
    book.book = $("#news-book").val();
}

function viewBooksForm(type) {
    confirmButtonText = "Добавити";
    title = "Добавити книгу";
    if (type == "edit") {
        confirmButtonText = "Зберегти";
        title = "Редагувати книгу";
    }

    Swal.fire({
        title: title,
        html:
            '<p><label for="news-book">Посилання:</label></p>' +
            '<input id="news-book" class="swal2-input" placeholder="Посилання на книгу" value="' + book.book + '">',
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: confirmButtonText,
        cancelButtonText: 'Скасувати',
        preConfirm: () => {
            bookSave();
            if (!book.book) {
                Swal.fire({
                    icon: 'error',
                    title: 'Помилка!',
                    text: 'Не всі поля були заповнені. Будьласка заповніт їх!',
                })
                return false;
            }
            formData = new FormData();
            formData.append("api_key", api_key);

            if (type == "edit") {
                formData.append("book", JSON.stringify(book));
                $.ajax({
                    type: "POST",
                    url: 'api/editBooks',
                    contentType: false, processData: false, dataType: "json",
                    data: formData,
                    success: function (response) {
                        if (response.res) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Книгу відредаговано!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    location.reload();
                                }
                            })
                        }
                    }
                });
            } else {
                formData.append("book", book.book);
                $.ajax({
                    type: "POST",
                    url: 'api/addBooks',
                    contentType: false, processData: false, dataType: "json",
                    data: formData,
                    success: function (response) {
                        if (response.res) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Книгу добавлено!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    location.reload();
                                }
                            })
                        }
                    }
                });
            }
        }
    })
}

function editBooks(id) {
    booksList.forEach((v, i) => {
        if (v.id == id) {
            book = v;
            viewBooksForm("edit");
        }
    })
}

function deleteBooks(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ms-2',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        title: 'Видалення книги',
        text: "Ви дійсно хочете видалити дану книгу?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Так!',
        cancelButtonText: 'Ні!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            formData = new FormData();
            formData.append("api_key", api_key);
            formData.append("id", id);
            $.ajax({
                type: "POST",
                url: 'api/deleteBooks',
                contentType: false, processData: false, dataType: "json",
                data: formData,
                success: function (response) {
                    if (response.res) {
                        swalWithBootstrapButtons.fire(
                            'Книгу видалено',
                            'Успішно видалено книгу!',
                            'success'
                        ).then((result) => {
                            location.reload();
                        })
                    } else {
                        swalWithBootstrapButtons.fire(
                            'Сталася помилка',
                            'Книгу не було видалено!',
                            'error'
                        )
                    }
                }
            });
        }
    })
}

function addAdministrators() {
    Swal.fire({
        title: 'Добавити адміністратора',
        html: '<input id="swal-administrators" class="swal2-input" placeholder="Email">',
        focusConfirm: false,
        preConfirm: () => {
            var email = $("#swal-administrators").val();
            if (!email) {
                return false;
            }
            formData = new FormData();
            formData.append("api_key", api_key);
            formData.append("email", email);
            $.ajax({
                type: "POST",
                url: 'api/addAdministrators',
                contentType: false, processData: false, dataType: "json",
                data: formData,
                success: function (response) {
                    if (response.res) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Адміністратора будо добавлено!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                location.reload();
                            }
                        })
                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Адміністратора не було добавлено! Можливо такий уже присутній.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            });
        }
    })
}

function deleteAdministrators(email) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        title: 'Видалення адміністратора',
        text: "Ви дійсно хочете видалити даного адміністратора?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Так!',
        cancelButtonText: 'Ні!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            formData = new FormData();
            formData.append("api_key", api_key);
            formData.append("email", email);
            $.ajax({
                type: "POST",
                url: 'api/deleteAdministrators',
                contentType: false, processData: false, dataType: "json",
                data: formData,
                success: function (response) {
                    if (response.res) {
                        swalWithBootstrapButtons.fire(
                            'Адміністратора видалено',
                            'Успішно видалено адміністратора!',
                            'success'
                        ).then((result) => {
                            location.reload();
                        })
                    } else {
                        swalWithBootstrapButtons.fire(
                            'Сталася помилка',
                            'Адміністратора не було видалено!',
                            'error'
                        )
                    }
                }
            });
        }
    })
}

function addTests() {
    if (test.id) {
        test = {
            img: "",
            title: "",
            url: ""
        };
    }
    viewTestsForm("add");
}

function testSave() {
    test.title = $("#test-title").val();
    test.img = $("#test-img").val();
    test.url = $("#test-url").val();
}

function viewTestsForm(type) {
    confirmButtonText = "Добавити";
    title = "Добавити тест";
    if (type == "edit") {
        confirmButtonText = "Зберегти";
        title = "Редагувати тест";
    }

    Swal.fire({
        title: title,
        html:
            '<p><label for="test-title">Назва:</label></p>' +
            '<input id="test-title" class="swal2-input" placeholder="Назва тесту" value="' + test.title + '">' +
            '<p><label for="test-img">Зображення:</label></p>' +
            '<input id="test-img" class="swal2-input" placeholder="Зображення прикріплене до тесту" value="' + test.img + '">' +
            '<p><label for="test-url">Писилання:</label></p>' +
            '<input id="test-url" class="swal2-input" placeholder="Посилання на тест" value="' + test.url + '">',
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: confirmButtonText,
        cancelButtonText: 'Скасувати',
        preConfirm: () => {
            testSave();
            if (!test.title || !test.img || !test.url) {
                Swal.fire({
                    icon: 'error',
                    title: 'Помилка!',
                    text: 'Не всі поля були заповнені. Будьласка заповніт їх!',
                })
                return false;
            }
            formData = new FormData();
            formData.append("api_key", api_key);
            formData.append("test", JSON.stringify(test));

            if (type == "edit") {
                $.ajax({
                    type: "POST",
                    url: 'api/editTests',
                    contentType: false, processData: false, dataType: "json",
                    data: formData,
                    success: function (response) {
                        if (response.res) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Тест відредаговано!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    location.reload();
                                }
                            })
                        }
                    }
                });
            } else {
                formData.append("book", book.book);
                $.ajax({
                    type: "POST",
                    url: 'api/addTests',
                    contentType: false, processData: false, dataType: "json",
                    data: formData,
                    success: function (response) {
                        if (response.res) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Тест добавлено!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    location.reload();
                                }
                            })
                        }
                    }
                });
            }
        }
    })
}

function editTests(id) {
    testsList.forEach((v, i) => {
        if (v.id == id) {
            test = v;
            viewTestsForm("edit");
        }
    })
}

function deleteTests(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ms-2',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        title: 'Видалення тесту',
        text: "Ви дійсно хочете видалити даний тест?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Так!',
        cancelButtonText: 'Ні!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            formData = new FormData();
            formData.append("api_key", api_key);
            formData.append("id", id);
            $.ajax({
                type: "POST",
                url: 'api/deleteTests',
                contentType: false, processData: false, dataType: "json",
                data: formData,
                success: function (response) {
                    if (response.res) {
                        swalWithBootstrapButtons.fire(
                            'Тест видалено',
                            'Успішно видалено тест!',
                            'success'
                        ).then((result) => {
                            location.reload();
                        })
                    } else {
                        swalWithBootstrapButtons.fire(
                            'Сталася помилка',
                            'Тест не було видалено!',
                            'error'
                        )
                    }
                }
            });
        }
    })
}

function addVideos() {
    if (video.id) {
        video = {
            video_url: ""
        };
    }
    viewVideosForm("add");
}

function videoSave() {
    video.video_url = $("#video-video_url").val();
}

function viewVideosForm(type) {
    confirmButtonText = "Добавити";
    title = "Добавити відео";
    if (type == "edit") {
        confirmButtonText = "Зберегти";
        title = "Редагувати відео";
    }

    Swal.fire({
        title: title,
        html:
            '<p><label for="video-video_url">Посилання:</label></p>' +
            '<input id="video-video_url" class="swal2-input" placeholder="Посилання на відео" value="' + video.video_url + '">',
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: confirmButtonText,
        cancelButtonText: 'Скасувати',
        preConfirm: () => {
            videoSave();
            if (!video.video_url) {
                Swal.fire({
                    icon: 'error',
                    title: 'Помилка!',
                    text: 'Не всі поля були заповнені. Будьласка заповніт їх!',
                })
                return false;
            }
            formData = new FormData();
            formData.append("api_key", api_key);

            if (type == "edit") {
                formData.append("video", JSON.stringify(video));
                $.ajax({
                    type: "POST",
                    url: 'api/editVideos',
                    contentType: false, processData: false, dataType: "json",
                    data: formData,
                    success: function (response) {
                        if (response.res) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Відео відредаговано!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    location.reload();
                                }
                            })
                        }
                    }
                });
            } else {
                formData.append("video", video.video_url);
                $.ajax({
                    type: "POST",
                    url: 'api/addVideos',
                    contentType: false, processData: false, dataType: "json",
                    data: formData,
                    success: function (response) {
                        if (response.res) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Відео добавлено!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    location.reload();
                                }
                            })
                        }
                    }
                });
            }
        }
    })
}

function editVideos(id) {
    videosList.forEach((v, i) => {
        if (v.id == id) {
            video = v;
            viewVideosForm("edit");
        }
    })
}

function deleteVideos(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ms-2',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        title: 'Видалення відео',
        text: "Ви дійсно хочете видалити дане відео?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Так!',
        cancelButtonText: 'Ні!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            formData = new FormData();
            formData.append("api_key", api_key);
            formData.append("id", id);
            $.ajax({
                type: "POST",
                url: 'api/deleteVideos',
                contentType: false, processData: false, dataType: "json",
                data: formData,
                success: function (response) {
                    if (response.res) {
                        swalWithBootstrapButtons.fire(
                            'Відео видалено',
                            'Успішно видалено відео!',
                            'success'
                        ).then((result) => {
                            location.reload();
                        })
                    } else {
                        swalWithBootstrapButtons.fire(
                            'Сталася помилка',
                            'Відео не було видалено!',
                            'error'
                        )
                    }
                }
            });
        }
    })
}