<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

use App\Models\Setting;
use App\Helpers\InputRender;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        return view('admins.settings.index',[
            'settings' => Setting::listOptions(),
            'inputRender' => new InputRender,
            'setting' => new Setting
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
        //
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
    public function update(Request $request)
    {
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        foreach ($request->all() as $key => $value )
        {
            $uploadFile = $this->uploadFile($key);
            if($uploadFile != ''){
                Setting::updateOrstore($key, $uploadFile);
            }else{
                Setting::updateOrstore($key, $value);
            }
        }
        return redirect()->back();
    }

    public function uploadFile($key)
    {
        if(request()->hasFile($key)){
            $duoiFile = request()->file($key)->getClientOriginalExtension();
            $fileName = 'logo-'.time().Str::random(3).'.'.$duoiFile;
            request()->file($key)->move(public_path('uploads/settings'), $fileName);
            $this->delFile($key);
            return '/uploads/settings/'.$fileName;
        }
        return '';
    }

    public function delFile($key)
    {
        if(Setting::getSetting($key)){
            $file = Setting::getSetting($key)->value;
            if (!empty($file))
            {
                $path = base_path('public'.$file);
                @unlink($path);
            }
        }
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
