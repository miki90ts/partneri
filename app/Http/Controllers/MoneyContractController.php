<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MoneyContract;
use App\Models\{Packet, Company, ContractStatus};

class MoneyContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $packets = Packet::all();
        $companies = Company::all();
        $statuses = ContractStatus::all();
        
        return view('contracts.money.create', compact('packets','companies','statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = Company::findOrFail($request->company);
        $packet = Packet::findOrFail($request->packet);
            
        $contract = new MoneyContract;
        $contract->start_of_contract = $request->start_of_contract;
        switch ($packet->name) {
            case 'Златни партнер':
            case 'Сребрни партнер':
                $contract->end_of_contract = Carbon::createFromFormat('Y-m-d', $request->start_of_contract)->addMonths(24);
                break;
            default:
            $contract->end_of_contract = Carbon::createFromFormat('Y-m-d', $request->start_of_contract)->addMonths(12);
        }     
        $contract->status = $request->status;
        if ($request->has('facture_send')) {
            $contract->facture_send = $request->facture_send;
        }
        if ($request->has('payment_done')) {
            $contract->payment_done = $request->payment_done;
        }
        $contract->date_of_payment = $request->date_of_payment;
        $contract->comment = $request->comment;    

        $contract->packet()->associate($packet);

        $company->moneyContract()->save($contract);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MoneyContract  $moneyContract
     * @return \Illuminate\Http\Response
     */
    public function show(MoneyContract $moneyContract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MoneyContract  $moneyContract
     * @return \Illuminate\Http\Response
     */
    public function edit(MoneyContract $moneyContract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MoneyContract  $moneyContract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MoneyContract $moneyContract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MoneyContract  $moneyContract
     * @return \Illuminate\Http\Response
     */
    public function destroy(MoneyContract $moneyContract)
    {
        //
    }
}