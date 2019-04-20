<?php

namespace App\Model\Game;

use Illuminate\Database\Eloquent\Model;

class GameNews extends Model
{
    /**
     * 模型的连接名称
     *
     * @var string
     */
    protected $connection = 'mysql_2';

    /**
     * 与模型关联的表名
     *
     * @var string
     */
    protected $table = 'News';
}