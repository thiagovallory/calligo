<div class="step step-agenda" data-step="7">
	<div class="step-agenda_header">
		<p class="subtitle1 bold mobile">Escolha os horários de atendimento</p>
		<div class="row">
			<div class="col-7">
				<p class="subtitle1 bold desktop">Escolha os horários de atendimento</p>
			</div>
			<div class="col-2">
				<!-- <div class="form-outline">
		            <select class="form-select active" name="" id="">
		                <option></option>
		                <option value="1" selected>Semanalmente</option>
		            </select>
		            <label for="" class="form-label body1" for="select1">Organização de agenda</label>
		        </div> -->
			</div>
			<div class="col-3 text-end">
				<!-- <div class="form-outline agenda_fuso-horario">
		            <select class="form-select active" name="" id="">
		                <option></option>
		                <option value="1" selected>GMT-3 Brasília</option>
		            </select>
		            <label for="" class="form-label body1" for="select1">Fuso horário</label>
		        </div> -->
		        <div class="configuracoes_agenda">
					<?= $this->Html->image('configuracoes.png');?>

					<div class="configuracoes_agenda-container">
						<h5>Horários</h5>

						<div class="row">
							<div class="col-12">
								<p class="duration-title">Duração da sessão</p>
								<p class="duration-time">50 MIN</p>
							</div>
						</div>

						<div class="row">
							<div class="col-12 align-items-start">
								<p class="duration-title">Intervalo entre sessões</p>
								<p class="duration-time">10 MIN</p>
							</div>
						</div>
					</div>						
				</div>
				<br class="mobile">
			</div>
		</div>
	</div>
	

	<div class="table_header">
		<table>
			<thead>
				<tr>
					<th class="th_tab_days active" data-target="1">
						<p class="bold desktop">Segunda</p>
						<p class="bold mobile">S</p>
					</th>
					<th class="th_tab_days" data-target="2">
						<p class="bold desktop">Terça</p>
						<p class="bold mobile">T</p>
					</th>
					<th class="th_tab_days" data-target="3">
						<p class="bold desktop">Quarta</p>
						<p class="bold mobile">Q</p>
					</th>
					<th class="th_tab_days" data-target="4">
						<p class="bold desktop">Quinta</p>
						<p class="bold mobile">Q</p>
					</th>
					<th class="th_tab_days" data-target="5">
						<p class="bold desktop">Sexta</p>
						<p class="bold mobile">S</p>
					</th>
					<th class="th_tab_days" data-target="6">
						<p class="bold desktop">Sábado</p>
						<p class="bold mobile">S</p>
					</th>
					<th class="th_tab_days" data-target="7">
						<p class="bold desktop">Domingo</p>
						<p class="bold mobile">D</p>
					</th>
				</tr>
			</thead>
		</table>
	</div>
	<div class="table_agenda-days">
		<form id="form_config-agenda">
			<div class="row align-items-start">
				<div class="col-12 col-sm td_column_days active" data-target="1">
					<ul>
						<?php foreach ($schedule_settings[0] as $key => $obj) : ?>
							<li class="agenda_input-list">
								<input class="agenda_input-hour get_agenda_input-hour" type="text" placeholder="00:00" data-day="0" value="<?= $obj->hour;?>"><span class="alert"></span>
							</li>
						<?php endforeach;?>
						<li class="agenda_add-hour text-center" data-day="0">
							<span class="material-icons-outlined">add</span>
						</li>
					</ul>
				</div>
				<div class="col-12 col-sm td_column_days" data-target="2">
					<ul>
						<?php foreach ($schedule_settings[1] as $key => $obj) : ?>
							<li class="agenda_input-list">
								<input class="agenda_input-hour get_agenda_input-hour" type="text" placeholder="00:00" data-day="1" value="<?= $obj->hour;?>"><span class="alert"></span>
							</li>
						<?php endforeach;?>
						<li class="agenda_add-hour text-center" data-day="1">
							<span class="material-icons-outlined">add</span>
						</li>
					</ul>
				</div>
				<div class="col-12 col-sm td_column_days" data-target="3">
					<ul>
						<?php foreach ($schedule_settings[2] as $key => $obj) : ?>
							<li class="agenda_input-list">
								<input class="agenda_input-hour get_agenda_input-hour" type="text" placeholder="00:00" data-day="2" value="<?= $obj->hour;?>"><span class="alert"></span>
							</li>
						<?php endforeach;?>
						<li class="agenda_add-hour text-center" data-day="2">
							<span class="material-icons-outlined">add</span>
						</li>
					</ul>
				</div>
				<div class="col-12 col-sm td_column_days" data-target="4">
					<ul>
						<?php foreach ($schedule_settings[3] as $key => $obj) : ?>
							<li class="agenda_input-list">
								<input class="agenda_input-hour get_agenda_input-hour" type="text" placeholder="00:00" data-day="3" value="<?= $obj->hour;?>"><span class="alert"></span>
							</li>
						<?php endforeach;?>
						<li class="agenda_add-hour text-center" data-day="3">
							<span class="material-icons-outlined">add</span>
						</li>
					</ul>
				</div>
				<div class="col-12 col-sm td_column_days" data-target="5">
					<ul>
						<?php foreach ($schedule_settings[4] as $key => $obj) : ?>
							<li class="agenda_input-list">
								<input class="agenda_input-hour get_agenda_input-hour" type="text" placeholder="00:00" data-day="4" value="<?= $obj->hour;?>"><span class="alert"></span>
							</li>
						<?php endforeach;?>
						<li class="agenda_add-hour text-center" data-day="4">
							<span class="material-icons-outlined">add</span>
						</li>
					</ul>
				</div>
				<div class="col-12 col-sm td_column_days" data-target="6">
					<ul>
						<?php foreach ($schedule_settings[5] as $key => $obj) : ?>
							<li class="agenda_input-list">
								<input class="agenda_input-hour get_agenda_input-hour" type="text" placeholder="00:00" data-day="5" value="<?= $obj->hour;?>"><span class="alert"></span>
							</li>
						<?php endforeach;?>
						<li class="agenda_add-hour text-center" data-day="5">
							<span class="material-icons-outlined">add</span>
						</li>
					</ul>
				</div>
				<div class="col-12 col-sm td_column_days" data-target="7">
					<ul>
						<?php foreach ($schedule_settings[6] as $key => $obj) : ?>
							<li class="agenda_input-list">
								<input class="agenda_input-hour get_agenda_input-hour" type="text" placeholder="00:00" data-day="6" value="<?= $obj->hour;?>"><span class="alert"></span>
							</li>
						<?php endforeach;?>
						<li class="agenda_add-hour text-center" data-day="6">
							<span class="material-icons-outlined">add</span>
						</li>
					</ul>
				</div>
			</div>
		</form>
	</div>

	<div class="step-buttons mobile">
        <button class="btn btn-bold step_button-prev">VOLTAR</button>
        <button class="btn btn-bold btn-primary step_button-next">PRÓXIMO</button>
        <span style="display: none;"><?= $this->Form->button(__('Submit')) ?></span>
    </div>
</div>