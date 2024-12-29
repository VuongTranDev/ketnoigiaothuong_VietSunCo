<?php

namespace App\DataTables;

use App\Models\CompanyImage;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CompanyImagesDataTables extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $deleteBtn = "
                <form action='".route('partner.company.deleteImages')."' method='POST' style='display:inline;'>
                    ".csrf_field()."
                    <input type='hidden' name='id' value='".$query->id."'>
                    <button type='submit' class='btn btn-danger ml-2'>
                        <i class='far fa-trash-alt'></i>
                    </button>
                </form>
            ";
                return $deleteBtn;
            })
            ->addColumn('image', function ($query) {
                return "<img width='200px' src='" . asset($query->image) . "' ></img>";
            })
            ->addColumn('empty_column', function ($query) {
                return ''; // Không có nội dung trong cột
            })
            ->rawColumns(['image', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CompanyImage $model): QueryBuilder
    {
        $companyId = request()->get('company_id');
        \Log::info('Company ID in DataTable:', ['company_id' => $companyId]);

        return $model->where('company_id', $companyId)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('companyimagesdatatables-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ])
            ->parameters([
                'scrollX' => true, // Bật chế độ cuộn ngang
                'responsive' => true, // Hỗ trợ giao diện responsive
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id')->width('40%'),
            Column::make('image')->width('40%'),
            Column::make('empty_column') // Cột trống
                ->title('')  // Không hiển thị tiêu đề
                ->orderable(false) // Không thể sắp xếp
                ->searchable(false) // Không thể tìm kiếm
                ->className('empty-column'), // CSS class nếu cầnf
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width('20%')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ProductImages_' . date('YmdHis');
    }
}
