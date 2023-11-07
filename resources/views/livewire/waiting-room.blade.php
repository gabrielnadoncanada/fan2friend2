
<div>
    <h3>Waiting Room Queue</h3>
    <ul>

        @foreach ($waitingRoomEntries as $entry)

            <li>{{ $entry->orderItem->order->customer->name }} - {{ $entry->status }}</li>
        @endforeach
    </ul>


    <div>
        <h4>Your Position in Queue:</h4>
        <p>{{ $currentPosition }}</p>
    </div>


    <script>
        document.addEventListener('livewire:initialized', () => {

            window.addEventListener('beforeunload', () => {
                Livewire.dispatch('removeFromWaitingRoom')
            });

        });
    </script>
</div>
