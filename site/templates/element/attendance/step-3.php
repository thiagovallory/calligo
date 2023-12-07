<div class="step step_form" data-step="3">   
    <div class="input-container" style="width: 100%;"> 
        <h5>Quais problemas você atende? *</h5>
        <div class="multiple_select-container">
            <select id="problem_select" class="step-select multiple_select" name="problems[_ids][]" multiple="multiple" data-placeholder="Ex: Depressão, ansiedade...">
            	<?php 
            		foreach ($problems as $key => $obj) {
            			$selected = ($obj['selected']) ? 'selected' : null;
            			echo '<option value="'.$obj['id'].'" '.$selected.'>'.$obj['name'].'</option>';
            		}
            	?>
            </select>
        </div>
    </div>

    <div class="input-container" style="width: 100%;">
        <h5>Quais abordagens você utiliza? *</h5>
        <div class="multiple_select-container">
            <select id="approach_select" class="step-select multiple_select" name="therapies[_ids][]" multiple="multiple" data-placeholder="Ex: Terapia Cognitiva, Psicanálise...">
            	<?php 
            		foreach ($therapies as $key => $obj) {
            			$selected = ($obj['selected']) ? 'selected' : null;
            			echo '<option value="'.$obj['id'].'" '.$selected.'>'.$obj['name'].'</option>';
            		}
            	?>
            </select>
        </div>
    </div>

    <div class="input-container" style="width: 100%;">
        <h5>Quais métodos você utiliza? <span class="title_obs">(Não obrigatório)</span></h5>
        <div class="multiple_select-container">
            <select id="method_select" class="step-select multiple_select" name="characteristics[_ids][]" multiple="multiple" data-placeholder="Ex: Passa atividades, escuta mais....">
            	<?php 
            		foreach ($characteristics as $key => $obj) {
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