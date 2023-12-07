<div class="step step_form" data-step="7">
	<h5 class="modalities-value-title">Escolha uma foto</h5>
	<div class="step-image-container">
		<?= $this->Html->image($user['profile']['photo'],['class'=>'step-image_placeholder']);?>
		<form id="image_upload" enctype="multipart/form-data">
			<input id="image_field" name="attachment" class="step-image_upload" type="file" accept="image/*"> <button class="btn btn-bold">REMOVER</button>
		</form>
	</div>
</div>