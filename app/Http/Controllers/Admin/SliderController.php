<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;

use App\Models\Slider;
use Response;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $title = 'Sliders';
    public function index()
    {
        return view('admins.sliders.index',[
            'sliders' => Slider::getItems(),
            'title'    => $this->title
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
    public function store(SliderRequest $request)
    {
        $stores = new Slider;
        $stores->key  = $request->key;
        $stores->save();
        return redirect()->back()->with('save_succeeded',config('admin.save_succeeded'));
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
        $slide = Slider::getItem($id);
        if( ! $slide ){
            return view('admins.errors.404');
        }
        return view('admins.sliders.edit',[
            'title'     => $this->title,
            'slide'      => $slide
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, $id)
    {
        $slider = new Slider;
        $update = $slider->getItem($id);
        if(!$update){
            return redirect()->route('sliders.index')->with('failed',config('admin.failed') );
        }
        $update->key    = strip_tags($request->key);
        $update->status = ($request->status == 1) ? 1 : 0;
        $update->save();
        return redirect()->route('sliders.index')->with('update_succeeded',config('admin.update_succeeded') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::getItem($id);
        if( !$slider ){
            return redirect()->route('sliders.index')->with('failed',config('admin.failed'));
        }

        $del = $slider->delete();
        if($del){
            return redirect()->route('sliders.index')->with('delete_succeeded',config('admin.delete_succeeded'));
        }
        return redirect()->route('sliders.edit',[$id])->with('failed',config('admin.failed'));
    }

    public function ajaxStauts($id)
    {
        $slider = new Slider;
        return $slider->updateStatus($id);
    }

    public function ajaxDelSlider($id)
    {
        $slider = Slider::getItem($id);
        if($slider){
            $slider->delete();
        }
    }
    
    public function ajaxUniqueKey(Request $request)
    {
        $id = strip_tags($request->id);
        $key = strip_tags($request->key);
        if($id != ''){
            $check = Slider::where('id','<>',$id)->where('key',$key)->first();
        }else{
            $check = Slider::getItemByKey($key);
        }
        if($check) {
            return Response::json(array('msg' => 'true'));
        }
        return Response::json(array('msg' => 'false'));
    }
    
}
