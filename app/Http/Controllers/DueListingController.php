<?php

namespace App\Http\Controllers;

use App\DueListing;
use App\Profile;
use Excel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DueListingController extends Controller
{
    /**
     *Create a new Listings controller
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return debtors-report view
     *This is the list of customers and their debts
     * @return \Response
     */
    public function index()
    {
        $debtors = DB::table('tbl_due_listings')
            ->leftJoin('tbl_profiles', 'tbl_profiles.id', '=', 'tbl_due_listings.profile_id')
            ->select('tbl_profiles.first_name', 'tbl_profiles.last_name', 'tbl_profiles.phone', 'tbl_profiles.address'
                , 'tbl_profiles.email', 'tbl_profiles.national_id', 'tbl_due_listings.amount', 'tbl_due_listings.date_credited')
            ->get();
        return view('due-listings.debtors-report');
    }

    /**
     *Return all debtors
     * @return Collection
     */
    public function debtors_list()
    {
        return DB::table('tbl_due_listings')
            ->leftJoin('tbl_profiles', 'tbl_profiles.id', '=', 'tbl_due_listings.profile_id')
            ->select('tbl_profiles.first_name', 'tbl_profiles.last_name', 'tbl_profiles.phone', 'tbl_profiles.address'
                , 'tbl_profiles.email', 'tbl_profiles.national_id', 'tbl_due_listings.amount', 'tbl_due_listings.date_credited')
            ->get();
    }

    /**
     *Add new debt
     * @return \Response
     */
    public function create()
    {
        return view();
    }

    /**
     *Store created debt
     * @param request
     * @return \Response
     */
    public function store(Request $request)
    {
        //validate data sent
        $this->validate($request, [
            'amount' => 'required|numeric',
            'profile_id' => 'integer|required',
            'date_credited' => 'date|required'
        ]);
        DueListing::create([
            'profile_id' => $request['profile_id'],
            'amount' => $request['amount'],
            'date_credited' => $request['date_credited']
        ]);
        return redirect();

    }

    /**
     *File to export to Excel
     * @param Request $request
     * @param string $type
     * @return \Response
     */
    public function downloadExcelFile(Request $request, $type)
    {
        $debts = DB::table('tbl_profiles')
            ->join('tbl_due_listings', 'tbl_profiles.id', '=', 'tbl_due_listings.profile_id')
            ->select('tbl_profiles.first_name', 'tbl_profiles.last_name', 'tbl_profiles.phone', 'tbl_profiles.address'
                , 'tbl_profiles.email', 'tbl_profiles.national_id', 'tbl_due_listings.amount', 'tbl_due_listings.date_credited')
            ->get();
        foreach ($debts as $debt) {
            $data[] = array(
                "first_name" => $debt->first_name,
                "last_name" => $debt->last_name,
                "email" => $debt->email,
                "phone" => $debt->phone,
                "address" => $debt->address,
                "national_id" => $debt->national_id,
                "amount" => $debt->amount,
                "date_credited" => $debt->date_credited
            );
        }
        return Excel::create('Debtors', function ($excel) use ($data) {
            $excel->sheet('Debt List', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->export($type);
    }

    /**
     *Return Debt status for a certain customer
     * @param Profile $profile
     * @return \Response
     */
    public function debt_status(Profile $profile)
    {
        $debts = DueListing::where('profile_id', $profile->id)->get();
        $total_debt = $debts->sum('amount');
        return view('due-listings.debt-status', ['profile' => $profile, 'debts' => $debts, 'total_debt' => $total_debt]);
    }

    /**
     *Find customer debt status
     * @return \Response
     */
    public function find_customer_debt_status()
    {
        return view('due-listings.find-customer');
    }

    /**
     *Perform the customer debt search
     * @param Request $request
     * @return \Response
     */
    public function search_debt(Request $request)
    {
        $this->validate($request, [
            'search' => 'required|string',
            'key' => 'required|string'
        ]);
        if ($request['search'] == 'phone') {
            try {
                $profile = Profile::where('phone', $request['key'])->firstOrFail();
                flash('Debt details for ' . $profile->first_name . ' ' . $profile->last_name)->success();
                return redirect('/debt/status/' . $profile->id);
            } catch (ModelNotFoundException $e) {
                flash('Customer with that phone number not found.Search again')->error()->important();
                return redirect('debt/status');
            }
        }
        if ($request['search'] == 'national_id') {
            try {
                $profile = Profile::where('national_id', (int)$request['key'])->firstOrFail();
                flash('Debt details for ' . $profile->first_name . ' ' . $profile->last_name)->success();
                return redirect('/debt/status/' . $profile->id);
            } catch (ModelNotFoundException $e) {
                flash('Customer with that National ID not found.Search Again')->error()->important();
                return redirect('debt/status');
            }
        }
        flash('Sorry could not get your search.Please try again')->error()->important();
        return redirect('debt/status');
    }

}
