<?php
use app\customvendor\labcoat\LabcoatGrid;
use yii\data\ActiveDataProvider;
use app\models\Cupcakes;
use app\models\CupcakesSearch;

/* @var $this yii\web\View */
$this->title = 'Available Cupcakes';
$this->params['breadcrumbs'][] = $this->title;

echo LabcoatGrid::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
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
    'title' => 'Cupcakes',
    'subtitle' => 'Betchya can\'t eat just one',
  ]);
 ?>
