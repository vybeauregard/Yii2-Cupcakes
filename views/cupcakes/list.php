<?php
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Cupcakes;

/* @var $this yii\web\View */
$this->title = 'Available Cupcakes';
$this->params['breadcrumbs'][] = $this->title;

$dataProvider = new ActiveDataProvider([
    'query' => Cupcakes::find(),
    'pagination' => [
        'pageSize' => 20,
    ],
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'showHeader' => true,
    'showFooter' => false,
    'columns' => [
        'name',
        'description',
        'cake_flavor_1',
        'cake_flavor_2',
        'cake_color',
        'icing_flavor',
        'icing_color',
        'fondant',
        [
          'attribute' => 'calories',
          'format' => 'integer',
        ],
    ],
  ]);
 ?>