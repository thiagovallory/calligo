<!-- Prontuário -->

<div class="content-header">
	<div class="row">
		<div class="client__header">
			<p><a href="/dashboard/clients">Clientes</a> <b><span class="material-icons-outlined">arrow_forward_ios</span> Luiz Ferreira</b></p>
		</div>
	</div>
</div>
<div class="content-body component" cp-name="clients">
	<div class="row component" cp-name="customPopover">
		<div id="client" class="col-md-8">
			<div class="box">
				<div class="client">
					<img src="/uploads/162456506360d4e547ce1f1.png">
					<div class="info">
						<h4>Luiz Ferreira</h4>
						<p>Masculino <i class="dot"></i> Ele/Dele <i class="dot"></i> 18 anos</p>
						<p class="mb-0">
							<span class="title_info bold">Próxima sessão</span>
							Março 10, 2021 <i class="dot"></i> 10:00 às 11:00
						</p>
						<p class="mb-0">
							<span class="title_info bold">Motivo(s)</span>
							<!-- imprimir até 3 -->
							<span class="speciality_tag records">Depressão</span>
							<span class="speciality_tag records">Ansiedade</span>
							<span class="speciality_tag records">Autoconhecimento</span>
							<!-- //INICIO// <-- imprimir se houver mais do que 3 -->
							<span class="more bold">Ver mais</span>
							<span class="info_oculta d-none">
								<!-- imprimir restante -->
								<span class="speciality_tag records">Ansiedade</span>
								<span class="speciality_tag records">Autoconhecimento</span>
								<span class="less bold">Ver menos</span>
							</span>
							<!-- //FIM// -->
						</p>
					</div>
					<div class="contacts">
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
									<li><a data-open-id-modal="#reportPatientModal" class="body1 popover__anchor" href="#">Denunciar cliente</a></li>
									<li><a data-open-id-modal="#closeTherapyModal" class="body1 popover__anchor" href="#">Encerrar terapia</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box">
				<div class="registers_client">
					<div class="registers_client_header">
						<div class="filters">
							<form action="" class="filterSearch">
								<?php
									$type=isset($_GET['type'])?$_GET['type']:'';
									$asc=isset($_GET['asc'])?$_GET['asc']:'';
									$order_date=isset($_GET['order_date'])?$_GET['order_date']:'';
								?>
								<div class="row">
									<div class="col">
										<div class="form-outline">
											<select class="form-select" name="type" id="type">
												<option <?=$type==""?'selected=""':''?> value="" disabled>Tipo de registro</option>
												<option <?=$type=="1"?'selected=""':''?> value="1">Contatos</option>
												<option <?=$type=="2"?'selected=""':''?> value="2">Terapias</option>
												<option <?=$type=="3"?'selected=""':''?> value="3">Atividades</option>
												<option <?=$type=="4"?'selected=""':''?> value="4">Escalas</option>
												<option <?=$type=="5"?'selected=""':''?> value="5">Diagnósticos</option>
												<option <?=$type=="6"?'selected=""':''?> value="6">Relatórios</option>
												<option <?=$type=="7"?'selected=""':''?> value="7">Testes psicológicos</option>
												<option <?=$type=="8"?'selected=""':''?> value="8">Outros</option>
											</select>
										</div>
									</div>
									<div class="col">
										<div class="form-outline">
											<select class="form-select" name="asc" id="asc">
												<option <?=$asc==""?'selected=""':''?> value="" disabled>Classificar por</option>
												<option <?=$asc=="true"?'selected=""':''?> value="true">Mais recentes</option>
												<option <?=$asc=="false"?'selected=""':''?> value="false">Mais antigos</option>
											</select>
										</div>
									</div>
									<div class="col">
										<div class="form-outline">
											<select class="form-select" name="order_date" id="order_date">
												<option <?=$order_date==""?'selected=""':''?> value="" disabled>Período</option>
												<option <?=$order_date=="1"?'selected=""':''?> value="1">Última semana</option>
												<option <?=$order_date=="2"?'selected=""':''?> value="2">Último mês</option>
												<option <?=$order_date=="3"?'selected=""':''?> value="3">Último ano</option>
												<option <?=$order_date=="4"?'selected=""':''?> value="4">Período</option>
											</select>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="new_reg">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newRegisterModal">
								<span class="material-icons-outlined">add</span> NOVO REGISTRO
							</button>
						</div>
					</div>
					<div class="br"></div>
					<div class="registers_client_body">
						<div class="row time-line">
							<div class="col">
								<?php
									$timeline[] = array(
										'ano' => 2021,
										'mes' => 'Fevereiro',
										'dia' => 20,
										'titulo' => 'Terapia individual',
										'hora_inicio' => '10:00',
										'hora_final' => '11:00',
										'publico' => true,
										'info' => ''
									);
									$timeline[] = array(
										'ano' => 2021,
										'mes' => 'Fevereiro',
										'dia' => 20,
										'titulo' => 'Hipótese diagnóstica',
										'hora_inicio' => '',
										'hora_final' => '',
										'publico' => false,
										'info' => 'Diagnóstico F43.10 - Transtorno de estresse pós-traumático, não especificado.'
									);
									$timeline[] = array(
										'ano' => 2021,
										'mes' => 'Fevereiro',
										'dia' => 10,
										'titulo' => 'Terapia individual',
										'hora_inicio' => '10:00',
										'hora_final' => '11:00',
										'publico' => true,
										'info' => 'Sua anotação aqui.'
									);
									$timeline[] = array(
										'ano' => 2021,
										'mes' => 'Fevereiro',
										'dia' => 10,
										'titulo' => 'Escala PHQ-9',
										'hora_inicio' => '',
										'hora_final' => '',
										'publico' => true,
										'info' => 'Score: 15'
									);
									$prev_date = array(0,0,0);

								foreach ($timeline as $tl) {
									if ($prev_date[0]==$tl['dia']&$prev_date[1]==$tl['mes']&$prev_date[2]==$tl['ano']) {
										$mostrar_data = true;
									} else {
										$mostrar_data = false;
									}
								?>
									<div class="time clearfix">
										<div class="date <?=$mostrar_data?'date_equal':''?>">
											<p class="month bold"><?=$tl['mes']?></p>
											<h3 class="day"><?=$tl['dia']?></h3>
										</div>
										<span class="line"></span>
										<p class="register">
											<span class="bold">
												<?=$tl['titulo']?><?=$tl['hora_inicio']!=''?' - '.$tl['hora_inicio'].' às '.$tl['hora_final']:''?>
												<span class="material-icons pub_priv text__gray70"><?=$tl['publico']?'people':'lock'?></span>
											</span>
											<span class="pub_priv text__<?=$tl['info']==''?'gray50':'dark'?>"><?=$tl['info']==''?'Você não adicionou nenhuma informação nesse registro.':$tl['info']?></span>
											<a href="#"><span class="add_edit material-icons-outlined text__gray70"><?=$tl['info']==''?'add_box':'edit'?></span></a>
										</p>
									</div>
								<?php $prev_date[0] = $tl['dia']; $prev_date[1] = $tl['mes']; $prev_date[2] = $tl['ano']; } ?>
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
						<a class="bold" href="#">Ver todas</a>
					</div>
					<div class="sidebar_client_body">
						<p>- A última nota ficará fixa aqui.</p>
						<P>- Paciente apresenta pensamentos suicidas.</p>
						<P>- Lorem ipsum dolor sit amet.</p>
						<P>- Lorem ipsum dolor sit amet.</p>
					</div>
					<div class="sidebar_client_footer">
					<span class="text__gray70"><span class="material-icons-outlined">schedule</span> Março 10, 2021 às 10:15</span>
						<button type="button" data-bs-toggle="modal" data-bs-target="#newNoteModal" class="btn btn-outline-dark">
							NOVA NOTA
						</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="documents sidebar_client box">
					<div class="sidebar_client_header">
						<span class="body1 bold">Documentos</span>
						<a class="bold" href="/dashboard/clients/docs/51">Ver todos</a>
					</div>
					<div class="sidebar_client_body">
						<ul class="body1">
							<?php for ($i=0; $i < 10; $i++) { ?>
								<li>
									<a href="#">Nome do documento</a>
									<span class="material-icons">people</span>
									<a href="#" class="material-icons-outlined">delete</a>
									<a href="#" class="material-icons-outlined">file_download</a>
									<span class="size">100kb</span>
								</li>
							<?php } ?>
						</ul>
					</div>
					<!-- <div class="sidebar_client_footer">
						<button class="btn btn-outline-dark">
							ADICIONAR DOCUMENTO
						</button>
					</div> -->
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo $this->element('clients/modals');?>
