<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">История задачи</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>Когда изменилось</th>
                    <th>Пользователь</th>
                    <th>Где изменилось</th>
                    <th>Что изменилось</th>
                </tr>
                </thead>
                <tbody>
                @foreach($stories as $story)
                    <tr class="even">
                        <td>{{ $story->getDate() }}</td>
                        <td>{{ $story->author->name }}</td>
                        <td>{{ $story->where_changed }}</td>
                        <td><span style="color: gray">{{ $story->last_value}}</span>
                            <i class="fa fa-long-arrow-alt-right" style="margin: 0.2em"></i>
                            {{ $story->current_value }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->

</div>
<!-- /.card -->
