@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Todas as Enquetes</h1>
        <a href="{{ route('polls.create') }}" class="btn btn-primary">Nova Enquete</a>
    </div>

    @forelse ($polls as $poll)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $poll->title }}</h5>
                <a href="{{ route('polls.show', $poll) }}" class="btn btn-secondary">Ver e Votar</a>
            </div>
        </div>
    @empty
        <p>Nenhuma enquete encontrada.</p>
    @endforelse
@endsection
