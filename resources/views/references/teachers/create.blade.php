<form id="create" method="post" role="form"
      enctype="multipart/form-data">
    @csrf
    <div style="display: flex; flex-direction: column">
        <div class="form-group">
            <label for="staff">Сотрудник</label>
            <select class="form-control @error('staff') is-invalid @enderror"
                    id="staff" name="staff" autocomplete="off" data-placeholder="Выбор сотрудника" style="width: 100%;" >
                @foreach($staffs as $k => $v)
                    <option value="{{ $k }}">{{ $v }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="subjects">Предметы</label>
            <select name="subjects[]" class="select2 @error('subjects') is-invalid @enderror"
                    multiple="multiple" id="subjects2" data-placeholder="Выбор предметов"
                    autocomplete="off" style="width: 100%;">
                @foreach($subjects as $k => $v)
                    <option value="{{ $k }}">{{ $v }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mt-3">
        <button id="store-create-teacher" type="button" class="btn btn-info"
                data-url-store="{{route('teachers.store')}}" data-url="{{route('teachers.index-ajax')}}">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="undo-create-teacher" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem">
            <i class="fa fa-undo" style="margin-right: 0.5rem"></i>Отменить</button>
    </div>
</form>


