<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div class="toast-container position-fixed bottom-0 end-0 p-3 component" cp-name="toast">
    <div class="toast align-items-center bg-success text-white" id="toast-element" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header text-success">
            <span class="material-icons-outlined toast-icon">check_circle</span>
            <strong class="me-auto toast-title">Sucesso!</strong>
            <button type="button" class="material-icons toast-close" data-bs-dismiss="toast" aria-label="Close">close</button>
        </div>
        <div class="toast-body"><?= $message ?></div>
    </div>
</div>
