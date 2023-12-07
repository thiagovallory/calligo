<div id="cardsIndex" class="container dashboard-content component" cp-name="form">
    <?= $this->Form->create() ?>
    <div class="content-header component" cp-name="cards">
        <h4>Adicionar Cartão</h4>
        <div class="controls">
            <?= $this->Html->link('Voltar', ['controller' => 'Cards', 'action' => 'index'], ['class' => 'btn btn-outline-primary btn-bold me-4']); ?>
            <?= $this->Form->button(__('Adicionar'), array('class' => 'btn btn-primary btn-bold btn-save btn_addCard')) ?>
        </div>
    </div>
    <div class="content-body">
        <div class="box row">
            <div class="form-wrapper box col-md-12 col-lg-6" style="margin:0 auto;">
                <div class="col-lg-12">
                    <h5>Adicionar cartão</h5>
                </div>
                <div class="row">
                    <div class="col">
                        <?= $this->Form->control('number', ['class' => 'form-control form-field', 'label' => 'Número', 'id' => 'card_number', 'maxlength' => 16]); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?= $this->Form->control('first_name', ['class' => 'form-control form-field', 'label' => 'Nome', 'id' => 'card_first-name']); ?>
                    </div>
                    <div class="col">
                        <?= $this->Form->control('last_name', ['class' => 'form-control form-field', 'label' => 'Sobrenome', 'id' => 'card_last-name']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?= $this->Form->control('month', ['class' => 'form-control form-field', 'label' => 'Mês', 'id' => 'card_month-val', 'maxlength' => 2]); ?>
                    </div>
                    <div class="col">
                        <?= $this->Form->control('year', ['class' => 'form-control form-field', 'label' => 'Ano', 'id' => 'card_year-val']); ?>
                    </div>
                    <div class="col">
                        <?= $this->Form->control('verification_value', ['class' => 'form-control form-field', 'label' => 'Número de verificação', 'id' => 'card_verify', 'maxlength' => 3]); ?>
                    </div>
                </div>

                <div class="col-lg-12">
                    <h5>Endereço de cobrança</h5>
                </div>
                <div class="row">
                    <div class="col">
                        <?= $this->Form->control('address', ['class' => 'form-control form-field', 'label' => 'Endereço']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?= $this->Form->control('address_number', ['class' => 'form-control form-field', 'label' => 'Número']); ?>
                    </div>
                    <div class="col">
                        <?= $this->Form->control('neighborhood', ['class' => 'form-control form-field', 'label' => 'Bairro']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?= $this->Form->control('complement', ['class' => 'form-control form-field', 'label' => 'Complemento']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?= $this->Form->control('zip_code', ['class' => 'form-control form-field', 'label' => 'Cep']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?= $this->Form->control('state_id', ['class' => 'form-control form-select form-field', 'label' => 'Estado', 'options' => $states, 'empty' => ' ']); ?>
                    </div>
                    <div class="col">
                        <?= $this->Form->control('city_id', ['class' => 'form-control form-select form-field', 'label' => 'Cidade', 'options' => $cities, 'empty' => ' ']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?= $this->Form->control('phone', ['class' => 'form-control form-field', 'label' => 'Telefone profissional']); ?>
                    </div>
                    <div class="col">
                        <?= $this->Form->control('emergency_phone', ['class' => 'form-control form-field', 'label' => 'Telefone de Emergência']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>

<div class="modal fade" id="add_card_success" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="h5 text-center modal_title">Cartão cadastrado com sucesso!</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="body1 modal_text">
                    Agora você pode utilizar seu cartão para realizar os pagamentos.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
  document.getElementById("state-id").addEventListener('change', (e) => {
    fetch('/api/change_state?state_id=' + e.target.value)
      .then(response => response.ok ? response.json() : Promise.reject(response))
      .then((data) => {
        let select = document.getElementById("city-id");
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
        let select = document.getElementById("city-id");
        select.innerHTML = "";
      });
  })
</script>
