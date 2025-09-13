@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Todas as Enquetes</h1>
        <a href="{{ route('polls.create') }}" class="btn btn-primary">Nova Enquete</a>
    </div>

    @forelse ($polls as $poll)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-itens-center">
                    <h5 class="card-title">{{ $poll->title }}</h5>
                    <span class="text-muted">
                        <small>
                            {{ $poll->data_inicio->format('d/m/Y H:i') }}
                            {{ $poll->data_termino->format('d/m/Y H:i') }}
                        </small>
                    </span>
                </div>
                @php
                        $statusClass = '';
                        switch ($poll->status) {
                            case 'Em Andamento':
                                $statusClass = 'bg-success';
                                break;
                            case 'Finalizada':
                                $statusClass = 'bg-secondary';
                                break;
                            case 'Não Iniciada':
                                $statusClass = 'bg-warning text-dark';
                                break;
                        }
                    @endphp
                    <h5 class="badge {{ $statusClass }}">{{ $poll->status }}</h5>
                <a href="{{ route('polls.show', $poll) }}" class="btn btn-secondary">Ver e Votar</a>
                <a href="{{ route('polls.edit', $poll) }}" class="btn btn-secondary">Editar</a>
                <a href="{{ route('polls.confirmDelete', $poll) }}" class="btn btn-danger btn-sm">Deletar</a>
            </div>
        </div>
    @empty
        <p>Nenhuma enquete encontrada.</p>
    @endforelse
@endsection
