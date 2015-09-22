<?php

namespace app\controllers;

use Yii;
use app\models\Cupcakes;
use app\models\CupcakesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CupcakesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionList()
    {
        $searchModel = new CupcakesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('list', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    protected function findModel($id)
    {
        if (($model = Cupcakes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
