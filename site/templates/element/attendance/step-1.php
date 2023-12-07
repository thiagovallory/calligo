<div class="step step_form" data-step="1"> 
    <h5>Fale um pouco sobre você *</h5>
    <textarea id="user_about" class="step-textarea" name="profile[description]" placeholder="Fale sobre sua experiência, sua forma de atendimento e etc."><?php echo $user['profile']['description'];?></textarea>

    <div class="input-container" style="width: 100%;">
        <h5>Quais são suas especialidades *</h5>

        <div class="multiple_select-container">
            <select id="specialities_select" class="step-select multiple_select" data-name="specialties[_ids][]" multiple="multiple" multiple="multiple" data-placeholder="Ex: Terapia Cognitiva, Psicanálise...">
            	<?php 
            		foreach ($specialties as $key => $obj) {
            			$selected = ($obj['selected']) ? 'selected' : null;
            			echo '<option value="'.$obj['id'].'" '.$selected.'>'.$obj['name'].'</option>';
            		}
            	?>
            </select>
        </div>
    </div>
    <br>
    <div class="step-buttons mobile">
        <button class="btn btn-bold step_button-prev">VOLTAR</button>
        <button class="btn btn-bold btn-primary step_button-next">PRÓXIMO</button>
        <span style="display: none;"><?= $this->Form->button(__('Submit')) ?></span>
    </div>
</div>

