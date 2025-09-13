@extends('layouts.app')
@section('content')
    <h1>Criar Nova Enquete</h1>
    <form action="{{ route('polls.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título da Enquete</label>
            <input type="text" class="form-control" id="title" name="title" required value="{{ old('title') }}">
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="data_inicio" class="form-label">Data de Início (opcional)</label>
                <input type="datetime-local" class="form-control" id="data_inicio" name="data_inicio" value="{{ old('data_inicio') }}">
            </div>
            <div class="col">
                <label for="data_termino" class="form-label">Data de Fim (opcional)</label>
                <input type="datetime-local" class="form-control" id="data_termino" name="data_termino" value="{{ old('data_termino') }}">
            </div>
        </div>

        <div id="options-container">
            <label class="form-label">Opções (mínimo 3)</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="options[]" required>
                <button class="btn btn-success" type="button" onclick="addOption()">+</button>
            </div>
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="options[]" required>
                <button class="btn btn-danger" type="button" onclick="removeOption(this)">-</button>
            </div>
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="options[]" required>
                <button class="btn btn-danger" type="button" onclick="removeOption(this)">-</button>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Criar Enquete</button>
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
            if (container.children.length > 4) { // 1 label + 3 inputs
                button.parentElement.remove();
            }
        }
    </script>
@endsection
