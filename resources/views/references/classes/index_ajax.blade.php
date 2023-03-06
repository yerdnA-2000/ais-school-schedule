@if (count($classes))
    @foreach($classes as $class)
        <tr class="showClass" data-value="{{$class->id}}">
            <td>{{ $class->title }}</td>
            <td>{{ $class->head->short_name }}</td>
            <td>{{ $class->year }}</td>
        </tr>
    @endforeach
@else
    <p>Классов пока нет...</p>
@endif
