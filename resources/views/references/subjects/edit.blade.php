<form id="update" method="post" role="form"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div style="display: flex; flex-direction: column">
        <div class="form-group" style="width: 100%;">
            <label for="title">Наименование</label>
            <input type="text" name="title"
                   class="form-control @error('title') is-invalid @enderror"
                   id="title" value="{{$subject->title}}">
        </div>

        <div class="form-group" style="width: 100%;">
            <label for="short_title">Краткое наименование</label>
            <input type="text" name="short_title"
                   class="form-control @error('short_title') is-invalid @enderror"
                   id="short_title" value="{{$subject->short_title}}">
        </div>

        <div class="form-group">
            <label for="profile">Профиль</label>
            <select class="form-control @error('profile') is-invalid @enderror"
                    id="profile" name="profile" style="width: 100%">
                @foreach($profiles as $key => $value)
                    <option value="{{ $key }}" @if($key == $subject->profile_id) selected @endif >
                        {{ $value }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group d-flex" style="width: 100%; flex-wrap: wrap">
            <div class="form-group hard-subject">
                <label for="hard1_4">1-4 классы</label>
                <input type="number" name="hard1_4"
                       class="form-control @error('hard1_4') is-invalid @enderror"
                       id="hard1_4" placeholder="-" value="{{$subject->hard1_4}}"></div>
            <div class="form-group hard-subject">
                <label for="hard5">5 класс</label>
                <input type="number" name="hard5"
                       class="form-control @error('hard5') is-invalid @enderror"
                       id="hard5" placeholder="-" value="{{$subject->hard5}}"></div>
            <div class="form-group hard-subject">
                <label for="hard6">6 класс</label>
                <input type="number" name="hard6"
                       class="form-control @error('hard6') is-invalid @enderror"
                       id="hard6" placeholder="-" value="{{$subject->hard6}}"></div>
            <div class="form-group hard-subject">
                <label for="hard6">7 класс</label>
                <input type="number" name="hard7"
                       class="form-control @error('hard7') is-invalid @enderror"
                       id="hard7" placeholder="-" value="{{$subject->hard7}}"></div>
            <div class="form-group hard-subject">
                <label for="hard8">8 класс</label>
                <input type="number" name="hard8"
                       class="form-control @error('hard8') is-invalid @enderror"
                       id="hard8" placeholder="-" value="{{$subject->hard8}}"></div>
            <div class="form-group hard-subject">
                <label for="hard9">9 класс</label>
                <input type="number" name="hard9"
                       class="form-control @error('hard9') is-invalid @enderror"
                       id="hard9" placeholder="-" value="{{$subject->hard9}}"></div>
            <div class="form-group hard-subject">
                <label for="hard10_11">10-11 класс</label>
                <input type="number" name="hard10_11"
                       class="form-control @error('hard10_11') is-invalid @enderror"
                       id="hard10_11" placeholder="-" value="{{$subject->hard10_11}}"></div>
        </div>
    </div>

    <div id="actions-edit" class="mt-3">
        <button id="save-edit-subject" type="button" class="btn btn-info"
                data-url-update="{{route('subjects.update', ['subject' => $subject->id])}}"
                data-url="{{route('subjects.index-ajax')}}"
                data-value="{{$subject->id}}">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="delete-subject" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem"
                data-url-delete="{{route('subjects.destroy', ['subject' => $subject->id])}}"
                data-url="{{route('subjects.index-ajax')}}"
                data-value="{{$subject->id}}">
            <i class="fa fa-trash" style="margin-right: 0.5rem"></i>Удалить</button>
    </div>
</form>
