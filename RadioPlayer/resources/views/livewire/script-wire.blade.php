<div>
    <div id="Content" class="p-4">
        <div class="flex flex-col p-4 rounded-lg mt-16">
            <div class="flex justify-center w-full mb-10">
                <button
                    class="flex flex-col items-center justify-center bg-white border border-gray-300 rounded h-[6rem] w-[12rem] hover:border-[#d97f0d] hover:border-2 transition duration-200 ease-in-out select-none"
                    wire:click="addScript()">
                    <svg class="w-6 h-6 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 3v4a1 1 0 0 1-1 1H5m4 8h6m-6-4h6m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                    </svg>
                    <span>New Script</span>

                </button>
            </div>

            <div class="bg-black h-[10rem] w-full "></div>

            <div class="grid grid-cols-4 gap-y-28 gap-x-20 ">
                @foreach ($scriptdb as $s)
                    <div @click.prevent='$wire.editScript({{ $s->id }})'
                        class="col-span-1 flex flex-col items-center justify-center bg-white border border-gray-200 py-2 px-6 text-[0.75rem] cursor-pointer select-none">
                        <span class="text-gray-600 items-center text-lg h-full text-center mb-8 font-bold">{{ $s->date }}</span>
                            <div class="flex justify-left w-full text-gray-400 font-normal">
                                <span class="">Producer</span>
                                <span class="w-2 ms-5 me-2">:</span>
                                <span class="w-min truncate me-1"></span>
                                <button class=""></button>
                            </div>
                            <div class="flex justify-left w-full text-gray-400 font-normal">
                                <span class="">Announcer</span>
                                <span class="w-2 ms-2.5 me-2">:</span>
                                <span class="w-max truncate">{{ $s->announcer }}</span>
                            </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
