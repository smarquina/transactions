@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Listado de usuarios</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">

                {{--                @include('admin.layout.messages')--}}
                <div class="dataTables_wrapper form-inline no-footer">

                    <table id="tabla"
                           class="table table-responsive table-hover table-striped filter-head dataTable no-footer">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Disponible</th>
{{--                            <th>Acciones</th>--}}
                        </tr>
                        </thead>
                    </table>
                </div>

            </div><!-- /.box-body -->
            <div class="box-footer text-center">

            </div><!-- /.box-footer -->
        </div><!-- /.box -->

    </section>
@stop

@section('js')
    <script type="text/javascript" src="//cdn.datatables.net/v/bs/dt-1.10.13/datatables.min.js"></script>

    <script type="text/javascript">

        jQuery(document).ready(function () {
            // Ordenar la tabla de forma inversa por ID
            jQuery('#tabla').DataTable({
                // set the initial value
                ordering: true,
                info: true,
                autoWidth: false,

                bPaginate: true,
                searching: true,
                processing: true,
                serverSide: true,
                ajax: '{{route('admin.user.index')}}',
                columns: [
                    {data: "id", name: "id", className: "text-center"},
                    {data: "name", name: "name", className: "text-center"},
                    {data: "email", name: "email", className: "text-center"},
                    {data: "amount", name: "amount", className: "text-center"},
                    // {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
                },
                initComplete: function () {
                    $('#tabla_filter').hide();
                    $('.filter-head thead th').each(function () {
                        var title = $('.filter-head thead th').eq($(this).index()).text();
                        if (title != 'Acciones') {
                            $(this).append('<br><input type="text" onclick="stopPropagation(event);" class="form-control input-sm text-center" placeholder="Filtro de ' + title + '" />');
                        }
                    });
                    var table = $('.filter-head').DataTable();
                    $(".filter-head thead input").on('keyup change', function () {
                        table.column($(this).parent().index() + ':visible').search(this.value).draw();
                    });
                }
            });
        });

    </script>
@stop
