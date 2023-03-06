@if (count($profiles))
    @foreach($profiles as $profile)
        <tr class="showProfile" data-value="{{$profile->id}}">
            <td>{{ $profile->title }}</td>
            <td>{{ $profile->short_title }}</td>
        </tr>
    @endforeach
@else
    <p>Профилей пока нет...</p>
@endif
