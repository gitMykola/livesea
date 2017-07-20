<?php

namespace App\Http\Controllers;

use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;

class TaskController extends Controller
{
    //
    protected $tasks;
    
    
    public function __construct(TaskRepository $tasks)
    {
      //$this->middleware('auth');
      $this->tasks = $tasks;
    }
    public function indexAll()
    {
        return json_encode(Task::where('status',1)
            ->orderBy('name','desc')
            ->take(10)
            ->get());
    }
    public function store(Request $request)
    {
        $this->middleware('auth');
        $this->validate($request, [
        'name' => 'required|max:50',
      ]);
      $request->user()->tasks()->create([
        'name' => $request->name,
          'latitude' => $request->latitude,
          'longitude' => $request->longitude,
          'author_id' => $request->user()->id,
          'text' => $request->text,
          'status' => 1,
      ]);

      return redirect('/tasks');
    }  
    public function index(Request $request)
    {
        //$this->middleware('auth');
     /* $tasks = $request->user()->tasks()->get();
      $user_role = DB::table('roles')->where('id',$request->user()->role)->first();
        if(is_object($user_role) && $user_role->name == 'administrator') {
            return view('tasks.index', [
                'tasks' => $this->tasks->forUser($request->user()), 'admin_menu' => 'control_panel',
            ]);
        }else{*/
     //var_export($this->tasks->forUser($request->user()));
        $data = ($request->user())?$this->tasks->forUser($request->user()):Task::where('status',1)
                                                                                    ->orderBy('name','desc')
                                                                                    ->take(5)
                                                                                    ->get();
            return view('tasks.index', [
                'tasks' => $data,
            ]);
       // }
    }
    public function destroy(Request $request, Task $task)
    {
        $this->middleware('auth');
        $this->authorize('destroy', $task);
        //
        $task->delete();
        
        return redirect('/tasks');
    }
}
