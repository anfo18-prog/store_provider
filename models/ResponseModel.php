<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Response is the model behind the response form.
 *
 */
class ResponseModel extends Model
{
    public $baseUrl;
    public $sku;
    public $sortRule;
    public $ascRule;
    public $offers;

    public $useMockedData = true;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // useMockedData must be a boolean value
            ['useMockedData', 'boolean'],
            // baseUrl and sku is a string
            [['baseUrl','sku'], 'string'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'baseUrl' => 'Especifica la URL base del API a consumir ({url_base}/getAllSkuOffers/:sku)',
            'useMockedData' => '¿Usar datos mockeados en lugar de consumir un API?',
        ];
    }

    /**
     * @return mixed specified rules sorted best offer   
     */
    public function getBestOffer(){      
        //Creates new seller model
        $model = null;
        $orderedArray = [];

        //Checks if offers are not null not empty
        if($this->offers !== null && !empty($this->offers)){
            //Sort array with custom sort rules
            $rule = array_column($this->offers, $this->sortRule);
            array_multisort($rule, $this->ascRule ? SORT_ASC : SORT_DESC, $this->offers);
            
            //Gets best offer with stock
            $hasStockFlag = false;
            $index = 0;
            while(!$hasStockFlag && $index < sizeof($this->offers)){
                if($this->offers[$index]['stock'] > 0){
                    //Sets best offer values
                    $model = new Offer();
                    $model->load($this->offers[$index],'');
                    $model->seller = $this->offers[$index]['seller'];
                    $hasStockFlag = true;
                
                }else
                    $index++;
            }
        }
        
        return $model;
    }
}
