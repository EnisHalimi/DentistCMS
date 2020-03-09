<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use DataTables;
use DB;
use Illuminate\Support\Str;

class RoleController extends Controller
{


    public function getRoleDataTable()
    {
        $roles = Role::all();
        $table = DataTables::of($roles)
       ->addColumn('Menaxhimi' ,'<a href="/role/{{$id}}" class="btn btn-circle btn-secondary"><i class="fa fa-eye"></i></a>
        <a href="/role/{{$id}}/edit"  class="btn btn-circle btn-primary"><i class="fa fa-pen"></i></a>
        <button class="btn btn-circle btn-danger" data-toggle="modal" data-target="#fshijModal{{$id}}"><i class="fa fa-trash"></i></button>
        <div class="modal fade" id="fshijModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fshijModalLabel{{$id}}">Fshij Rolin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        A jeni i sigurtë që doni të vazhdoni?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                        <form class="d-inline" method="POST" action="{{ route(\'role.destroy\',$id)}}" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-circle btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div> ')
        ->addColumn('access',' <i class="fa @if(App\Role::hasAccess($id, \'View\') == 1) fa-check-square @elseif(App\Role::hasAccess($id, \'View\') == 0) fa-minus-square @else fa-square @endif"></i> <a href="#" class=" btn btn-secondary btn-sm btn-circle"><i class="fa fa-eye"></i></a>
                            <i class="fa @if(App\Role::hasAccess($id, \'Create\') == 1) fa-check-square @elseif(App\Role::hasAccess($id, \'Create\') == 0) fa-minus-square @else fa-square @endif"></i> <a href="#" class=" btn btn-success btn-sm btn-circle"><i class="fa fa-plus"></i></a>   
                            <i class="fa @if(App\Role::hasAccess($id, \'Edit\') == 1) fa-check-square @elseif(App\Role::hasAccess($id, \'Edit\') == 0) fa-minus-square @else fa-square @endif"></i> <a href="#" class=" btn btn-primary btn-sm btn-circle"><i class="fa fa-pen"></i></a> 
                               <i class="fa @if(App\Role::hasAccess($id, \'Delete\') == 1) fa-check-square @elseif(App\Role::hasAccess($id, \'Delete\') == 0) fa-minus-square @else fa-square @endif"></i> <a href="#" class=" btn btn-danger btn-sm btn-circle"><i class="fa fa-trash"></i></a>')
        ->addColumn('number','{{App\User::getRolesCount($id)}}')                       
        ->rawColumns(['Menaxhimi','access','number'])
        ->make(true);
        return $table;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasPermission('view-role'))
        return view('role.role');
    else
        return redirect('/')->with('error', __('messages.noauthorization'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->hasPermission('create-role'))
            return view('role.create');
            else
        return redirect('/')->with('error', __('messages.noauthorization'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->hasPermission('create-role')){
            $this->validate($request,[
                'name'=> 'required|min:3|string',
            ]);
            
            $role = new Role;
            $role->name = $request->input('name');
            $role->slug = Str::slug($request->input('name'), '-');
            $role->save();
            $role->permissions()->attach($request->input('permission'));
            return redirect('/role')->with('success',__('messages.role-add'));
        }
        else
            return redirect('/')->with('error', __('messages.noauthorization'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $permissions = $role->permissions()->get();
        if(auth()->user()->hasPermission('view-role'))
            return view('role.show')->with('role',$role)->with('permissions',$permissions);
        else
            return redirect('/')->with('error', __('messages.noauthorization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        if(auth()->user()->hasPermission('edit-role'))
            return view('role.edit')->with('role',$role);
        else
            return redirect('/')->with('error', __('messages.noauthorization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->hasPermission('edit-role')){
            $this->validate($request,[
                'name'=> 'required|min:3|string',
            ]);
            
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->slug = Str::slug($request->input('name'), '-');
            $role->permissions()->sync($request->input('permission'));
            $role->save();
            return redirect('/role')->with('success',__('messages.role-edit'));
        }
        else
            return redirect('/')->with('error', __('messages.noauthorization'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        if(!auth()->user()->hasPermission('delete-role'))
        {
            return redirect('/')->with('error',__('messages.noauthorization')); 
        }
        else
        {
            $role->permissions()->detach();
            $role->delete();
            return redirect('/role')->with('success',__('messages.role-delete'));
        }
    }
}
