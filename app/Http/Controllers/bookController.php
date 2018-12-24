<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Theme;
use Session;

class bookController extends Controller
 {

   function __construct(Request $request)
   {
       $this->middleware('auth');
   }
   
   public function index(){
     $books = Book::all();
     $themes = Theme::all();
     return  View('Books.index',['books'=>$books,"themes"=>$themes]);
   }
   public function filter(Request $request){
     $books;
     $filterbooks = null;
     $request->session()->push('oldtheme', $request->theme);
     $themes = Theme::all();
     if ($request->exist == "[on]") {
        $books = Book::where('status', '1')->get();
     }else {
       $books = Book::all();
     }
     if ($request->theme != "All") {
      foreach ($books as  $book) {
        if($book->Theme->description == $request->theme ){
          $filterbooks [] = $book;
        }
      }
     }
     else {
       $filterbooks = $books;
     }
     if ($filterbooks == null) {

        Session::flash('message', 'Doest exist a book with this theme');
        // return Redirect::route('Books.index, $id')->with( ['data' => $data] );
        return  View('Books.index',['books'=>$books,"themes"=>$themes]);
      }
     else {
        return  View('Books.index',['books'=>$filterbooks,"themes"=>$themes]);
     }
   }

   public function create(){
      // \App::setLocale($locale);
     $themes = Theme::all();
     return view('Books.add',['themes'=>$themes]);
   }
   public function store(Request $request){
     $request->validate([
        'title' => 'required|min:1|max:20',
        'author' => 'required',
        'theme' => 'required',
        'description' => 'required|min:5|max:200',
    ]);
     $book = new book();
     $book->title = $request->title;
     $book->author = $request->author;
     $book->theme_id = $request->theme;
     $book->description = $request->description;
     $book->status = '1';
     $book->save();
     $books = Book::all();
     $themes = Theme::all();
     Session::flash('message', 'Added '.$book->title.' with success!');
     return  View('Books.index',['books'=>$books,"themes"=>$themes]);
   }
   public function edit($id){
       // \App::setLocale($locale);
     $book = Book::findorfail($id);
     $themes = Theme::all();
     return view('books/edit',['book'=>$book],['themes'=>$themes]);
   }
   public function update($id,Request $request){
     $request->validate([
        'title' => 'required|min:1|max:20',
        'author' => 'required',
        'theme' => 'required',
        'description' => 'required|min:5|max:200',
    ]);
     $book = Book::findorfail($id);
     $book->title = $request->title;
     $book->author = $request->author;
     $book->theme_id = $request->theme;
     $book->description = $request->description;
     $book->status = '1';
     $book->save();
     // return redirect("/books")->with('message', ' Updated '.$book->title.' with success!');
     $books = Book::all();
     $themes = Theme::all();
     Session::flash('message', 'Added '.$book->title.' with success!');
     return  View('Books.index',['books'=>$books,"themes"=>$themes]);
   }
   public function destroy($id,Request $request){
      $book = Book::findorfail ($request->id_delete);
      $book->delete();
      // return redirect("/books")->with('message', 'delete '.$book->title.' with success!');
      $books = Book::all();
      $themes = Theme::all();
      Session::flash('message', 'Deleted the book '.$book->title.' with success!');
      return  View('Books.index',['books'=>$books,"themes"=>$themes]);
   }
   public function show($id)
   {
     $book = Book::findorfail($id);
     return view('Books.show',["book"=>$book]);
   }
   public function theme(Request $request){
     $theme = new theme();
     $theme->description = $request->description;
     $theme->save();
     // return redirect("/books")->with('message', 'Added the new theme'.$request->descritpion.' with success!');
     $books = Book::all();
     $themes = Theme::all();
     Session::flash('message', 'Added '.$theme->description.' with success!');
     return  View('Books.index',['books'=>$books,"themes"=>$themes]);
   }
   public function generatePDF()
   {
  $books = Book::all();
  if(Session::get('locale')=='en'){
    $output = '<h3 align="center"> Books List </h3>';
    $datenow = new \DateTime();
    $output .= '<p align="right">'.$datenow->format('d/m/Y H:i:s').'</p>';
    $output .= '<p align="right">Total : ('.count($books).') members</p>';

    $output .= '<table  width="100%" style="border-collapse: collapse; border: 0px;"id="customers">
     <tr>
   <th style="border: 1px solid; padding:5px;"align="center" width="">ID</th>
   <th style="border: 1px solid; padding:5px;"align="center" width="">Title</th>
   <th style="border: 1px solid; padding:2px;"align="center" width="">Author</th
   <th style="border: 1px solid; padding:2px;"align="center" width="">Price</th>
   <th style="border: 1px solid; padding:2px;"align="center" width="">Theme</th>
   <th style="border: 1px solid; padding:5px;"align="center" width="">Status</th>
  </tr>
    ';
    foreach($books as $book)
    {
     $output .= '
     <tr>
      <td style="border: 1px solid; padding:5px;"align="center">'.$book->id.'</td>
      <td style="border: 1px solid; padding:5px;"align="center">'.$book->title .'</td>
      <td style="border: 1px solid; padding:5px;"align="center">'.$book->author.'</td>
      <td style="border: 1px solid; padding:5px;"align="center">'.$book->price.' $</td>
      <td style="border: 1px solid; padding:5px;"align="center">'.$book->theme->description.'</td>';
      if($book->status == 1)  $output .='<td style="border: 1px solid; padding:12px;"align="center"><p style="background-color:green;">Existe</p></td>';
      else $output .='<td style="border: 1px solid; padding:12px;"align="center"><p style="background-color:red;">NOT  EXIST</p></td>
     </tr>
     ';
  }


  }
  else {
    $output = '<h3 align="center">  Liste de Livre </h3>';
    $datenow = new \DateTime();
    $output .= '<p align="right">'.$datenow->format('d/m/Y H:i:s').'</p>';
    $output .= '<p align="right">Totale : ('.count($books).') membres</p>';

    $output .= '<table  width="100%" style="border-collapse: collapse; border: 0px;"id="customers">
     <tr>
   <th style="border: 1px solid; padding:5px;"align="center" width="">ID</th>
   <th style="border: 1px solid; padding:5px;"align="center" width="">Titre</th>
   <th style="border: 1px solid; padding:2px;"align="center" width="">Auteur</th
   <th style="border: 1px solid; padding:2px;"align="center" width="">Prix</th>
   <th style="border: 1px solid; padding:2px;"align="center" width="">Thème</th>
   <th style="border: 1px solid; padding:5px;"align="center" width="">Statut</th>
  </tr>
    ';
    foreach($books as $book)
    {
     $output .= '
     <tr>
      <td style="border: 1px solid; padding:5px;"align="center">'.$book->id.'</td>
      <td style="border: 1px solid; padding:5px;"align="center">'.$book->title .'</td>
      <td style="border: 1px solid; padding:5px;"align="center">'.$book->author.'</td>
      <td style="border: 1px solid; padding:5px;"align="center">'.$book->price.' $</td>
      <td style="border: 1px solid; padding:5px;"align="center">'.$book->theme->description.'</td>';
      if($book->status == 1)  $output .='<td style="border: 1px solid; padding:12px;"align="center"><p style="background-color:green;">Existe</p></td>';
      else $output .='<td style="border: 1px solid; padding:12px;"align="center"><p style="background-color:red;">NOT  EXIST</p></td>
     </tr>
     ';
  }
  }

  $output .= '</table>';
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($output);
      return $pdf->stream();
      // $books = Book::all();
      // $themes = Theme::all();
      // $pdf = \PDF::loadView('Books.index', ["books"=>$books,"themes"=>$themes]);
      // return $pdf->download('itsolutionstuff.pdf');
   }
}
