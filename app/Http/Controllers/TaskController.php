<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;



class TaskController extends Controller
{
    public function index (Request $request){
    //filter for show tasks, if is COMPLETED, PENDING or ALL
        //Requesting a query to table task    
        $query = Task::query();
        //Validation if have something in $request 
        if($request->filled('filter')){
            //Make and takeing a query to table task
            $query->where('completed', $request->filter);

            $tasks = $query->get();


        }else{
            $tasks=Task::all();
        }

        //Validation to see if have tasks pending
        $pending = $tasks->where('completed', '0')->count();
            
        return view('tasks.dashboard', ['tasks' => $tasks, 'pending'=>$pending]);
    }

    public function create(){
        return view('tasks.create');
    }
    public function store(Request $request){
        $task = new Task;
        $request -> teste;
        $task -> title = $request -> title;
        $task -> description = $request -> description;
        $task -> completed = 0;
        $task -> priority = $request -> priority;
        $task -> deadline = $request -> deadline;
        $task -> save();

        return redirect('/') -> with('msg', 'Created task :)');
    }

    public function edit($id){
        $query = Task::findOrFail($id);
        
        return view('tasks.edit', ['task' => $query]);
    }

    public function update(Request $request, $id){
        $task = Task::findOrFail($id);

        $task -> update($request->only([
            'title',
            'description',
            'priority',
            'deadline',
        ]));

        
        return redirect('/') -> with('msg', 'Task updated');
    }

    public function destroy($id){
        $task = Task::findOrFail($id);
        
        $task -> delete();

        return redirect('/') -> with('msg', 'Deleted task');
    }

    public function complete($id){
        $task = Task::findOrFail($id);

        $task -> completed = !$task -> completed;

        $task -> save();

        return redirect('/') -> with('msg', 'Completed task');
    }
}