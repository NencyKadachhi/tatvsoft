@extends('layout.layout')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="cotainer">
    <button type="button" class="btn btn-info">Edit</button>
    <div class="col-md-4 col-md-offset-4">

        <form action="{{ route('update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">Blog Title</label>
                <input type="text" class="form-control" name="title" value="{{ $blog->title }}"
                    placeholder="Enter Blog Title">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Blog Description</label>
                <textarea class="form-control" name="description" rows="3">{{ $blog->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Tags</label>
                <input type="text" class="w-100" id="tagnames" name="tags" data-role="tagsinput"  value="@foreach($blog_tag as $tags){{$tags->tag_name.','}}@endforeach">

            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Blog Image</label>
                <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1">
                <img src="{{ url($blog->image) }}" alt="">
            </div>
            <div class="form-group">
                <input type="submit" id="submit">
            </div>
        </form>
    </div>
</div>
@push('script')
    <script type="text/javascript">
        $('#form').validate({
            rules: {
                title: {
                    required: true,
                    maxlength: 255
                },
                description: "required",
                tags: "required",
            },
            messages: {
                title: {
                    required: "Titke Field Is Required",
                    maxlength: "Title MAxLength Should be atleast 255"
                },
                description: "Description Field Is Required",
                tags: "Tags Field Is Required",

            }
        });
    </script>
@endpush
