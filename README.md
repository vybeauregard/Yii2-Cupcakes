# Yii2
Notes for Yii2 for those unfamiliar with the framework

_index.php_
```php
// Include the Yii framework
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
// Get the configuration
$config = require(__DIR__ . '/../config/web.php');
// Make and launch the application immediately 
(new yii\web\Application($config))->run();
```

_config.php_ holds configuration values for every part of your app.
- error handling
- caching directives
- database config
- time zone settings
- url management

##Controllers

Controllers direct traffic between the browser and the data. Yii2 knows that when a user requests the page at `cupcakes/list` to talk to the cupcakes controller and find out what it says to do with `actionList()`. From the context provided by the verb list, we can deduct that this route will produce a list of all the cupcakes that are available.

_controllers/cupcakes.php_
```php
namespace app\controllers;

use Yii;
use app\models\Cupcake;
use app\models\CupcakeSearch;

class CupcakeController extends Controller
{
  public function actionList(){
    $searchModel = new CupcakeSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
    return $this->render('list', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }
}
```

Yes, we're tracking cupcakes. Here's the simple data structure we'll be working with:

id|name|description|cake_flavor_1|cake_flavor_2|cake_color|icing_flavor|icing_color|fondant|calories
---|---|---|---|---|---|---|---|---|---
1|Marble|Marble|Chocolate|Vanilla|Marble|Butter Cream|Ivory|No|220

Before we wire up a model and view to the `controllers/cupcakes.php`, let's create our table using Yii's migration feature.

##Migrations
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
    }
    public function down()
    {
      $this->dropTable('cupcakes');
    }
```

The `Schema::TYPE_` constants allow Yii to remain database-engine agnostic if you need to switch from, for example, POSTGRES to SQLite in midstream. As the migration is being applied, it will pull the site configuration and determine the data types for the database you're using. [Here's a list of available constants](http://www.yiiframework.com/doc-2.0/yii-db-schema.html#constants).

Once the migration file is saved, return to the command line and execute `./yii migrate/up`. You will be prompted to confirm the alteration, then the cupcakes table will be created.

##Models

Models are fairly straightforward. They tell Yii how our cupcake object is structured and where to find the data when we ask for it. In most cases, we can use Gii to automatically generate a model based off of the table structure in the database. This model can be altered and updated after it is generated, but Gii makes sure everything in the table makes it across to the model.

_Gii can be accessed in dev environments at_ http://your-dev-url/gii/

Of particular note in the cupcake model Gii generates is the `rules()` method, which allows you to set validation parameters for each field. Also, if your table uses field names that aren't super-great for human-readability, you can map them to better descriptors in the `attributeLabels()` method.
