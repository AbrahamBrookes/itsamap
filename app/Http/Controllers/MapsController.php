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

class MapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.maps');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.newmap');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $map = new \App\Map();
		$map->fill($request->all());
		$map->user_id = auth()->user()->id;
		$map->save();
		return redirect('/dashboard/maps/'.$map->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$map = \App\Map::find($id);
		$pointers = $map->pointers;
        return view('admin.map', [
			'map' => $map,
			'pointers' => $pointers
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
        //
    }
}
