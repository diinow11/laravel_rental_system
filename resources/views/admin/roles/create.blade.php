@extends('admin.layout.master')

@section('content')
  <section class="content-header">
    <h1>Create Role</h1>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-body">
        @include('admin.roles.partials.form', ['role'=>null, 'permissions'=>$permissions])
      </div>
    </div>
  </section>
@endsection