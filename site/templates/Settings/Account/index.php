<div id="accountIndexForm" class="container dashboard-content component" cp-name="form">
    <?= $this->Form->create($user, ['type' => 'file']); ?>
    <div class="content-header">
        <h4>Configurações da conta</h4>
        <div class="controls desktop">
            <?= $this->Form->button(__('Cancelar'), array('class' => 'btn btn-bold btn-save d-none', 'type' => 'button', 'onclick' => "toggleEdit()")) ?>
            <?= $this->Form->button(__('Salvar'), array('class' => 'btn btn-primary btn-bold btn-save d-none')) ?>
            <?= $this->Form->button(__('Editar'), array('class' => 'btn btn-primary btn-bold btn-edit', 'type' => 'button', 'onclick' => "toggleEdit(true)")) ?>
        </div>
    </div>
    <div class="content-body">
        <div class="form-wrapper box col-12">
            <div class="row">
                <div class="col-lg-2 upload_container-img">
                    <div class="img-upload-container">
                        <img class="imgPreview" src="" alt="">
                        <img class="profile-image" src="<?php echo $user->profile->photo; ?>" />
                        <a class="btn btn-primary btn-round-icon imgUploadComponent d-none" id="imgUpload"><span class="material-icons-outlined">photo_camera</span></a>
                        <input type="file" class="img-input imgUploadComponent d-none" />
                        <?= $this->Form->input('profile.photo_base64', ['type' => 'hidden', 'id' => 'imgbase64']); ?>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="col-lg-12">
                        <h5>Informações Pessoais</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <?= $this->Form->control('name', ['class' => 'form-control form-field', 'disabled', 'label' => 'Nome Completo']); ?>
                            <?= $this->Form->control('profile.id'); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $this->Form->control('profile.title_id', ['class' => 'form-control form-select form-field', 'disabled', 'label' => 'Título', 'options' => $titles, 'empty' => ' ']); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $this->Form->control('profile.birth_date', ['class' => 'form-control form-field', 'disabled', 'label' => 'Data de Nascimento']); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $this->Form->control('profile.age', ['class' => 'form-control form-field', 'disabled', 'readonly', 'label' => 'Idade', 'value' => $user->profile->age]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <?= $this->Form->control('profile.gender', ['class' => 'form-control form-select form-field', 'disabled', 'label' => 'Gênero', 'options' => $genders, 'empty' => ' ']); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $this->Form->control('profile.pronoun', ['class' => 'form-control form-select form-field', 'disabled', 'label' => 'Pronome', 'options' => $pronouns, 'empty' => ' ']); ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $this->Form->control('profile.document_number', ['class' => 'mask_cpf form-control form-field', 'disabled', 'label' => 'CPF']); ?>
                        </div>
                    </div>

                    <?php if ($_userLogged['role'] == 2): ?>
                        <div class="row">
                            <div class="col-lg-3">
                                <?= $this->Form->control('profile.crp', ['class' => 'form-control form-field', 'disabled', 'label' => 'CRP']); ?>
                            </div>
                            <div class="col-lg-3">
                                <?= $this->Form->control('profile.crp_origin', ['class' => 'form-control form-select form-field', 'disabled', 'label' => 'Origem do CRP', 'options' => $crp_origins, 'empty' => ' ']); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->Form->control('profile.telephone_number', ['class' => 'mask_phone form-control form-field', 'disabled', 'label' => 'Telefone']); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <?= $this->Form->control('profile.crp_expiration', ['class' => 'form-control form-field', 'disabled', 'label' => 'Data de expiração do CRP']); ?>
                            </div>
                            <div class="col-lg-3">
                                <?= $this->Form->control('profile.crp_expiration_date', ['class' => 'form-control form-field', 'disabled', 'readonly', 'label' => '', 'value' => $user->profile->crp_expiration_date]); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->Form->control('username', ['class' => 'form-control form-field', 'disabled', 'label' => 'Email']); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <?= $this->Form->control('profile.epsi', ['class' => 'form-control form-field mask_epsi', 'disabled', 'label' => 'E-psi']); ?>
                            </div>
                            <div class="col-lg-3">
                                <?= $this->Form->control('profile.epsi_origin', ['class' => 'form-control form-select form-field', 'disabled', 'label' => 'Origem do E-psi', 'options' => $crp_origins, 'empty' => ' ']); ?>
                            </div>
                            <div class="col-lg-3">
                                <?= $this->Form->control('profile.default_language', ['class' => 'form-control form-select form-field', 'disabled', 'label' => 'Idioma', 'options' => $languages, 'empty' => ' ']); ?>
                            </div>
                            <div class="col-lg-3">
                                <?= $this->Form->control('profile.default_time_zone', ['class' => 'form-control form-select form-field', 'disabled', 'label' => 'Fuso Horário', 'options' => $time_zones, 'empty' => ' ']); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <?= $this->Form->control('profile.epsi_expiration', ['class' => 'form-control form-field', 'disabled', 'label' => 'Data de expiração do E-psi']); ?>
                            </div>
                            <div class="col-lg-3">
                                <?= $this->Form->control('profile.epsi_expiration_days', ['class' => 'form-control form-field', 'disabled', 'readonly', 'label' => '', 'value' => $user->profile->epsi_expiration_date]); ?>
                            </div>
                            <div class="col-lg-6">
                                <a href="https://e-psi.cfp.org.br/cadastro-simplificado/encontrarRegistro" target="_blank">Sem cadastro do e-psi, clique aqui</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <?= $this->Form->control('profile.telephone_number', ['class' => 'mask_phone form-control form-field', 'disabled', 'label' => 'Telefone']); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->Form->control('username', ['class' => 'form-control form-field', 'disabled', 'label' => 'Email']); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <?= $this->Form->control('profile.default_language', ['class' => 'form-control form-select form-field', 'disabled', 'label' => 'Idioma', 'options' => $languages, 'empty' => ' ']); ?>
                            </div>
                            <div class="col-lg-3">
                                <?= $this->Form->control('profile.default_time_zone', ['class' => 'form-control form-select form-field', 'disabled', 'label' => 'Fuso Horário', 'options' => $time_zones, 'empty' => ' ']); ?>
                            </div>
                            <div class="col-lg-6"></div>
                        </div>
                    <?php endif ?>

                    <?php if ($_userLogged['role'] == 1): ?>
                        <div class="col-lg-12 mb-4">
                            <h5>Quais as tuas motivações para buscar terapia?</h5>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-outline multiple_select-container">
                                <select id="problem_select" class="step-select multiple_select form-select form-field select2" name="problems[_ids][]" multiple="multiple" disabled>
                                    <?php
                                    foreach ($problems as $key => $obj) {
                                        $selected = ($obj['selected']) ? 'selected' : null;
                                        echo '<option value="' . $obj['id'] . '" ' . $selected . '>' . $obj['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <span class="search-icon material-icons-outlined">search</span>
                                <label class="form-label body1" for="problem_select">Ex: Depressão, ansiedade...</label>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-4">
                            <h5>Contato de emergência</h5>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <?= $this->Form->control('emergency_contact.id', ['class' => 'form-control']); ?>
                                <?= $this->Form->control('emergency_contact.name', ['class' => 'form-control form-field', 'disabled', 'label' => 'Nome Completo']); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->Form->control('emergency_contact.telephone_number', ['class' => 'mask_phone form-control form-field', 'disabled', 'label' => 'Telefone']); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <?= $this->Form->control('emergency_contact.gender', ['class' => 'form-control form-select form-field', 'disabled', 'label' => 'Gênero', 'options' => $genders, 'empty' => ' ']); ?>
                            </div>
                            <div class="col-lg-3">
                                <?= $this->Form->control('emergency_contact.pronoun', ['class' => 'form-control form-select form-field', 'disabled', 'label' => 'Pronome', 'options' => $pronouns, 'empty' => ' ']); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->Form->control('emergency_contact.email', ['class' => 'form-control form-field', 'disabled', 'label' => 'Email']); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="col-lg-12 mb-4">
                        <h5>Dados de Login</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 settings_account-form-mg">
                            <?= $this->Form->control('username', ['class' => 'form-control', 'label' => 'Email', 'disabled']); ?>
                            <?= $this->Html->link('Alterar E-mail', ['controller' => 'Account', 'action' => 'changeEmail'], ['class' => 'btn btn-outline-primary btn-bold mobile']) ?>
                        </div>
                        <div class="col-lg-6 settings_account-form-mg">
                            <?= $this->Form->control('password', ['class' => 'form-control', 'label' => 'Senha', 'disabled']); ?>
                            <?= $this->Html->link('Alterar Senha', ['controller' => 'Account', 'action' => 'changePassword'], ['class' => 'btn btn-outline-primary btn-bold mobile']) ?>
                        </div>
                    </div>
                    <div class="row mb-4 desktop desktopFlex">
                        <div class="col-lg-6">
                            <?= $this->Html->link('Alterar E-mail', ['controller' => 'Account', 'action' => 'changeEmail'], ['class' => 'btn btn-outline-primary btn-bold']) ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $this->Html->link('Alterar Senha', ['controller' => 'Account', 'action' => 'changePassword'], ['class' => 'btn btn-outline-primary btn-bold']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"></div>
                        <div class="col-lg-3">
                            <?= $this->Html->link(__('Encerrar conta'), ['controller' => 'Account', 'action' => 'deleteAccount'], ['class' => 'btn btn-bold btn_mobile']) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $this->Html->link(__('Desativar conta'), ['controller' => 'Account', 'action' => 'deactivateAccount'], ['class' => 'btn btn-outline-primary btn-bold btn_mobile']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="controls controls_mobile text-end mobile">
            <?= $this->Form->button(__('Cancelar'), array('class' => 'btn btn-bold btn-save d-none', 'type' => 'button', 'onclick' => "toggleEdit()")) ?>
            <?= $this->Form->button(__('Salvar'), array('class' => 'btn btn-primary btn-bold btn-save d-none')) ?>
            <?= $this->Form->button(__('Editar'), array('class' => 'btn btn-primary btn-bold btn-edit', 'type' => 'button', 'onclick' => "toggleEdit(true)")) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>
<!-- Modal -->
<div class="modal fade" id="cropModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Imagem de Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" alt="" id="imgToCrop" style="width: 100%; min-height: 300px; height: auto;">
            </div>
            <div class="modal-footer">
                <button type="button" id="cancelCrop" class="btn btn-bold btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" id="selectCrop" class="btn btn-bold btn-primary">Selecionar</button>
            </div>
        </div>
    </div>
</div>
<script>
  var toggleEdit = function (status) {
    if (!status) {
      $('.form-field').prop('disabled', true);
      $('.btn-save').toggleClass('d-none');
      $('.btn-edit').toggleClass('d-none');
      $('.imgUploadComponent').toggleClass('d-none')
    } else {
      $('.form-field').prop('disabled', false).trigger('blur');
      $('.btn-save').toggleClass('d-none');
      $('.btn-edit').toggleClass('d-none');
      $('.imgUploadComponent').toggleClass('d-none')
    }
  }
</script>
