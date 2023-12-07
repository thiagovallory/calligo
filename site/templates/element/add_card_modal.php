<div class="modal fade" id="add_card_page_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="cardsIndex" class="container dashboard-content component" cp-name="form">
                <?= $this->Form->create(null, ['type' => 'post', 'url' => ['controller' => 'Cards', 'action' => 'add', 'prefix' => 'Settings', true]]) ?>
                <div class="content-header component" cp-name="cards">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Adicionar Cartão</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-6">
                                    <?= $this->Html->link('Voltar', ['controller' => 'Cards', 'action' => 'index'], ['class' => 'btn btn-outline-primary btn-bold me-4']); ?>
                                </div>
                                <div class="col-6">
                                    <?= $this->Form->button(__('Adicionar'), array('class' => 'btn btn-primary btn-bold btn-save btn_addCard')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <div class="box row">
                        <div class="form-wrapper box col-sm-12 col-md-12 col-lg-10" style="margin:0 auto;">
                            <div class="row">
                                <div class="col">
                                    <?= $this->Form->control('number', ['class' => 'form-control form-field', 'label' => 'Número', 'id' => 'card_number', 'maxlength' => 16]); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <?= $this->Form->control('first_name', ['class' => 'form-control form-field', 'label' => 'Nome', 'id' => 'card_first-name']); ?>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <?= $this->Form->control('last_name', ['class' => 'form-control form-field', 'label' => 'Sobrenome', 'id' => 'card_last-name']); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-lg-4">
                                    <?= $this->Form->control('month', ['class' => 'form-control form-field', 'label' => 'Mês', 'id' => 'card_month-val', 'maxlength' => 2]); ?>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <?= $this->Form->control('year', ['class' => 'form-control form-field', 'label' => 'Ano', 'id' => 'card_year-val', 'options' => $years, 'empty' => ' ']); ?>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <?= $this->Form->control('verification_value', ['class' => 'form-control form-field', 'label' => 'Número de verificação', 'id' => 'card_verify', 'maxlength' => 3]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
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
