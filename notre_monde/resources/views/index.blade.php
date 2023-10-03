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
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <style>
        @media (min-width: 768px) {
            .card-carousel-inner {
                display: flex;
                overflow: hidden;
            }

            .card {
                margin: 0 1em;
            }

            .card-carousel-item {
                margin-right: 0;
                flex: 0 0 33.333333%;
                display: block;
            }

            .img-wrapper {
                max-width: 100%;
                height: 350px;
            }

            .carousel-img-wrapper{
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
                    <li class="nav-item"><a class="nav-link" href="#!">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Circuits</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Thématiques</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="">
                    <div class="text-center my-5">
                        <h1 class="display-5 fw-bolder text-white mb-2">LE VOYAGE QUI VOUS RESSEMBLE</h1>
                        <form action="">
                            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                <select class="form-select btn-light px-4" aria-label="Default select example">
                                    <option selected>Choisissez une destination</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <select class="form-select btn-light px-4" aria-label="Default select example">
                                    <option selected>Choisissez une destination</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <select class="form-select btn-light px-4" aria-label="Default select example">
                                    <option selected>Choisissez une destination</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <select class="form-select btn-light px-4" aria-label="Default select example">
                                    <option selected>Choisissez une destination</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <button type="submit" class="btn btn-light">Rechercher</button>
                            </div>
                        </form>
                    </div>
                    <p class="lead text-white-50 mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit!</p>
                </div>
            </div>
        </div>
    </header>
    <!-- Features section-->
    <section class="py-5 border-bottom" id="features">
        <div class="wrapper">
            <h2>Nos destinations<h2>
        </div>
        <div id="carouselExampleAutoplaying" class="carousel">
            <div class="carousel-inner card-carousel-inner">
                <div class="carousel-item card-carousel-item active">
                    <div class="card">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3 class="card-title soustitre">Thailande</h3>
                            <button type="button" class="btn btn-success">Explorer</button>
                        </div>
                    </div>
                </div>
                <div class="carousel-item card-carousel-item">
                    <div class="card">
                        <div class="img-wrapper">
                            <img src="{{ asset('images/amazonie.jpg') }}" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title soustitre">Thailande</h3>
                            <button type="button" class="btn btn-success">Explorer</button>
                        </div>
                    </div>
                </div>
                <div class="carousel-item card-carousel-item">
                    <div class="card">
                        <div class="img-wrapper">
                            <img src="{{ asset('images/amazonie.jpg') }}" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title soustitre">Thailande</h3>
                            <button type="button" class="btn btn-success">Explorer</button>
                        </div>
                    </div>
                </div>
                <div class="carousel-item card-carousel-item">
                    <div class="card">
                        <div class="img-wrapper">
                            <img src="{{ asset('images/amazonie.jpg') }}" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title soustitre">Thailande</h3>
                            <button type="button" class="btn btn-success">Explorer</button>
                        </div>
                    </div>
                </div>
                <div class="carousel-item card-carousel-item">
                    <div class="card">
                        <div class="img-wrapper">
                            <img src="{{ asset('images/amazonie.jpg') }}" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title soustitre">Thailande</h3>
                            <button type="button" class="btn btn-success">Explorer</button>
                        </div>
                    </div>
                </div>
                <div class="carousel-item card-carousel-item">
                    <div class="card">
                        <div class="img-wrapper">
                            <img src="{{ asset('images/amazonie.jpg') }}" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title soustitre">Thailande</h3>
                            <button type="button" class="btn btn-success">Explorer</button>
                        </div>
                    </div>
                </div>
                <div class="carousel-item card-carousel-item">
                    <div class="card">
                        <div class="img-wrapper">
                            <img src="{{ asset('images/amazonie.jpg') }}" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title soustitre">Thailande</h3>
                            <button type="button" class="btn btn-success">Explorer</button>
                        </div>
                    </div>
                </div>
                <div class="carousel-item card-carousel-item">
                    <div class="card">
                        <div class="img-wrapper">
                            <img src="{{ asset('images/amazonie.jpg') }}" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title soustitre">Thailande</h3>
                            <button type="button" class="btn btn-success">Explorer</button>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section>
        <div id="sur-mesure">
            <img src="" alt="">
            <div class="text">
                <h3 class="titre2">
                    Partir avec nous
                </h3>
                <p class="paragraphe">
                    Tous nos circuits sont modifiables pour répondre à vos besoins spécifiques. Vous pouvez ajuster l'itinéraire, la durée et les activités pour créer une expérience de voyage sur mesure.
                    Laissez-vous guider par notre agence de voyage dédiée au slow travel pour une aventure qui vous permettra de savourer chaque moment de votre voyage. Explorez les destinations avec une perspective différente, en prenant le temps de vous connecter avec les habitants et de vous imprégner de la beauté du voyage lui-même.

                    N’hésitez plus !
                    Tous les circuits sont adaptables ....
                </p>
                <button type="button" class="btn btn-success">Explorer</button>
            </div>
        </div>
    </section>

    <section>
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-img-wrapper">
                        <img src="{{ asset('images/amazonie.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-caption d-none d-md-block">
                        <h3>First slide label</h3>
                        <button type="button" class="btn btn-success">Explorer</button>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-img-wrapper">
                        <img src="{{ asset('images/amazonie.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Second slide label</h3>
                        <button type="button" class="btn btn-success">Explorer</button>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-img-wrapper">
                        <img src="{{ asset('images/amazonie.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Second slide label</h3>
                        <button type="button" class="btn btn-success">Explorer</button>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-img-wrapper">
                        <img src="{{ asset('images/amazonie.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Second slide label</h3>
                        <button type="button" class="btn btn-success">Explorer</button>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="why-us">
            <div class="why-us-items">
                <div class="why-us-item">
                    <img src="" alt="">
                    <p class="accent">Expérience Authentique</p>
                </div>
                <div class="why-us-item">
                    <img src="" alt="">
                    <p class="accent">Flexibilité Totale</p>
                </div>
                <div class="why-us-item">
                    <img src="" alt="">
                    <p class="accent">Professionnalisme</p>
                </div>
            </div>
            <button type="button" class="btn btn-success">Explorer</button>
            <p class="paragraphe">
                N’hésitez plus ! Si vous avez des questions...
            </p>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <img src="" alt="" class="footer-logo">
        <div class="container px-5">
            <h4 class="accent">À propos</h4>
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
        <div class="container px-5">
            <h4 class="accent"></h4>
            <ul>
                <li class="m-0 text-center">
                    <h4>Copyright &copy; Your Website 2023</h4>
                </li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
            </ul>
            <ul>
                <li class="m-0 text-center">
                    <h4>Copyright &copy; Your Website 2023</h4>
                </li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
            </ul>
            <ul>
                <li class="m-0 text-center">
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