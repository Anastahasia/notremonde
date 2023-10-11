<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Accueil - Notre Monde</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <style>
        @media (min-width: 768px) {
            .card-carousel-inner {
                display: flex;
                overflow: hidden;
            }

            .card {
                margin: 0 1em;
                position: relative;
            }

            .card-carousel-item {
                margin-right: 0;
                flex: 0 0 33.333333%;
                display: block;
            }

            .img-wrapper {
                width: 100%;
                height: 430px;
            }

            .carousel-img-wrapper {
                max-width: 100%;
                height: 500px;
            }

            img {
                max-height: 100%;
            }

            section {
                padding: 10%;
            }
        }
    </style>
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="#!">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="circuits">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="circuits/create">Circuits</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Thématiques</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('header')
    <!-- @yield('content') -->

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <img src="" alt="" class="footer-logo">
        <div class="container px-5">
            <h4 class="accent">À propos</h4>
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
        <div class="container px-5">
            <ul>
                <li class="m-0 text-center accent">
                    <h4>Copyright &copy; Your Website 2023</h4>
                </li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
            </ul>
            <ul>
                <li class="m-0 text-center accent">
                    <h4>Copyright &copy; Your Website 2023</h4>
                </li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
            </ul>
            <ul>
                <li class="m-0 text-center accent">
                    <h4>Copyright &copy; Your Website 2023</h4>
                </li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
            </ul>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script>
        var carouselWidth = $(".carousel-inner")[0].scrollWidth;
        var cardWidth = $(".carousel-item").width();
        var scrollPosition = 0;
        var multipleCardCarousel = document.querySelector("#carouselExampleAutoplaying");

        if (window.matchMedia("(min-width: 768px)").matches) {

            $(".carousel-control-next").on("click", function() {
                if (scrollPosition < (carouselWidth - cardWidth * 4)) { //check if you can go any further
                    scrollPosition += cardWidth; //update scroll position
                    $(".carousel-inner").animate({
                        scrollLeft: scrollPosition
                    }, 600); //scroll left
                }
            });

            $(".carousel-control-prev").on("click", function() {
                if (scrollPosition > 0) {
                    scrollPosition -= cardWidth;
                    $(".carousel-inner").animate({
                            scrollLeft: scrollPosition
                        },
                        600
                    );
                }
            });

            var carousel = new bootstrap.Carousel(multipleCardCarousel, {
                interval: false,
                wrap: false,
            });
        } else {
            $(multipleCardCarousel).addClass("slide");
        }
    </script>
</body>

</html>