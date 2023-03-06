<form id="update" method="post" role="form"
enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div style="display: flex; flex-direction: column">
        <div class="form-group" style="width: 100%;">
            <label for="title">Наименование</label>
            <input type="text" name="title"
                   class="form-control @error('title') is-invalid @enderror"
                   id="title" value="{{$building->title}}">
        </div>

        <div class="form-group" style="width: 100%;">
            <div class="custom-control custom-checkbox">
                <input name="is_schedule" class="custom-control-input" type="checkbox"
                       id="scheduleCheckbox" @if ($building->is_schedule != 0) checked @endif>
                <label for="scheduleCheckbox" class="custom-control-label">Учитывать в расписании</label>
            </div>
        </div>
    </div>

    <div id="actions-edit" class="mt-3">
        <button id="save-edit-building" type="button" class="btn btn-info"
                data-url-update="{{route('buildings.update', ['building' => $building->id])}}"
                data-url="{{route('buildings.index-ajax')}}"
                data-value="{{$building->id}}">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="delete-building" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem"
                data-url-delete="{{route('buildings.destroy', ['building' => $building->id])}}"
                data-url="{{route('buildings.index-ajax')}}"
                data-value="{{$building->id}}">
            <i class="fa fa-trash" style="margin-right: 0.5rem"></i>Удалить</button>
    </div>
</form>
