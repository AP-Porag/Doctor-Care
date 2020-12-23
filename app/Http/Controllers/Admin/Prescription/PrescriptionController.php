<?php

namespace App\Http\Controllers\Admin\Prescription;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Lab;
use App\Models\Medicine;
use App\Models\PrescribedMedicine;
use App\Models\PrescribedTest;
use App\Models\Prescription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class PrescriptionController extends Controller
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
        $patients = User::role('patient')->get();
        $medicines = Medicine::all();
        $labs = Lab::all();
        $categories = Category::all();
        return response(view('admin.prescriptions.prescription-create', compact('medicines', 'categories', 'patients', 'labs')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $medicines = $request->medicine;
        $categories = $request->med_category;
        $dosages = $request->dosage;
        $frequencies = $request->frequency;
        $days = $request->days;
        $instructions = $request->instruction;

        //return $instructions;
//        {
//            "_token": "9Z6DJwLJWSbinpGoRB1ozr57YbNcK4ciHpp4kr9G",
//"patient_id": "5",
//"doctor_id": "1",
//"history": "<p>History</p>",
//"symptom": "<p>Symptom</p>",
//"med_id": [
//            "Wade Norton",
//            "Ramona Ramos",
//            "Drake Hendrix"
//        ],
//"medicine": [
//            "4",
//            "7",
//            "12"
//        ],
//"med_category": [
//            "2",
//            "1",
//            "5"
//        ],
//"dosage": [
//            "2.5",
//            "20",
//            "80"
//        ],
//"frequency": [
//            "1+0+1",
//            "1+1+1",
//            "1"
//        ],
//"days": [
//            "7",
//            "15",
//            "3"
//        ],
//"instruction": [
//            "After Food",
//            "Before Food",
//            "Morning"
//        ],
//"investigation": [
//            "2"
//        ],
//"advice": "<p>advice</p>"
//}

        //return $request->all();

//        $this->validate($request, [
//            'patient_id' => 'required',
//            'doctor_id' => 'required',
//            'history' => 'required',
//            'symptom' => 'required',
//            'advice' => 'required',
//            'medicine' => 'required',
//            'med_category' => 'required',
//            'dosage' => 'required',
//            'frequency' => 'required',
//            'days' => 'required',
//            'instruction' => 'required',
//        ]);

        $prescription = Prescription::create([

            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'history' => $request->history,
            'symptom' => $request->symptom,
            'advice' => $request->advice,
        ]);

        //return $prescription;
        if ($prescription) {
            $investigations = $request->investigation;

            foreach ($investigations as $key=>$investigation) {
                PrescribedTest::create([
                    'prescription_id' => $prescription->id,
                    'lab_id' => $investigation
                ]);
            }
        }
        $prescribedMedicine = null;
        if ($prescription) {

            $medicines = $request->medicine;
            $category = $request->med_category;
            $dosage = $request->dosage;
            $frequency = $request->frequency;
            $day = $request->days;
            $instruction = $request->instruction;

            foreach ($medicines as $key=>$medicine) {
                $prescribedMedicine = PrescribedMedicine::create([
                    'prescription_id' => $prescription->id,
                    'medicine_id' => $medicine,
                    'category_id' => $category[$key],
                    'dosage' => $dosage[$key],
                    'frequency' => $frequency[$key],
                    'days' => $day[$key],
                    'instruction' => $instruction[$key],
                ]);
            }
        }

        if (!$prescription == null){
            Session::flash('success','Prescription Added Successfully !');
        }
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
