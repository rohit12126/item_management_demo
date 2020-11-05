<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item as ItemModel;
/**
* ItemManagementPage ItemController Controller class file
* PHP Version 7
*
* @category Controllers
*
* @package Controllers
*
* @author Rohit Agrawal<rohita.chapter247@gmail.com>
*
*
* @link NA
*/
class ItemController extends Controller
{
    public function addUpdateItem(Request $req)
    {
        $req->validate([
            'token'  => 'required',
            'name'  => 'required',
            'position' => 'bail|required|in:left,right',
        ]);
        $item = ItemModel::where('token', $req->token)->where('name', $req->name)->first();
        if ($item === null) {
            $item = new ItemModel;
        }

        $item->token = $req->token;
        $item->name = $req->name;
        $item->position = $req->position;
        $item->save();

        return ['status' => 'success', 'message' => 'Item saved successfully!'];
    }

    public function getList(Request $req)
    {
        $req->validate([
            'token'  => 'bail|required|exists:items,token',
        ]);
        $left = ItemModel::where('token', $req->token)->where('position', 'left')->get();
        $right = ItemModel::where('token', $req->token)->where('position', 'right')->get();
        return [
            'status' => 'success', 
            'message' => 'Item list by position!', 
            'data' => [
                'left' => $left,
                'right' => $right,
            ]
        ];
    }
}
