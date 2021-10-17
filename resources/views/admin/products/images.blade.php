@extends('admin.layout')
@section('content')

<div class="content">
  <div class="row">
    <div class="col-md-4">
      @include('admin.products.product_names')
    </div>

    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header d-flex justify-content-between card-header-border-bottom">
          <h2>Products Images</h2>
          <a href="{{ route('admin.products.add.image', $productID) }}" class="btn btn-outline-primary btn-sm">Add Image</a>
        </div>
  
        <div class="card-body">
          @include('admin.partials.flash')

          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Upload At</th>
                <th scope="col">Action</th>
              </tr>
            </thead>

            <tbody>
              @forelse ($productImage as $image)
                <tr>
                  <td scope="row">{{ $paginateImages->firstItem()+$loop->index }}</td>
                  <td><img style="width: 50px; heigth: 50px" src="{{ asset('storage/'. $image->path) }}" alt=""></td>
                  <td>{{ $image->created_at }}</td>
                  <td>
                    {!! Form::open(['route'=>['admin.products.rm.image', $image->id], 'class' => 'delete d-inline']) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('remove', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4">No records found</td>
                </tr>
              @endforelse
              
            </tbody>
          </table>
          {{ $paginateImages->links('pagination::simple-bootstrap-4') }}
        </div>
    </div>
  </div>
</div>

@endsection