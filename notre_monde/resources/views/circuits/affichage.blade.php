@extends('layouts.NavFooter')
@extends('layouts.HeaderFiltre')
@section('content')

<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item accent"><a href="#">Home</a></li>
        <li class="breadcrumb-item accent active" aria-current="page">Library</li>
    </ol>
</nav>

<header class="presentation">
    <div class="img-presentation">
        <img src="{{asset ('images/amazonie.jpg') }}" alt="">
    </div>
    <div class="txt-presentation">
        <h1 class="titre1">Émilie-Romagne : Une Aventure Italienne</h1>
        <p>Explorez les ruelles pavées de Bologne, découvrez les secrets de fabrication du vinaigre balsamique à Modène, et goûtez les délices du Parmesan dans les fromageries locales. Vous serez enchanté par la beauté des villes médiévales, les trésors artistiques et les traditions gastronomiques uniques de cette région. Une expérience gustative et culturelle qui éveillera tous vos sens.</p>
        <p class="soutitre">Catégorie :</p>
        <p class="soutitre">Thématiques :</p>
        <div class="flex-text">
            <p class="soutitre">Destination :</p>
            <p class="soutitre">Durée :</p>
        </div>
        <p class="titre2">Prix</p>
        <button type="button" class="btn btn-success">Demandez un devis</button>
    </div>
</header>

@endsection