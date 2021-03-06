<?php
	use yii\helpers\Url;
	use yii\bootstrap\Html;
	use yii\bootstrap\Modal;
	use yii\widgets\LinkPager;
	use yii\bootstrap\ActiveForm;

	$this->title = 'Browse Pages';
	$this->params['tab'] = 'page';
	$this->params['breadcrumbs'][] = $this->title;
?>

	<?php $this->beginBlock('links'); ?>
		<li><a href="<?= Url::to([Yii::$app->params['adminAbsUrl'] . 'page/add']); ?>" class="btn bg-purple btn-flat"> Add Page</a></li>
	<?php $this->endBlock(); ?>

	<div class="">
		<?php
			$form = ActiveForm::begin([
				'method' => 'get',
				'action' => Url::to([Yii::$app->params['adminAbsUrl'] . 'page'])
			]);
		?>

			<div class="form-group col-xs-12 col-sm-4">
				<?php echo $form->field($searchModel, 'title'); ?>
			</div>

			<div class="form-group col-xs-12 col-sm-4">
				<?php echo $form->field($searchModel, 'page_title'); ?>
			</div>

			<div class="form-group col-xs-12 col-sm-4">
				<?php 
					$items = [
						'no' => 'No', 
						'yes' => 'Yes'
					]
				?>
				<?php echo $form->field($searchModel, 'draft')->radioList($items, [
                    'item' => function($index, $label, $name, $checked, $value) {
                    	$checkedString = '';
                    	if ($checked) {
                    		$checkedString = 'checked';
                    	}
                        $return = '<label class="radio-inline">';
                        $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" ' . $checkedString . '>';
                        $return .= '<span>' . $label . '</span>';
                        $return .= '</label>';
                        return $return;
                    }
                ]); ?>
			</div>
			<div class="clearfix"></div>

			<div class="col-xs-12" style="margin-bottom: 10px;">
				<?= Html::submitButton('Search', ['class' => 'button btn btn-primary btn-large']) ?>
			</div>

		<?php 
			ActiveForm::end();
		?>

		<table class="table table-responsive">
			<tr>
				<th>#</th>
				<th>Title</th>
				<th>SEO URL</th>
				<th>Draft</th>
				<th>Section</th>
				<th>Updated At</th>
				<th>Options</th>
			</tr>
			<?php
				if ($model) {
					$counter = 1;
					foreach ($model as $row) {
			?>
			<tr>
				<td><?php echo $counter++; ?></td>
				<td><?php echo $row->title; ?></td>
				<td><?php echo $row->seo_url; ?></td>
				<td><?php echo ucfirst($row->draft); ?></td>
				<td><?php echo ucwords(str_replace('-', ' ', $row->section)); ?></td>
				<td>
					<?php
						echo $row->updated_at;
					?>
				</td>
				<td>
					<a href="<?= Url::to([Yii::$app->params['adminAbsUrl'] . 'page/view/' . $row->id]); ?>" class="btn btn-primary btn-xs glyphicon glyphicon-eye-open"></a>
					<a href="<?= Url::to([Yii::$app->params['adminAbsUrl'] . 'page/update/' . $row->id]); ?>" class="btn btn-info btn-xs glyphicon glyphicon-pencil"></a>
					<a data-toggle="modal" data-target="#modal" class="btn btn-danger btn-xs glyphicon glyphicon-trash delete-modal" data-id="<?= $row->id ?>" data-name="<?= $row->title ?>"></a>
				</td>
			</tr>
			<?php
					}
				} else {
			?>
			<tr>
				<td colspan="7" class="text-center">No Record Found!</td>
			</tr>
			<?php
				}
			?>
		</table>

		<div class="pagination">
		<?php
			echo LinkPager::widget([
				'pagination' => $pages,
			]);
		?>
		</div>
	</div>
	
	<?php
		$url = Url::to([Yii::$app->params['adminAbsUrl'] . 'page/delete']);
		Modal::begin([
			'header' => '<h4 class="modal-title"></h4>',
			'id'     => 'deleteModal',
			'footer' => Html::a('Confirm', '', ['class' => 'btn btn-danger', 'id' => 'delete-confirm']),
		]);
	?>

	<?= 'Are you sure you want to perform this action?'; ?>

	<?php Modal::end(); ?>

	<?php
		$this->registerJs("$(function() {
		   $('.delete-modal').click(function(e) {
				e.preventDefault();
				$('#deleteModal').modal('show');
				var modal = $(this);
				var triggered = $(this);
				var id = triggered.data('id');
				var name = triggered.data('name');
				$('.modal-title').text('Delete Page: \"' + name + '\"');

				$('#delete-confirm').click(function(e) {
					e.preventDefault();
					window.location = '" . $url . "/' + id;
				});
		   });
		});");
	?>