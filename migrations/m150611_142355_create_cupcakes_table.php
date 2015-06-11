<?php

use yii\db\Schema;
use yii\db\Migration;

class m150611_142355_create_cupcakes_table extends Migration
{
    public function up()
    {
        $this->createTable('cupcakes', [
        'id' => Schema::TYPE_PK,
        'name' => Schema::TYPE_STRING,
        'description' => Schema::TYPE_STRING,
        'cake_flavor_1' => Schema::TYPE_STRING,
        'cake_flavor_2' => Schema::TYPE_STRING,
        'cake_color' => Schema::TYPE_STRING,
        'icing_flavor' => Schema::TYPE_STRING,
        'icing_color' => Schema::TYPE_STRING,
        'fondant' => Schema::TYPE_STRING,
        'calories' => Schema::TYPE_INTEGER,
      ]);
      $this->batchInsert('cupcakes', ['name', 'description', 'cake_flavor_1', 'cake_flavor_2', 'cake_color', 'icing_flavor', 'icing_color', 'fondant', 'calories'], [
        ['Marble', 'Marble', 'Chocolate', 'Vanilla', 'Marble', 'Butter Cream', 'Ivory', 'No', '220'],
        ['Pumpkin Mania', 'It looks and tastes like a whole pumpkin!', 'Pumpkin', 'null', 'Orange', 'Cream Cheese', 'White', 'No', '190'],
        ['Power Up!', 'Mushrooms inspired by Super Mario Bros.', 'Carrot Cake', 'null', 'Brown', 'Cream Cheese', 'White', 'Yes', '245'],
      ]);
    }

    public function down()
    {
      $this->dropTable('cupcakes');
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
