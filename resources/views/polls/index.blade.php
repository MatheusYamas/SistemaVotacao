@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Todas as Enquetes</h1>
        <a href="{{ route('polls.create') }}" class="btn btn-primary">Nova Enquete</a>
    </div>

    @forelse ($polls as $poll)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title mb-2">{{ $poll->title }}</h5>
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
                        <span class="badge fs-6 {{ $statusClass }}">{{ $poll->status }}</span>
                    </div>

                    @if ($poll->data_inicio && $poll->data_termino)
                        <span class="text-muted text-end">
                            <small>
                                Data de Início: {{ $poll->data_inicio->format('d/m/Y H:i') }} <br>
                                Data de Término: {{ $poll->data_termino->format('d/m/Y H:i') }}
                            </small>
                        </span>
                    @endif
                </div>
                <hr>
                <div class="d-flex gap-2">
                    <a href="{{ route('polls.show', $poll) }}" class="btn btn-info btn-sm rounded-2">Ver e Votar</a>
                    <a href="{{ route('polls.edit', $poll) }}" class="btn btn-warning btn-sm rounded-2">Editar</a>
                    <a href="{{ route('polls.confirmDelete', $poll) }}" class="btn btn-danger btn-sm rounded-2 text-dark">Deletar</a>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-secondary">
            Nenhuma enquete encontrada.
        </div>
    @endforelse
@endsection
