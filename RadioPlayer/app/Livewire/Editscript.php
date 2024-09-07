<?php

namespace App\Livewire;
use App\Events\detail_scriptUpdate;
use App\Models\detail_script;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\Attributes\On;
class Editscript extends Component
{
    public $scriptid;
    public $detail_script;
    public $des_scriptField;
    public $tempdes_scriptField;
    public function render()
    {
        return view('livewire.editscript');
    }

    public function mount($id)
    {
        $this->scriptid = $id;
        $this->detail_script = detail_script::find($id);
        $this->des_scriptField = $this->detail_script->des_script;
        $this->tempdes_scriptField = $this->detail_script->des_script;
    }

    // public function updatedDesScriptField()
    // {
    //     // Logika tambahan sebelum menyimpan (misalnya, validasi)
    //     $this->saveScript();
    // }
    public function saveScript()
    {
        $this->detail_script->des_script = $this->des_scriptField;
        $this->detail_script->save();

        broadcast(new detail_scriptUpdate($this->detail_script))->toOthers();
        // dd($this->detail_script->des_script);
    }

    #[On('echo:EditScript.{scriptid},detail_scriptUpdate')]
    public function listenUpdate($script)
    {
        // dd($script);
        // $this->mount($script['scriptid']);
        $this->detail_script = detail_script::find($script['scriptid']);
        $this->des_scriptField = $this->detail_script->des_script;
    }

}
