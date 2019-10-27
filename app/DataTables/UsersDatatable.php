<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;


class UsersDatatable extends DataTable
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
            ->addColumn('level', 'admin.users.btn.level')
            ->addColumn('checkbox', 'admin.users.btn.checkbox')
            ->addColumn('edit', 'admin.users.btn.edit')
            ->addColumn('delete', 'admin.users.btn.delete')
            ->rawColumns([
                'edit',
                'delete',
                'checkbox',
                'level',
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
        
        return User::query()->where(function($q){
           if(request()->has('level'))
           {
            return $q->where('level',request('level',request('level')));
           }
        });
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
                                'text'=>'<i class="fa fa-plus"></i> Create User',
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
                            this.api().columns([1,2,3,4,5,6]).every(function () {
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
                'name'=>'name',
                'data'=>'name',
                'title'=>'User Name'
            ],
            [
                'name'=>'email',
                'data'=>'email',
                'title'=>'User Email'

            ],
            [
                'name'=>'level',
                'data'=>'level',
                'title'=>'User level'

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
        return 'Users_' . date('YmdHis');
    }
}
