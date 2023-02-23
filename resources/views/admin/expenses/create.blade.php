@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.expense.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.expenses.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('program_id') ? 'has-error' : '' }}">
                <label for="program">Programe</label>
                <select name="program_id" id="program" class="form-control select2">
                    @foreach($programmes as $id => $program)
                    <option value="{{ $id }}" {{ (isset($expense) && $expense->program ? $expense->program->id : old('program_id')) == $id ? 'selected' : '' }}>{{ $program }}</option>
                    @endforeach
                </select>
                @if($errors->has('program_id'))
                <em class="invalid-feedback">
                    {{ $errors->first('program_id') }}
                </em>
                @endif
            </div>

           

            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                <label for="category">{{ trans('cruds.expense.fields.category') }}</label>
                <select name="category_id" id="category" class="form-control select2">
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ (isset($expense) && $expense->category ? $expense->category->id : old('category_id')) == $id ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('category_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('category_id') }}
                    </em>
                @endif
            </div>

            <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" class="form-control" value="{{ old('quantity', isset($expense) ? $expense->quantity : '') }}" step="0.01" required>
                @if($errors->has('quantity'))
                <em class="invalid-feedback">
                    {{ $errors->first('quantity') }}
                </em>
                @endif
                <p class="helper-block">
                    {{ trans('') }}
                </p>
            </div>


            <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                <label for="amount">Unit Price</label>
                <input type="number" id="amount" name="amount" class="form-control" value="{{ old('amount', isset($expense) ? $expense->amount : '') }}" step="0.01" required>
                @if($errors->has('amount'))
                <em class="invalid-feedback">
                    {{ $errors->first('amount') }}
                </em>
                @endif
                <p class="helper-block">
                    {{ trans('') }}
                </p>
            </div>


            <div class="form-group {{ $errors->has('vat') ? 'has-error' : '' }}">
                <label for="vat">VAT</label>
                <input type="number" id="vat" name="vat" class="form-control" value="{{ old('vat', isset($expense) ? $expense->vat : '') }}" step="0.01" required>
                @if($errors->has('vat'))
                <em class="invalid-feedback">
                    {{ $errors->first('vat') }}
                </em>
                @endif
                <p class="helper-block">
                    {{ trans('') }}
                </p>
            </div>


          
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('cruds.expense.fields.description') }}</label>
                <textarea id="description" name="description" class="form-control ">{{ old('description', isset($expense) ? $expense->description : '') }}</textarea>
                @if($errors->has('description'))
                <em class="invalid-feedback">
                    {{ $errors->first('description') }}
                </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.expense.fields.description_helper') }}
                </p>
            </div>
          
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection