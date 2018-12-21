<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table id="booksTable" class="table table-striped" >
       <thead>
          <th> {{__('messages.MemberID')}} </th>
          <th id="picture"> {{__('messages.MemberImage')}} </th>
          <th> {{__('messages.MemberName')}}  </th>
          <!-- <th id="author">Birthdate</th> -->
          <th id="cin">{{__('messages.MemberCIN')}} </th>
          <th> {{__('messages.MemberPhonenumber')}} </th>
          <th id="email">{{__('messages.MemberDeposit')}} </th>
       </thead>
       @foreach($members as $member)
        <tr>
          <td>{{$member->id}}</td>
          <td> <img src="{{asset($member->picture)}}" style= "height: 100px; width: 80px;"></td>
          <td id="">{{$member->firstname}} {{$member->lastname}}</td>
          <!-- <td id="author">{{$member->birthdate}}</td> -->
          <td id="cin">{{$member->cin}}</td>
          <td id="">{{$member->phonenumber}}</td>
          <td id="email">
             @if($member->deposit)
             <span class="badge badge-success">Yes</span>

             @else
             <span class="badge badge-danger">No</span>
             @endif
           </td>
       </tr>
       @endforeach
    </table>

  </body>
</html>
