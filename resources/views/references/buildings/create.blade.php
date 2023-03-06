<form id="create" method="post" role="form"
      enctype="multipart/form-data">
    @csrf
    <div style="display: flex; flex-direction: column">
        <div class="form-group" style="width: 100%;">
            <label for="title">Наименование</label>
            <input type="text" name="title"
                   class="form-control @error('title') is-invalid @enderror"
                   id="title" placeholder="Наименование">
        </div>

        <div class="form-group" style="width: 100%;">
            <div class="custom-control custom-checkbox">
                <input name="is_schedule" class="custom-control-input" type="checkbox"
                       id="customCheckbox1" value="1">
                <label for="customCheckbox1" class="custom-control-label">Учитывать в расписании</label>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <button id="store-create-building" type="button" class="btn btn-info"
                data-url-store="{{route('buildings.store')}}" data-url="{{route('buildings.index-ajax')}}">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="undo-create-building" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem">
            <i class="fa fa-undo" style="margin-right: 0.5rem"></i>Отменить</button>
    </div>
</form>


