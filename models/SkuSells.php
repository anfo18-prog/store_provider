<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sell".
 *
 * @property int $id
 * @property string $date
 * @property string|null $sku
 * @property int $offer_id
 */
class SkuSells extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sell';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['sku'], 'string'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'sku' => 'Sku',
            'price' => 'Price',
        ];
    }
}
