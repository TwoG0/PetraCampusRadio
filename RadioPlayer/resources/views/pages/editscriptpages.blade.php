@extends('Layouts.app')

@section('content')
    @include('Layouts.sidebar')
    @livewire('editscript',['id' => $id])
  
@endsection
