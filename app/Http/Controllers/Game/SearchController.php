<?php

namespace App\Http\Controllers\Game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Game\App as AppModel;
use App\Model\Game\AppHistory as AppHistoryModel;
use App\Model\Game\AppInfo as AppInfoModel;
use App\Model\Game\AppPrice as AppPriceModel;
use App\Model\Game\AppType as AppTypeModel;

class SearchController extends Controller
{
    public function index () {
        return AppModel::paginate();
    }
}

