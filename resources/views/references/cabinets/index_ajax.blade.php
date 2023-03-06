@if (count($cabinets))
    @foreach($cabinets as $cabinet)
        <tr class="showCabinet" data-value="{{$cabinet->id}}">
            <td>{{ $cabinet->title }}</td>
            <td>{{ $cabinet->profile->short_title }}</td>
            <td>{{ $cabinet->building->title }}</td>
            <td> @if ($cabinet->is_schedule == 0) Нет @else Да @endif </td>
        </tr>
    @endforeach
@else
    <p>Кабинетов пока нет...</p>
@endif
