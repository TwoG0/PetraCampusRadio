<div>
    <div id="Content" class="p-4">
        <div class="flex flex-col p-4 rounded-lg mt-16">

            <div class="container">
                <div id="toolbar">
                    <button onclick="execCmd('bold')">Bold</button>
                    <button onclick="execCmd('italic')">Italic</button>
                    <button onclick="execCmd('underline')">Underline</button>
                    <button onclick="execCmd('strikeThrough')">Strike</button>
                    <button onclick="execCmd('insertOrderedList')">OL</button>
                    <button onclick="execCmd('insertUnorderedList')">UL</button>
                    <div class="relative">
                        <div class="flex items-center space-x-2">
                            <!-- Custom Color Picker Button -->
                            <div id="recentColors" class="flex space-x-1" wire:ignore></div>
                        </div>

                        <!-- Hidden Native Color Input -->
                        <input type="color" id="fontColorPicker" onblur="execCmdWithValue('foreColor', this.value)">
                    </div>
                </div>
                <div id="des_script" contenteditable="true" class="block bg-white border rounded-lg p-2 min-h-[200px]"
                    wire:ignore>
                    {!! $des_scriptField !!}
                </div>
                <textarea wire:model="des_scriptField" name="des_script" id="des_scripttxtare" cols="30" rows="10" hidden></textarea>

            </div>

            <form id="autoSubmitForm" wire:submit.prevent="saveScript"></form>

        </div>
    </div>
</div>


<script>
    let recentColors = [];

    function toggleColorPicker() {
        document.getElementById('fontColorPicker').click();
    }

    function execCmd(command) {
        document.execCommand(command, false, null);
        handleInput(); // Update the Livewire model after applying a command
    }

    function execCmdWithValue(command, value) {
        document.execCommand(command, false, value);
        addRecentColor(value);
        handleInput();
    }

    function handleColorChange() {
        const colorPicker = document.getElementById('fontColorPicker');
        const colorValue = colorPicker.value;
        execCmdWithValue('foreColor', colorValue);
        handleInput(); // Call handleInput here
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

    document.addEventListener('DOMContentLoaded', function() {
        const desScriptDiv = document.getElementById('des_script');

        // Add drag-and-drop functionality for resizing if needed

        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                console.log('Change detected:', mutation);
            });
        });

        // Configure the observer
        observer.observe(desScriptDiv, {
            childList: true,
            subtree: true,
            characterData: true
        });

        // Function to handle changes (for example, when using input event)
        function handleChange() {
            const newValue = desScriptDiv.innerHTML;
            console.log('Content changed:', newValue);
        }

        // Add event listeners
        desScriptDiv.addEventListener('input', handleChange);
        desScriptDiv.addEventListener('keyup', handleChange);
        desScriptDiv.addEventListener('paste', handleChange);

        Echo.channel(`EditScript.${@json($scriptid)}`)
            .listen('detail_scriptUpdate', (e) => {
                // Log the updated script data received from the broadcast event



                setTimeout(() => {
                    // Update the contenteditable div
                    let desScriptContent = document.getElementById('des_scripttxtare');
                    console.log(desScriptContent.value);
                    desScriptDiv.innerHTML = desScriptContent.value
                }, 250);
            });
    });

    // Debounce function to limit how often the input event handler is called
    function debounce(func, delay) {
        let timer;
        return function(...args) {
            clearTimeout(timer);
            timer = setTimeout(() => func.apply(this, args), delay);
        };
    }

    // Event handler for form submission
    function handleInput() {
        // const content = quill.root.innerHTML;
        const content = document.getElementById('des_script');
        @this.set('des_scriptField', content.innerHTML)
        document.getElementById('autoSubmitForm').dispatchEvent(new Event('submit'));
    }

    // Attach debounced event handler to contenteditable div input
    document.getElementById('des_script').addEventListener('input', debounce(handleInput, 150));
</script>
