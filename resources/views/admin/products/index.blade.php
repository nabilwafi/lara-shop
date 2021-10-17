@extends('admin.layout')
@section('content')
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header d-flex justify-content-between card-header-border-bottom">
            <h2>Products</h2>
            <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary btn-sm">Add Product</a>
          </div>
    
          <div class="card-body">
            @include('admin.partials.flash')

            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">SKU</th>
                  <th scope="col">Name</th>
                  <th scope="col">Price</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>

              <tbody>
                @forelse ($products as $product)
                  <tr>
                    <td scope="row">{{ $products->firstItem()+$loop->index }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->status  }}</td>
                    <td>
                      <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                      {!! Form::open(['route'=>['admin.products.delete', $product->id], 'class' => 'delete d-inline']) !!}
                      {!! Form::hidden('_method', 'DELETE') !!}
                      {!! Form::submit('remove', ['class' => 'btn btn-danger btn-sm']) !!}
                      {!! Form::close() !!}
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6">No records found</td>
                  </tr>
                @endforelse
                
              </tbody>
            </table>
            {{ $products->links('pagination::simple-bootstrap-4') }}
          </div>
      </div>
    </div>
  </div>
@endsection