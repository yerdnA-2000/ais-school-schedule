<form id="create" method="post" role="form"
enctype="multipart/form-data">
    @csrf
    <div style="display: flex; flex-direction: column">
        <div class="form-group" style="width: 100%;">
            <label for="number">Номер урока</label>
            <input type="number" name="number"
                   class="form-control @error('number') is-invalid @enderror"
                   id="number" placeholder="Номер урока">
        </div>
        <div class="form-group">
            <label for="datepicker-start" style="display: block">Время начала урока</label>
            <input name="start_time" type='text' id="timepicker-start-create"
                   class="form-control @error('start') is-invalid @enderror"
                   data-position="left center" placeholder="Время начала урока"/>
        </div>
        <div class="form-group">
            <label for="timepicker-end" style="display: block">Время окончания урока</label>
            <input name="end_time" type='text' id="timepicker-end-create"
                   class="form-control @error('end') is-invalid @enderror"
                   data-position="left center" placeholder="Время окончания урока"/>
        </div>
    </div>
    <div class="mt-3">
        <button id="store-create-call" type="button" class="btn btn-info"
                data-url-store="{{route('calls.store')}}" data-url="{{route('calls.index-ajax')}}">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="undo-create-call" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem">
            <i class="fa fa-undo" style="margin-right: 0.5rem"></i>Отменить</button>
    </div>
</form>

