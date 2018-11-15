<?php

namespace App\Http\Controllers\V2\App;

use Cache;
use Carbon\Carbon;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Game\AppTag;
use App\Model\Game\AppReview;

class TagController extends Controller
{
    public function index(Request $request)
    {
      return Cache::remember($request->fullUrl(), 360, function () use ($request) {
        $queryTag = AppTag::query();
        $queryReview = AppReview::query();
        $queryTagName = $queryTag->distinct()->pluck('Tag');
        Validator::make($request->all(), [
          'name.*' => [
            'required',
            Rule::in($queryTagName),
          ],
          'type' => [
            Rule::in(['reviews']),
          ],
          'math' => [
            'required',
            Rule::in(['count']),
          ],
        ])->validate();
        
        foreach ($request->name as $field) {
          if ($request->type === 'reviews') {
            $appid = $queryTag->orWhere('Tag', $field)->pluck('AppID');
            $data[$field] = $queryReview->orWhereIn('AppID', $appid)->with('tags')->count();
          } else {
            $data[$field] = $queryTag->orWhere('Tag', $field)->count();
          }
        }
        return $data;
      });
    }

    public function show($id)
    {
    }
}
