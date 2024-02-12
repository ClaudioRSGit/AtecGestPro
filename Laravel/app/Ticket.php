<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use softDeletes;

    protected $fillable = [
        'title',
        'description',
        'ticket_status_id',
        'ticket_priority_id',
        'ticket_category_id',
        'user_id',
        'dueByDate',
        'attachment'
    ];
    public function ticketHistories()
    {
        return $this->hasMany(TicketHistory::class);
    }

    public function ticketStatus(){
        return $this->belongsTo(TicketStatus::class);
    }

    public function ticketType(){
        return $this->belongsTo(TicketCategory::class);
    }

    public function ticketPriority(){
        return $this->belongsTo(TicketPriority::class);
    }

    public function ticketCategory(){
        return $this->belongsTo(TicketCategory::class);
    }

    public function users(){
        return $this->belongsToMany(User::class, 'ticket_users');
    }

    public function requester(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function getInitialsAttribute()
    {
        $nameParts = explode(' ', $this->name);
        $firstNameInitial = $nameParts[0][0] ?? '';
        $lastNameInitial = count($nameParts) > 1 ? $nameParts[count($nameParts) - 1][0] : '';

        return strtoupper($firstNameInitial . $lastNameInitial);
    }
}
