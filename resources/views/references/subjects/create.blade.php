<form id="create" method="post" role="form"
      enctype="multipart/form-data">
    @csrf
    <div style="display: flex; flex-direction: column">
        <div class="form-group" style="width: 100%;">
            <label for="title">Наименование</label>
            <input type="text" name="title"
                   class="form-control @error('title') is-invalid @enderror"
                   id="title" autocomplete="off" placeholder="Наименование предмета">
        </div>

        <div class="form-group" style="width: 100%;">
            <label for="short_title">Краткое наименование</label>
            <input type="text" name="short_title"
                   class="form-control @error('short_title') is-invalid @enderror"
                   id="short_title" autocomplete="off" placeholder="Краткое наименование предмета">
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

        <div class="form-group d-flex" style="width: 100%; flex-wrap: wrap">
            <div class="form-group hard-subject">
                <label for="hard1_4">1-4 классы</label>
                <input type="number" name="hard1_4"
                       class="form-control @error('hard1_4') is-invalid @enderror"
                       id="hard1_4" autocomplete="off" placeholder="-"></div>
            <div class="form-group hard-subject">
                <label for="hard5">5 класс</label>
                <input type="number" name="hard5"
                       class="form-control @error('hard5') is-invalid @enderror"
                       id="hard5" autocomplete="off" placeholder="-"></div>
            <div class="form-group hard-subject">
                <label for="hard6">6 класс</label>
                <input type="number" name="hard6"
                       class="form-control @error('hard6') is-invalid @enderror"
                       id="hard6" autocomplete="off" placeholder="-"></div>
            <div class="form-group hard-subject">
                <label for="hard7">7 класс</label>
                <input type="number" name="hard7"
                       class="form-control @error('hard7') is-invalid @enderror"
                       id="hard7" autocomplete="off" placeholder="-"></div>
            <div class="form-group hard-subject">
                <label for="hard8">8 класс</label>
                <input type="number" name="hard8"
                       class="form-control @error('hard8') is-invalid @enderror"
                       id="hard8" autocomplete="off" placeholder="-"></div>
            <div class="form-group hard-subject">
                <label for="hard9">9 класс</label>
                <input type="number" name="hard9"
                       class="form-control @error('hard9') is-invalid @enderror"
                       id="hard9" autocomplete="off" placeholder="-"></div>
            <div class="form-group hard-subject">
                <label for="hard10_11">10-11 класс</label>
                <input type="number" name="hard10_11"
                       class="form-control @error('hard10_11') is-invalid @enderror"
                       id="hard10_11" autocomplete="off" placeholder="-"></div>
        </div>
    </div>
    <div class="mt-3">
        <button id="store-create-subject" type="button" class="btn btn-info"
                data-url-store="{{route('subjects.store')}}" data-url="{{route('subjects.index-ajax')}}">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="undo-create-subject" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem">
            <i class="fa fa-undo" style="margin-right: 0.5rem"></i>Отменить</button>
    </div>
</form>


