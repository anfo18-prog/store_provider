<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

?>
<div class="site-error">

    <h1><?= Html::encode($name) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        El error descrito arriba se presentó mientras se procesaba la petición en el servidor.
    </p>
    <p>
        Por favor inténta nuevamente y contáctanos si el error persiste. Gracias.
    </p>
    <div align="center">
        <?= Html::a('Volver', Yii::$app->request->referrer, ['class' => 'btn btn-info']); ?>
    </div>

</div>
