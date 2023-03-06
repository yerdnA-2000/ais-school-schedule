@if (count($sch))
    <div class="card-body table-responsive p-0" style="max-height: 470px;" id="sch-by-teacher">
        <table class="table table-bordered table-hover text-nowrap table-head-fixed">
            <thead class="ta-c">
            <tr class="tr-w-sort" title="Нажмите для сортировки">
                <th class="th-w-sort" style="background-color: var(--th-color)"
                    data-url="" data-status="0" data-type="updatedAt">
                    День</th>
                <th class="th-w-sort" style="background-color: var(--th-color)"
                    data-url="" data-status="0" data-type="createdAt">
                    №</th>
                @foreach($staffs as $staff)
                <th class="th-w-sort" style="background-color: var(--th-color)"
                    data-url="" data-status="0" data-type="staff">
                    {{$staff->getName()}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody id="re-tbody">
            <?php $c = 0 ?>
            @foreach($sch as $t)
                <tr class="showStaff text-wrap">
                    @if ($c == 0 or $c == 5 or $c == 10 or $c == 15 or $c == 20)
                        <td rowspan="5" class="ta-c td-weekday">
                            <span style="text-align: center">{{$t->getWeekDay()}}</span>
                        </td>
                    @endif
                    <td class="ta-c">{{ $t->getNumber() }}</td>
                    @foreach($staffs as $staff)
                            <?php $isEmpty = 1?>
                            @foreach($t->getLessons() as $l)
                                @if($l->getTeacher()->getId() == $staff->getId())
                                <td style="padding: 0.2rem; height: inherit">
                                    <div class="lesson-color" style="background-color: {{$l->getSubject()->getColor()}}; padding: 0.5rem; border-radius: 0.7rem">
                                        <b>{{$l->getSubject()->getTitle()}}</b> <br>
                                        <em>{{ $l->getClass()->gettitle() }}</em>, к.{{$l->getTeacher()->getCabinet()}}
                                        {{--{{$l->getClass()->getTitle()}}--}}
                                    </div>
                                </td>
                                <?php $isEmpty = 0?>
                                    @break
                                @endif
                            @endforeach
                            @if ($isEmpty == 1)
                                <td style="padding: 0.2rem; height: inherit">
                                </td>
                                @endif
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

