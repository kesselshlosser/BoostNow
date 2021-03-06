<?php
	use yii\widgets\DetailView;
	use yii\helpers\Url;

	$this->title = $model->name . ' - Category';
	$this->params['tab'] = 'categories';
	$this->params['breadcrumbs'][] = ['label' => 'Browse Categories', 'url' => Url::to([Yii::$app->params['adminAbsUrl'] . 'categories'])];
	$this->params['breadcrumbs'][] = $model->name;
?>

<?php $this->beginBlock('links'); ?>
	<li><a href="<?= Url::to([Yii::$app->params['adminAbsUrl'] . 'categories']); ?>" class="btn bg-purple btn-flat"> Go Back</a></li>
<?php $this->endBlock(); ?>

<style type="text/css">
	table.detail-view th {width: 150px;}
</style>

<?php
	echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'name',
			'description',
			'keywords',
			'detail',
			'parentCategory.name',
			'admin.username',
			[
                'attribute' => 'created_at',
                'value' => function($model) {
                    return date('M d, Y h:i:s A', strtotime($model->created_at));
                }
            ],
			[
                'attribute' => 'updated_at',
                'value' => function($model) {
                    return date('M d, Y h:i:s A', strtotime($model->updated_at));
                }
            ],
		],
	]);
?>