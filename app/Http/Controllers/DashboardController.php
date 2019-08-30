<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\User;
use DB;

class DashboardController extends Controller
{
    public function show(Request $request)
    {
      $user = User::select([
          'id',
          'name',
          'permission',
          'email',
          'created_at',
          'updated_at',
      ]);

      return DataTables::of($user)
              ->filterColumn('name', function($query, $keyword) {
                  $sql = "name  like ?";
                  $query->whereRaw($sql, ["%{$keyword}%"]);
              })->addColumn('action', function ($user) {
              return '<a href="#" id="'.$user->id.'" class="btn btn-xs btn-primary user-edit" data-toggle="modal" data-target="#user-edit">
                                Edit</a>
                      <a href="#" id="'.$user->id.'" class="btn btn-xs btn-primary user-delete" data-toggle="modal" data-target="#user-delete">
                                Delete</a>';
              })
              ->toJson();
    }
    public function edit(Request $request)
    {
        $id = $request->input('id');
        $userdata = User::find($id);
        $output = array('name' => $userdata->name,
                        'email' => $userdata->email,
                        'permission' => $userdata->permission);
        echo json_encode($output);
    }
    public function update(Request $request)
    {
          $this->validate($request, [
          'name' => 'required',
          'email' => 'required'
        ]);

        $id = $request->input('id');
        $data = User::find($id);
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->permission = $request->input('permission');
        $data->save();
        return redirect('dashboard');
    }
    public function delete(Request $request)
    {
      $id = $request->input('id');
      User::where('id', $id)->delete();
    }
}
