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

##Models

Models are fairly simple. They tell Yii how our cupcake object is structured and where to find the data when we ask for it. In most cases, we can use Gii to automatically generate a model based off of the table structure in the database. This model can be altered and updated after it is generated, but Gii makes sure everything in the table makes it across to the model.

_Gii can be accessed in dev environments at_ http://your-dev-url/gii/

####_A simple data structure_
id|name|description|cake_flavor_1|cake_flavor_2|cake_color|icing_flavor|icing_color|fondant|calories
---|---|---|---|---|---|---|---|---|---
1|Marble|Marble|Chocolate|Vanilla|Marble|Butter Cream|Ivory|No|220



Of particular note in the cupcake model Gii generates is the `rules()` method, which allows you to set validation parameters for each field. Also, if your table uses field names that aren't super-great for human-readability, you can map them to better descriptors in the `attributeLabels()` method.
