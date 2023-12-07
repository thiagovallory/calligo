<div class="remote-stream"></div>
<div class="local-stream"></div>
<div class="controls">
    <button class="toggle-microphone" title="Alternar microfone">
        <span class="icon-enabled">
            <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3Z" fill="#fff"/><path d="M17 11c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2Z" fill="#fff"/></svg>
        </span>
        <span class="icon-disabled">
            <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.8 4.9c0-.66.54-1.2 1.2-1.2.66 0 1.2.54 1.2 1.2l-.01 3.91L15 10.6V5c0-1.66-1.34-3-3-3-1.54 0-2.79 1.16-2.96 2.65l1.76 1.76V4.9ZM19 11h-1.7c0 .58-.1 1.13-.27 1.64l1.27 1.27c.44-.88.7-1.87.7-2.91ZM4.41 2.86 3 4.27l6 6V11c0 1.66 1.34 3 3 3 .23 0 .44-.03.65-.08l1.66 1.66c-.71.33-1.5.52-2.31.52-2.76 0-5.3-2.1-5.3-5.1H5c0 3.41 2.72 6.23 6 6.72V21h2v-3.28a7.13 7.13 0 0 0 2.55-.9l4.2 4.2 1.41-1.41L4.41 2.86Z" fill="#fff"/></svg>
        </span>
    </button>
    <button class="toggle-video" title="Alternar video">
        <span class="icon-enabled">
            <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 8v8H5V8h10Zm1-2H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4V7c0-.55-.45-1-1-1Z" fill="#fff"/></svg>
        </span>
        <span class="icon-disabled">
            <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m9.56 8-2-2-4.15-4.14L2 3.27 4.73 6H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.21 0 .39-.08.55-.18L19.73 21l1.41-1.41-8.86-8.86L9.56 8ZM5 16V8h1.73l8 8H5Zm10-8v2.61l6 6V6.5l-4 4V7c0-.55-.45-1-1-1h-5.61l2 2H15Z" fill="#fff"/></svg>
        </span>
    </button>
    <button class="end-call" title="Encerrar chamada">
        <span>
            <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.59 10.52c1.05.51 2.04 1.15 2.96 1.91l-1.07 1.07c-.58-.47-1.21-.89-1.88-1.27v-1.71h-.01Zm-13.19 0v1.7c-.65.37-1.28.79-1.87 1.27l-1.07-1.07c.91-.75 1.9-1.38 2.94-1.9ZM12 7C7.46 7 3.34 8.78.29 11.67c-.18.18-.29.43-.29.71 0 .28.11.53.29.7l2.48 2.48c.18.18.43.29.71.29.27 0 .52-.1.7-.28.79-.73 1.68-1.36 2.66-1.85.33-.16.56-.51.56-.9v-3.1C8.85 9.25 10.4 9 12 9c1.6 0 3.15.25 4.59.73v3.1c0 .4.23.74.56.9.98.49 1.88 1.11 2.67 1.85.18.17.43.28.7.28.28 0 .53-.11.71-.29l2.48-2.48c.18-.18.29-.43.29-.71 0-.28-.11-.53-.29-.71A16.971 16.971 0 0 0 12 7Z" fill="#fff"/></svg>
        </span>
    </button>
</div>
<script>
    (function () {
        let room = null;
        let tracks = null;
        const localStream = document.querySelector(".local-stream");
        const remoteStream = document.querySelector(".remote-stream");
        const toggleMicrophoneButton = document.querySelector(".toggle-microphone");
        const toggleVideoButton = document.querySelector(".toggle-video");
        const endCallButton = document.querySelector(".end-call");

        function getTrackByType(type) {
            return tracks && tracks.find(function(track){
                return track.kind === type
            })
        }

        function enableVideoTrack() {
            const localVideoTrack = getTrackByType('video');
            localVideoTrack.isStopped ? localVideoTrack.restart() : localStream.appendChild(localVideoTrack.attach());
            toggleVideoButton.classList.add('-active');
            toggleVideoButton.removeEventListener("click", enableVideoTrack);
            toggleVideoButton.addEventListener("click", disableVideoTrack);
        }

        function disableVideoTrack() {
            const localVideoTrack = getTrackByType('video');
            localVideoTrack.stop();
            toggleVideoButton.classList.remove('-active');
            toggleVideoButton.removeEventListener("click", disableVideoTrack);
            toggleVideoButton.addEventListener("click", enableVideoTrack);
        }

        function enableAudioTrack() {
            const localAudioTrack = getTrackByType('audio');
            localAudioTrack.isStopped && localAudioTrack.restart();
            toggleMicrophoneButton.classList.add('-active');
            toggleMicrophoneButton.removeEventListener("click", enableAudioTrack);
            toggleMicrophoneButton.addEventListener("click", disableAudioTrack);
        }

        function disableAudioTrack() {
            const localAudioTrack = getTrackByType('audio');
            localAudioTrack.stop();
            toggleMicrophoneButton.classList.remove('-active');
            toggleMicrophoneButton.removeEventListener("click", disableAudioTrack);
            toggleMicrophoneButton.addEventListener("click", enableAudioTrack);
        }

        function participantConnected(participant) {
            participant.on('trackSubscribed', function(track) {
                remoteStream.appendChild(track.attach());
            });
            participant.on('trackUnsubscribed', function(track){
                track.detach().forEach(function(element) {
                    element.remove()
                });
            });
            participant.tracks.forEach(function(publication) {
                if (publication.isSubscribed) {
                    remoteStream.appendChild(publication.track.attach());
                }
            });
        }

        function participantDisconnected(participant) {
            remoteStream.replaceChildren();
        }

        function connectRoom() {
            Twilio.Video.connect('<?= $tokenJWT; ?>', {
                name: '<?= $roomName; ?>',
                tracks: tracks
            }).then(result => {
                room = result;

                room.participants.forEach(participantConnected);
                room.on('participantConnected', participantConnected);

                room.on('participantDisconnected', participantDisconnected);
                room.once('disconnected', function(error) {
                    room.participants.forEach(participantDisconnected)
                });
            });
        }

        function endCallHandler() {
            window.close();
        }

        function disconnectRoom() {
            room && room.disconnect && room.disconnect();
        }

        function initializeHandler() { 
            Twilio.Video.createLocalTracks({
                audio: true,
                video: { facingMode: 'user' }
            }).then(function(localTracks) {
                tracks = localTracks;
                enableVideoTrack();
                enableAudioTrack();
                connectRoom();
            }, function(error) {
                alert(error);
            });
        }

        endCallButton.addEventListener("click", endCallHandler);
        window.addEventListener('beforeunload', disconnectRoom);
        window.addEventListener('pagehide', disconnectRoom);

        initializeHandler();
    })();
</script>