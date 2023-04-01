<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Offer is the model behind the response data.
 */
class Offer extends Model
{
    public $id;
    public $price;
    public $stock;
    public $shipping_price;
    public $delivery_date;
    public $can_be_refunded;
    public $guarantee;
    public $status;
    public $seller;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // id and stock are required
            [['id', 'stock'], 'required'],
            // price and shipping_price are decimals
            [['price', 'shipping_price'], 'number'],
            // id and stock are integers
            [['id', 'stock'], 'integer'],
            // status is a string
            [['status'], 'string'],
            // delivery_date is a date
            [['delivery_date'], 'safe'],
            // guarantee and can_be_refunded must be a boolean value
            [['guarantee','can_be_refunded'], 'boolean'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'stock' => 'Cantidad disponible',
            'price' => 'Precio',
            'shipping_price' => 'Costo de envío',
            'delivery_date' => 'Fecha de envío',
            'currentStatusFormattedName' => 'Estado',
            'sellerInfo' => 'Vendedor',
            'canBeRefundedInfo' => '¿Tiene devolución?',
            'guaranteeInfo' => '¿Tiene garantía?',
        ];
    }

    /**
     * @return mixed related seller model   
     */
    public function getSellerModel(){      
        //Creates new seller model
        $model = new Seller();
        
        //Retrieves info from current array
        $model->load($this->seller,'');
        
        return $model;
    }

    /**
     * Gets current status formatted name
     */
    public function getCurrentStatusFormattedName()
    {
        switch($this->status){
            case 'new':
            return 'Nuevo';

            case 'used':
            return 'Usado';

            default:
            return 'Remanufacturado';
        }
    }

    /**
     * Gets current seller formatted info
     */
    public function getSellerInfo()
    {
        return "Nombre del vendedor: ".$this->sellerModel->name.", ". 
            "Calificación: ".$this->sellerModel->qualification.", ".
            "Cantidad de reseñas: ".$this->sellerModel->reviews_quantity;
    }

    /**
     * Gets current refund formatted info
     */
    public function getCanBeRefundedInfo()
    {
        return $this->can_be_refunded ? "Si" : "No";
    }

    /**
     * Gets current guarantee formatted info
     */
    public function getGuaranteeInfo()
    {
        return $this->guarantee ? "Si" : "No";
    }
}
