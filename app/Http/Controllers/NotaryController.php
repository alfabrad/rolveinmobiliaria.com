<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Client;
use App\Notary;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class NotaryController extends Controller
{
    use ThrottlesLogins;

    /**
     * Set the uri returned to views.
     *
     * @var string
     */
    private $_uri = 'sale';

    /**
     * Set the localization for the language in the app.
     *
     * @var string
     */
    private $_locale;

    /**
     * Set the message to the used returned to views.
     *
     * @var string
     */
    private $_message = null;

    /**
     * Set the type of the alarm return to views.
     *
     * @var string
     */
    private $_type = null;

    /**
     * Date of the attribute updated or created.
     *
     * @var string
     */
    private $_date = null;

    public function __construct()
    {
        $this->_locale = \App::getLocale();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Sale $sale)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Sale $sale)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Sale $sale)
    {
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale, Notary $notary)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale, Notary $notary)
    {
        $clients = Client::all();

        return view('sales.edit_notary', [
            'uri' => $this->_uri,
            'sale' => $sale,
            'clients' => $clients,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale, Notary $notary)
    {
        $this->_date = now()->format('U');
        $SN_federal_entity = $request->SN_federal_entity ?? null;
        $SN_notaries_office = $request->SN_notaries_office ?? null;
        $SN_zoning = !empty($request->SN_zoning) ? $this->_date : null;
        $SN_water_no_due_constants = !empty($request->SN_water_no_due_constants) ? $this->_date : null;
        $SN_non_debit_proof_of_property = !empty($request->SN_non_debit_proof_of_property) ? $this->_date : null;
        $SN_certificate_of_improvement = !empty($request->SN_certificate_of_improvement) ? $this->_date : null;
        $SN_key_and_cadastral_value = !empty($request->SN_key_and_cadastral_value) ? $this->_date : null;
        $SN_date_freedom_of_lien_certificate = !empty($request->SN_date_freedom_of_lien_certificate)
            ? Carbon::parse($request->SN_date_freedom_of_lien_certificate)->format('U')
            : null;
        $SN_observations_freedom_of_lien_certificate = $request->SN_observations_freedom_of_lien_certificate;
        $SN_seller_documents = !empty($request->SN_seller_documents) ? $this->_date : null;
        $SN_buyer_documents = !empty($request->SN_buyer_documents) ? $this->_date : null;
        $SN_activation_documents_for_the_mortgage_loan = !empty($request->SN_activation_documents_for_the_mortgage_loan) ? $this->_date : null;
        $SN_complete = (
            $SN_federal_entity !== null ||
            $SN_notaries_office !== null ||
            $SN_zoning !== null ||
            $SN_water_no_due_constants !== null ||
            $SN_non_debit_proof_of_property !== null ||
            $SN_certificate_of_improvement !== null ||
            $SN_key_and_cadastral_value !== null ||
            $SN_date_freedom_of_lien_certificate !== null ||
            $SN_observations_freedom_of_lien_certificate !== null ||
            $SN_seller_documents !== null ||
            $SN_buyer_documents !== null ||
            $SN_activation_documents_for_the_mortgage_loan !== null
        );
        $notaryInfo = [
            'SN_federal_entity' => $SN_federal_entity,
            'SN_notaries_office' => $SN_notaries_office,
            'SN_zoning' => $SN_zoning,
            'SN_water_no_due_constants' => $SN_water_no_due_constants,
            'SN_non_debit_proof_of_property' => $SN_non_debit_proof_of_property,
            'SN_certificate_of_improvement' => $SN_certificate_of_improvement,
            'SN_key_and_cadastral_value' => $SN_key_and_cadastral_value,
            'SN_date_freedom_of_lien_certificate' => $SN_date_freedom_of_lien_certificate,
            'SN_observations_freedom_of_lien_certificate' => $SN_observations_freedom_of_lien_certificate,
            'SN_seller_documents' => $SN_seller_documents,
            'SN_buyer_documents' => $SN_buyer_documents,
            'SN_activation_documents_for_the_mortgage_loan' => $SN_activation_documents_for_the_mortgage_loan,
            'SN_complete' => $SN_complete,
        ];
        $notary = $sale->notary()
            ->update($notaryInfo);

        $this->_message = $notary ? 'Notaría actualizada' : 'No se pudo actualizar la notaría.';
        $this->_type = $notary ? 'success' : 'danger';
        $request->session()->flash('message', $this->_message);
        $request->session()->flash('type', $this->_type);

        // event(new SaleCreatedEvent($sale));

        if ($notary) {
            return redirect()->route('sale.index');
        }

        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale, Notary $notary)
    {
    }
}
