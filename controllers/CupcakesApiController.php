<?php
namespace app\controllers;

use Yii;
use app\models\Cupcakes;
use app\controllers\CupcakesController;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;


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

    public function actionUpdate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Json::decode(Yii::$app->request->getRawBody());
        foreach($request as $newCupcake){
            $cupcake = $this->findModel($newCupcake['id']);
            $cupcake->setAttributes($newCupcake);
            $cupcake->save();
        }
    }

    /*
    * Finds the Compliance model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return Compliance the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
   protected function findModel($id)
   {
       if (($model = Cupcakes::findOne($id)) !== null) {
           return $model;
       } else {
           return new Cupcake;
       }
   }
}
