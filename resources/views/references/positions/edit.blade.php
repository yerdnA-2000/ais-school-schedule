<form id="update" method="post" role="form"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div style="display: flex; flex-direction: column">
        <div class="form-group" style="width: 100%;">
            <label for="title">Наименование</label>
            <input type="text" name="title"
                   class="form-control @error('title') is-invalid @enderror"
                   id="title" value="{{$position->title}}">
        </div>

        <div class="form-group" style="width: 100%;">
            <label for="short_title">Краткое наименование</label>
            <input type="text" name="short_title"
                   class="form-control @error('short_title') is-invalid @enderror"
                   id="short_title" value="{{$position->short_title}}">
        </div>
    </div>

    <div id="actions-edit" class="mt-3">
        <button id="save-edit-position" type="button" class="btn btn-info"
                data-url-update="{{route('positions.update', ['position' => $position->id])}}"
                data-url="{{route('positions.index-ajax')}}"
                data-value="{{$position->id}}">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="delete-position" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem"
                data-url-delete="{{route('positions.destroy', ['position' => $position->id])}}"
                data-url="{{route('positions.index-ajax')}}"
                data-value="{{$position->id}}">
            <i class="fa fa-trash" style="margin-right: 0.5rem"></i>Удалить</button>
    </div>
</form>
