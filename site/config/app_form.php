<?php

return [
    'inputContainer'      => '<div class="form-outline">{{content}}<span class="help-message"></span></div>',
    'inputContainerError' => '<div class="form-outline value-error">{{content}}<span class="help-message"></span>{{error}}</div>',
    'label'               => '<label class="form-label body1">{{text}}</label>',
    'error'               => '<div class="error-message">{{content}}</div>',
    'formGroup'           => '{{input}}{{label}}',
    'input'               => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
];
