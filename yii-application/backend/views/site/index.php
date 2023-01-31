<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Modules</h1>

        </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-3">
                <h2>Books</h2>
                <p><a class="btn btn-lg btn-success" href="index.php?r=books%2Findex">Go to books</a></p>
            </div>
            <div class="col-lg-3">
                <h2>Borrows</h2>
                <p><a class="btn btn-lg btn-success" href="index.php?r=borrow%2Findex">Go to borrows</a></p>    
            </div>
            <div class="col-lg-3">
                <h2>Readers</h2>
                <p><a class="btn btn-lg btn-success" href="index.php?r=readers%2Findex">Go to readers</a></p>
            </div>
            <div class="col-lg-3">
                <h2>Cash</h2>
                <p><a class="btn btn-lg btn-success" href="index.php?r=prices%2Findex">Go to cash</a></p>
            </div>
        </div>

    </div>
</div>
