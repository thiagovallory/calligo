<div id="cardsIndex" class="container dashboard-content" cp-name="">
    <div class="content-header">
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <h4>Histórico de Pagamentos</h4>
            </div>
            <div class="col-sm-12 col-lg-6 d-flex justify-content-end">
                <div class="flex-sm-grow-1 flex-lg-grow-0">
                    <?= $this->Form->create(null, ['id'=>'filterPaymentHistory', 'type' => 'get']); ?>
                        <div class="form-outline">
                            <select name="paymentOrder" id="#paymentOrderSelect" class="form-select" onchange="this.form.submit()">
                                <option value="0" <?= ($this->request->getQuery('paymentOrder') == 0) ? 'selected' : null;?>>Mais Recentes</option>
                                <option value="1" <?= ($this->request->getQuery('paymentOrder') == 1) ? 'selected' : null;?>>Mais Antigos</option>
                                <option value="2" <?= ($this->request->getQuery('paymentOrder') == 2) ? 'selected' : null;?>>Maior Valor</option>
                                <option value="3" <?= ($this->request->getQuery('paymentOrder') == 3) ? 'selected' : null;?>>Menor Valor</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- HTML de 1 linha -->
        <?php foreach ($invoices as $key => $obj) : ?>
            <div class="row box cardItem historyItem body1">
                <div class="col-3">
                    <strong>Terapeuta</strong>
                    <span><?= $obj->appointment->therapist->name;?></span>
                </div>
                <div class="col-2">
                    <strong>Serviço</strong>
                    <span>Consulta</span>
                </div>
                <div class="col-2">
                    <strong>Data</strong>
                    <span><?= $obj->created;?></span>
                </div>
                <div class="col-2">
                    <strong>Preço</strong>
                    <span><?= $obj->appointment->price;?></span>
                </div>
                <div class="col-2">
                    <strong>Pagamento</strong>
                    <span class="body1"><?= $obj->iugu_card_details;?></span>
                </div>
                <div class="col-3">
                    <a href=<?= $obj->iugu_url!=null ? $obj->iugu_url:'#' ;?> class="btn btn-outline-primary btn-bold me-2">Nota</a>
                    <a href=<?= "/settings/history/requestrefund/".$obj->id ?> class="btn btn-outline btn-bold me-2">Reembolso</a>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- -->

        <!-- Linha com produtos agrupados -->
        <!-- <div class="row box cardItem historyItem body1">
            <div class="col-3">
                <strong>Produto</strong>
                <span>7 produtos</span>
                <div class="component" cp-name="customPopover">
                    <div class="custom-popover__content" id="popover-select">
                        <ul class="list--clean-style content-popover-select">
                            <li><a href="#" target="_blank">Produto 1</a></li>
                            <li><a href="#" target="_blank">Produto 2</a></li>
                            <li><a href="#" target="_blank">Produto 3</a></li>
                            <li><a href="#" target="_blank">Produto 4</a></li>
                            <li><a href="#" target="_blank">Produto 5</a></li>
                            <li><a href="#" target="_blank">Produto 6</a></li>
                            <li><a href="#" target="_blank">Produto 7</a></li>
                        </ul>
                    </div>

                    <a
                            class="text__dark viewAll"
                            rel="popover" title="Popover title"
                            data-text-align="left"
                            data-callback-function="openModal"
                            data-anchor-close="true"
                            data-target="popover-select">
                            Visualizar Todos <span class="material-icons-outlined">arrow_drop_down</span>
                    </a>

                </div>

            </div>
            <div class="col-2">
                <strong>Data</strong>
                <span>22 de Fevereiro de 2021</span>
            </div>
            <div class="col-2">
                <strong>Preço</strong>
                <span>R$ 1087,42</span>
            </div>
            <div class="col-2">
                <strong>Pagamento</strong>
                <span class="body1">Visa ****0344</span>
            </div>
            <div class="col-3">
                <a href="#" class="btn btn-outline-primary btn-bold me-2">Nota</a>
                <a href="#" class="btn btn-outline btn-bold me-2">Reembolso</a>
            </div>
        </div> -->
        <!-- -->
    </div>

    <?php echo (count($invoices)>0) ? $this->element('paginate') : null;?>
</div>
