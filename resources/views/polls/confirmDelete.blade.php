@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    Confirmar Exclusão
                </div>
                <div class="card-body">
                    <h5 class="card-title">Você tem certeza que deseja deletar esta enquete?</h5>
                    <p class="text-danger">
                        <strong>Atenção:</strong> Esta ação não pode ser desfeita.
                    </p>
                    <hr>
                    <p><strong>Enquete a ser deletada:</strong></p>
                    <blockquote class="blockquote">
                        <p class="mb-0"><em>{{ $poll->title }}</em></p>
                    </blockquote>
                    <hr>
                    <form action="{{ route('polls.destroy', $poll) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Sim, Deletar Permanentemente</button>
                    </form>

                    <a href="{{ route('polls.index') }}" class="btn btn-secondary d-inline">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
