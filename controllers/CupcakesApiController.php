<?php
namespace app\controllers;

use Yii;
use app\models\Cupcakes;
use app\controllers\CupcakesController;

class CupcakesApiController extends CupcakesController
{
    public function actionView($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $cupcakes = new Cupcakes();
        return $cupcakes->viewCupcakeDetails($id);
    }

    public function actionIndex()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $cupcakes = new Cupcakes();
        return $cupcakes->viewAllCupcakes();
    }
}
