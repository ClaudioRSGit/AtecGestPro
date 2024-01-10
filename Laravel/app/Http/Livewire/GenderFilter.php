<?php

namespace App\Http\Livewire;

use App\Material;
use Livewire\Component;

class GenderFilter extends Component
{
    public $gender = 'male';
    public $clothes;

    public function render()
    {
        $this->clothes = Material::query();

        if ($this->gender == "male") {
            $this->clothes = $this->clothes->where('gender', 0)->get();
        } elseif ($this->gender == "female") {
            $this->clothes = $this->clothes->where('gender', 1)->get();
        }

        return view('livewire.gender-filter');
    }
}
