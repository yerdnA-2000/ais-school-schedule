@if (count($calls))
    @foreach($calls as $call)
        <tr class="showCall" data-value="{{$call->number}}" {{--data-href="{{route('calls.show', $call->number)}}"--}}>
            <td>{{ $call->number }}</td>
            <td>{{ $call->getTime('start') }}</td>
            <td>{{ $call->getTime('end') }}</td>
        </tr>
    @endforeach
@else
    <p>Звонков пока нет...</p>
@endif
