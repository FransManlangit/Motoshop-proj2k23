<?php

namespace App\DataTables;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomerDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
     public function dataTable(QueryBuilder $query): EloquentDataTable
    {
       return datatables()
       ->eloquent($query)
       ->addColumn('action', function($row){
        return "<a href=". route('customers.edit', $row->id)." class=\"btn btn-warning\">Edit</a>
        <form action=". route('customers.destroy', $row->id)." method=\"POST\" >". csrf_field().
        '<input name="_method" type="hidden" value="DELETE">
        <button class="btn btn-danger" type="submit">Delete</button>
        </form>';

       })

       ->addColumn('images', function($customers){
        $url = asset('img_path/'."$customers->cust_img");
        return '<img src='.$url.' alt="Image" height="80" width="80">';
        
       })

       ->rawColumns(['action', 'images']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Customer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {

        return $this->builder()
        ->setTableId('customer-table')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->dom('Bfrtip')
        ->orderBy(1)
        ->buttons(
            Button::make('create'),
            Button::make('export'),
            Button::make('print'),
            Button::make('reset'),
            Button::make('reload')
        );

    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {

        return [

            Column::make('id'),
            Column::make('fname')->title('First Name'),
            Column::make('lname')->title('Last Name'),
            Column::make('address'),
            Column::make('town'),
            Column::make('city'),
            Column::make('phone'),
            Column::make('images'),
            Column::make('action')
            ->exportable(false)
            ->printable(false),
        ];
        
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Customer_' . date('YmdHis');
    }
}
