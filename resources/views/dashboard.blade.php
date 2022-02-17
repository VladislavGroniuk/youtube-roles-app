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
                @if(auth()->user()->can('add posts'))
                    <a href="{{route('add-post')}}" class="btn btn-success mb-4">Add new post</a>
                @endif
                @if(auth()->user()->can('show posts'))
                    @foreach($posts as $post)
                        <div class="card mb-4">
                            <h5 class="card-header">{{$post->name}}</h5>
                            <div class="card-body">
                                <p>{{$post->created_at}}</p>
                                @if(auth()->user()->can('edit posts'))
                                    <a href="{{route('edit-post', $post->id)}}" class="btn btn-primary">Edit</a>
                                @endif
                                @if(auth()->user()->can('delete posts'))
                                    <form action="{{route('delete-post', $post->id)}}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
