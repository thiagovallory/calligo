<div id="accountIndexForm" class="container dashboard-content component" cp-name="form">
    <?= $this->Form->create($bank); ?>
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
                <div class="col-lg-10">
                    <div class="col-lg-12">
                        <h5>Dados Bancários</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $this->Form->control('bank.id', ['class' => 'form-control form-field', 'disabled', 'label' => 'Nome do Titular']); ?>
                            <?= $this->Form->control('bank.name', ['class' => 'form-control form-field', 'disabled', 'label' => 'Nome do Titular']); ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $this->Form->control('bank.financial_institution_id', ['class' => 'form-control form-select form-field', 'disabled', 'label' => 'Banco', 'options' => $financial_institutions, 'empty' => ' ']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $this->Form->control('bank.document_number', ['class' => 'form-control form-field mask_cpf_cnpj', 'disabled', 'label' => 'CPF/CNPJ']); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $this->Form->control('bank.agency', ['class' => 'form-control form-field', 'disabled', 'label' => 'Agência']); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $this->Form->control('bank.account', ['class' => 'form-control form-field', 'disabled', 'label' => 'Conta']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $this->Form->control('bank.type', ['class' => 'form-control form-select form-field', 'disabled', 'label' => 'Tipo de Conta', 'options' => $bank_types, 'empty' => ' ']); ?>
                        </div>
                        <div class="col-lg-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $this->Form->control('bank.cep', ['class' => 'form-control form-field', 'disabled', 'label' => 'CEP']); ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $this->Form->control('bank.address', ['class' => 'form-control form-field', 'disabled', 'label' => 'Endereço']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $this->Form->control('bank.state_id', ['class' => 'form-control form-select form-field', 'disabled', 'label' => 'Estado', 'options' => $states, 'empty' => ' ']); ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $this->Form->control('bank.city_id', ['class' => 'form-control form-select form-field', 'disabled', 'label' => 'Cidade', 'options' => $cities, 'empty' => ' ']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $this->Form->control('bank.neighborhood', ['class' => 'form-control form-field', 'disabled', 'label' => 'Bairro']); ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $this->Form->control('bank.telephone', ['class' => 'form-control form-field', 'disabled', 'label' => 'Telefone']); ?>
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

<script>
  var toggleEdit = function (status) {
    if (!status) {
      $('.form-field').prop('disabled', true);
      $('.btn-save').toggleClass('d-none');
      $('.btn-edit').toggleClass('d-none');
    } else {
      $('.form-field').prop('disabled', false).trigger('blur');
      $('.btn-save').toggleClass('d-none');
      $('.btn-edit').toggleClass('d-none');
    }
  }

  document.getElementById("bank-state-id").addEventListener('change', (e) => {
    fetch('/api/change_state?state_id=' + e.target.value)
      .then(response => response.ok ? response.json() : Promise.reject(response))
      .then((data) => {
        let select = document.getElementById("bank-city-id");
        select.innerHTML = "";
        let option = document.createElement('option');
        option.value = "";
        option.text = "";
        select.add(option);
        Object.keys(data).forEach((key) => {
          let option = document.createElement('option');
          option.value = key;
          option.text = data[key];
          select.add(option);
        });
      })
      .catch(err => {
        let select = document.getElementById("bank-city-id");
        select.innerHTML = "";
      });
  })
</script>
