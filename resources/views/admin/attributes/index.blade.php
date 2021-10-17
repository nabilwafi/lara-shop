@extends('admin.layout')
@section('content')
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header d-flex justify-content-between card-header-border-bottom">
            <h2>Categories</h2>
            <a href="{{ route('admin.attributes.create') }}" class="btn btn-outline-primary btn-sm">Add Attribute</a>
          </div>
    
          <div class="card-body">
            @include('admin.partials.flash')

            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Code</th>
                  <th scope="col">Name</th>
                  <th scope="col">Type</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>

              <tbody>
                @forelse ($attributes as $attribute)
                  <tr>
                    <td scope="row">{{ $attributes->firstItem()+$loop->index }}</td>
                    <td>{{ $attribute->code }}</td>
                    <td>{{ $attribute->name }}</td>
                    <td>{{ $attribute->type }}</td>
                    <td>
                      <a href="{{ route('admin.attributes.edit', $attribute->id) }}" class="btn btn-warning btn-sm">Edit</a>
                      @if ($attribute->type == 'select')
                      <a href="{{ route('admin.attributes.options', $attribute->id) }}" class="btn btn-success btn-sm">Options</a>
                      @endif
                      {!! Form::open(['route'=>['admin.attributes.delete', $attribute->id], 'class' => 'delete d-inline']) !!}
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
            {{ $attributes->links('pagination::simple-bootstrap-4') }}
          </div>
      </div>
    </div>
  </div>
@endsection