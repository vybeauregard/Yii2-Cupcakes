# Yii2
####Let's make some delicious cupcakes!

_Before you get started, you'll probably want to [get your environment configured](https://github.com/vybeauregard/Yii2-Cupcakes/wiki/Configuring-your-environment)._

_config.php_ holds configuration values for every part of your app.
- error handling
- caching directives
- database config
- time zone settings
- url management

The database in the project has been configured to create an [SQLite](https://github.com/vybeauregard/Yii2-Cupcakes/wiki/SQLite) data store in the `db` directory.

##File structure
> _or, "[Keeping the Varmints Out](http://youtu.be/THWCH2Nwsss)"_

One large concern for any framework is keeping code organized. This fosters a collaborative environment because it makes it easier to deduce where a particular function is being called from. With Yii2, there are a lot of files that need to be accessible to the server, but not accessible from a web browser (e.g. controllers, db config, vendor files). That's where our `web` folder comes in handy. We will tell the web server that the root of the site is located at `web` and php will still be able to access all of the other files in our project without exposing them to the world.

##Cupcakes!

Here's the simple data structure we'll be working with:

id|name|description|cake_flavor_1|cake_flavor_2|cake_color|icing_flavor|icing_color|fondant|calories
---|---|---|---|---|---|---|---|---|---
1|Marble|Marble|Chocolate|Vanilla|Marble|Butter Cream|Ivory|No|220
2|Pumpkin Mania|It looks and tastes like a whole pumpkin!|Pumpkin|null|Orange|Cream Cheese|White|No|190
3|Power Up!|Mushrooms inspired by Super Mario Bros.|Carrot Cake|null|Brown|Cream Cheese|White|Yes|245


Before we wire up a model and view to the `controllers/CupcakesController.php`, let's create our table using Yii's migration feature.

##Migrations
> _[Are you suggesting coconuts migrate?](http://youtu.be/w8Rn_f75UHs#t=80)_

To initialize a new migration, navigate to your project in the command line and execute `./yii migrate/create create_cupcakes_table`. This will create a new migration file `m150610_160800_create_cupcakes_table.php` with today's date and time in the file name. Inside the migration class are two methods: `up()` and `down()`. When rolling back migrations, `down` will be executed. When applying a migration, `up` is executed.
If you're using a transactional database engine, `safeUp()` and `safeDown()` will do the same, but in a transaction-safe manner.
Since we're just creating a table to hold some cupcakes, we'll just add the `createTable()` information to `up()` and the `dropTable()` command to `down()`.

```php
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
```

The `Schema::TYPE_` constants allow Yii to remain database-engine agnostic if you need to switch from, for example, POSTGRES to SQLite in midstream. As the migration is being applied, it will pull the site configuration and determine the data types for the database you're using. [Here's a list of available constants](http://www.yiiframework.com/doc-2.0/yii-db-schema.html#constants).

`batchInsert()` allows us to pre-populate the table with data as the table is created. This is helpful if you know ahead of time what data records will be required in the table. [Here are the Yii2 docs on `batchInsert()`](http://www.yiiframework.com/doc-2.0/yii-db-migration.html#batchInsert()-detail).

Once the migration file is saved, return to the command line and execute `./yii migrate`. You will be prompted to confirm the alteration, then the cupcakes table will be created.

##Models
> _[Do a little turn on the catwalk](http://youtu.be/YFmsgHfuXpA#t=56)_

Models are fairly straightforward. They tell Yii how our cupcakes object is structured and where to find the data when we ask for it. In most cases, we can use Gii to automatically generate a model based off of the table structure in the database. This model can be altered and updated after it is generated, but Gii makes sure everything in the table makes it across to the model.

_Gii can be accessed in dev environments at_ http://your-dev-url/gii/

Take a look at the wiki to quickly [dip your toes in the Gii waters](https://github.com/vybeauregard/Yii2-Cupcakes/wiki/Gii) and create our `Cupcakes` model.

Of particular note in the `Cupcakes` model Gii generates is the `rules()` method, which allows you to set validation parameters for each field. Also, if your table uses field names that aren't super-great for human-readability, you can map them to better descriptors in the `attributeLabels()` method.

##Controllers
> _[Where do you think **you're** going?](http://youtu.be/mk74WprmZxY#t=12)_

Controllers direct traffic between the browser and the data. Yii2 knows that when a user requests the page at `cupcakes/list` to talk to the cupcakes controller and find out what it says to do with `actionList()`. From the context provided by the verb list, we can deduct that this route will produce a list of all the cupcakes that are available.

_controllers/CupcakesController.php_
```php
namespace app\controllers;

use Yii;
use app\models\Cupcakes;
use yii\base\Controller; 
use yii\web\NotFoundHttpException;

class CupcakesController extends Controller
{
  public function actionList(){
    $model = Cupcakes::find();
    if($model === null){
      throw new NotFoundHttpException;
    }
    return $this->render('list', [
      'model' => $model,
    ]);
  }
}
```

Now that we have a `Cupcakes` model and a `CupcakesController`, it's time to make a Cupcakes view!

##Views
> _[I just adore a penthouse view](http://youtu.be/DrbPAt1_vc4#t=40)_

You'll notice in our Controller, the action we created was called `actionList`. 
```php
    return $this->render('list', [
      'model' => $model;
    ]);
```
So we need to create a view called `list.php` in our `views/cupcakes` directory. By default, this is where Yii looks for the view associated with the controller handling our request.

_views/cupcakes/list.php_
```php
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
```

[GridView](http://www.yiiframework.com/doc-2.0/yii-grid-gridview.html) is a handy Yii widget that will render a lovely grid with all of your cupcakes neatly aligned and sortable by any column the user desires!
