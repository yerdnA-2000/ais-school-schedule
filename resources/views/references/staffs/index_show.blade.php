<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        border-color: #3A97FF;
    }
</style>
<div id="show" >
    <div style="display: flex; flex-direction: column">
        <div class="form-group" style="width: 100%;">
            <label for="name">ФИО</label>
            <input type="text" name="name" disabled
                   class="form-control @error('name') is-invalid @enderror"
                   id="name" value="{{$staff->name}}">
        </div>

        <div class="form-group" style="width: 100%;">
            <label for="short_name">Инициалы</label>
            <input type="text" name="short_name" disabled
                   class="form-control @error('short_name') is-invalid @enderror"
                   id="short_name" value="{{$staff->short_name}}">
        </div>

        <div class="form-group">
            <label for="positions">Должности</label>
            <select class="select2" disabled
                    multiple="multiple" id="positions" style="width: 100%; border: none">
                @foreach($positions as $k => $v)
                    <option value="{{ $k }}" @if(in_array($k, $staff->positions->pluck('id')->all())) selected @endif >
                        {{ $v }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#positions').select2();
    });
</script>
