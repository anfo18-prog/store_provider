<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="jumbotron text-center bg-transparent">
    <h1 class="display-4">Selección de parámetros</h1>

    <p class="lead">Solo visible si se está en Debug mod!</p>
</div>
<div class="site-login">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">

            <?php $form = ActiveForm::begin(['id' => 'response-form']); ?>

                <?= $form->field($model, 'useMockedData')->checkbox() ?>

                <?= $form->field($model, 'baseUrl')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'sku')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Recargar datos', ['class' => 'btn btn-primary', 'name' => 'response-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>

        </div>
        <div class="col-lg-3"></div>
    </div>
</div>