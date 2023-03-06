@if (count($restricts))
    @foreach($restricts as $r)
        <tr class=" text-wrap">
            <td>{{ $r['type'] }}</td>
            <td class="text-wrap" style="white-space: break-spaces">{{ $r['desc'] }}</td>
            <td style="white-space: nowrap">
                <div class="d-flex">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" checked="">
                        <label class="form-check-label">Использовать</label>
                    </div>
                    <a class="btn btn-outline-danger btn-sm ml-3" href="#" style="font-size: 0.7rem">
                        <i class="fas fa-trash mr-2"></i>Удалить</a>
                </div>
            </td>
        </tr>
    @endforeach
@else
    <p>Пользовательских ограничений нет. Чтобы создать новое, нажмите на кнопку "Создать"</p>
@endif
