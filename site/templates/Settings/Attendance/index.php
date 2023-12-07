<div id="steps-container" class="col-lg-8 sidebar-content component" cp-name="steps">
	<div class="sidebar-content__wrapper">
		<div class="container dashboard-content">
    		<div class="content-body">
    			<div class="box steps_block <?php if (($user['profile']['completed_profile']) && (!$this->request->getQuery('step'))) {?> hidden <?php } ?>">
    					<?php $this->Form->create(); ?>
	            		<!------------>
	            		<?php echo $this->element('attendance/steps-control');?>
	            		<!------------>
	            		<?php echo $this->element('attendance/start');?>
	            		<!------------>
	            		<?php echo $this->element('attendance/step-1');?>
	            		<!------------>
	            		<?php echo $this->element('attendance/step-2');?>
			            <!------------>
			            <?php echo $this->element('attendance/step-3');?>
	            		<!------------>
	            		<?php echo $this->element('attendance/step-4');?>
	            		<!------------>
	            		<?php echo $this->element('attendance/step-5');?>
	            		<!------------>
	            		<?php echo $this->element('attendance/step-6');?>
	            		<!------------>
	            		<?php echo $this->element('attendance/step-7');?>
	            		<!------------>
	            		<?php echo $this->element('attendance/step-8');?>
	            		<!------------>
		            	<?= $this->Form->end() ?>

		            <div class="step-buttons desktop">
	        			<button class="btn btn-bold step_button-prev">VOLTAR</button>
	            		<button class="btn btn-bold btn-primary step_button-next">PRÓXIMO</button>
	            		<span style="display: none;"><?= $this->Form->button(__('Submit')) ?></span>
	        		</div>
		        </div>

		        <div class="steps-completed <?php if ((!$user['profile']['completed_profile']) && (!$this->request->getQuery('step'))) {?> hidden <?php } ?>">
		        	<?php echo $this->element('attendance/completed');?>
		        </div>
            </div>
        </div>
    </div>
</div>