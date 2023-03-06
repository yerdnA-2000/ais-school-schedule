@if (count($sch))
        <div class="card-body table-responsive p-0" style="max-height: 470px;" id="sch-by-class">
        <table class="table table-bordered table-hover text-nowrap table-head-fixed"  style="font-size: 1rem">
            <thead class="ta-c">
            <tr class="tr-w-sort" title="Нажмите для сортировки">
                <th class="th-w-sort" style="background-color: var(--th-color)">День</th>
                <th class="th-w-sort" style="background-color: var(--th-color)">№</th>
                @foreach($classesEdu as $class)
                    <th class="th-w-sort" style="background-color: var(--th-color)">
                        {{$class->getTitle()}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody id="re-tbody">
            <?php $c = 0 ?>
            @foreach($sch as $t)
                <tr class="showStaff text-wrap">
                    @if ($c == 0 or $c == 5 or $c == 10 or $c == 15 or $c == 20)
                        <td rowspan="5" class="ta-c td-weekday" {{--style="writing-mode: vertical-lr; text-orientation: upright;"--}}>
                            <span style="text-align: center">{{$t->getWeekDay()}}</span>
                        </td>
                    @endif
                    <td class="ta-c">{{ $t->getNumber() }}</td>
                    @foreach($t->getLessons() as $l)
                        <td style="padding: 0.2rem; height: inherit">
                            <div class="lesson-color" style="background-color: {{$l->getSubject()->getColor()}}; padding: 0.5rem; border-radius: 0.7rem">
                                <b>{{$l->getSubject()->getTitle()}}</b><br>
                                <em>{{ $l->getTeacher()->getName() }}</em>, к. {{$l->getTeacher()->getCabinet()}}
                                {{--{{$l->getClass()->getTitle()}}--}}
                            </div>
                        </td>
                    @endforeach
                </tr>
                <?php $c++ ?>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>Ошибка расчёта расписания!</p>
@endif
