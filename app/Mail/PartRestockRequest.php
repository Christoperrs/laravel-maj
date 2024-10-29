<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PartRestockRequest extends Mailable
{
    use Queueable, SerializesModels;

    protected $nama;
    protected $website;
    protected $partsToRestock;

    public function __construct($nama, $website, $partsToRestock)
    {
        $this->nama = $nama;
        $this->website = $website;
        $this->partsToRestock = $partsToRestock; // Store the parts to restock
    }

    public function build()
    {   
        print_r($this->partsToRestock);
        return $this->from('royalespirit4@gmail.com')
                    ->view('email/request')
                    ->with([
                        'nama' => $this->nama,
                        'website' => $this->website,
                        'items' => $this->partsToRestock, // Pass the parts to the view
                    ]);
    }
}