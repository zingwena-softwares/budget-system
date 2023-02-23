<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Department;
use App\Programm;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProgrammesController extends Controller
{
    public function index()
    {

        $programmes = Programm::all();
        error_log($programmes);

        return view('admin.programmes.index', compact('programmes'));
    }

    public function create()
    {
        $departments  = Department::all()->pluck('name', 'id')->prepend('Please select', '');
        return view('admin.programmes.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $attrs = $request->validate([
            'programe' => 'required|string',
            'department_id' => 'string|string',
        ]);

        Programm::create([
            'programe' => $attrs['programe'],
            'sub_programm' => 'S'.$attrs['programe'],
            'department_id' => $attrs['department_id'],
        ]);
        return redirect()->route('admin.programmes.index');
    }

    public function edit(Programm $programm)
    {

        $departments = Department::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $programm->load('programm');

        return view('admin.programm.edit', compact('programmes', 'departments'));
    }

    public function update(Request $request, Programm $programm)
    {
        $programm->update($request->all());

        return redirect()->route('admin.programmes.index');
    }

    public function show(Programm $programm)
    {

        $programm->load('programm');

        return view('admin.programmes.show', compact('programm'));
    }

    public function destroy(Programm $programm)
    {
        $programm->delete();
        return back();
    }

    public function massDestroy(Request $request)
    {
        Programm::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
