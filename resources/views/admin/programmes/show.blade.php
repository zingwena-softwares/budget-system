@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} Programmes
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Id
                        </th>
                        <td>
                            {{ $programm->id }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                           Programme
                        </th>
                        <td>
                            {{ $programm->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Sub-Programme
                        </th>
                        <td>
                            {{ $programm->sub_programme}}
                        </td>
                    </tr>

                    <tr>
                        <th>
                           Department
                        </th>
                        <td>
                            {{ $programm->department->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection