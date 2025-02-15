<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Technology;
use App\Models\SourceCodes;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class DataController extends Controller
{
    public static function globalSourceCode($paginate = 10, $random = false, $search = false)
    {
        $query = SourceCodes::where('status', '1');

        if ($random) {
            $query->inRandomOrder();
        } else {
            $query->orderBy('id', 'desc');
        }

        $results = $query->get()->map(function ($source) {
            $tech_ids = json_decode($source->technologies, true);
            $cat_ids = json_decode($source->categories, true);

            $source->tech_details = Technology::whereIn('id', $tech_ids)->get();
            $source->cat_details = Categories::whereIn('id', $cat_ids)->get();

            return $source;
        });

        if ($search) {
            $results = $results->filter(function ($source) use ($search) {
                if (stripos($source->title, $search) !== false || stripos($source->price, $search) !== false) {
                    return true;
                }

                foreach ($source->tech_details as $tech) {
                    if (stripos($tech->name, $search) !== false) {
                        return true;
                    }
                }

                foreach ($source->cat_details as $cat) {
                    if (stripos($cat->name, $search) !== false) {
                        return true;
                    }
                }

                return false;
            });
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $pagedData = $results->slice(($currentPage - 1) * $paginate, $paginate)->values();
        $paginator = new LengthAwarePaginator($pagedData, $results->count(), $paginate);

        return $paginator;
    }

    public static function globalTechnologies($limit)
    {
        return Technology::inRandomOrder()->limit($limit)->get();
    }

    public static function globalCategories($limit)
    {
        return Categories::inRandomOrder()->limit($limit)->get();
    }

    public static function showSourceCode($slug)
    {
        $source = SourceCodes::where('status', '1')->with('createdBy', 'assets')->where('slug', $slug)->first();
    
        if (!$source) {
            abort(404);
        }
        $source->update([
            'viewer' => $source->viewer + 1
        ]);
    
        $tech_ids = json_decode($source->technologies, true);
        $cat_ids = json_decode($source->categories, true);
    
        $source->tech_details = Technology::whereIn('id', $tech_ids)->get();
        $source->cat_details = Categories::whereIn('id', $cat_ids)->get();
    
        return $source;
    }
    
}
