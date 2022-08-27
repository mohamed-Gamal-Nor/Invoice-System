<?php

namespace App\Http\Livewire;
use Livewire\WithPagination;
use App\Models\invoices as invoicesModel;
use Livewire\Component;

class Invoices extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $invoicesList = true;
    public function render()
    {
        return view('livewire.invoices.invoices',['invoices' => invoicesModel::orderBy('date', 'DESC')->paginate(1),]);
    }

}
