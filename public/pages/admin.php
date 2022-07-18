<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Адмін панель</title>

    <? include 'public/libs/favicon.php' ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.css" />

    <!-- Шрифти -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">

    <!-- Стилі -->
    <link rel="stylesheet" type="text/css" href="public/css/alert.css">
    <link rel="stylesheet" type="text/css" href="public/css/admin.css">

</head>

<body>
    <input type="hidden" id="api_key" name="api_key" value="<? echo $_SESSION['ApiKey']; ?>">

    <header class="navbar sticky-top flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-black" href="#">
            <img src="public/img/wrench_adjustable.svg">
            Адмін - панель
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <img src="public/img/list.svg">
            </span>
        </button>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block alert alert-dark sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                <img src="public/img/home.svg">
                                На головну
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#Title-List-Books">
                                <img src="public/img/book.svg">
                                Книги
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#Title-List-Tests">
                                <img src="public/img/test.svg">
                                Тести
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#Title-List-Videos">
                                <img src="public/img/video.svg">
                                Публікації
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                        <a class="link-secondary" href="javascript: addAdministrators();">
                        ➕ Добавити адміністратора
                        </a>
                    </h6>
                    <ul id="List-Administrators" class="nav flex-column mb-2">
                        <!-- Дані заповняються через JS -->
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 id="Title-List-Books" class="h2">Книги:</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="addBooks();">➕ Дабавити книгу</button>
                    </div>
                </div>

                <table class="table table-hover">
                    <tbody id="List-Books">
                        <!-- Дані заповняються через JS -->
                    </tbody>
                </table>

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 id="Title-List-Tests" class="h2">Тести:</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="addTests();">➕ Дабавити тест</button>
                    </div>
                </div>

                <table class="table table-hover">
                    <tbody id="List-Tests">
                        <!-- Дані заповняються через JS -->
                    </tbody>
                </table>

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 id="Title-List-Videos" class="h2">Відео:</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="addVideos();">➕ Дабавити відео</button>
                    </div>
                </div>

                <table class="table table-hover">
                    <tbody id="List-Videos">
                        <!-- Дані заповняються через JS -->
                    </tbody>
                </table>

            </main>
        </div>
    </div>

    <!-- HelloPreload -->
    <style type="text/css">
        #hellopreloader>p {
            display: none;
        }

        #hellopreloader_preload {
            display: block;
            position: fixed;
            z-index: 99999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            min-width: 300px;
            background: white url(public/img/load.gif) center center no-repeat;
            background-size: 96px;
        }
    </style>
    <div id="hellopreloader">
        <div id="hellopreloader_preload"></div>
    </div>
    <script type="text/javascript">
        var hellopreloader = document.getElementById("hellopreloader_preload");

        function fadeOutnojquery(el) {
            el.style.opacity = 1;
            var interhellopreloader = setInterval(function() {
                el.style.opacity = el.style.opacity - 0.05;
                if (el.style.opacity <= 0.05) {
                    clearInterval(interhellopreloader);
                    hellopreloader.style.display = "none";
                }
            }, 16);
        }
        window.onload = function() {
            setTimeout(function() {
                fadeOutnojquery(hellopreloader);
            }, 1000);
        };
    </script>
    <!-- HelloPreload -->

    <!-- JavaScript Движки -->
    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/jquery.cookie.js"></script>
    <script src="public/js/bootstrap.js"></script>
    <script src="public/js/alert.js"></script>

    <script src="public/js/admin.js" type="text/javascript"></script>

</body>

</html>