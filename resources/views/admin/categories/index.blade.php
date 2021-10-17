@extends('admin.layout')
@section('content')
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header d-flex justify-content-between card-header-border-bottom">
            <h2>Categories</h2>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary btn-sm">Add Category</a>
          </div>
    
          <div class="card-body">
            @include('admin.partials.flash')

            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Slug</th>
                  <th scope="col">Parent</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>

              <tbody>
                @forelse ($categories as $category)
                  <tr>
                    <td scope="row">{{ $categories->firstItem()+$loop->index }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ ($category->parent) ? $category->parent->name : ''  }}</td>
                    <td>
                      <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                      {!! Form::open(['route'=>['admin.categories.delete', $category->id], 'class' => 'delete d-inline']) !!}
                      {!! Form::hidden('_method', 'DELETE') !!}
                      {!! Form::submit('remove', ['class' => 'btn btn-danger btn-sm']) !!}
                      {!! Form::close() !!}
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5">No records found</td>
                  </tr>
                @endforelse
                
              </tbody>
            </table>
            {{ $categories->links('pagination::simple-bootstrap-4') }}
          </div>
      </div>
    </div>
  </div>
@endsection