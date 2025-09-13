@extends('layouts.app')
@section('content')
    <h1>Atualizar Enquete</h1>
    <form action="{{ route('polls.update', $poll) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Título da Enquete</label>
            <input type="text" class="form-control" id="title" name="title" required value="{{ old('title', $poll->title)}}">
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="data_inicio" class="form-label">Data de Início</label>
                <input type="datetime-local" class="form-control" id="data_inicio" name="data_inicio" required value="{{ old('data_inicio', $poll->data_inicio ? $poll->data_inicio->format('Y-m-d\TH:i') : '') }}">
            </div>
            <div class="col">
                <label for="data_termino" class="form-label">Data de Fim</label>
                <input type="datetime-local" class="form-control" id="data_termino" name="data_termino" required value="{{ old('data_termino', $poll->data_termino ? $poll->data_termino->format('Y-m-d\TH:i') : '') }}">
            </div>
        </div>

        <div id="options-container">
            <label class="form-label">Opções (mínimo 3)</label>
            @foreach ($poll->options as $index => $option)
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="options[]" required value="{{ old('options.' . $index, $option->name) }}">
                    @if ($loop->first)
                        <button class="btn btn-success" type="button" onclick="addOption()">+</button>
                    @else
                        <button class="btn btn-danger" type="button" onclick="removeOption(this)">-</button>
                    @endif
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary mt-3">Salvar Alterações</button>
    </form>

    <script>
        function addOption() {
            const container = document.getElementById('options-container');
            const newOption = container.children[2].cloneNode(true);
            newOption.querySelector('input').value = '';
            container.appendChild(newOption);
        }
        function removeOption(button) {
            const container = document.getElementById('options-container');
            if (container.children.length > 4) {
                button.parentElement.remove();
            }
        }
    </script>
@endsection
