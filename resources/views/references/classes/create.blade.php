<form id="create" method="post" role="form"
      enctype="multipart/form-data">
    @csrf
    <div style="display: flex; flex-direction: column">
        <div class="form-group" style="width: 100%;">
            <label for="title">Название</label>
            <input type="text" name="title"
                   class="form-control @error('title') is-invalid @enderror"
                   id="title" autocomplete="off" placeholder="Название класса">
        </div>

        <div class="form-group">
            <label for="head">Классный руководитель</label>
            <select class="form-control @error('head') is-invalid @enderror"
                    id="head" name="head" autocomplete="off" data-placeholder="Классный руководитель" style="width: 100%;">
                @foreach($staffs as $k => $v)
                    <option value="{{ $k }}">{{ $v }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="year">Учебный год</label>
            <select class="form-control @error('year') is-invalid @enderror"
                    id="year" name="year" autocomplete="off" data-placeholder="Учебный год" style="width: 100%;">
                <option value="2021-2022">2021-2022</option>
                <option value="2022-2023">2022-2023</option>
                <option value="2023-2024">2023-2024</option>
                <option value="2024-2025">2024-2025</option>
                <option value="2025-2026">2025-2026</option>
                <option value="2026-2027">2026-2027</option>
                <option value="2027-2028">2027-2028</option>
                <option value="2028-2029">2028-2029</option>
                <option value="2029-2030">2029-2030</option>
            </select>
        </div>
    </div>
    <div class="mt-3">
        <button id="store-create-class" type="button" class="btn btn-info"
                data-url-store="{{route('classes.store')}}" data-url="{{route('classes.index-ajax')}}">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="undo-create-class" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem">
            <i class="fa fa-undo" style="margin-right: 0.5rem"></i>Отменить</button>
    </div>
</form>


