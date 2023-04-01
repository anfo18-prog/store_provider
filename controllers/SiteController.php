<?php

namespace app\controllers;

use Yii;
use yii\web\BadRequestHttpException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ResponseModel;
use app\models\Offer;
use app\models\Constants;
use yii\httpclient\Client;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($sku = 'xxx', $sortRule = Constants::SORT_BY_SHIPPING_PRICE, $ascRule = false)
    {
        //TODO: 1. Try to create and API from this basic app
        //      2. Add new Model (Sell -id, date, sku, offer_id) and Controller (SellController -actionCreate, -actionIndex with start/end date params)
        //      3. Check how to create a Docker file from this
        //      4. Check how to implement Swagger to show services inventory

        //Initializes values
        $client = new Client();
        $model = new ResponseModel();
        $model->sku = $sku;
        $model->sortRule = $sortRule;
        $model->ascRule = $ascRule;
        $model->baseUrl = Yii::$app->params['baseURL'];
        $responseData;

        //Loads post values if applies (debug mode)
        $model->load(Yii::$app->request->post());

        //Tries to get response from API service if mock service is disabled
        if(!$model->useMockedData) {
            
            try{
                //Gets service response
                $response = $client->createRequest()
                    ->setMethod('GET')
                    ->setUrl("$model->baseUrl/getAllSkuOffers/$model->sku")
                    ->send();

                //Validates process
                if($response->isOk)
                    $responseData = $response->data;
                
                else
                    throw new BadRequestHttpException($response->getContent());
                

            }catch (\Exception $e){
                throw new BadRequestHttpException($e->getMessage());
            }
            
        
        }else
            //Sets mocked data
            $responseData = json_decode(Yii::$app->params['mockOffers'],true);
            

        //Sets offers array
        $model->offers = $responseData['offers'];
        
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
