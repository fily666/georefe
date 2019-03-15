<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ma Groups'), ['controller' => 'MaGroups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ma Group'), ['controller' => 'MaGroups', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ma General'), ['controller' => 'MaGeneral', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ma General'), ['controller' => 'MaGeneral', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Devices'), ['controller' => 'Devices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Device'), ['controller' => 'Devices', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Person') ?></th>
            <td><?= $user->has('person') ? $this->Html->link($user->person->name, ['controller' => 'People', 'action' => 'view', $user->person->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Ma Group') ?></th>
            <td><?= $user->has('ma_group') ? $this->Html->link($user->ma_group->name, ['controller' => 'MaGroups', 'action' => 'view', $user->ma_group->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Urlphoto') ?></th>
            <td><?= h($user->urlphoto) ?></td>
        </tr>
        <tr>
            <th><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $user->has('user') ? $this->Html->link($user->user->id, ['controller' => 'Users', 'action' => 'view', $user->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Ma General') ?></th>
            <td><?= $user->has('ma_general') ? $this->Html->link($user->ma_general->id, ['controller' => 'MaGeneral', 'action' => 'view', $user->ma_general->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
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
        <h4><?= __('Related Devices') ?></h4>
        <?php if (!empty($user->devices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Device Type Id') ?></th>
                <th><?= __('Serial Number') ?></th>
                <th><?= __('Reference') ?></th>
                <th><?= __('Brand Id') ?></th>
                <th><?= __('Purchase Price') ?></th>
                <th><?= __('Purchase Date') ?></th>
                <th><?= __('Number Policy') ?></th>
                <th><?= __('Value Policy') ?></th>
                <th><?= __('Urlphoto') ?></th>
                <th><?= __('Creator Id') ?></th>
                <th><?= __('Status Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->devices as $devices): ?>
            <tr>
                <td><?= h($devices->id) ?></td>
                <td><?= h($devices->device_type_id) ?></td>
                <td><?= h($devices->serial_number) ?></td>
                <td><?= h($devices->reference) ?></td>
                <td><?= h($devices->brand_id) ?></td>
                <td><?= h($devices->purchase_price) ?></td>
                <td><?= h($devices->purchase_date) ?></td>
                <td><?= h($devices->number_policy) ?></td>
                <td><?= h($devices->value_policy) ?></td>
                <td><?= h($devices->urlphoto) ?></td>
                <td><?= h($devices->creator_id) ?></td>
                <td><?= h($devices->status_id) ?></td>
                <td><?= h($devices->created) ?></td>
                <td><?= h($devices->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Devices', 'action' => 'view', $devices->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Devices', 'action' => 'edit', $devices->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Devices', 'action' => 'delete', $devices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $devices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
