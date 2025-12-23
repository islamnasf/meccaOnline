<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
public function addNewVendor(){
    return view("dashboard.forms.vendor");
}
}
