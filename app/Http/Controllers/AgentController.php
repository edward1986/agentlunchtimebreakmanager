<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agent = Agent::all();
        return response()->json($agent);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agent  = $request->hold ? Agent::updateOrCreate(
            ['id' => $request->id],
            ['istimer' => $request->istimer, 'hold' => $request->hold]
        ) : Agent::updateOrCreate(
            ['id' => $request->id],
            ['istimer'=> $request->istimer, 'date_started' => $request->date_started]
        );
        return response()->json($agent);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Agent $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Agent $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $agent)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Agent $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        //
    }
}
