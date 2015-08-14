<?php

namespace app\controllers;

use Yii;
use app\models\Cupcakes;
use yii\base\Controller;
use yii\web\NotFoundHttpException;

class CupcakesController extends Controller
{
  public function actionList()
  {
    $model = Cupcakes::find();
    if($model === null){
      throw new NotFoundHttpException;
    }
    return $this->render('list', [
      'model' => $model,
    ]);
  }

  public function actionIndex()
  {
      return $this->render('index');
  }
}
