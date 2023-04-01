<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\ResponseModel;
use app\models\Offer;
use app\models\Constants;
use yii\httpclient\Client;


class OfferController extends ActiveController
{
	public $modelClass = 'app\models\Offer';	

	public function actions(){
        $actions = parent::actions();
        unset($actions['index'], $actions['update'], $actions['create'], $actions['delete'], $actions['view']);
        return $actions;
    }

    /**
     * Displays best offer by SKU and associated rules.
     *
     * @return mixed best offer model
     */
    public function actionBestOfferBySku($sku = 'xxx', $sortRule = Constants::SORT_BY_PRICE, $ascRule = false, $isMockData = false)
    {
        //Initializes values
        $client = new Client();
        $model = new ResponseModel();
        $model->sku = $sku;
        $model->sortRule = $sortRule;
        $model->ascRule = $ascRule;
        $responseData;

        //Tries to get response from API service if mock service is disabled
        if(!$isMockData) {

        	try{
                //Gets service response
                $response = $client->createRequest()
                    ->setMethod('GET')
                    ->setUrl(Yii::$app->params['baseURL']."/getAllSkuOffers/$model->sku")
                    ->send();

                //Validates process
                if($response->isOk)
                    $responseData = $response->data;
                
                else{
                    $model->addError('Error',$response->getContent());
                    return $model->getErrors();
                }
                

            }catch (\Exception $e){
                $model->addError('Error',$e->getMessage());
                return $model->getErrors();
            }
            
        
        }else
            //Sets mocked data
            $responseData = json_decode(Yii::$app->params['mockOffers'],true);
            

        //Sets offers array
        $model->offers = $responseData['offers'];
        
        return $model->bestOffer;
    }
}