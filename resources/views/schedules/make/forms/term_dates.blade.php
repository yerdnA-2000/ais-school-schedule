<label for="start-date-term" style="display: block">Первый учебный день</label>
<input name="start_date" type='text' disabled="true"
       id="start-date-term" placeholder="Выберите дату"
       class="form-control @error('start_date') is-invalid @enderror"
       data-position="right center" @if($startDate != null) value="{{$startDate}}" @endif/>
<label for="finish-date-term" style="display: block">Крайний учебный день</label>
<input name="finish_date" type='text' disabled="true"
       id="finish-date-term" placeholder="Выберите дату"
       class="form-control @error('finish_date') is-invalid @enderror"
       data-position="right center" @if($finishDate != null) value="{{$finishDate}}" @endif/>
