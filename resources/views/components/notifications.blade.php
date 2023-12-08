<div
    x-data="{
        messages: [],
        remove(mid) {
            $dispatch('close-me', {id: mid})
            let m = this.messages.filter((m) => { return m.id == mid })
            if (m.length) {
                setTimeout(() => {this.messages.splice(this.messages.indexOf(m[0]), 1)}, 2000)
            }
        },
    }"
    @notify.window="let mid = Date.now(); messages.push({id: mid, msg: $event.detail[0]});console.log($event.detail); setTimeout(() => { remove(mid) }, 2500)"
    class="z-50 fixed inset-0 flex flex-col items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:justify-start space-y-4"
>
    <template x-for="(message, messageIndex) in messages" :key="messageIndex" hidden>
        <div
            x-data="{ id: message.id, show: false }"
            x-init="$nextTick(() => { show = true })"
            x-show="show"
            @close-me.window="if ($event.detail.id == id) {show=false}"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto"
        >
            <div class="rounded-lg shadow-lg overflow-hidden">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <img :src="'/svg/status/' + message.msg.type + '.svg'" alt="">
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p x-text="message.msg.title" class="text-sm font-medium text-gray-900"></p>
                            <p x-text="message.msg.description" class="mt-1 text-sm text-gray-500"></p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex" x-init="console.log(message)">
                            <button @click="remove(message.id)" class="inline-flex text-gray-400 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150">
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>