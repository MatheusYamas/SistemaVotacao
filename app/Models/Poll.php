<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Poll extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'data_inicio', 'data_termino'];

    protected $casts = ['data_inicio' => 'datetime', 'data_termino' => 'datetime'];

    public function options(){
        return $this->hasMany(Option::class);
    }

    public function isRunning(): bool{
        $now = Carbon::now();
        if (is_null($this->data_inicio) && is_null($this->data_termino)){
            return true;
        }

        if ($this->data_inicio && $this->data_termino){
            return $now->between($this->data_inicio, $this->data_termino);
        }
        return false;
    }

    protected function status(): Attribute{
        return Attribute::make(
            get: function (){
                $now = now();

                if ($this->data_inicio && $now->isBefore($this->data_inicio)){
                    return 'Não Iniciada';
                }

                if ($this->data_termino && $now->isAfter($this->data_termino)){
                    return 'Finalizada';
                }

                return 'Em Andamento';
            }
        );
    }
}
