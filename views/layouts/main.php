<?php
/*

	LABCOAT NEEDS:
		widget for page-header
		widget for security markings







*/


use yii\helpers\Html;
use app\customvendor\labcoat\LabcoatSiteHeader;
use app\customvendor\labcoat\LabcoatPrimarySidebar;
use app\customvendor\labcoat\LabcoatSecondarySidebar;
use app\customvendor\labcoat\LabcoatSecurityMarkings;
// use yii\bootstrap\NavBar;
// use yii\widgets\Breadcrumbs;
use customvendor\labcoat\LabcoatAsset;

/* @var $this \yii\web\View */
/* @var $content string */

$secondarySidebar = '';
$mainSidebar = '';
$securityTopper = '';


LabcoatAsset::register($this);

Yii::$app->params['labcoat']['LabcoatSiteHeader']['logoPath'] = Yii::$app->assetManager->getPublishedUrl('@customvendor/labcoat') . "/images/";

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php print Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<!--
if you need a sidebar, you will need to put the right class(es) on:
<body class="main-sidebar secondary-sidebar">
 -->
 <?php
 	// various possible body classes, depending on what we have for this view/page
 	if (!empty(Yii::$app->params['labcoat']['LabcoatSecondarySidebar'])){
 		$secondarySidebar = " secondary-sidebar";
 	}
 	if (!empty(Yii::$app->params['labcoat']['LabcoatPrimarySidebar'])){
 		$mainSidebar = " main-sidebar";
 	}
	if (array_key_exists("top",Yii::$app->params['labcoat']['LabcoatSecurityMarkings']) && !empty(Yii::$app->params['labcoat']['LabcoatSecurityMarkings']['top'])){
		$securityTopper = " secure-net";
	}
 ?>
<body class="<?php echo $mainSidebar.$secondarySidebar.$securityTopper ?>">
<?php $this->beginBody();
		echo LabcoatSecurityMarkings::widget([
				'securityMarkings' => Yii::$app->params['labcoat']['LabcoatSecurityMarkings']
				]);

?>

	<div id="main-page-wrapper">
		<?php
		// this is pretty much required... site header
		echo LabcoatSiteHeader::widget([
							'siteHeader' => Yii::$app->params['labcoat']['LabcoatSiteHeader'],
							]);

		// spit out the leftmost sidebar...
		// if LabcoatPrimarySidebar array is empty, this will return nada.
		echo LabcoatPrimarySidebar::widget([
						'primarySidebar' =>Yii::$app->params['labcoat']['LabcoatPrimarySidebar'],
						]);
		?>
		<div id="content-wrapper" class="main<?php echo $mainSidebar.$secondarySidebar?>">

		<?php
		// spit out the yet-as-unwritten page header widget here...


		// if array is empty, this will return nada.
		echo LabcoatSecondarySidebar::widget([
						'secondarySidebar' => Yii::$app->params['labcoat']['LabcoatSecondarySidebar'],
						]);
		?>
			<div id="main-content-wrapper">
				<div id="main-content">

					<?php print $content ?>

				</div>
			</div> <!-- end of main-content-wrapper -->
		</div> <!-- end of content-wrapper -->
	</div> <!-- end of main-page-wrapper -->
	<div id ="footer-spacer">&nbsp;</div>
	<?php
		if (!empty(Yii::$app->params['labcoat']['LabcoatSecurityMarkings'])){
			// if we have a topper, we need a bottom one, so set bottom to be like the top with content AND color
			if (array_key_exists("top",Yii::$app->params['labcoat']['LabcoatSecurityMarkings']) && !empty(Yii::$app->params['labcoat']['LabcoatSecurityMarkings']['top'])){
				// set up the bottom marker's arguments... overwrite any that are present.
				Yii::$app->params['labcoat']['LabcoatSecurityMarkings']['bottom'] = ['color' => 'red','content' => Yii::$app->params['labcoat']['LabcoatSecurityMarkings']['top']['content']  ];
				// get rid of the top data so we don't get another top one...
				unset(Yii::$app->params['labcoat']['LabcoatSecurityMarkings']['top']);

				echo LabcoatSecurityMarkings::widget([
						'securityMarkings' => Yii::$app->params['labcoat']['LabcoatSecurityMarkings']
						]);


			}
			// oh, just a straight up regular
			else if (array_key_exists("bottom",Yii::$app->params['labcoat']['LabcoatSecurityMarkings']) && !empty(Yii::$app->params['labcoat']['LabcoatSecurityMarkings']['bottom'])){
				echo LabcoatSecurityMarkings::widget([
					'securityMarkings' => Yii::$app->params['labcoat']['LabcoatSecurityMarkings']
					]);
			}
		}
	?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
