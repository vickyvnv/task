@extends('layout')

@section('content')
<style>
    .uper {
        margin-top: 40px;
    }
</style>
<div class="card uper">
    <div class="card-header">
        Edit Task
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif
        <a href="{{ route('task.create')}}" class="btn btn-primary" style="">Create Task</a><br><br>
        <form method="post" action="{{ route('task.update', $tasks->id ) }}">
            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="task_name">Task Name:</label>
                <input type="text" class="form-control" name="task_name" value="{{ $tasks->task_name }}"/>
            </div>
            <div class="form-group">
                <label for="priority">Priority :</label>
                <select name="priority" id="priority">
                    <option value="{{ $tasks->priority }}">{{ $tasks->priority }}</option>
                    <? for ($pri=1; $pri <= 5; $pri++): ?>
                        <option value="<?=$pri;?>"><?=$pri;?></option>
                    <? endfor; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection