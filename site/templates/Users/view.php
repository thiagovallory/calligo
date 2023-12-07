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
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Password') ?></th>
                    <td><?= h($user->password) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($user->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= $this->Number->format($user->role) ?></td>
                </tr>
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= $this->Number->format($user->active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Ages') ?></h4>
                <?php if (!empty($user->ages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->ages as $ages) : ?>
                        <tr>
                            <td><?= h($ages->id) ?></td>
                            <td><?= h($ages->name) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Ages', 'action' => 'view', $ages->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Ages', 'action' => 'edit', $ages->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Ages', 'action' => 'delete', $ages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ages->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Characteristics') ?></h4>
                <?php if (!empty($user->characteristics)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->characteristics as $characteristics) : ?>
                        <tr>
                            <td><?= h($characteristics->id) ?></td>
                            <td><?= h($characteristics->name) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Characteristics', 'action' => 'view', $characteristics->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Characteristics', 'action' => 'edit', $characteristics->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Characteristics', 'action' => 'delete', $characteristics->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characteristics->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Langs') ?></h4>
                <?php if (!empty($user->langs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->langs as $langs) : ?>
                        <tr>
                            <td><?= h($langs->id) ?></td>
                            <td><?= h($langs->name) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Langs', 'action' => 'view', $langs->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Langs', 'action' => 'edit', $langs->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Langs', 'action' => 'delete', $langs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $langs->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Problems') ?></h4>
                <?php if (!empty($user->problems)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->problems as $problems) : ?>
                        <tr>
                            <td><?= h($problems->id) ?></td>
                            <td><?= h($problems->name) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Problems', 'action' => 'view', $problems->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Problems', 'action' => 'edit', $problems->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Problems', 'action' => 'delete', $problems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $problems->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Specialties') ?></h4>
                <?php if (!empty($user->specialties)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->specialties as $specialties) : ?>
                        <tr>
                            <td><?= h($specialties->id) ?></td>
                            <td><?= h($specialties->name) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Specialties', 'action' => 'view', $specialties->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Specialties', 'action' => 'edit', $specialties->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Specialties', 'action' => 'delete', $specialties->id], ['confirm' => __('Are you sure you want to delete # {0}?', $specialties->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Therapies') ?></h4>
                <?php if (!empty($user->therapies)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->therapies as $therapies) : ?>
                        <tr>
                            <td><?= h($therapies->id) ?></td>
                            <td><?= h($therapies->name) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Therapies', 'action' => 'view', $therapies->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Therapies', 'action' => 'edit', $therapies->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Therapies', 'action' => 'delete', $therapies->id], ['confirm' => __('Are you sure you want to delete # {0}?', $therapies->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Academic Backgrounds') ?></h4>
                <?php if (!empty($user->academic_backgrounds)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Class Name') ?></th>
                            <th><?= __('Institution') ?></th>
                            <th><?= __('Period Start') ?></th>
                            <th><?= __('Period End') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->academic_backgrounds as $academicBackgrounds) : ?>
                        <tr>
                            <td><?= h($academicBackgrounds->id) ?></td>
                            <td><?= h($academicBackgrounds->type) ?></td>
                            <td><?= h($academicBackgrounds->class_name) ?></td>
                            <td><?= h($academicBackgrounds->institution) ?></td>
                            <td><?= h($academicBackgrounds->period_start) ?></td>
                            <td><?= h($academicBackgrounds->period_end) ?></td>
                            <td><?= h($academicBackgrounds->status) ?></td>
                            <td><?= h($academicBackgrounds->created) ?></td>
                            <td><?= h($academicBackgrounds->modified) ?></td>
                            <td><?= h($academicBackgrounds->user_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'AcademicBackgrounds', 'action' => 'view', $academicBackgrounds->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'AcademicBackgrounds', 'action' => 'edit', $academicBackgrounds->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'AcademicBackgrounds', 'action' => 'delete', $academicBackgrounds->id], ['confirm' => __('Are you sure you want to delete # {0}?', $academicBackgrounds->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Modalities Has Users') ?></h4>
                <?php if (!empty($user->modalities_has_users)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Modality Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->modalities_has_users as $modalitiesHasUsers) : ?>
                        <tr>
                            <td><?= h($modalitiesHasUsers->id) ?></td>
                            <td><?= h($modalitiesHasUsers->modality_id) ?></td>
                            <td><?= h($modalitiesHasUsers->user_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ModalitiesHasUsers', 'action' => 'view', $modalitiesHasUsers->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ModalitiesHasUsers', 'action' => 'edit', $modalitiesHasUsers->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ModalitiesHasUsers', 'action' => 'delete', $modalitiesHasUsers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $modalitiesHasUsers->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Notifications') ?></h4>
                <?php if (!empty($user->notifications)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Sms Schedule') ?></th>
                            <th><?= __('Sms Msg') ?></th>
                            <th><?= __('Email Schedule') ?></th>
                            <th><?= __('Email Msg') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->notifications as $notifications) : ?>
                        <tr>
                            <td><?= h($notifications->id) ?></td>
                            <td><?= h($notifications->sms_schedule) ?></td>
                            <td><?= h($notifications->sms_msg) ?></td>
                            <td><?= h($notifications->email_schedule) ?></td>
                            <td><?= h($notifications->email_msg) ?></td>
                            <td><?= h($notifications->created) ?></td>
                            <td><?= h($notifications->modified) ?></td>
                            <td><?= h($notifications->user_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Notifications', 'action' => 'view', $notifications->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Notifications', 'action' => 'edit', $notifications->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Notifications', 'action' => 'delete', $notifications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notifications->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Payment Methods') ?></h4>
                <?php if (!empty($user->payment_methods)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Is Main') ?></th>
                            <th><?= __('Card Number') ?></th>
                            <th><?= __('Owner Name') ?></th>
                            <th><?= __('Owner Cpf') ?></th>
                            <th><?= __('Expiration Date') ?></th>
                            <th><?= __('Cvv') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->payment_methods as $paymentMethods) : ?>
                        <tr>
                            <td><?= h($paymentMethods->id) ?></td>
                            <td><?= h($paymentMethods->is_main) ?></td>
                            <td><?= h($paymentMethods->card_number) ?></td>
                            <td><?= h($paymentMethods->owner_name) ?></td>
                            <td><?= h($paymentMethods->owner_cpf) ?></td>
                            <td><?= h($paymentMethods->expiration_date) ?></td>
                            <td><?= h($paymentMethods->cvv) ?></td>
                            <td><?= h($paymentMethods->created) ?></td>
                            <td><?= h($paymentMethods->modified) ?></td>
                            <td><?= h($paymentMethods->user_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'PaymentMethods', 'action' => 'view', $paymentMethods->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'PaymentMethods', 'action' => 'edit', $paymentMethods->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'PaymentMethods', 'action' => 'delete', $paymentMethods->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paymentMethods->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Products') ?></h4>
                <?php if (!empty($user->products)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->products as $products) : ?>
                        <tr>
                            <td><?= h($products->id) ?></td>
                            <td><?= h($products->user_id) ?></td>
                            <td><?= h($products->name) ?></td>
                            <td><?= h($products->description) ?></td>
                            <td><?= h($products->type) ?></td>
                            <td><?= h($products->price) ?></td>
                            <td><?= h($products->created) ?></td>
                            <td><?= h($products->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $products->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $products->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $products->id], ['confirm' => __('Are you sure you want to delete # {0}?', $products->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Profiles') ?></h4>
                <?php if (!empty($user->profiles)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Birth Date') ?></th>
                            <th><?= __('Gender') ?></th>
                            <th><?= __('Pronoun') ?></th>
                            <th><?= __('Document Number') ?></th>
                            <th><?= __('Document Shipping Date') ?></th>
                            <th><?= __('Document Uf') ?></th>
                            <th><?= __('Telephone Number') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Crp') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->profiles as $profiles) : ?>
                        <tr>
                            <td><?= h($profiles->id) ?></td>
                            <td><?= h($profiles->birth_date) ?></td>
                            <td><?= h($profiles->gender) ?></td>
                            <td><?= h($profiles->pronoun) ?></td>
                            <td><?= h($profiles->document_number) ?></td>
                            <td><?= h($profiles->document_shipping_date) ?></td>
                            <td><?= h($profiles->document_uf) ?></td>
                            <td><?= h($profiles->telephone_number) ?></td>
                            <td><?= h($profiles->email) ?></td>
                            <td><?= h($profiles->created) ?></td>
                            <td><?= h($profiles->modified) ?></td>
                            <td><?= h($profiles->crp) ?></td>
                            <td><?= h($profiles->description) ?></td>
                            <td><?= h($profiles->user_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Profiles', 'action' => 'view', $profiles->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Profiles', 'action' => 'edit', $profiles->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Profiles', 'action' => 'delete', $profiles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $profiles->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Reviews') ?></h4>
                <?php if (!empty($user->reviews)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->reviews as $reviews) : ?>
                        <tr>
                            <td><?= h($reviews->id) ?></td>
                            <td><?= h($reviews->product_id) ?></td>
                            <td><?= h($reviews->user_id) ?></td>
                            <td><?= h($reviews->description) ?></td>
                            <td><?= h($reviews->created) ?></td>
                            <td><?= h($reviews->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Reviews', 'action' => 'view', $reviews->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Reviews', 'action' => 'edit', $reviews->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reviews', 'action' => 'delete', $reviews->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reviews->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Type Of Services') ?></h4>
                <?php if (!empty($user->type_of_services)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('By Phone Call') ?></th>
                            <th><?= __('By Video Call') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->type_of_services as $typeOfServices) : ?>
                        <tr>
                            <td><?= h($typeOfServices->id) ?></td>
                            <td><?= h($typeOfServices->by_phone_call) ?></td>
                            <td><?= h($typeOfServices->by_video_call) ?></td>
                            <td><?= h($typeOfServices->created) ?></td>
                            <td><?= h($typeOfServices->modified) ?></td>
                            <td><?= h($typeOfServices->user_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'TypeOfServices', 'action' => 'view', $typeOfServices->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'TypeOfServices', 'action' => 'edit', $typeOfServices->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'TypeOfServices', 'action' => 'delete', $typeOfServices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $typeOfServices->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
