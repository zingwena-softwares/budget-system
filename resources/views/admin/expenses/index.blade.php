@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.expenses.create") }}">
            {{ trans('global.add') }} {{ trans('cruds.expense.title_singular') }}
        </a>
    </div>
</div>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.expense.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Expense">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Id
                        </th>

                        <th>
                            Description
                        </th>

                        <th>
                            Group
                        </th>

                        <th>
                            Category
                        </th>

                        <th>
                            Program
                        </th>
                        <th>
                            Sub-Program
                        </th>

                        <th>
                            Department
                        </th>

                        <th>
                            UnitMeasure
                        </th>

                        <th>
                            Period
                        </th>

                        <th>
                            Quantity
                        </th>

                        <th>
                            UnitPrice
                        </th>

                        <th>
                            Total(Excl)
                        </th>

                        <th>
                            VAT
                        </th>

                        <th>
                            Total(Incl)
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses as $key => $expense)
                    <tr data-entry-id="{{ $expense->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $expense->id ?? '' }}
                        </td>
                        <td>
                            {{ $expense->description ?? '' }}
                        </td>
                        <td>
                            {{ $expense->category->name ?? '' }}
                        </td>
                        <td>
                            {{ $expense->category->name ?? '' }}
                        </td>

                        <td>
                            {{ $expense->program->programe ?? '' }}
                        </td>

                        <td>
                            {{ $expense->program->sub_programm ?? 'To be displayed' }}
                        </td>

                        <td>
                            {{ $expense->program->department_id ?? 'To be displayed' }}
                        </td>
                        <td>
                            {{ $expense->unit_measure ?? '' }}
                        </td>
                        <td>
                            {{ $expense->period ?? '' }}
                        </td>

                        <td>
                            {{ $expense->quantity ?? '' }}
                        </td>
                        <td>
                            {{ $expense->amount ?? '' }}
                        </td>

                        <td>
                            {{ $expense->total_exclusive ?? '' }}
                        </td>

                        <td>
                            {{ $expense->vat ?? '' }}
                        </td>
                        <td>
                            {{ $expense->total_inclusive ?? '' }}
                        </td>

                        <td>
                            @can('expense_show')
                            <a class="btn btn-xs btn-primary" href="#">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('expense_edit')
                            <a class="btn btn-xs btn-info" href="#">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('expense_delete')
                            <form action="{{ route('admin.expenses.destroy', $expense->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                            @endcan

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function() {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('expense_delete')
        let deleteButtonTrans = '{{ trans('
        global.datatables.delete ') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.expenses.massDestroy') }}",
            className: 'btn-danger',
            action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function(entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('{{ trans('
                        global.datatables.zero_selected ') }}')

                    return
                }

                if (confirm('{{ trans('
                        global.areYouSure ') }}')) {
                    $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            },
                            method: 'POST',
                            url: config.url,
                            data: {
                                ids: ids,
                                _method: 'DELETE'
                            }
                        })
                        .done(function() {
                            location.reload()
                        })
                }
            }
        }
        dtButtons.push(deleteButton)
        @endcan

        $.extend(true, $.fn.dataTable.defaults, {
            order: [
                [1, 'desc']
            ],
            pageLength: 100,
        });
        $('.datatable-Expense:not(.ajaxTable)').DataTable({
            buttons: dtButtons
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
</script>
@endsection