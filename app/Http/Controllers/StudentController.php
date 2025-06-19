<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class StudentController extends Controller
{
 /**
  * Display a listing of the resource.
  */
 public function index()
 {
  return response()->json([
   'students' => Student::all(),
  ], 200);
 }

 /**
  * Show the form for creating a new resource.
  */
 public function create()
 {
  //
 }

 /**
  * Store a newly created resource in storage.
  */
 public function store(Request $request): JsonResponse
 {

  $request->validate([
   'name'       => 'required|string|max:255',
   'email'      => 'required|email|unique:students,email',
   'department' => 'required|string|max:255',
  ]);

  $student = Student::create([
   'name'       => $request->name,
   'email'      => $request->email,
   'department' => $request->department,
  ]);

  return response()->json([
   'message' => 'Student created successfully',
   'data'    => $student,
  ], 201);

 }

 /**
  * Display the specified resource.
  */
 public function show(Student $student)
 {
  return response()->json([
   'student' => $student,
  ], 200);
 }

 /**
  * Show the form for editing the specified resource.
  */
 public function edit(Student $student)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  */
 public function update(Request $request, Student $student)
 {
  $validated = $request->validate([
   'name'       => 'required|string',
   'email'      => 'required|email|unique:students,email,' . $student->id,
   'department' => 'required|string',
  ]);

  $student->update($validated);

  return response()->json([
   'message' => 'Student updated successfully',
   'student' => $student,
  ], 200);
 }

 /**
  * Remove the specified resource from storage.
  */
 public function destroy(Student $student)
 {
  $student->delete();

  return response()->json([
   'message' => 'Student deleted successfully',
  ], 200);
 }
}
