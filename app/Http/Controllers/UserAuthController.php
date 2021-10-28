<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Appointment;
use App\Models\User;
use App\Models\FreelancerCategory;
use App\Models\Freelancer;
use App\Models\FreelancerCalendar;
use App\Models\FreelancerRegion;
use App\Models\FreelancerRegionPivot;
use App\Models\rating;
use App\Models\Connection;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register','freelancerregister']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'phone' => 'required|integer|digits:8',
            'user_type' => 'required|integer|between:0,1',
            'firebase_token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                "status" => false,
                "errors" => $validator->errors()
            ), 400);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->user_type = $request->user_type;
        $user->firebase_token = $request->firebase_token;
        $user->image = "http://3.15.143.135/storage/mytnk4gxibti4Y0bPxdufDQDKJJB96CapkvUsSH6.jpg";
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }
    public function freelancerregister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'phone' => 'required|integer|digits:8',
            'user_type' => 'required|integer|between:0,1',
            'hourly_price' => 'required|integer|min:1|max:200',
            'category' => 'required',
            'region' => 'required',
            'firebase_token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                "status" => false,
                "errors" => $validator->errors()
            ), 400);
        }



        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->user_type = $request->user_type;
        $user->firebase_token = $request->firebase_token;
        $user->image = "http://3.15.143.135/storage/mytnk4gxibti4Y0bPxdufDQDKJJB96CapkvUsSH6.jpg";
        $user->save();

        $user_id = User::where('email',$request->email)->get('id');
        $user_id = $user_id[0]->id;
        $category_id = FreelancerCategory::where('category',$request->category)->get('id');
        $category_id = $category_id[0]->id;

        $freelancer_standard_info = new freelancer;
        $freelancer_standard_info->user_id = $user_id;
        $freelancer_standard_info->hourly_price = $request->hourly_price;
        $freelancer_standard_info->category_id = $category_id;
        $freelancer_standard_info->save();

        $region_id = FreelancerRegion::where("region",$request->region)->get('id');
        $region_id = $region_id[0]->id;

        $region = new FreelancerRegionPivot;
        $region->region_id = $region_id;
        $region->user_id = $user_id;
        $region->save();



        return response()->json([
            'status' => true,
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }



    public function userProfile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function GetFreelancers(Request $request){
        $category = $request->category;
        $region = $request->region;
        $date = $request->date;

        $category_id = FreelancerCategory::where('category',$category)->get();
        $category_id = $category_id[0]->id;

        $region_id = FreelancerRegion::where('region',$region)->get();
        $region_id = $region_id[0]->id;

        $freelancers_with_category = Freelancer::where('category_id',$category_id)->get(['hourly_price','user_id','category_id']);

        $freelancers_with_region = FreelancerRegionPivot::where('region_id',$region_id)->get(['region_id','user_id']);

        /// getting available freelancers with the needed category
        $freelancers_available= array();
        for($i = 0; $i < count($freelancers_with_category); $i++){
            $id = $freelancers_with_category[$i]->user_id;
            $freelancers_available_results= FreelancerCalendar::where('user_id',$id)
                                            ->where('date_of_day', $date)
                                            ->where('availability', '0')///0-> available
                                            ->get("user_id");
            if(count($freelancers_available_results) > 0){
                array_push($freelancers_available, $freelancers_available_results);
            }
        }

        /// filtering available freelancers on bases of region
        $id_results = array();
        for($i = 0; $i < count($freelancers_available); $i++){
            for($j = 0; $j < count($freelancers_with_region); $j++){
                if($freelancers_available[$i][0]->user_id == $freelancers_with_region[$j]->user_id){
                    array_push($id_results,$freelancers_available[$i][0]->user_id);
                }
            }
        }


        $ratings = array();
        $result = array();
        for($i = 0; $i < count($id_results); $i++){
            $result[$i][0] = User::find($id_results[$i]);
            $ratings[$i] = User::find($id_results[$i])->userRating;
        }

        // getting the price per hour
        $price_per_hour = array();
        for($i = 0; $i < count($result); $i++){
            $price_per_hour = Freelancer::where('id',$result[$i][0]->id)->get('hourly_price');
            array_push($result[$i], $price_per_hour[0]);
        }

        // returning rating in form of total rate  and how many rated
        for($i = 0; $i < count($ratings); $i++){
            $variable = 0;
            for($j = 0; $j < count($ratings[$i]); $j++){
                $variable += $ratings[$i][$j]->ratings;
            }
            $ratings[$i]['number_of_raters'] = count($ratings[$i]);
            $ratings[$i]['rating'] = $variable/count($ratings[$i]);

        }

        for($i = 0; $i < count($result); $i++){
            $result[$i][2] = $ratings[$i];
        }




        return json_encode($result,JSON_PRETTY_PRINT);
    }


    public function PickAppointment(Request $request){
        $user_id =auth()->user()->id;
        $longitude = $request->longitude;
        $latitude = $request->latitude;
        $date = $request->date;
        $description = $request->description;
        $freelancer_id = $request->freelancer_id;


        $calendar_id = FreelancerCalendar::where('date_of_day',$date)
                                            ->where('user_id',$freelancer_id)
                                            ->where('availability',0)->get('id');

        $calendar_id = $calendar_id[0]->id;

        $count_of_appointments = Appointment::where('calendar_id',$calendar_id)->get('id');
        $count_of_appointments = count($count_of_appointments);

        if($count_of_appointments == 5){
            $calender_availability = FreelancerCalendar::find($calendar_id);
            $calender_availability->availability = 1;
            $calender_availability->save();

        }
        $appointment = new Appointment();
        $appointment->calendar_id = $calendar_id;
        $appointment->user_id = $user_id;
        $appointment->longitude = $longitude;
        $appointment->latitude = $latitude;
        $appointment->description = $description;
        $appointment->status = 0;
        $appointment->save();

        $existingConnection = Connection::where("user1",$user_id) ->where("user2",$freelancer_id)->get();
        if(count($existingConnection)>0){
            return response()->json([
                'status' => true,
                'message' => 'User successfully reserved an appointment with someone thhey worked with before',
                'appointment'=>$appointment
            ], 201);
        }

        $connections1 = new Connection;
        $connections1->user1 = $user_id;
        $connections1->user2 = $freelancer_id;
        $connections1->save();

        $connections2 = new Connection;
        $connections2->user1 = $freelancer_id;
        $connections2->user2 = $user_id;
        $connections2->save();


        return response()->json([
            'status' => true,
            'message' => 'User successfully reserved an appointment',
            'appointment'=>$appointment
        ], 201);

    }

    // public function chat(){}


    public function EditName(Request $request){
        $user_id =auth()->user()->id;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
        ]);
        if ($validator->fails()) {
            return response()->json(array(
                "status" => false,
                "errors" => $validator->errors()
            ), 400);
        }

        $name = $request->name;

        $user = User::find($user_id);
        $user->name = $name;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User successfully Edited Name',
            'user' => $user
        ], 201);

    }

    public function EditPhone(Request $request){
        $user_id =auth()->user()->id;

        $validator = Validator::make($request->all(), [
            'phone' => 'required|integer|digits:8',
        ]);
        if ($validator->fails()) {
            return response()->json(array(
                "status" => false,
                "errors" => $validator->errors()
            ), 400);
        }

        $phone = $request->phone;

        $user = User::find($user_id);
        $user->phone = $phone;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User successfully Edited Phone Number',
            'user' => $user
        ], 201);
    }

    public function EditPassword(Request $request){
        $user_id =auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(array(
                "status" => false,
                "errors" => $validator->errors()
            ), 400);
        }

        $user = User::find($user_id);
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User successfully Edited Password',
            'user' => $user
        ], 201);
    }

    public function EditImage(Request $request){
        $user_id =auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'image' =>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(array(
                "status" => false,
                "errors" => $validator->errors()
            ), 400);
        }

        $picture_url = $request->file("image")->store('/public');
        $res = str_replace('public/', '', $picture_url);

        $user = User::find($user_id);
        $user->image = 'http://3.15.143.135/storage/'.$res;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User successfully Edited Image',
            'user' => $user
        ], 201);
    }

    public function ViewPastOrders(){
        $user_id =auth()->user()->id;

        $appointments = Appointment::where('user_id',$user_id)
                                    ->where('status',1)
                                    ->get('calendar_id');

        $user_id_result = array();
        for($i=0;$i<count($appointments);$i++){
            $test=FreelancerCalendar::where('id',$appointments[$i]->calendar_id)->get('user_id');
            array_push($user_id_result, $test[0]);
        }

        $filtered = array();
        for($i=0;$i<count($user_id_result);$i++){
            if(!in_array ( $user_id_result[$i]->user_id,$filtered )){
                array_push($filtered, $user_id_result[$i]->user_id);
            }
        }

        $result = array();
        for($i=0;$i<count($filtered);$i++){
            $test=User::where('id',$filtered[$i])->get();
            array_push($result, $test[0]);
        }



        return json_encode($result,JSON_PRETTY_PRINT);
    }

    public function GetRegions(){
        $Regions = FreelancerRegion::get();
        return json_encode($Regions,JSON_PRETTY_PRINT);
    }

    public function GetCategories(){
        $categories = FreelancerCategory::get();
        return json_encode($categories,JSON_PRETTY_PRINT);
    }

    public function RateFreelancer(Request $request){
        $user_id =auth()->user()->id;
        $rated_user_id = $request->rated_user;
        $rate = $request->rate;

        $findrate = rating::where('user_rating',$user_id)->where('rated_user',$rated_user_id)->get();
        if(count($findrate)== 0){
            $rating = new rating();
            $rating->user_rating=$user_id;
            $rating->rated_user=$rated_user_id;
            $rating->ratings=$rate;
            $rating->save();
            return response()->json([
                'status' => true,
                'message' => 'User successfully rated freelancer',
                'rating' => $rating
            ], 201);
        }
        $findrate = $findrate[0]->id;


        $editrate = rating::find($findrate);
        $editrate->ratings = $rate;
        $editrate->save();


        return response()->json([
            'status' => true,
            'message' => 'User successfully edited rated freelancer',
            'rating' => $editrate
        ], 201);


    }


    ////Freelancer APIs
    public function ViewAppointments(Request $request){
        $user_id =auth()->user()->id;
        $date = $request->date;

        $calendar_id = FreelancerCalendar::where('user_id',$user_id)
                                        ->where('date_of_day',$date)
                                        ->get('id');

        $appointments = Appointment::where('calendar_id',$calendar_id[0]->id)->where('status',0)->get();

        for($i=0;$i<count($appointments);$i++){
            $test=User::where('id',$appointments[$i]->user_id)->get();
            $appointments[$i]['user'] =  $test[0];
        }
        return json_encode($appointments,JSON_PRETTY_PRINT);
    }

    public function GetDates(){
        $user_id =auth()->user()->id;
        $dates = FreelancerCalendar::where('user_id',$user_id)
                                        ->get();

        return json_encode($dates,JSON_PRETTY_PRINT);
    }

    public function GetDoneJobs(){
        $user_id =auth()->user()->id;
        $dates = FreelancerCalendar::where('user_id',$user_id)
                                        ->get();

        return json_encode($dates,JSON_PRETTY_PRINT);
    }

    public function AddToCalendar(Request $request){
        $user_id =auth()->user()->id;
        $date = $request->date;
        $datecheck = FreelancerCalendar::where('user_id',$user_id)
                                        ->where('date_of_day',$date)
                                        ->get();
        if (count($datecheck)== 0){
        $addCalendar = new FreelancerCalendar;
        $addCalendar->user_id = $user_id;
        $addCalendar->date_of_day = $date;
        $addCalendar->availability = 0;
        $addCalendar->save();
        return response()->json([
            'status' => true,
            'message' => 'User successfully Added To Calendar',
        ], 201);
        }

        return response()->json(array(
            "status" => false,
            "errors" => "Date Already exist"
        ), 400);

    }

    //regions
    public function GetMyRegions(){
        $user_id =auth()->user()->id;
        $Regions = FreelancerRegionPivot::where('user_id',$user_id)
                                        ->get();

        for($i = 0; $i < count($Regions); $i++){
            $region_id = $Regions[$i]->region_id;
            $Region_name = FreelancerRegion::where('id',$region_id)
                                        ->get('region');
            $Regions[$i][1]=$Region_name;
        }

        return json_encode($Regions,JSON_PRETTY_PRINT);
    }

    public function AddRegion(Request $request){
        $user_id =auth()->user()->id;
        $region = $request->region;
        $region_id =FreelancerRegion::where('region',$region)->get('id');
        $region_id = $region_id[0]->id;


        $regioncheck = FreelancerRegionPivot::where('region_id',$region_id)
                                            ->where('user_id',$user_id)->get();

        if (count($regioncheck)== 0){
            $addreegion = new FreelancerRegionPivot;
            $addreegion->user_id = $user_id;
            $addreegion->region_id = $region_id;
            $addreegion->save();
            return response()->json([
                'status' => true,
                'message' => 'User successfully Added region',
            ], 201);
            }

            return response()->json(array(
                "status" => false,
                "errors" => "region Already exist"
            ), 400);
    }

    public function RemoveRegion(Request $request){
        $user_id =auth()->user()->id;
        $region = $request->region;
        $region_id =FreelancerRegion::where('region',$region)->get('id');
        $region_id = $region_id[0]->id;


        $addreegion = FreelancerRegionPivot::where('user_id',$user_id)->where('region_id',$region_id);
        $addreegion->delete();

        return response()->json([
            'status' => true,
            'message' => 'User successfully Removed region',
        ], 201);
    }

    public function EditPrice(Request $request){
        $user_id =auth()->user()->id;

        $validator = Validator::make($request->all(), [
            'hourly_price' => 'required|integer|min:1|max:200',
        ]);
        if ($validator->fails()) {
            return response()->json(array(
                "status" => false,
                "errors" => $validator->errors()
            ), 400);
        }

        $hourly_price = $request->hourly_price;
        $Freelancer_table_id = Freelancer::where('user_id',$user_id)->get('id');
        $Freelancer_table_id = $Freelancer_table_id[0]->id;


        $user = Freelancer::find($Freelancer_table_id);
        $user->hourly_price = $hourly_price;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User successfully Edited Hourly Price',
            'user' => $user
        ], 201);

    }

    public function EditCategory(Request $request){
        $user_id =auth()->user()->id;

        $validator = Validator::make($request->all(), [
            'category' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(array(
                "status" => false,
                "errors" => $validator->errors()
            ), 400);
        }

        $category = $request->category;

        $Freelancer_table_id = Freelancer::where('user_id',$user_id)->get('id');
        $Freelancer_table_id = $Freelancer_table_id[0]->id;

        $category_id = FreelancerCategory::where('category',$request->category)->get('id');
        $category_id = $category_id[0]->id;


        $user = Freelancer::find($Freelancer_table_id);
        $user->category_id = $category_id;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User successfully Edited category',
            'user' => $user
        ], 201);
    }

    public function EditAppointmentStatus(Request $request){
        $appointment_id = $request->appointment_id ;

        $appointment = Appointment::find($appointment_id);
        $appointment->status = 1;
        $appointment->save();

        return response()->json([
            'status' => true,
            'message' => 'User successfully Edited category',
            'user' => $appointment
        ], 201);
    }

    public function SendMessage(Request $request){
        $user_id =auth()->user()->id;
        $receiver_id =$request->receiver_id;
        $message_sent = $request->message ;

        $message = new Message;
        $message->sender_id = $user_id;
        $message->receiver_id = $receiver_id;
        $message->message = $message_sent;
        $message->save();

        return response()->json([
            'status' => true,
            'message' => 'User successfully sent message',
            'message_sent' => $message
        ], 201);
    }

    public function GetConnections(){
        $user_id =auth()->user()->id;

        $users = Connection::where('user1',$user_id)->get('user2');

        $result = array();
        for($i=0;$i<count($users);$i++){
            $test=User::where('id',$users[$i]->user2)->get();
            array_push($result, $test[0]);
        }



        return response()->json([
            'status' => true,
            'message' => 'User successfully sent message',
            'connections' => $result
        ], 201);
    }

    public function GetMessages(){
        $user_id =auth()->user()->id;

        $messages = Message::where('receiver_id',$user_id)->get();



        $result = array();
        for($i=0;$i<count($messages);$i++){
            $test=User::where('id',$messages[$i]->sender_id)->get();
            $result[$i]['message']= $messages[$i];
            $result[$i]['user'] = $test[0];
        }

        return json_encode($result,JSON_PRETTY_PRINT);
    }

    public function GetChat(Request $request){
        $user_id =auth()->user()->id;
        $otheruser = $request->otheruser;

        $messages = DB::select('Select * from messages where (receiver_id = ? and sender_id = ?) or
                                 (receiver_id = ? and sender_id = ?)',[$user_id,$otheruser,$otheruser,$user_id]);

        return json_encode($messages,JSON_PRETTY_PRINT);

    }
    public function EditRegion(Request $request){
        $user_id =auth()->user()->id;
        $region = $request->region;
        $region_id = FreelancerRegion::where("region",$request->region)->get('id');
        $region_id = $region_id[0]->id;



        $region = FreelancerRegionPivot::where("user_id",$user_id)->get('id');
        $region = $region[0]->id;


        $regionedit = FreelancerRegionPivot::find($region);
        $regionedit->region_id = $region_id;
        $regionedit->user_id = $user_id;
        $regionedit->save();

        return json_encode($regionedit,JSON_PRETTY_PRINT);




    }
    public function freelancerProfile(){
        $user_id =auth()->user()->id;
        $Regions = FreelancerRegionPivot::where('user_id',$user_id)
                                        ->get('region_id');
        $Region_id = $Regions[0]->region_id;
        $Region = FreelancerRegion::where('id',$Region_id)->get();
        $Region = $Region[0]->region;


        $user = User::where('id',$user_id)->get();
        $category = Freelancer::where('user_id',$user_id)->get();
        $hourly_price = $category[0]->hourly_price;

        $category_id = $category[0]->category_id;
        $category = FreelancerCategory::where('id',$category_id)->get();
        $category = $category[0]->category;

        $result = [$user,$Region,$hourly_price,$category];

        return json_encode($result,JSON_PRETTY_PRINT);
    }

    public function EditImagebase64(Request $request){
        $user_id =auth()->user()->id;

        $image = $request->image;

        $imageName = Str::random(12)."."."jpg";

        //decode and store image
        Storage::disk('public')->put($imageName,base64_decode($image));

        $user = User::find($user_id);
        $user->image = 'http://3.15.143.135/storage/'.$imageName;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User successfully Edited Image',
            'user' => $user
        ], 201);
    }

    public function getfreelancerAppointments(Request $request){
        $freelancer_id= $request->freelancer_id;

        $dates = FreelancerCalendar::where("user_id",$freelancer_id)->get();

        $appointments = array();
        for($i = 0; $i < count($dates); $i++){
            $checkAppointments = Appointment::where("calendar_id",$dates[$i]->id)->where("status",0)->get();
            if(count($checkAppointments)>0){
                array_push($appointments, $checkAppointments);
            }
        }
        $result = array();
        for($i = 0; $i < count($appointments); $i++){
            for($j = 0; $j < count($appointments[$i]); $j++){
                $user_per_appointment = User::where("id",$appointments[$i][$j]->user_id)->get();
                $appointments[$i][$j]["user"] = $user_per_appointment;
                array_push($result, $appointments[$i][$j]);

            }
        }

        for($i = 0; $i < count($result); $i++){
            $date = FreelancerCalendar::where("id",$result[$i]->calendar_id)->get();
            $result[$i]["date"] = $date[0]->date_of_day;
    }

        return json_encode($result,JSON_PRETTY_PRINT);
    }

    public function getallfreelancers(){


        $result = User::where("user_type",1)->get();


        return json_encode($result,JSON_PRETTY_PRINT);
    }

    public function getUserAppointments(){
        $user_id =auth()->user()->id;

        $appointments = Appointment::where("user_id",$user_id)
                                    ->where("status",0)
                                    ->get();

        // $dates = FreelancerCalendar::where("user_id",$freelancer_id)->get();

        for($i = 0; $i < count($appointments); $i++){
            $checkAppointments = FreelancerCalendar::where("id",$appointments[$i]->calendar_id)->get();
            $appointments[$i]["date"] = $checkAppointments[0]->date_of_day;
            $appointments[$i]["freelancer_id"] = $checkAppointments[0]->user_id;
        }

        for($i = 0; $i < count($appointments); $i++){
            $category = Freelancer::where("user_id",$appointments[$i]->freelancer_id)->get();
            $category_name = FreelancerCategory::where("id",$category[0]->category_id)->get();
            $appointments[$i]["category"] = $category_name[0]->category;
        }

        for($i = 0; $i < count($appointments); $i++){
            $freelancer = User::where("id",$appointments[$i]->freelancer_id)->get();
            $appointments[$i]["freelancer"] = $freelancer;
        }




        return json_encode($appointments,JSON_PRETTY_PRINT);
    }





}
