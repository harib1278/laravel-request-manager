<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();

        $response = $client->get('http://itemapi.stg/api/items');
        $items = json_decode($response->getBody()->getContents());

        return view('index')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the form input
        $this->validate($request, [
          'text' => 'required',
          'body' => 'required'
        ]);

        // Assemble into params
        $submission = http_build_query([
          'text' => $request->input('text'),
          'body' => $request->input('body')
        ]);

        // New guzzle client
        $client = New Client();

        try {
          // Submit the request to the api layer
          $response = $client->post('http://itemapi.stg/api/items?'.$submission);

        } catch(RequestException $e) {
          if ($e->hasResponse()) {
            $msg = $e->getResponse();
          } else {
            $msg = 'Sorry there was an error';
          }
          return redirect()->to('/')->with('error', $msg);
        }
        return redirect()->to('/')->with('success', 'Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = New Client();

        $response = $client->get('http://itemapi.stg/api/items/'.$id);

        $item = json_decode($response->getBody()->getContents());

        return view('edit')->with('item', $item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // Validate the form input
      $this->validate($request, [
        'text' => 'required',
        'body' => 'required'
      ]);

      // Assemble into params
      $submission = http_build_query([
        'text' => $request->input('text'),
        'body' => $request->input('body'),
        '_method' => 'PUT'
      ]);

      // New guzzle client
      $client = New Client();

      try {
        // Submit the request to the api layer
        $response = $client->post('http://itemapi.stg/api/items/'.$id.'?'.$submission);

      } catch(RequestException $e) {
        if ($e->hasResponse()) {
          $msg = $e->getResponse();
        } else {
          $msg = 'Sorry there was an error';
        }
        return redirect()->to('/')->with('error', $msg);
      }
      return redirect()->to('/')->with('success', 'Item updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = New Client();

        $response = $client->post('http://itemapi.stg/api/items/'.$id.'?_method=DELETE');

        $contents = json_decode($response->getBody()->getContents());

        if ($contents->success){
          return redirect()->to('/')->with('success', 'Item deleted successfully');
        }

        return redirect()->to('/')->with('error','There was an error with deletion');
    }
}
