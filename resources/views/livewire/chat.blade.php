<div class="flex h-[calc(100vh-162px)] w-full">
    <!-- Left: salas -->
    <div class="w-[10%] border-r p-3 flex-shrink-0 h-full overflow-auto">
        <h3 class="font-bold mb-3">Salas</h3>
        @foreach($rooms as $room)
            <div wire:click="changeRoom({{ $room['id'] }})"
                class="cursor-pointer p-2 mb-1 rounded {{ $currentRoom == $room['id'] ? 'bg-gray-300' : 'bg-gray-100' }}">
                <div class="flex items-center">
                    <div class="h-3 w-3 rounded-full mr-2 flex-shrink-0" style="background: {{ $room['color'] ?? '#ccc' }}"></div>
                    <div class="truncate min-w-0" title="{{ $room['name'] }}">
                        {{ $room['name'] }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Center: chat -->
    <div class="w-[80%] flex-1 flex flex-col p-3 min-h-0">

        <!-- Nombre de la sala -->
        <div class="mb-2 p-2 border-b font-bold text-lg">
            {{ $rooms[array_search($currentRoom, array_column($rooms, 'id'))]['name'] ?? 'Sin sala' }}
        </div>

        <div id="messages" class="flex-1 overflow-auto mb-3 p-2 border rounded">
            @foreach($messages as $m)
                <div class="mb-2 flex {{ $m['user_id'] == auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="p-2 rounded-lg relative break-words"
                        style="background: {{ $m['user_id'] == auth()->id() ? '#DCF8C6' : '#FFF' }}; max-width: 100%;">
                        
                        <div class="text-xs font-bold text-gray-600">{{ $m['user_name'] }}</div>

                        @if($editingMessageId === $m['id'])
                            <input type="text" wire:model.defer="editingMessageBody" class="border p-1 w-full rounded" />
                            <div class="flex justify-end mt-1">
                                <button wire:click="saveEdit({{ $m['id'] }})" class="text-green-600 text-sm ml-1" title="Guardar">💾</button>
                                <button wire:click="cancelEdit" class="text-red-600 text-sm ml-1" title="Cancelar">❌</button>
                            </div>
                        @else
                            <div class="mt-1">{{ $m['body'] }}</div>
                        @endif

                        <div class="text-xs text-gray-400 mt-1">
                            {{ $m['created_at'] }}
                        </div>
                        @if($m['edited'])
                            <div class="text-xs italic text-gray-400">editado</div>
                        @endif

                        @if(auth()->id() === $m['user_id'] && $editingMessageId !== $m['id'])
                            <div class="absolute top-1 right-1 flex space-x-1">
                                <button wire:click="startEdit({{ $m['id'] }}, '{{ addslashes($m['body']) }}')"
                                        class="text-blue-500 text-sm" title="Editar">✏️</button>
                                <button wire:click="deleteMessage({{ $m['id'] }})"
                                        class="text-red-500 text-sm" title="Borrar">🗑️</button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div> 

        <form wire:submit.prevent="sendMessage" class="flex flex-col">
            <div class="flex">
                <input wire:model="body" class="border p-2 flex-1 rounded" placeholder="Escribe..."  maxlength="{{ $maxChars }}" />
                <button type="submit" class="ml-2 px-4 bg-blue-600 text-white rounded">Enviar</button>
            </div>
            <div class="text-right text-xs text-gray-500 mt-1">
                <span id="charCount">0</span>/{{ $maxChars }}
            </div>
        </form>
    </div>

    <!-- Right: usuarios -->
    <div class="w-[10%] border-l p-3 flex-shrink-0 h-full overflow-auto">
        <h3 class="font-bold mb-3">Usuarios en la sala</h3>
        @php
            $usersInRoom = collect($messages)->pluck('user_name')->unique();
        @endphp
        @foreach($usersInRoom as $u)
            <div class="p-1 truncate" title="{{ $u }}">{{ $u }}</div>
        @endforeach
    </div>

    <style>
        #messages { scroll-behavior: smooth; }
    </style>

    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.hook('message.processed', (message, component) => {
                const el = document.getElementById('messages');
                if (el) el.scrollTop = el.scrollHeight;
            });
        });

        document.addEventListener('input', e => {
            if (e.target.hasAttribute('wire:model')) {
                const input = e.target;
                const countEl = document.getElementById('charCount');
                if (countEl) countEl.textContent = input.value.length;
            }
        });
    </script>
</div>
