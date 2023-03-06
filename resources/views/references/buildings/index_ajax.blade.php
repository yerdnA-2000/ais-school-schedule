@if (count($buildings))
    @foreach($buildings as $building)
        <tr class="showBuilding" data-value="{{$building->id}}">
            <td>{{ $building->title }}</td>
            <td> @if ($building->is_schedule == 0) Нет @else Да @endif </td>
        </tr>
    @endforeach
@else
    <p>Звонков пока нет...</p>
@endif
