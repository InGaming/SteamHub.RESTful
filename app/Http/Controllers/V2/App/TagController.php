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
            'filled',
            'distinct',
            Rule::in($queryTagName),
          ],
          'type' => [
            'filled',
            Rule::in(['list', 'reviews']),
          ],
          'math' => [
            'filled',
            Rule::in(['count']),
          ],
        ])->validate();
        
        if ($request->type === 'list') {
          return $queryTagName;
        }

        foreach ($request->name as $field) {
          $data[$field] = $queryTag
          ->orWhere('Tag', $field)
          ->when($request->type === 'reviews', function ($query) use ($queryReview) {
            $appid = $query->pluck('AppID');
            return $queryReview->orWhereIn('AppID', $appid)->with('tags');
          })
          ->count();
        }
        return $data;
      });
    }

    public function show($id)
    {
    }
}
