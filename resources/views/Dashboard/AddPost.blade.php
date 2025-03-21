@extends('Files.adminMaster')
@section('content')
    {{-- @section('admin') --}}
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
    <div class="row">
        <p class="col-sm-12 h2">Add New Post</p>
        <div class="col-sm-12">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="post" action="{{ route('addPosts') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="h4">Post Title</label>
                        <input class='form-control' type='text' name='p_title' value="{{ old('p_title') }}" required
                            placeholder="Post Title" />
                    </div>
                    <div class="form-group">
                        <label class="h4">Post URL</label>
                        <input class='form-control' type='text' name='p_url' value="{{ old('p_url') }}" required
                            placeholder="Post Url" />
                    </div>
                    @error('p_url')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label class="h4">Short Description</label>
                        <textarea class='form-control' name='short_des' value="{{ old('short_des') }}" required placeholder="Short Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="h4">Post Image</label>
                        <input class='form-control' type='file' name='p_image' value="{{ old('p_image') }}">
                    </div>
                    <div class="group-form">
                        <label class="h4">Post Description</label>
                        <textarea class="ckeditor" name="p_description" id="tinymce">{{ old('p_description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="h4">Meta Title</label>
                        <input class='form-control' type='text' name='meta_title' value="{{ old('meta_title') }}"
                            required placeholder="Meta Tile" />
                    </div>
                    <div class="form-group">
                        <label class="h4">Meta Description</label>
                        <input class='form-control' type='text' name='meta_description'
                            value="{{ old('meta_description') }}" required placeholder="Meta Description" />
                    </div>
                    <div class="form-group mt-3 mb-5">
                        <input type="submit" name="submit" class="btn btn-primary" value="Add Post">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            "use strict";
            $(window).on('load', function() {
                tinymce.init({
                    selector: "textarea#tnymce_editor",
                    plugins: "print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons",
                    menubar: "file edit view insert format tools table help",
                    toolbar: "undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl",
                    toolbar_sticky: false,
                    autosave_ask_before_unload: true,
                    autosave_retention: "2m",
                    image_advtab: true,
                    importcss_append: true,
                    height: 400,
                    image_caption: true,
                    quickbars_selection_toolbar: "bold italic | quicklink h2 h3 blockquote quickimage quicktable",
                    noneditable_noneditable_class: "mceNonEditable",
                    toolbar_mode: "sliding",
                    contextmenu: "link image imagetools table",
                });
            });
        });
    </script>
@endsection
