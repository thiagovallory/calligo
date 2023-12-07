<div id="cardsIndex" class="container dashboard-content">
    <div class="content-header">
        <h4>Integrações</h4>
        <div class="controls">

        </div>        
    </div>
    <div class="content-body">
        <div class="row box cardItem">
            <div class="col-7">
                <img class="gcal-icon row-icon" src="/img/icon-googlecal.png" alt="Google Calendário"> <strong>Google Calendário 1</strong>
            </div>
            <div class="col-3">
                <?php if ($connected) : ?>
                        <span class="body1"><span class="material-icons-outlined">sync</span>Sincronizado</span>
                <?php else : ?>
                        <span class="body1 text__warning"><span class="material-icons-outlined">sync_disabled</span>'Sincronização desativada</span>
                <?php endif; ?>
            </div>
            <div class="col-2">
                <?php 
                    if ($connected) :
                        echo $this->Html->link('DESCONECTAR',
                            ['controller' => 'Integrations', 'action' => 'logoff'],
                            ['class'=>'btn btn-outline-primary btn-bold']
                        );
                    else :
                        echo $this->Html->link('CONECTAR',
                                    ['controller' => 'Integrations', 'action' => 'sync'],
                                    ['class'=>'btn btn-bold btn-primary']
                        );
                    endif; ?>
            </div>
        </div>
                   
                    <?php 
                        // if ($connected) {
                        //     echo '<h5>CONECTADO</h5>';
                        //     if (empty($events)) {
                        //         echo 'sem eventos';
                        //     } else {
                        //         echo "Eventos encontrados:<br>";
                        //         foreach ($events as $event) {
                        //             $start = $event->start->dateTime;
                        //             if (empty($start)) {
                        //                 $start = $event->start->date;
                        //             }
                        //             printf("<br>%s (%s)\n", $event->getSummary(), $start);
                        //         }
                        //     }
                        // } else {
                        //      echo $this->Html->link('CONECTAR',
                        //             ['controller' => 'Integrations', 'action' => 'sync'],
                        //             ['class'=>'btn btn-bold btn-outline-primary me-2']
                        //     );
                        // }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
