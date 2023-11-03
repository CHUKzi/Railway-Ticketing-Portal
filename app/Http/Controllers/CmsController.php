<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CmsController extends Controller
{
    public function termsAndPolicies()
    {
        // Terms & Policies index page
        $terms_policies = Cms::where('type','terms')->first();
        return view('cms.terms-&-policies', compact('terms_policies'));
    }

    public function updateTermsAndPolicies(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);
        // Update Terms & Policies
        try {
            $terms_policies = Cms::where('type','terms')->first();
            if ($terms_policies){
                $terms_policies->description = $request->description;
                $terms_policies->save();
            } else {
                $terms_policies = new Cms();
                $terms_policies->type = 'terms';
                $terms_policies->description = $request->description;
                $terms_policies->save();
            }
            return redirect()->route('terms.policies')->with('SuccessMessage', 'Terms And Policies Updated successfully');
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return back()->with('ErrorMessage', 'An error occurred while updating the package.');
        }
    }
}
