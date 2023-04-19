@extends('layouts.app')

@section('content')
    <div class="d-flex mt-3 justify-content-end">
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary mt-3">Create new project</a>
    </div>
    <table class="table table-primary table-striped mt-3">
        <thead>
            <tr>
                <th scope="col"><a
                        href="{{ route('admin.projects.index') }}?sort=id&order=@if ($sort == 'id' && $order != 'DESC') DESC @else ASC @endif">ID
                        @if ($sort == 'id')
                            <i class="bi bi-arrow-down d-inline-block @if ($order == 'DESC') rotate @endif"></i>
                        @endif
                    </a>
                </th>


                <th scope="col"><a
                        href="{{ route('admin.projects.index') }}?sort=title&order=@if ($sort == 'title' && $order != 'DESC') DESC @else ASC @endif">Title
                        @if ($sort == 'title')
                            <i class="bi bi-arrow-down d-inline-block @if ($order == 'DESC') rotate @endif"></i>
                        @endif
                    </a>
                </th>

                <th scope="col" class="text-center">Type</th>


                <th scope="col"><a
                        href="{{ route('admin.projects.index') }}?sort=languages&order=@if ($sort == 'languages' && $order != 'DESC') DESC @else ASC @endif">Languages
                        @if ($sort == 'languages')
                            <i class="bi bi-arrow-down d-inline-block @if ($order == 'DESC') rotate @endif"></i>
                        @endif
                    </a>
                </th>

                <th scope="col"><a
                        href="{{ route('admin.projects.index') }}?sort=created_at&order=@if ($sort == 'created_at' && $order != 'DESC') DESC @else ASC @endif">Created
                        @if ($sort == 'created_at')
                            <i class="bi bi-arrow-down d-inline-block @if ($order == 'DESC') rotate @endif"></i>
                        @endif
                    </a>
                </th>
                <th scope="col"><a
                        href="{{ route('admin.projects.index') }}?sort=updated_at&order=@if ($sort == 'updated_at' && $order != 'DESC') DESC @else ASC @endif">Updated
                        @if ($sort == 'updated_at')
                            <i class="bi bi-arrow-down d-inline-block @if ($order == 'DESC') rotate @endif"></i>
                        @endif
                    </a>
                </th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>

            @forelse ($projects as $project)
                <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->title }}</td>
                    <td class="text-center"><span class="badge"
                            style="background-color:{{ $project->type?->color }} ">{{ $project->type?->name }}</span></td>
                    <td>{{ $project->languages }}</td>
                    <td>{{ $project->created_at }}</td>
                    <td>{{ $project->updated_at }}</td>
                    <td>
                        <a href="{{ route('admin.projects.show', $project) }}"><i class="bi bi-eye-fill"></i></a>
                        <a href="{{ route('admin.projects.edit', $project) }}" class="action-icon"><i
                                class="bi bi-pencil mx-2"></i>
                        </a>
                        <a type="button" class="text-danger" data-bs-toggle="modal"
                            data-bs-target="#delete-modal-{{ $project->id }}">
                            <i class="bi bi-trash mx-2"></i>
                        </a>
                    </td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    {{ $projects->links() }}

    <!-- Modal -->
    @foreach ($projects as $project)
        <div class="modal fade" id="delete-modal-{{ $project->id }}" tabindex="-1"
            aria-labelledby="delete-modal-{{ $project->id }}-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="delete-modal-{{ $project->id }}-label">
                            <i class="bi bi-exclamation-triangle-fill me-3 text-danger"></i>Delete Project ID -
                            {{ $project->id }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        Are you sure you want to delete the project <strong>{{ $project->title }}</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="">
                            @method('DELETE')
                            @csrf

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
