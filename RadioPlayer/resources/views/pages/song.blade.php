@extends('Layouts.app')

@section('content')
    @include('Layouts.sidebar')
    @livewire('songfolder')
    @livewireScripts
@endsection
