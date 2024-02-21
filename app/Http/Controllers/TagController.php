<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\TagAssociation;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request, $idTag, $level)
    {

        $associatedTags = TagAssociation::all()->toArray();
        $nextLevel = [];
        $previosIds = $request->input('previosIds');

        for($i = 0; $i < count($associatedTags); $i++) {
            $ids = explode(',', $associatedTags[$i]['ids_tags']);
            $indexId = array_search($idTag, $ids);

            if($indexId !== false && isset($ids[(int) $indexId + 1])) {

                if($previosIds != implode(',', array_slice($ids, 0, $indexId))) continue;
                $nextLevel[] = [
                    'idTag' => $ids[$indexId + 1],
                    'level' => $level,
                    'name' => Tag::find($ids[$indexId + 1])->nombre
                ];
            }
        }

        return response()->json($nextLevel, 200);
    }
}
