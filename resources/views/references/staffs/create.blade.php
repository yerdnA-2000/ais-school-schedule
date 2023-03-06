<form id="create" method="post" role="form"
      enctype="multipart/form-data">
    @csrf
    <div style="display: flex; flex-direction: column">
        <div class="form-group" style="width: 100%;">
            <label for="name">ФИО</label>
            <input type="text" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   id="name" autocomplete="off" placeholder="ФИО сотрудника">
        </div>

        <div class="form-group" style="width: 100%;">
            <label for="short_name">Инициалы</label>
            <input type="text" name="short_name"
                   class="form-control @error('short_name') is-invalid @enderror"
                   id="short_name" autocomplete="off" placeholder="Инициалы">
        </div>

            <div class="form-group">
                <label for="positions">Должности</label>
                <select name="positions[]" class="select2 @error('positions') is-invalid @enderror"
                        multiple="multiple" id="positions2" data-placeholder="Выбор должностей"
                        autocomplete="off" style="width: 100%;">
                    @foreach($positions as $k => $v)
                        <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </div>
    </div>
    <div class="mt-3">
        <button id="store-create-staff" type="button" class="btn btn-info"
                data-url-store="{{route('staffs.store')}}" data-url="{{route('staffs.index-ajax')}}">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="undo-create-staff" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem">
            <i class="fa fa-undo" style="margin-right: 0.5rem"></i>Отменить</button>
    </div>
</form>
<script>
    $(document).ready(function () {
        $('#positions2').select2();
    });
</script>


