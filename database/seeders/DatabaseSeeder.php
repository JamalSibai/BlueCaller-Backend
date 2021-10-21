<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Seeder;

use App\Models\FreelancerRegion;
use App\Models\FreelancerCategory;
use App\Models\User;
use App\Models\Freelancer;
use App\Models\FreelancerRegionPivot;
use App\Models\FreelancerCalendar;
use App\Models\rating;
use App\Models\Connection;
use App\Models\Message;

// use Illuminate\Database\Connection;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        FreelancerRegion::create([
            "region" => "Akkar",
            ]);
        FreelancerRegion::create([
            "region" => "Baalbeck-Hermel",
            ]);
        FreelancerRegion::create([
            "region" => "Beirut",
            ]);
        FreelancerRegion::create([
            "region" => "Bekaa",
            ]);
        FreelancerRegion::create([
            "region" => "Mount Lebanon",
            ]);
        FreelancerRegion::create([
            "region" => "North Lebanon",
            ]);
        FreelancerRegion::create([
            "region" => "Nabatiyeh",
            ]);
        FreelancerRegion::create([
            "region" => "South Lebanon",
            ]);


        FreelancerCategory::create([
            "category" => "Electricity",
            ]);
        FreelancerCategory::create([
            "category" => "Air Conditioning",
            ]);
        FreelancerCategory::create([
            "category" => "Satellite",
            ]);
        FreelancerCategory::create([
            "category" => "Pluming",
            ]);
        FreelancerCategory::create([
            "category" => "Carpentry",
            ]);
        FreelancerCategory::create([
            "category" => "Welding",
            ]);
        FreelancerCategory::create([
            "category" => "General Constraction",
            ]);
        FreelancerCategory::create([
            "category" => "Car Mechanic",
            ]);
        FreelancerCategory::create([
            "category" => "Car Electricity",
            ]);
        FreelancerCategory::create([
            "category" => "Tires Expert",
            ]);
        FreelancerCategory::create([
            "category" => "Glass and Aluminum",
            ]);
        FreelancerCategory::create([
            "category" => "Elevator Maintenance",
            ]);


        //users
        User::create([
            "name" => "Mark",
            "email"=> "Mark@gmail.com",
            "password"=> bcrypt("password"),
            "phone"=> "70800000",
            "image"=>"http://3.15.143.135/storage/mytnk4gxibti4Y0bPxdufDQDKJJB96CapkvUsSH6.jpg",
            "user_type"=>"0"
            ]);
        User::create([
            "name" => "Mike",
            "email"=> "Mike@gmail.com",
            "password"=> bcrypt("password"),
            "phone"=> "70800001",
            "image"=>"http://3.15.143.135/storage/mytnk4gxibti4Y0bPxdufDQDKJJB96CapkvUsSH6.jpg",
            "user_type"=>"0"
            ]);
        User::create([
            "name" => "Ali",
            "email"=> "Ali@gmail.com",
            "password"=> bcrypt("password"),
            "phone"=> "70800001",
            "image"=>"http://3.15.143.135/storage/mytnk4gxibti4Y0bPxdufDQDKJJB96CapkvUsSH6.jpg",
            "user_type"=>"0"
            ]);
        User::create([
            "name" => "Mohammad",
            "email"=> "Mohammad@gmail.com",
            "password"=> bcrypt("password"),
            "phone"=> "70800001",
            "image"=>"http://3.15.143.135/storage/mytnk4gxibti4Y0bPxdufDQDKJJB96CapkvUsSH6.jpg",
            "user_type"=>"0"
            ]);
        User::create([
            "name" => "Charbel",
            "email"=> "Charbel@gmail.com",
            "password"=> bcrypt("password"),
            "phone"=> "70800001",
            "image"=>"http://3.15.143.135/storage/mytnk4gxibti4Y0bPxdufDQDKJJB96CapkvUsSH6.jpg",
            "user_type"=>"0"
            ]);

        //Freelancers
        User::create([
            "name" => "George",
            "email"=> "George@gmail.com",
            "password"=> bcrypt("password"),
            "phone"=> "70800001",
            "image"=>"http://3.15.143.135/storage/mytnk4gxibti4Y0bPxdufDQDKJJB96CapkvUsSH6.jpg",
            "user_type"=>"1"
            ]);
        User::create([
            "name" => "Fadi",
            "email"=> "Fadi@gmail.com",
            "password"=> bcrypt("password"),
            "phone"=> "70800001",
            "image"=>"http://3.15.143.135/storage/mytnk4gxibti4Y0bPxdufDQDKJJB96CapkvUsSH6.jpg",
            "user_type"=>"1"
            ]);
        User::create([
            "name" => "Karim",
            "email"=> "Karim@gmail.com",
            "password"=> bcrypt("password"),
            "phone"=> "70800001",
            "image"=>"http://3.15.143.135/storage/mytnk4gxibti4Y0bPxdufDQDKJJB96CapkvUsSH6.jpg",
            "user_type"=>"1"
            ]);
        User::create([
            "name" => "Abass",
            "email"=> "Abass@gmail.com",
            "password"=> bcrypt("password"),
            "phone"=> "70800001",
            "image"=>"http://3.15.143.135/storage/mytnk4gxibti4Y0bPxdufDQDKJJB96CapkvUsSH6.jpg",
            "user_type"=>"1"
            ]);
        User::create([
            "name" => "Fadel",
            "email"=> "Fadel@gmail.com",
            "password"=> bcrypt("password"),
            "phone"=> "70800001",
            "image"=>"http://3.15.143.135/storage/mytnk4gxibti4Y0bPxdufDQDKJJB96CapkvUsSH6.jpg",
            "user_type"=>"1"
            ]);
        User::create([
            "name" => "John",
            "email"=> "John@gmail.com",
            "password"=> bcrypt("password"),
            "phone"=> "70800001",
            "image"=>"http://3.15.143.135/storage/mytnk4gxibti4Y0bPxdufDQDKJJB96CapkvUsSH6.jpg",
            "user_type"=>"1"
            ]);
        User::create([
            "name" => "Jad",
            "email"=> "Jad@gmail.com",
            "password"=> bcrypt("password"),
            "phone"=> "70800001",
            "image"=>"http://3.15.143.135/storage/mytnk4gxibti4Y0bPxdufDQDKJJB96CapkvUsSH6.jpg",
            "user_type"=>"1"
            ]);
        User::create([
            "name" => "Joudi",
            "email"=> "Joudi@gmail.com",
            "password"=> bcrypt("password"),
            "phone"=> "70800001",
            "image"=>"http://3.15.143.135/storage/mytnk4gxibti4Y0bPxdufDQDKJJB96CapkvUsSH6.jpg",
            "user_type"=>"1"
            ]);
        User::create([
            "name" => "Jamal",
            "email"=> "jamal@gmail.com",
            "password"=> bcrypt("password"),
            "phone"=> "70800001",
            "image"=>"http://3.15.143.135/storage/mytnk4gxibti4Y0bPxdufDQDKJJB96CapkvUsSH6.jpg",
            "user_type"=>"0",
            "firebase_token"=>"ExponentPushToken[5RBES7Ixh6sgwQpqy1quK3]"
            ]);


        ///Freelancers Info
        Freelancer::create([
            "hourly_price" => "10",
            "category_id"=> "1",
            "user_id"=> "6",
            ]);
        Freelancer::create([
            "hourly_price" => "15",
            "category_id"=> "1",
            "user_id"=> "7",
            ]);
        Freelancer::create([
            "hourly_price" => "13",
            "category_id"=> "1",
            "user_id"=> "8",
            ]);
        Freelancer::create([
            "hourly_price" => "25",
            "category_id"=> "1",
            "user_id"=> "9",
            ]);
        Freelancer::create([
            "hourly_price" => "9",
            "category_id"=> "4",
            "user_id"=> "10",
            ]);
        Freelancer::create([
            "hourly_price" => "10",
            "category_id"=> "4",
            "user_id"=> "11",
            ]);
        Freelancer::create([
            "hourly_price" => "15",
            "category_id"=> "4",
            "user_id"=> "12",
            ]);
        Freelancer::create([
            "hourly_price" => "14",
            "category_id"=> "4",
            "user_id"=> "13",
            ]);

        ///regions
        FreelancerRegionPivot::create([
            "region_id" => "3",
            "user_id"=> "6"
            ]);

        FreelancerRegionPivot::create([
            "region_id" => "3",
            "user_id"=> "7"
            ]);

        FreelancerRegionPivot::create([
            "region_id" => "3",
            "user_id"=> "8"
            ]);

        FreelancerRegionPivot::create([
            "region_id" => "5",
            "user_id"=> "9"
            ]);

        FreelancerRegionPivot::create([
            "region_id" => "1",
            "user_id"=> "10"
            ]);

        FreelancerRegionPivot::create([
            "region_id" => "1",
            "user_id"=> "11"
            ]);

        FreelancerRegionPivot::create([
            "region_id" => "1",
            "user_id"=> "12"
            ]);

        FreelancerRegionPivot::create([
            "region_id" => "2",
            "user_id"=> "13"
            ]);

        // Freelancers calenders
        FreelancerCalendar::create([
            "user_id" => "6",
            "date_of_day"=> "2021-11-20",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "6",
            "date_of_day"=> "2021-11-21",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "6",
            "date_of_day"=> "2021-11-22",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "6",
            "date_of_day"=> "2021-11-22",
            "availability"=> "0"
            ]);


        FreelancerCalendar::create([
            "user_id" => "7",
            "date_of_day"=> "2021-11-20",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "7",
            "date_of_day"=> "2021-11-21",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "7",
            "date_of_day"=> "2021-11-22",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "7",
            "date_of_day"=> "2021-11-22",
            "availability"=> "0"
            ]);


        FreelancerCalendar::create([
            "user_id" => "8",
            "date_of_day"=> "2021-11-20",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "8",
            "date_of_day"=> "2021-11-21",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "8",
            "date_of_day"=> "2021-11-22",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "8",
            "date_of_day"=> "2021-11-22",
            "availability"=> "0"
            ]);


        FreelancerCalendar::create([
            "user_id" => "9",
            "date_of_day"=> "2021-11-20",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "9",
            "date_of_day"=> "2021-11-21",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "9",
            "date_of_day"=> "2021-11-22",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "9",
            "date_of_day"=> "2021-11-22",
            "availability"=> "0"
            ]);

        FreelancerCalendar::create([
            "user_id" => "10",
            "date_of_day"=> "2021-11-20",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "10",
            "date_of_day"=> "2021-11-21",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "10",
            "date_of_day"=> "2021-11-22",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "10",
            "date_of_day"=> "2021-11-22",
            "availability"=> "0"
            ]);

        FreelancerCalendar::create([
            "user_id" => "11",
            "date_of_day"=> "2021-11-20",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "11",
            "date_of_day"=> "2021-11-21",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "11",
            "date_of_day"=> "2021-11-22",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "11",
            "date_of_day"=> "2021-11-22",
            "availability"=> "0"
            ]);

        FreelancerCalendar::create([
            "user_id" => "12",
            "date_of_day"=> "2021-11-20",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "12",
            "date_of_day"=> "2021-11-21",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "12",
            "date_of_day"=> "2021-11-22",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "12",
            "date_of_day"=> "2021-11-22",
            "availability"=> "0"
            ]);

        FreelancerCalendar::create([
            "user_id" => "13",
            "date_of_day"=> "2021-11-20",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "13",
            "date_of_day"=> "2021-11-21",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "13",
            "date_of_day"=> "2021-11-22",
            "availability"=> "0"
            ]);
        FreelancerCalendar::create([
            "user_id" => "13",
            "date_of_day"=> "2021-11-22",
            "availability"=> "0"
            ]);

        FreelancerCalendar::create([
            "user_id" => "6",
            "date_of_day"=> "2021-11-30",
            "availability"=> "1"
            ]);
        FreelancerCalendar::create([
            "user_id" => "7",
            "date_of_day"=> "2021-11-30",
            "availability"=> "1"
            ]);
        FreelancerCalendar::create([
            "user_id" => "10",
            "date_of_day"=> "2021-11-30",
            "availability"=> "1"
            ]);
        FreelancerCalendar::create([
            "user_id" => "11",
            "date_of_day"=> "2021-11-30",
            "availability"=> "1"
            ]);

        //appointments
        Appointment::create([
            "calendar_id" => "33",
            "user_id"=> "1",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);
        Appointment::create([
            "calendar_id" => "33",
            "user_id"=> "2",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);
        Appointment::create([
            "calendar_id" => "33",
            "user_id"=> "3",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);
        Appointment::create([
            "calendar_id" => "33",
            "user_id"=> "4",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);
        Appointment::create([
            "calendar_id" => "33",
            "user_id"=> "5",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);

        Appointment::create([
            "calendar_id" => "34",
            "user_id"=> "1",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);
        Appointment::create([
            "calendar_id" => "34",
            "user_id"=> "2",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);
        Appointment::create([
            "calendar_id" => "34",
            "user_id"=> "3",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);
        Appointment::create([
            "calendar_id" => "34",
            "user_id"=> "4",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);
        Appointment::create([
            "calendar_id" => "34",
            "user_id"=> "5",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);

        Appointment::create([
            "calendar_id" => "35",
            "user_id"=> "1",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);
        Appointment::create([
            "calendar_id" => "35",
            "user_id"=> "2",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);
        Appointment::create([
            "calendar_id" => "35",
            "user_id"=> "3",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);
        Appointment::create([
            "calendar_id" => "34",
            "user_id"=> "4",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);
        Appointment::create([
            "calendar_id" => "35",
            "user_id"=> "5",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);

        Appointment::create([
            "calendar_id" => "36",
            "user_id"=> "1",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);
        Appointment::create([
            "calendar_id" => "36",
            "user_id"=> "2",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);
        Appointment::create([
            "calendar_id" => "36",
            "user_id"=> "3",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);
        Appointment::create([
            "calendar_id" => "36",
            "user_id"=> "4",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);
        Appointment::create([
            "calendar_id" => "36",
            "user_id"=> "5",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'0'
            ]);

        //done appointments
        Appointment::create([
            "calendar_id" => "36",
            "user_id"=> "1",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'1'
            ]);
        Appointment::create([
            "calendar_id" => "35",
            "user_id"=> "1",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'1'
            ]);
        Appointment::create([
            "calendar_id" => "34",
            "user_id"=> "1",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'1'
            ]);
        Appointment::create([
            "calendar_id" => "33",
            "user_id"=> "1",
            "longitude"=> "33.84631872619141",
            "latitude"=> "35.507493995180134",
            "description"=> "Broken {example} ...",
            "status"=>'1'
            ]);

        //freelancer ratings
        rating::create([
            "user_rating"=>'1',
            "rated_user"=>'6',
            "ratings"=>'4'
        ]);
        rating::create([
            "user_rating"=>'1',
            "rated_user"=>'7',
            "ratings"=>'2'
        ]);
        rating::create([
            "user_rating"=>'1',
            "rated_user"=>'10',
            "ratings"=>'3'
        ]);
        rating::create([
            "user_rating"=>'1',
            "rated_user"=>'11',
            "ratings"=>'5'
        ]);

        ///connection
        Connection::create([
            "user1"=>'1',
            "user2"=>'6',
        ]);
        Connection::create([
            "user1"=>'6',
            "user2"=>'1',
        ]);

        Connection::create([
            "user1"=>'1',
            "user2"=>'7',
        ]);
        Connection::create([
            "user1"=>'7',
            "user2"=>'1',
        ]);

        Connection::create([
            "user1"=>'1',
            "user2"=>'10',
        ]);
        Connection::create([
            "user1"=>'10',
            "user2"=>'1',
        ]);

        Connection::create([
            "user1"=>'1',
            "user2"=>'11',
        ]);
        Connection::create([
            "user1"=>'11',
            "user2"=>'1',
        ]);

        //messages
        Message::create([
            "sender_id"=>'1',
            "receiver_id"=>'6',
            "message"=>'Hello can be here as early as possible',
        ]);

        Message::create([
            "sender_id"=>'1',
            "receiver_id"=>'7',
            "message"=>'Hello can be here as early as possible',
        ]);

        Message::create([
            "sender_id"=>'1',
            "receiver_id"=>'10',
            "message"=>'Hello can be here as early as possible',
        ]);

        Message::create([
            "sender_id"=>'1',
            "receiver_id"=>'11',
            "message"=>'Hello can be here as early as possible',
        ]);


        Message::create([
            "sender_id"=>'6',
            "receiver_id"=>'1',
            "message"=>'Hello I am on my way',
        ]);

        Message::create([
            "sender_id"=>'7',
            "receiver_id"=>'1',
            "message"=>'Hello is there any electric problems',
        ]);

        Message::create([
            "sender_id"=>'10',
            "receiver_id"=>'1',
            "message"=>'Hello coming',
        ]);

        Message::create([
            "sender_id"=>'11',
            "receiver_id"=>'1',
            "message"=>'Hello sir do not worry I will fix it ',
        ]);
    }
}
