<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\roles;
use Illuminate\Auth\Events\Validated;

class RolesController extends Controller
{
    public function index(){
       try {
            $roles = \App\Models\roles::all();
           if ($roles->count()>0) {
               return response()->json($roles, 200);
           }
           else {
               return response()->json(["message" => "Roles found", $roles], 200);
           }
        } catch (\Exception $e) {
            return response()->json(["error" =>"Error Fetching Role"], 500);
    }
}

    public function createRole(Request $request){
        $validated = $request->validate([
            'name' => "required|string|max:255|unique:roles",
            "slug" => "required|string|max:255|unique:roles",
            'description' => "nullable|string|max:1000",
        ]);

        try{
            $role = new roles();
            $role->name = $validated['name'];
            $role->slug = $validated['slug'];
            $role->description = $validated['description'];
            $createdRole = $role->save();

            if ($createdRole) {
                return response()->json(["Created Role", $role], 201);
            }
            else {
                return response()->json(["message" => "Role not created"], 404);
            }
                } catch (\Exception $e) {
                    return response()->json(["message" => "Error creating"()], 500);
                }
            }
    
        public function getRole($id){
                $fetchedrole = roles::findOrFail($id);
                if ($fetchedrole) {
                    return response()->json($fetchedrole, 200);
                } else {
                    return response()->json(["message" => "Role not found"], 404);}
                      
        } // Closing brace for getRole method

        public function updateRole(Request $request, $id){
                $validated = $request->validate([
                    'name' => "required|string|max:255,|unique:roles,",
                    "slug" => "required|string|max:255,|unique:roles,",
                    'description' => "nullable|string|max:1000",
                ]);
                
                    $roleToUpdate = roles::findOrFail($id);
                
                    if ($roleToUpdate){
                        $roleToUpdate->name = $validated['name'];
                        $roleToUpdate->slug = $validated['slug'];
                        $roleToUpdate->description = $validated['description'];
                        $updatedRole = $roleToUpdate->save();
                    try {
                        if ($updatedRole) {
                            return response()->json(["Role Updated", $roleToUpdate], 201);
                        }
                        else {
                            return response()->json(["message" => "Role not updated"], 404);
                        }
                    } catch (\Exception $e) {
                        return response()->json(["Error" => "Role not updated"], 500);
                    }
                }
        }
        public function deleteRole($id){
            try {
                $roleToDelete = roles::findOrFail($id);
            if (!$roleToDelete) {
                $deletedrole= roles::destroy($id);
            if ($deletedrole) {
                return response()->json(["message" => "Role Deleted"], 200);
            }
            else {
                return response()->json(["message" => "Failed to deleted"], 404);
            }
            }
            } catch (\Exception $e) {
                return response()->json(["message" => "Role not deleted"], 404);
            }
            }
        }
?>