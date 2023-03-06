<form id="store-workload" method="post" role="form"
      enctype="multipart/form-data">
    @csrf
    <div style="display: flex; flex-direction: column">
        <div class="form-group" style="width: 100%;">
            <label for="staff-chose">Учитель</label>
            <select name="staffId" class="form-control @error('staffId') is-invalid @enderror"
                    id="staff-chose" autocomplete="off" style="width: 100%;" required>
                <option selected disabled>Выберите учителя</option>
                @foreach($staffs as $k => $v)
                    <option value="{{ $k }}">{{ $v }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" style="width: 100%;">
            <label for="subject-chose">Предмет</label>
            <select name="subjectId" class="form-control @error('subjectId') is-invalid @enderror"
                    id="subject-chose" autocomplete="off" required>
                <option selected disabled>Выберите предмет</option>
                @foreach($subjects as $k => $v)
                    <option value="{{ $k }}">{{ $v }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group" style="width: 100%;">
            <label for="class-chose">Класс</label>
            <select name="classId" class="form-control @error('classId') is-invalid @enderror"
                    id="class-chose" autocomplete="off" style="width: 50%;" required>
                <option selected disabled>Выберите класс</option>
                @foreach($classes as $k => $v)
                    <option value="{{ $k }}">{{ $v }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group" style="width: 100%;">
            <label for="week-hours">Часов в неделю</label>
            <input type="number" name="weekHours"
                   class="form-control @error('weekHours') is-invalid @enderror" autocomplete="off"
                   id="week-hours" placeholder="Введите кол-во часов в неделю" style="width: 80%;" required>
        </div>
    </div>
    <div class="mt-3">
        <button id="btn-store-workload" type="button" class="btn btn-info"
                data-url-store="{{route('schedule.workloads.store', ['distId'=>$dist->id])}}">
            <i class="fa fa-save" style="margin-right: 0.5rem"></i>Сохранить</button>
        <button id="clear-inputs" type="button" class="btn btn-outline-secondary" style="margin-left: 0.5rem">
            <i class="fa fa-undo" style="margin-right: 0.5rem"></i>Очистить</button>
    </div>
</form>
