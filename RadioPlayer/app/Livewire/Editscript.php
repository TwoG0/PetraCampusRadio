<?php

namespace App\Livewire;
use App\Events\detail_scriptUpdate;
use App\Models\detail_script;
use App\Models\script;
use App\Models\scriptProgram;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\Attributes\On;
class Editscript extends Component
{
    public $scriptid;
    public $script;
    public $programs;
    public $programModel;
    public $date;
    public $announcer;
    public $producer;
    public $detail_script = [];
    public $des_scriptField = [];
    public $kuadranField = [];
    public $deletedScript = [];
    public function render()
    {
        return view('livewire.editscript');
    }

    public function mount($id)
    {
        $this->scriptid = $id;
        $this->script = script::find($id);
        $this->date = $this->script->date;
        $this->announcer = $this->script->announcer;
        $this->producer = $this->script->producer;
        $this->programs = scriptProgram::get();
        if($this->script->scriptprogram != null){
            $this->programModel = $this->script->scriptprogram;
        }
        foreach (json_decode($this->script->detailScript) as $d) {
            $this->detail_script[] = detail_script::find($d);
            $this->des_scriptField[$d] = detail_script::find($d)->des_script;
            $this->kuadranField[$d] = detail_script::find($d)->kuadran;
        }
        // dd($this->des_scriptField);
        // $this->detail_script = detail_script::find($id);

    }

    public function saveDate()
    {
        if ($this->date == "") {
            $this->date = $this->script->date;
            return;
        }
        $this->script->date = $this->date;
        $this->script->save();
        broadcast(new detail_scriptUpdate($this->script, null, null, 5))->toOthers();
    }

    public function saveAnnouncer()
    {
        $this->script->announcer = $this->announcer;
        $this->script->save();
        broadcast(new detail_scriptUpdate($this->script, null, null, 6))->toOthers();

    }
    public function saveProducer()
    {
        $this->script->producer = $this->producer;
        $this->script->save();
        broadcast(new detail_scriptUpdate($this->script, null, null, 7))->toOthers();

    }

    public function savePrograms(){
        $this->script->scriptprogram = $this->programModel;
        $this->script->save();
        broadcast(new detail_scriptUpdate($this->script, null, null, 8))->toOthers();

    }

    public function saveScript($index)
    {
        // dd($index);
        // dd($this->des_scriptField);
        foreach ($this->detail_script as $dscript) {
            if ($dscript->id == $index) {
                $dscript->des_script = $this->des_scriptField[$index];
                $dscript->save();
                broadcast(new detail_scriptUpdate($this->script, $dscript->id, $index, 1))->toOthers();
            }
        }
    }

    public function saveKuadran($index)
    {
        foreach ($this->detail_script as $dscript) {
            if ($dscript->id == $index) {
                $dscript->kuadran = $this->kuadranField[$index];
                $dscript->save();
                broadcast(new detail_scriptUpdate($this->script, $dscript->id, $index, 2))->toOthers();
            }
        }
    }

    #[On('echo:EditScript.{scriptid},detail_scriptUpdate')]
    public function listenUpdate($script)
    {
        // dd($script);
        if ($script['command'] == 1) {
            // dd($script);
            foreach ($this->detail_script as $index => $d) {
                if ($d->id == $script['index']) {
                    $d = detail_script::find($script['index']);
                    $this->des_scriptField[$d->id] = $d->des_script;
                }
            }
        } elseif ($script['command'] == 2) {
            foreach ($this->detail_script as $d) {
                if ($d->id == $script['index']) {
                    $d = detail_script::find($script['index']);
                    $this->kuadranField[$d->id] = $d->kuadran;
                }
            }
        } elseif ($script['command'] == 3) {
            $this->script = script::find($this->scriptid);
            $this->detail_script[] = detail_script::find($script['index']);
            $this->des_scriptField[] = end($this->detail_script)->kuadran;
            $this->kuadranField[] = end($this->detail_script)->kuadran;
        } elseif ($script['command'] == 4) {
            $this->deletedScript[] = $script['index'];
        } elseif ($script['command'] == 5) {
            $this->script = script::find($script['scriptid']);
            $this->date = $this->script->date;
        } else if ($script['command'] == 6) {
            $this->script = script::find($script['scriptid']);
            $this->announcer = $this->script->announcer;
        }else if ($script['command'] == 7) {
            $this->script = script::find($script['scriptid']);
            $this->producer = $this->script->producer;
        }else if($script['command'] == 8){
            $this->script = script::find($script['scriptid']);
            $this->programModel = $this->script->scriptprogram;
        }
    }


    #[On('delete-detail-script')]
    public function deleteDetailScript($index)
    {
        // dd($index);
        $arrayToUnset = json_decode($this->script->detailScript);
        $i = array_search($index, $arrayToUnset);
        unset($arrayToUnset[$i]);
        $temp = [];
        foreach ($arrayToUnset as $a) {
            $temp[] = $a;
        }
        $this->script->detailScript = $temp;
        $this->script->save();
        $this->deletedScript[] = $index;
        broadcast(new detail_scriptUpdate($this->script, $index, null, 4));
    }

    public function addDesScript()
    {
        $tempscriptid = json_decode($this->script->detailScript);
        $this->script->detailScript = json_encode($tempscriptid);
        $newdesscript = new detail_script();
        $newdesscript->save();
        array_push($tempscriptid, $newdesscript->id);
        $this->script->detailScript = json_encode($tempscriptid);
        $this->script->save();
        $this->detail_script[] = $newdesscript;
        $this->des_scriptField[] = $newdesscript->des_script;
        $this->kuadranField[] = $newdesscript->kuadran;
        broadcast(new detail_scriptUpdate($this->script, $newdesscript->id, null, 3))->toOthers();
    }
}
