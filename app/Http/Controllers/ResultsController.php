<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\Result;
use App\Models\Student;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Http\Resources\Result as ResultResource;

class ResultsController extends Controller
{
  /**
   * Display a listing of the results grouped by name and term
   *
   * @return \Illuminate\Http\Response
  */
  public function index()
  {
    // get logged in user school id
    $user_school = JWTAuth::parseToken()->toUser()->school;

    $results = Result::where('school', $user_school)->get()->groupBy(['year', 'term', 'class', 'type']);

    foreach ($results as $y => $year) {

      foreach ($year as $t => $term) {

        foreach ($term as $c => $class) {

          foreach ($class as $ty => $type) {

            foreach ($type as $t => $value) {
              // fetch
              $student = Student::where('student_reg', $value->student)->get()->first();
              $class = ClassModel::where('id', $value->class)->get()->first();

              // set the info
              $value->studentInfo = $student;
              $value->classInfo = $class;
            }

          }

        }

      }

    }

    // // return in json format
    return response()->json([
      'results' => $results
    ], 200);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
  */
  public function create()
  {
    // code
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // store result in the database
       $result = $request->isMethod('put') ? Result::findOrFail($request->result_id) : new Result;
       $result->id = $request->input('result_id');

       $result->term = $request->input('term');
       $result->term = $request->input('type');
       $result->student = $request->input('regnumber');
       $result->class = $request->input('class');
       $result->teacher = $request->input('teacher');
       $result->school = $request->input('school');
       $result->subject = $request->input('subjects');
       $result->marks = $request->input('marks');
       $result->year = $request->input('year');

       if ($result->save()) {
        return new ResultResource($result);
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

       $data = [];
       $data["result"] = Scchool::find($id);
       if ($id != -1) {

        }
        return new ResultResource($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    // delete single result
      $result = Result::findOrFail($id);

      if ($result->delete()) {
        // return sngle result as a resource
        return new ResultResource($result);
      }
    }

}
