<?php

namespace App\DataTables;

use App\Models\Store;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StoreDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))->setRowId('id')->addColumn('actions', function (Store $store) {
            return '
                <a href="' . route('lojas.edit', $store->id) . '" class="btn btn-warning btn-sm">Edit</a>
                <form action="' . route('lojas.destroy', $store->id) . '" method="POST" style="display:inline">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Excluir a loja: ' . $store->id . ' ?\')">Delete</button>
                </form>
                <form action="' . route('lojas.sethome', $store->id) . '" method="POST" style="display:inline">
                    ' . csrf_field() . '
                    ' . method_field('POST') . '
                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm(\'tornar a loja: ' . $store->id . ' a principal ?\')">Set Home</button>
                </form>
            ';
        })
            ->rawColumns(['actions']);
    }
    // public function dataTable(QueryBuilder $query): EloquentDataTable
    // {
    //     return (new EloquentDataTable($query))
    //         ->addColumn('action', 'store.action')
    //         ->setRowId('id');
    // }

    /**
     * Get the query source of dataTable.
     */
    public function query(Store $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('store-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('add'),
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('actions')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('id'),
            Column::make('alias'), // Adicionando o campo 'official_name'
            Column::make('official_name'), // Adicionando o campo 'official_name'
            Column::make('address'), // Adicionando o campo 'address'
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }



    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Store_' . date('YmdHis');
    }
}
