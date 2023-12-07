<div class="step step_form" data-step="4">    
    <h5>Quais as formas de atendimento?</h5>
    
    <?php
    	$type_of_service_Video_checked = null;
    	$type_of_service_Audio_checked = null;

    	if ((isset($user['profile']['attendance_by_video_call'])) && ($user['profile']['attendance_by_video_call']==1)){
    		$type_of_service_Video_checked = 'checked';
    	}

    	if ((isset($user['profile']['attendance_by_phone_call'])) && ($user['profile']['attendance_by_phone_call']==1)){
    		$type_of_service_Audio_checked = 'checked';
    	}
    ?>
    
    <input id="type_of_service_video" type="checkbox" class="form-check-input" name="type_of_service_video" <?= $type_of_service_Video_checked;?>>
    <label class="form-check-label" for="type_of_service_video">Vídeo</label>

    <input id="type_of_service_audio" type="checkbox" class="form-check-input" name="type_of_service_audio" <?= $type_of_service_Audio_checked;?>>
    <label class="form-check-label" for="type_of_service_audio">Áudio</label>

    <br><br><br>
    <div class="input-container" style="width: 100%;">
        <h5>Quais as modalidades de terapia?</h5>

    <?php 
        foreach ($modalities as $key => $obj) {
            $selected = ($obj['selected']) ? 'checked' : null;
            echo '<div class="checkbox_inform"><input type="checkbox" class="form-check-input" id="type_of_service_'.$obj['id'].'" name="type_of_service_'.$obj['id'].'" value="'.$obj['id'].'" '.$selected.'> <label class="form-check-label" for="type_of_service_'.$obj['id'].'">'.$obj['name'].'</label></div>';
        }
    ?>
        <!-- <div class="multiple_select-container">
            <select name="modalities[_ids][]" multiple="multiple" class="step-select multiple_select" data-placeholder="Ex: Terapia de alcance, casal, individual...">
                
            </select>
        </div> -->
    </div>
    <br><br>
    <div class="input-container" style="width: 100%;">
        <h5>Quais faixas etárias você atende? *</h5>

        <div class="multiple_select-container">
            <select id="attended_ages" name="ages[_ids][]" multiple="multiple" class="step-select multiple_select" data-placeholder="Ex: Crianças de 0 a 6 anos, adultos...">
                <?php 
                    foreach ($ages as $key => $obj) {
                        $selected = ($obj['selected']) ? 'selected' : null;
                        echo '<option value="'.$obj['id'].'" '.$selected.'>'.$obj['name'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>

    <div class="input-container" style="width: 100%;">
        <h5>Quais idiomas você domina? *</h5>

        <div class="multiple_select-container">
            <select id="attended_languages" name="langs[_ids][]" multiple="multiple" class="step-select multiple_select" data-placeholder="Ex: Português, inglês...">
            	<?php 
            		foreach ($langs as $key => $obj) {
            			$selected = ($obj['selected']) ? 'selected' : null;
            			echo '<option value="'.$obj['id'].'" '.$selected.'>'.$obj['name'].'</option>';
            		}
            	?>
            </select>
        </div>
    </div>

    <div class="step-buttons mobile">
        <button class="btn btn-bold step_button-prev">VOLTAR</button>
        <button class="btn btn-bold btn-primary step_button-next">PRÓXIMO</button>
        <span style="display: none;"><?= $this->Form->button(__('Submit')) ?></span>
    </div>
</div>