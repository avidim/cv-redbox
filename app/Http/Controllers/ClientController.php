<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Generator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clients')->with('data', Client::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric'
        ]);

        $client = Client::create($request->all());
        $link = \Str::random(12);
        $client->link = $link;
        $client->save();

        $url = $request->root() . "/link/" . $link;
        $file_path = storage_path('app/public/') . 'file.png';
        $qr = new Generator;
        $qr->format('png')->size(150)->generate($url, $file_path);
        sleep(5);
        require_once(storage_path('app/') . 'smsc_api.php');
        $response = send_sms("79967912757", "", 0, 0, 0, 7, false, "subj=PromoLink", array($file_path));
        \File::delete($file_path);

        if (count($response) == 2) {
            if ($response[1] == '-9') {
                return back()->with('error', 'Client added, but more than 1 identic sms in under 60sec!');
            }
            if ($response[1] == '-8') {
                return back()->with('error', 'Client added, but MMS service not working!');
            }
            return back()->with('error', 'Client added, but unhandled exception in sms!');
        } else {
            return back()->with('message', 'Client added succesfully!');
        }
    }
}
