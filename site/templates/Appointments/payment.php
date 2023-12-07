<main class="main">
    <div id="profile-page" class="payment-page content">
        <div id="form_identifier" class="profile-content container flex-fullcentered component" cp-name="payment">
            <?= $this->Form->create() ?>
            <div class="row">
                <div class="form-header">
                    <p class="body1 text-center bold">
                        <span class="text__primary50"><span class="circle">2</span> Pagamento</span>
                        <span class="material-icons-outlined">navigate_next</span>
                        <span class="circle">3</span> Confirmação
                    </p>
                </div>
                <div class="col-8">
                    <div class="box white">
                        <div id="cardsIndex" class="container dashboard-content component" cp-name="form">
                            <div class="card-container">
                                <ul>
                                    <?php if ($cards) : ?>
                                        <p class="h5 bold text-start">Cartões Salvos</p>
                                        <?php
                                            foreach ($cards as $keyC => $obj) :
                                        ?>
                                                <li>
                                                    <div class="row">
                                                        <div class="col">
                                                            <input class="form-check-input" type="radio" id=<?= $obj['id'] ?> value=<?= $obj['id'] ?> name="card">
                                                            <label for="<?= $obj['id'] ?>">
                                                                <b><?= $obj['brand']; ?></b>
                                                                <span><?= $obj['display_number']; ?></span>
                                                            </label>
                                                        </div>
                                                        <div class="col offset-2">
                                                            <p class="text-end"><?= 'Vencimento '.$obj['month'].'/'.$obj['year'];?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                        <?php
                                            endforeach;
                                        ?>
                                    <?php
                                        else :
                                            echo '<li><p>Nenhum cartão cadastrado</p></li>';
                                        endif;
                                    ?>
                                </ul>
                            </div>

                            <div class="controls">
                                <button class="add_card_page btn btn-primary btn-bold" type="button">Adicionar novo cartão</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="box white">
                        <p class="h5 text-start">Resumo do Pedido</p>
                        <div class="row">
                            <div class="col">
                                <p>Terapeuta:</p>
                            </div>
                            <div class="col">
                                <p class="text-end"><?= $appointment->therapist->name;?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>Horário de agendamento:</p>
                            </div>
                            <div class="col">
                                <p class="text-end"><?= $appointment->day . '- às' .$appointment->hour;?></p>
                            </div>
                        </div>
                        <div class="row total_row">
                            <div class="col">
                                <p>Total:</p>
                            </div>
                            <div class="col">
                                <p class="h5 bold text-end">R$ <?= $appointment->price;?></p>
                            </div>
                        </div>

                        <?= $this->Form->button(__('FINALIZAR PAGAMENTO'), array('class' => 'btn btn-primary btn-bold btn-save btn_appointmentPay')) ?>

                    </div>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</main>
<?php echo $this->element('add_card_modal'); ?>


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
