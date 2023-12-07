<div class="step step_form" data-step="2">
	<form id="form_step2" enctype="multipart/form-data">
		<div class="tempo_container">
			<h5>Informe o seu tempo de experiência</h5>
			<input id="tempo_experiencia" name="time_work_experience" type="number" value="<?= $user['profile']['time_work_experience'];?>">
			<span>anos</span>
		</div>
		<?php if ($user['academic_backgrounds']) : ?>
			<?php foreach ($user['academic_backgrounds'] as $key => $obj) :?>
				<div class="form_adder" data-key="<?= $key;?>">
					
					<h5>Informe a sua formação</h5>
					<div class="form_container">
						
			        	<input class="experience_ids" type="hidden" name="academic_backgrounds[<?php echo $key;?>][id]" value="<?= $obj['id'];?>"></input>
			        	
			        	<div class="input-container" style="width: 15%;">
				        	<label>Tipo</label>
			                <select class="academic_type" name="academic_backgrounds[<?php echo $key;?>][type]" required>
			                	<option>Selecione</option>
			                	<?php foreach ($academic_backgrounds_types as $keyABT=> $objABT) {
			                		$selected = ($obj['type']==$keyABT) ? 'selected' : null;
			                		echo '<option value="'.$keyABT.'" '.$selected.'>'.$objABT.'</option>';
			                	}?>
			                </select>
		                </div>

			            <div class="input-container" style="width: 25%;">
			            	<label>Curso</label>
			            	<input class="user_course" name="academic_backgrounds[<?= $key;?>][class_name]" value="<?= $obj['class_name'];?>" required></input>
			            </div>

			            <div class="input-container" style="width: 50%;">
			            	<label>Instituição</label>
			            	<input class="user_institution" name="academic_backgrounds[<?= $key;?>][institution]" value="<?= $obj['institution'];?>" required></input>
			            </div>

			            <div class="input-container" style="width: 18%;">
			            	<label class="desktop">Inicio</label>
			            	<label class="mobile">Período</label>
			            	<input class="user_academic_start" type="date" name="academic_backgrounds[<?= $key;?>][period_start]" value="<?= $obj['period_start_formated'];?>" required></input>
			            </div>
			            <span class="btw_dates">até</span>
			            <div class="input-container" style="width: 18%;">
			            	<label class="desktop">Fim</label>
			            	<input class="user_academic_end" type="date" name="academic_backgrounds[<?= $key;?>][period_end]" value="<?= $obj['period_end_formated'];?>" required></input>
			            </div>

			            <div class="input-container" style="width: 20%;">
				            <label>Status</label>
			                <select class="user_academic_status" name="academic_backgrounds[<?= $key;?>][status]" required>
			                	<option>Selecione</option>
			                	<?php foreach ($academic_backgrounds_status as $keyABS => $objABS) {
			                		$selected = ($obj['status']==$keyABS) ? 'selected' : null;
			                		echo '<option value="'.$keyABS.'" '.$selected.'>'.$objABS.'</option>';
			                	}?>
			                </select>
			            </div>
			        </div>
			    </div>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="form_adder" data-key="0">
				<h5>Informe a sua formação</h5>
				<div class="form_container">
					
		        	<input class="experience_ids" type="hidden" name="academic_backgrounds[0][id]" value="0"></input>
		        	
		        	<div class="input-container" style="width: 15%;">	
		        		<label>Tipo</label>
		                <select class="academic_type" name="academic_backgrounds[0][type]" required>
		                	<option>Selecione</option>
		                	<?php foreach ($academic_backgrounds_types as $key => $obj) {
		                			echo '<option value="'.$key.'">'.$obj.'</option>';
		                	}?>
		                </select>
		            </div>

		            <div class="input-container" style="width: 25%;">
		            	<label>Curso</label>
		            	<input class="user_course" name="academic_backgrounds[0][class_name]" required></input>
		            </div>

		            <div class="input-container" style="width: 50%;">
		            	<label>Instituição</label>
		            	<input class="user_institution" name="academic_backgrounds[0][institution]" required></input>
		            </div>

		            <div class="input-container" style="width: 18%;">
		            	<label class="desktop">Inicio</label>
			            <label class="mobile">Período</label>

		            	<input class="user_academic_start" type="date" name="academic_backgrounds[0][period_start]" required></input>
		            </div>
		            <span class="btw_dates">até</span>
		            <div class="input-container" style="width: 18%;">
		            	<label class="desktop">Fim</label>
		            	<input class="user_academic_end" type="date" name="academic_backgrounds[0][period_end]" required></input>
		            </div>

		            <div class="input-container" style="width: 20%;">
		            	<label>Status</label>
		                <select class="user_academic_status" name="academic_backgrounds[0][status]" required>
		                	<option>Selecione</option>
		                	<?php foreach ($academic_backgrounds_status as $key => $obj) {
		                			echo '<option value="'.$key.'">'.$obj.'</option>';
		                	}?>
		                </select>
		            </div>
		        </div>
		    </div>
		<?php endif;?>
	</form>

	<button class="btn btn-bold add_rmv_form add_form"><img src="/img/add.png">ADICIONAR</button>
	<button class="btn btn-bold add_rmv_form remove_form"><img src="/img/subtract.png">REMOVER</button>

	<div class="step-buttons mobile">
        <button class="btn btn-bold step_button-prev">VOLTAR</button>
        <button class="btn btn-bold btn-primary step_button-next">PRÓXIMO</button>
        <span style="display: none;"><?= $this->Form->button(__('Submit')) ?></span>
    </div>
</div>