<?php

namespace App\Http\Controllers\Game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Game\GameNews as GameNewsResources;
use App\Model\Game\GameNews as GameNewsModel;
use App\Http\Requests\Game\GameNewsQuery;
use phpDocumentor\Reflection\Types\String_;

class GameNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GameNewsQuery $request
     * @param GameNewsModel $GameNewsModel
     * @return GameNewsResources
     */
    public function index(GameNewsQuery $request, GameNewsModel $GameNewsModel)
    {
        $query = $GameNewsModel::paginate($request->length);
        $data = new GameNewsResources($query);
        return $data;
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
     * @param GameNewsModel $GameNewsModel
     * @param  String_ $appids
     * @return GameNewsResources
     */
    public function show(GameNewsModel $GameNewsModel, $appids)
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
        //
    }
}
