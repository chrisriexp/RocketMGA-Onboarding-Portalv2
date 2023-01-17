<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Users::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newUser = new Users;
        $newUser->email = $request->user['email'];
        $newUser->rocketMGA_id = $request->user['rocketMGA_id'];
        $newUser->stage = $request->user['stage'];
        $newUser->save();

        return $newUser;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $existingUser = Users::find($id);

        return $existingUser;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**RocketMGA ID */
        $existingUser = Users::find($id);
        if(!empty($request->user['rocketMGA_id'])){
            $existingUser->rocketMGA_id = $request->user['rocketMGA_id'];
            $existingUser->save();
        }

        /**Agency Name */
        if(!empty($request->user['agency_name'])){
            $existingUser->agency_name = $request->user['agency_name'];
            $existingUser->save();
        }

        /**DBA Name */
        if(!empty($request->user['dba_name'])){
            $existingUser->dba_name = $request->user['dba_name'];
            $existingUser->save();
        }

        /**Phone */
        if(!empty($request->user['phone'])){
            $existingUser->phone = $request->user['phone'];
            $existingUser->save();
        }

        /**Email */
        if(!empty($request->user['email'])){
            $existingUser->email = $request->user['email'];
            $existingUser->save();
        }

        /**Address */
        if(!empty($request->user['address'])){
            $existingUser->address = $request->user['address'];
            $existingUser->save();
        }

        /**Address 1 */
        if(!empty($request->user['address_1'])){
            $existingUser->address_1 = $request->user['address_1'];
            $existingUser->save();
        }

        /**Address 2 */
        if(!empty($request->user['address_2'])){
            $existingUser->address_2 = $request->user['address_2'];
            $existingUser->save();
        }

        /**City */
        if(!empty($request->user['city'])){
            $existingUser->city = $request->user['city'];
            $existingUser->save();
        }

        /**State */
        if(!empty($request->user['state'])){
            $existingUser->state = $request->user['state'];
            $existingUser->save();
        }

        /**Zip */
        if(!empty($request->user['zip'])){
            $existingUser->zip = $request->user['zip'];
            $existingUser->save();
        }

        /**Zip+4 */
        if(!empty($request->user['zip4'])){
            $existingUser->zip4 = $request->user['zip4'];
            $existingUser->save();
        }
        
        /**Agent Name */
        if(!empty($request->user['agent_name'])){
            $existingUser->agent_name = $request->user['agent_name'];
            $existingUser->save();
        }

        /**Agent First Name */
        if(!empty($request->user['first_name'])){
            $existingUser->first_name = $request->user['first_name'];
            $existingUser->save();
        }

        /**Agent Last Name */
        if(!empty($request->user['last_name'])){
            $existingUser->last_name = $request->user['last_name'];
            $existingUser->save();
        }

        /**Additional States */
        if(!empty($request->user['additional_states'])){
            $existingUser->additional_states = $request->user['additional_states'];
            $existingUser->save();
        }

        /**Carriers */
        if(!empty($request->user['carriers'])){
            $existingUser->carriers = $request->user['carriers'];
            $existingUser->save();
        }

        /**Aon */
        if(!empty($request->user['aon'])){
            $existingUser->aon = $request->user['aon'] ? true : false;
            $existingUser->save();
        }

        /**Beyond */
        if(!empty($request->user['beyond'])){
            $existingUser->beyond = $request->user['beyond'] ? true : false;
            $existingUser->save();
        }

        /**Dual */
        if(!empty($request->user['dual'])){
            $existingUser->dual = $request->user['dual'] ? true : false;
            $existingUser->save();
        }

        /**Flow */
        if(!empty($request->user['flow'])){
            $existingUser->flow = $request->user['flow'] ? true : false;
            $existingUser->save();
        }

        /**Neptune */
        if(!empty($request->user['neptune'])){
            $existingUser->neptune = $request->user['neptune'] ? true : false;
            $existingUser->save();
        }

        /**Palomar */
        if(!empty($request->user['palomar'])){
            $existingUser->palomar = $request->user['palomar'] ? true : false;
            $existingUser->save();
        }

        /**Sterling */
        if(!empty($request->user['sterling'])){
            $existingUser->sterling = $request->user['sterling'] ? true : false;
            $existingUser->save();
        }

        /**Wright */
        if(!empty($request->user['wright'])){
            $existingUser->wright = $request->user['wright'] ? true : false;
            $existingUser->save();
        }

        /**Agency License Number */
        if(!empty($request->user['agency_license'])){
            $existingUser->agency_license = $request->user['agency_license'];
            $existingUser->save();
        }

        /**Agent License Number */
        if(!empty($request->user['agent_license'])){
            $existingUser->agent_license = $request->user['agent_license'];
            $existingUser->save();
        }

        /**Agent License Eff */
        if(!empty($request->user['agent_license_eff'])){
            $existingUser->agent_license_eff = $request->user['agent_license_eff'];
            $existingUser->save();
        }

        /**Agent License Exp */
        if(!empty($request->user['agent_license_exp'])){
            $existingUser->agent_license_exp = $request->user['agent_license_exp'];
            $existingUser->save();
        }

        /**EO Exp */
        if(!empty($request->user['eo_exp'])){
            $existingUser->eo_exp = $request->user['eo_exp'];
            $existingUser->save();
        }

        /**EO Policy Number */
        if(!empty($request->user['eo_policy'])){
            $existingUser->eo_policy = $request->user['eo_policy'];
            $existingUser->save();
        }

        /**EO Limit */
        if(!empty($request->user['eo_limit'])){
            $existingUser->eo_limit = $request->user['eo_limit'];
            $existingUser->save();
        }

        /**EO Insurer */
        if(!empty($request->user['eo_insurer'])){
            $existingUser->eo_insurer = $request->user['eo_insurer'];
            $existingUser->save();
        }

        /**EO */
        if(!empty($request->user['eo'])){
            $existingUser->eo = $request->user['eo'];
            $existingUser->save();
        }

        /**Agency Tax ID */
        if(!empty($request->user['agency_tax_id'])){
            $existingUser->agency_tax_id = $request->user['agency_tax_id'];
            $existingUser->save();
        }

        /**Agent NPN */
        if(!empty($request->user['agent_npn'])){
            $existingUser->agent_npn = $request->user['agent_npn'];
            $existingUser->save();
        }

        /**Agency Type */
        if(!empty($request->user['agency_type'])){
            $existingUser->agency_type = $request->user['agency_type'];
            $existingUser->save();
        }

        /**Agency Logo */
        if(!empty($request->user['agency_logo'])){
            $existingUser->agency_logo = $request->user['agency_logo'];
            $existingUser->save();
        }

        /**Submitted */
        if(!empty($request->user['submitted'])){
            $existingUser->submitted = $request->user['submitted'] ? true : false;
            $existingUser->save();
        }

        /**Stage */
        if(!empty($request->user['stage'])){
            $existingUser->stage = $request->user['stage'];
            $existingUser->save();
        }

        /**Document ID */
        if(!empty($request->user['document_id'])){
            $existingUser->document_id = $request->user['document_id'];
            $existingUser->save();
        }

        /**Document Status */
        if(!empty($request->user['document_status'])){
            $existingUser->document_status = $request->user['document_status'];
            $existingUser->save();
        }

        /**Embed ID */
        if(!empty($request->user['embed_id'])){
            $existingUser->embed_id = $request->user['embed_id'];
            $existingUser->save();
        }

        return $existingUser;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
