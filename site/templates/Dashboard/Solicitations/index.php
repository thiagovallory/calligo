<?php use Cake\Utility\Hash; ?>
<div class="content-header">
	<h4>Solicitações de terapia</h4> 
	<!--
	<div class="controls">
		<?= $this->Form->button(__('Salvar'),array('class'=>'btn btn-primary btn-bold')) ?>
	</div>
	-->
</div> 
<div class="content-body">
	<?php 
		foreach ($appointments as $key => $obj) {
			echo '<p>';
			echo '['.$obj->day.'] '.$obj->patient->name;
			echo ' ('.implode(' ', Hash::extract($obj->patient->problems, '{n}.name')).')';
			echo ' <a href="'.$this->Url->build(['action'=>'status', $obj->id, 4]).'">Aprovar</a>';
			echo ' <a href="'.$this->Url->build(['action'=>'status', $obj->id, 6]).'">Reprovar</a>';
			echo '</p>';
		}
	?>
</div>

