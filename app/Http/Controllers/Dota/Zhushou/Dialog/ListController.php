<?php

namespace App\Http\Controllers\Dota\Zhushou\Dialog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Dota\Zhushou\DialogList as DialogListModel;
use App\Http\Resources\Dota\Zhushou\DialogList as DialogListResources;
use App\Http\Requests\Dota\Zhushou\DialogListStore as DialogListStoreRequest;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param DialogListModel $dialogListModel
     * @return DialogListResources
     */
    public function index(DialogListModel $dialogListModel)
    {
        $query
            = $dialogListModel
                ->latest()
                ->paginate();

        return new DialogListResources($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DialogListStoreRequest $request
     * @param DialogListModel $dialogListModel
     * @return DialogListResources
     */
    public function store(DialogListStoreRequest $request, DialogListModel $dialogListModel)
    {
        $query
            = $dialogListModel
                ->create(clean($request->all()));

        return new DialogListResources(collect($query));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param DialogListModel $dialogListModel
     * @return DialogListResources
     */
    public function show($id, DialogListModel $dialogListModel)
    {
        $query
            = $dialogListModel
                ->find($id);

        return new DialogListResources(collect($query));
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
