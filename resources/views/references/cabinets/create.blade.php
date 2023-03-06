<form id="create" method="post" role="form"
      enctype="multipart/form-data">
    @csrf
    <div style="display: flex; flex-direction: column">
        <div class="form-group" style="width: 100%;">
            <label for="title">Номер</label>
            <input type="text" name="title"
                   class="form-control @error('title') is-invalid @enderror"
                   id="title" placeholder="Номер кабинета">
        </div>

        <div class="form-group">
            <label for="profile">Профиль</label>
            <select class="form-control @error('profile') is-invalid @enderror"
                    id="profile" name="profile" style="width: 100%;">
                @foreach($profiles as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="building">Здание</label>
            <select class="form-control @error('building') is-invalid @enderror"
                    id="building" name="building" style="width: 100%">
                @foreach($buildings as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" style="width: 100%;">
            <div class="custom-control custom-checkbox">
                <input name="is_schedule" class="custom-control-input" type="checkbox"
                       id="customCheckbox" value="1">
                <label for="customCheckbox" class="custom-control-label">Учитывать в расписании</label>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <button id="store-create-cabinet" type="button" class="btn btn-info"
                data-url-store="{{route('cabinets.store')}}" data-url="{{route('cabinets.index-ajax')}}">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="undo-create-cabinet" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem">
            <i class="fa fa-undo" style="margin-right: 0.5rem"></i>Отменить</button>
    </div>
</form>


