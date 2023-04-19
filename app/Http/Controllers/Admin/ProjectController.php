<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\New_;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : "updated_at";
        $order = (!empty($order_request = $request->get('order'))) ? $order_request : "DESC";
        $projects = Project::orderBy($sort, $order)->paginate(10)->withQueryString();

        return view('admin.projects.index', compact('projects', 'sort', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        $types = Type::all();

        return view('admin.projects.create', compact('project', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //*  Validazione 
        $data = $this->validation($request->all());

        //* Metodo caricamento immagine 
        if (Arr::exists($data, 'pic')) {

            $img_path = Storage::put('uploads/projects', $data['pic']);
            $data['pic'] =  $img_path;
        }

        $project = new Project;
        $project->fill($data);
        $project->save();

        return to_route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();

        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = $this->validation($request->all());

        //* Metodo caricamento immagine   
        if (Arr::exists($data, 'pic')) {
            if ($project->pic) Storage::delete($project->pic);
            $img_path = Storage::put('uploads/projects', $data['pic']);
            $data['pic'] =  $img_path;
        }

        $project->update($data);
        return to_route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->pic) Storage::delete($project->pic);
        $project->delete();


        return to_route('admin.projects.index');
    }

    //   Validazione 

    private function validation($data)
    {
        $validator = Validator::make(

            $data,
            [
                'title'  => 'required|string|max:100',
                'pic' => 'nullable|image|mimes:png,jpg,jpeg',
                'description' => 'required|string',
                'languages' => 'required',
                'link' => 'nullable|string',
                'type_id' => 'nullable|exists:types,id'
            ],
            [
                'title.required' => 'il campo è richiesto',
                'description.required' => 'il campo è richiesto',
                'languages.required' => 'il campo è richiesto',

                'title.string' => 'il campo deve essere una stringa',
                'pic.image' => 'Il file caricato deve essere un immagine',
                'description.string' => 'il campo deve essere una stringa',
                'link.string' => 'il campo deve essere una stringa',

                'title.max' => 'il campo deve avere massimo 100 caratteri',
                'pic.mimes' => 'Le estensioni accettate sono:png,jpg,jpeg',
                'type_id.exists' => 'L\'id della categoria non è valido',
            ]
        )->validate();
        return $validator;
    }
}
