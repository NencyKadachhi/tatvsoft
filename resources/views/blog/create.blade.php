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
    <div class="col-md-4 col-md-offset-4">
        <h1>Create Blog</h1>

        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data" id="form">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">Blog Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter Blog Title">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Blog Description</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Tags</label>
                <input class="form-control" type="text" data-role="tagsinput" name="tags">
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Blog Image</label>
                <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1">
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
                file: {
                    required: true,
                    extension: "jpg|jpeg|png"
                },
                description: "required",
                tags: "required",
            },
            messages: {
                title: {
                    required: "Titke Field Is Required",
                    maxlength: "Title MAxLength Should be atleast 255"
                },
                file: {
                    required: "Please upload file.",
                    extension: "Please upload file in these format only (jpg, jpeg, png)."
                },
                description: "Description Field Is Required",
                tags: "Tags Field Is Required",

            }
        });
    </script>
@endpush
