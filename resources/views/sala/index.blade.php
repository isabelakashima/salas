@extends('main')
@section('title') Sistema de Reserva de Salas @endsection
@section('content')
@forelse($salas as $sala)
@include('sala.partials.fields')
@empty
    <p>Não há salas cadastradas ainda.</p>
@endforelse
@endsection