@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} Programm
    </div>

    <div class="card-body">
        <form action="{{ route("admin.programmes.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('programe') ? 'has-error' : '' }}">
                <label for="programe">Programm Name</label>
                <input type="text" id="programe" name="programe" class="form-control" value="{{ old('programe', isset($programmes) ? $programm->programe : '') }}">
                @if($errors->has('programm'))
                    <em class="invalid-feedback">
                        {{ $errors->first('programm') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('department_id') ? 'has-error' : '' }}">
                <label for="department">Department</label>
                <select name="department_id" id="department" class="form-control select2">
                    @foreach($departments as $id => $department)
                        <option value="{{ $id }}" {{ (isset($programm) && $programm->department ? $programm->department->id : old('department_id')) == $id ? 'selected' : '' }}>{{ $department }}</option>
                    @endforeach
                </select>
                @if($errors->has('department_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('department_id') }}
                    </em>
                @endif
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection