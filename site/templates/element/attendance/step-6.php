<div class="step step_form" data-step="6">
	<h5 class="modalities-value-title no-margin">Adicione o link de acesso para o seu vídeo! <span>(não obrigatório)</span></h5>
	<div class="step-image-container">
		<br><br>
		
		<label for="link_video" class="main-label">Insira uma URL</label><br>
		<input placeholder="https://exemplo.com" type="text" class="main-input" id="link_video" name="link_video"><br>
		<span class="input_infoholder">Cole um link do youtube ou vimeo</span>

		<br><br>
		<div class="form-check">
			<input class="form-check-input" type="checkbox" name="uncheckedRadio" id="video_alert-checkbox">
			<label for="video_alert-checkbox" class="form-check-label body1 video_alert-message">
				Estou ciente que todas informações presentes aqui são de minha responsabilidade
			</label>
		</div>
	</div>

	<div class="step-buttons mobile">
        <button class="btn btn-bold step_button-prev">VOLTAR</button>
        <button class="btn btn-bold btn-primary step_button-next">PRÓXIMO</button>
        <span style="display: none;"><?= $this->Form->button(__('Submit')) ?></span>
    </div>
</div>