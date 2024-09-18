<?php

namespace App\Http\Controllers\Api\V1;

use DB;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index() 
    {
        // $student = Student::all();
        $student = Student::offset(0)->limit(5)->get();
        $data = [
            'status' => 200,
            'student' => $student
        ];
        
        return response()->json($data, 200);

    }

    //No Parameter Binding
    // public function show(Request $request) 
    // {
    //     $id = $request->id; // Assume this comes from user input, such as a form or URL
    //     $query = "SELECT * FROM students WHERE id = $id";
    //     $results = DB::select($query);

    //     $data = [
    //         'status' => 200,
    //         'student' => $results
    //     ];
        
    //     return response()->json($data, 200);

    // }

    //With Parameter Binding
    public function show(Request $request) 
    {
        $id = $request->id; // Assume this comes from user input, such as a form or URL
        $query = "SELECT * FROM students WHERE id = ?";
        $results = DB::select($query, [$id]);

        $data = [
            'status' => 200,
            'student' => $results
        ];
        
        return response()->json($data, 200);

    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails())
        {
            $data = [
                'status' => 422,
                'message' => $validator->messages(),
            ];

            return response()->json($data, 422);
        }
        else
        {
            $student = new Student();
            $student->name = $request->name;
            $student->email = $request->email; 
            $student->phone = $request->phone;
            $student->save();

            $data = [
                'status' => 200,
                'message' => 'Save data succesfully'
            ];

            return response()->json($data, 200);
        }
    }

    public function update(Request $request, $id) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails())
        {
            $data = [
                'status' => 422,
                'message' => $validator->messages(),
            ];

            return response()->json($data, 422);
        }
        else
        {
            $student = Student::find($id);
            $student->name = $request->name;
            $student->email = $request->email; 
            $student->phone = $request->phone;
            $student->save();

            $data = [
                'status' => 200,
                'message' => 'Update data succesfully'
            ];

            return response()->json($data, 200);
        }
    }

    public function delete($id) 
    {
        $student = Student::find($id);
        $student->delete();

        $data = [
            'status' => 200,
            'message' => 'Delete data succesfully'
        ];
        
        return response()->json($data, 200);

    }

}
