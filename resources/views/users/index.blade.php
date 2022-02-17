<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mt-6">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success mt-4">
                        {{ session('status') }}
                    </div>
                @endif
                @foreach($users as $user)
                    <div class="card mb-4">
                        <h5 class="card-header">{{$user->name}}</h5>
                        <div class="card-body">
                            <p>Role:
                                @foreach($user->roles as $role)
                                    {{$role['name']}}
                                @endforeach
                            </p>
                            <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary">Edit</a>
                            <form action="{{route('users.destroy', $user->id)}}" method="post" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
