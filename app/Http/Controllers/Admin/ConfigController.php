<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $title = 'Configs';

    public function index()
    {
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        $config = new Config;
        return view('admins.configs.index',[
            'title'   => $this->title,
            'configs' => $config->getItems(),
            'skins'   => $config->skin_array,
            'layouts' => $config->layout_array
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        $all = $request->all();
        Config::updateConfig($all);
        return redirect()->route('configs.index')->with('update_succeeded',config('admin.update_succeeded'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
    
}
