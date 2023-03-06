<form id="create" method="post" role="form"
      enctype="multipart/form-data">
    @csrf
    <div style="display: flex; flex-direction: column">
        <div class="form-group" style="width: 100%;">
            <label for="title">Наименование</label>
            <input type="text" name="title"
                   class="form-control @error('title') is-invalid @enderror"
                   id="title" placeholder="Наименование должности">
        </div>

        <div class="form-group" style="width: 100%;">
            <label for="short_title">Краткое наименование</label>
            <input type="text" name="short_title"
                   class="form-control @error('short_title') is-invalid @enderror"
                   id="short_title" placeholder="Краткое наименование должности">
        </div>
    </div>
    <div class="mt-3">
        <button id="store-create-position" type="button" class="btn btn-info"
                data-url-store="{{route('positions.store')}}" data-url="{{route('positions.index-ajax')}}">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="undo-create-position" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem">
            <i class="fa fa-undo" style="margin-right: 0.5rem"></i>Отменить</button>
    </div>
</form>


