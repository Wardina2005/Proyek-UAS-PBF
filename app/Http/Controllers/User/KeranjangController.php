<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $items = Keranjang::where('user_id', auth()->id())
            ->with('product')
            ->get();

        return view('user.keranjang.index', compact('items'));
    }

    public function store(Request $request)
    {
        Keranjang::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'qty' => $request->qty
        ]);

        return redirect('/user/keranjang')
            ->with('success','Masuk keranjang');
    }

    public function destroy(Keranjang $keranjang)
    {
        $keranjang->delete();
        return back();
    }
}
