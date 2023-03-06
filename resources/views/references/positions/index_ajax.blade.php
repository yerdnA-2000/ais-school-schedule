@if (count($positions))
    @foreach($positions as $position)
        <tr class="showPosition" data-value="{{$position->id}}">
            <td>{{ $position->title }}</td>
            <td>{{ $position->short_title }}</td>
        </tr>
    @endforeach
@else
    <p>Должностей пока нет...</p>
@endif
