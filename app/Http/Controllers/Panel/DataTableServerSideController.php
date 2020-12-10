<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataTableServerSideController extends Controller
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * RoleController constructor.
     * @param Request $request
     */
    public function __construct
    (
        Request $request
    )
    {
        $this->request = $request;
    }

    public function init(Request $request)
    {
        $columns = array_column($request["columns"], "name");
        $columnsData = array_column($request["columns"], "data");
        $columnRelation = array_column($request["columns"], "column_relation");
        $columnButtonsActive = array_column($request["columns"], "buttons_active");
        $columnCountRelation = array_column($request["columns"], "count_relation");

        if($request->table=="User")
        {
            $class = "\App\\".$request["table"];
            if(class_exists($class))
            {
                $obj =  new $class();
            }
        }
        else
        {
            $class = "\App\\Models\\".$request["table"];
            if(class_exists($class))
            {
                $obj =  new $class();
            }
        }
        $totalData   = $obj::count();
        $limit       = $request->input('length');
        $start       = $request->input('start');
        $order       = $columns[$request->input('order.0.column')];
        $dir         = $request->input('order.0.dir');

        if(empty($request->input('search.value')) && isset($request["statusCondition"]) && $request["statusCondition"]=="not")
        {
            $posts = $obj::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $obj::count();
        }
        elseif(empty($request->input('search.value')) && isset($request["statusCondition"]) && $request["statusCondition"]=="yes")
        {
            $posts = $obj::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->where("status", $request["statusVerify"])
                ->get();
            $totalFiltered = $obj::count();
        }
        else
        {
            $search = $request->input('search.value');
            $posts  = $obj::where(function ($query) use ($search, $columns) {
                foreach ($columns as $col)
                {
                    if($col!="relation" && $col!="action")
                    {
                        $query->orWhere("$col", "like", "%{$search}%");
                    }
                    if($col=="relation" && $col!="action")
                    {
                        $query->with("$col");
                    }
                }
            })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $obj::where(function ($query) use ($search, $columns) {
                foreach ($columns as $col)
                {
                    if($col!="relation" && $col!="action")
                    {
                        $query->orWhere("$col", "like", "%{$search}%");
                    }
                }
            })->count();
        }

        $data        = array();
        if($posts){
            foreach ($posts as $r)
            {
                foreach ($columns as $key => $col)
                {
                    if($col!="relation" && $col!="action")
                    {
                        $nestedData["$col"] = $r->$col;
                    }
                    elseif($col=="relation" && $col!="action")
                    {
                        $relation = $columnsData[$key] ?? "";
                        $colRelation = $columnRelation[$key] ?? "";
                        $countRelation = $columnCountRelation[$key];
                        if($countRelation=="unique")
                        {
                            $explode = explode(",", $r->$relation->$colRelation);
                            $replace = str_replace(["[", "]", '"'], "", $explode);
                            $nestedData["$relation"] = implode( " - ", $replace);
                        }
                        if($countRelation=="multiple")
                        {
                            $explode = explode(",", $r->$relation->pluck($colRelation));
                            $replace = str_replace(["[", "]", '"'], "", $explode);
                            $nestedData["$relation"] = implode( " - ", $replace);
                        }
                        if($countRelation=="action_button")
                        {
                            $nestedData["$relation"] = '
                            <a href="'.route("panel.".$relation.".edit", $r->$relation->id).'" class="btn btn-success"><i class="fa fa-list"></i></a>
                            ';
                        }
                    }
                    elseif($col!="relation" && $col=="action")
                    {
                        $nestedData['action']   = buttons("edit", route("panel.".lcfirst($request->table).".edit", $r->id), $r)." ";
                        $nestedData['action']  .= buttons("delete", route("panel.".lcfirst($request->table).".delete", $r->id), $r);
                    }
                }
                $data[] = $nestedData;
            }
        }
        return response()->json([
            "draw"                          => intval($request->input('draw')),
            "recordsTotal"                  => intval($totalData),
            "recordsFiltered"               => intval($totalFiltered),
            "data"                          => $data,
        ]);
    }

}
