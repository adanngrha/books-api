<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Book;
use Exception;

class BookController extends Controller
{
    public function all(Request $request)
    {
        $user_id = $request->user()->id;
        $books = Book::where('users_id', $user_id)->paginate(10);

        return ResponseFormatter::success([
            $books,
        ], 'Data Semua Buku Berhasil Diambil');
    }

    public function add(Request $request)
    {
        try {
            $request->validate([
                'isbn' => 'required|string',
                'title' => 'required|string',
                'subtitle' => 'required|string',
                'author' => 'required|string',
                'published' => 'required|string',
                'publisher' => 'required|string',
                'pages' => 'required|integer',
                'description' => 'required|string',
                'website' => 'required|string',
            ]);

            $user_id = $request->user()->id;

            Book::create([
                'user_id' => $user_id,
                'isbn' => $request->isbn,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'author' => $request->author,
                'published' => $request->published,
                'publisher' => $request->publisher,
                'pages' => $request->pages,
                'description' => $request->description,
                'website' => $request->website,
            ]);

            $book = Book::where('title', $request->title)->first();

            return ResponseFormatter::success($book, 'Book created');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong.',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function edit(Request $request, $book_id)
    {
        try {
            $book = Book::find($book_id);

            $request->validate([
                'isbn' => 'required|string',
                'title' => 'required|string',
                'subtitle' => 'required|string',
                'author' => 'required|string',
                'published' => 'required|string',
                'publisher' => 'required|string',
                'pages' => 'required|integer',
                'description' => 'required|string',
                'website' => 'required|string',
            ]);

            $data = $request->all();

            $book->update($data);

            return ResponseFormatter::success($book, 'Book Updated.');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong.',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function detail($book_id)
    {
        $book = Book::find($book_id);

        return ResponseFormatter::success([
            $book,
        ], 'Data Buku Berhasil Diambil');
    }

    public function destroy($book_id)
    {
        $book = Book::find($book_id);

        if ($book) {
            return ResponseFormatter::success(null, 'Buku Berhasil Dihapus');
        }
    }
}
