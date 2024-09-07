<div>
    <div x-data="{ songopen: false }" class="relative">
        {{-- Menampilkan Folder/songcategory --}}
        @if ($folders->isnotempty())
            <div :class="songopen ? 'grid grid-cols-4 gap-8' : 'p-4'" >
                <div :class="songopen ? 'col-span-2' : ''"
                    class="p-4 rounded-lg bg-[#FAFAFA] h-min mt-24 mx-8 shadow-lg">
                    <div :class="songopen ? 'grid-cols-3' : 'grid-cols-5'" class="grid  gap-8 mb-1" id="folder-place">
                        @foreach ($folders as $folder)
                            <div x-data="{ open: false }" class="relative">
                                <div class="flex items-center justify-center h-200 w-100 rounded"
                                    @contextmenu.prevent="open = !open">
                                    <div class="flex flex-col">
                                        <button class="flex text-2xl justify-center text-gray-400 dark:text-gray-500 button-songopen"
                                            wire:click="saveFolderIsOpen({{ $folder }})"; @click="songopen=true">
                                            <svg :class="songopen ? 'w-[100px] h-[100px]' : 'w-[140px] h-[140px]'"
                                                class=" text-[#804800]" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="138" height="138"
                                                fill="currentColor" viewBox="0 0 138 138">
                                                <path
                                                    d="M51.75 17.25C53.0138 17.2499 54.2425 17.6662 55.246 18.4345L55.821 18.9348L71.3805 34.5H109.25C113.65 34.4998 117.884 36.1809 121.085 39.1994C124.286 42.2179 126.213 46.3456 126.471 50.738L126.5 51.75V97.75C126.5 102.15 124.819 106.384 121.801 109.585C118.782 112.786 114.654 114.713 110.262 114.971L109.25 115H28.75C24.35 115 20.1163 113.319 16.915 110.301C13.7137 107.282 11.7869 103.154 11.5288 98.762L11.5 97.75V34.5C11.4998 30.1 13.1809 25.8663 16.1994 22.665C19.2179 19.4637 23.3456 17.5369 27.738 17.2788L28.75 17.25H51.75Z"
                                                    fill="#804800" />
                                            </svg>
                                        </button>
                                        <div class="grid grid-flow-row-dense grid-cols-8">
                                            <p class="col-span-7 text-center select-none">{{ $folder->name }}</p>

                                            <button type="button" @click="open=!open"
                                                class="self-start justify-self-end">
                                                <svg class="w-6 h-6 text-black" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                        d="M12 6h.01M12 12h.01M12 18h.01" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Dropdown menu -->
                                <div x-show="open" @click.away="open = false" @contextmenu.away="open = false"
                                    class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg z-50"
                                    style="display: none;">
                                    <div x-data="{ renameModal: false }" class="relative">
                                        <button @click="renameModal= true"
                                            class="flex justify-between px-4 py-2 w-full text-black hover:bg-gray-100">
                                            <span>Rename</span>
                                            <svg class="w-6 h-6 text-[#804800]" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                                    clip-rule="evenodd" />
                                                <path fill-rule="evenodd"
                                                    d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                        </button>


                                        <div x-show="renameModal"
                                            class="fixed inset-0 flex items-center justify-center z-50">
                                            <div
                                                class="bg-white basis-1/3 p-6 rounded-lg shadow-lg mx-auto select-none">
                                                <h2 class="text-xl font-semibold mb-4">Rename
                                                </h2>
                                                <input type="text" id="folderNameInput{{ $folder->id }}"
                                                    class="mb-5 w-full border-2 border-black transition ease-in-out delay-50 focus:outline-none focus:border-blue-500 px-2 rounded-lg"
                                                    value="{{ $folder->name }}" autocomplete="off">
                                                <div class="flex justify-end space-x-4">
                                                    @if (session()->has('renameError'))
                                                        {{ session('renameError') }}
                                                    @elseif(session()->has('renameSuccess'))
                                                        {{ session('renameSuccess') }}
                                                    @endif
                                                    <button
                                                        @click="     = false; document.getElementById('folderNameInput{{ $folder->id }}').value = '{{ $folder->name }}';"
                                                        wire:click="resetAllSessions()"
                                                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                                                    <button @click=" renameModal = true"
                                                        wire:click="renameFolder({{ $folder }}, document.getElementById('folderNameInput{{ $folder->id }}').value)"
                                                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Oke</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Background Overlay -->
                                        <div x-show="renameModal" class="fixed inset-0 bg-black opacity-50 z-40"></div>
                                    </div>

                                    <div x-data="{ showSong: false }">
                                        <!-- Delete Button -->
                                        <a href="#" @click.prevent="showSong = true"
                                            class="flex justify-between px-4 py-2 text-red-600 hover:bg-gray-100">
                                            <span>Delete</span>
                                            <svg class="w-6 h-6 text-red-800" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>

                                        <!-- Modal -->
                                        <div x-show="showSong"
                                            class="fixed inset-0 flex items-center justify-center z-50">
                                            <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm mx-auto">
                                                <h2 class="text-xl font-semibold mb-4">Are you sure you want to delete?
                                                </h2>
                                                <div class="flex justify-end space-x-4">
                                                    <button @click="showSong = false"
                                                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                                                    <button @click="open = false"
                                                        wire:click="delete({{ $folder }})"
                                                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Background Overlay -->
                                        <div x-show="showSong" @click.away="showSong = false"
                                            class="fixed inset-0 bg-black opacity-50 z-40"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- Tampilan Song berdasarkan folder/songcategory -->
                <div x-show="songopen" class="col-span-2    ">
                    <div
                        class="fixed inset-4 ms-auto  mt-24 z-20 bg-white w-2/5 h-auto p-6 rounded-lg bg-[#FAFAFA] shadow-lg overflow-y-auto select-none">
                        <div class="flex flex-col">
                            <div class="flex text-center mb-8">
                                <button data-modal-target="song-modal" data-modal-toggle="song-modal"><svg
                                        class="w-[30px] h-[30px] text-[#804800] hover:text-[#D77900]"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M5 12h14m-7 7V5"></path>
                                    </svg>
                                </button>
                                <span class=" w-full">
                                    @if ($FolderIsOpen != null)
                                        {{ $FolderIsOpen['name'] }}
                                    @endif
                                </span>
                                <button @click="songopen = false" class=""><svg class="w-6 h-6 text-gray-800"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                    </svg>
                                </button>
                            </div>
                            <div x-data="{ moveFolderModal: false }" class="relative">
                                @foreach ($this->SongIsOpen as $song)
                                    {{-- {{ dd($this->SongIsOpen) }} --}}
                                    <div class="flex p-4 mt-8 w-50 h-100 border border-lg border-slate-300 rounded-lg">
                                        <div class="flex-col truncate me-5">
                                            {{-- <div class="truncate"> {{ $song->name }}</div> --}}
                                            <input type="text" wire:model="songName.{{ $loop->index }}"
                                                class="flex truncate w-screen select-none focus:outline-none"
                                                wire:keydown.enter="renameSong({{ $song }}, {{ $loop->index }})"
                                                readonly="true" ondblclick="enableEdit(this);"
                                                onblur="disableEdit(this);" onkeydown="handleKeyDown(event, this);"
                                                readonly>
                                            <div class="mt-2 text-sm text-slate-600">
                                                {{ $this->convertSongLength($song->length) }}
                                            </div>
                                        </div>
                                        <div class="flex ms-auto">
                                            <audio id="myAudio-{{ $song->id }}" class="bg-none" preload="none">
                                                <source src="{{ Storage::url($song->path) }}">
                                            </audio>
                                            <button id="playPauseButton-{{ $song->id }}"
                                                onclick="playandpause({{ $song->id }})"><svg
                                                    class="w-6 h-6 text-gray-800 " aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M8.6 5.2A1 1 0 0 0 7 6v12a1 1 0 0 0 1.6.8l8-6a1 1 0 0 0 0-1.6l-8-6Z"
                                                        clip-rule="evenodd" />
                                                </svg></button>
                                            <button onclick="reloadAudio({{ $song->id }})"><svg
                                                    class="w-6 h-6 text-gray-800" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4" />
                                                </svg>
                                            </button>
                                            <div x-data="{ songMenuOpen: false }" class="relative flex">
                                                <button @click="songMenuOpen = !songMenuOpen">
                                                    <svg class="w-6 h-6 text-black" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-width="2" d="M12 6h.01M12 12h.01M12 18h.01"></path>
                                                    </svg>
                                                </button>

                                                <!-- Dropdown Menu -->
                                                <div x-show="songMenuOpen" @click.away="songMenuOpen = false"
                                                    class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg z-50">

                                                    <button wire:click='setSongMoveId({{ $song->id }})'
                                                        @click.prevent="moveFolderModal = true; songMenuOpen = false"
                                                        class="flex justify-between px-4 py-2 w-full text-black hover:bg-gray-100"><span>Move</span>
                                                        <svg class="w-6 h-6 text-[#804800]" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M5 4a2 2 0 0 0-2 2v1h10.968l-1.9-2.28A2 2 0 0 0 10.532 4H5ZM3 19V9h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm11.707-7.707a1 1 0 0 0-1.414 1.414l.293.293H8a1 1 0 1 0 0 2h5.586l-.293.293a1 1 0 0 0 1.414 1.414l2-2a1 1 0 0 0 0-1.414l-2-2Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>


                                                    <div x-data="{ songWarning: false }">
                                                        <!-- Delete Button -->
                                                        <a href="#" @click.prevent="songWarning = true"
                                                            class="flex justify-between px-4 py-2 text-red-600 hover:bg-gray-100">
                                                            <span>Delete</span>
                                                            <svg class="w-6 h-6 text-red-800" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" fill="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path fill-rule="evenodd"
                                                                    d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </a>

                                                        <!-- Modal -->
                                                        <div x-show="songWarning"
                                                            class="fixed inset-0 flex items-center justify-center z-50">
                                                            <div
                                                                class="bg-white p-6 rounded-lg shadow-lg max-w-sm mx-auto">
                                                                <h2 class="text-xl font-semibold mb-4">Are you sure you
                                                                    want to
                                                                    delete?
                                                                </h2>
                                                                <div class="flex justify-end space-x-4">
                                                                    <button @click="songWarning = false"
                                                                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                                                                    <button
                                                                        @click="songWarning = false; songMenuOpen = false "
                                                                        wire:click="deleteSong({{ $song }})"
                                                                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Background Overlay -->
                                                        <div x-show="songWarning" @click.away="songWarning = false"
                                                            class="fixed inset-0 bg-black opacity-50 z-40"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                @endforeach
                                <div x-show="moveFolderModal"
                                    class="fixed inset-1 flex justify-center items-center z-50">
                                    <div class="flex bg-gray-200 h-3/4 w-2/4 p-8">
                                        <div class="flex flex-col h-min w-full">
                                            <div class="flex flex-row mb-8">
                                                <input wire:model="songMoveSearch"
                                                    wire:keydown.enter="searchFolderForMoveSong()" type="text"
                                                    class="bg-white border border-gray-300 me-8 h-min text-gray-900 text-start text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 h-min w-full pl-10 p-2.5 py-2.5"
                                                    placeholder="Search Folder" value="">
                                                <button wire:click="unsetSongMoveId()"
                                                    @click.prevent="moveFolderModal = false">
                                                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M6 18 17.94 6M18 18 6.06 6"></path>
                                                    </svg>
                                                </button>
                                            </div>


                                            @if (!empty($this->searchFoundFolder))
                                                <div class="flex flex-col h-[26rem] overflow-y-auto">
                                                    @foreach ($this->searchFoundFolder as $folder)
                                                        @if ($folder->id != $this->FolderIsOpen['id'])
                                                            <button @click.prevent="moveFolderModal = false"
                                                                class="flex justify-left items-center p-4 mb-1 hover:bg-gray-300 rounded"
                                                                wire:click="moveSong({{ $folder->id }})">
                                                                <div class="flex flex-row">
                                                                    <svg class="w-[50px] h-[50px] text-[#804800] me-4"
                                                                        aria-hidden="true"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="138" height="138"
                                                                        fill="currentColor" viewBox="0 0 138 138">
                                                                        <path
                                                                            d="M51.75 17.25C53.0138 17.2499 54.2425 17.6662 55.246 18.4345L55.821 18.9348L71.3805 34.5H109.25C113.65 34.4998 117.884 36.1809 121.085 39.1994C124.286 42.2179 126.213 46.3456 126.471 50.738L126.5 51.75V97.75C126.5 102.15 124.819 106.384 121.801 109.585C118.782 112.786 114.654 114.713 110.262 114.971L109.25 115H28.75C24.35 115 20.1163 113.319 16.915 110.301C13.7137 107.282 11.7869 103.154 11.5288 98.762L11.5 97.75V34.5C11.4998 30.1 13.1809 25.8663 16.1994 22.665C19.2179 19.4637 23.3456 17.5369 27.738 17.2788L28.75 17.25H51.75Z"
                                                                            fill="#804800" />
                                                                    </svg>
                                                                    <span
                                                                        class="flex items-center text-center truncate">
                                                                        {{ $folder->name }}

                                                                    </span>
                                                                </div>

                                                            </button>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif

                                        </div>


                                    </div>

                                </div>
                                <div x-show="moveFolderModal" class="fixed inset-0 bg-black opacity-50 z-40"></div>
                            </div>
                        </div>



                    </div>

                </div>
            </div>
        @else
            <div class="p-4 sm:ml-64">
                <div class="p-4  text-center mt-16">
                    <h1>FOLDER IS EMPTY</h1>
                </div>
            </div>
        @endif



        <!-- Modal upload dan create folder/songcategory -->
        <form wire:submit.prevent="submit"
            class="{{ $showModal ? '' : 'hidden' }} fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-[calc(100%-1rem)] h-full bg-gray-800 bg-opacity-50"
            id="default-modal" tabindex="-1">
            <div class="relative p-4 w-full max-w-2xl max-h-full bg-gray-800 rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-200 text-center w-full">
                        Make A NEW FOLDER
                    </h3>
                    <button type="button" wire:click="closeModal()" data-modal-hide="default-modal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 space-y-4">
                    <div class="flex items-center justify-center w-full">
                        <label for="music-file"
                            class="flex flex-col items-center justify-center w-full h-50 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-800 hover:bg-gray-700">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to
                                        upload</span>
                                    or drag and drop</p>
                                <p class="text-xs text-gray-500">MP3, WAV, OGG</p>
                            </div>
                            <input id="music-file" wire:model="musicFiles" type="file" class="hidden"
                                accept="audio/*" multiple>

                        </label>
                    </div>
                    @if (count($musicFiles) > 0)
                        <div class="uploaded-files">
                            <h4 class="text-lg font-semibold text-gray-200">Uploaded Files:</h4>
                            <ul class="list-disc pl-5 text-gray-200">
                                @foreach ($musicFiles as $file)
                                    <li>{{ $file->getClientOriginalName() }}<button type="button"
                                            wire:click='removeFile("{{ $file->getClientOriginalName() }}")'
                                            class="ml-4 text-red-500 hover:text-red-700">
                                            Delete
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-6">
                        <label for="folder-name" class="block mb-2 text-sm font-medium text-gray-300">Folder
                            Name</label>
                        <input type="text" wire:model="folderName" id="folder-name"
                            class="bg-gray-800 border border-gray-300 text-gray-200 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                    </div>
                </div>
                <!-- Modal footer -->
                @if (session()->has('success'))
                    <div class="mt-2 text-green-500">
                        {{ session('success') }}
                    </div>
                @elseif (session()->has('error'))
                    <div class="mt-2 text-red-700">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="flex items-center justify-center p-4  rounded-b">
                    <button type="submit" data-modal-hide="default-modal"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Add
                        New Folder
                    </button>
                    <button type="button" data-modal-hide="default-modal" wire:click="closeModal()"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-300 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Cancel
                    </button>
                </div>

            </div>

        </form>

        <!-- Modal upload lagu -->
        <form wire:submit.prevent="submit2"
            class="{{ $showModalSong ? '' : 'hidden' }} fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-[calc(100%-1rem)] h-full bg-gray-800 bg-opacity-50"
            id="song-modal" tabindex="-1">
            <div class="relative p-4 w-full max-w-2xl max-h-full bg-gray-800 rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-200 text-center w-full">
                        UPLOAD NEW SONG
                    </h3>
                    <button type="button" wire:click="closeModal()" data-modal-hide="song-modal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 space-y-4">
                    <div class="flex items-center justify-center w-full">
                        <label for="song-file"
                            class="flex flex-col items-center justify-center w-full h-50 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-800 hover:bg-gray-700">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to
                                        upload</span>
                                    or drag and drop</p>
                                <p class="text-xs text-gray-500">MP3, WAV, OGG</p>
                            </div>
                            <input id="song-file" wire:model="musicFiles2" type="file" class="hidden"
                                accept="audio/*" multiple>

                        </label>
                    </div>
                    @if (count($musicFiles2) > 0)
                        <div class="uploaded-files">
                            <h4 class="text-lg font-semibold text-gray-200">Uploaded Files:</h4>
                            <ul class="list-disc pl-5 text-gray-200">
                                @foreach ($musicFiles2 as $file)
                                    <li>{{ $file->getClientOriginalName() }}<button type="button"
                                            wire:click='removeFile2("{{ $file->getClientOriginalName() }}")'
                                            class="ml-4 text-red-500 hover:text-red-700">
                                            Delete
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <!-- Modal footer -->
                @if (session()->has('success'))
                    <div class="mt-2 text-green-500">
                        {{ session('success') }}
                    </div>
                @elseif (session()->has('error'))
                    <div class="mt-2 text-red-700">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="flex items-center justify-center p-4  rounded-b">
                    <button type="submit" data-modal-hide="song-modal"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Add
                        New Song
                    </button>
                    <button type="button" data-modal-hide="song-modal" wire:click="closeModal()"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-300 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Cancel
                    </button>
                </div>

            </div>

        </form>

    </div>
</div>


<script>
    let isEditing = false;

    function enableEdit(el) {
        el.readOnly = false;
        el.classList.remove('focus:outline-none');
        isEditing = true; // Set flag to true when input is enabled
    }

    function disableEdit(el) {
        el.readOnly = true;
        el.classList.add('focus:outline-none');
        isEditing = false; // Reset flag when input loses focus
    }

    function handleKeyDown(event, el) {
        if (isEditing && event.key === 'Enter') {
            el.blur(); // Trigger onblur
        }
    }
</script>

<script>
    function clearSelection() {
        if (window.getSelection) {
            window.getSelection().removeAllRanges();
        } else if (document.selection) { // For IE
            document.selection.empty();
        }
    }

    function playandpause(songId) {
        var audioElement = document.getElementById('myAudio-' + songId);
        let button = document.getElementById('playPauseButton-' + songId);

        if (audioElement.paused) {
            audioElement.play(); // Memutar audio jika sedang di-pause
            button.innerHTML = `<svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M8 5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H8Zm7 0a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1Z" clip-rule="evenodd"/>
                </svg>`;
        } else {
            audioElement.pause(); // Pause audio jika sedang diputar
            button.innerHTML = `<svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M8.6 5.2A1 1 0 0 0 7 6v12a1 1 0 0 0 1.6.8l8-6a1 1 0 0 0 0-1.6l-8-6Z" clip-rule="evenodd"/>
                </svg>`;

        }
    }

    function isDomNotLoaded() {
        return document.readyState === 'loading' || document.readyState === 'interactive';
    }

    function reloadAudio(songId) {
        if (isDomNotLoaded()) {
            console.warn('DOM is not fully loaded. Try again later.');
        } else {
            var audioElement = document.getElementById('myAudio-' + songId);

            if (audioElement) {
                audioElement.load();
            } else {
                console.error('Audio element not found.');
            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        @foreach ($this->SongIsOpen as $song)
            var audioElement = document.getElementById('myAudio-{{ $song->id }}');
            var playPauseButton = document.getElementById('playPauseButton-{{ $song->id }}');

            if (audioElement) {
                if (!audioElement.paused) {
                    playPauseButton.textContent = 'Pause';
                } else {
                    playPauseButton.textContent = 'Play';
                }
            }
        @endforeach

    });
</script>
