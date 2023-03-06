@if (count($staffs))
    @foreach($staffs as $staff)
        <tr class="showStaff" data-value="{{$staff->id}}">
            <td>{{ $staff->name }}</td>
            <td>{{ $staff->short_name }}</td>
            <td>{{ $staff->positions->pluck('short_title')->join(', ') }} </td>
        </tr>
    @endforeach
@else
    <p>Сотрудников пока нет...</p>
@endif
