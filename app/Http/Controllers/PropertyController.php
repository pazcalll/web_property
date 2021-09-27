<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Commons;

use App\Models\Sub;
use App\Models\Property;

class PropertyController extends Controller {
    // VIEW
    public function listPropertyView () {
        $data = Property::get()->toArray();
        return view('adminPage.property', $data);
    }
    public function addPropertyView () {
        $subData = Sub::get()->groupBy('attribute')->toArray();
        $data = [
            "homeStatus" => Commons::HOME_STATUS,
            "homeCategory" => Commons::HOME_CATEGORY,
            "bedRoom" => Commons::BED_ROOM,
            "bathRoom" => Commons::BATH_ROOM,
            "parkingLot" => Commons::PARKING_LOT,
            "heating" => Commons::HEATING
        ];
        $data = array_merge($data, $subData);
        return view('adminPage.propertyAdd', $data);
    }
    
    // ACTION
    public function addPropertyAction (Request $req) {
        try {
            $payload = $req->validate([
                'title' => ['required', 'unique:properties'],
                'price' => ['required', 'integer'],
                'address' => ['required', 'max:40'],
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
                'status' => ['required', 'integer'],
                'category' => ['required', 'integer'],
                'bedRoom' => ['required', 'integer'],
                'bathRoom' => ['required', 'integer'],
                'parkingLot' => ['required', 'integer'],
                'heating' => ['required', 'integer'],
                'length' => ['required', 'integer'],
                'width' => ['required', 'integer'],
                'description' => ['required'],
                'subSalaryId' => ['required', 'integer'],
                'subHomeFurnitureId' => ['required', 'integer'],
                'subFamilyMemberId' => ['required', 'integer']
            ]);

            $imageName = sha1(time()).'.'.$payload['image']->extension();
            $payload['image']->move(public_path('property'), $imageName);
            $payload['image'] = 'property/'.$imageName;

            Property::create($payload);
        } catch (\Throwable $th) {
            return back()->withErrors('Anda gagal membuat properti.');
        }
        return redirect('/admin/property')->withSuccess('Properti telah dibuat.');
    }
}
