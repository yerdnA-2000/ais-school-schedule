<form id="update" method="post" role="form"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div style="display: flex; flex-direction: column">
        <div class="form-group" style="width: 100%;">
            <label for="title">Название</label>
            <input type="text" name="title"
                   class="form-control @error('title') is-invalid @enderror"
                   id="title" autocomplete="off" placeholder="Название класса" value="{{$class->title}}">
        </div>

        <div class="form-group">
            <label for="head">Классный руководитель</label>
            <select class="form-control @error('head') is-invalid @enderror"
                    id="head" name="head" autocomplete="off" data-placeholder="Классный руководитель" style="width: 100%;">
                @foreach($staffs as $k => $v)
                    <option value="{{ $k }}" @if($k == $class->head_id) selected @endif >
                        {{ $v }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="year">Учебный год</label>
            <select class="form-control @error('year') is-invalid @enderror"
                    id="year" name="year" autocomplete="off" data-placeholder="Учебный год" style="width: 100%;">
                <option value="2021-2022" @if ('2021-2022' == $class->year) selected @endif>2021-2022</option>
                <option value="2022-2023" @if ('2022-2023' == $class->year) selected @endif>2022-2023</option>
                <option value="2023-2024" @if ('2023-2024' == $class->year) selected @endif>2023-2024</option>
                <option value="2024-2025" @if ('2024-2025' == $class->year) selected @endif>2024-2025</option>
                <option value="2025-2026" @if ('2025-2026' == $class->year) selected @endif>2025-2026</option>
                <option value="2026-2027" @if ('2026-2027' == $class->year) selected @endif>2026-2027</option>
                <option value="2027-2028" @if ('2027-2028' == $class->year) selected @endif>2027-2028</option>
                <option value="2028-2029" @if ('2028-2029' == $class->year) selected @endif>2028-2029</option>
                <option value="2029-2030" @if ('2029-2030' == $class->year) selected @endif>2029-2030</option>
            </select>
        </div>
    </div>

    <div id="actions-edit" class="mt-3">
        <button id="save-edit-class" type="button" class="btn btn-info"
                data-url-update="{{route('classes.update', ['class' => $class->id])}}"
                data-url="{{route('classes.index-ajax')}}"
                data-value="{{$class->id}}">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="delete-class" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem"
                data-url-delete="{{route('classes.destroy', ['class' => $class->id])}}"
                data-url="{{route('classes.index-ajax')}}"
                data-value="{{$class->id}}">
            <i class="fa fa-trash" style="margin-right: 0.5rem"></i>Удалить</button>
    </div>
</form>
