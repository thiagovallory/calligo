<div class="content-header">
	<div class="row">
		<div class="client__header">
			<p>
            <?php if ($patient->role==1) : ?>
					<a href="<?=$this->Url->build(['controller'=>'Clients','action'=>'index','prefix'=>'Dashboard']);?>">Clientes</a>
				<?php else : ?>
					<a href="<?=$this->Url->build(['controller'=>'Clients','action'=>'supervision','prefix'=>'Dashboard']);?>">Supervisão Técnica</a>
				<?php endif;?>
                <b><span class="material-icons-outlined">arrow_forward_ios</span></b> <a href="<?=$this->Url->build(['controller'=>'Clients','action'=>'view','prefix'=>'Dashboard', $patient->id]);?>"><?=$patient->name?></a>
                <b><span class="material-icons-outlined">arrow_forward_ios</span> Documentos</b>
            </p>
            <div class="client__header-filter">
				<div class="form-outline required">
					<span class="material-icons">search</span>
					<input type="text" placeholder="Pesquisar..." id="client-docs-search" class="form-control" />
				</div>
			</div>
		</div>
	</div>
</div>

<div class="content-body component" cp-name="docs">
	<div class="row">
		<div class="col">
            <div class="box">
                <div id="filter-docs" class="filter-table">
                    <button data-filter="" data-column="2" class="btn active">
                        Todos documentos
                    </button>
                    <button data-filter="share_N" data-column="2" class="btn">
                        Meus documentos
                    </button>
                    <button data-filter="share_Y" data-column="2" class="btn">
                        Compartilhados comigo
                    </button>
                    <div id="actions-table" class="d-none" data-action="docs">
                        <a href="#" class="link" target="_BLANK" title="Visualizar arquivo selecionado">
                            <span class="material-icons-outlined text__gray70">visibility</span>
                        </a>
                        <a href="#" class="download" download title="Fazer download do arquivo selecionado">
                            <span class="material-icons-outlined text__gray70">file_download</span>
                        </a>
                        <a href="#" class="delete" title="Deletar arquivo selecionado">
                            <span class="material-icons-outlined text__gray70">delete</span>
                        </a>
                    </div>
                </div>
                <table id="docs" class="table-records" width="100%" data-order='[[3,"asc"]]'
                data-columns='[{"width":"40%"},null,{"width":"15%"},{"width":"20%"},{"width":"10%"}]'>
                    <thead>
                        <tr>
                            <th>Nome
                                <span class="material-icons-outlined asc">arrow_downward</span>
                                <span class="material-icons-outlined desc">arrow_upward</span>
                            </th>
                            <th>Tipo
                                <span class="material-icons-outlined asc">arrow_downward</span>
                                <span class="material-icons-outlined desc">arrow_upward</span>
                            </th>
                            <th>Proprietário
                                <span class="material-icons-outlined asc">arrow_downward</span>
                                <span class="material-icons-outlined desc">arrow_upward</span>
                            </th>
                            <th>Data
                                <span class="material-icons-outlined asc">arrow_downward</span>
                                <span class="material-icons-outlined desc">arrow_upward</span>
                            </th>
                            <th data-orderable="false">Tamanho
                                <span class="material-icons-outlined asc">arrow_downward</span>
                                <span class="material-icons-outlined desc">arrow_upward</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all as $key => $obj) : ?>
                            <tr
                                data-id="<?=$obj->id?>"
                                data-file-download="<?=$this->Url->build(['controller'=>'Docs','action'=>'download','prefix'=>'Dashboard', $obj->id]);?>"
                                data-file-view="<?=$this->Url->build(['controller'=>'Docs','action'=>'view','prefix'=>'Dashboard', $obj->id]);?>"
                                data-file-name="<?=$obj->name?>"
                            >
                                <td><?=$obj->name?><span class="material-icons text__gray70"><?=($obj->record->private==1)? 'lock' : 'people'?></span></td>
                                <td><?=$obj->record->type_of_record->name?></td>
                                <td data-filter="<?=($obj->record->owner_id==$_userLogged['id'])? 'share_N' : 'share_Y'?>"><img src="<?=$obj->record->owner->profile->photo?>"> <?= ($obj->record->owner_id==$_userLogged['id']) ? 'Eu' : $obj->record->owner->name?> </td>
                                <td data-order="-<?=$obj->id?>"><?=$obj->created_simple?></td>
                                <td><?=$obj->size_formated?></td>
                            </tr>    
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
		</div>
	</div>
</div>
<?php echo $this->element('clients/modals');?>