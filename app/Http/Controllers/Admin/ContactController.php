<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $title = 'Contacts';
    public function index()
    {
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        return view('admins.contacts.index',[
            'contacts' => Contact::getItems(),
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
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        $obj = new Contact;
        return view('admins.contacts.show',[
            'contact'   => $obj->getItem($id),
            'title'     => $this->title
        ]);
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
        if (! Gate::allows('full')) {
            return redirect( url('admin') )->with('failed', 'Sorry, You are not authorized');
        }
        $del = Contact::delItem($id);
        if($del){
            return redirect()->route('contacts.index')->with('delete_succeeded',config('admin.delete_succeeded'));
        }
        return redirect()->route('contacts.index',['id' => $id ])->with('failed',config('admin.failed'));
    }

    public function ajaxStauts(Request $request, $id)
    {
        $obj = new Contact;
        return $obj->updateStatus($id);
    }

    public function ajaxDelContact($id)
    {
        return Contact::delItem($id);
    }
    
}
