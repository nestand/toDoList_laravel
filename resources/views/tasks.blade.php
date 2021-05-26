@extends('layout.app')

@section('content')
    <div class="panel-body">
        @include('common.errors')

        <form action="{{ url('tasks') }} method=" post" class="form-horizontal">
            {{-- against CSRF attacks, we need to include empty CSRF field --}}
            {{ csrf_field() }}
        </form>

        @if (count($tasks) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    Current Tasks
                </div>
                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Task</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ $task->name }}</div>
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection


{{--  
old code

<div class="form-group">
    <label for="task" class="col-sm-3 control-label">Task</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="name" id="task">
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-6">
        <button class="btn btn-default">
            <i class="fa fa-plus"></i>Add Task
        </button>
    </div>
</div>

</div>
--}}