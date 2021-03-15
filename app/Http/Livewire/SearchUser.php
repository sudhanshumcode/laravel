<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
class SearchUser extends Component
{
    public $search="";
    public function render()
    {
        
        $user= User::where('name', "like", "%".$this->search."%")->get();
        if($this->search == ''){
            $user=array();
        }
        return view('livewire.search-user',[
            "users"=>$user,

        ]);
    }
}
