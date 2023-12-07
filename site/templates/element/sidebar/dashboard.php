<nav >
    <div class="control">
        <span class="material-icons step-backward">menu_open</span>
        <span class="material-icons step-forward">menu</span>
    </div>
    <p class="body1 desktop"><strong>Meu Consultório</strong></p>
    <ul class="sidebar__menu list--clean-style">
        <li class="<?php if($this->request->getParam('controller') == 'Schedules'){ echo 'active';} ?>">
            <a href="/dashboard/schedules">
                <span class="material-icons-outlined">today</span>
                <span class="icon-text">Agenda</span>
            </a>
        </li>
        <li class="<?php if($this->request->getParam('controller') == 'Clients' && $this->request->getParam('action') == 'index'){ echo 'active';} ?>">
            <a href="<?= $this->Url->build(['controller'=>'Clients','action'=>'index']);?>">
                <span class="material-icons-outlined">perm_identity</span>
                <span class="icon-text">Clientes</span>
            </a>
        </li>
        <!--<li class="<?php if($this->request->getParam('controller') == 'Therapy'){ echo 'active';} ?>">
            <a href="/dashboard/therapy"><span class="material-icons-outlined">volunteer_activism</span>Terapia de Alcance</a>
        </li>-->
        <li class="<?php if($this->request->getParam('controller') == 'Clients' && $this->request->getParam('action') == 'supervision'){ echo 'active';} ?>">
            <a href="<?= $this->Url->build(['controller'=>'Clients','action'=>'supervision', '?'=>['role'=>2]]);?>">
                <span class="material-icons-outlined">supervisor_account</span>
                <span class="icon-text">Supervisão Técnica</span>
            </a>
        </li>
        <li class="<?php if($this->request->getParam('controller') == 'Financial'){ echo 'active';} ?>">
            <a href="/dashboard/financial">
                <span class="material-icons-outlined">monetization_on</span>
                <span class="icon-text">Financeiro</span>
            </a>
        </li>
    </ul>
</nav>
