<?php

/*
Verb			URI						Action				Route Name				desc
GET				/photos					index				photos.index			Display a listing of the resource.
GET				/photos/create			create				photos.create			Show the form for creating a new resource.
POST			/photos					store				photos.store			Store a newly created resource in storage.
GET				/photos/{photo}			show				photos.show				Display the specified resource.
GET				/photos/{photo}/edit	edit				photos.edit				Show the form for editing the specified resource.
PUT/PATCH		/photos/{photo}			update				photos.update			Update the specified resource in storage.
DELETE			/photos/{photo}			destroy				photos.destroy			Remove the specified resource from storage.
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapPointersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $pointer = new \App\MapPointer();
		$pointer->fill($request->all());
		$pointer->save();
		
		// handle image
		$pointer->image()->create([
			"handle" => $request->input('image_handle') // nullable
		]);
		
		return redirect('/dashboard/maps/'.$request->map_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pointer = \App\MapPointer::find($id);
		$image_handle = $pointer->image->handle;
		$pointer = $pointer->toArray();
		$pointer['image_handle'] = $image_handle;
		return json_encode( $pointer );
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
        $pointer = \App\MapPointer::find($id);
        $pointer->fill($request->all());
		$pointer->save();
		
		// handle image
		$pointer->image()->update([
			"handle" => $request->input('image_handle') // nullable
		]);
		
		return 'success';
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
