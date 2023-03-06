<form id="update" method="post" role="form"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div style="display: flex; flex-direction: column">
        <div class="form-group" style="width: 100%;">
            <label for="number">Номер урока</label>
            <input disabled type="text"
                   class="form-control @error('number') is-invalid @enderror"
                   id="number" value="{{$call->number}}">
            <input type="hidden" name="number" value="{{$call->number}}">
        </div>

        <div class="form-group" style="width: 100%;">
            <label for="timepicker-start-edit" style="display: block">Время начала урока</label>
            <input name="start_time" type='text' id="timepicker-start-edit"
                   class="form-control @error('start') is-invalid @enderror"
                   data-position="left center" value="{{$call->getTime('start')}}"/>
        </div>

        <div class="form-group" style="width: 100%;">
            <label for="timepicker-end" style="display: block">Время окончания урока</label>
            <input name="end_time" type='text' id="timepicker-end-edit"
                   class="form-control @error('end') is-invalid @enderror"
                   data-position="left center" value="{{$call->getTime('end')}}"/>
        </div>
    </div>

    <div id="actions-edit" class="mt-3">
        <button id="save-edit-call" type="button" class="btn btn-info"
                data-url-update="{{route('calls.update', ['call' => $call->number])}}"
                data-url="{{route('calls.index-ajax')}}"
                data-value="{{$call->number}}">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="delete-call" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem"
                data-url-delete="{{route('calls.destroy', ['call' => $call->number])}}"
                data-url="{{route('calls.index-ajax')}}"
                data-value="{{$call->number}}">
            <i class="fa fa-trash" style="margin-right: 0.5rem"></i>Удалить</button>
    </div>
</form>

<script>
    $(document).ready(function () {
        initTimepickerEditCall ();
    });
</script>
