<?php

namespace App\Http\Controllers;

use App\Models\Book;
// use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        $books =  Book::all();
        return $books;
    }

    public function show($id)
    {
        $book = Book::find($id);
        return $book;
    }
    public function destroy($id)
    {
        Book::find($id)->delete();
    }
    public function store(Request $request)
    {
        $Book = new Book();
        $Book->author = $request->author;
        $Book->title = $request->title;
        $Book->save();
    }

    public function update(Request $request, $id)
    {
        $Book = Book::find($id);
        $Book->author = $request->author;
        $Book->title = $request->title;
    }

    public function bookCopies($title)
    {
        $copies = Book::with('copy_c')->where('title', '=', $title)->get();
        return $copies;
    }
    public function orderBooksbyAuthor()
    {
        $answer = DB::select(DB::raw("select author, title from books order by AUTHOR"));
        return $answer;
    }
    //     Határozd meg a könyvtár nyilvántartásában legalább 2 könyvvel rendelkező szerzőket!
    public function authorsWithAtLeastTwoBooks($number)
    {
        // $answer = DB::select(DB::raw("select author, count(*) from books group by author"));
        $answer = DB::table('books')
            ->selectRaw('author, count(*)')
            ->groupBy('author')
            ->having('count(*)', '>=', $number)
            ->get();
        return $answer;
    }
    // A B betűvel kezdődő szerzőket add meg!
    public function startsWithB()
    {
        $answer = DB::select(DB::raw("select author from books where LEFT(author, 1) = 'B'"));
        return $answer;
    }
    // A bejelentkezett felhasználó 3 napnál régebbi előjegyzéseit add meg! (együtt)
    public function oldRes($day)
    {
        $answer = DB::table('reservations')
            ->where('user_id', '=', Auth::user()->id)
            ->whereRaw('DATEDIFF(CURRENT_DATE, start) > ?', $day)
            ->get();
        return $answer;
    }
    // Bejelentkezett felhasználó azon kölcsönzéseit add meg (copy_id és db), ahol egy példányt legalább db-szor (paraméteres fg) kölcsönzött ki! (együtt)
    // Hosszabbítsd meg a könyvet, ha nincs rá előjegyzés! (együtt)

}
