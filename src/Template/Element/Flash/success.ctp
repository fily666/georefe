<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div role="alert" class="alert alert-success" onclick="this.classList.add('hidden');">
    <button type="button" data-dismiss="alert" aria-label="Close" class="close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Mensaje del Sistema: </strong><?= $message ?>
</div>

