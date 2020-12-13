<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use Illuminate\Http\Request;
use App\Models\ControlTag;
use App\User;

class UserTagsController extends Controller
{
    private $objuser;
    private $objTags;

    public function __construct()
    {
        $this->objuser = new User();
        $this->objTags = new ControlTag();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd($this->objuser->find(1)->relTags);
        $tag = $this->objTags->all()->sortByDesc('id');                
        return view('admin.pages.users.index', compact('tag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->objuser->all();
        return view('admin.pages.users.create', compact('users'));
    }

    public function tagCreate(Request $request) {                      

        echo auth()->user()->id.'<br>';
        echo $request->nome.'<br>';
        echo $request->language.'<br>';
        echo $request->image.'<br>';
        $cadTag = $this->objTags->create([
            'id_user' => auth()->user()->id, 
            'nome' => $request->nome,
            'language' => $request->language,
            'image' => $request->image
        ]);
        if($cadTag){
            return redirect('users');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $cadTag = $this->objTags->create([
            'id_user' => $request->id_user, 
            'nome' => $request->nome,
            'language' => $request->language,
            'image' => $request->image
        ]);
        if($cadTag){
            return redirect('users');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = $this->objTags->find($id);
        return view('admin.pages.users.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = $this->objTags->find($id);
        $users = $this->objuser->all();
        return view('admin.pages.users.create', compact('tags', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id)
    {
        $this->objTags->where(['id'=>$id])->update([
            'id_user' => $request->id_user, 
            'nome' => $request->nome,
            'language' => $request->language,
            'image' => $request->image
        ]);
        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del=$this->objTags->destroy($id);
        return($del)?"Excluido com Sucesso":"Houve alguma problema na exclusão";
    }
}
