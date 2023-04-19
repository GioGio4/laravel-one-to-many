@extends('layouts.app')

@section('content')
    <h3 class="my-3 text-center">Create new project</h3>
    <div class="card my-3">
        <div class="row g-0">
            <div class="col-md-12">
                <div class="card-body">
                    <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data"
                        class="row g-3">
                        @csrf

                        <div class="col-5">
                            <label for="title" class="form-label"><strong>Title</strong></label>
                            <input type="text" name="title" id="title"
                                class="form-control  @error('title') is-invalid @enderror" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-5">
                            <label for="link" class="form-label"><strong>Project link</strong></label>
                            <input type="text" name="link" id="link"
                                class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}">
                            @error('link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-2">
                            <label for="languages" class="form-label"><strong>Languages</strong></label>
                            <select class="form-select" aria-label="Default select example" name="languages" id="languages">
                                <option value="php" class="{{ old('languages') == 'php' ? 'selected' : '' }}">PHP
                                </option>
                                <option value="html" class=" {{ old('languages') == 'html' ? 'selected' : '' }}">HTML
                                </option>
                                <option value="javascript"class="{{ old('languages') == 'javascript' ? 'selected' : '' }}">
                                    Javascript
                                </option>
                            </select>
                        </div>

                        <div class="col-5">
                            <label for="type_id" class="form-label"><strong>Type</strong></label>
                            <select class="form-select @error('type_id') is-invalid @enderror"
                                aria-label="Default select example" name="type_id" id="type_id">
                                <option value="">No Type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('type_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-10">
                            <label for="description" class="form-label"><strong>Description</strong></label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                rows="6">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-2 text-center">
                            <label for="current-image" class="form-label"><strong>Current Image</strong></label>
                            <img src="{{ $project->getImageUri() }}" name="current-image" alt="project-image"
                                class="form-box-img ">
                        </div>

                        <div class="col-12">
                            <label for="pic" class="form-label"><strong>Image</strong></label>
                            <input type="file" name="pic" id="pic"
                                class="form-control @error('pic') is-invalid @enderror">
                            @error('pic')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-auto">
                            <input type="submit" value="Save" class="btn btn-primary mt-3">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex mt-3 justify-content-end">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Return to projects</a>
    </div>
@endsection
