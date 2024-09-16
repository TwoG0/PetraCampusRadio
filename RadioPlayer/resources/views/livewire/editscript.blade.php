<div>
    <style>
        ol {
            list-style: decimal;
            margin-left: 2rem;
        }

        ul {
            list-style-type: disc;
            margin-left: 2rem;

        }
    </style>
     <div id="toolbar" class="fixed flex gap-4 bg-[#e28743] text-[#fdfdfd] w-full mt-16 justify-center px-6 p-2">
                    <button onclick="execCmd('bold')"><svg class="w-6 h-6 " aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 5h4.5a3.5 3.5 0 1 1 0 7H8m0-7v7m0-7H6m2 7h6.5a3.5 3.5 0 1 1 0 7H8m0-7v7m0 0H6" />
                        </svg>
                    </button>
                    <button onclick="execCmd('italic')"><svg class="w-6 h-6 " aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m8.874 19 6.143-14M6 19h6.33m-.66-14H18" />
                        </svg>
                    </button>
                    <button onclick="execCmd('underline')"><svg class="w-6 h-6 " aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="M6 19h12M8 5v9a4 4 0 0 0 8 0V5M6 5h4m4 0h4" />
                        </svg>
                    </button>
                    <button onclick="execCmd('insertOrderedList')"><svg class="w-6 h-6" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6h8m-8 6h8m-8 6h8M4 16a2 2 0 1 1 3.321 1.5L4 20h5M4 5l2-1v6m-2 0h4" />
                        </svg>
                    </button>
                    <button onclick="execCmd('insertUnorderedList')"><svg class="w-6 h-6" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5" />
                        </svg>
                    </button>
                    <div class="relative">
                        <div class="flex items-center space-x-2">
                            <!-- Custom Color Picker Button -->
                            <div id="recentColors" class="flex space-x-1" wire:ignore></div>
                        </div>

                        <!-- Hidden Native Color Input -->
                        <button>
                            <input type="color" id="fontColorPicker"
                                onblur="execCmdWithValue('foreColor', this.value)">
                        </button>
                    </div>
                    <button class=" hover:bg-blue-700" wire:click="addDesScript()" onclick="getNewContent()">add new
                        des_script</button>
                </div>
    <div id="Content" class="p-8 text-sm">
        <div class="flex flex-col rounded-lg mt-10">
            <div class="container mx-auto">
               
                <div class="flex bg-white border border-b-[1px] mt-20 p-1">
                    <div class="text-nowrap me-4 w-24">
                        Date 
                    </div>
                    <div class="me-4">:</div>
                    <input date wire:model="date" type="date" class="w-full" wire:change="saveDate" onclick="this.showPicker()">
                </div>
                <div class="flex bg-white border border-b-[1px] border-t-[0px]  p-1">
                    <div class="text-nowrap me-4 w-24">
                        Programs
                    </div>
                    <div class="me-4">:</div>
                    <select wire:model="programModel"  class="w-full" wire:change="savePrograms">
                        <option value="">-- Pilih Opsi --</option>
                        @foreach ($this->programs as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                        
                    </select>
                </div>

                <div class="flex bg-white border border-b-[1px] border-t-[0px] p-1">
                    <div class="text-nowrap me-4 w-24">
                        Producer
                    </div>
                    <div class="me-4">:</div>
                    <input wire:model="producer" type="text" class="w-full" wire:change="saveProducer">
                </div>

                <div class="flex bg-white border border-b-[1px] border-t-[0px] mb-4 p-1">
                    <div class="text-nowrap me-4 w-24">
                        Announcer
                    </div>
                    <div class="me-4">:</div>
                    <input wire:model="announcer" type="text" class="w-full" wire:change="saveAnnouncer">
                </div>


                
                    @foreach ($detail_script as $dscript)
                    @if (!in_array($dscript->id, $this->deletedScript))
                        <div id="container-script{{ $dscript->id }}"
                            class="flex bg-white min-h-[200px] select-none h-1/4 border-slate-800 border-y border-x">
                            <div id="kuadran_script{{ $dscript->id }}" contenteditable="true"
                                class="p-2 w-1/4 select-none border-r"
                                onfocus="selectElement({{ $dscript->id }},1)"
                                onkeydown="handleKeyDown(event, {{ $dscript->id }})" wire:ignore>
                                {!! $kuadranField[$dscript->id] !!}
                            </div>

                            <div id="des_script{{ $dscript->id }}" contenteditable="true"
                                class="p-2 w-full select-none" onfocus="selectElement({{ $dscript->id }},2)"
                                onkeydown="handleKeyDown(event, {{ $dscript->id }})" wire:ignore>
                                {!! $des_scriptField[$dscript->id] !!}
                            </div>
                            <textarea wire:model="des_scriptField.{{ $dscript->id }}" id="textarea{{ $dscript->id }}" cols="30"
                                rows="10" hidden></textarea>
                            <textarea wire:model="kuadranField.{{ $dscript->id }}" id="kuadranarea{{ $dscript->id }}" cols="30"
                                rows="10" hidden></textarea>
                            <form id="autoSubmitForm{{ $dscript->id }}"
                                wire:submit.prevent="saveScript({{ $dscript->id }})">
                            </form>
                            <form id="autoSubmitFormKuadran{{ $dscript->id }}"
                                wire:submit.prevent="saveKuadran({{ $dscript->id }})">
                            </form>
                        </div>
                    @endif
                @endforeach
                

            </div>


        </div>
    </div>
</div>


<script>
    // native rich text editor
    let activeelement = [];
    let recentColors = [];
    let desScripts = document.querySelectorAll('[id^="des_script"]');
    let desKuadran = document.querySelectorAll('[id^="kuadran_script"]');



    function selectElement($index, $type) {
        activeelement[0] = $index;
        activeelement[1] = $type;
        console.log(activeelement);
    }

    function toggleColorPicker() {
        document.getElementById('fontColorPicker').click();
    }

    function execCmd(command) {
        if (activeelement[1] == 2) {
            const elements = document.getElementById(`des_script${activeelement[0]}`);
            elements.focus();
            document.execCommand(command, false, null);
            handleInput(activeelement[0]);
        } else if (activeelement[1] == 1) {
            const elements = document.getElementById(`kuadran_script${activeelement[0]}`);
            elements.focus();
            document.execCommand(command, false, null);
            handleInputKuadran(activeelement[0]);
        }

    }

    function execCmdWithValue(command, value) {
        if (activeelement[1] == 2) {
            const elements = document.getElementById(`des_script${activeelement[0]}`);
            elements.focus();
            document.execCommand(command, false, value);
            addRecentColor(value);
            handleInput(activeelement[0]);
        } else if (activeelement[1] == 1) {
            const elements = document.getElementById(`kuadran_script${activeelement[0]}`);
            elements.focus();
            document.execCommand(command, false, value);
            addRecentColor(value);
            handleInput(activeelement[0]);
        }
    }

    function handleColorChange() {
        const colorPicker = document.getElementById('fontColorPicker');
        const colorValue = colorPicker.value;
        execCmdWithValue('foreColor', colorValue);
        handleInput(activeelement); // Call handleInput here
    }

    function addRecentColor(color) {
        if (!recentColors.includes(color)) {
            recentColors.push(color);
            updateRecentColors();
        }
    }

    function updateRecentColors() {
        const recentColorsDiv = document.getElementById('recentColors');
        recentColorsDiv.innerHTML = '';

        recentColors.forEach(color => {
            const colorButton = document.createElement('button');
            colorButton.style.backgroundColor = color;
            colorButton.className = 'w-8 h-8 rounded-full border border-gray-300';
            colorButton.onclick = () => execCmdWithValue('foreColor', color);
            recentColorsDiv.appendChild(colorButton);
        });
    }

    function handleKeyDown(event, index) {
        const scriptContent = document.getElementById(`des_script${index}`);
        const kuadranContent = document.getElementById(`kuadran_script${index}`);
        const containerscript = document.getElementById(`container-script${index}`);
        if (event.key === 'Backspace') {
            if (scriptContent.innerHTML.trim() === '' && kuadranContent.innerHTML.trim() === '') {
                const eIndex = [activeelement[0]];
                @this.dispatch('delete-detail-script', eIndex);
                containerscript.remove();
            }

            // Add your logic here for what should happen when Backspace is pressed
        }
    }

    
    // Debounce function to limit how often the input event handler is called
    function debounce(func, delay) {
        let timer;
        return function(...args) {
            clearTimeout(timer);
            timer = setTimeout(() => func.apply(this, args), delay);
        };
    }

    //   Melakukan pengecekan apakah handleInput melakukan pengulangan kata yang sama atau tidak
    //   Mencegah agar tidak submit berulang agar perubahan web tidak lambat
    let lastSentScript = [];
    let lastSentKuadran = [];

    function handleInput(index) {
        console.log(activeelement[0]);
        // console.log('index:',index);
        const content = document.getElementById(`des_script${activeelement[0]}`).innerHTML;
        // console.log("content: ",content,"lastcontent:", lastSentContent);

        if (lastSentScript !== content) {
            lastSentScript[activeelement[0]] = content;
            @this.set(`des_scriptField.${activeelement[0]}`, content);

            document.getElementById(`autoSubmitForm${activeelement[0]}`).dispatchEvent(new Event('submit'));
        }
    }

    function handleInputKuadran(index) {
        console.log(activeelement[0]);
        const contentKuadran = document.getElementById(`kuadran_script${activeelement[0]}`).innerHTML;
        if (lastSentKuadran !== contentKuadran) {
            lastSentScript[activeelement[0]] = contentKuadran;
            @this.set(`kuadranField.${activeelement[0]}`, contentKuadran);

            document.getElementById(`autoSubmitFormKuadran${activeelement[0]}`).dispatchEvent(new Event('submit'));
        }
    }



    function updateContent() {
        desScripts = document.querySelectorAll('[id^="des_script"]');
        desKuadran = document.querySelectorAll('[id^="kuadran_script"]');
        desScripts.forEach((div, index) => {
            const debouncedHandleInput = debounce(() => handleInput(index), 200);
            div.removeEventListener('input', debouncedHandleInput); // Remove previous listener
            div.addEventListener('input', debouncedHandleInput);   // Add new listener
        });

        desKuadran.forEach((div, index) => {
            const debouncedHandleInputKuadran = debounce(() => handleInputKuadran(index), 200);
            div.removeEventListener('input', debouncedHandleInputKuadran); // Remove previous listener
            div.addEventListener('input', debouncedHandleInputKuadran);    // Add new listener
        });
    }

    function getNewContent() {
        setTimeout(() => {
            updateContent();
        }, 550);
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateContent();

        // //end native rich

        Echo.channel(`EditScript.${@json($scriptid)}`)
            .listen('detail_scriptUpdate', (e) => {
                
                if (e['command'] == 1) {
                    setTimeout(() => {
                        // console.log(e['fieldindex']);
                        let desScriptContent = document.getElementById(`textarea${e['index']}`);
                        document.getElementById(`des_script${e['index']}`).innerHTML = desScriptContent.value
                        // desScripts[e['fieldindex']].innerHTML = desScriptContent.value
                    }, 250);
                } else if (e['command'] == 2) {
                    setTimeout(() => {
                        let desScriptContentKur = document.getElementById(`kuadranarea${e['index']}`);
                        // console.log(desScritpContentKur)
                        document.getElementById(`kuadran_script${e['index']}`).innerHTML = desScriptContentKur.value
                    }, 250);
                } else if (e['command'] == 3) {
                    setTimeout(() => {
                        updateContent();
                    }, 250);
                }else if(e['command'] == 4){
                    setTimeout(() => {
                        updateContent();
                    }, 250);
                }

            });
    });


</script>
