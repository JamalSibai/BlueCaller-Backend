<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Appointment;

class FreelancerCalendar extends Model
{
    protected $table = "calendars";
    use HasFactory;

    public function CalendarAppointment(){
        return $this->hasMany(Appointment::class, 'calendar_id');
    }
}
