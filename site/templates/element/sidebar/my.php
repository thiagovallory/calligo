<nav >
    <div class="control">
        <span class="material-icons step-backward">menu_open</span>
        <span class="material-icons step-forward">menu</span>
    </div>
    <p class="body1 desktop"><strong>Minha Terapia</strong></p>
    <ul class="sidebar__menu list--clean-style">
        <li class="<?php if($this->request->getParam('controller') == 'Schedules'){ echo 'active';} ?>">
            <a href="<?= $this->Url->build(['controller'=>'Schedules','action'=>'index']);?>">
                <span class="material-icons-outlined">today</span>
                <span class="icon-text">Agenda</span>
            </a>
        </li>
        <li class="<?php if($this->request->getParam('controller') == 'My'){ echo 'active';} ?>">
            <a href="<?= $this->Url->build(['controller'=>'My','action'=>'index']);?>">
                <span class="material-icons-outlined">perm_identity</span>
                <span class="icon-text">Meu Prontuário</span>
            </a>
        </li>
    </ul>
</nav>
