<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Models\commenter;
class PostsController extends Controller
{

   
    /**
     * Store a new post in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Post::create($data);

            return redirect()->route('home')
                ->with('success_message', trans('posts.model_was_added'));
        } catch (Exception $exception) {
        	

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('posts.unexpected_error')]);
        }
    }

   
    /**
     * Remove the specified post from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            foreach($post->commenter()->get() as $commenter){
            	$commenter->delete();
            }
            $post->delete();


            return redirect()->route('posts.post.index')
                ->with('success_message', trans('posts.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('posts.unexpected_error')]);
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

    	if ($request->hasFile('file')) {
  $rules = [
                'Text' => 'string|min:1|nullable',
                 ];
         $data = $request->validate($rules);
        $imageName = 'post/'.time().'.'.$request->file->extension();  
        $request->file->move(public_path('images/post'), $imageName);

            $data['file'] = $imageName;
            
            
          $data['user_id'] = Auth::user()->id;
        return $data;
        }

        $rules = [
                'Text' => 'string|min:1',
            'file' => ['file','nullable'],
         
        ];
       
        
        $data = $request->validate($rules);
        if ($request->has('custom_delete_file')) {
            $data['file'] = null;
        }
        
 $data['user_id'] = Auth::user()->id;
        return $data;
    }
  
    
}
