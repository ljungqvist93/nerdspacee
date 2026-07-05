<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reverb WebSocket Live Editor</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <h1>Live WebSocket Message Editor</h1>

    <input type="text" id="message-input" value="Hello World" style="width: 300px;" />

    <p><strong>Live Output:</strong></p>
    <div id="output" style="font-size: 1.5rem; color: green;"></div>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const pusher = new Pusher('local', {
            wsHost: 'cashsmash.app',
            wsPort: 443,
            wssPort: 443,
            forceTLS: true,
            disableStats: true,
            enabledTransports: ['ws', 'wss'],
        });
        const channel = pusher.subscribe('test-channel');

        channel.bind('message.sent', function (data) {
            console.log('[Reverb] Received:', data.message);
            document.getElementById('output').textContent = data.message;

            const input = document.getElementById('message-input');
            if (input.value !== data.message) {
                input.value = data.message;
            }
        });

        const input = document.getElementById('message-input');

        input.addEventListener('input', async (e) => {
            const message = e.target.value;

            console.log('[Sender] Sending:', message);

            await fetch('/broadcast-test', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ message })
            });
        });

        pusher.connection.bind('connected', function () {
            console.log('✅ CONNECTED TO REVERB');
        });

        pusher.connection.bind('error', function (err) {
            console.error('❌ CONNECTION ERROR:', err);
        });
    </script>
</body>

</html>