<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <link href="{{ asset('css/app2.css') }}" rel="stylesheet" type="text/css" />
   
    <div class="card uper">
    <div class="card-header"> Add Task </div>
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
        <form method="post" action="{{ route('project.store') }}">
            <div class="form-group">
                @csrf
                <label for="project">Project Name:</label>
                <input type="text" class="form-control" name="project"/>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Project</button>
        </form>
    </div>
</div>
</x-app-layout>
