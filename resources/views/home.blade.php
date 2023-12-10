@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @can('isAdmin')
                            <div class="btn btn-success btn-lg">
                                You have Admin Access
                            </div>
                        @elsecan('isManager')
                            <div class="btn btn-primary btn-lg">
                                You have Manager Access
                            </div>
                        @else
                            <div class="btn btn-info btn-lg">
                                You have User Access
                            </div>
                        @endcan



                        <table border="1" cellpadding="10" style="margin-top:5px">
                            <th>
                                <tr>
                                    <td>Name</td>
                                    <td>Type</td>
                                    <td>user</td>
                                    <td>Action</td>
                                </tr>
                            </th>
                            @foreach($posts as $post)
                            <tbody>
                            <tr>
                                <td>{{ $post->name }}</td>
                                <td>{{ $post->type }}</td>
                                <td>{{ $post->user_id }}</td>
                                <td>
                                    @can('view', $post)
                                    <button>View</button>
                                    @endcan

                                    @can('update', [$post, 1])
                                        <button><a href="{{ url('post/edit/'.$post->id) }}">Edit</a></button>
                                    @endcan
                                        <button><a href="{{ url('post/edit/'.$post->id) }}">Unauthorized Edit Check</a></button>
                                </td>
                            </tr>
                            </tbody>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
