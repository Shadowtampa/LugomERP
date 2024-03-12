<?php

namespace App\DataTables;

use App\Models\Store;
use App\Models\Venda;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))->setRowId('id')->addColumn('actions', function (Venda $venda) {
            return '
                <a href="' . route('vendas.show', $venda->id) . '" class="btn btn-warning btn-sm">Visualizar</a>
                <form action="' . route('apivenda.destroy', $venda->id) . '" method="POST" style="display:inline">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Excluir a venda de ID: ' . $venda->id . ' ?\')">Delete</button>
                </form>
            ';
        })
            ->rawColumns(['actions']);
    }
    /**
     * Get the query source of dataTable.
     */
    public function query(Venda $model): QueryBuilder
    {
        $storeId = session()->get('store', Store::first()->id);

        return $model->newQuery()
            ->whereHas('store', function ($query) use ($storeId) {
                $query->where('stores.id',  $storeId); // 1 é o ID da loja desejada
            });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('venda-table')
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

            Column::make('id'),
            Column::make('final_price')
                  ->title("Preço Final")
                  ->addClass('text-right'),
            Column::make('status'),
            Column::make('created_at')
            ->title("Criado em"),
            Column::computed('actions')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }
    

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Venda_' . date('YmdHis');
    }
}
