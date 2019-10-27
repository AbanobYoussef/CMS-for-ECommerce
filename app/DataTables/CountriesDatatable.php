<?php

namespace App\DataTables;

use App\Model\Country;
use Yajra\DataTables\Services\DataTable;


class CountriesDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('checkbox', 'admin.Countries.btn.checkbox')
            ->addColumn('edit', 'admin.Countries.btn.edit')
            ->addColumn('delete', 'admin.Countries.btn.delete')
            ->rawColumns([
                'edit',
                'delete',
                'checkbox'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        
        return Country::query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->addAction(['width' => '80px'])
                    //->parameters($this->getBuilderParameters())
                    ->parameters([

                        'dom'=>'Blfrtip',
                        'lengthMenu'=>[[10,25,50,100,-1],[10,25,50,100,'All Recod']],
                        'buttons'=>[

                             [
                                'className'=>'btn btn-info',
                                'text'=>'<i class="fa fa-plus"></i> Create Admin',
                                'action'=>"function(){
                                    window.location.href='".\URL::current()."/create';
                                }",
                            ]
                            ,
                            [
                                'extend'=>'print',
                                'className'=>'btn btn-primary',
                                'text'=>'<i class="fa fa-print"></i>'
                            ]
                            ,
                            [
                                'extend'=>'csv',
                                'className'=>'btn btn-info',
                                'text'=>'<i class="fa fa-file"></i> Export CSV'
                            ]
                            ,
                            [
                                'extend'=>'excel',
                                'className'=>'btn btn-success',
                                'text'=>'<i class="fa fa-file"></i> Export EXCEL'
                            ]
                            ,
                             [
                                'extend'=>'pdf',
                                'className'=>'btn btn-danger',
                                'text'=>'<i class="fa fa-file"></i> Export pdf'
                            ]
                            ,
                            [
                                'className'=>'btn btn-danger delBtn',
                                'text'=>'<i class="fa fa-trash"></i> delete'
                            ]
                            ,
                        ],
                        'initComplete'=>"function () {
                            this.api().columns([1,2,3,4]).every(function () {
                            var column = this;
                            var input = document.createElement(\"input\");
                            $(input).appendTo($(column.footer()).empty())
                            .on('keyup', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                   });
                               });
                             }",

                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name'=>'checkbox',
                'data'=>'checkbox',
                'title'=>'<input type="checkbox" class="check_all" onclick="check_all()"/>',
                'exportable'=>false,
                'printable'=>false,
                'orderable'=>false,
                'searchable'=>false,
            ],
            [
                'name'=>'id',
                'data'=>'id',
                'title'=>'ID'
            ],
            [
                'name'=>'country_name',
                'data'=>'country_name',
                'title'=>'Country Name'
            ],
            [
                'name'=>'currency',
                'data'=>'currency',
                'title'=>'Currency'
            ],
            [
                'name'=>'created_at',
                'data'=>'created_at',
                'title'=>'created at'

            ],
            [
                'name'=>'updated_at',
                'data'=>'updated_at',
                'title'=>'updated at'

            ],
            [
                'name'=>'edit',
                'data'=>'edit',
                'title'=>'Edit',
                'exportable'=>false,
                'printable'=>false,
                'orderable'=>false,
                'searchable'=>false,

            ],
            [
                'name'=>'delete',
                'data'=>'delete',
                'title'=>'Delete',
                'exportable'=>false,
                'printable'=>false,
                'orderable'=>false,
                'searchable'=>false,

            ],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Countries_' . date('YmdHis');
    }
}
