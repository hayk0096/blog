<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $authors = Author::with('books')->paginate(10);
        return view('authors.index', compact('authors'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('authors.create');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'bio' => 'required'
        ]);

        if ($validator->fails()){
            return back()
                ->withInput()
                ->withErrors($validator->errors());
        }

        $file = $request->file('avatar');

        if ($file){
            $fileType = $file->getClientMimeType();
            if ($fileType == 'image/jpeg' || $fileType == 'image/jpg' || $fileType == 'image/png') {
                $extension = $file->getClientOriginalExtension();
            } else {
                return back()
                    ->withInput()
                    ->withErrors(['avatar' => "Chosen image doesn't have original type. Please choose another image."]);
            }
        }

        $author = Author::create([
            'full_name' => $request->full_name,
            'bio' => $request->bio,
            'user_id' => $request->user()->id
        ]);

        if ($file) {
            $fileNameToStore = 'authors/' . "author-$author->id." . $extension;
            $file->storeAs('public/', $fileNameToStore);
            $author->avatar = 'storage/' . $fileNameToStore;
            $author->save();
        }

        return redirect()
            ->route('authors.list')
            ->with('success', 'New author successfully created');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        $author = Author::with('books')->where('id', $id)->first();
        return $author == null
            ? back()->with('error', 'There is no author with the requested id')
            : view('authors.single', compact('author'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $author = Author::with('books')->where('id', $id)->first();

        if ($author == null) {
            return back()->with('error', 'There is no author with the requested id');
        }

        return $author->user_id != $request->user()->id
            ? back()->with('info', 'This author is not your\'s')
            : view('authors.edit', compact('author'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $author = Author::find($id);
        if ($author == null) {
            return back()->with('error', 'There is no author with the requested id');
        }

        if ($author->user_id != $request->user()->id){
            return back()->with('info', 'This author is not your\'s');
        }

        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
        ]);

        if ($validator->fails()){
            return back()
                ->withInput()
                ->withErrors($validator->errors());
        }

        $file = $request->file('avatar');
        $fileName = $author->avatar;

        if ($file){
            $fileType = $file->getClientMimeType();
            if ($fileType == 'image/jpeg' || $fileType == 'image/jpg' || $fileType == 'image/png') {
                if (file_exists($author->avatar)) {
                    $img = substr($author->avatar, 8);
                    Storage::delete('public/'.$img);
                }
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = 'authors/' . "author-$author->id." . $extension;
                $file->storeAs('public/', $fileNameToStore);
                $fileName = 'storage/' . $fileNameToStore;
            } else {
                return back()
                    ->withInput()
                    ->withErrors(['avatar' => "Chosen image doesn't have original type. Please choose another image."]);
            }
        }

        $author->update([
            'full_name' => $request->full_name,
            'bio' => $request->bio,
            'avatar' => $fileName,
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('author.show', [$author->id])
            ->with('success', 'Author info updated successful');
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $author = Author::find($id);
        if ($author == null) {
            return back()->with('error', 'There is no author with the requested id');
        }

        if ($author->user_id != $request->user()->id){
            return back()->with('info', 'This author is not your\'s');
        }

        Author::destroy($id);
        return redirect()->route('authors.list')
            ->with('success', "Author successfully deleted");
    }

}
