<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cupcakes".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $cake_flavor_1
 * @property string $cake_flavor_2
 * @property string $cake_color
 * @property string $icing_flavor
 * @property string $icing_color
 * @property string $fondant
 * @property integer $calories
 */
class Cupcakes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cupcakes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['calories'], 'integer'],
            [['name', 'description', 'cake_flavor_1', 'cake_flavor_2', 'cake_color', 'icing_flavor', 'icing_color', 'fondant'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'cake_flavor_1' => 'Cake Flavor 1',
            'cake_flavor_2' => 'Cake Flavor 2',
            'cake_color' => 'Cake Color',
            'icing_flavor' => 'Icing Flavor',
            'icing_color' => 'Icing Color',
            'fondant' => 'Fondant',
            'calories' => 'Calories',
        ];
    }

    public function viewCupcakeDetails($id)
    {
        return $this->findOne($id);
    }

    public function viewAllCupcakes()
    {
        return $this->find()->all();
    }
}
