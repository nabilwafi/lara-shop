@extends('admin.layout')
@section('content')

@php
$formTitle = !empty($product) ? 'Update' : 'New';
@endphp

<div class="content">
    <div class="row">
        <div class="col-lg-4">
            @include('admin.products.product_names')
        </div>

        <div class="col-lg-8">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>{{ $formTitle }} Product</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash', ['$errors' => $errors])

                    @if (isset($product->id))
                    {!! Form::model($product, ['route' => ['admin.products.update', $product->id],'method' => 'PUT',])
                    !!}
                    {!! Form::hidden('id') !!}
                    @else
                    {!!
                    Form::open([ 'route' => 'admin.products.store','method' => 'POST',])
                    !!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('sku', 'SKU') !!}
                        {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => 'sku']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'name']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('price', 'Price') !!}
                        {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'price']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('category_ids', 'Category') !!}
                        {!! General::selectMultiLevel('category_ids[]', $categories, ['class' => 'form-control',
                        'multiple' => true, 'selected' => !empty(old('category_ids')) ? old('category_ids') :
                        $categoryIDs, 'placeholder' => '== Choose Category ==']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('short_description', 'Short Description') !!}
                        {!! Form::textarea('short_description', null, ['class' => 'form-control', 'placeholder' =>
                        'Short Description']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Short
                        description']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('weight', 'Weight') !!}
                        {!! Form::text('weight', null, ['class' => 'form-control', 'placeholder' => 'Weight']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('length', 'Length') !!}
                        {!! Form::text('length', null, ['class' => 'form-control', 'placeholder' => 'Length']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('length', 'Length') !!}
                        {!! Form::text('length', null, ['class' => 'form-control', 'placeholder' => 'Length']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('width', 'Width') !!}
                        {!! Form::text('width', null, ['class' => 'form-control', 'placeholder' => 'Width']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('height', 'Height') !!}
                        {!! Form::text('height', null, ['class' => 'form-control', 'placeholder' => 'Height']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('status', 'Status') !!}
                        {!! Form::select('status', $statuses, null, ['class' => 'form-control', 'placeholder' => '== Set
                        Status ==']) !!}
                    </div>

                    <div class="form-footer pt-5 border-top">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('admin.categories') }}" class="btn btn-secondary">Back</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
