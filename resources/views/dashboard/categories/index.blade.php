@extends('layouts.dashboard.app')
@section('title')
    {{ __('dashboard.categories') }}
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.categories') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('dashboard.dashboard') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">
                                        {{ __('dashboard.categories') }}</a>
                                </li>


                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-md-11">
                    <div class="content-body">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-colored-form-control">
                                    {{ __('dashboard.categories') }}
                                </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-content">
                                <div class="card-body">
                                    <a href="{{ route('dashboard.categories.create') }}"
                                        class="btn btn-outline-success ">{{ __('dashboard.add_category') }}</a>

                                    {{-- alert --}}
                                    @include('dashboard.includes.tostar-success')
                                    @include('dashboard.includes.tostar-error')


                                    <p class="card-text"></p>
                                    <table id="yajra_table" class="table table-striped table-bordered language-file">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('dashboard.name') }}</th>
                                                <th>{{ __('dashboard.status') }}</th>
                                                <th>{{ __('dashboard.products_count') }}</th>
                                                <th>{{ __('dashboard.created_at') }}</th>
                                                <th>{{ __('dashboard.actions') }}</th>
                                            </tr>
                                        </thead>

                                        <body>
                                            {{-- empty --}}
                                        </body>
                                        {{-- <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('dashboard.name') }}</th>
                                                <th>{{ __('dashboard.status') }}</th>
                                                <th>{{ __('dashboard.products_count') }}</th>
                                                <th>{{ __('dashboard.created_at') }}</th>
                                                <th>{{ __('dashboard.actions') }}</th>
                                            </tr>
                                        </tfoot> --}}
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>


        html[lang="ar"] table.dataTable thead th {
            text-align: right !important;
        }

        html[lang="ar"] table.dataTable th,
        html[lang="ar"] table.dataTable td {
            text-align: right !important;
        }
    </style>
@endpush
@push('js')
    <script>
        var lang = "{{ app()->getLocale() }}";

        $('#yajra_table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: true,

            colReorder: true,
            rowReorder: true,
            // scroller: true,
            // scrollY: 300,
            //  select: true,
            responsive: {
                details: {
                    display: DataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return 'Details for ' + data[0] + ' ' + data[1];
                        }
                    }),
                    renderer: DataTable.Responsive.renderer.tableAll({
                        tableClass: 'table'
                    })
                }
            },
            ajax: "{{ route('dashboard.categories.all') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    orderable: false,
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'products_count',
                    name: 'products_count',

                },
                {
                    data: 'created_at',
                    name: 'created_at'

                },
                {
                    data: 'action',
                    searchable: false,
                    orderable: false,
                },

            ],
            layout: {
                topStart: {
                    buttons: [{
                            extend: 'colvis',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'copy',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: ':visible',
                            },
                            customize: function(win) {
                                if (lang === 'ar') {
                                    $(win.document.body).css('direction', 'rtl');
                                    $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('direction', 'rtl');
                                    $(win.document.body).find('th, td')
                                        .css('text-align', 'right')
                                        .css('padding-right', '5px')
                                        .css('padding-left', '5px');
                                } else {
                                    $(win.document.body).css('direction', 'ltr');
                                    $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('direction', 'ltr');
                                    $(win.document.body).find('th, td')
                                        .css('text-align', 'left')
                                        .css('padding-left', '5px')
                                        .css('padding-right', '5px');
                                }
                            }


                        },
                        {
                            extend: 'excel',
                            text: lang === 'ar' ? 'إكسل' : 'Excel',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                    ]
                }
            },
            language: lang === 'ar' ? {
                url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/ar.json",
            } : {},
        });
    </script>
@endpush
