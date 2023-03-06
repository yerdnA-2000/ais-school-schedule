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
            <label for="staff">Сотрудник</label>
            <input disabled type="text"
                   class="form-control @error('staff') is-invalid @enderror"
                   value="{{$teacher->short_name}}">
            <input hidden type="text" name="staff"
                   id="staff" value="{{$teacher->id}}">
        </div>

        <div class="form-group">
            <label for="subjects">Предметы</label>
            <select name="subjects[]" class="select2 @error('subjects') is-invalid @enderror"
                    multiple="multiple" id="subjects" data-placeholder="Выбор предметов"
                    autocomplete="off" style="width: 100%;">
                @foreach($subjects as $k => $v)
                    <option value="{{ $k }}" @if(in_array($k, $teacher->subjects->pluck('id')->all())) selected @endif >
                        {{ $v }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div id="actions-edit" class="mt-3">
        <button id="save-edit-teacher" type="button" class="btn btn-info"
                data-url-update="{{route('teachers.update', ['teacher' => $teacher->id])}}"
                data-url="{{route('teachers.index-ajax')}}"
                data-value="{{$teacher->id}}">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="delete-teacher" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem"
                data-url-delete="{{route('teachers.destroy', ['teacher' => $teacher->id])}}"
                data-url="{{route('teachers.index-ajax')}}"
                data-value="{{$teacher->id}}">
            <i class="fa fa-trash" style="margin-right: 0.5rem"></i>Удалить</button>
    </div>
</form>
<script>
    $('#subjects').select2();
</script>
