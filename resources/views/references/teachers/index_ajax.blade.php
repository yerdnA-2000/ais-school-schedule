@if (count($teachers))
    @foreach($teachers as $teacher)
        @if ($teacher->subjects->count())
            <tr class="showTeacher text-wrap" data-value="{{$teacher->id}}">
                <td>{{ $teacher->short_name }}</td>
                <td>{{ $teacher->subjects->pluck('short_title')->join(', ') }} </td>
            </tr>
        @endif
    @endforeach
@else
    <p>Сотрудников пока нет...</p>
@endif
