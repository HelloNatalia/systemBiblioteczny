<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use yii\helpers\Html;
?>


<div class="container">
    <div class="row">
        <img src="<?=Url::to('@web/library.jpg')?>" class="img-fluid" alt="Zdjęcie biblioteki">
    </div>
    <div class="container-fluid py-5 text-center">
        <h1 class="display-4">Witaj czytelniku!</h1>
        <p class="fs-5 fw-light">Pozwól, że Cię oprowadzę.</p>
    </div>
    <?php if (Yii::$app->user->isGuest) { ?>
        <div class="row mb-4">
            <div class="col-12 col-md-6 col-lg-3 p-2">
                <h2 class="fs-3">Nie wiesz od czego zacząć?</h2>
                <p>
                    Jeżeli nie jesteś jeszcze naszym czytelnikiem, 
                    skontaktuj się z oddziałem biblioteki i na miejscu 
                    bądź mailowo wypełnij odpowiedni formularz.
                </p>
                <p><?= Html::a('Kontakt &raquo;', ['contact'], ['class' => 'btn btn-outline-success']) ?></p>
            </div>
            <div class="col-12 col-md-6 col-lg-3 p-2">
                <h2 class="fs-3">Jak założyć konto?</h2>
                <p>
                    Jeżeli jesteś już naszym czytelnikiem ale nie masz jeszcze 
                    konta, załóż je podając swój numer identyfikacyjny. Po zarejestrowaniu 
                    przejdź na podany adres e-mail i zweryfikuj konto. Gotowe!
                </p>
                <p><?= Html::a('Rejestracja &raquo;', ['signup'], ['class' => 'btn btn-outline-success']) ?></p>
            </div>
            <div class="col-12 col-md-6 col-lg-3 p-2">
                <h2 class="fs-3">Logowanie</h2>
                <p>
                    Po rejestracji zaloguj się podając swój numer identyfikacyjny oraz stworzone 
                    hasło. Po zalogowaniu otrzymasz 
                    zdalny dostęp do wszystkich informacji o Twoim koncie oraz 
                    o wypożyczonych przez Ciebie książkach.
                </p>
                <p><?= Html::a('Logowanie &raquo;', ['login'], ['class' => 'btn btn-outline-success']) ?></p>
            </div>
            <div class="col-12 col-md-6 col-lg-3 p-2">
                <h2 class="fs-3">Możliwości</h2>
                <p>
                    Na Naszej aplikacji możesz sprawdzić jakie posiadamy książki, ich dostępność, 
                    poznać naszych autorów oraz mieć dostęp do informacji o swoich wypożyczeniach. 
                    Sprawdź zakładki u góry strony.
                </p>
            </div>
        </div>
    <?php } else { ?>
        <div class="row mb-4">
            <div class="col-12 col-md-4 col-lg-4 p-2">
                <h2 class="fs-3">Moje konto</h2>
                <p>
                    W tym miejscu możesz zobaczyć informacje o swoim koncie oraz 
                    wszystkie wypożyczone książki wraz z terminem zwrotu i informacją 
                    ile zostało dni.
                </p>
                <p><?= Html::a('Moje konto &raquo;', ['reader/index'], ['class' => 'btn btn-outline-success']) ?></p>
            </div>
            <div class="col-12 col-md-4 col-lg-4 p-2">
                <h2 class="fs-3">Książki</h2>
                <p>
                    Masz możliwość sprawdzenia jakie posiadamy książki oraz czy są dostępne. 
                    Z pomocą intuicyjnego formularza wyszukiwania możesz w szybki i prosty sposób wyszukać 
                    interesującą Cię pozycję a następnie po kliknięciu w daną książkę możesz zobaczyć jej szczegóły.
                </p>
                <p><?= Html::a('Książki &raquo;', ['books/index'], ['class' => 'btn btn-outline-success']) ?></p>
            </div>
            <div class="col-12 col-md-4 col-lg-4 p-2">
                <h2 class="fs-3">Autorzy</h2>
                <p>
                    W zakładce autorzy zobaczysz listę wszystkich autorów, których książki posiadamy w 
                    naszym asortymencie. Możesz w szybki i prosty sposób wyszukać konkretną osobę, a 
                    po kliknięciu na nią pojawią się wszystkie jej książki dostępne w bibliotece.
                </p>
                <p><?= Html::a('Autorzy &raquo;', ['books/authors'], ['class' => 'btn btn-outline-success']) ?></p>
            </div>
        </div>
    <?php } ?>
</div>



