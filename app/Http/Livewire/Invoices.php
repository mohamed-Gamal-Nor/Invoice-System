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
    //theme pagnation
    protected $paginationTheme = 'bootstrap';
    public $current_step=2;
    // var for control view
    public $invoicesList = false,$invoiceCreate=true;
    // var for search in list and step
    public $supplierId=null,$storageId=null,$amount=null,$invoiceNumber=null,$fromDate=null,$toDate=null;
    // var for add invoice public variable
    public $supplierIdCreate=1,$storageIdCreate=1,$item_count=10;
    // var for array items invoice
    public $productId=[],$productColor=[],$productSize=[],$quantity=[],$price=[],$discVat=[],$rateVat=[];
    public function render()
    {
        $invoicesQuery = invoicesModel::where('id','like','%'.$this->invoiceNumber.'%')
            ->where('supplier_id','like','%'.$this->supplierId.'%')
            ->where('storage_id','like','%'.$this->storageId.'%')
            ->where('sub_total','like','%'.$this->amount.'%')
            ->whereBetween('date', [Carbon::parse($this->fromDate)->startOfDay(), Carbon::parse($this->toDate)->startOfDay()])
            ->paginate(25);
        $supplier=supplier::select('id','name')->where('status','=',1)->get();
        $storage=storge::select('id','name')->get();
        $products=product::select('id','product_name','unit')->get();
        $units=units::select('id','name')->get();
        $colors=colors::select('id','name','rgb')->get();
        $sizes=sizes::select('id','name')->get();
        return view('livewire.invoices.invoices',[
            'invoices' => $invoicesQuery,
            'supplier' => $supplier,
            'storage' => $storage,
            'products' => $products,
            'units' => $units,
            'colors' => $colors,
            'sizes' => $sizes,
            ]);

    }
    public function mount()
    {
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
        'item_count' => "required|numeric|min:1|max:100",
        'productId.*' => "required|exists:products,id",
        'productColor.*' => "required|exists:colors,id",
        'productSize.*' => "required|exists:sizes,id",
        'quantity.*' => "required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0.1",
        'price.*' => "required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0.1",
        'discVat.*' => "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0|max:100",
        'rateVat.*' => "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0|max:100",
        /*
        'total' => "required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/",
        */
    ];
    protected $messages = [
        'supplierIdCreate.required' => "يجب اختيار المورد",
        'supplierIdCreate.exists' => "هذا المورد غير مدرج بالنظام",
        'storageIdCreate.required' => "يجب اختيار المخزن",
        'item_count.required' => "يجب ادخال عدد الاصناف",
        'item_count.numeric' => "عدد الاصناف غير صحيح",
        'item_count.min' => "اقل عدد للاصناف بالفاتورة هي واحد",
        'item_count.max' => "اكتر عدد للاصناف بالفاتورة هي 100 صنف",
        'productId.*.required' => "يجب اختيار المنتج",
        'productId.*.exists' => "هذا المنتج غير مدرج بالنظام",
        'quantity.*.required' => "يجب ادخال الكمية",
        'quantity.*.regex' => "الكمية يجب انت تكون رقما صحيحا او كسر",
        'quantity.*.min' => " الكمية يجب ان لا تقل 0.1 ",
        'price.*.required' => "يجب ادخال السعر",
        'price.*.regex' => "السعر يجب انت يكون رقما صحيحا او كسر",
        'price.*.min' => " السعر يجب ان لا يقل عن 0.1 ",
        'productColor.*.required' => "يجب اختيار اللون",
        'productColor.*.exists' => "هذا اللون غير مدرج بالنظام",
        'productSize.*.required' => "يجب اختيار المقاس",
        'productSize.*.exists' => "هذا المقاس غير مدرج بالنظام",
        'discVat.regex' => "نسبة الخصم يجب ان تكون رقما صحيحا او كسر",
        'discVat.min' => "نسبة الخصم يجب ان لا تقل عن 0",
        'rateVat.regex' => "نسبة الضريبة يجب ان تكون رقما صحيحا او كسر",
        'rateVat.min' => "نسبة الضريبة يجب ان لا تقل عن 0",
        'total.required' => "يجب ان يكون هناك صافي الاجمالي",
        'total.regex' => "صافي الاجمالي يجب ان يكون رقما ",
    ];

    public function setp1(){
        $this->current_step = 1;
    }
    public function setp2(){
        $this->validate([
            'supplierIdCreate' => "required|exists:suppliers,id",
            'storageIdCreate' => "required|exists:storges,id",
            'item_count' => "required|numeric|min:1|max:100",
        ]);
        $this->current_step = 2;
    }
    public function setp3(){
        for ($i=1; $this->item_count>$i;$i++ ){
            $this->validate([
                'productId.'.$i=>"required|exists:products,id",
                'productColor.'.$i => "required|exists:colors,id",
                'productSize.'.$i=> "required|exists:sizes,id",
                'quantity.'.$i => "required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0.1",
                'price.'.$i => "required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0.1",
                'discVat.'.$i => "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0|max:100",
                'rateVat.'.$i => "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0|max:100",
            ]);
        }
        $this->current_step = 3;
    }
}
