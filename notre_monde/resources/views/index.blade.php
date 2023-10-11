@extends('layouts.NavFooter')
@section('content')
@extends('layouts.HeaderFiltre')
<!-- Features section-->
<section class="py-5 border-bottom" id="features">
    <div class="wrapper">
        <h2 class="titre1">Nos destinations<h2>
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
            <p>
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
                    <h3 class="soustitre">First slide label</h3>
                    <button type="button" class="btn btn-success accent">Explorer</button>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-img-wrapper">
                    <img src="{{ asset('images/amazonie.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h3 class="soustitre">Second slide label</h3>
                    <button type="button" class="btn btn-success accent">Explorer</button>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-img-wrapper">
                    <img src="{{ asset('images/amazonie.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h3 class="soustitre">Second slide label</h3>
                    <button type="button" class="btn btn-success accent">Explorer</button>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-img-wrapper">
                    <img src="{{ asset('images/amazonie.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h3 class="soustitre">Second slide label</h3>
                    <button type="button" class="btn btn-success accent">Explorer</button>
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
        <p>
            N’hésitez plus ! Si vous avez des questions...
        </p>
    </div>
</section>
@endsection