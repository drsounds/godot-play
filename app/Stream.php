<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    use HasFactory;
    public function asset() {
      return $this->belongsTo("App\Asset");
    }
    public function assetVersion() {
      return $this->belongsTo("App\AssetVersion");
    }
    public function user() {
      return $this->belongsTo("App\User");
    }
    public $fillable = ['user_id', 'asset_id', 'asset_version_id'];
}
