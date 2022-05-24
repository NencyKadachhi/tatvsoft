@extends('layout.layout')
<a href="{{ route('logout') }}">Logout</a>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    You are Logged In
                </div>
                <a type="button" class="btn btn-primary" href="{{ route('create') }}">Create Blog</a>
                <br>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Blog Image</th>
                            <th scope="col">Blog Title</th>
                            <th scope="col">Blog Description</th>
                            <th scope="col">Blog Tags</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($blog_list))
                            @foreach ($blog_list as $blogs)
                                <tr>
                                    <td><img src="{{ url($blogs->image) }}" style="width:100px;height:100px;"></td>
                                    <td>{{ substr($blogs->title, 0, 10) . '...' }}</td>
                                    <td>{{ substr($blogs->description, 0, 10) . '...' }}</td>
                                    <td>{{ substr($blogs->tags, 0, 20) . '...' }}</td>
                                    @if (auth()->user()->id == $blogs->user_id)
                                        <td><a type="button" class="btn btn-success"
                                                href="{{ route('edit', $blogs->id) }}">Edit</a></td>
                                        <td><a type="button" class="btn btn-success"
                                                href="{{ route('delete', $blogs->id) }}">Delete</a></td>
                                    @endif

                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
