<form id="store-restrict" method="post" role="form"
      enctype="multipart/form-data">
    @csrf
    <div style="display: flex; flex-direction: column">
        <div class="form-group" style="width: 100%;">
            <label for="type-chose">Тип</label>
            <select name="typeId" class="form-control @error('typeId') is-invalid @enderror"
                    id="type-chose" autocomplete="off" style="width: 100%;" required>
                <option selected disabled>Выберите тип</option>
                <option value="1">Физическая культура</option>
                {{--@foreach($staffs as $k => $v)
                    <option value="{{ $k }}">{{ $v }}</option>
                @endforeach--}}
            </select>
        </div>
        <div id="arrow-down" class="row" style="font-size: 1.5rem; opacity: 0.6; margin: 0 auto; color: #2fa6c7">
            <i class="fas fa-arrow-down"></i>
        </div>
        <div class="form-group" style="width: 100%;">
            <label for="subject">Предмет из справочника</label>
            <select name="subjectId" class="form-control @error('subjectId') is-invalid @enderror"
                    id="subject" autocomplete="off" style="width: 100%;" required>
                <option selected disabled>Выберите предмет</option>
                <option value="1">Физическая культура</option>
            </select>
        </div>
        <div class="form-group" style="width: 100%;">
            <label for="desc">Описание</label><br>
            <span><em>На уроке физической культуры могут заниматься одновременно:</em></span>
            <div class="d-flex">
                <span style="margin: auto 1rem auto 0"><em>не более</em></span>
                <select name="desc" class="form-control @error('desc') is-invalid @enderror"
                        id="type-chose" autocomplete="off" style="width: 40%;" required>
                    <option selected disabled>Выберите кол-во</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                <span style="margin: auto 0 auto 1rem"><em>классов</em></span>
            </div>

        </div>

    </div>
    <div class="mt-3">
        <button id="btn-store-restrict" type="button" class="btn btn-info"
                data-url-store="">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="clear-inputs" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem">
            <i class="fa fa-undo" style="margin-right: 0.5rem"></i>Очистить</button>
    </div>
</form>

