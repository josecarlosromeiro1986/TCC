@extends('index')
@section('title', 'Novo Cliente')
@section('activeAtt', 'activeElement')
@section('content')
    <h1 class="display-4">Novo Atendimento</h1>
    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="client_id">Cliente</label>
                <select name="client_id" id="client_id" class="form-control shadow-sm" placeholder="Selecione o Cliente:">
                    <option selected disabled value="">Selecione o Cliente:</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="collaborator_id">Tatuador</label>
                <input type="hidden" class="form-control shadow-sm" name="title" id="title" value="Fulano" >
                <select name="collaborator_id" id="collaborator_id" class="form-control shadow-sm" placeholder="Selecione o Tatuador:">
                    <option selected disabled value="">Selecione o Tatuador:</option>
                    @foreach ($collaborators as $collaborator)
                        <option value="{{ $collaborator->id }}">{{ $collaborator->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
    <div id="app" data-route-schedule-index="{{ route('schedule.index') }}">
        <calendar-component></calendar-component>
    </div>
    @include('includes.modal')
@endsection
