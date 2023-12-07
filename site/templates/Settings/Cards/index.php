<div id="cardsIndex" class="container dashboard-content" cp-name="">
    <div class="content-header">
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <h4>Cartões</h4>
            </div>
            <div class="col-sm-12 col-lg-6 d-flex justify-content-end">
                <div>
                    <button class="add_card_page btn btn-primary btn-bold">Adicionar cartão</button>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <?php if ($cards) : foreach ($cards as $keyC => $obj) : ?>
            <div class="row box cardItem">
                <div class="col-2">
                    <i class="fab fa-cc-<?= ($obj['brand']=='Master') ? 'mastercard' : strtolower($obj['brand']);?>"></i> <strong><?= $obj['brand'];?> Crédito</strong>
                </div>
                <div class="col-4">
                    <span class="body1"><?= $obj['display_number'];?></span>
                </div>
                <div class="col-4">
                    <span class="body1"> <?= 'Vencimento '.$obj['month'].'/'.$obj['year'];?></span>
                </div>
                <div class="col-2">
                    <?= $this->Html->link('Excluir',
                        ['controller' => 'Cards', 'action' => 'delete', $obj['id']],
                        ['class'=>'btn btn-bold btn-outline-primary']
                    );?>
                </div>
            </div>
        <?php
            endforeach;
            else :
                echo '<p>Nenhum cartão cadastrado';
            endif;
        ?>
    </div>
</div>

<?php echo $this->element('add_card_modal'); ?>
