<div class="step step-agenda completed" data-step="10">
	<h4 class="align-left desktop">Configurações de atendimento</h4>
	<br class="desktop"><br class="desktop">
	<div class="row">
		<div class="col-12">
			<div class="box">
				<h4>Horários de atendimento</h4>
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
											<input class="agenda_input-hour" type="text" placeholder="00:00" data-day="0" value="<?= $obj->hour;?>" disabled>
										</li>
									<?php endforeach;?>
								</ul>
							</div>
							<div class="col-12 col-sm td_column_days" data-target="2">
								<ul>
									<?php foreach ($schedule_settings[1] as $key => $obj) : ?>
										<li class="agenda_input-list">
											<input class="agenda_input-hour" type="text" placeholder="00:00" data-day="1" value="<?= $obj->hour;?>" disabled>
										</li>
									<?php endforeach;?>
								</ul>
							</div>
							<div class="col-12 col-sm td_column_days" data-target="3">
								<ul>
									<?php foreach ($schedule_settings[2] as $key => $obj) : ?>
										<li class="agenda_input-list">
											<input class="agenda_input-hour" type="text" placeholder="00:00" data-day="2" value="<?= $obj->hour;?>" disabled>
										</li>
									<?php endforeach;?>
								</ul>
							</div>
							<div class="col-12 col-sm td_column_days" data-target="4">
								<ul>
									<?php foreach ($schedule_settings[3] as $key => $obj) : ?>
										<li class="agenda_input-list">
											<input class="agenda_input-hour" type="text" placeholder="00:00" data-day="3" value="<?= $obj->hour;?>" disabled>
										</li>
									<?php endforeach;?>
								</ul>
							</div>
							<div class="col-12 col-sm td_column_days" data-target="5">
								<ul>
									<?php foreach ($schedule_settings[4] as $key => $obj) : ?>
										<li class="agenda_input-list">
											<input class="agenda_input-hour" type="text" placeholder="00:00" data-day="4" value="<?= $obj->hour;?>" disabled>
										</li>
									<?php endforeach;?>
								</ul>
							</div>
							<div class="col-12 col-sm td_column_days" data-target="6">
								<ul>
									<?php foreach ($schedule_settings[5] as $key => $obj) : ?>
										<li class="agenda_input-list">
											<input class="agenda_input-hour" type="text" placeholder="00:00" data-day="5" value="<?= $obj->hour;?>" disabled>
										</li>
									<?php endforeach;?>
								</ul>
							</div>
							<div class="col-12 col-sm td_column_days" data-target="7">
								<ul>
									<?php foreach ($schedule_settings[6] as $key => $obj) : ?>
										<li class="agenda_input-list">
											<input class="agenda_input-hour" type="text" placeholder="00:00" data-day="6" value="<?= $obj->hour;?>" disabled>
										</li>
									<?php endforeach;?>
								</ul>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-12 text-end">
			<?= $this->Html->link('Editar', ['controller' => 'Attendance', 'action' => 'index', '?'=>['step'=>8]], ['class'=>'btn btn-bold btn-primary btn-attendance']);?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-12 col-sm-8">
			<div class="box">
				<div class="row">
					<div class="col col-sm-10"><h4>Perfil</h4></div>
					<div class="col col-sm-2 desktop text-end"><?= $this->Html->link('Editar', ['controller' => 'Attendance', 'action' => 'index', '?'=>['step'=>1]], ['class'=>'btn btn-bold btn-primary']);?></div>
				</div>
				<br>
				<div class="row">
					<div class="col-12 text-center col-sm-4 text-sm-start">
						<?= $this->Html->image($user['profile']['photo'],['class'=>'attc_profile-pic']);?>
					</div>
					<div class="col-12 col-sm-8">
                        <div class="attc_profile-name">
                            <p class="attc_title"><?= $user['name']; ?></p>
                            <?php if ($user['profile']['crp']): ?>
                                <p class="body1">CRP <?= $user['profile']['crp']; ?></p>
                            <?php endif; ?>
                            <?php if ($user['profile']['epsi']): ?>
                                <p class="body1">E-Psi <?= $user['profile']['epsi']; ?></p>
                            <?php endif; ?>
                        </div>
						<div class="attc_description-info">
							<p class="attc_title smaller">Sobre</p>
							<div class="attc_description-container">
								<p><?= $user['profile']['description'];?></p>
							</div>
							<a href="javascript:;" class="attc_description-read-more body1 bold">LER <span class="more">MAIS</span> <span class="minus">MENOS</span><span class="text__primary material-icons-outlined">arrow_back_ios</span></a>
						</div>
						<div class="attc_speciality">
							<p class="attc_title smaller">Especialidades</p>
							<div class="speciality__wrapper">
								<?php foreach ($user['specialties'] as $key => $obj) : ?>
									<div class="speciality_tag"><p><?= $obj['name']; ?></p></div>
								<?php endforeach; ?>
							</div>
						</div>
						<br>
						<div class="attc_attributes">
							<p class="attc_title smaller">Características</p>
							<?php foreach ($user['characteristics'] as $key => $obj) : ?>
								<p><?= $obj['name']; ?></p>
							<?php endforeach; ?>
						</div>
						<br>
						<div class="attc_academic-bg">
							<p class="attc_title smaller">Formação Acadêmica</p>
							<ul>
							<?php foreach ($user['academic_backgrounds'] as $key => $obj) : ?>
								<li class="attc_academic-list">
									<p class="body1 bold"><?= $obj['period_start']->format('Y'); ?> - <?= $obj['period_end']->format('Y'); ?></p>
									<p class='body1'><?= $academic_backgrounds_types[$obj['type']] . ' em ' . $obj['class_name']; ?></p>
								</li>
							<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</div>

				<div class="row mobile mobileFlex">
					<div class="col-12 text-end">
						<?= $this->Html->link('Editar', ['controller' => 'Attendance', 'action' => 'index', '?'=>['step'=>1]], ['class'=>'btn btn-bold btn-primary']);?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-4">
			<div class="box attc_modality-container">
				<div class="row">
					<div class="col-8"><h4>Valores</h4></div>
					<div class="col-4 text-end"><?= $this->Html->link('Editar', ['controller' => 'Attendance', 'action' => 'index', '?'=>['step'=>5]], ['class'=>'btn btn-bold btn-primary']);?></div>
				</div>
				<br class="desktop">
				<br>
				<div class="row">
					<div class="col-12 attc_modality-block">
						<?php foreach ($user['costs'] as $key => $obj) : ?>
							<div class="row align-items-center py-2">
								<div class="col-12 col-sm-4"><p><?= $obj['modality']['name']; ?></p></div>
								<div class="col-8 col-sm-6"><p class="attc_modality-value"><?= 'R$ '.$obj['value_full']; ?></p></div>
								<div class="col-4 col-sm-2"><p class="attc_modality-time text-center"><?= $user['profile']['session_duration'].'min';?></p></div>
							</div>
							<!--<div class="row align-items-center py-2">
								<div class="col-12 col-sm-4"></div>
								<div class="col-8 col-sm-6"><p class="attc_modality-value"><?= 'R$ '.$obj['value_additional']; ?></p></div>
								<div class="col-4 col-sm-2"><p class="attc_modality-time text-center"><?= $user['profile']['session_break'].'min';?></p></div>
							</div>-->
							<br>
						<?php endforeach; ?>
					</div>
				</div>
				<br class="mobile">
				<div class="row mobile mobileFlex">
					<div class="col-12 text-end">
						<?= $this->Html->link('Editar', ['controller' => 'Attendance', 'action' => 'index', '?'=>['step'=>5]], ['class'=>'btn btn-bold btn-primary']);?>
					</div>
				</div>
				<br class="mobile">
				<br class="mobile">
			</div>
		</div>
	</div>
</div>
