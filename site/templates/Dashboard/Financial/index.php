<div id="cardsIndex" class="container dashboard-content" cp-name="">
    <div class="content-header">
        <div class="clients__header">
            <h4>Financeiro</h4>
            <div class="controls">
                <?=$this->Form->create(null, ['id'=>'filterPaymentHistory', 'class'=>'clients__header-filter', 'type' => 'get']); ?>
                    <div class="form-outline me-4">
                        <select name="paymentType" id="paymentTypeSelect" onchange="this.form.submit()">
                            <option value="0" <?=($this->request->getQuery('paymentType') == 0) ? 'selected' : ''?>>Todos</option>
                            <option value="1" <?=($this->request->getQuery('paymentType') == 1) ? 'selected' : ''?>>Compensado</option>
                            <option value="2" <?=($this->request->getQuery('paymentType') == 2) ? 'selected' : ''?>>Estorno</option>
                            <option value="3" <?=($this->request->getQuery('paymentType') == 3) ? 'selected' : ''?>>Aguardando liberação</option>
                        </select>
                    </div>
                    <div class="form-outline">
                        <select name="paymentOrder" id="paymentOrderSelect" onchange="this.form.submit()">
                            <option value="0" <?=($this->request->getQuery('paymentOrder') == 0) ? 'selected' : null;?>>Mais Recentes</option>
                            <option value="1" <?=($this->request->getQuery('paymentOrder') == 1) ? 'selected' : null;?>>Mais Antigos</option>
                            <option value="2" <?=($this->request->getQuery('paymentOrder') == 2) ? 'selected' : null;?>>Maior Valor</option>
                            <option value="3" <?=($this->request->getQuery('paymentOrder') == 3) ? 'selected' : null;?>>Menor Valor</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="content-body">

        <?php foreach ($invoices as $key => $obj) { ?>
				<div class="row box cardItem historyItem body1">
                    <div class="col-3">
                        <strong>Cliente</strong>
                        <span><?=$obj->appointment->patient->name?></span>
                    </div>
                    <div class="col-2">
                        <strong>Status</strong>
                        <?php switch ($obj['status']) {
                            case 1:
                                echo '<span class="text__success">Compensado</span>';
                            break;
                            case 2:
                                echo '<span class="text__error">Estorno</span>';
                            break;
                            default:
                                echo '<span class="text__warning">Aguardando liberação</span>';
                            break;
                        } ?>
                        
                    </div>
                    <div class="col-3">
                        <strong>Serviço</strong>
                        <span><?=$obj->appointment->modality->name?></span>
                    </div>
                    <div class="col-2">
                        <strong>Data</strong>
                        <span><?=$obj->modified?></span>
                    </div>
                    <div class="col-1">
                        <strong>Preço</strong>
                        <span><?=$obj->appointment->price?></span>
                    </div>
                    <div class="col-1">
                        <a href="<?=$obj->iugu_url?>" class="btn btn-outline-primary btn-bold me-2" target="_BLANK">Nota</a>
                    </div>
                </div>
			<?php } ?>
    </div>

    <?php echo (count($invoices)>0) ? $this->element('paginate') : null;?>
</div>
