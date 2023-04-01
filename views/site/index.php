<?php
use yii\widgets\DetailView;
/** @var yii\web\View $this */

$this->title = 'Tiendamia Challenge!';
?>

<div class="site-index">

    <?php if(YII_ENV_DEV) { 
        echo $this->render('_response-form', [
            'model' => $model,
        ]); } ?>

    <div class="body-content">

        <div class="row" align="center">
            <div class="col-lg-12">
              
                <?= $model->bestOffer !== null ? DetailView::widget([
                    'model' => $model->bestOffer,
                    'attributes' => [
                        //'id',
                        'price',
                        'stock',
                        'shipping_price',
                        'delivery_date',
                        //'status',
                        'currentStatusFormattedName',
                        //'can_be_refunded',
                        'canBeRefundedInfo',
                        //'guarantee',
                        'guaranteeInfo',
                        //'seller',
                        'sellerInfo',
                    ],
                ]) : "<p>Aún no se han asociado ofertas</p>" ?>

            </div>
        </div>

    </div>
</div>
