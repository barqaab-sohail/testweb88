<?php 
namespace App\Exports;
use App\Models\OrderItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoiceExport implements FromCollection,WithHeadings {

  public function headings()
  {
    return [
       "Order Id","Services","Cycle","qty", "price"
    ];
  }

  /**
  * @return \Illuminate\Support\Collection
  */
  public function collection() {

     return collect(OrderItem::getItems());
     // return Page::getUsers(); // Use this if you return data from Model without using toArray().
  }
}

 ?>