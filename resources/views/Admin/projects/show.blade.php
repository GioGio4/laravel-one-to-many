@extends('layouts.app')

@section('content')
    <h3 class="my-3 text-center">{{ $project->title }}</h3>
    <div class="card my-3">
        <div class="row g-0">
            <div class="col-md-12">
                <div class="card-body">
                    <p class="card-text"><strong>ID - </strong> {{ $project->id }} </p>
                    <p class="card-text"><strong>Title - </strong> {{ $project->title }} </p>
                    <p class="card-text"><strong>Description - </strong> {{ $project->description }}</p>

                    <p class="card-text">
                        <strong>Type -</strong>
                        <span style="background-color:{{ $project->type?->color }} ">{{ $project->type?->name }}</span>
                    </p>

                    <p class="card-text"><strong>Languages - </strong> {{ $project->languages }}</p>
                    <p class="card-text"><strong>Project link - </strong> {{ $project->link }}</p>
                    <p class="card-text"><strong>Image - </strong></p>
                    <div class="col-2">
                        <img src="{{ $project->getImageUri() }}" alt="project-image" class="form-box-img ">
                    </div>
                    <p class="card-text"><strong>Create - </strong> {{ $project->created_at }}</p>
                    <p class="card-text"><strong>Last update - </strong> {{ $project->updated_at }}</p>
                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-secondary">Edit</a>

                </div>
            </div>
        </div>
    </div>
    <div class="d-flex mt-3 justify-content-end">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Return to projects</a>
    </div>
@endsection
