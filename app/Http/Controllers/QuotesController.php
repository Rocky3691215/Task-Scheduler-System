<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuotesController extends Controller
{
    public function index()
    {
        $quotes = $this->getQuotes();
        //dd($quotes);
        return view('quotes.index', [
            'quotes'=>$quotes
        ]);
    }


    public function filterByAuthor($author)
    {
        //to filter an array, you must get the array
        $quotes = $this->getQuotes();
        $filtered_quotes = array_filter($quotes, function($quote) use ($author){
            //normalize your code so that it can filter both lowercase and uppercase
            if (strpos(strtolower($quote['author']), strtolower($author))!==false){
                return true;
            }
        });
        $quotes = $filtered_quotes;
        return view('quotes.index', [
            'quotes'=>$quotes
        ]);
    }






    public function getQuotes()
    {
        return [
            ["quote"=>"Life isn't getting and having, it's about giving and being.","author"=>"Kevin Kruse"],
            ["quote"=>"Getting and having, it's about giving and being.","author"=>"Kev Krus"],
            ["quote"=>"Life isn't getting, it's about being.","author"=>"Evin Use"],
            ["quote"=>"Life isn't having, it's about giving.","author"=>"Vin Kruse"],
                        [
                'quote' => "The only way to do great work is to love what you do.",
                'author' => "Steve Jobs",
            ],
            [
                'quote' => "Innovation distinguishes between a leader and a follower.",
                'author' => "Steve Jobs",
            ],
            [
                'quote' => "The future belongs to those who believe in the beauty of their dreams.",
                'author' => "Eleanor Roosevelt",
            ],
            [
                'quote' => "The best time to plant a tree was 20 years ago. The second best time is now.",
                'author' => "Chinese Proverb",
            ],
            [
                'quote' => "It is during our darkest moments that we must focus to see the light.",
                'author' => "Aristotle",
            ],
            [
                'quote' => "The greatest glory in living lies not in never falling, but in rising every time we fall.",
                'author' => "Nelson Mandela",
            ]
        ];
    }
}
