import Echo from 'laravel-echo';

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY ?? 'local-app-key',
    wsHost: import.meta.env.VITE_REVERB_HOST ?? '127.0.0.1',
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 6001,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 6001,
    forceTLS: false,
    enabledTransports: ['ws', 'wss'],
});

// Canal de mensajes
window.Echo.channel('chat').listen('.message.sent', (e) => {
    window.dispatchEvent(new CustomEvent('realtime-message', { detail: e.message }));
});

// Canal de presencia
window.Echo.join('presence-chatroom')
    .here(users => window.dispatchEvent(new CustomEvent('update-users', { detail: users })))
    .joining(user => window.dispatchEvent(new CustomEvent('add-user', { detail: user })))
    .leaving(user => window.dispatchEvent(new CustomEvent('remove-user', { detail: user })));
