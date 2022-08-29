<?php

namespace App\Http\Livewire;
use Carbon\Carbon;
use Livewire\WithPagination;
use App\Models\invoices as invoicesModel;
use App\Models\supplier;
use App\Models\storge;
use App\Models\product;
use App\Models\colors;
use App\Models\sizes;
use App\Models\units;
use Livewire\Component;

class Invoices extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $invoicesList = false,$invoiceCreate=true,$currentStep=1;
    public $supplierId=null,$storageId=null,$amount=null,$invoiceNumber=null,$fromDate=null,$toDate=null,
    $supplierIdCreate=5,$storageIdCreate=null,$productId,$quantity,$price,$productColor,$productSize;
    public function render()
    {
        $supplier=supplier::select('*')->get();
        $storage=storge::select('*')->get();
        if ($this->invoiceCreate){
            $product = product::select('*','product_name')->get();
            $color = colors::select('id','name')->get();
            $size = sizes::select('id','name')->get();

        }else{
            $product = null;
            $color = null;
            $size = null;

        }
        if(!empty($this->productId)){
            $unitProduct = product::where('id',$this->productId)->value('unit');
            $unit = units::where('id',$unitProduct)->value('name');
        }else{
            $unit = null;
        }
        $invoicesQuery = invoicesModel::where('id','like','%'.$this->invoiceNumber.'%')
            ->where('supplier_id','like','%'.$this->supplierId.'%')
            ->where('storage_id','like','%'.$this->storageId.'%')
            ->where('sub_total','like','%'.$this->amount.'%')
            ->whereBetween('date', [Carbon::parse($this->fromDate)->startOfDay(), Carbon::parse($this->toDate)->startOfDay()])
            ->paginate(25);
        return view('livewire.invoices.invoices',[
            'invoices' => $invoicesQuery,
            'supplier' => $supplier,
            'storage' => $storage,
            'product' => $product,
            'color' => $color,
            'size' => $size,
            'unit' => $unit,
            ]);
    }
    public function invoiceListForm(){
        $this->invoiceCreate = false;
        $this->invoicesList = true;
    }
    public function invoiceCreateForm(){
        $this->invoiceCreate = true;
        $this->invoicesList = false;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected $rules = [
        'supplierIdCreate' => "required|exists:suppliers,id",
        'storageIdCreate' => "required|exists:storges,id",

    ];
    protected $messages = [
        'supplierIdCreate.required' => "يجب اختيار المورد",
        'supplierIdCreate.exists' => "هذا المورد غير مدرج بالنظام",
        'storageIdCreate.required' => "يجب اختيار المخزن",
        'storageIdCreate.exists' => "هذا المخزن غير مدرج بالنظام",
    ];

}
