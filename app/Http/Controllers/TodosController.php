<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodosController extends Controller
{
    public function index() {

        //fetch all todos from database
        //display this in todos page
        $todos = Todo::all();
        return view('todos.index')->with('todos',$todos);
    }
    public function show(Todo $todo){
        
        //$todo=Todo::find($todoId);
        return view('todos.show')->with('todo',$todo);
    }
    public function create(){
        return view('todos.create');
    }
    public function store(){
        $this->validate(request(),[
            'name' =>'required',
            'description'=>'required'
        ]);
        $data=request()->all();

        $todo = new Todo();
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->completed = false;
        $todo->save();

        session()->flash('success','Todo created successfully');
        return redirect('/todos');

    }
    public function edit(Todo $todo){
        //$todo=Todo::find($todoId);

        return view('todos.edit')->with('todo',$todo);
    }
    public function update(Todo $todo){
        $this->validate(request(),[
            'name' =>'required',
            'description'=>'required'
        ]);
        $data=request()->all();
        //$todo=Todo::find($todoId);

        $todo->name=$data['name'];
        $todo->description=$data['description'];
        $todo->save();
        session()->flash('success','Todo updated successfully');

        return redirect('/todos');
    }
    public function destroy(Todo $todo){
        //$todo=Todo::find($todoId);

        $todo->delete();
        session()->flash('delete','Todo deleted successfully');
        return redirect('/todos');
    }
    public function complete(Todo $todo){
        $todo->completed= true;
        $todo->save();

        session()->flash('success','Todo completed successfully');
        return redirect('/todos');
    }

}
