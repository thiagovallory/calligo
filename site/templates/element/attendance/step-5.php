<div class="step step_form" data-step="5">
	<h5 class="modalities-value-title">Informe os valores das modalidades de terapia</h5>
	<form id="form_service" enctype="multipart/form-data">
		<div class="row">
			<?php 
	        foreach ($modalities as $key => $obj) {
		            echo '<div class="col-12 col-sm-4">
							<div class="modalities-container" data-type-service="type_of_service_'.$obj['id'].'" data-form-service="form_service_'.$obj['id'].'">
								<p class="modalities-title">'.$obj['name'].'</p>
								<input type="hidden" name="costs['.$key.'][modality_id]" value="'.$obj['id'].'">
								<div class="row align-items-start no-gutter modalities-regular">
									<div class="col-6 align-self-start">Sessão Regular</div>
									<div class="col-6 modalities-value_container">
										<span class="input-modalities_label">R$</span>
										<input data-id="'.$obj['id'].'" name="costs['.$key.'][value_full]" class="input-modalities-value" type="text" placeholder="0,00" value="'.$obj['value_full'].'">
									</div>
								</div>
							</div>
						</div>';
		        }
		    ?>
		</div>
	</form>

	<div class="step-buttons mobile">
        <button class="btn btn-bold step_button-prev">VOLTAR</button>
        <button class="btn btn-bold btn-primary step_button-next">PRÓXIMO</button>
        <span style="display: none;"><?= $this->Form->button(__('Submit')) ?></span>
    </div>
</div>