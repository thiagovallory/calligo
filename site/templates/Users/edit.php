<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Edit User') ?></legend>
                <?php
                    echo $this->Form->control('username');
                    echo $this->Form->control('password');
                    echo $this->Form->control('name');
                    echo $this->Form->control('role');
                    echo $this->Form->control('active');
                    echo $this->Form->control('ages._ids', ['options' => $ages]);
                    echo $this->Form->control('characteristics._ids', ['options' => $characteristics]);
                    echo $this->Form->control('langs._ids', ['options' => $langs]);
                    echo $this->Form->control('problems._ids', ['options' => $problems]);
                    echo $this->Form->control('specialties._ids', ['options' => $specialties]);
                    echo $this->Form->control('therapies._ids', ['options' => $therapies]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
