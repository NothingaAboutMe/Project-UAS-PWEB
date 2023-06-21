<?php

namespace App\Http\Controllers;
use App\Models\Car;
use App\Models\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        $cars = Car::latest()->get();

        return view('frontend.homepage', compact('cars'));
    }
    public function contact(){
        return view('frontend.contact');
    }

    public function contactStore(Request $request){
        $data = $request->validate([
            'nama' => 'required',
            'pesan' => 'required',
            'subject' => 'required',
            'email' => 'required'
        ]);

        Message::create($data);

        return redirect()->back()->with([
            'massage' => 'Pesan anda berhasil dikirim',
            'alert-type' => 'succes'
        ]);
    }

    public function detail(Car $car){

        return view('frontend.detail', compact('car'));
    }

}
