<?php
namespace App\Http\Interfaces;

use App\Models\Interest;

Interface InterestRepositoryInterface{
    public function allInterests();
    public function storeInterest($data);
    public function updateInterest($data, Interest $interest); 
    public function destroyInterest(Interest $interest);
}