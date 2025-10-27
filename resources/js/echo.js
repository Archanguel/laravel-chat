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

window.Echo.channel('chat').listen('MessageSent', (e) => {
    // e contiene id, user_name, body, created_at según broadcastWith()
    // emitimos un evento para que Livewire o Alpine lo capture
    window.dispatchEvent(new CustomEvent('realtime-message', { detail: e }));
});
