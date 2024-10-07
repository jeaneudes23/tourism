<?php

namespace App\Livewire;

use App\Models\FrontPageContent;
use Livewire\Component;

class ApplicationLogo extends Component
{

    public $logo;

    public function mount(){
      $this->logo = 'storage/'.FrontPageContent::first()->logo;
    }
    public function render()
    {
        
        return <<<'HTML'
        <div class="inline-flex items-center gap-2">
            <img src="{{asset($logo)}}" alt="" class="h-6">
            <span class="text-lg capitalize font-medium tracking-wide">{{env('APP_NAME')}}</span>
        </div>
        HTML;
    }
}
