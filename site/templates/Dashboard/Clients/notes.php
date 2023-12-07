<div class="content-header">
	<div class="row">
		<div class="client__header">
			<p>
                <?php if ($patient->role==1) : ?>
					<a href="<?=$this->Url->build(['controller'=>'Clients','action'=>'index','prefix'=>'Dashboard']);?>">Clientes</a>
				<?php else : ?>
					<a href="<?=$this->Url->build(['controller'=>'Clients','action'=>'supervision','prefix'=>'Dashboard']);?>">Supervisão Técnica</a>
				<?php endif;?>
                <b><span class="material-icons-outlined">arrow_forward_ios</span></b> <a href="<?=$this->Url->build(['controller'=>'Clients','action'=>'view',$patient->id, 'prefix'=>'Dashboard']);?>"><?=$patient->name?></a>
                <b><span class="material-icons-outlined">arrow_forward_ios</span> Notas Administrativas</b>
            </p>
            <div class="client__header-filter">
				<div class="form-outline required">
					<span class="material-icons">search</span>
					<input type="text" placeholder="Pesquisar..." id="client-notes-search" class="form-control" />
				</div>
			</div>
		</div>
	</div>
</div>


<div class="content-body component" cp-name="docs">
	<div class="row">
		<div class="col">
            <div class="box">
                <div id="filter-notes" class="filter-table">
                    <button data-filter="" class="btn active">
                        Todas notas administrativas
                    </button>
                    <div id="actions-table" class="d-none" data-action="newNote">
                        <a href="#viewNoteModal" class="modal-start" title="Visualizar nota selecionada">
                            <span class="material-icons-outlined text__gray70">visibility</span>
                        </a>
                        <a href="#" class="delete" title="Deletar arquivo selecionado">
                            <span class="material-icons-outlined text__gray70">delete</span>
                        </a>
                    </div>
                </div>
                <table id="notes" class="table-records" width="100%" data-order='[[1,"asc"]]'
                data-columns='[{"width":"80%"},{"width":"20%"}]'>
                    <thead>
                        <tr>
                            <th>Resumo
                                <span class="material-icons-outlined asc">arrow_downward</span>
                                <span class="material-icons-outlined desc">arrow_upward</span>
                            </th>
                            <th>Data
                                <span class="material-icons-outlined asc">arrow_downward</span>
                                <span class="material-icons-outlined desc">arrow_upward</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($notes as $key => $note) : ?>
                            <tr data-id="<?=$note->id?>" data-title="Nota administrativa" data-body="<?=$note->description?>">
                                <td><?=$note->description_resume?></td>
                                <td data-order="-<?=$note->id?>"><?=$note->created_simple?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
		</div>
	</div>
</div>

<div class="modal modal_notes fade" id="viewNoteModal" tabindex="-1" aria-labelledby="viewNoteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewNoteModalLabel"></span></h5>
        <button type="button" class="material-icons text__gray70 btn-close" data-bs-dismiss="modal" aria-label="Close">close</button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<?php echo $this->element('clients/modals');?>
<?php 

    // debug($notes);