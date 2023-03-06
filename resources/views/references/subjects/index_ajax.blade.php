@if (count($subjects))
    @foreach($subjects as $subject)
        <tr class="showSubject text-wrap" data-value="{{$subject->id}}">
            <td>{{ $subject->title }}</td>
            <td>{{ $subject->short_title }}</td>
            <td> @if ($subject->profile->short_title != null) {{ $subject->profile->short_title }} @else - @endif </td>
            <td> @if ($subject->hard1_4 != null) {{ $subject->hard1_4 }} @else - @endif</td>
            <td>@if ($subject->hard5 != null) {{ $subject->hard5 }} @else - @endif</td>
            <td>@if ($subject->hard6 != null) {{ $subject->hard6 }} @else - @endif</td>
            <td>@if ($subject->hard7 != null) {{ $subject->hard7 }} @else - @endif</td>
            <td>@if ($subject->hard8 != null) {{ $subject->hard8 }} @else - @endif</td>
            <td>@if ($subject->hard9 != null) {{ $subject->hard9 }} @else - @endif</td>
            <td>@if ($subject->hard10_11 != null) {{ $subject->hard10_11 }} @else - @endif</td>
        </tr>
    @endforeach
@else
    <p>Кабинетов пока нет...</p>
@endif
