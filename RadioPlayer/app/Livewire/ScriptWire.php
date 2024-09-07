<?php

namespace App\Livewire;

use App\Models\script;
use App\Models\detail_script;
use Carbon\Carbon;
use Livewire\Component;

class ScriptWire extends Component
{
    public $scriptdb;
    public function render()
    {
        return view('livewire.script-wire');
    }

    public function mount(){
        $this->scriptdb = Script::orderBy('updated_at', 'desc')->get();
    }

    public function addScript(){
        $newdetailscript = new detail_script();
       $newdetailscript->save();

       $newscript= new script();
       $newscript->date = Carbon::now();

       
       
       $newscript->detailScript = $newdetailscript->id;
       $newscript->save();
       
       $this->scriptdb = Script::orderBy('updated_at', 'desc')->get();

       return redirect()->route('editscriptPages', ['id' => $newscript->id]);
    }

    public function editScript($id){
        return redirect()->route('editscriptPages', ['id' => $id]);
    }
}
