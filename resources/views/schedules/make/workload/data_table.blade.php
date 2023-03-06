@if (count($workloads))
    @foreach($workloads as $wl)
        <tr class="showStaff text-wrap" data-value="{{$wl->id}}">
            <td>{{ $wl->staff->short_name }}</td>
            <td>{{ $wl->subject->short_title }}</td>
            <td>{{ $wl->class->title }}</td>
            <td>{{ $wl->week_hours }}</td>
        </tr>
    @endforeach
@else
    <p>Нагрузок нет. Создайте новые в карточке справа</p>
@endif
