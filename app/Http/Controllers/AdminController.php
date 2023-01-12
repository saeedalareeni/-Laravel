<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Admin::all();
        return response()->view('cms.admin.index', ['admins' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:admins',
            'mobile' => 'required|numeric|digits:12',
            'password' => ['required', 'string', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->uncompromised()
                    ->numbers()
                    ->symbols(),
            ],
        ]);
        if (!$validator->fails()) {
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->password = Hash::make($request->input('password'));
            $admin->mobile = $request->input('mobile');
            $saved = $admin->save();

            return response()->json([
                'message' => $saved ? 'Add suuccessfuly' : 'Faild to add',
            ]
                , $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Admin::findOrFail($id);
        return response()->view('cms.admin.edit', ['admin' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|max:50|min:4',
            'email' => 'required|email|unique:admins,email,' . $id,
            'mobile' => 'required|numeric|digits:12',
        ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST);
        } else {
            $admin = Admin::findOrFail($id);
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->mobile = $request->input('mobile');
            $saved = $admin->save();

            return response()->json([
                'message' => $saved ? 'Updated successfully' : 'Failed to update',
            ],
                $saved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedCount = Admin::destroy($id);
        $deleted = $deletedCount == 1;
        return response()->json([
            'message' => $deleted ? 'Deleted Successfully' : 'Faild To Delete',
        ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}