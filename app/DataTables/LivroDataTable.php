<?php

namespace App\DataTables;

use App\Models\Livro;
use App\Services\UploadService;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LivroDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('capa', function ($l) {
                $capa = UploadService::getUrlArquivo($l->capa);
                return view('restrito.livro.capa_datatable', compact('capa'));
            })
            ->addColumn('action', function ($l) {
                return view('restrito.datatable.acoes_padrao', [
                    'editar' => route('restrito.livros.edit', $l),
                    'excluir' => route('restrito.livros.destroy', $l)
                ]);
            });
    }

    public function query(Livro $livro)
    {
        return $livro->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('livro-table')
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
                  ->addClass('text-center'),
            Column::computed('capa'),
            Column::make('nome'),
            Column::make('paginas'),
            Column::make('valor')
        ];
    }

    protected function filename()
    {
        return 'Livro_' . date('YmdHis');
    }
}
