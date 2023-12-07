<?php use Cake\Utility\Hash; ?>
<div class="content-header">
	<div class="clients__header component" cp-name="customPopover">
		<h4>Supervisão Técnica</h4>
		<form action="" class="clients__header-filter filterSearch">
			<div class="row">
				<div class="col">
					<div class="form-outline">
						<input type="text" name="search" placeholder="Pesquisa..." class="inputFilterSearch <?=$param['search']!=''?'open':''?>" value="<?=$param['search']?>">
						<a class="clients__header-filter__search" href="#">
							<span class="material-icons">search</span>
						</a>
					</div>
				</div>
				<div class="col">
					<div class="form-outline">
						<select name="order" id="order">
							<!-- <option selected="">Mais recentes</option> -->
							<option <?=$param['order']==""?'selected':''?> value="" disabled>Classificar por</option>
							<option <?=$param['order']=="name"?'selected':''?> value="name">Nome: A a Z</option>
							<option <?=$param['order']=="name-desc"?'selected':''?> value="name-desc">Nome: Z a A</option>
							<option <?=$param['order']=="date"?'selected':''?> value="date">Mais recentes</option>
							<option <?=$param['order']=="date-desc"?'selected':''?> value="date-desc">Mais antigos</option>						
						</select>
					</div>
				</div>
				<div class="col">
					<div class="form-outline">
						<select name="active" id="select3">
							<!-- <option selected="">Clientes ativos</option> -->
							<option <?=$param['active']==""?'selected':''?> value="" disabled>Filtrar por</option>
							<option <?=$param['active']=="week"?'selected':''?> value="week">Última semana</option>
							<option <?=$param['active']=="month"?'selected':''?> value="month">Último mês</option>
							<option <?=$param['active']=="year"?'selected':''?> value="year">Último ano</option>
							<option <?=$param['active']=="y"?'selected':''?> value="y">Clientes ativos</option>
							<option <?=$param['active']=="n"?'selected':''?> value="n">Clientes inativos</option>							
						</select>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="content-body component" cp-name="clients">
	<div class="row">
		<div id="clientsIndex" class="col">
		<?php foreach ($clients as $key => $client) : ?>
				<div class="box">
					<div class="client">
						<a href="<?=$this->Url->build(['controller'=>'Clients','action'=>'view',$client->patient_id, 'prefix'=>'Dashboard']);?>">
							<img src="<?=$client->patient->profile->photo?>">
						</a>
						<div class="info">
							<a href="<?=$this->Url->build(['controller'=>'Clients','action'=>'view',$client->patient_id, 'prefix'=>'Dashboard']);?>">
								<p class="bold"><?=$client->patient->name?></p>
								<p><?=$genders[$client->patient->profile->gender]?> <i class="dot"></i> <?=$pronouns[$client->patient->profile->pronoun]?> <i class="dot"></i> <?=$client->patient->profile->age?></p>
							</a>
							<p class="mb-0">
								<?php 
									$totalProblems = count($client->patient->problems);
									if ($totalProblems>0) :
										for ($i=0; $i < 3 ; $i++) : 
											echo (isset($client->patient->problems[$i]->name)) ? '<span class="speciality_tag records">'.$client->patient->problems[$i]->name.'</span>' : null;
										endfor;
										if ($totalProblems>2) : 
											echo '<span class="more bold">Ver mais</span>';
											echo '<span class="info_oculta d-none">';
											for ($i=3; $i < $totalProblems ; $i++) : 
												echo '<span class="speciality_tag records">'.$client->patient->problems[$i]->name.'</span>';
											endfor;
											echo '<span class="less bold">Ver menos</span>';
											echo '</span>';
										endif;
									endif; 
								?>
							</p>
						</div>
					</div>
					<div class="next_therapy">
						<p class="mb-0 bold">Próxima terapia</p>
						<?php if ($client->patient->appointments_received[0]) { ?>
							<p class="mb-0"><?=ucfirst($client->patient->appointments_received[0]->day_complet).' - '.$client->patient->appointments_received[0]->hour_complet?></p>
						<?php } ?>
					</div>
					<div class="contacts">
						<?php if ($client->status==2) : ?>
							<span class="material-icons"
								rel="popover"
								data-text-align="left"
								data-anchor-close="true"
								data-target="popover-phones">
								phone
							</span>
							<div class="d-none">
								<div class="custom-popover__content" id="popover-phones">
									<ul class="list--clean-style content-popover-phones">
										<li><a data-id="1" class="body1 popover__anchor" href="#">Contato Pessoal</a></li>
										<li><a data-id="2" class="body1 popover__anchor" href="#">Contato Emergencial</a></li>
									</ul>
								</div>
							</div>
							<a href="#"><span class="material-icons">chat_bubble_outline</span></a>
							<span class="material-icons"
								rel="popover"
								data-text-align="left"
								data-callback-function="clients.openModal"
								data-anchor-close="true"
								data-target="popover-more_vert_<?=$key?>">
								more_vert
							</span>
							<div class="d-none">
								<div class="custom-popover__content" id="popover-more_vert_<?=$key?>">
									<ul class="list--clean-style content-popover-more_vert_<?=$key?>">
										<li><a data-open-id-modal="#reportPatientModal" data-name="<?=$client->patient->name?>" class="body1 popover__anchor" href="#">Denunciar cliente</a></li>
										<li><a data-open-id-modal="#closeTherapyModal" data-name="<?=$client->patient->name?>" class="body1 popover__anchor" href="#">Encerrar terapia</a></li>
									</ul>
								</div>
							</div>
						<?php endif;?>
					</div>
				</div>
			<?php endforeach;?>
		</div>
	</div>
</div>

<?php echo $this->element('clients/modals', [
	'data'=>[
		'complaintItems'=>$complaintItems
	]

]);?>