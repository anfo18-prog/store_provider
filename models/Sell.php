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
class Sell extends \yii\db\ActiveRecord
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
            [['offer_id'], 'required'],
            [['offer_id'], 'integer'],
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
            'offer_id' => 'Offer ID',
        ];
    }
}
