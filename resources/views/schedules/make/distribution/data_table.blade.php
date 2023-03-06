@if (count($distributions))
    @foreach($distributions as $dist)
        <tr class="chose-dist-tr text-wrap" data-value="{{$dist->id}}">
            <td><div class="form-check">
                    <input class="form-check-input" type="radio"
                           name="distId" value="{{$dist->id}}">
                </div></td>
            <td>{{ $dist->title }} № {{ $dist->id }} на {{$dist->term->number}} четверть
                {{$dist->term->academicYear->getHumanAcademicYear()}}</td>
            <td>{{ $dist->getHumanUpdatedAt() }}</td>
            <td>{{ $dist->getHumanCreatedAt()}}</td>
        </tr>
    @endforeach
@else
    <p>Распределения нагрузок нет. Чтобы создать новую, нажмите на кнопку "Создать"</p>
@endif
