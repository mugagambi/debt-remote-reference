<?php

namespace App\Http\Controllers;

use App\DueListing;
use App\Profile;
use Excel;
use Illuminate\Http\Request;
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
     * Return all the debtors
     *This is the list of customers and their debts
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        $debtors = DB::table('tbl_due_listings')
            ->leftJoin('tbl_profiles', 'tbl_profiles.id', '=', 'tbl_due_listings.profile_id')
            ->select('tbl_profiles.first_name', 'tbl_profiles.last_name', 'tbl_profiles.phone', 'tbl_profiles.address'
                , 'tbl_profiles.email', 'tbl_profiles.national_id', 'tbl_due_listings.amount', 'tbl_due_listings.date_credited')
            ->get();
        return $debtors;
    }

    /**
    *Add new debt
     *@return \Response
     */
    public function create()
    {
        return view();
    }

    /**
    *Store created debt
     *@param request
     *@return \Response
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
     *@param Profile $profile
     * @return \Response
     */
    public function debt_status(Profile $profile)
    {
        $debts = DueListing::where('profile_id', $profile->id)->get();
        $total_debt = $debts->sum('amount');
        return view('due-listings.debt-status',['profile' => $profile, 'debts'=> $debts, 'total_debt' => $total_debt]);
    }

}
