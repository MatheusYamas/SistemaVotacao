@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1>{{ $poll->title }}</h1>
        <a href="{{ route('polls.index') }}" class="btn btn-secondary">Voltar para todas as enquetes</a>
    </div>
    @if($poll->data_inicio && $poll->data_termino)
        <p class="text-muted">
            Período de votação: de {{ $poll->data_inicio->format('d/m/Y H:i') }} até {{ $poll->data_termino->format('d/m/Y H:i') }}
        </p>
    @endif

    @php
        $totalVotes = $poll->options->sum('votes');
    @endphp

    @if($poll->isRunning() && !session('voted_poll_' . $poll->id))
        <div class="card mb-4">
            <div class="card-header">Votar</div>
            <div class="card-body">
                <form action="{{ route('polls.vote', $poll) }}" method="POST">
                    @csrf
                    @foreach($poll->options as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="option_id" id="option-{{ $option->id }}" value="{{ $option->id }}" required>
                            <label class="form-check-label" for="option-{{ $option->id }}">
                                {{ $option->name }}
                            </label>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary mt-3">Votar</button>
                </form>
            </div>
        </div>
    @elseif(session('voted_poll_' . $poll->id))
        <div class="alert alert-info">Você já votou nesta enquete.</div>
    @else
        <div class="alert alert-warning">Esta enquete está fora do período de votação.</div>
    @endif


    <div class="card">
        <div class="card-header">Resultados (Total de Votos: {{ $totalVotes }})</div>
        <div class="card-body">
            @forelse($poll->options as $option)
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <strong>{{ $option->name }}</strong>
                        <span>{{ $option->votes }} votos</span>
                    </div>
                    <div class="progress" role="progressbar">
                        @php
                            $percentage = $totalVotes > 0 ? ($option->votes / $totalVotes) * 100 : 0;
                        @endphp
                        <div class="progress-bar" style="width: {{ $percentage }}%;">{{ number_format($percentage, 1) }}%</div>
                    </div>
                </div>
            @empty
                <p>Esta enquete ainda não tem opções.</p>
            @endforelse
        </div>
    </div>
@endsection
