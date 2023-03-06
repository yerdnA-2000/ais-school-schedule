<form id="update" method="post" role="form"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div style="display: flex; flex-direction: column">
        <div class="form-group" style="width: 100%;">
            <label for="title">Номер</label>
            <input type="text" name="title"
                   class="form-control @error('title') is-invalid @enderror"
                   id="title" value="{{$cabinet->title}}">
        </div>

        <div class="form-group">
            <label for="profile">Профиль</label>
            <select class="form-control @error('profile') is-invalid @enderror"
                    id="profile" name="profile" style="width: 100%">
                @foreach($profiles as $key => $value)
                    <option value="{{ $key }}" @if($key == $cabinet->profile_id) selected @endif >
                        {{ $value }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="building">Здание</label>
            <select class="form-control @error('building') is-invalid @enderror"
                    id="building" name="building" style="width: 100%">
                @foreach($buildings as $key => $value)
                    <option value="{{ $key }}" @if($key == $cabinet->building_id) selected @endif >
                        {{ $value }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" style="width: 100%;">
            <div class="custom-control custom-checkbox">
                <input name="is_schedule" class="custom-control-input" type="checkbox"
                       id="scheduleCheckbox" @if ($cabinet->is_schedule != 0) checked @endif>
                <label for="scheduleCheckbox" class="custom-control-label">Учитывать в расписании</label>
            </div>
        </div>
    </div>

    <div id="actions-edit" class="mt-3">
        <button id="save-edit-cabinet" type="button" class="btn btn-info"
                data-url-update="{{route('cabinets.update', ['cabinet' => $cabinet->id])}}"
                data-url="{{route('cabinets.index-ajax')}}"
                data-value="{{$cabinet->id}}">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="delete-cabinet" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem"
                data-url-delete="{{route('cabinets.destroy', ['cabinet' => $cabinet->id])}}"
                data-url="{{route('cabinets.index-ajax')}}"
                data-value="{{$cabinet->id}}">
            <i class="fa fa-trash" style="margin-right: 0.5rem"></i>Удалить</button>
    </div>
</form>
