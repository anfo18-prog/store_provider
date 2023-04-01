<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use app\models\Sell;
use app\models\SkuSells;

class SellController extends ActiveController
{
	public $modelClass = 'app\models\Sell';

	public function actions(){
        $actions = parent::actions();
        unset($actions['update'], $actions['delete']);
        return $actions;
    }

    /**
    * Creates a sell, HTTP POST method
    */
    public function actionCreate(){
        $model = new Sell();

        $model->load(Yii::$app->request->post(),'');

        //Begins a transaction
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();

        //Commits or rollbacks db's changes 
        try {
            //Tries to save model
            if(!$model->save())
                return $model->getErrors();

            return $model;

        } catch (Exception $e) {
            $transaction->rollback();
            $model->addError('Error',$e->getMessage());
            return $model->getErrors();
        }
    }

    /**
     * @SWG\Get(path="/sell/find-by-dates",
     *     tags={"Sell"},
     *     summary="Retrieves the collection of sells between two given dates.",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Sells collection response",
     *         @SWG\Schema(ref = "#/definitions/Sell")
     *     ),
     * )
     */
    public function actionFindByDates($date_from, $date_to, $page = 0, $limit = 10, $orderAsc = true){
        $query = Sell::find()->where(['between', 'date', $date_from, $date_to])
                      ->orderBy(['date' => $orderAsc ? SORT_ASC : SORT_DESC]);                                      

        //Creates data provider with pagination
        $dataProvider = new ActiveDataProvider([
            'pagination' => [
                'page' => $page,
                'pageSize' => $limit,
            ],
            'query' => $query,
        ]);

        return $dataProvider; 
    }

    /**
     * @SWG\Get(path="/sell/daily-sells",
     *     tags={"Sell"},
     *     summary="Retrieves the collection of gruped price of every sku sell in the given date.",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Sells sku report collection response",
     *         @SWG\Schema(ref = "#/definitions/Sell")
     *     ),
     * )
     */
    public function actionDailySells($date, $page = 0, $limit = 10){
        
    	$toDate = new \DateTime($date);
    	$toDate->modify('+1 day');

    	$query = SkuSells::find()
    	->select(['sku','SUM(price) AS price'])
		->where(['between', 'date', $date, $toDate->format('Y-m-d 00:00:00')])
		->groupBy(['sku']);

        //Creates data provider with pagination
        $dataProvider = new ActiveDataProvider([
            'pagination' => [
                'page' => $page,
                'pageSize' => $limit,
            ],
            'query' => $query,
        ]);

        return $dataProvider; 
    }
}