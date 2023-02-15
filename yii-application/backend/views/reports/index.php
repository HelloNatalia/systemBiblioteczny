<?php
/** @var yii\web\View $this */
use yii\helpers\Url;
?>
<h1>reports/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>

<a href="<?=Url::to(['borrows'])?>"><button>Wypożyczenia</button></a>
<a href="<?=Url::to(['returns'])?>"><button>Zwroty</button></a>
<a href="<?=Url::to(['extensions'])?>"><button>Przedłużenia</button></a>
<a href="<?=Url::to(['paid'])?>"><button>Wpływy</button></a>
<a href="<?=Url::to(['status'])?>"><button>Status</button></a>
