<?php

namespace App\Http\Controllers\V2\App;

use Cache;
use Carbon\Carbon;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Game\AppTag;

class TagController extends Controller
{
    public function index(Request $request)
    {
      return Cache::remember($request->fullUrl(), 30, function () use ($request) {
        $query = AppTag::query();
        $queryName = $query->distinct()->pluck('Tag');
        Validator::make($request->all(), [
          'name.*' => [
            'required',
            Rule::in($queryName),
          ],
          'math' => [
            'required',
            Rule::in(['count']),
          ],
        ])->validate();
        
        foreach ($request->name as $field) {
          $data[$field] = $query->orWhere('Tag', $field)->count();
        }
        return $data;
      });
    }

    public function show($id)
    {
    }
}
