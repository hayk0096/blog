<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
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
        $books = Book::with('author', 'user')->paginate(12);
        return view('books.index', compact('books'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:books,name',
            'author' => 'required'
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

        $book = new Book();
        $book->name = $request->name;
        $book->context = $request->context;
        $book->author_id = $request->author;
        $book->user_id = $request->user()->id;
        $book->save();

        if (isset($extension)) {
            $fileNameToStore = 'books/' . "book-$book->id." . $extension;
            $file->storeAs('public/', $fileNameToStore);
            $book->update(['avatar' => 'storage/' . $fileNameToStore]);
        }

        return redirect()
            ->route('book.show', [$book->id])
            ->with('success', 'New book successfully created');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        $book = Book::with('author', 'user')->where('id', $id)->first();
        $authors = Author::all();

        return $book == null
            ? back()->with('error', 'There is no book with the requested id')
            : view('books.single', [ 'book' => $book, 'authors' => $authors ]);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $book = Book::with('author', 'user')->where('id', $id)->first();
        $authors = Author::all();

        if ($book == null) {
            return back()->with('error', 'There is no book with the requested id');
        }

        return $book->user->id != $request->user()->id
            ? back()->with('info', 'This book is not your\'s')
            : view('books.edit', [
                'book' => $book,
                'authors' => $authors
            ]);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if ($book == null) {
            return back()->with('error', 'There is no book with the requested id');
        }

        if ($book->user->id != $request->user()->id){
            return back()->with('info', 'This book is not your\'s');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'author' => 'required'
        ]);

        if ($validator->fails()){
            return back()
                ->withInput()
                ->withErrors($validator->errors());
        }

        $file = $request->file('avatar');
        $fileName = $book->avatar;

        if ($file){
            $fileType = $file->getClientMimeType();
            if ($fileType == 'image/jpeg' || $fileType == 'image/jpg' || $fileType == 'image/png') {
                if (file_exists($book->avatar)) {
                    $img = substr($book->avatar, 8);
                    Storage::delete('public/'.$img);
                }
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = 'books/' . "book-$book->id." . $extension;
                $file->storeAs('public/', $fileNameToStore);
                $fileName = 'storage/' . $fileNameToStore;
            } else {
                return back()
                    ->withInput()
                    ->withErrors(['avatar' => "Chosen image doesn't have original type. Please choose another image."]);
            }
        }

        $book->update([
            'book' => $request->name,
            'author_id' => $request->author,
            'avatar' => $fileName
        ]);

        return redirect()
            ->route('book.show', [$book->id])
            ->with('success', 'Book info updated successful');
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $book = Book::find($id);
        if ($book == null) {
            return back()->with('error', 'There is no book with the requested id');
        }

        if ($book->user_id != $request->user()->id){
            return back()->with('info', 'This book is not your\'s');
        }

        Book::destroy($id);
        return redirect()->route('books.list')
            ->with('success', "Book successfully deleted");
    }
}
