@extends('layout')

@section('content')
<style>
    .uper {
        margin-top: 40px;
    }
</style>
<div class="uper">
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
    @endif
    <a href="{{ route('task.create')}}" class="btn btn-primary" style="">Create Task</a><br><br>

<div class="row mt-5">
    <div class="col-md-10 offset-md-1">
        <h3 class="text-center mb-4">List Task</h3>
            <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="30px">#</th>
                        <th>Task Name</th>
                        <th>Priority</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tablecontents">
                    @foreach($tasks as $task)
    	                <tr class="row1" data-id="{{ $task->id }}">
                            <td class="pl-3"><i class="fa fa-sort">{{ $task->id }}</i></td>
                            <td>{{ $task->task_name }}</td>
                            <td>{{ $task->priority }}</td>
                            <td>
                            <a href="{{ route('task.edit', $task->id)}}" class="btn btn-primary">Edit</a><br>
                            <form action="{{ route('task.destroy', $task->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form></td>
    	                </tr>
                    @endforeach
                </tbody>                  
            </table>
            <hr>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#table").DataTable();

        $( "#tablecontents" ).sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                sendOrderToServer();
            }
        });

        function sendOrderToServer() {
            var order = [];
            var token = $('meta[name="csrf-token"]').attr('content');
            $('tr.row1').each(function(index,element) {
                order.push({
                id: $(this).attr('data-id'),
                position: index+1
                });
            });

            $.ajax({
                type: "POST", 
                dataType: "json", 
                url: "{{ url('post-sortable') }}",
                    data: {
                order: order,
                _token: token
                },
                success: function(response) {
                    if (response.status == "success") {
                    console.log(response);
                    } else {
                    console.log(response);
                    }
                }
            });
        }
    });
</script>
@endsection