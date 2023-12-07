<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */

use Cake\Core\Configure;

?>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users</h3>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-striped text-nowrap">
                    <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('name', ['label' => 'Nome']) ?></th>
                        <th><?= $this->Paginator->sort('username', ['label' => 'Email']) ?></th>
                        <th><?= $this->Paginator->sort('role', ['label' => 'Tipo']) ?></th>
                        <th><?= $this->Paginator->sort('active', ['label' => 'Ativo']) ?></th>
                        <th><?= $this->Paginator->sort('created', ['label' => 'Criado em']) ?></th>
                        <th><?= $this->Paginator->sort('modified', ['label' => 'Modificado em']) ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= h($user->name) ?></td>
                            <td><?= h($user->username) ?></td>
                            <td><?= Configure::read('ROLES')[$user->role] ?></td>
                            <td><?= $user->active ? 'Ativo' : 'Não ativo' ?></td>
                            <td><?= h($user->created) ?></td>
                            <td><?= h($user->modified) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <ul class="pagination pagination-sm">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
    </div>
</div>
