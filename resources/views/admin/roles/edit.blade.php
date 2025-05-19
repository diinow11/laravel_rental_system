@extends('admin.layout.master')

@section('content')
  <section class="content-header">
    <h1>Edit Role: {{ $role->name }}</h1>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-body">
        @include('admin.roles.partials.form', ['role'=>$role, 'permissions'=>$permissions])
      </div>
    </div>
  </section>
@endsection