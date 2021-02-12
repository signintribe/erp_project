<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorModels\tblcompanyprotfolio;
use Auth;
use DB;

/**
 * Description of CompanyPortfolioController
 *
 * @author Attique
 */
class CompanyPortfolioController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('user.compan_portfolio');
    }

    /**
     * 
     * @return type
     * Get company portfolio images
     */
    public function getcompanyportfolio() {
        $company_id = \App\Models\VendorModels\tblcompanydetail::select('id')->where('user_id', Auth::user()->id)->first();
        if (!empty($company_id)) {
            return tblcompanyprotfolio::where('company_id', $company_id->id)->get();
        } else {
            return 'false';
        }
    }

    /**
     * 
     * @param type $image_id
     * @return string
     * Delete portfolio images
     */
    public function delete_portfolio_image($image_id) {
        tblcompanyprotfolio::where('id', $image_id)->delete();
        return 'File Delete Permanently';
    }

    public function edit_portfolio_image($portfolio_id) {
        return tblcompanyprotfolio::where('id', $portfolio_id)->first();
    }

    public function SaveCompanyPortfolio(Request $request) {
        $company_id = \App\Models\VendorModels\tblcompanydetail::select('id')->where('user_id', Auth::user()->id)->first();
        $chkprt = array();
        $chkprt = tblcompanyprotfolio::where('company_id', $company_id->id)->first();
        if (empty($chkprt)) {
            if ($request->hasFile('userfile')) {
                $files = $request->file('userfile');
                foreach ($files as $file) {
                    $current = date('ymd') . rand(1, 999999) . time();
                    $portimgname = $current . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('/company_portfolio'), $portimgname);
                    tblcompanyprotfolio::create([
                        'company_id' => $company_id->id,
                        'portfolio_image' => $portimgname
                    ]);
                }
            }
        } else {
            if ($request->hasFile('companyPortfolio')) {
                $portf = array();
                $current = date('ymd') . rand(1, 999999) . time();
                $file = $request->file('companyPortfolio');
                $imgname = $current . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/company_portfolio'), $imgname);
                $portf = tblcompanyprotfolio::where('id', $request->id)->first();
                if (!empty($portf)) {
                    $portf->portfolio_image = $imgname;
                    $portf->save();
                } else {
                    $count = DB::select('SELECT count(id) as count_portfolio FROM tblcompanyprotfolios WHERE company_id = ' . $company_id->id . '');
                    if ($count[0]->count_portfolio < 6) {
                        tblcompanyprotfolio::create([
                            'company_id' => $company_id->id,
                            'portfolio_image' => $imgname
                        ]);
                    } else {
                        return "Your portfolio image limit excced";
                    }
                }
                return "Portfolio Image Save Successfully";
            } else {
                return "Please Choose Image";
            }
        }
    }

}
