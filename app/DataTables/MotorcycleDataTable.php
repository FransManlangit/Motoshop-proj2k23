<?php

namespace App\DataTables;

use App\Models\Motorcycle;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Dompdf\Dompdf;

class MotorcyclesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $motorcycles = motorcycle::with('customers');
        return datatables()
            ->eloquent($motorcycles)
            ->addColumn('image', function ($motorcycles) { 
            $url= asset('storage/'.$motorcycles->imagePath);
            return '<img src="'.$url.'" border="0" width="80" height="80" class="rounded" align="center" />';
        })
            ->addColumn('owner', function ($motorcycles) { 
            return  $motorcycles->customers->fname . " " . $motorcycles->customers->lname ;
        })
            ->addColumn('action', function($row) {
                    return "<a href=". route('motorcycle.edit', $row->id). " class=\"btn btn-warning\">Edit</a> 
                    <form action=". route('motorcycle.destroy', $row->id). " method= \"POST\" >". csrf_field() .
                    '<input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                    </form>';
            })
            // ->addColumn('customers', function (motorcycle $motorcycles) {
            //         return $motorcycles->customers->map(function($customer) {
            //             // return str_limit($listener->listener_name, 30, '...');
            //             return "<li>" .$customer->fname. "</li>";
            //         })->implode('<br>');
            //     })
            // ->rawColumns(['listener','action'])
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\motorcycle $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(motorcycle $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
       return $this->builder()
                    ->setTableId('motorcycles-table')
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
    protected function getColumns()
    {
        return [
            Column::make('id'),
            // Column::make('customer')->name('customers.fname')->title('Owner Name'),
            Column::make('owner')->title('Owner'),
            Column::make('name')->title('motorcycle Name'),
            Column::make('image')->title('Image'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('action')
                  ->exportable(false)
                  ->printable(false)
                  ->orderable(false)
                  ->width(60),
            //       ->addClass('text-center'),
        ];    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'motorcycles_' . date('YmdHis');
    }
}
