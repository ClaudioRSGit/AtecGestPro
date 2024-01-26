<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'description',
        'ticket_status_id',
        'ticket_priority_id',
        'ticket_category_id',
        'attachment',
        'user_id',
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
}
