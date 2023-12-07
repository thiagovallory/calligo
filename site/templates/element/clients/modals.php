<!-- Modals -->
<div class="modal modal_records fade" id="newRegisterModal" tabindex="-1" aria-labelledby="newRegisterModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newRegisterModalLabel"><?php echo \Cake\I18n\Date::create()->format('d') . ' de ' . @Cake\Core\Configure::read('MONTHS_PORT')[\Cake\I18n\Date::create()->format('n')] . ' de ' . \Cake\I18n\Date::create()->format('Y') ?></h5>
        <div class="select">
          <div class="icon_select component" cp-name="select_share">
            <select class="form-select body2 bold" name="record_private" id="record_private">
              <option selected="selected" value="0" data-icon="<span class='material-icons text__gray70'>people</span>">Compartilhar</option>
                <?php if($_userLogged['role'] == 2): ?>
              <option value="1" data-icon="<span class='material-icons text__gray70'>lock</span>">Privado</option>
                <?php endif; ?>
            </select>
            <div class="icon"></div>
          </div>
        </div>
        <button type="button" class="material-icons text__gray70 btn-close" data-bs-dismiss="modal" aria-label="Close">close</button>
      </div>
      <div class="modal-body">
        <form>
          <div class="row">
              <div class="col">
                  <!-- input -->
                  <div class="form-outline required">
                    <input type="text" placeholder="Nome do registro" id="record_name" name="record_name" class="form-control">
                    <span class="help-message"></span>
                    <span class="error-message"></span>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col">
                  <div class="form-outline">
                      <select class="form-select form-control" name="record_type_of_record_id" id="record_type_of_record_id">
                          <option selected disabled value="">Tipo</option>
                          <?php foreach ($typeOfRecords as $key => $obj) : ?>
                            <option value="<?=$obj->id;?>"><?=$obj->name;?></option>
                          <?php endforeach;?>
                      </select>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col">
                  <!-- input -->
                  <div class="form-outline required">
                    <textarea name="record_description" id="record_description" placeholder="Anotações" cols="30" rows="10" class="form-control component" cp-name="form_summernote"></textarea>
                    <div class="files">
                      <!-- <span class="file">Anamnese Adulto <b>(100kb)</b> <button type="button" class="material-icons text__gray70 btn-delete-file">close</button></span> -->
                    </div>
                    <span class="error-message"></span>
                    <span class="help-message"></span>
                  </div>
              </div>
          </div>
          <input type="hidden" name="record_patient_id" id="record_patient_id" value="<?=$patient->id?>">
          <input class="d-none files_in_textarea" type="file" id="formFileRecord" name="attachment" accept=".doc,.docx,.pdf,.txt,.jpg,.jpeg,.png">
        </form>
      </div>
      <div class="modal-footer">
        <div class="left-modal-footer">
          <div class="format-note" data-summernote="record_description">
            <span data-button-summernote="bold" class="material-icons-outlined">format_bold</span>
            <span data-button-summernote="italic" class="material-icons-outlined">format_italic</span>
            <span data-button-summernote="underline" class="material-icons-outlined">format_underlined</span>
            <span data-button-summernote="strikethrough" class="material-icons-outlined">strikethrough_s</span>
            <span data-button-summernote="insertUnorderedList" class="material-icons-outlined">format_list_bulleted</span>
            <span data-button-summernote="insertOrderedList" class="material-icons-outlined">format_list_numbered</span>
            <span data-button-summernote="removeFormat" class="material-icons-outlined border-1 border-start border-end">format_clear</span>
            <label for="formFileRecord">
              <span class="material-icons-outlined">attach_file</span>
            </label>
            <!-- <input class="d-none" type="file" id="formFile" name="attachment" multiple> -->
          </div>
        </div>
        <button type="button" class="form_buttons btn btn-default" data-bs-dismiss="modal">CANCELAR</button>
        <button type="submit" class="form_buttons btn btn-primary">SALVAR</button>
      </div>
    </div>
  </div>
</div>

<div class="modal modal_notes fade" id="newNoteModal" tabindex="-1" aria-labelledby="newNoteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newNoteModalLabel">Nova nota administrativa</h5>
        <button type="button" class="material-icons text__gray70 btn-close" data-bs-dismiss="modal" aria-label="Close">close</button>
      </div>
      <div class="modal-body">
        <form>
          <div class="row">
              <div class="col">
                  <!-- input -->
                  <div class="form-outline required">
                    <textarea name="note_description" id="note_description" placeholder="Anotações" cols="30" rows="10" class="form-control"></textarea>
                    <span class="error-message"></span>
                    <span class="help-message"></span>
                  </div>
              </div>
          </div>
          <input type="hidden" name="note_patient_id" id="note_patient_id" value="<?=$patient->id?>">
        </form>
      </div>
      <div class="modal-footer">
        <div class="left-modal-footer">
          <div class="format-note" data-summernote="note_description">
            <span data-button-summernote="bold" class="material-icons-outlined">format_bold</span>
            <span data-button-summernote="italic" class="material-icons-outlined">format_italic</span>
            <span data-button-summernote="underline" class="material-icons-outlined">format_underlined</span>
            <span data-button-summernote="strikethrough" class="material-icons-outlined">strikethrough_s</span>
            <span data-button-summernote="insertUnorderedList" class="material-icons-outlined">format_list_bulleted</span>
            <span data-button-summernote="insertOrderedList" class="material-icons-outlined">format_list_numbered</span>
            <span data-button-summernote="removeFormat" class="material-icons-outlined border-1 border-start">format_clear</span>
          </div>
        </div>
        <button type="button" class="btn btn-default form_buttons" data-bs-dismiss="modal">CANCELAR</button>
        <button type="submit" class="btn btn-primary form_buttons">SALVAR</button>
      </div>
    </div>
  </div>
</div>

<div class="modal modal_notes fade" id="closeTherapyModal" tabindex="-1" aria-labelledby="closeTherapyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="closeTherapyModalLabel">Encerrar terapia com <span id="closeTherapyModalName"></span></h5>
        <button type="button" class="material-icons text__gray70 btn-close" data-bs-dismiss="modal" aria-label="Close">close</button>
      </div>
      <div class="modal-body">
        <form id="closeTherapyForm">
          <div class="row component" cp-name="form_files">
          <!-- <div class="row"> -->
              <div class="col">
                  <!-- input -->
                  <div class="form-outline required">
                    <textarea name="closing_description" id="close_therapy" placeholder="Redigir nota de encerramento." cols="30" rows="10" class="form-control"></textarea>
                    <div class="files">
                      <!-- <span class="file">nota de encerramento <b>(100kb)</b> <button type="button" class="material-icons text__gray70 btn-delete-file">close</button></span> -->
                    </div>
                    <span class="error-message"></span>
                    <span class="help-message"></span>
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" name="closing_patient_at_risk" type="checkbox" value="1" id="closing_patient_at_risk">
                    <label class="form-check-label body1" for="closing_patient_at_risk">
                        <b>O <?=($this->request->getParam('controller') == 'Clients') ? 'paciente' : 'psicólogo';?> oferece risco</b><br>
                        Estou ciente da gravidade deste alerta e afirmo que todas as informações contidas aqui são verídicas.
                    </label>
                </div>
            </div>
          </div>
          <input type="hidden" name="id" id="closing_id">
          <input type="hidden" name="profile" id="closing_profile">
          <input class="d-none files_in_textarea" type="file" id="formFile" name="attachment" accept=".doc,.docx,.pdf,.txt,.jpg,.jpeg,.png">
        </form>
      </div>
      <div class="modal-footer">
        <div class="left-modal-footer">
          <div class="format-note" data-summernote="close_therapy">
            <span data-button-summernote="bold" class="material-icons-outlined">format_bold</span>
            <span data-button-summernote="italic" class="material-icons-outlined">format_italic</span>
            <span data-button-summernote="underline" class="material-icons-outlined">format_underlined</span>
            <span data-button-summernote="strikethrough" class="material-icons-outlined">strikethrough_s</span>
            <span data-button-summernote="insertUnorderedList" class="material-icons-outlined">format_list_bulleted</span>
            <span data-button-summernote="insertOrderedList" class="material-icons-outlined">format_list_numbered</span>
            <span data-button-summernote="removeFormat" class="material-icons-outlined border-1 border-start border-end">format_clear</span>
            <!-- <span class="material-icons-outlined">attach_file</span> -->
            <label for="formFile">
              <span class="material-icons-outlined">attach_file</span>
            </label>
          </div>
        </div>
        <button type="button" class="form_buttons btn btn-default" data-bs-dismiss="modal">CANCELAR</button>
        <button type="submit" class="form_buttons btn btn-primary">ENCERRAR TERAPIA</button>
      </div>
    </div>
  </div>
</div>

<?php if (isset($data['complaintItems'])) : ?>
<div class="modal modal_notes fade" id="reportPatientModal" tabindex="-1" aria-labelledby="reportPatientModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reportPatientModalLabel">Denunciar <span id="reportPatientModalName"></span></h5>
        <button type="button" class="material-icons text__gray70 btn-close" data-bs-dismiss="modal" aria-label="Close">close</button>
      </div>
      <div class="modal-body">
        <form>
          <!-- <div class="row component" cp-name="form_files"> -->
          <?php foreach ($data['complaintItems'] as $key => $item) : ?>
              <div class="row reportCheckbox">
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?=$item->id?>" id="reportCheckbox_<?=$key?>">
                        <label class="form-check-label body1" for="reportCheckbox_<?=$key?>">
                            <b><?=$item->name?></b>
                        </label>
                    </div>
                </div>
              </div>
          <?php endforeach; ?>
          <div class="row">
              <div class="col">
                  <!-- input -->
                  <div class="form-outline required">
                    <textarea name="report_description" id="report_description" placeholder="Anotação." cols="30" rows="10" class="form-control"></textarea>
                    <span class="error-message"></span>
                    <span class="help-message"></span>
                  </div>
              </div>
          </div>
          <input type="hidden" name="id" id="report_id">
          <input type="hidden" name="profile" id="report_profile">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">CANCELAR</button>
        <button type="submit" class="btn btn-primary">DENUNCIAR</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<div class="modal modal_notes fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationModalLabel">
          <span class="confirm_reportPatient">Você tem certeza que quer denunciar <span class="confirm_name_reportPatient"></span>?</span>
          <span class="confirm_closeTherapy">Você tem certeza que deseja encerrar a terapia com <span class="confirm_name_closeTherapy"></span>?</span>
          <span class="confirm_newNote">Você tem certeza que quer excluir esta nota?</span>
          <span class="confirm_docs">Você tem certeza que quer excluir este documento?</span>
        </h5>
        <button type="button" class="material-icons text__gray70 btn-close" data-bs-dismiss="modal" aria-label="Close">close</button>
      </div>
      <div class="modal-body">
        <p class="confirm_reportPatient">
            Declaro que as informações prestadas são verdadeiras e me responsabilizo legalmente pelo conteúdo da denúncia realizada.        </p>
        <p class="confirm_closeTherapy">
            Estou ciente que, uma vez encerrada a terapia, a (o) psicólogo (a) não terá mais acesso aos documentos e informações da (o) cliente. Concorda com o encerramento?        </p>
        <p class="confirm_newNote">
            Estou ciente que, uma vez excluído a nota, esta não poderá ser recuperada. Concorda com a exclusão?        </p>
        <p class="confirm_docs">
            Estou ciente que, uma vez excluído o documento, este não poderá ser recuperado. Concorda com a exclusão?        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="confirm_cancel">CANCELAR</button>
        <button type="button" class="btn btn-error" id="confirm_delete">
          <span class="confirm_reportPatient">DENUNCIAR</span>
          <span class="confirm_closeTherapy">ENCERRAR TERAPIA</span>
          <span class="confirm_newNote">EXLCUIR</span>
          <span class="confirm_docs">EXLCUIR</span>
        </button>
      </div>
    </div>
  </div>
</div>
