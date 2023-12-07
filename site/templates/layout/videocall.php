<?php use Cake\Routing\Router;?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?> - Calligo
    </title>
    <?= $this->Html->meta('icon', 'favicon.png') ?>
    <style>
        html {
            position: relative;
            width: 100%;
            height: 100%;
        }
        .remote-stream {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: #363644;
        }

        .remote-stream video {
            width: 100%;
            height: 100%;
        }

        .local-stream {
            position: absolute;
            width: 25%;
            bottom: 0;
            left: 0;
            background: #000;
        }

        .local-stream:before {
            content: '';
            display: block;
            padding-top: 75%;
        }
        
        .local-stream video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .controls {
            position: absolute;
            display: flex;
            justify-content: center;
            left: 25%;
            right: 25%;
            bottom: 0;
            padding: 48px 16px;
        }

        .controls button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            margin: 0 32px;
            border-radius: 50%;
            border: 0;
            overflow: hidden;
            text-indent: -9999px;
            cursor: pointer;
        }

        .controls button svg {
            display: block;
        }

        .toggle-microphone {
            background: #5C02FF;
        }

        .toggle-video {
            background: #5C02FF;
        }

        .toggle-microphone .icon-disabled,
        .toggle-video .icon-disabled {
            display: block;
        }

        .toggle-microphone .icon-enabled,
        .toggle-video .icon-enabled {
            display: none;
        }

        .toggle-microphone.-active .icon-enabled,
        .toggle-video.-active .icon-enabled {
            display: block;
        }

        .toggle-microphone.-active .icon-disabled,
        .toggle-video.-active .icon-disabled {
            display: none;
        }

        .end-call {
            background: #fff;
        }

        .end-call svg path {
            fill: #AA223A;
        }

        .end-call:hover,
        .end-call:active {
            background: #AA223A;
        }

        .end-call:hover svg path,
        .end-call:active svg path {
            fill: #fff;
        }
        
        
    </style>
    <script src="//sdk.twilio.com/js/video/releases/2.17.0/twilio-video.min.js"></script>
</head>
<body>
	<script>var _BASE_URL_ = "<?php echo Router::url("/", false);?>";</script>
    <?= $this->fetch('content') ?>
</body>
</html>
