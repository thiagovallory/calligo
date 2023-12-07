<!-- Prontuário -->

<div class="content-header">
	<div class="row">
		<div class="client__header">
			<p>
				<?php if ($patient->role==1) : ?>
					<a href="<?=$this->Url->build(['controller'=>'Clients','action'=>'index','prefix'=>'Dashboard']);?>">Clientes</a> <b><span class="material-icons-outlined">arrow_forward_ios</span> <?=$patient->name?></b>
				<?php else : ?>
					<a href="<?=$this->Url->build(['controller'=>'Clients','action'=>'supervision','prefix'=>'Dashboard']);?>">Supervisão Técnica</a> <b><span class="material-icons-outlined">arrow_forward_ios</span> <?=$patient->name?></b>
				<?php endif;?>
			</p>
		</div>
	</div>
</div>
<div class="content-body component" cp-name="clients">
	<div class="row component" cp-name="customPopover">
		<div id="client" class="col-md-8">
			<div class="box">
				<div class="client">
					<?=$this->Html->image($patient->profile->photo, ['alt' => '', 'class'=>[]]);?>
					<div class="info">
						<h4><?=$patient->name?></h4>
						<p><?php if($patient->profile->gender): ?><?=$genders[$patient->profile->gender]?> <i class="dot"></i><?php endif; ?> <?php if($patient->profile->pronoun): ?><?=$pronouns[$patient->profile->pronoun]?> <i class="dot"></i><?php endif; ?> <?=$patient->profile->age?></p>
						<p class="mb-0">
							<?php if ($bondActive && (isset($patient->appointments_received[0]))) { ?>
								<span class="title_info bold">Próxima sessão</span>
								<?=ucfirst($patient->appointments_received[0]->day_complet).' <i class="dot"></i> '.$patient->appointments_received[0]->hour_complet?></p>
							<?php } else { ?>
								<span class="title_info bold">Terapia Encerrada</span>
							<?php } ?>
						</p>
						<p class="mb-0">
							<?php
								$totalProblems = count($patient->problems);
								if ($totalProblems>0) :
									echo '<span class="title_info bold">Motivo(s)</span>';
									for ($i=0; $i < 3 ; $i++) :
										echo (isset($patient->problems[$i]->name)) ? '<span class="speciality_tag records">'.$patient->problems[$i]->name.'</span>' : null;
									endfor;
									if ($totalProblems>2) :
										echo '<span class="more bold">Ver mais</span>';
										echo '<span class="info_oculta d-none">';
										for ($i=3; $i < $totalProblems ; $i++) :
											echo '<span class="speciality_tag records">'.$patient->problems[$i]->name.'</span>';
										endfor;
										echo '<span class="less bold">Ver menos</span>';
										echo '</span>';
									endif;
								endif;
							?>
						</p>
					</div>
					<div class="contacts">
						<?php if ($bondActive) { ?>
							<span class="material-icons"
								rel="popover"
								data-text-align="left"
								data-anchor-close="true"
								data-target="popover-phones">
								phone
							</span>
							<!-- data-callback-function="openModal" -->
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
								data-target="popover-more_vert">
								more_vert
							</span>
							<div class="d-none">
								<div class="custom-popover__content" id="popover-more_vert">
									<ul class="list--clean-style content-popover-more_vert">
										<li><a data-open-id-modal="#reportPatientModal" data-name="<?=$patient->name?>" data-id="<?=$patient->id?>" class="body1 popover__anchor" href="#">Denunciar cliente</a></li>
										<li><a data-open-id-modal="#closeTherapyModal" data-name="<?=$patient->name?>" data-id="<?=$patient->id?>" class="body1 popover__anchor" href="#">Encerrar terapia</a></li>
									</ul>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="box">
				<div class="registers_client">
					<div class="registers_client_header">
						<div class="filters">
							<form action="" class="filterSearch">
								<div class="row">
									<div class="col">
										<div class="form-outline">
											<select class="form-select" name="type" id="type">
												<option <?=$params['type']==""?'selected':''?> value="" disabled>Tipo de registro</option>
												<?php foreach ($typeOfRecords as $key => $type) {
													$selected = ($type->id==$params['type']) ? 'selected' : null;
													echo '<option '.$selected.' value="'.$type->id.'">'.$type->name.'</option>';
												}?>
											</select>
										</div>
									</div>
									<div class="col">
										<div class="form-outline">
											<select class="form-select" name="asc" id="asc">
												<option <?=$params['asc']==""?'selected':''?> value="" disabled>Classificar por</option>
												<option <?=$params['asc']=="desc"?'selected':''?> value="desc">Mais recentes</option>
												<option <?=$params['asc']=="ascxw"?'selected':''?> value="asc">Mais antigos</option>
											</select>
										</div>
									</div>
									<div class="col">
										<div class="form-outline">
											<select class="form-select" name="order_date" id="order_date">
												<option <?=$params['order_date']==""?'selected':''?> value="" disabled>Período</option>
												<option <?=$params['order_date']=="week"?'selected':''?> value="week">Última semana</option>
												<option <?=$params['order_date']=="month"?'selected':''?> value="month">Último mês</option>
												<option <?=$params['order_date']=="year"?'selected':''?> value="year">Último ano</option>
											</select>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="new_reg">
							<?php if ($bondActive) { ?>
								<button type="button" class="clear_form btn btn-primary" data-bs-toggle="modal" data-bs-target="#newRegisterModal">
									<span class="material-icons-outlined">add</span> NOVO REGISTRO
								</button>
							<?php } ?>
						</div>
					</div>
					<div class="br"></div>
					<div class="registers_client_body">
						<div class="row time-line">
							<div class="col">
								<?php
									$prev_date = array(0,0,0);
									foreach ($records as $obj) :
										$showDate = ($prev_date[0]==$obj->created_day&$prev_date[1]==$obj->created_month&$prev_date[2]==$obj->created_year) ? true : false;
									?>
										<div class="time clearfix">
											<div class="date <?=($showDate)?'date_equal':''?>">
												<p class="month bold"><?=$obj->created_month?></p>
												<h3 class="day"><?=$obj->created_day?></h3>
											</div>
											<span class="line"></span>
											<div class="register body1">
												<span class="bold">
													<?=$obj->name?>
													<span class="material-icons pub_priv text__gray70"><?=($obj->private)?'lock':'people'?></span>
												</span>
												<span class="pub_priv text__<?=($obj->description)==''?'gray50':'dark'?>"><?=($obj->description)==''?'Você não adicionou nenhuma informação nesse registro.':$obj->description?></span>
												<?php if ($bondActive&&($obj->name!='Terapia Encerrada')) { ?>
													<a class="modal-start" href="#newRegisterModal" data-edit="<?=$obj->id?>" data-name="<?=$obj->name?>" data-description="<?=$obj->description?>" data-private="<?=$obj->private?>" data-type_of_record_id="<?=$obj->type_of_record_id?>"><span class="add_edit material-icons-outlined text__gray70"><?=($obj->description)==''?'add_box':'edit'?></span></a>
												<?php } ?>
											</div>
										</div>
									<?php
										$prev_date[0] = $obj->created_day;
										$prev_date[1] = $obj->created_month;
										$prev_date[2] = $obj->created_year;
									endforeach;
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="row">
				<div class="adm_notes sidebar_client box">
					<div class="sidebar_client_header">
						<span class="body1 bold">Notas Admnistrativas</span>
						<a class="bold" href="<?= $this->Url->build(['controller'=>'Clients','action'=>'notes',$patient->id, 'prefix'=>'Dashboard']);?>">Ver todas</a>
					</div>
					<div class="sidebar_client_body">
						<?=(isset($lastNote->description)) ? $lastNote->description : null?>
					</div>
					<div class="sidebar_client_footer">
						<?=(isset($lastNote->description)) ? '<span class="text__gray70"><span class="material-icons-outlined">schedule</span> '.ucfirst($lastNote->created_complet).' </span>' : null?>
						<?php if ($bondActive) { ?>
							<button type="button" data-bs-toggle="modal" data-bs-target="#newNoteModal" class="btn btn-outline-dark">
								NOVA NOTA
							</button>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="documents sidebar_client box">
					<div class="sidebar_client_header">
						<span class="body1 bold">Documentos</span>
						<a class="bold" href="<?=$this->Url->build(['controller'=>'Clients','action'=>'docs','prefix'=>'Dashboard', $patient->id]);?>">Ver todos</a>
					</div>
					<div class="sidebar_client_body">
						<ul class="body1">
							<?php foreach ($summaryListDocs as $key => $obj) : ?>
								<li>
									<?=$obj->name;?>
									<span class="material-icons">people</span>
									<a href="#" class="material-icons-outlined delete" data-id="<?=$obj->id?>">delete</a>
									<a href="<?=$this->Url->build(['controller'=>'Docs','action'=>'download','prefix'=>'Dashboard', $obj->id]);?>" class="material-icons-outlined">file_download</a>
									<span class="size"><?=$obj->size_formated;?></span>
								</li>
							<?php endforeach;?>
						</ul>
					</div>
				</div>
			</div>
            <div class="row">
                <div class="documents sidebar_client box">
                    <div class="sidebar_client_header">
                        <span class="body1 bold">Anexos</span>
                    </div>
                    <div class="sidebar_client_body">
                        <ul class="body1">
                            <li>
                                SOAP
                                <a href="/docs/SOAP.docx" class="material-icons-outlined">file_download</a>
                            </li>
                            <li>
                                Anaminese
                                <a href="/docs/anaminese.docx" class="material-icons-outlined">file_download</a>
                            </li>
                            <li>
                                Autorização para a transmissão de informações
                                <a href="/docs/autorizacao_transmissao_informacao.docx" class="material-icons-outlined">file_download</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>

<?php echo $this->element('clients/modals', [
	'data'=>[
		'complaintItems'=>$complaintItems
	]

]);?>
