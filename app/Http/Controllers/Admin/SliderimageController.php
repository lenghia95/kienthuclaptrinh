<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderimageRequest;
use App\Helpers\articleService;

use App\Models\Sliderimage;
use App\Models\Slider;
use Response;

class SliderimageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $title = 'Sliders Images';
    public function __construct()
    {
        $this->articleService = new articleService;
    }
    public function index()
    {
        return view('admins.sliderimages.index',[
            'sliderimages' => Sliderimage::getItems(),
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
    public function store(SliderimageRequest $request)
    {
        $uploadFile = $this->articleService->uploadFile('image','uploads/sliders/');
        $stores = new Sliderimage;
        $stores->title      = $request->title;
        $stores->key        = $request->key;
        $stores->content    = $request->content;
        $stores->html       = $request->html;
        $stores->image      = $uploadFile;
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
        $sliderimage = Sliderimage::getItem($id);
        if( ! $sliderimage ){
            return view('admins.errors.404');
        }
        return view('admins.sliderimages.edit',[
            'title'         => $this->title,
            'sliderimage'   => $sliderimage,
            'sliders' => Slider::getItems(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderimageRequest $request, $id)
    {
        $update = Sliderimage::getItem($id);
        if($update){
            $uploadFile = $this->articleService->uploadFile('image','uploads/sliders/');
            if($uploadFile != ''){
                $this->articleService->delFile($update->image);
            }
            $update->title      = $request->title; 
            $update->key        = $request->key;
            $update->content    = $request->content;
            $update->html       = $request->html;
            $update->image      = ($uploadFile == '') ? $update->image : $uploadFile;
            $update->save();
            return redirect()->route('sliderimages.index')->with('update_succeeded',config('admin.update_succeeded') );
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
        $sliderImage = Sliderimage::getItem($id);
        if( !$sliderImage ){
            return redirect()->route('sliderimages.index')->with('failed',config('admin.failed'));
        }
        $del = $sliderImage->delete();
        if($del){
            $this->articleService->delFile($sliderImage->image);
            return redirect()->route('sliderimages.index')->with('delete_succeeded',config('admin.delete_succeeded'));
        }
        return redirect()->route('sliderimages.index',[ $id ])->with('failed',config('admin.failed'));
    }

    # ===========================ajax============================== #

    public function ajaxDelSliderImages($id)
    {
        $sliderImage = Sliderimage::getItem($id);
        $delItem = $sliderImage->delete();
        if($delItem){
            $this->articleService->delFile($sliderImage->image);
            return config('admin.delete_succeeded');
        }
        return config('admin.failed');
    }
    
}
