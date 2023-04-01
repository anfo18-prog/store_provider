<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Offer is the model behind the seller info.
 */
class Seller extends Model
{
    public $name;
    public $qualification;
    public $reviews_quantity;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name is required
            [['name'], 'required'],
            // qualification and reviews_quantity are integers
            [['qualification', 'reviews_quantity'], 'integer'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Nombre',
            'qualification' => 'Calificación',
            'reviews_quantity' => 'Cantidad de reseñas',
        ];
    }
}
