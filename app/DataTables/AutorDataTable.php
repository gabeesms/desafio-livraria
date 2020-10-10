<?php

namespace App\DataTables;

use App\Models\Autor;
use Collective\Html\FormFacade;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AutorDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($a) {
                return view('restrito.datatable.acoes_padrao', [
                    'editar' => route('restrito.autors.edit', $a),
                    'excluir' => route('restrito.autors.destroy', $a)
                ]);
            })
            ->addColumn('total_livros', function ($a) {
                return $a->livros()->count();
            });
    }

    public function query(Autor $autor)
    {
        return $autor->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('autor-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')
                            ->addClass('btn btn-primary')
                            ->text('<i class="fas fa-plus-circle"></i> Cadastrar'),
                        Button::make('print')
                            ->addClass('btn btn-primary')
                            ->text('<i class="fas fa-print"></i> Imprimir')
                    );
    }

    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(100)
                  ->title('Ações'),
            Column::make('nome'),
            Column::make('email'),
            Column::computed('total_livros')->title('Total de Livros')
        ];
    }

    protected function filename()
    {
        return 'Autor_' . date('YmdHis');
    }
}
