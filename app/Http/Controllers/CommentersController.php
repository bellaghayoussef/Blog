<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\commenter;
use Illuminate\Http\Request;
use Exception;
use Auth;
class CommentersController extends Controller
{

    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            commenter::create($data);

            return redirect()->route('home')
                ->with('success_message', 'Commenter was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    /**
     * Remove the specified commenter from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $commenter = commenter::findOrFail($id);
            $commenter->delete();

            return redirect()->route('commenters.commenter.index')
                ->with('success_message', 'Commenter was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
                'text' => 'string|min:1',
       
            'post_id' => 'nullable', 
        ];
        
        $data = $request->validate($rules);

 $data['user_id'] = Auth::user()->id;
        return $data;
    }

}
