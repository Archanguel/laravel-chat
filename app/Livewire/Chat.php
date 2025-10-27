<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\Room;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    public $rooms = [];
    public $currentRoom = null;
    public $messages = [];
    public $body = '';
    public $maxChars = 250;

    protected $rules = [
        'body' => 'required|string|max:250',
    ];

    public function mount()
    {
        // Cargar las salas (pueden estar en la tabla rooms)
        $this->rooms = Room::all()->toArray();

        // Seleccionar la primera sala por defecto
        $first = Room::first();
        $this->currentRoom = $first ? $first->id : null;

        $this->loadMessages();
    }

    public function loadMessages()
    {
        if (!$this->currentRoom) {
            $this->messages = [];
            return;
        }

        // Traer mensajes de la sala actual con el nombre del usuario
        $this->messages = Message::with('user')
            ->where('room_id', $this->currentRoom)
            ->orderBy('created_at')
            ->get()
            ->map(fn($m) => [
                'id' => $m->id,
                'user_id' => $m->user_id,
                'user_name' => $m->user->name,
                'body' => $m->body,
                'edited' => $m->edited,
                'created_at' => $m->created_at->toDateTimeString(),
            ])
            ->toArray();
    }

    public function changeRoom($roomId)
    {
        $this->currentRoom = $roomId;
        $this->body = '';
        $this->loadMessages();
    }

    public function sendMessage()
    {
        $this->validate();

        if (!$this->currentRoom) return;

        $user = Auth::user();

        $message = Message::create([
            'user_id' => $user->id,
            'room_id' => $this->currentRoom,
            'body' => $this->body,
            'edited' => false,
        ]);

        // Limpiar input
        $this->body = '';

        // Agregarlo localmente
        $this->messages[] = [
            'id' => $message->id,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'body' => $message->body,
            'edited' => false,
            'created_at' => $message->created_at->toDateTimeString(),
        ];

        // Enviar a otros (Reverb)
        broadcast(new MessageSent($message))->toOthers();
    }

    public function clearChat()
    {
        if (!$this->currentRoom) return;

        Message::where('room_id', $this->currentRoom)->delete();
        $this->messages = [];
    }

    public function deleteMessage($id)
    {
        $message = Message::find($id);
        $user = Auth::user();

        // Solo puede borrar si está logueado y es su mensaje
        if ($message && $user && $message->user_id === $user->id) {
            $message->delete();
            $this->loadMessages();
        }
    }
    
    public $editingMessageId = null;
    public $editingMessageBody = '';

    public function startEdit($id, $body)
    {
        $this->editingMessageId = $id;
        $this->editingMessageBody = $body;
    }

    public function cancelEdit()
    {
        $this->editingMessageId = null;
        $this->editingMessageBody = '';
    }

    public function saveEdit($id)
    {
        $message = Message::find($id);
        $userId = Auth::id();
        
        if ($message && $userId && $message->user_id === $userId) {
            $message->update(['body' => $this->editingMessageBody, 'edited' => true]);
        }

        $this->editingMessageId = null;
        $this->editingMessageBody = '';
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
