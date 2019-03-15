<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ma Group'), ['action' => 'edit', $maGroup->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ma Group'), ['action' => 'delete', $maGroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $maGroup->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ma Groups'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ma Group'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ma General'), ['controller' => 'MaGeneral', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ma General'), ['controller' => 'MaGeneral', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ma Actions'), ['controller' => 'MaActions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ma Action'), ['controller' => 'MaActions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="maGroups view large-9 medium-8 columns content">
    <h3><?= h($maGroup->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($maGroup->name) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $maGroup->has('user') ? $this->Html->link($maGroup->user->id, ['controller' => 'Users', 'action' => 'view', $maGroup->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Ma General') ?></th>
            <td><?= $maGroup->has('ma_general') ? $this->Html->link($maGroup->ma_general->id, ['controller' => 'MaGeneral', 'action' => 'view', $maGroup->ma_general->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($maGroup->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($maGroup->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($maGroup->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Ma Actions') ?></h4>
        <?php if (!empty($maGroup->ma_actions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Url') ?></th>
                <th><?= __('Controller Id') ?></th>
                <th><?= __('Creator Id') ?></th>
                <th><?= __('Status Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($maGroup->ma_actions as $maActions): ?>
            <tr>
                <td><?= h($maActions->id) ?></td>
                <td><?= h($maActions->name) ?></td>
                <td><?= h($maActions->url) ?></td>
                <td><?= h($maActions->controller_id) ?></td>
                <td><?= h($maActions->creator_id) ?></td>
                <td><?= h($maActions->status_id) ?></td>
                <td><?= h($maActions->created) ?></td>
                <td><?= h($maActions->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MaActions', 'action' => 'view', $maActions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MaActions', 'action' => 'edit', $maActions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MaActions', 'action' => 'delete', $maActions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $maActions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
