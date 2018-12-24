<?php

namespace App\Http\Controllers;
use App\Mail\sendMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Member;
use Mail;
use session;
use PDF;
use DateTime;
use Intervention\Image\ImageManagerStatic as Image;


class membersController extends Controller
{

  function __construct(Request $request)
  {
      $this->middleware('auth');
  }
   public function index(){
     uniqid();
     $members = Member::all();
     return view ("Members.index",["members"=>$members]);
   }
     public function create(){
       return view("Members.add");
     }
     public function store(Request $request){

       $request->validate([
          'firstname' => 'required|min:1|max:18|regex:/^[a-zA-Z]+$/u',
          'lastname' => 'required|min:1|max:18|regex:/^[a-zA-Z]+$/u',
          'birthdate' => 'required|date|before:tomorrow',
          'cin' => 'required',
          'phonenumber' => 'required|numeric',
          'email' => 'sometimes|required|email',
          'picture' => 'required',
      ]);

       $member = new member();
       // $id = hexdec(uniqid());
       // return $id;
       // $member->id = $id;
       $member->firstname = $request->firstname;
       $member->lastname = $request->lastname;
       $member->cin = $request->cin;
       $member->phonenumber = $request->phonenumber;
       $member->birthdate = $request->birthdate;
       $member->email = $request->email;
       $member->adress = $request->adress;
       $member->deposit = $request->deposit;
       $path ="";
       $PATHName = "";
       if ($request->picture != "") {


         $file = $request->file('picture');
         //seize
        // $file = Image::make($image->getRealPath());
         //$file->resize(300, 300);

         $fileWithExt = $request->file('picture')->getClientOriginalName();
         $path= $file->move('storage/uploads',time().'_'.$file->getClientOriginalName());
         $fileExtension = $request->file('picture')->getClientOriginalExtension();
         $PATHName = pathinfo($path);

        }
        else{
           return "hello.png";
         }

         $member->picture  = $PATHName['dirname'].'/'.$PATHName['basename'];
         $member->save();
         // return Redirect('members')->with('message', 'success Image Upload successfully');
         $members = Member::all();
         Session::flash('message', 'Added '.$member->firstname.' '.$member->lastname.' with success!');
         return  View('Members.index',['members'=>$members]);
     }
     public function edit($id){
       // return $id;
       $member =  Member::find($id);
       return view("Members.edit",["member"=>$member]);
     }
     public function update(Request $request,$id){
       $member = Member::findorfail($id);
       $request->validate([
          'firstname' => 'required|min:1|max:18|regex:/^[a-zA-Z]+$/u',
          'lastname' => 'required|min:1|max:18|regex:/^[a-zA-Z]+$/u',
          'birthdate' => 'required|date|before:tomorrow',
          'cin' => 'required',
          'phonenumber' => 'required|numeric',
          'email' => 'sometimes|required|email',
          'picture' => 'required',
      ]);

       $member->firstname = $request->firstname;
       $member->lastname = $request->lastname;
       $member->cin = $request->cin;
       $member->phonenumber = $request->phonenumber;
       $member->birthdate = $request->birthdate;
       $member->email = $request->email;
       $member->adress = $request->adress;
       $member->deposit = $request->deposit;
       $path ="";
       $PATHName = "";
       if ($request->picture != "") {


         $file = $request->file('picture');

         $fileWithExt = $request->file('picture')->getClientOriginalName();
         $path= $file->move('storage/uploads',time().'_'.$file->getClientOriginalName());
         $fileExtension = $request->file('picture')->getClientOriginalExtension();
         $PATHName = pathinfo($path);

        }
        else{
           return "hello.png";
         }

         $member->picture  = $PATHName['dirname'].'/'.$PATHName['basename'];
         $member->save();

         // return Redirect('members')->with('message', 'success Image Upload successfully');
         $members = Member::all();

         // Session::flash('message', 'Updated with succes !');
         // Session::get('variableName');
         // Session::get('message');
         // return Redirect::to("members")->with("members",$members);
         // return view('Members.index',["members"=>$members]);
         $members = Member::all();
         Session::flash('message', 'Updated '.ucfirst($member->lastname).' '.$member->firstname.' with success!');
         return  View('Members.index',['members'=>$members]);

     }
     public function show($id)
     {
       $member = Member::findorfail($id);
       return view('Members.show',["member"=>$member]);
     }
     public function destroy($id,Request $request){
       $member = Member::findorfail($request->iddelete);
       $member->delete();
       // return Redirect('members')->with('message', 'Delete successfully');
       $members = Member::all();
       Session::flash('message', 'Deleted '.$member->firstname.' '.$member->lastname.' with success!');
       return  View('Members.index',['members'=>$members]);
     }
     public function sendMail()
          {
            $id =1;
            $member = Member::findorfail($id);
            $data = array('name' => $member->firstname,
            'message' => "hello",
            'email' => 'anasslam69@gmail.com',
          );
            Mail::to('anasslam69@gmail.com')->send(new sendMail($data));
            return Redirect('members')->with('message', 'email send  successfully');
          }
     public function generatePDF()
     {
       // $members = Member::all();
       // $pdf = PDF::loadView('Generate_pdf.members', ["members"=>$members]);
       // return $pdf->download('itsolutionstuff.pdf');
       $members = Member::all();
    if(Session::get('locale')=='fr'){
      $output = '<h2 align="center">  Liste de membres </h2>';
      $datenow = new DateTime();

      $output .= '<p align="right">'.$datenow->format('d/m/Y H:i:s').'</p>';
      $output .= '<p align="right">Totale : ('.count($members).') membres </p>';
      $output .= '<table  width="100%" style="border-collapse: collapse; border: 0px;">
       <tr>
     <th style="border: 1px solid; padding:5px;"align="center" width="">ID</th>
     <th style="border: 1px solid; padding:5px;" width="">Image</th>
     <th style="border: 1px solid; padding:5px;"align="center" width="">Nom complet</th>
     <th style="border: 1px solid; padding:2px;"align="center" width="">Date de naissance</th>
     <th style="border: 1px solid; padding:5px;"align="center" width="">Email</th>
     <th style="border: 1px solid; padding:5px;"align="center" width="">Numéro de Téléphone</th>
     <th style="border: 1px solid; padding:5px;"align="center" width="">Caution</th>
    </tr>
      ';
      foreach($members as $member)
      {
       $output .= '
       <tr>
       <td style="border: 1px solid; padding:5px;"align="center">'.$member->id.'</td>
       <td style="border: 1px solid; padding:5px;"><img src="'.$member->picture.'" alt="" style= "height: 100px; width: 80px;" /></td>
        <td style="border: 1px solid; padding:5px;"align="center">'.ucfirst($member->lastname).' '.$member->firstname.'</td>
        <td style="border: 1px solid; padding:5px;"align="center">'.date('d-m-Y', strtotime($member->birthdate)).'</td>
        <td style="border: 1px solid; padding:5px;"align="center">'.$member->email.'</td>
        <td style="border: 1px solid; padding:5px;"align="center">'.$member->phonenumber.'</td>';
        if($member->deposit == 1)  $output .='<td style="border: 1px solid; padding:12px;"align="center"><p style="background-color:green;">OUI</p></td>';
        else $output .='<td style="border: 1px solid; padding:12px;"align="center" ><p style="background-color:red;">NO</p></td>
       </tr>
       ';
    }


    }
    else {
      $output = '<h2 align="center"> Members List </h2>';
      $datenow = new DateTime();

      $output .= '<p align="right">'.$datenow->format('d/m/Y H:i:s').'</p>';
      $output .= '<p align="right">Total : ('.count($members).') members</p>';
      $output .= '<table  width="100%" style="border-collapse: collapse; border: 0px;">
       <tr>
     <th style="border: 1px solid; padding:5px;"align="center" width="">ID</th>
     <th style="border: 1px solid; padding:5px;" width="">Picture</th>
     <th style="border: 1px solid; padding:5px;"align="center" width="">Full name</th>
     <th style="border: 1px solid; padding:2px;"align="center" width="">Birthdate</th>
     <th style="border: 1px solid; padding:5px;"align="center" width="">Email</th>
     <th style="border: 1px solid; padding:5px;"align="center" width="">Phone number</th>
     <th style="border: 1px solid; padding:5px;"align="center" width="">Deposite</th>
    </tr>
      ';
      foreach($members as $member)
      {
       $output .= '
       <tr>
        <td style="border: 1px solid; padding:5px;"align="center">'.$member->id.'</td>
        <td style="border: 1px solid; padding:5px;"><img src="'.$member->picture.'" alt="" style= "height: 100px; width: 80px;" /></td>
        <td style="border: 1px solid; padding:5px;"align="center">'.$member->firstname .' '. $member->lastname.'</td>
        <td style="border: 1px solid; padding:5px;"align="center">'.date('d-m-Y', strtotime($member->birthdate)).'</td>
        <td style="border: 1px solid; padding:5px;"align="center">'.$member->email.'</td>
        <td style="border: 1px solid; padding:5px;"align="center">'.$member->phonenumber.'</td>';
        if($member->deposit == 1)  $output .='<td style="border: 1px solid; padding:12px;"align="center"><p style="background-color:green;">YES</p></td>';
        else $output .='<td style="border: 1px solid; padding:12px;"align="center" ><p style="background-color:red;">NOT</p></td>
       </tr>
       ';
    }


    }
        $output .= '</table>';
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($output);
        return $pdf->stream();
        // <th style="border: 1px solid; padding:5px;" width="">Picture</th>
        // <td style="border: 1px solid; padding:5px;"><img src="{{asset('.$member->picture.')}}" alt="" /></td>


     }
     public function generatePDF_Member($id)
     {
       $member = Member::findorfail($id);
       $d ="";
       if ($member->deposit==0) {
         $d = "No";
       }
       else {
         $d = "Yes";
       }
       if(Session::get('locale')=='en'){
         $output =  "<h2 style=''align='center'>Registration receipt</h2>";
         $output .= '<img src="'.$member->picture.'" alt="" style= "height: 100px; width: 80px;margin-left:11%" />';
         $output .= "<table style='width:125%;margin-left:60%'>
          <tr >
          <td style='font-size:19.5px;padding-top:1%;'>First name :</td>
          <td style='font-size:19.5px;padding-top:1%;'>".ucfirst($member->firstname)."</td>
          </tr>
          <tr>
          </tr>
          <tr>
          <td style='font-size:19.5px;padding-top:1%;'>Last name :</td>
          <td style='font-size:19.5px;padding-top:1%;'>".ucfirst($member->lastname)."</td>
          </tr>
          <tr>
          <td style='font-size:19.5px;padding-top:1%;'>Birthdate :</td>
          <td style='font-size:19.5px;padding-top:1%;'>".date('d-m-Y', strtotime($member->birthdate))."</td>
          </tr>
          <tr>
          <td style='font-size:19.5px;padding-top:1%;'>CIN :</td>
          <td style='font-size:19.5px;padding-top:1%;'>".$member->cin."</td>
          </tr>
          <tr>
          <td style='font-size:19.5px;padding-top:1%;'>Adresse :</td>
          <td style='font-size:19.5px;padding-top:1%;'>".ucfirst($member->adress)."</td>
          </tr>
          <tr>
          <td style='font-size:19.5px;padding-top:1%;'>Email :</td>
          <td style='font-size:19.5px;padding-top:1%;'>".ucfirst($member->email)."</td>
          </tr>
          <tr>
          <td style='font-size:19.5px;padding-top:1%;'>Phone number :</td>
          <td style='font-size:19.5px;padding-top:1%;'>".$member->phonenumber."</td>
          </tr>
          <tr>
          <td style='font-size:19.5px;padding-top:1%;'>Deposit :</td>
          <td style='font-size:18px;padding-top:1%;'>".ucfirst($d)."</td>
          </tr>
          <tr>
          <td style='font-size:19.5px;padding-top:1%;'>Registration date  :</td>
          <td style='font-size:18px;padding-top:1%;'>".date('d-m-Y', strtotime($member->created_at))."</td>
          </tr>
      </table>";
       }
       else {
           $output =  "<h2 style=''align='center'>Reçu d'inscription </h2>";
           $output .= '<img src="'.$member->picture.'" alt="" style= "height: 100px; width: 80px;margin-left:11%" />';
           $output .= "<table style='width:125%;margin-left:60%'>
           <tr>
           <td style='font-size:19.5px;padding-top:1%;'>Nom :</td>
           <td style='font-size:19.5px;padding-top:1%;'>".ucfirst($member->lastname)."</td>
           </tr>
            <tr >
            <td style='font-size:19.5px;padding-top:1%;'>Prénom :</td>
            <td style='font-size:19.5px;padding-top:11;'>".ucfirst($member->firstname)."</td>
            </tr>

            <tr>
            <td style='font-size:19.5px;padding-top:1%;'>Date de naissance  :</td>
            <td style='font-size:19.5px;padding-top:1%;'>".date('d-m-Y', strtotime($member->birthdate))."</td>
            </tr>
            <tr>
            <td style='font-size:19.5px;padding-top:1%;'>CIN :</td>
            <td style='font-size:19.5px;padding-top:1%;'>".$member->cin."</td>
            </tr>
            <tr>
            <td style='font-size:19.5px;padding-top:1%;'>Adresse :</td>
            <td style='font-size:19.5px;padding-top:1%;'>".ucfirst($member->adress)."</td>
            </tr>
            <tr>
            <td style='font-size:19.5px;padding-top:1%;'>Email :</td>
            <td style='font-size:19.5px;padding-top:1%;'>".ucfirst($member->email)."</td>
            </tr>
            <tr>
            <td style='font-size:19.5px;padding-top:1%;'>Numéro de Téléphone :</td>
            <td style='font-size:19.5px;padding-top:1%;'>".$member->phonenumber."</td>
            </tr>
            <tr>
            <td style='font-size:19.5px;padding-top:1%;'>Caution :</td>
            <td style='font-size:18px;padding-top:1%;'>".ucfirst($d)."</td>
            </tr>
            <tr>
            <td style='font-size:19.5px;padding-top:1%;'>Date d'inscription  :</td>
            <td style='font-size:18px;padding-top:1%;'>".date('d-m-Y', strtotime($member->created_at))."</td>
            </tr>
        </table>";

       }

       $pdf = \App::make('dompdf.wrapper');
       $pdf->loadHTML($output);
       return $pdf->stream();
     }


}
