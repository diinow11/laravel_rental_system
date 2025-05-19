@extends('layouts.admin')

@section('title', 'Roles')

@section('content')
  {{-- This will mount your Livewire component --}}
  <livewire:admin.roles-index />
@endsection
