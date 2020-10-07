<!-- Modal Create -->
<div class="modal fade" id="attendance" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal"></h5>
            </div>
            <form class="needs-validation" id="attendanceForm" action="{{ route('attendance.store') }}" method="post" novalidate>
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>Cliente</strong>
                            <p id="client">{{ $data['client_name'] }}</p>
                            <input type="hidden" class="form-control shadow-sm" name="client_id" id="client_id" value="{{ $data['client_id'] }}" >
                            <input type="hidden" class="form-control shadow-sm" name="client_name" id="client_name" value="{{ $data['client_name'] }}" >
                            <div class="invalid-feedback">
                                O Cliente é Obrigatório!
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <strong>Tatuador</strong>
                            <p id="collaborator">{{ $data['collaborator_name'] }}</p>
                            <input type="hidden" class="form-control shadow-sm" name="collaborator_id" id="collaborator_id" value="{{ $data['collaborator_id'] }}" >
                            <input type="hidden" class="form-control shadow-sm" name="title" id="title" value="" >
                            <div class="invalid-feedback">
                                O Tatuador é Obrigatório!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="start">Data Inicial</label>
                            <input type="datetime-local" class="form-control shadow-sm" name="start" id="start" value="" readonly>
                            <div class="invalid-feedback">
                                A Data Inicial é Obrigatória!
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="end">Data Final</label>
                            <input type="datetime-local" class="form-control shadow-sm" name="end" id="end" value="" readonly>
                            <div class="invalid-feedback">
                                A Data Final é Obrigatória!
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note">Observações</label>
                        <textarea class="form-control shadow-sm" name="note" id="note" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-cst btn-primary">Salvar</button>
                    <button type="button" onclick="window.location.reload();" class="btn btn-secondary">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update -->
<div class="modal fade" id="attendanceUp" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal"></h5>
            </div>
            <form class="needs-validation" id="attendanceUpForm" action="{{ route('schedule.update') }}" method="post" novalidate>
                @method('PUT')
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <strong>Cliente</strong>
                            <p id="client"></p>
                            <input type="hidden" class="form-control shadow-sm" name="client_id" id="client_id" value="" >
                            <input type="hidden" class="form-control shadow-sm" name="attendance_id" id="attendance_id" value="" >
                            <input type="hidden" class="form-control shadow-sm" name="schedule_id" id="schedule_id" value="" >
                            <div class="invalid-feedback">
                                O Cliente é Obrigatório!
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <strong>Tatuador</strong>
                            <p id="collaborator"></p>
                            <input type="hidden" class="form-control shadow-sm" name="collaborator_id" id="collaborator_id" value="" >
                            <input type="hidden" class="form-control shadow-sm" name="title" id="title" value="" >
                            <div class="invalid-feedback">
                                O Tatuador é Obrigatório!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="start">Data Inicial</label>
                            <input type="datetime-local" class="form-control shadow-sm" name="start" id="start" value="" readonly>
                            <div class="invalid-feedback">
                                A Data Inicial é Obrigatória!
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="end">Data Final</label>
                            <input type="datetime-local" class="form-control shadow-sm" name="end" id="end" value="" readonly>
                            <div class="invalid-feedback">
                                A Data Final é Obrigatória!
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note">Observações</label>
                        <textarea class="form-control shadow-sm" name="note" id="note" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-cst btn-primary">Salvar</button>
                    <button type="button" onclick="window.location.reload();" class="btn btn-secondary">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
