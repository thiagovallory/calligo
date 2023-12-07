<div class="step step_form" data-step="6">
	<h5>Defina a duração das sessões *</h5>
	<br>
	<label class="label_duration" for="">Duração</label><br class="mobile">
	<input id="session_duration" type="number" style="width: 60px;" value="<?= $user['profile']['session_duration'];?>">
	<span>minutos</span>
	<br>
	<br>
	<h5 class="mobile">Defina o intervalo das sessões</h5>
	<label class="label_duration" for="">Intervalo</label><br class="mobile">
	<input id="session_interval" type="number" style="width: 60px;" value="<?= $user['profile']['session_break'];?>">
	<span>minutos</span>
	<div class="step-buttons mobile">
        <button class="btn btn-bold step_button-prev">VOLTAR</button>
        <button class="btn btn-bold btn-primary step_button-next">PRÓXIMO</button>
        <span style="display: none;"><?= $this->Form->button(__('Submit')) ?></span>
    </div>
</div>