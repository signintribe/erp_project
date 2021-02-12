<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Http\Request;
use DB;
use PDF;
use App\Models\tblreports;
use App\Models\tblreport_definations;
use App\Http\Controllers\Controller;

/**
 * Description of FinanceReportController
 *
 * @author Attique
 */
class FinanceReportController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * 
     * @return type
     * Finance Reports
     */
    public function finance_report() {
        $Accounts = DB::select("call getAccounts()");
        return view('Finance.views.finance_report', compact('Accounts'));
    }

    /**
     * 
     * @return type
     * Finance General Journal Reports
     */
    public function report_general_journal() {
        return view('Finance.views.report_general_journal');
    }

    public function report_general_ledger() {
        return view('Finance.views.ledger-report');
    }

    public function TrialBalance() {
        return view('Finance.views.TrialBalance');
    }

    public function incomeStatement() {
        return view('Finance.views.incomeStatement');
    }

    public function BalanceSheet() {
        return view('Finance.views.BalanceSheet');
    }

    public function advance_reports() {
        return view('Finance.advance-reports');
    }

    public function definereportform() {
        return view('Finance.views.define-customise-report');
    }

    function GeneraljournalreportData(Request $r) {
        $fromdate = $r->datefrom;
        $todate = $r->dateto;
        $data = DB::select("select * from (select id,AccountId, CategoryName from tblaccountcategories where id in (select account_Id from tblgeneralentries where date >= '$fromdate' AND date <='$todate') ) x join (select * from tblgeneralentries where date >= '$fromdate' AND date <='$todate') a on x.id = a.account_Id order by a.id asc");
        return $data;
    }

    function GeneraljournalLedgerreportData(Request $r) {
        $fromdate = $r->datefrom;
        $todate = $r->dateto;
        $data = DB::select("select id,AccountId,CategoryName from tblaccountcategories where id in (select account_Id from tblgeneralentries where date >= '$fromdate' AND date <='$todate')");
        foreach ($data as $k => $v):
            $Total = DB::select("select dc.debitTotal, dc.CreditTotal, ac.CategoryName from (
                                    select account_id, IFNULL(sum(debit), 0) as debitTotal, IFNULL(sum(credit), 0) as CreditTotal 
                                    from tblgeneralentries where date >= '$fromdate' AND date <='$todate' AND account_Id = '" . $v->id . "'
                                ) as dc join (
                                    select id, CategoryName 
                                    from tblaccountcategories
                                ) as ac on ac.id = dc.account_id");
            $data[$k]->debitTotal = $Total[0]->debitTotal;
            $data[$k]->CreditTotal = $Total[0]->CreditTotal;
            $data[$k]->CatName = $Total[0]->CategoryName;
            $data[$k]->data = DB::select("select * from tblgeneralentries where date >= '$fromdate' AND date <='$todate' AND account_Id = '" . $v->id . "'");
        endforeach;
        return $data;
    }

    function customizereportdata(Request $r) {
        $fromdate = $r->datefrom;
        $todate = $r->dateto;
        $reportId = $r->reportId;
        $data = DB::select("select id,AccountId,CategoryName from tblaccountcategories where id in (select account_id from tblreport_definations where report_id ='$reportId')");
        foreach ($data as $k => $v):
            $Total = DB::select("select IFNULL(sum(debit), 0) as debitTotal, IFNULL(sum(credit), 0) as CreditTotal from tblgeneralentries where date >= '$fromdate' AND date <='$todate' AND account_Id = '" . $v->id . "'");
            $data[$k]->debitTotal = $Total[0]->debitTotal;
            $data[$k]->CreditTotal = $Total[0]->CreditTotal;
            $data[$k]->data = DB::select("select * from tblgeneralentries where date >= '$fromdate' AND date <='$todate' AND account_Id = '" . $v->id . "'");
        endforeach;
        return $data;
    }

    function TrialBalanceReportData(Request $r) {
        $fromdate = $r->datefrom;
        $todate = $r->dateto;
        return $data = DB::select("select * from (select id,AccountId,CategoryName from tblaccountcategories where id in (select account_Id from tblgeneralentries where date >= '$fromdate' AND date <='$todate') ) x join (select account_Id,IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");
    }

    function incomeStatementReportData(Request $r) {
        $fromdate = $r->datefrom;
        $todate = $r->dateto;
        $data['income'] = DB::select("select * from (select id,CategoryName from tblaccountcategories where id in (select  productlineid from categoriesproductline where categoryid = 27) ) x join (select account_Id, IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");
        $data['COS'] = DB::select("select * from (select id,CategoryName from tblaccountcategories where id in (select  productlineid from categoriesproductline where categoryid = 31) ) x join (select account_Id, IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");
        $data['expance'] = DB::select("select * from (select id,CategoryName from tblaccountcategories where id in (select  productlineid from categoriesproductline where categoryid = 30) ) x join (select account_Id, IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");
        $data['operatingCost'] = DB::select("select * from (select id,CategoryName from tblaccountcategories where id in (select  productlineid from categoriesproductline where categoryid = 33) ) x join (select account_Id, IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");
        $data['FinancialExpenses'] = DB::select("select * from (select id,CategoryName from tblaccountcategories where id in (select  productlineid from categoriesproductline where categoryid = 36) ) x join (select account_Id, IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");

        return $data;
    }

    function BalanceSheetReportData(Request $r) {
        $fromdate = $r->datefrom;
        $todate = $r->dateto;
        $data['CurrentLiablites'] = DB::select("select * from (select id,CategoryName from tblaccountcategories where id in (select  productlineid from categoriesproductline where categoryid = 18)) x join (select account_Id, IF(sum(debit) > 0, IFNULL(sum(credit), 0) - IFNULL(sum(debit), 0) , IFNULL(sum(credit), 0)) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");
        $data['FixedAsset'] = DB::select("select * from (select id,CategoryName from tblaccountcategories where id in (select  productlineid from categoriesproductline where categoryid = 5) ) x join (select account_Id, IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");
        $data['OtherAsset'] = DB::select("select * from (select id,CategoryName from tblaccountcategories where id in (select  productlineid from categoriesproductline where categoryid = 20) ) x join (select account_Id, IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");
        $data['CurrentAsset'] = DB::select("select * from (select id,CategoryName from tblaccountcategories where id in (select  productlineid from categoriesproductline where categoryid = 13) ) x join (select account_Id, IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");
        $data['LongtermLiablites'] = DB::select("select * from (select id,CategoryName from tblaccountcategories where id in (select  productlineid from categoriesproductline where categoryid = 14) ) x join (select account_Id, IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");
        $data['Equity'] = DB::select("select * from (select id,CategoryName from tblaccountcategories where id in (select  productlineid from categoriesproductline where categoryid = 11) ) x join (select account_Id, IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");
        $data['NetIncome'] = DB::select("select (select IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) * -1 from tblgeneralentries where date >= '$fromdate' AND date <='$todate' AND account_Id in (select  productlineid from categoriesproductline where categoryid = 27)) - (select IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) from tblgeneralentries where date >= '$fromdate' AND date <='$todate' AND account_Id in (select  productlineid from categoriesproductline where categoryid = 30))as NetIncome")[0]->NetIncome;
        $data['income'] = DB::select("select * from (select id,CategoryName from tblaccountcategories where id in (select  productlineid from categoriesproductline where categoryid = 27) ) x join (select account_Id, IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");
        $data['BbusinessCapital'] = DB::select("select * from (select id,CategoryName from tblaccountcategories where id = 26) x join (select account_Id, IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");
        $data['expance'] = DB::select("select * from (select id,CategoryName from tblaccountcategories where id in (select  productlineid from categoriesproductline where categoryid = 30) ) x join (select account_Id, IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");
        $data['COS'] = DB::select("select * from (select id,CategoryName from tblaccountcategories where id in (select  productlineid from categoriesproductline where categoryid = 31) ) x join (select account_Id, IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");
        $data['operatingCost'] = DB::select("select * from (select id,CategoryName from tblaccountcategories where id in (select  productlineid from categoriesproductline where categoryid = 33) ) x join (select account_Id, IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");
        $data['FinancialExpenses'] = DB::select("select * from (select id,CategoryName from tblaccountcategories where id in (select  productlineid from categoriesproductline where categoryid = 36) ) x join (select account_Id, IF(sum(debit) > 0, IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) , IFNULL(sum(credit), 0)) as Total from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id) a on x.id = a.account_Id");
        return $data;
    }

    function savecustomreport(Request $r) {
        $report = new tblreports;
        $report->title = $r->title;
        $report->description = $r->description;
        $report->created_by = Auth::user()->id;
        $report->save();
        $reportid = $report->id;
        foreach ($r->accounts as $id):
            tblreport_definations::create(['report_id' => $reportid, 'account_id' => $id]);
        endforeach;
        return $report;
    }

    function AllcustomizeReports() {
        return tblreports::get();
    }

    function deleteAccount($reportid) {
        tblreport_definations::where('report_id', $reportid)->delete();
        tblreports::find($reportid)->delete();
        return 'Account Has been Deleted';
    }

    function genrateReport($reportid) {
        $report = tblreports::find($reportid);
        return view('Finance.views.ViewCustomizeReport', compact('report'));
    }

    function gentaretPDF(Request $r) {
//        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $fromdate = Input::get('datefrom');
        $todate = Input::get('dateto');
        $reportId = Input::get('reportId');
        $Accounts = DB::select("select id,AccountId,CategoryName from tblaccountcategories where id in (select account_id from tblreport_definations where report_id ='$reportId')");
        foreach ($Accounts as $k => $v):
            $Total = DB::select("select IFNULL(sum(debit), 0) as debitTotal, IFNULL(sum(credit), 0) as CreditTotal from tblgeneralentries where date >= '$fromdate' AND date <='$todate' AND account_Id = '" . $v->id . "'");
            $Accounts[$k]->debitTotal = $Total[0]->debitTotal;
            $Accounts[$k]->CreditTotal = $Total[0]->CreditTotal;
            $Accounts[$k]->data = DB::select("select * from tblgeneralentries where date >= '$fromdate' AND date <='$todate' AND account_Id = '" . $v->id . "'");
        endforeach;
        $data = array('fromdate' => $fromdate, 'todate' => $todate, 'title' => Input::get('fileName'));
//        return view('Finance.views.genratepdf', compact('Accounts'));
        $pdf = PDF::loadView('Finance.views.genratepdf', compact('Accounts', 'data'));
        $file = str_replace(' ', '', Input::get('fileName')) . date('(Ymdhi)') . '.pdf';
        return $pdf->download($file);
    }

    public function balance_sheet() {
        return view('Finance.balance-sheet');
    }

    public function income_statement() {
        return view('Finance.income-statement');
    }

    public function cash_flow() {
        return view('Finance.cash-flow');
    }

    public function fixed_asset() {
        return view('Finance.fixed-asset');
    }

}
