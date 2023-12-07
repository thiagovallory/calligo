<nav>
    <div class="control">
        <span class="material-icons step-backward">menu_open</span>
        <span class="material-icons step-forward">menu</span>
    </div>
    <div class="sidebar_menu-content">
        <p class="body1 desktop"><strong>Configurações</strong></p>
        <ul class="sidebar__menu list--clean-style">
            <li class="<?php if($this->request->getParam('controller') == 'Account' && $this->request->getParam('action') == 'index'){ echo 'active';} ?>">
                <a href="<?= $this->Url->build(['controller'=>'Account','action'=>'index']);?>">
                    <span class="material-icons-outlined">perm_identity</span>
                    <span class="icon-text">Conta</span>
                </a>
            </li>
            <?php if ($_userLogged['role']==2) : ?>
                <li class="<?php if($this->request->getParam('controller') == 'Account' && $this->request->getParam('action') == 'bank'){ echo 'active';} ?>">
                <a href="<?= $this->Url->build(['controller'=>'Account','action'=>'bank']);?>">
                    <span class="material-icons-outlined">maps_home_work</span>
                    <span class="icon-text">Dados Bancários</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if ($_userLogged['role']==2) : ?>
                <li class="<?php if($this->request->getParam('controller') == 'Attendance'){ echo 'active';} ?>">
                    <a href="<?= $this->Url->build(['controller'=>'Attendance','action'=>'index']);?>">
                        <span class="material-icons-outlined">calendar_today</span>
                        <span class="icon-text">Atendimento</span>
                    </a>
                </li>
            <?php endif; ?>

            <li class="<?php if($this->request->getParam('controller') == 'Cards' && $this->request->getParam('action') == 'index'){ echo 'active';} ?>">
                <a href="<?= $this->Url->build(['controller'=>'Cards','action'=>'index']);?>">
                <span class="material-icons-outlined">credit_card</span>
                    <span class="icon-text">Cartões</span>
                </a>
            </li>
            <li class="<?php if($this->request->getParam('controller') == 'History' && $this->request->getParam('action') == 'index'){ echo 'active';} ?>">
                <a href="<?= $this->Url->build(['controller'=>'History','action'=>'index']);?>">
                <span class="material-icons-outlined">monetization_on</span>
                    <span class="icon-text">Histórico de Pagamentos</span>
                </a>
            </li>
            <!--<li  class="<?php if($this->request->getParam('controller') == 'Notifications'){ echo 'active';} ?>">
                <a href="<?= $this->Url->build(['controller'=>'Notifications','action'=>'index']);?>"><span class="material-icons-outlined">notifications</span>Notificações</a>
            </li>
            <li class="<?php if($this->request->getParam('controller') == 'Integrations'){ echo 'active';} ?>">
                <a href="<?= $this->Url->build(['controller'=>'Integrations','action'=>'index']);?>"><span class="material-icons-outlined">extension</span>Integrações</a>
            </li>-->
            <!--<li><button onclick="window.open('/videocall','Video Call', 'scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width='+ window.screen.width +',height='+ window.screen.height +',left=0,top=0')">Testar Videochamada</button></li>-->
        </ul>
    </div>
</nav>
