<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        
        $this->validate($request, Profile::$rules);

        $profiles = new Profile;
        $form = $request->all();
        
        unset($form['_token']);
        
        $profiles->fill($form);
        $profiles->save();
        
        return redirect('admin/profile/create');
    }
    
    public function edit(Request $request)
    {
        $profiles = Profile::find($request->id);
        if (empty($profiles)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profiles]);
    }
    
    public function update(Request $request)
    {
        $this->validate($request, Profile::$rules);
        
        $profiles = Profile::find($request->id);
        
        $profiles_form = $request->all();
        
        unset($profiles_form['_token']);
        
        $profiles->fill($profiles_form)->save();
        
        return redirect('admin/profile/create');
    }
    
}
