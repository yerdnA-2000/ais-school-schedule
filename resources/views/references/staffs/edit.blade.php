<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        border-color: #3A97FF;
    }
    </style>
<form id="update" method="post" role="form"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div style="display: flex; flex-direction: column">
        <div class="form-group" style="width: 100%;">
            <label for="name">ФИО</label>
            <input type="text" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   id="name" value="{{$staff->name}}">
        </div>

        <div class="form-group" style="width: 100%;">
            <label for="short_name">Инициалы</label>
            <input type="text" name="short_name"
                   class="form-control @error('short_name') is-invalid @enderror"
                   id="short_name" value="{{$staff->short_name}}">
        </div>

        <div class="form-group">
            <label for="positions">Должности</label>
            <select name="positions[]" class="select2"
                    multiple="multiple" id="positions" data-placeholder="Выбор должностей" style="width: 100%; border: none">
                @foreach($positions as $k => $v)
                    <option value="{{ $k }}" @if(in_array($k, $staff->positions->pluck('id')->all())) selected @endif >
                        {{ $v }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div id="actions-edit" class="mt-3">
        <button id="save-edit-staff" type="button" class="btn btn-info"
                data-url-update="{{route('staffs.update', ['staff' => $staff->id])}}"
                data-url="{{route('staffs.index-ajax')}}"
                data-value="{{$staff->id}}">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="delete-staff" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem"
                data-url-delete="{{route('staffs.destroy', ['staff' => $staff->id])}}"
                data-url="{{route('staffs.index-ajax')}}"
                data-value="{{$staff->id}}">
            <i class="fa fa-trash" style="margin-right: 0.5rem"></i>Удалить</button>
    </div>
</form>
<script>
    $(document).ready(function () {
        $('#positions').select2();
    });
</script>
