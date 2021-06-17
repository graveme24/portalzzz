<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	use HasFactory;

	protected $fillable = [
		'title', 'start', 'end'
	];

    public function getEventDate() {
        $start_date = strtotime($this->attributes['start']);
        $end_date = strtotime($this->attributes['end']);

        if ($start_date == $end_date) {
            return date('d M', $start_date);
        }
        else if (date('M-Y', $start_date) == date('M-Y', $end_date)) {
            return date('d', $start_date) . '-' . date('d M', $end_date);
        }

        return date('M d', $start_date) . ' - '. date('M d', $end_date);
    }
}

?>
